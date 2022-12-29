import axios from "axios";

export default {
    namespaced: true,
    state: {
        products: {},
    },
    getters: {
        getProducts(state) {
            return state.products
        },
    },
    actions: {
        getProducts(context, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/product-list', payload).then(response => {
                    context.commit('setProducts', response.data.products)
                    // context.commit('setPosition', response.data.positions.data)
                    resolve('success')
                }).catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
    },
    mutations: {
        setProducts(state, values) {
            state.products = values
        },
    },
}
