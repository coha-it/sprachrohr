<template>
  <div class="ui basic segment">
    <h1>Podcasts</h1>
    <PodcastList />
  </div>
</template>
<script>
import PodcastList from '~/components/Frontend/PodcastList'

export default {

  components: {
    PodcastList
  },

  data () {
    return {
    }
  }
}
</script>
