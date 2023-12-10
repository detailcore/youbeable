<template>
  <div class="tags-list">
    <h2> All tags </h2>
    <p>
      Teg is the key word or mark that classifies your question with other similar questions. The use of the right tags makes it easier for another search and answer to your question.
    </p>

    <pagination :page='page'
                :totalPages='totalPages'
                @onPrevPage='prevPage'
                @onNextPage='nextPage'
                @onSelectPage='selectPage' />

    <spinner v-if="isLoading" />

    <tags-item v-else v-for="(item, index) in tags.data" :key="index" :title="item.tag_name" :count="item.count" :description="item.description" />

    <pagination :page='page'
                :totalPages='totalPages'
                @onPrevPage='prevPage'
                @onNextPage='nextPage'
                @onSelectPage='selectPage' />
  </div>
</template>

<script>
// import HTTP from '@/http';
import { mapGetters } from 'vuex'
import Pagination from '@/components/Pagination.vue'
import TagsItem from '../components/TagsItem.vue';
import Spinner from '../components/widgets/spinner.vue';

export default {
  name: 'tags',

  metaInfo: {
    title: 'All tags',
    meta: [
      { name: 'description', content: 'Teg is the key word or mark that classifies your question with other similar questions. The use of the right tags makes it easier for another search and answer to your question.' }
    ]
  },

  components: { Pagination, TagsItem, Spinner },

  data: () => ({
      page: 1,
      // tags: [],
      totalPages: 1,
      isLoading: true,
  }),

  async ssrData({ store, params }) {
    await store.dispatch('tags/load');
  },

  computed: {
    ...mapGetters( 'tags', { tags: 'tagItem' }),
  },

  async created() {
    await this.getTags()
    this.setPage()
  },

  methods: {
    async getTags() {
      await this.$store.dispatch('tags/load')
      .then(()=> {
        this.isLoading = false
      })
      // HTTP.get('tags/list')
      // .then(({ data }) => {
      //   this.tags = data.data
      //   this.page = data.current_page
      //   this.totalPages = data.last_page
      // })
      // .catch(e => console.log(e, 'getTags'))
    },

    setPage() {
        this.page = this.tags.current_page
        this.totalPages = this.tags.last_page
    },

    async loadPage() {
      await this.$store.dispatch('tags/load', this.page)
      .then(()=> {
        this.isLoading = false
      })

      // HTTP.get(`tags/list?page=${this.page}`, {
      //   page: this.page,
      // }).then(({ data }) => {
      //   this.tags = data.data
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