import { createApp } from 'vue';
import { createPinia } from "pinia";
import Logado from "../js/components/Logado.vue";

const app = createApp(Logado);
const pinia = createPinia();

app.use(pinia);
app.mount('#Logado');
