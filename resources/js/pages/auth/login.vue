<template lang="pug">
.ui.container.vertical.segment
  form.ui.form.content(@submit.prevent='login', @keydown='form.onKeydown($event)' style="max-width: 500px")
    h1 {{ $t('login') }}

    // Email
    .field(:class="{'error': form.errors.has('email')}")
      label {{ $t('email') }}
      sui-input(
        v-model='form.email'
        :class="{ 'error': form.errors.has('email') }"
        :placeholder="$t('email')"
        type='email'
        name='email'
        :loading="loading"
      )
      has-error(:form='form', field='email')

    // Password
    .field(:class="{'error': form.errors.has('password')}")
      label {{ $t('password') }}
      sui-input(
        v-model='form.password'
        :class="{ 'error': form.errors.has('password') }"
        type='password'
        name='password'
        :placeholder='$t("password")'
      )
      has-error(:form='form', field='password')

    // Remember
    .field
      sui-checkbox(
        v-model='remember'
        :label="$t('remember_me')"
        name='remember'
      )

    // Login Button
    .field
      button.ui.button(type='submit' :loading='form.busy') {{ $t(&apos;login&apos;) }}

    // Login with Github
    .field
      login-with-github

    // Forgot PW
    .field
      router-link(:to="{ name: 'password.request' }")
        | {{ $t('forgot_password') }}
</template>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false,
    loading: null
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'start' })
    }
  }
}
</script>
