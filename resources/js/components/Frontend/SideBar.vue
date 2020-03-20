<template>
  <sui-menu
    is="sui-sidebar"
    :visible="visible"
    :dimmed="dimmed"
    animation="overlay"
    direction="right"
    vertical
  >
    <sui-menu-item to="/"> <sui-icon name="home" /> Home </sui-menu-item>
    <sui-menu-item to="/"> <sui-icon name="gamepad" /> Games </sui-menu-item>
    <sui-menu-item to="/">
      <sui-icon name="camera" /> Channels
    </sui-menu-item>
  </sui-menu>
</template>

<script>
export default {
  data () {
    return {
    }
  },

  props: {
    visible: Boolean,
    dimmed: Boolean
  }
}
</script>
