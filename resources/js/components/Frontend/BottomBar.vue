<template>
  <sui-menu
    is="sui-sidebar"
    animation="overlay"
    direction="bottom"
    visible
    position="fixed"
  >

  <!-- audio element -->
  <vue-plyr>
    <audio>
      <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-14.mp3" type="audio/mp3"/>
      <source src="audio.ogg" type="audio/ogg"/>
    </audio>
  </vue-plyr>

    <sui-menu-item to="/">
      <sui-icon name="home" />
      Home
    </sui-menu-item>
    <sui-menu-item to="/">
      <sui-icon name="gamepad" />
      Games
    </sui-menu-item>
    <sui-menu-item to="/">
      <sui-icon name="camera" />
      Channels
    </sui-menu-item>
    <sui-menu-item to="/" @click="toggleSideBar()">
      <sui-icon name="settings" />
      Menu
    </sui-menu-item>
  </sui-menu>
</template>
<script>
export default {
  methods: {
    toggleSideBar () {
      this.$emit('event')
    }
  }
}
</script>
