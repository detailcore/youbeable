<template>
  <div class="content_full">
    <div class="question_full">
      <h1 class="title"> {{ question.title }} </h1>

      <div v-if="!isLoading" class="question" v-html="question.body"></div>
      <spinner v-else />

      <div class="tags">
        <span v-for="(item, index) in tags" :key="index">
          <router-link :to="{ name: 'tag', params: { alias: item, id: item } }"> {{ item }} </router-link>
        </span>
      </div>

      <info v-if="question.creation_date" :name='question.owner_display_name' :date='question.creation_date' :source="`https://ru.stackoverflow.com/questions/` + question.id" />
    </div>
    
    
    <h3 v-if="answers.length > 0">Total Answers: {{ answers.length }}</h3>

    <spinner v-if="isLoading" />
    <h4 v-if="!isLoading && +answers.length === 0" class="no-answer"> We apologize, but we did not find an answer to this question. </h4>
    
    <answer-item v-for="item in answers" 
                :key="item.id"
                class="answer"
                :id="item.id" 
                :text="item.body" 
                :votes="item.score"
                :accepted="acceptedAnswer"
                :user_name="item.owner_display_name"
                :date="item.creation_date" />

    <question-related :related="related" />

  </div>
</template>

<script>
// import HTTP from '@/http';
import { mapGetters } from 'vuex'
import info from '@/components/widgets/info.vue'
import AnswerItem from '@/components/AnswerItem.vue'
import Spinner from '@/components/widgets/spinner.vue'
import QuestionRelated from '@/components/QuestionRelated.vue'


export default {
  name: 'question',

  metaInfo () {
    return {
      title: this.tags ? this.tags[0] + ' - ' + this.question.title : '',
      // meta: [
      //   { name: 'description', content: 'Translation of popular issues Russian-speaking content of RuStackOverflow' }
      // ]
    }
  },

  components: { 
    info, 
    Spinner,
    AnswerItem, 
    QuestionRelated 
  },

  data() {
    return {
      // tags: null,
      // answers: [],
      // question: {},
      // accepted_answer: null,
    }
  },

  async ssrData({ store, params }) {
    await store.dispatch('question/loadOneQuestion', +params.alias);
    await store.dispatch('answers/loadAnswerItem', +params.alias);
    await store.dispatch('question/loadRelated', +params.alias);
  },

  computed: {
    ...mapGetters( 'answers', { answers: 'answerItem' }),
    ...mapGetters( 'question', { question: 'questionItem' }),
    ...mapGetters( 'question', { related: 'getRelated' }),

    alias() {
      return +this.$route.params.alias
    },
    acceptedAnswer() {
      return +this.question.accepted_answer_id
    },
    tags() {
      if(this.question.tags) {
        return this.question.tags.split(/<(.*?)>/).filter(n => n)
      }
      return null
    },
    isLoading() {
      return this.alias == this.question.id ? false : true
    }
  },

  watch: {
    alias() {
      this.loadAll()
      this.loadAnswer()
      this.loadRelated()
    },
  },

  async created() {
    await this.loadAll()
    await this.loadAnswer()
    await this.loadRelated()  
  },

  methods: {
    async loadAll() {
      await this.$store.dispatch('question/loadOneQuestion', +this.$route.params.alias)
    },

    async loadAnswer() {
      await this.$store.dispatch('answers/loadAnswerItem', +this.$route.params.alias)
    },

    async loadRelated() {
      await this.$store.dispatch('question/loadRelated', +this.$route.params.alias)
    },
  },
}
</script>

<style lang="scss">
.no-answer {
  font-size: 120%;
  text-align: center;
}
.content_full {
  .answer {
    &::after {
      content: '';
      display: block;
      margin: 0 -30px;
      padding-top: 10px;
      background-color: #dee1e5;
    }
    &:last-child {
      &::after {
        padding-top: 0px;
      }
    }
  }
}

</style>