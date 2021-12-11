import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import axios from "axios";
import VueAxios from "vue-axios";

Vue.use(VueAxios, axios);

// custom axios instance untuk automasi base url kedepannya
const axiosCustomInstance = axios.create({
  baseURL: process.env.VUE_APP_HOST_BACKEND,
});

Vue.prototype.$axios = axiosCustomInstance;
Vue.prototype.$axios.interceptors.response.use(
  function (response) {
    return response;
  },
  function (error) {
    // console.error(error.response.data);
    return Promise.reject(error.response.data);
  }
);

Vue.config.productionTip = false;

new Vue({
  router,
  render: (h) => h(App),
}).$mount("#app");
