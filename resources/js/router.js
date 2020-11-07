import Vue from 'vue'
import Router from 'vue-router'

//page 
import home from './pages/home.vue'
import cart from './pages/cart/cart.vue'
import test from './pages/test.vue'
import category from './pages/category.vue'
import productDetails from './pages/product-details.vue'
import login from './pages/checkout/login-checkout.vue'
import checkout from './pages/checkout/checkout.vue'
import payment from './pages/payment/payment.vue'

Vue.use(Router)

const routes = [
    //route project
    {
        path: '/',
        component: home,
        name: 'home',
    },

    // {
    //     path: '/shop',
    //     component: shop,
    //     name: 'shop',
    // },
    // {
    //     path: '/blog',
    //     component: blog,
    //     name: 'blog',
    // },
    {
        path: '/contact',
        component: test,    
        name: 'contact',
    },
    {
        path: '/cart',
        component: cart,
        name: 'cart',
    },
    {
        path: '/login',
        component: login,
        name: 'login',
    },
    {
        path: '/categories',
        component: category,
        name: 'categories.index',
    },
    {
        path: '/categories/:productName',
        component: productDetails,
        name: 'categories.show',
    },
    {
        path: '/checkout',
        component: checkout,
        name: 'checkout',
    },
    {
        path: '/payment',
        component: payment,
        name: 'payment',
    },
]



export default new Router({
    mode: 'history',
    routes
})