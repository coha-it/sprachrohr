<template lang="pug">
// audio element
div(style="width: 100%")
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
      savingInterval: null
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
    }
  },

  watch: {
    '$store.state.podcast': {
      handler: function (o, n) {
        this.changeAudioSource()
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
    })
  },

  created () {
    setInterval(() => {
      this.saveTime()
    }, 2 * 1000)
  },

  methods: {
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
    },

    changeAudioSource () {
      // Define Source
      let source = this.podcast

      // Set Audio
      source.type = 'audio'

      // Change Source
      this.player.source = source
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
