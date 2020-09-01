import Vue from 'vue'
import store from '~/store'
import VueI18n from 'vue-i18n'

const dateTimeFormats = {
  'de': {
    date_long: {
      weekday: 'long', day: 'numeric', month: 'numeric', year: 'numeric'
    },
    time: {
      hour: 'numeric', minute: 'numeric', hours24: true
    }
  },
  'en': {
    date_short: {
      year: 'numeric', month: 'short', day: 'numeric'
    },
    date_long: {
      weekday: 'short', year: 'numeric', month: 'short', day: 'numeric'
    },
    time: {
      hour: 'numeric', minute: 'numeric', hours24: true
    }
  }
}

Vue.use(VueI18n)

const i18n = new VueI18n({
  locale: 'en',
  messages: {},
  dateTimeFormats
})

/**
 * @param {String} locale
 */
export async function loadMessages (locale) {
  if (Object.keys(i18n.getLocaleMessage(locale)).length === 0) {
    const messages = await import(/* webpackChunkName: '' */ `~/lang/${locale}`)
    i18n.setLocaleMessage(locale, messages)
  }

  if (i18n.locale !== locale) {
    i18n.locale = locale
  }
}

;(async function () {
  await loadMessages(store.getters['lang/locale'])
})()

export default i18n
