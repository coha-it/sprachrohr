<template>
  <div class="main-layout">
    <div class="ui bottom attached segment pushable">
      <div class="pusher">
        <child />
      </div>
      <navbar />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Frontend/Navbar'

export default {
  name: 'FrontendLayout',

  components: {
    Navbar
  }
}
</script>
