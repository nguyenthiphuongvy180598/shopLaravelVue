<template>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <leftSidebar @pushCategoryName="value => pushCategoryName(value)"></leftSidebar>
            </div>

            <div class="col-sm-9 padding-right">
                <features v-if="products" :products="products"></features>
            </div>
        </div>
    </div>
</section>
</template>

<script>
import features from '../sub-components/features'
import leftSidebar from '../sub-components/left-sidebar'
export default {
    name: "category",
    components: {
        leftSidebar,
        features,
    },
    data() {
        return {
            categoryName: '',
            products: [],
        }
    },
    methods: {
        pushCategoryName(categoryName) {
            this.categoryName = categoryName;
            this.getProducts();
        },
        async getProducts() {
            const res = await this.callApi("get", "/get_products", {
                categoryName: this.categoryName
            });
            if (res.status === 200) {
                this.products = res.data;
            }
        }
    },
    async created() {
        this.categoryName = this.$route.query.categoryName;
        this.getProducts();
    }
};
</script>

<style>
</style>
