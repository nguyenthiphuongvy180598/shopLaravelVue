<template>
<div>
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a @click="$router.push({name: 'home'})">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                <table class="table table-condensed">
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(product, index) in cart">
                            <cartItem :propProduct="product" @onChangeQty="onChangeQty" @deleted="deleted" ref="products" :key="index"></cartItem>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!--/#cart_items-->
    <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>{{formatNumber(net)}} VND</span></li>
                            <li>Eco Tax <span>{{formatNumber(tax)}} VND</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>{{formatNumber(totalPrice)}} VND</span></li>
                        </ul>
                        <a class="btn btn-default check_out" @click="checkOut">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#do_action-->

</div>
</template>

<script>
import cartItem from './cartItem'
export default {
    name: 'cart',
    components: {
        cartItem,
    },
    data() {
        return {
            cart: null,
        }
    },
    computed: {
        net() {
            let total = 0;
            for (let key in this.cart) {
                total += this.cart[key].price * this.cart[key].qty;
            }
            return total;
        },
        tax() {
            let tax = 0;
            for (let key in this.cart) {
                tax += this.cart[key].tax;
            }
            return tax;
        },
        totalPrice() {
            return this.net + this.tax;
        }
    },
    methods: {
        async getCart() {
            const res = await this.callApi("get", "/get_Cart");
            if (res.status === 200) {
                this.cart = res.data;
            }
        },
        deleted() {
            this.getCart();
            alert('xoa thanh cong');
        },
        onChangeQty() {
            console.log(this.$refs.products)
            this.cart = {};
            for (let key in this.$refs.products) {
                this.cart[key] = this.$refs.products[key].product;
            }
        },
        async checkOut() {
            const res = await this.callApi("post", "/validate_checkout", {
                cart: this.cart
            });
            if (res.status === 200) {
                this.$router.push({
                    name: 'checkout',
                });
            } else if (res.status === 401) {
                this.$router.push({
                    name: 'login',
                    query: {
                        to: 'checkout'
                    }
                });
            }

        }
    },
    created() {
        this.getCart();
    }
}
</script>

<style>

</style>
