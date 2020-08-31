<template lang="pug">
.ui.cards
  .card(v-for='(podcast, i) in podcasts' :key='i')
    .image
      img(:src='podcast.image')
    .content(style='padding: 1rem;')
      router-link.header(:to="{name: 'podcast', params: {id: podcast.id}}")
        | {{ podcast.title }}
      .meta
        p.desc.short
          | {{ podcast.desc_short }}
        template(v-if="podcast.sources.length")
          template(v-if='getCurrentPodcastId() === podcast.id')
            sui-button(primary='' disabled='' active='' readonly='')
              | Wird abgespielt
          template(v-else='')
            sui-button(primary='' @click='clickedPlay(podcast)')
              | Anh&ouml;ren
      .description
        p
      .extra
        .ui.label IMAX
        .ui.label
          i.globe.icon
          | Additional Languages
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
    }
  }

}
</script>
