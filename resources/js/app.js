import './bootstrap';
import { createApp } from 'vue';
const app = createApp({});

import LoginComponent from './components/LoginComponent.vue';
import PerformanceComponent from './components/PerformanceComponent.vue';
app.component('performance-component',PerformanceComponent);
app.component('login-component', LoginComponent);
app.mount('#app');
