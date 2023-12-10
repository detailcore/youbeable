<template>
  <div class="tag">
    <div class="tag-item">
      <div class="title">
        <h3>{{ alias }}</h3>
        <span> {{ desc.count }} </span>
      </div>
      <div class="desc">
        {{ desc.text }}
      </div>
    </div>

    <pagination :page='page'
                :totalPages='totalPages'
                @onPrevPage='prevPage'
                @onNextPage='nextPage'
                @onSelectPage='selectPage' />

    <spinner v-if="isActive" />
    
    <tag-latest v-else v-for="post in questions.data" :key="post.id"
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
import { mapGetters } from 'vuex';
import TagLatest from '../components/TagLatest.vue'
import Pagination from '@/components/Pagination.vue'
import Spinner from '@/components/widgets/spinner.vue'

export default {
  name: 'tag',

  metaInfo () {
    return {
      title: 'New questions according to the tag ' + '[' + this.alias + ']',
      meta: [
        { vmid: 'description', name: 'description', content: this.desc.text }
      ]
    }
  },

  components: { Pagination, TagLatest, Spinner },

  async created() {
    await this.loadDescTag()
    await this.loadTag()
    await this.setPage()
    // await this.loadTopAnswers()
  },

  computed: {
    ...mapGetters( 'tag', { desc: 'tagItemDesc' }),
    ...mapGetters( 'tag', { questions: 'tagItem' }),

    alias() {
      return this.$route.params.alias
    },
  },

  watch: {
    alias() {
      this.loadDescTag()
      this.loadTag()
      // this.loadTopAnswers()
    },
  },

  data: () => ({
      page: 1,
      isActive: true,
      totalPages: 1,
  }),

  methods: {
    async loadTag() {
      this.page = +this.$route.params.page
      await this.$store.dispatch('tag/load', {
        tag: this.$route.params.alias,
        page: this.page        
      })
      .then(() => {
        this.isActive = false
      })
    },

    async loadDescTag() {
      await this.$store.dispatch('tag/loadDesc', this.$route.params.alias)
    },

    // async loadTopAnswers() {
    //   await this.$store.dispatch('topAnswers/loadTop', this.$route.params.alias)
    // },

    setPage() {
        this.page = this.questions.current_page
        this.totalPages = this.questions.last_page
    },

    loadPage() {
      this.$store.dispatch('tag/load', {
        tag: this.$route.params.alias,
        page: this.page        
      })
      .then(() => {
        this.isActive = false
      })
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