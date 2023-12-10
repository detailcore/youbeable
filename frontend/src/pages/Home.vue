<template>
  <div class="home">
    <h1>Translation of popular issues from RuStackOverflow</h1>

    <top-home />

    <pagination :page='page'
                :totalPages='totalPages'
                @onPrevPage='prevPage'
                @onNextPage='nextPage'
                @onSelectPage='selectPage' />

    <spinner v-if="isLoading" />

    <question-latest v-else v-for="post in questions.data" :key="post.id"
        :id='post.id'
        :title='post.title' 
        :desc='post.body' 
        :tags='post.tags' 
        :answer='post.answer_count'
        :views='post.view_count'
        :update='post.community_owned_date' />

    <pagination :page='page'
                :totalPages='totalPages'
                @onPrevPage='prevPage'
                @onNextPage='nextPage'
                @onSelectPage='selectPage' />

  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import TopHome from '@/components/TopHome.vue'
import Pagination from '@/components/Pagination.vue'
import Spinner from '@/components/widgets/spinner.vue'
import QuestionLatest from '@/components/QuestionLatest.vue'
// import HTTP from '@/http'

export default {
  name: 'home',

  metaInfo: {
    title: 'Translation of popular issues from RuStackOverflow',
    meta: [
      { name: 'description', content: 'Translation of popular issues Russian-speaking content of RuStackOverflow' }
    ]
  },

  components: { 
    TopHome, 
    Spinner, 
    Pagination, 
    QuestionLatest, 
    },

  data: () => ({
    page: 1,
    // questions: [],
    totalPages: 1,
    isLoading: true,
  }),

  async ssrData({ store, params }) {
    await store.dispatch('questions/loadQuestions', this.page);
    await store.dispatch('topQuestions/loadTop');
    await store.dispatch('topQuestions/loadNew');
  },

  computed: {
    ...mapGetters( 'questions', { questions: 'allQuestions' }),
  },

  async created() {
    await this.loadPage()
    await this.getHome()
  },

  methods: {
    getHome() {
        this.page = this.questions.current_page
        this.totalPages = this.questions.last_page
    },

    async loadPage() {
      await this.$store.dispatch('questions/loadQuestions', this.page)
      .then(()=> {
        this.isLoading = false
      })
      
      // HTTP.get(`questions?page=${this.page}`, {
      //   name: this.$route.params.name,
      //   page: this.page,
      // }).then(({ data }) => {
      //   this.questions = data.data
      //   this.page = data.current_page
      //   this.totalPages = data.last_page
        
      // }).catch((err) => {
      //   console.log(err)
      // })
    },

    selectPage(payload) {
      this.page = payload.page
      this.loadPage()
    },

    prevPage() {
      this.isLoading = true
      this.page--
      this.loadPage()
    },

    nextPage() {
      this.isLoading = true
      this.page++
      this.loadPage()
    },
  },

}
</script>

<style lang="scss">

</style>
