<template lang="pug">
#add-comment

  // Success Msg
  sui-message(
    v-if="comment.success"
    positive
    dismissable
    visible
    header="Comment sent"
    content="After verification your comment will be visible"
    @dismiss="comment.success = false"
  )

  // Show Comment-Form
  sui-button(
    v-if="!comment.show_form"
    size="tiny"
    content="Kommentar hinzufügen"
    primary
    @click="user ? comment.show_form = true : $router.push({name: 'login'})"
  )

  // Comment-Form
  sui-form.ui.form.content(
    v-else
    @submit.prevent='trySendComment'
    style="max-width: 500px"
    :loading="loading"
  )
    sui-form-field
      label {{ $t('comment') }}
      textarea(v-model="comment.form.text" rows='2' placeholder="Ihr Kommentar ..." autofocus :disabled="loading")
    sui-form-field
      sui-checkbox(v-model="comment.form.public_name" label='Namen des Authors anzeigen' :disabled="loading")
    sui-form-field
      sui-checkbox(v-model="comment.form.with_seconds" :label="'Mit Zeitstempel am Podcast' " :disabled="loading")

    // Error Msg
    sui-message(
      v-if="comment.error"
      negative
      dismissable
      visible
      header="Error"
      :content="comment.error"
      @dismiss="comment.error = false"
    )

    sui-button(
      primary
      content='Kommentar veröffentlichen'
      label-position='left'
      icon='edit'
      :disabled="!comment.form.text"
      :loading="loading"
    )
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios'

export default {

  props: {
    podcast: {
      type: Object,
      required: true
    }
  },

  data () {
    return {

      // Loading
      loading: false,

      // Comment Data
      comment: {
        show_form: false,
        form: {
          public_name: true,
          with_seconds: true,
          seconds: null,
          text: ''
        },
        success: false,
        error: false
      }
    }
  },

  computed: mapGetters({
    user: 'auth/user'
  }),

  mounted () {},

  methods: {
    getSeconds () {
      // const curr = this.player.media.currentTime
      const player = this.$store.state.player

      if (player?.media?.currentTime) {
        return parseInt(player.media.currentTime)
      }
      return null
    },

    trySendComment (event) {
      let form = this.comment.form
      let seconds = this.getSeconds()

      // If With Seconds set and current Seconds exist
      if (
        form.with_seconds &&
        seconds &&
        // eslint-disable-next-line camelcase
        this.$store?.state?.player?._podcast_id &&
        this.podcast?.id &&
        this.$store.state.player._podcast_id === this.podcast.id
      ) {
        form.seconds = seconds
      } else {
        form.seconds = null
      }

      this.sendComment(form)
    },

    sendComment (form) {
      this.loading = true
      this.comment.error = false
      this.comment.success = false

      axios
        .post('/api/podcast/' + this.podcast.id + '/create-comment', form)
        .then((res) => {
          console.log(res)
          this.comment.success = true
          this.comment.form.text = ''
          this.comment.show_form = ''
        })
        .catch((err) => {
          console.log('err', err)
          this.comment.error = err
        })
        .then(() => {
          this.loading = false
        })
    }
  }
}
</script>
