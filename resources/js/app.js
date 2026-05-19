import './bootstrap';
import { createApp } from 'vue';

// Importando o seu componente
import LoginComponent from './components/Login.vue';

// Criando e montando a aplicação Vue
const app = createApp({});
app.component('login-component', LoginComponent);
app.mount('#app');