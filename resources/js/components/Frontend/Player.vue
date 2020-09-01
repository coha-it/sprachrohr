<template lang="pug">
// audio element
div(style="width: 100%")

  // DEBUG
  .in-comments-wrapper(v-if="$store.state.podcast")
    .in-comments-inner
      .in-comment(
        v-for="comment in comments"
        :style="'left: ' + (comment.seconds / duration * 100).toFixed(2) + '%'"
      )
        .text.outer
          .text.inner {{ comment.text }}

  vue-plyr.podcast_player_wrapper(
    ref='plyr'
    :class="$store.state.podcast ? '' :'disabled'"
    style='width: 100%;'
  )
    audio
      // <source src="https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/cooking.mp3" type="audio/mp3">
</template>
<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Player',

  data () {
    return {
      savingInterval: null,
      duration: 0,
      activeComments: []
    }
  },

  computed: {
    ...mapGetters({
      podcasts: 'audio/podcasts',
      podcast: 'audio/podcast'
    }),
    player () {
      return this.$refs.plyr.player
    },
    podcast () {
      return this.$store.state.podcast
    },
    comments () {
      return this.$store.state.podcast.comments
    }
  },

  watch: {
    '$store.state.podcast': {
      handler: function (o, n) {
        // Set Player to State
        this.$set(this.$store.state, 'player', this.player)

        // Define Source
        let source = this.podcast

        // Set Audio
        source.type = 'audio'

        // Change Source
        this.player.source = source
      },
      deep: true
    }
  },

  mounted () {
    // this.player.config.iconUrl = 'test'
    this.player.config.autoplay = true
    this.player.config.loop = { active: true }

    // this.player.config.controls = ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen']
    // this.player.config.settings = ['captions', 'quality', 'speed', 'loop']

    // ON ready
    this.player.on('ready', event => {
      this.loadTime()

      setTimeout(() => {
        this.setDuration()
      }, 50)
    })

    this.player.on('timeupdate', event => {
      // const curr = this.player.media.currentTime
      // const comments = this.podcast.comments

      // If Duration isn't set
      if (this.duration <= 0) {
        this.setDuration()
      }
    })
  },

  created () {
    setInterval(() => {
      this.saveTime()
    }, 2 * 1000)
  },

  methods: {

    setDuration () {
      this.duration = this.player.duration
    },

    saveTime () {
      if (
        this.podcast &&
        this.player?.media?.currentTime > 0 &&
        this.isPlaying()
      ) {
        let id = this.podcast.id
        let data = {
          currentTime: this.player.media.currentTime,
          createdAt: Date.now()
        }

        this.setLocalStorage(id, data)
      }
    },
    loadTime () {
      if (this.podcast) {
        // Look for old Data
        let oldInstance = this.getLocalStorage(this.podcast.id)

        // Old Data Found
        if (oldInstance) {
          let time = oldInstance.currentTime
          this.player.media.currentTime = time
        }
      }
    },

    storageAlias (id) {
      return '__podcast-' + id
    },

    getLocalStorage (id) {
      let oOld = localStorage[this.storageAlias(id)]

      if (oOld) {
        return JSON.parse(oOld)
      } else {
        return false
      }
    },

    setLocalStorage (id, data) {
      localStorage.setItem(
        this.storageAlias(id),
        JSON.stringify(data)
      )
    },

    isPlaying () {
      return this.player?.playing
    }

  }
}
</script>

<style lang="scss" scoped>
.podcast_player_wrapper {
  &.disabled {
    pointer-events: none;
    opacity: .5;
  }
}
</style>
