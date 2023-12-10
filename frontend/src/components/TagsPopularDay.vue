<template>
  <aside class="sidebar-tags">
    <h3>Popular Answers</h3>
    
    <div class="answer" v-for="item in answers" :key="item.id">
      <router-link class="title" :to="{ name: 'question', params: { alias: item.parent_id } }">
        <h5> <check-all :size="16" :class="{ score: item.score }" /> {{ item.title }} </h5>
      </router-link>

      <div class="desc">
        {{ item.body }}...
      </div>

      <div class="tags">
        <span v-for="(value, index) in item.tags" :key="index">
          <router-link :to="{ name: 'tag', params: { alias: value } }"> {{ value }}  </router-link>
        </span>
      </div>
    </div>
  </aside>
</template>

<script>
import { mapGetters } from 'vuex';
import CheckAll from 'vue-material-design-icons/CheckAll.vue';
  

export default {
  name: 'tagsPopularDay',

  components: { CheckAll },

  computed: {
    ...mapGetters( 'topAnswers', { answers: 'allTop' }),
    // alias() {
    //   return this.$route.params.alias
    // },
  },

  // watch: {
  //   alias() {
  //     this.loadTop()
  //   },
  // },

  // async created() {
  //   await this.loadTop()
  // },

  methods: {
    // async loadTop() {
    //   await this.$store.dispatch('topAnswers/loadTop', this.alias)
    //   // this.answers = await this.$api.top.apiAnswerTop()
    // },

    separateTags(param) {
      return param
    },
  },
}
</script>

<style lang="scss">
.sidebar-tags {
  .title {
    h5 {
      font-size: 0.9em;
      margin-bottom: 0.2em;
    }
  }
  .answer {
    overflow: hidden;
    .desc {
      text-align: justify;
    }
  }
}
</style>
