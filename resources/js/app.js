require("./bootstrap");

/* window.Vue = require("vue");
Vue.component("hello", require("./components/Hello.vue").default);
new Vue({
    el: "#app"
}); */
import Vue from "vue";
import App from "./App.vue";

new Vue({
    render: h => h(App)
}).$mount("#app");
