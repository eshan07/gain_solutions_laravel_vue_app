import axios from "axios";

export default {
    namespaced: true,
    state: {
        cart: {},
    },
    getters: {
        getCart(state) {
            return state.cart
        },
    },
    actions: {
        getCart(context, payload) {
            return new Promise((resolve, reject) => {
                axios.get('/cart', payload).then(response => {
                    context.commit('setCart', response.data.carts)
                    resolve('success')
                }).catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
        addCart(context, payload) {
            return new Promise((resolve, reject) => {
                axios.post('/cart', payload).then(response => {
                    // console.log(response)
                    resolve(response)
                }).catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
        removeCart(context, payload) {
            return new Promise((resolve, reject) => {
                axios.delete(`/cart/${payload.cart.id}`).then(response => {
                    resolve(response)
                }).catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
    },
    mutations: {
        setCart(state, values) {
            state.cart = values
        },
    },
}
