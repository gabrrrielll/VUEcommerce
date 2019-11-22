// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from "vue"
import App from "./App.vue"
import router from "./router"
import store from "./store"
import BootstrapVue from "bootstrap-vue"
import "bootstrap/dist/css/bootstrap.css"
import "bootstrap-vue/dist/bootstrap-vue.css"


import AllIosIcon from 'vue-ionicons/dist/ionicons-ios.js'
Vue.use(BootstrapVue)
require("vue-ionicons/ionicons.css")
Vue.use(AllIosIcon)


Vue.config.productionTip = false

document.addEventListener("DOMContentLoaded", () => {
  new Vue({
    el: "#app",
    router,
    store,
    components: {
      App
    },
    template: "<App/>"
  })
})
