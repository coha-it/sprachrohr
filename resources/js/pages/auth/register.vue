<template lang="pug">
.ui.container.basic.segment
  div( style="max-width: 500px")
    h1 {{ $t('register') }}
    p
      | {{ $t('register_desc') }}
      br

    // Must Verify
    div(v-if='mustVerifyEmail') {{ $t('verify_email_address') }}

    // Verified
    div(v-else)
      form.ui.form(@submit.prevent='register' @keydown='form.onKeydown($event)')
        // Name
        .field(:class="{'error': form.errors.has('name')}")
          label {{ $t('name') }}
          sui-input(
            :class="{ 'error': form.errors.has('name') }"
            :placeholder="$t('name')"
            v-model='form.name'
            type='text'
            name='name'
          )
          has-error(:form='form', field='name')

        // E-Mail
        .field(:class="{'error': form.errors.has('email')}")
          label {{ $t('email') }}
          sui-input(
            v-model='form.email'
            :class="{ 'error': form.errors.has('email') }"
            :placeholder="$t('email')"
            type='email'
            name='email'
          )
          has-error(:form='form', field='email')

        // Password
        .field(:class="{'error': form.errors.has('password')}")
          label {{ $t('password') }}
          sui-input(
            v-model='form.password'
            :class="{ 'error': form.errors.has('password') }"
            :placeholder='$t("password")'
            type='password'
            name='password'
          )
          has-error(:form='form', field='password')

        // Password Confirmation
        .field(:class="{'error': form.errors.has('password_confirmation')}")
          label {{ $t('confirm_password') }}
          sui-input(
            v-model='form.password_confirmation'
            :class="{ 'error': form.errors.has('password_confirmation') }"
            :placeholder='$t("confirm_password")'
            type='password'
            name='password_confirmation'
          )
          has-error(:form='form', field='password_confirmation')

        // Login Button
        button.ui.button(type='submit' :loading='form.busy') {{ $t('register') }}

        // GitHub Register Button
        login-with-github

  br

  p {{ $t('login_alternative') }}&nbsp;
    router-link(:to="{name: 'login'}") {{ $t('login') }}

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
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
