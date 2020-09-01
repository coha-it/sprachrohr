<template lang="pug">
sui-comment(v-if="comment")
  sui-comment-avatar(v-if="comment.user" :src="comment.user.photo_url")
  sui-comment-content
    a(is='sui-comment-author') {{ getCommentsUsername(comment) }}
    sui-comment-metadata
      div(v-if="comment.created_at") {{ $t('datetime', {date: getDate(comment.created_at), time: getTime(comment.created_at)}) }}
    sui-comment-text {{ comment.text }}
    sui-comment-actions(v-if="comment.seconds")
      sui-comment-action(@click="jumpToSeconds(comment)")
        | Bei {{ comment.seconds }} Sekunden
</template>

<script>
export default {
  props: {
    comment: {
      type: Object,
      required: true
    },
    podcast: {
      type: Object,
      required: true
    }
  },

  methods: {
    jumpToSeconds (comment) {
      if (
        comment?.seconds &&
        this.$store.state?.player?.media
      ) {
        // If Podcast isn't the same
        if (this.$store.state.player._podcast_id !== this.podcast.id) {
          this.$set(this.$store.state, 'podcast', this.podcast)
        }

        this.$store.state.player.media.currentTime = comment.seconds
      }
    },
    getCommentsUsername (comment) {
      if (comment?.user?.name) {
        return comment.user.name
      }
      return 'Anonymous'
    },

    getDate (d) {
      return this.$d(new Date(d), 'date_long')
    },

    getTime (d) {
      return this.$d(new Date(d), 'time')
    }

  }
}
</script>
