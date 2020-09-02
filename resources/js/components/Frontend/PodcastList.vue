<template lang="pug">
.ui.cards
  .card(v-for='(podcast, i) in podcasts' :key='i')
    .image
      img(:src='podcast.image')
    .content(style='padding: 1rem;')
      router-link.header(:to="podcastRoute(podcast)")
        | {{ podcast.title }}
      .meta
        p.desc.short
          | {{ podcast.desc_short }}
        // Visit Podcast button
        sui-button(primary @click="$router.push(podcastRoute(podcast))") Zum Podcast
        // Play Instant Button
        template(v-if="podcast.sources.length")
          template(v-if='getCurrentPodcastId() === podcast.id')
            sui-button(disabled active readonly) Wird abgespielt
          template(v-else)
            sui-button(@click='clickedPlay(podcast)') Anh&ouml;ren
      .description
        p
      .extra
        .ui.label.tiny(v-for="tag in podcast.tags")
          i.icon(v-if="tag.icon" :class="tag.icon")
          | {{ tag.name }}
</template>
<script>
import { mapGetters } from 'vuex'

export default {

  computed: {
    ...mapGetters({
      podcasts: 'audio/podcasts'
    }),
    podcast () {
      return this.$store && this.$store.state ? this.$store.state.podcast : null
    }
  },

  created: function () {
    this.$store.dispatch('audio/fetchPodcasts')
  },

  methods: {
    clickedPlay (podcast) {
      // this.$root.$data.podcast = podcast
      this.$set(this.$store.state, 'podcast', podcast)
    },

    getCurrentPodcastId () {
      return this.podcast ? this.podcast.id : 0
    },

    podcastRoute (podcast) {
      return {
        name: 'podcast', params: { id: podcast.id }
      }
    }
  }

}
</script>
