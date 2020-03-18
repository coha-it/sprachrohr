<template>
  <div>
    <sui-sidebar-pushable>
      <sui-sidebar-pusher
        class="ui full height"
        :class="isSideBarVisible() ? 'pushed' : 'unpushed'"
        :dimmed="isDimmed()"
        @click="(isSideBarVisible()) ? toggleSideBar() : null"
      >
        <child @event="clickedPlay" />
      </sui-sidebar-pusher>
    </sui-sidebar-pushable>
    <MenuButton @event="toggleSideBar" />
    <SideBar :visible="isSideBarVisible()" />
    <BottomBar />
  </div>
</template>

<script>
import SideBar from '~/components/Frontend/SideBar'
import BottomBar from '~/components/Frontend/BottomBar'
import MenuButton from '~/components/Frontend/MenuButton'

export default {
  name: 'FrontendLayout',

  components: {
    SideBar,
    BottomBar,
    MenuButton
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
    clickedPlay: function () {
      console.log('joghurtmann von parent')
    },
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
