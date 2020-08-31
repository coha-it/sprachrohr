<template lang="pug">
sui-menu(is='sui-sidebar' :visible='visible' :dimmed='dimmed' animation='overlay' direction='right' vertical='')
  sui-menu-item(:link="true" @click="goTo({name: 'start'})")
    sui-icon(name='home')
    | Home
  template(v-if="user")
    sui-menu-item(:link="true" @click.prevent="logout")
      sui-icon(name='sign-out')
      | Logout
  template(v-else)
    sui-menu-item(:link="true" @click="goTo({name: 'login'})")
      sui-icon(name='sign-in')
      | Login
    sui-menu-item(:link="true" @click="goTo({name: 'register'})")
      sui-icon(name='sign-in')
      | Register
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  props: {
    visible: Boolean,
    dimmed: Boolean
  },

  data () {
    return {
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
      // Log out the user.
      await this.$store.dispatch('auth/logout')
      // Redirect to login.
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
