<template>
<div>
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Product List</h2>
        <div class="col-sm-4" v-for="(product, index) in products" :key="index">
            <div class="product-image-wrapper">
                <div class="single-products" @click="goToProductDetails(product.product_id, product.product_name)">
                    <div class="productinfo text-center">
                        <img :src="productImage(product.product_image)" alt="Haven't yet" />
                        <h2>{{formatNumber(product.product_price)}} VND</h2>
                        <p>{{product.product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{formatNumber(product.product_price)}} VND</h2>
                            <p>{{product.product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--features_items-->

</div>
</template>

<script>
export default {
    name: 'features',
    props: {
        products: {
            type: Array,
            required: true,
        }
    },
    data() {
        return {
            productList: [],
        }
    },
    methods: {

        goToProductDetails(productId, productName) {
            this.$router.push({
                name: 'categories.show',
                params: {
                    productName
                },
                query: {
                    productId
                },
            });
        },

    },
    created() {
        this.productList = this.products;
    },
}
</script>

<style>

</style>
