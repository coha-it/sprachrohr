<template lang="pug">
.ui.basic.segment
  .ui.breadcrumb(v-if="podcast")
    router-link(:to="{name: 'podcasts'}").section Podcasts
    i.right.angle.icon.divider
    div.active.section {{ podcast.title }}

  // loading
  template(v-if="loading")
    .ui.placeholder
      .paragraph
        .line
        .line
        .line
        .line
        .line
    .ui.active.inverted.dimmer
      .ui.loader

  // Not Loading
  template(v-else-if="podcast")
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
      i.icon(v-if="tag.icon" :class="tag.icon")
      | {{ tag.name }}
    br
    // Author
    h3 {{ $t('author') }}
    .ui.header.small(style="margin:0")
      i.user.circle.icon
      .content
        | {{ podcast.author.name }}
        .sub.header {{ podcast.author.title }}
    // Comments
    br
    Comments(:podcast="podcast")
    // Comment-Form
    br
    CommentForm(v-if="commentable" :podcast="podcast")

</template>
<script>
import { mapGetters } from 'vuex'
import Comments from '~/components/Frontend/Comments'
import CommentForm from '~/components/Frontend/CommentForm'

export default {

  components: {
    Comments,
    CommentForm
  },

  data () {
    return {
      loading: false,
      commentable: true
    }
  },

  computed: mapGetters({
    podcast: 'audio/podcast'
  }),

  mounted () {},

  metaInfo () {
    return { title: this.podcast?.title }
  },

  created: function () {
    this.loading = true
    this.$store.dispatch('audio/fetchPodcast', this.$route.params.id).then(() => {
      this.loading = false
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
    }

    // checkCommentabilty () {
    //   const podcast = this.$store?.state?.podcast ? this.$store.state.podcast : false
    //   const player = this.$store?.state?.player ? this.$store.state.player : false

    //   this.commentable = podcast && player && podcast.id === player._podcast_id
    // }

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
