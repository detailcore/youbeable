<template>
  <header class="header">
    <router-link :to="{ name: 'home' }" class="logo" v-if="isMobile" title="Translation of popular issues from RuStackOverflow">
      <home-icon />
    </router-link>
    
    <router-link :to="{ name: 'home' }" class="logo" v-if="!isMobile" title="Translation of popular issues from RuStackOverflow">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="186" height="56" viewBox="0 0 186 56">
        <image id="logo" data-name="fyq" x="0" y="0" width="186" height="56" xlink:href="data:img/png;base64,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"/>
      </svg>
    </router-link>

    <div class="button-menu" @click="openMenu" v-if="isMobile">
      <menu-icon v-if="menuOpen" />
      <close-icon v-else />
    </div>    

    <search-region />

    <router-link :to="{ name: 'contact' }" v-if="!isMobile">Contacts</router-link>

  </header>
</template>

<script>
import { mapState, mapGetters } from 'vuex'
import SearchRegion from './SearchRegion.vue'
import HomeIcon from 'vue-material-design-icons/Home.vue';
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import CloseIcon from 'vue-material-design-icons/Close.vue';

export default {
  name: 'headerRegion',

  components: { SearchRegion, HomeIcon, MenuIcon, CloseIcon },
  
  computed: {
    ...mapState('mobi', { isMobile: 'item' }),
    ...mapGetters('mobi', { menuOpened: 'menuOpened' }),
  },

  data() {
    return {
      menuOpen: true,
    }
  },

  methods: {
    async openMenu() {
      await this.$store.dispatch('mobi/opened', this.menuOpen)
      .then(()=> {
        this.menuOpen = !this.menuOpen
      })
    }
  },
}
</script>

<style lang="scss">

</style>
