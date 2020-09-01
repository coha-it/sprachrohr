<template lang="pug">
.ui.basic.segment(v-if="podcast")

  .ui.breadcrumb
    router-link(:to="{name: 'podcasts'}").section Podcasts
    i.right.angle.icon.divider
    div.active.section {{ podcast.title }}

  // Title
  h1 {{ podcast.title }}

  // Playbutton
  template(v-if="podcast.sources.length")
    template(v-if='false && getCurrentPodcastId() === podcast.id')
      sui-button(primary disabled active readonly)
        | Wird abgespielt
    template(v-else='')
      sui-button(
        primary
        :class="{'loading' : loading}"
        @click='startPlay(podcast)'
        icon="play"
      )
        | Anh&ouml;ren
    //- button(@click="debug") Debug
  br
  br

  // Long Description
  div(v-html="podcast.desc_long")

  br

  // Tags
  h3 {{ $t('tags') }}
  .ui.label(v-for="tag in podcast.tags")
    i.icon(v-if="tag.icon" class="tag.icon")
    | {{ tag.name }}
  br

  // Author
  h3 {{ $t('author') }}
  .ui.header.small(style="margin:0")
    i.user.circle.icon
    .content
      | {{ podcast.author.name }}
      .sub.header {{ podcast.author.title }}

  // Kommentare
  template(v-if="podcast.comments.length")
    h3 {{ $t('comments') }}

    sui-comment-group(threaded)
      sui-comment(v-for="comment in podcast.comments")
        sui-comment-avatar(v-if="comment.user" :src="comment.user.photo_url")
        sui-comment-content
          a(is='sui-comment-author') {{ comment.user.name }}
          sui-comment-metadata
            div Today at {{ comment.created_at }}
          sui-comment-text {{ comment.text }}
          sui-comment-actions
            sui-comment-action(@click="jumpToSeconds(comment)")
              | Bei {{ comment.seconds }} Sekunden

  template(v-else)
    h3 no comments yet

  // Kommentar Hinzufügen
  form
    sui-button(content='Kommentar Verfassen' label-position='left' icon='edit')

</template>
<script>
import { mapGetters } from 'vuex'

export default {

  data () {
    return {
      loading: null
    }
  },

  computed: mapGetters({
    podcast: 'audio/podcast'
  }),

  metaInfo () {
    return { title: this.podcast?.title }
  },

  created: function () {
    this.loading = true
    this.$store.dispatch('audio/fetchPodcast', this.$route.params.id).then(() => {
      this.loading = false

      // if (typeof this.$store.state.player === 'undefined') {
      //   this.setPodcast(this.podcast)
      // }
    })
  },

  methods: {
    setPodcast (podcast) {
      this.$set(this.$store.state, 'podcast', podcast)
    },

    startPlay (podcast) {
      this.setPodcast(podcast)

      // Start Playing
      if (this.$store.state.player?.play) {
        this.$store.state.player.play()
      }
    },

    getCurrentPodcastId () {
      return this.podcast?.id
    },

    jumpToSeconds (comment) {
      if (
        this.$store.state?.player?.media &&
        comment?.seconds
      ) {
        this.$store.state.player.media.currentTime = comment.seconds
      }
    }

    // debug () {
    //   console.log(
    //     this.$store.state.player.media.paused
    //   )

    //   console.log(
    //     this.$store.state.player.media.currentTime
    //   )
    // }
  }

  // watch: {
  //   '$store.state.player.media.paused': {
  //     handler () {
  //       console.log('jo')
  //     },
  //     deep: true
  //   }
  // }

}
</script>
