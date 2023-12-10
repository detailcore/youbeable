<template>
  <div class="search-gerion" v-click-outside="resultHide">

    <input type="search" id="site-search" name="q"
          autocomplete="off"
          placeholder="Find a question and / or answer"
          v-model.trim="query"
          ref="width"
          aria-label="Search through site content"
          @click="resultOpen">
    
    <ul class="search-result" v-if="results.length > 0 && query && isActive" :style="widthSearch">
      <li class="search-item" v-for="result in results.slice(0,10)" :key="result.id" @click="resultHide">
        <router-link class="item-link" :to="{ name: 'question', params: { alias: result.id } }"> {{ result.title }} </router-link>
      </li>
    </ul>

  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import ClickOutside from 'vue-click-outside'
import Spinner from '@/components/widgets/spinner.vue'


export default {
  name: 'searchRegion',

  components: { Spinner },

  directives: {
    ClickOutside
  },

  data() {
    return {
      query: null,
      // results: [],
      isActive: true,
      isLoading: true,
    }
  },

  computed: {
    ...mapGetters( 'search', { results: 'getSearch' }),

    widthSearch() {
      return 'width:' +this.$refs.width.clientWidth+ 'px'
    }
  },

  watch: {
    query() {
      this.searchAnswer();
    }
  },

  methods: {
    async searchAnswer() {
      await this.$store.dispatch('search/loadSearch', this.query)
      .then(()=> {
        this.isActive = true
      })

      // HTTP.get('search', { params: { query: this.query } })
      // .then(({ data }) => {
      //   this.results = data
      //   this.isActive = true
      // })
      // .catch(e => console.log(e, 'searchAnswer'))
    },

    resultHide () {
      this.isActive = false
    },

    resultOpen() {
      this.isActive = true
    }
  },
}
</script>

<style lang="scss">
.search-gerion {
  width: 100%;
  padding: 0 20px;
  #site-search {
    width: 100%;
    background: #424b5f;
    padding-left: 15px;
    padding-right: 15px;
    border: 0;
    border-radius: 5px;
    color: #a7b3cb;
    font-size: 14px;
    font-style: normal;
    font-weight: normal;
    height: 37px;
    line-height: 1.5em;
    margin: 0;
    text-align: left;
    outline: none;
    &:hover,
    &:focus {
      background: #3a4357;
    }
    &::placeholder {
      color: #a7b3cb;
    }
  }

.search-result {
  margin: 0;
  z-index: 10;
  display: flex;
  padding: 0 1px;
  overflow: hidden;
  list-style: none;
  position: absolute;
  border-radius: 5px;
  flex-direction: column;
  background-color: #fff;
  box-shadow: 0 0 5px #999;
  .search-item {
    width: 100%;
    margin: 0;
    padding: 0;
    border-bottom: 1px solid #f0f0f0;
  }
  .item-link {
    display: block;
    padding: 12px;
    text-decoration: none;
    line-height: 1.3em;
    color: #333;
    font-size: 15px;
    cursor: pointer;
    &:hover {
      background-color: #dde1e4;
    }
  }
}
}
</style>
