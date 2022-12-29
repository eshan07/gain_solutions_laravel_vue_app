<template>
    <div>
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
        <router-link class="d-flex align-items-center justify-content-center ml-4 text-decoration-none mr-auto" :to="{name:'home'}">
            <!--            <div class="sidebar-brand-icon" style="margin-left: -12% !important;">-->
            <!--                <img src='#' class="rounded" alt="image"-->
            <!--                     style="height: 100px; width: 100px">-->
            <!--            </div>-->
            <div class="sidebar-brand-text" style="margin-left: -8% !important;">Gain Solutions</div>
        </router-link>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav mr-4">
            <!-- Nav Item  -->
            <li class="nav-item no-arrow">
                <router-link class="nav-link" :to="{name:'home'}">
                    <span>Product</span>
                </router-link>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item no-arrow">
                <router-link class="nav-link" :to="{name:'about'}">
                    <span>About</span>
                </router-link>
            </li>
            <div class="topbar-divider d-none d-sm-block"></div>

            <li class="nav-item no-arrow">
                <router-link class="nav-link" id="sidebarCollapse" @click.prevent='toggle = !toggle' to="#cart">
                    Cart
                    <span class="badge badge-danger badge-counter">{{rows.length}}</span>
                </router-link>
            </li>
        </ul>
    </nav>
        <CartDrawer :toggle="toggle" @closeCart="toggle = !toggle" :carts="rows"/>
    </div>
</template>

<script>
import CartDrawer from "./CartDrawer.vue";

export default {
    name: "NavBar",
    components: {CartDrawer},
    data(){
        return {
            toggle: true //toggle variable
        }
    },
    computed: {
        rows() {
            return this.$store.getters['cart/getCart']
        },
    },
    created() {
        this.getCart()
    },
    mounted() {
        this.emitter.on("toggle-sidebar", toggle => {
            this.toggle = toggle;
            this.getCart()
        });
    },
    methods:{
        asd(){
            this.toggle = false
        },
        getCart() {
            this.$store.dispatch('cart/getCart')
        },
    }
}
</script>

<style scoped>
.topbar.navbar-light .navbar-nav .nav-item .nav-link:hover {
    color: #000005;
}
.topbar.navbar-light .navbar-nav .nav-item .nav-link {
    color: #878787;
}
.badge-counter {
    right: -0.80rem !important;
}
</style>
