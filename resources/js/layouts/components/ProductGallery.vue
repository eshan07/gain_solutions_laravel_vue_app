<template>
<div>
    <SearchProduct @search="handleSearch"/>
    <ProductThumbnail :products="products"/>

</div>
</template>

<script>
import SearchProduct from "./SearchProduct.vue";
import ProductThumbnail from "./ProductThumbnail.vue";

export default {
    name: "ProductGallery",
    components: { ProductThumbnail, SearchProduct},
    props:{
        products: {
            type: Object,
            default: ()=>{}
        },
    },
    methods:{
        handleSearch(search_key){
            return this.$emit('search', search_key)
        }
    }
}
</script>

<style scoped>

</style>
