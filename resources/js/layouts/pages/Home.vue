<template>
    <div>
        <ProductGallery :products="rows" @search="handleSearch"/>
        <Bootstrap5Pagination
            v-if="rows.meta && rows.meta.total>rows.meta.per_page"
            class="justify-content-center"
            :data="rows"
            :show-disabled=true
            @pagination-change-page="getProducts"
        />
    </div>
</template>

<script>
import ProductGallery from "../components/ProductGallery.vue";
import {Bootstrap5Pagination} from "laravel-vue-pagination";
export default {
    name: "Home",
    components: {ProductGallery,Bootstrap5Pagination},
    data() {
        return {
            searchTerm: '',
            perPage: 10,
            page: 1,
            pageLength: 10,
        }
    },
    computed: {
        rows() {
            return this.$store.getters['product/getProducts']
        },
    },
    mounted() {
        this.getProducts()
    },
    methods:{
        handleSearch(search_key){
            this.searchTerm = search_key
            this.getProducts()
        },
        getProducts(current_page = 1) {
            this.$store.dispatch('product/getProducts', {
                params: {
                    page: current_page,
                    per_page: this.pageLength,
                    searchTerm: this.searchTerm,
                },
            })
        },
        handleChangePage(page) {
            this.getProducts(page)
        },
        selectedPage(value) {
            this.getProducts(this.page, value)
        },
        searchHandler() {
            this.getProducts(this.page, this.pageLength, this.searchTerm)
        },
    }
}
</script>

<style scoped>

</style>
