<template lang="pug">
div
  sui-menu(
    is='sui-sidebar'
    :visible='visible'
    :dimmed='dimmed'
    animation='overlay'
    direction='right'
    vertical=''
    style="display: flex;padding-bottom: 50px;"
  )
    // Navigation
    sui-menu-item(
      v-if="nav.all || user && nav.user || !user && nav.guest"
      v-for="nav in navs"
      :link="true"
      @click="nav.click"
    )
      sui-icon(:name='nav.icon')
      | {{ $t(nav.text) }}

    // Spacer
    div(style="flex:1")

    // Locales
    sui-menu-item
      LocaleDropdown

  sui-modal(basic v-model='bLogout')
    .ui.icon.header
      i.sign-out.icon
      | {{ $t('logout.title') }}
    .content.text-center
      p.text-center {{ $t('logout.desc') }}
    .actions
      button.ui.basic.inverted.button(@click="bLogout = false") {{ $t('back') }}
      button.ui.orange.inverted.button(@click="logout")
        i.sign-out.icon
        | {{ $t('logout.btn') }}

</template>

<script>
import { mapGetters } from 'vuex'
import LocaleDropdown from '~/components/LocaleDropdown'

export default {

  components: {
    LocaleDropdown
  },

  props: {
    visible: Boolean,
    dimmed: Boolean
  },

  data () {
    return {
      bLogout: false,
      navs: [
        {
          text: 'Home',
          icon: 'home',
          all: true,
          click: () => { this.goTo({ name: 'start' }) }
        },
        {
          text: 'Logout',
          icon: 'sign-out',
          user: true,
          click: () => { this.bLogout = !this.bLogout }
        },
        {
          text: 'Login',
          icon: 'sign-in',
          guest: true,
          click: () => { this.goTo({ name: 'login' }) }
        },
        {
          text: 'Register',
          icon: 'sign-in',
          guest: true,
          click: () => { this.goTo({ name: 'register' }) }
        }
      ]
    }
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  methods: {
    goTo (vars) {
      this.$router.push(vars)
    },
    async logout () {
      this.bLogout = false
      // Log out the user.
      await this.$store.dispatch('auth/logout')
      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
