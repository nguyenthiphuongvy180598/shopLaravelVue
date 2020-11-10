<template>
<div>
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Product List</h2>
        <div class="col-sm-4" v-for="(product, index) in products" :key="index">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a @click="goToProductDetails(product.product_id, product.product_name)">
                            <img :src="productImage(product.product_image)" alt="Haven't yet" />
                            <h2>{{formatNumber(product.product_price)}} VND</h2>
                            <p>{{product.product_name}}</p>
                        </a>
                        <button type="button" class="btn btn-default add-to-cart" @click="addToCart(product.product_id)"><i class="fa fa-shopping-cart"></i>Add to cart</button>
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
        // async addCartAjax(product) {
        //     const res = await this.callApi("post", "/add_cart_ajax", {
        //         product
        //     });
        //     if (res.status === 200) {
        //         swal("Successful!", "Your product is added!", "success");
        //     }
        // },
        async addToCart(productId) {
            const res = await this.callApi("post", "/add_to_cart", {
                productId: productId,
                qty: '1'
            });
            if (res.status === 200) {
                swal("Successful!", "Your product is added!", "success");
            }
        },
    },
    created() {
        this.productList = this.products;
    },
}
</script>

<style>

</style>
