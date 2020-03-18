<template>
  <!-- audio element -->
  <vue-plyr v-show="$store.state.song" ref="plyr">
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
      songs: 'music/songs'
    }),
    player () {
      return this.$refs.plyr.player
    },
    song () {
      return this.$store.state.song
    }
  },

  mounted () {
    // this.player.config.iconUrl = 'test'
    this.player.config.autoplay = true

    setInterval(() => {
      if (this.song) {
        this.saveTime()
      }
    }, 5 * 1000)
  },

  methods: {
    saveTime () {
      let id = this.song.id
      let time = this.player.media.currentTime
      let storage = localStorage

      storage['song-' + id] = JSON.stringify({
        currentTime: time
      })
    },
    isPlaying () {
      return this.player && this.player.playing
    },
    changeSong (song) {
      // Change Source
      this.player.source = song

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
    '$store.state.song': {
      handler: function (o, n) {
        this.changeSong(this.$store.state.song)
      },
      deep: true
    }
  },
}
</script>
