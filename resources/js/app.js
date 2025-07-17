import { createApp } from 'vue';
import {createPinia} from "pinia";
import Inicio from '../js/components/Inicio.vue';

const app = createApp(Inicio);
const pinia = createPinia();

app.use(pinia);
app.mount('#app');

