<template lang="pug">
.ui.cards
  .card(
    v-for='(podcast, podcast_key) in podcasts'
    :key='podcast_key'
  )
    .image
      img(:src='podcast.img_url')
    .content(style='padding: 1rem;')
      router-link.header(:to="podcastRoute(podcast)") {{ podcast.title }}
      .description(v-if="podcast.desc_short")
        p {{ podcast.desc_short }}
      .meta
        sui-button(primary @click="$router.push(podcastRoute(podcast))") Zum Podcast
        template(v-if="podcast.sources.length")
          sui-button(:disabled="getCurrentPodcastId() === podcast.id" icon @click='clickedPlay(podcast)')
            sui-icon(name='play')

      .extra(v-if="tags")
        .ui.label.tiny(
          v-for="(tag, tag_key) in tags"
          :key="tag_key"
        )
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
      return this.$store?.state?.podcast ?? null
    },
    tags () {
      return this.podcast?.tags ?? null
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
