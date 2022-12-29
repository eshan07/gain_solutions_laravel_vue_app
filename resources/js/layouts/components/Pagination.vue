<template>
<div>
    <Bootstrap5Pagination/>
</div>
</template>

<script>

export default {
    name: "Pagination",
    props:{
        products: {
            type: Object,
            default: ()=>{}
        },
    }
}
</script>

<style scoped>

</style>
