<template lang="pug">
.ui.container.vertical.segment
  transition(name="fade")
    sui-message(
      v-if="status && form"
      :header="$t('Look in your Mails')"
      :form='form'
      :content="status"
      dismissable
    )

  form.ui.form.content(@submit.prevent='send' @keydown='form.onKeydown($event)')
    h1 {{ $t('verify_email') }}

    // Email
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

    // Submit Button
    sui-button(primary :loading='form.busy') {{ $t('send_verification_link') }}
</template>

<script>
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('verify_email') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  created () {
    if (this.$route.query.email) {
      this.form.email = this.$route.query.email
    }
  },

  methods: {
    async send () {
      const { data } = await this.form.post('/api/email/resend')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
