<template>
  <sui-menu
    is="sui-sidebar"
    animation="overlay"
    direction="bottom"
    visible
    position="fixed"
  >
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
