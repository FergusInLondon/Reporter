import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import App from '~/components/App'

import '~/plugins'
import '~/components'
import '~/components/forms'

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  store,
  router,
  ...App
})
