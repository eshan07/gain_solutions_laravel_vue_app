import 'bootstrap/dist/css/bootstrap.css'
import {createApp} from "vue/dist/vue.esm-bundler";
// import the root component App from a single-file component.
import AppComponent from './App.vue'
import router from './router/index'
import store from './store/index'

const app = createApp({
    components:{
        AppComponent,
    }
})
app.use(router)
app.use(store)
app.mount('#app');
import 'bootstrap/dist/js/bootstrap.js'
