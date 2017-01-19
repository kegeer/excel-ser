// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import Root from './Root'
import router from './router'
import store from './store'
import { sync } from 'vuex-router-sync'
import TableReader from './components/general/TableReader'
import Pagination from './components/general/Pagination'
import eventBus from './plugins/eventBus'
import http from './plugins/http'

Vue.use(eventBus)
Vue.use(http, { store, router })

Vue.component('tableReader', TableReader)
Vue.component('pagination', Pagination)
require('./includes')
sync(store, router)
/* eslint-disable no-new */
new Vue({
  store,
  router,
  el: '#app',
  render: h => h(Root)
})
