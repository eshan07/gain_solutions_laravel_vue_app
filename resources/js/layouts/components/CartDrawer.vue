<template>
    <div>
        <nav id="sidebar" v-bind:class = "(toggle)?'show':'hide'">
            <div id="dismiss" @click.prevent="$emit('closeCart')">
                <i class="fas fa-times"></i>
            </div>
            <div class="sidebar-header">
                <h3>Cart</h3>
            </div>
            <div>
               <table class="table table-borderless text-white">
                   <tr v-for="(cart,index) in carts">
                       <td>{{cart.name}}</td>
                       <td class="text-right">{{cart.quantity}}</td>
                       <td class="text-center">{{cart.quantity * cart.price}} <span class="pointer" @click.prevent="removeCart(cart)"><i class="fas fa-times"></i></span></td>

                   </tr>
               </table>
            </div>

                <table class="table table-borderless text-white bottom-total h5">
                    <tr>
                        <td>Total</td>
                        <td class="text-center">{{Array.from(carts).reduce((sum,item) => sum + item.price * item.quantity, 0)}}</td>
                    </tr>
                </table>
            <button type="button" class="btn btn-secondary btn-block bottom">Pay</button>


        </nav>
        <!--        <div class="overlay" v-bind:class = "(toggle)?'':'active'"></div>-->
    </div>
</template>

<script>
export default {
    name: "CartDrawer",
    props: {
        toggle: {
            type: Boolean,
            default: false
        },
        carts: {
            type: Object,
            default: () => {}
        },
    },
    methods:{
        removeCart(cart) {
            this.$store.dispatch('cart/removeCart',{
                    cart
            }).then((response)=>{
                if (response.data.success){
                    let index = this.carts.findIndex(item => item.id === cart.id)
                    this.carts.splice(index,1)
                }
            })
        },
    }
}
</script>

<style scoped>
.pointer {
    cursor: pointer;
}
.bottom{
    position:absolute;
    bottom: 0;
}
.bottom-total{
    position:absolute;
    bottom: 1.5rem;
}
#sidebar {
    width: 350px;
    position: fixed;
    top: 0;
    right: -350px;
    height: 100vh;
    z-index: 999;
    background: #7386D5;
    color: #fff;
    transition: all 0.3s;

    box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
}
#sidebar.active {
    right: 0;
}
#dismiss {
    width: 35px;
    height: 35px;
    line-height: 35px;
    text-align: center;
    background: #7386D5;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
    -webkit-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
}
#dismiss:hover {
    background: #fff;
    color: #7386D5;
}
.overlay {
    display: none;
    position: fixed;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.7);
    z-index: 998;
    opacity: 0;
    transition: all 0.5s ease-in-out;
}
.overlay.active {
    display: block;
    opacity: 1;
}
#sidebar .sidebar-header {
    padding: 20px;
    background: #6d7fcc;
}
#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}
#sidebar ul p {
    color: #fff;
    padding: 10px;
}
#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
    color: #ffffff;
    text-decoration: none;
}
#sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
}
#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #fff;
    background: #6d7fcc;
}
a[data-toggle="collapse"] {
    position: relative;
}
.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}
ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}
ul.CTAs {
    padding: 20px;
}
ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}
a.download {
    background: #fff;
    color: #7386D5;
}
a.article,
a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}
/* ---------------------------------------------------
  CONTENT STYLE
----------------------------------------------------- */
#content {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
    position: absolute;
    top: 0;
    right: 0;
}
.overlay.active {
    display: block;
    opacity: 1;
}
.overlay {
    display: none;
    position: fixed;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.7);
    z-index: 998;
    opacity: 0;
    transition: all 0.5s ease-in-out;
}
@media (min-width: 768px) {
    #sidebar {
        margin-right: 0;
    }

    #content {
        min-width: 0;
        width: 100%;
    }
    .show
    {
        margin-right: 0!important;
    }
    .hide
    {
        margin-right: 350px!important;
    }
}
@media (max-width: 767px) {
    .show
    {
        margin-right: 0!important;
    }
    .hide
    {
        margin-right: 350px!important;
    }
}
</style>
