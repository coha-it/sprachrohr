<template lang="pug">
.ui.basic.segment(v-if="podcast")
  h1 {{ podcast.title }}
  div {{ podcast.desc_long }}
  template(v-if='false && getCurrentPodcastId() === podcast.id')
    sui-button(primary disabled active readonly)
      | Wird abgespielt
  template(v-else='')
    sui-button(primary @click='clickedPlay(podcast)' :class="{'loading' : loading}")
      | Anh&ouml;ren
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
  }

}
</script>
