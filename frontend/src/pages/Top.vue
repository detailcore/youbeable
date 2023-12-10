<template>
  <div class="home">
    <h2 v-if="this.alias == 'topnew'"> List of new questions </h2>
    <h2 v-else> Popular questions </h2>

    <pagination :page='page'
                :totalPages='totalPages'
                @onPrevPage='prevPage'
                @onNextPage='nextPage'
                @onSelectPage='selectPage' />

    <spinner v-if="isActive" />

    <question-latest v-else v-for="post in questions.data" :key="post.id"
        :id='post.id'
        :title='post.title' 
        :desc='post.body' 
        :tags='post.tags' 
        :answer='post.answer_count'
        :views='post.view_count'
        :update='post.community_owned_date' />

    <pagination :page='page'
                :perPage='this.questions.length'
                :totalPages='totalPages'
                @onPrevPage='prevPage'
                @onNextPage='nextPage'
                @onSelectPage='selectPage' />

  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Pagination from '@/components/Pagination.vue'
import Spinner from '@/components/widgets/spinner.vue'
import QuestionLatest from '@/components/QuestionLatest.vue'

export default {
  name: 'top',

  metaInfo () {
    return {
      title: this.alias=='topnew' ? 'The sorted questions in novelty' : 'The sorted questions in popularity',
      meta: [
        { 
          vmid: 'description', 
          name: 'description', 
          content: this.alias=='topnew' ? 'The list of questions which are sorted by novelty' : 'The list of questions which are sorted by popularity'
        }
      ]
    }
  },

  components: { QuestionLatest, Pagination, Spinner },

  computed: {
    ...mapGetters( 'topPage', { questions: 'getTop' }),
    
    alias() {
      return this.$route.query.sort
    },
  },

  watch: {
    alias() {
      this.getTops()
    },
  },

  data: () => ({
      page: 1,
      isActive: true,
      totalPages: 1,
  }),

  async created() {
    await this.getTops()
    await this.setPage()
  },

  methods: {
    async getTops() {
      this.page = +this.$route.query.page
      await this.$store.dispatch('topPage/load', {
        sort: this.$route.query.sort,
        page: this.page
      })
      .then(()=> {
        this.isActive = false
      })
    },

    async loadPage() {
      await this.$store.dispatch('topPage/load', {
        sort: this.$route.query.sort,
        page: this.page
      })
      .then(() => {
        this.isActive = false
      })
    },

    setPage() {
        this.page = this.questions.current_page
        this.totalPages = this.questions.last_page
    },

    selectPage(payload) {
      this.page = payload.page
      this.loadPage()
    },

    prevPage() {
      this.isActive = true
      this.page--
      this.loadPage()
    },

    nextPage() {
      this.isActive = true
      this.page++
      this.loadPage()
    },
  },

}
</script>

<style lang="scss">

</style>
