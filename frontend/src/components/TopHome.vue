<template>
  <div class="top__home">
    <div class="top__home__pop">
      <h2>Popular questions</h2>
      <ul v-if="top.length > 0">
        <li v-for="item in top" :key="item.id">
          <router-link :to="{ name: 'question', params: { alias: item.id } }"> {{ item.title }} </router-link>
        </li>
      </ul>
      <spinner v-else />
      <router-link class="more" :to="{ name: 'top', query: { sort: 'toptop' } }"> More popular questions... </router-link>
    </div>
    <div class="top__home__new">
      <h2>New questions</h2>
      <ul v-if="newTop.length > 0">
        <li v-for="item in newTop" :key="item.id">
          <router-link :to="{ name: 'question', params: { alias: item.id } }"> {{ item.title }} </router-link>
        </li>
      </ul>
      <spinner v-else />
      <router-link class="more" :to="{ name: 'top', query: { sort: 'topnew' } }"> More new questions... </router-link>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Spinner from './widgets/spinner.vue'

export default {
  name: 'topHome',

  components: { Spinner },

  computed: {
    ...mapGetters( 'topQuestions', { top: 'allTop' }),
    ...mapGetters( 'topQuestions', { newTop: 'allNew' })
  },

  created() {
    this.loadTop()
    this.loadNew()
  },

  methods: {
    async loadTop() {
      await this.$store.dispatch('topQuestions/loadTop')
    },
    async loadNew() {
      await this.$store.dispatch('topQuestions/loadNew')
    },
  },
}
</script>

<style lang="scss">
  .top__home {
      width: 100%;
      display: flex;
      justify-content: space-between;

    &__pop,
    &__new {
      max-width: 50%;
      min-width: 40%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      ul {
        height: 100%;
        margin-top: 0;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        li {
          padding: 5px 0;
        }
      }
    }
    .more {
      text-align: right;
    }
  }
</style>
