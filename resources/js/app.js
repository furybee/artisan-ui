import axios from "axios";
import Base from "./base";
import moment from "moment-timezone";
import Routes from "./routes";
import Vue from "vue";
import VueJsonPretty from "vue-json-pretty";
import VueRouter from "vue-router";

const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  axios.defaults.headers.common["X-CSRF-TOKEN"] = token.content;
}

Vue.use(VueRouter);

moment.tz.setDefault("utc");

const router = new VueRouter({
  routes: Routes,
  mode: "history",
  base: "/artisan-ui",
});

router.beforeEach((to, from, next) => {
  to.meta.title = to.meta.createTitle(to.params);

  document.title = "Artisan UI - " + to.meta.title;

  next();
});

/**
Vue.component(
  "icon-information-circle",
  require("./components/icons/InformationCircle.vue").default
); 
*/

Vue.mixin(Base);

new Vue({
  el: "#artisan-ui",
  router,
});
