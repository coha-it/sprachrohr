<template>
  <div class="ui basic segment">
    <div v-for="(song, i) in songs" :key="i" class="ui card" style="max-width: 100%; min-width: 100%;">
      <div class="content" style="padding: 0;">
        <div class="ui items">
          <div class="item">
            <div class="ui medium image">
              <img :src="song.image">
            </div>
            <div class="content" style="padding: 1rem;">
              <a class="header">
                {{ song.title }}
              </a>
              <div class="meta">
                <span class="cinema">Union Square 14</span><br>
                <sui-button primary @click="clickedPlay(song)">
                  Anhören
                </sui-button>
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
      songs: 'music/songs'
    })
  },

  created: function () {
    this.$store.dispatch('music/fetchSongs')
  },

  methods: {
    clickedPlay (song) {
      // this.$root.$data.song = song
      this.$set(
        this.$store.state,
        'song',
        song
      )
    }
  },

  data () {
    return {
    }
  }
}
</script>
