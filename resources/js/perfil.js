import { createApp } from 'vue';
import { createPinia } from "pinia";
import Perfil from '../js/components/Perfil.vue';

const app = createApp(Perfil);
const pinia = createPinia();

app.use(pinia);
app.mount('#app');

