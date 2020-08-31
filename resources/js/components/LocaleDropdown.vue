<template lang="pug">
// {{ locales[locale] }}
div
  i.flag.pointer(
    v-for='(value, key) in locales'
    :key='key'
    :class="getFlag(value) + ' ' + (locales[locale] == value ? 'active' : 'half-opacity')"
    @click.prevent='setLocale(key)'
  )
</template>

<script>
import { mapGetters } from 'vuex'
import { loadMessages } from '~/plugins/i18n'

export default {
  computed: mapGetters({
    locale: 'lang/locale',
    locales: 'lang/locales'
  }),

  methods: {
    setLocale (locale) {
      if (this.$i18n.locale !== locale) {
        loadMessages(locale)

        this.$store.dispatch('lang/setLocale', { locale })
      }
    },
    getFlag (loc) {
      let l = loc.toLowerCase()
      switch (l) {
        case 'en':
          return 'us'

        case '中文':
          return 'cn'

        default:
          return l
      }
    }
  }
}
</script>
