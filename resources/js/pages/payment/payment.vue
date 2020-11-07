<template>
<section id="cart_items">
    <div v-if="!finishOrder" class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a @click="$router.push({name: 'home'})">Home</a></li>
                <li><a @click="$router.push({name: 'cart'})">Cart</a></li>
                <li><a @click="$router.push({name: 'checkout'})">Check out</a></li>
                <li class="active">Payment</li>
            </ol>
        </div>
        <!--/breadcrums-->
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="payment-options">
            <span>
                <label><input name="payment_method" type="radio" value="Direct Bank Transfer" v-model="payment_method"> Direct Bank Transfer</label>
            </span>
            <span>
                <label><input name="payment_method" type="radio" value="Check Payment" v-model="payment_method"> Check Payment</label>
            </span>
            <span>
                <label><input name="payment_method" type="radio" value="Paypal" v-model="payment_method"> Paypal</label>
            </span>

            <button @click="orderHandle" class="btn btn-default" :style="{background: '#FE980F', color: 'white'}">Order</button>
        </div>
    </div>
    <template v-else>
        <finishOrder></finishOrder>
    </template>
</section>
<!--/#cart_items-->
</template>
</template>

<script>
import finishOrder from '../finish-order'
export default {
    name: 'payment',
    components: {
        finishOrder,
    },
    data() {
        return {
            payment_method: '',
            finishOrder: false,
        }
    },
    methods: {
        async orderHandle() {
            const res = await this.callApi("post", "/save_order", {
                payment_method: this.payment_method
            });
            if (res.status === 200) {
                this.finishOrder = true;
            }
        }
    },

}
</script>

<style>

</style>
