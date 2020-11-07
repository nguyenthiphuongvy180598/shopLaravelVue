<template>
<tr v-if="product">
    <td class="cart_product">
        <a href=""><img :src="productImage(product.options.image)" alt="Haven't yet"></a>
    </td>
    <td class="cart_description">
        <h4><a href="">{{product.name}}</a></h4>
        <p>Product ID: {{product.id}}</p>
    </td>
    <td class="cart_price">
        <p>{{formatNumber(product.price)}} VND</p>
    </td>
    <td class="cart_quantity">
        <div class="cart_quantity_button">
            <a class="cart_quantity_up" @click="checkAdd"> + </a>
            <input class="cart_quantity_input" type="text" v-model="product.qty" autocomplete="off" size="2">
            <a class="cart_quantity_down" @click="checkSub"> - </a>
        </div>
    </td>
    <td class="cart_total">
        <p class="cart_total_price">{{product.qty*product.price}}</p>
    </td>
    <td class="cart_delete">
        <a class="cart_quantity_delete" @click="deleteProduct(product.rowId)"><i class="fa fa-times"></i></a>
    </td>
</tr>
</template>

<script>
export default {
    name: 'cartItem',
    props: {
        propProduct: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            product: null,
        }
    },
    methods: {
        checkAdd() {
            this.product.qty++;
            this.$emit('onChangeQty')
        },
        checkSub() {
            this.product.qty <= 1 ? 1 : this.product.qty--;
            this.$emit('onChangeQty')
        },
        async deleteProduct(rowId) {
            const res = await this.callApi("post", "/delete_product_cart", {
                rowId: rowId
            });
            if (res.status === 200) {
                this.$emit('deleted')
            }
        },
    },
    created() {
        this.product = this.propProduct;
    }
}
</script>

<style>

</style>
