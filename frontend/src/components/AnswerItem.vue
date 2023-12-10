<template>
<div :id="id">
  <div class="content_full">
    <div class="answer_full">
      <votes :score="votes" :accept="this.isActive" />

      <div class="answer-text" :class="{ hash: hash }" v-html="text"></div>
    </div>

    <info v-if="user_name" :id="id" :name='user_name' :date='date' />
  </div>
</div>
</template>

<script>
import Info from './widgets/info.vue'
import votes from './widgets/votes.vue'
export default {
  components: { votes, Info },
  name: 'answerItem',

  props: {
    id: { type: Number, default: 0, },
    text: { type: String, default: '', },
    date: { type: String, default: '', },
    votes: { type: Number, default: 0, },
    accepted: { type: Number, default: 0, },
    user_name: { type: String, default: '', },
  },

  data: () => ({
    hash: false,
    accept: false,
  }),

  computed: {
    isActive() {
      return this.accept
    }
  },

  async created() {
    this.isHash()
    this.acceptedAnswer()
  },

  methods: {
    acceptedAnswer() {
      if (this.id === this.accepted) {
        this.accept = true
      }
    },

    isHash() {
      if('#'+this.id == this.$route.hash) {
        this.hash = true
      }
    }
  },
}
</script>

<style lang="scss" scoped>
  .content_full {
    display: flex;
    flex-direction: column;
    &::after {
      border: 0;
      content: '';
      display: block;
      margin-top: 1rem;
      margin-bottom: 1rem;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
    }
  }

  .answer_full {
    display: flex;
    .answer-text {
      max-width: 92%;
      width: calc(100% - 60px);
      word-wrap: break-word;
    }
    .hash {
      background-color: rgba(33, 167, 29, 0.2);
    }
  }
</style>
