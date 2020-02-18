/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import App from './App'
import store from './store'
import router from './router'
import CoreuiVue from '@coreui/vue'
import { iconsSet as icons } from '../icons/icons'
 
import '@progress/kendo-ui'
import '@progress/kendo-theme-default/dist/all.css'
import { Grid, GridInstaller } from '@progress/kendo-grid-vue-wrapper'
import { DataSourceInstaller } from '@progress/kendo-datasource-vue-wrapper'

import ElementUI from 'element-ui'
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';

Vue.config.performance = true
Vue.use(CoreuiVue)
Vue.use(GridInstaller)
Vue.use(DataSourceInstaller)
Vue.use(ElementUI, { locale })


new Vue({
  el: '#app',
  router,
  icons,
  store,
  template: '<App/>',
  components: {
    App,Grid
  },
})
