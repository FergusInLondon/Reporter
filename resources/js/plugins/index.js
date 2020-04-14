import './axios'
import './fontawesome'
import 'bootstrap'

import Vue from 'vue'
import VueTimeago from 'vue-timeago'
import ElementUI from 'element-ui'

// ! @todo - only import the required ones!
Vue.use(ElementUI)

Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'en' // Default locale
})