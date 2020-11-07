<template>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a @click="$router.push({name: 'home'})">Home</a></li>
                <li><a @click="$router.push({name: 'cart'})">Cart</a></li>
                <li class="active">Check out</li>
            </ol>
        </div>
        <!--/breadcrums-->

        <!--/checkout-options-->
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-10 form clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form @submit.prevent="saveCheckout">
                                <input type="email" v-model="dataCheckOut.email" placeholder="Email">
                                <input type="text" v-model="dataCheckOut.name" placeholder="Name">
                                <input type="text" v-model="dataCheckOut.address" placeholder="Address">
                                <input type="text" v-model="dataCheckOut.phone" placeholder="Phone">
                                <div class="order-message">
                                    <textarea v-model="dataCheckOut.notes" placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                                </div>
                                <button class="btn btn-default">Check Out</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#cart_items-->
</template>

<script>
import loginCheckoutVue from './login-checkout.vue';
export default {
    name: 'checkout',
    data() {
        return {
            dataCheckOut: {
                name: '',
                email: '',
                phone: '',
                address: '',
                notes: '',
                customer_id: '',
            }
        }
    },
    methods: {
        async saveCheckout() {
            const res = await this.callApi("post", "/save_checkout_customer", this.dataCheckOut);
            if (res.status === 200) {
                this.$router.push({
                    name: 'payment',
                });
            } else {
                alert('Erorr')
            }
        },
    },
    created() {
        this.dataCheckOut.customer_id = this.$route.query.customerId;
    }
}
</script>

<style>

</style>
