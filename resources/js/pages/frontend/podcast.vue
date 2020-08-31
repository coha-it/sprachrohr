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
        @click='clickedPlay(podcast)'
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
  h3 Schlagworte
  .ui.label(v-for="tag in podcast.tags")
    i.icon(v-if="tag.icon" class="tag.icon")
    | {{ tag.name }}
  br

  // Author
  h3 Author
  .ui.header.small(style="margin:0")
    i.user.circle.icon
    .content
      | {{ podcast.author.name }}
      .sub.header {{ podcast.author.title }}


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
    })
  },

  methods: {
    clickedPlay (podcast) {
      this.$set(this.$store.state, 'podcast', podcast)
    },

    getCurrentPodcastId () {
      return this.podcast?.id
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
