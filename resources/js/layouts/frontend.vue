<template>
  <div>
    <sui-sidebar-pushable>
      <SideBar :visible="isSideBarVisible()" />
      <sui-sidebar-pusher class="ui full height" :dimmed="isDimmed()" >
        <child />
      </sui-sidebar-pusher>
      <BottomBar @event="toggleSideBar" />
    </sui-sidebar-pushable>
  </div>
</template>

<script>
import SideBar from '~/components/Frontend/SideBar'
import BottomBar from '~/components/Frontend/BottomBar'

export default {
  name: 'FrontendLayout',

  components: {
    SideBar,
    BottomBar
  },

  data () {
    return {
      visible: false,
      window: {
        width: 0,
        height: 0,
        iMobileWidth: 770
      }
    }
  },

  created () {
    window.addEventListener('resize', this.handleResize)
    this.handleResize()
  },

  destroyed () {
    window.removeEventListener('resize', this.handleResize)
  },

  methods: {
    isSideBarVisible: function () {
      return this.window.width >= this.window.iMobileWidth || this.visible
    },
    isDimmed: function () {
      return this.isSideBarVisible() && this.window.width < this.window.iMobileWidth
    },
    toggleSideBar: function () {
      this.visible = !this.visible
    },
    handleResize () {
      this.window.width = window.innerWidth
      this.window.height = window.innerHeight
    }
  }
}
</script>
