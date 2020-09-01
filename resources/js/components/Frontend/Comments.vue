<template lang="pug">
div
  // Comments
  template(v-if="podcast.comments.length")
    h3 {{ $t('comments') }}
    p Verfasse auch einen Kommentar:&nbsp;
      a(href="#add-comment") Hier klicken
    sui-comment-group(threaded)
      // Comment
      Comment(
        v-if="i <= comments.max || comments.show_all"
        v-for="(comment, i) in podcast.comments"
        :key="comment.id"
        :comment="comment"
      )
      br

      // Hide comments Button
      //- sui-button(v-if="comments.show_all" content="Kommentare verstecken" size="small" @click="comments.show_all = false")
      // Show all Button
      sui-button(
        v-if="!comments.show_all && podcast.comments.length > comments.max"
        content="Zeige alle Kommentare"
        icon="comment"
        size="small"
        @click="comments.show_all = true"
      )
  // No Comments yet
  template(v-else)
    h3 no comments yet

</template>

<script>
import Comment from '~/components/Frontend/Comment'
// import axios from 'axios'

export default {

  components: {
    Comment
  },

  props: {
    podcast: {
      type: Object,
      required: true
    }
  },

  data () {
    return {
      // Comments
      comments: {
        max: 5,
        show_all: false
      }
    }
  }
}
</script>
