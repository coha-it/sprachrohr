<template lang="pug">
.ui.basic.segment
  h1 Podcasts
  PodcastList
</template>
<script>
import PodcastList from '~/components/Frontend/PodcastList'
export default {
  components: {
    PodcastList
  }
}
</script>
