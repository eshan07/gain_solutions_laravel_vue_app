import { createStore } from 'vuex'
import product from './product'
import cart from './cart'
// Create a new store instance.
const store = createStore({
    modules:{
        product,
        cart
    },
})

export default store;
