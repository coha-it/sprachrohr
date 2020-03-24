<template>
  <div class="ui mobile only grid">
    <div class="lnr menu coha_menu" @click="toggleSideBar()" />
  </div>
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
<style lang="scss" scoped>
.coha_menu {
    position: fixed;
    z-index: 1;
    cursor: pointer;
    font-size: 2em;
    color: #bcbec0;
    top: 0;
    right: 0;
    padding: .5rem 1rem;
    mix-blend-mode: darken;
    backdrop-filter: blur(1px);
}
</style>
