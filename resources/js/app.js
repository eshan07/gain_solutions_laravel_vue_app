import 'bootstrap/dist/css/bootstrap.css'
import '../css/all.min.css'
import '../css/sb-admin-2.min.css'
import './bootstrap.bundle.min.js'
import './sb-admin-2.js'
import './jquery.easing.min.js'
import {createApp} from "vue/dist/vue.esm-bundler";
// import the root component App from a single-file component.
import AppComponent from './App.vue'
import router from './router/index'
import store from './store/index'
import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000/api/v1';
import mitt from 'mitt';
const emitter = mitt();



const app = createApp({
    components:{
        AppComponent,
    }
})
app.config.globalProperties.emitter = emitter;
app.use(router)
app.use(store)
app.mount('#app');
import 'bootstrap/dist/js/bootstrap.js'
