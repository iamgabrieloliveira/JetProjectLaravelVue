import { createApp } from 'vue'
import App from './App.vue'
import router from "./routes";
import axios from 'axios';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap';

const app = createApp(App);
app.use(router);
app.mount('#app');

