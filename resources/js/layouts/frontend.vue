<template>
  <div class="main-layout ui pushable">
    <div class="pusher">
      <child />
    </div>
    <navbar />
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
