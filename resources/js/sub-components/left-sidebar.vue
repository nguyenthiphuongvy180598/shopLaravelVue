<template>
<div class="left-sidebar">
    <h2>Category</h2>
    <div v-if="categories.length > 0" class="panel-group category-products" id="accordian">
        <!--category-productsr-->
        <div v-for="(cate, index) in categories" :key="index" class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><a @click="onChange(cate.category_name, cate.category_id)">{{cate.category_name}}</a></h4>
            </div>
        </div>

    </div>
    <!--/category-products-->

    <!--brands_products-->

    <!--/brands_products-->

    <div class="price-range">
        <!--price-range-->
        <h2>Price Range</h2>
        <div class="well text-center">
            <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2"><br />
            <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
        </div>
    </div>
    <!--/price-range-->

    <div class="shipping text-center">
        <!--shipping-->
        <img src="/fontend/images/home/shipping.jpg" alt="" />
    </div>
    <!--/shipping-->

</div>
</template>

<script>
export default {
    name: 'left-sidebar',
    data() {
        return {
            categories: [],
        }
    },
    methods: {
        onChange(categoryName) {
            this.$router.push({
                name: 'categories.index',
                query: {
                    categoryName
                },
            });
            this.$emit('pushCategoryName', categoryName);

        },
    },
    async created() {
        const res = await this.callApi("get", "/get_categories");
        if (res.status === 200) {
            this.categories = res.data;
        }
    },
}
</script>

<style>

</style>
