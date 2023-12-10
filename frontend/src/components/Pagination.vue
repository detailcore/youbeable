<template>
  <div class="pages">
    <div class="btn-page prev" @click="prevPage"> <chevron-left :size="26" /> </div>

    <span class="page-list">
      1 - {{ page }}  of  {{ totalPages }} 
    </span>

    <div class="btn-page next" @click="nextPage"> <chevron-right :size="26" /> </div>
  </div>
</template>

<script>
import ChevronLeft from 'vue-material-design-icons/ChevronLeft.vue';
import ChevronRight from 'vue-material-design-icons/ChevronRight.vue';

export default {
  name: 'pagination',

  components: { ChevronLeft, ChevronRight },

  props: {
    page: { type: Number, default: () => 1 },
    totalPages: { type: Number, default: () => 1 },
  },

  computed: {
    // startPage() {
    //   return this.page
    // },

    // currentPage() {},
  },

  methods: {
    nextPage () {
      if (this.page < this.totalPages) {
        this.$emit('onNextPage')
      }
    },

    prevPage () {
      if (this.page > 1) {
        this.$emit('onPrevPage')
      }
    },
  }

}
</script>

<style lang="scss">
  .pages {
    display: flex;
    padding: 15px 0px;
    justify-content: space-between;
    .btn-page {
      cursor: pointer;
      margin: 0.25rem;
      border-radius: 0.2rem;
      padding: 0.25rem 0.5rem;
      border: 1px solid #f0f0f0;
      &:hover {
        color: #000;
        border-color: #ccc;
      }
      svg {
        display: flex;
      }
    }
    .btn-page.prev {
      b {
      }
    }
    .btn-page.next {
      b {
      }
    }

    .page-list {
      width: 100%;
      text-align: right;
      align-self: center;
      padding-right: 20px;
    }
  }
</style>
