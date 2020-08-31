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
    sui-menu-item(:link="true" @click="goTo({name: 'start'})")
      sui-icon(name='home')
      | Home
    template(v-if="user")
      sui-menu-item(:link="true" @click="bLogout = !bLogout")
        sui-icon(name='sign-out')
        | Logout
    template(v-else)
      sui-menu-item(:link="true" @click="goTo({name: 'login'})")
        sui-icon(name='sign-in')
        | Login
      sui-menu-item(:link="true" @click="goTo({name: 'register'})")
        sui-icon(name='sign-in')
        | Register
    div(style="flex:1")
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
      bLogout: false
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
