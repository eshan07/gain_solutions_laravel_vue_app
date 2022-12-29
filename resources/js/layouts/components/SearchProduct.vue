<template>
        <div>
            <input v-model="search_key" type="text" class="form-control bg-light border-1 small" placeholder="Search for..."
                   aria-label="Search" aria-describedby="basic-addon2" @keyup.prevent="$emit('search',search_key)">
        </div>
</template>

<script>
export default {
    name: "SearchProduct",
    data(){
        return {
            search_key:''
        }
    }
}
</script>

<style scoped>

</style>
