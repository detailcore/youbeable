<template>
  <div id="app" :class="{ mobile: isMobile }">
    <header-region />

    <main class="main">
      <menu-region v-if="menu" />
      <article class="main__block">
        <router-view class="main__content"></router-view>
        <tags-popular-day v-if="!isMobile" />
      </article>
    </main>

    <footer-region />
  </div>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import MenuRegion from '@/components/MenuRegion.vue'
import HeaderRegion from '@/components/HeaderRegion.vue'
import FooterRegion from '@/components/FooterRegion.vue'
import TagsPopularDay from './components/TagsPopularDay.vue'

export default {
  name: 'App',
  components: {
    MenuRegion,
    HeaderRegion,
    FooterRegion,
    TagsPopularDay,
  },
  computed: {
    ...mapState('mobi', { isMobile: 'item' }),
    ...mapGetters('mobi', { menuOpened: 'menuOpened' }),
    menu() {
      if(!this.isMobile) return true
      return this.menuOpened
    },
  },

}
</script>