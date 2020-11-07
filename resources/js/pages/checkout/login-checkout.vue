<template>
<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <h2>Login to your account</h2>
                    <form @submit.prevent="signIn">
                        <input type="email" v-model="dataSignIn.email" placeholder="Email" />
                        <input type="password" v-model="dataSignIn.password" placeholder="Password" />
                        <button name="signIn" class="btn btn-default">Login</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <h2>New User Signup!</h2>
                    <form @submit.prevent="signUp">
                        <input type="text" v-model="dataSignUp.name" placeholder="Name" />
                        <input type="email" v-model="dataSignUp.email" placeholder="Email Address" />
                        <input type="password" v-model="dataSignUp.password" placeholder="Password" />
                        <input type="text" v-model="dataSignUp.phone" placeholder="Phone" />
                        <button name="signup" class="btn btn-default">Sign Up</button>
                    </form>
                </div>
                <!--/sign up form-->
            </div>
        </div>
    </div>
</section>
<!--/form-->
</template>

<script>
export default {
    name: 'login-checkout',
    data() {
        return {
            dataSignUp: {
                name: '',
                email: '',
                password: '',
                phone: '',
            },
            dataSignIn: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        async signIn() {
            const res = await this.callApi("post", "/login_customer", this.dataSignIn);
            if (res.status === 200) {
                let customer_id = res.data;
                if (customer_id) {
                    this.$router.push({
                        name: this.$route.query.to,
                        query: {
                            customerId: customer_id,
                        }
                    });
                } else {
                    alert('Dang nhap that bai');
                }
            }
        },
        async signUp() {
            const res = await this.callApi("post", "/add_customer", this.dataSignUp);
            if (res.status === 200) {
                let customer_id = res.data;
                if (this.$route.query.to) {
                    this.$router.push({
                        name: this.$route.query.to,
                        query: {
                            customerId: customer_id,
                        }
                    });
                }
            }
        }
    },

}
</script>

<style>

</style>
