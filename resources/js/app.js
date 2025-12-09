// resources/js/app.js
import './bootstrap';
import { createApp } from 'vue';
import RequestTable from './components/RequestTable.vue';

const app = createApp({});
app.component('request-table', RequestTable);
app.mount('#app');
