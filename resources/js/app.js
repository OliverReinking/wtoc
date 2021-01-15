require('./bootstrap');
import Vue from 'vue';
// Views
import AppHomepage from "@/js/Pages/Homepage/Views/Home.vue";
const app = new Vue({
    el: "#app",
    render: h => h(AppHomepage)
});
export default app;
