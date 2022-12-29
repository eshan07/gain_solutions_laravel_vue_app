<template>
    <div>
        <div class="container p-0 mt-5 mb-5">
            <div class="row row-cols-1 row-cols-lg-5 row-cols-md-2 g-4">
                <div class="col"
                     v-for="(product, index) in products.data"
                     :key="index"
                      @click.prevent="addToCart(product)"
                >
                    <div class="card hover-div">
                        <i class="bi bi-heart-fill"></i>
                        <img :src="product.feature_image" class="card-img-top"
                             alt="...">
                        <div class="card-body text-center">
                            <h6 class="card-title">{{ product.name }}</h6>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <h5 class="text-danger pt-0">৳ {{ product.price }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductThumbnail",
    props: {
        products: {
            type: Object,
            default: () => {
            }
        },
    },
    methods:{
        addToCart(product){
            this.$store.dispatch('cart/addCart',{
                slug:product.slug,
                quantity:1
            }).then((response) => {
                this.emitter.emit("toggle-sidebar");
            })
        }
    }
}
</script>

<style scoped>
img {
    height: 200px;
}

.card {
    padding: 10px;
    height: 100%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, .1), 0 8px 16px rgba(0, 0, 0, .1);
}

h5 {
    padding-top: 15px;
}

@media (max-width: 768px) {
    img {
        height: 100%;
    }
}

@media (max-width: 575px) {
    .container {
        width: 90%;
    }
}

.hover-div {
    text-align: center;
}

.hover-div {
    border-top: 1px solid #f8f8f8;
    background: #ffffff;
    box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.2);
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    margin: 10px 0px;
}

.hover-div:hover {
    -webkit-transform: translateY(-20px);
    -ms-transform: translateY(-20px);
    transform: translateY(-20px);
    box-shadow: 0 22px 43px rgba(0, 0, 0, 0.32);
    cursor: pointer;
    border-radius: 5px;
}
</style>
