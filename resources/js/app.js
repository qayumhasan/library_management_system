import './bootstrap';

import { createApp } from 'vue'
import store from '@/store';
import '@/services/auth/authService.js';
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import AppComponent from './views/AppComponent.vue'
import ModalComponent from "@/components/CustomModal.vue";
import router from './router/index.js';


const app = createApp({});
app.use(router);
app.component('App', AppComponent);
app.component('Modal', ModalComponent);
app.use(ElementPlus)
app.use(store);
app.mount('#app')
