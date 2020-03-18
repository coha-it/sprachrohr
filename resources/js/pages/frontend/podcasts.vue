<template>
  <div class="ui basic segment">
    <h1>Podcasts</h1>
    <div v-for="(podcast, i) in podcasts" :key="i" class="ui card" style="max-width: 100%; min-width: 100%;">
      <div class="content" style="padding: 0;">
        <div class="ui items">
          <div class="item">
            <div class="ui medium image">
              <img :src="podcast.image">
            </div>
            <div class="content" style="padding: 1rem;">
              <a class="header">
                {{ podcast.title }}
              </a>
              <div class="meta">
                <span class="cinema">Union Square 14</span><br>
                <template v-if="getCurrentPodcastId() === podcast.id">
                  <sui-button primary disabled active readonly>
                    Wird abgespielt
                  </sui-button>
                </template>
                <template v-else>
                  <sui-button primary @click="clickedPlay(podcast)">
                    Anhören
                  </sui-button>
                </template>
              </div>
              <div class="description">
                <p></p>
              </div>
              <div class="extra">
                <div class="ui label">IMAX</div>
                <div class="ui label"><i class="globe icon"></i> Additional Languages</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from 'vuex'
import axios from 'axios'

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
      this.$set(
        this.$store.state,
        'podcast',
        podcast
      )
    },

    getCurrentPodcastId () {
      return this.podcast ? this.podcast.id : 0
    }
  },

  data () {
    return {
    }
  }
}
</script>
