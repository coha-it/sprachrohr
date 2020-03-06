import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App/Frontend'

import '~/plugins'
import '~/components'

// Import Semantic-UI VueJS
import SuiVue from 'semantic-ui-vue'
Vue.use(SuiVue)

Vue.config.productionTip = false

// Custom VUE-STyle
Vue.component('v-style', {
  render: function (createElement) {
    return createElement('style', this.$slots.default)
  }
})

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  SuiVue,
  ...App
})
