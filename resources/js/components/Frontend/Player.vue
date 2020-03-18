<template>
  <!-- audio element -->
  <vue-plyr
    ref="plyr"
    class="podcast_player_wrapper"
    :class="$store.state.podcast ? '' :'disabled'"
    style="width: 100%;"
  >
    <audio>
      <!-- <source src="https://corporatehappiness.s3.eu-central-1.amazonaws.com/testing/music/cooking.mp3" type="audio/mp3"> -->
    </audio>
  </vue-plyr>
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
      podcasts: 'audio/podcasts'
    }),
    player () {
      return this.$refs.plyr.player
    },
    podcast () {
      return this.$store.state.podcast
    }
  },

  mounted () {
    // this.player.config.iconUrl = 'test'
    this.player.config.autoplay = true

    // ON ready
    this.player.on('ready', event => {
      if (this.podcast) {
        // Look for old Data
        let oldInstance = this.getLocalStorage(this.podcast.id)

        // Old Data Found
        if (oldInstance) {
          let time = oldInstance.currentTime
          this.player.media.currentTime = time
        }
      }
    })

    setInterval(() => {
      this.saveTime()
    }, 5 * 1000)
  },

  methods: {
    saveTime () {
      if (
        this.podcast &&
        this.player &&
        this.player.media &&
        this.player.media.currentTime > 0
      ) {
        let id = this.podcast.id
        let time = this.player.media.currentTime

        this.setLocalStorage(id, time)
      }
    },
    storageAlias (id) {
      return '__podcast-' + id
    },
    getLocalStorage (id) {
      let oOld = localStorage[this.storageAlias(id)]

      if (oOld) {
        let jOld = JSON.parse(oOld)
        return jOld
      }
      return false
    },
    setLocalStorage (id, time) {
      localStorage[this.storageAlias(id)] = JSON.stringify({
        currentTime: time
      })
    },
    isPlaying () {
      return this.player && this.player.playing
    },
    changePodcast (podcast) {
      // Change Source
      this.player.source = podcast

      // Keep Playing
      // this.player.config.autoplay = this.player.playing
      // this.player.config.autoplay = true

      /*
      this.player.config.title = 'JA'
      this.player.config.controls = ['play-large', 'title', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen']
      this.player.config.settings = ['captions', 'quality', 'speed', 'loop']
      */
    }
  },

  watch: {
    '$store.state.podcast': {
      handler: function (o, n) {
        this.changePodcast(this.$store.state.podcast)
      },
      deep: true
    }
  },
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
