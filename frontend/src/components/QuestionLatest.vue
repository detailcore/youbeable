<template>
  <section class="question_short">
    <div class="question_content">
      <h2 class="title"><router-link :to="{ name: 'question', params: { alias: id }  }"> {{ title }} </router-link></h2>      
      <p class="desc_short">
        {{ desc }}
      </p>
      <div class="tags">
        <span v-for="(item, index) in tagsCurrent" :key="index">
          <router-link :to="{ name: 'tag', params: { alias: item } }"> {{ item }} </router-link>
        </span>
      </div>
      <div class="info">
        <small>views: {{ views }}</small>
        <small>updated: {{ timeCurrent }}</small>
      </div>
    </div>
    <div class="question_answers" :class="{ plus: answer > 0 }">
      {{ answer }} answer(s)
    </div>
  </section>
</template>

<script>
export default {
  name: 'questionLatest',

  props: {
    id: { type: Number, default: ()=> 0 },
    title: { type: String, default: ()=> '' },
    desc: { type: String, default: ()=> '' },
    tags: { type: String, default: ()=> '' },
    answer: { type: Number, default: ()=> 0 },
    views: { type: Number, default: ()=> 0 },
    update: { type: String, default: ()=> '' },
  },

  data() {
    return {
      dateTime: '',
      tagsLatest: [],
    }
  },

  computed: {
    tagsCurrent() {
      return this.separateTags(this.tags)
    },
    timeCurrent() {
      return this.getTime()
    },
  },

  methods: {
    separateTags(param) {
      return this.tagsLatest = param.split(/<(.*?)>/).filter(n => n)
    },

    getTime() {
      return this.dateTime = new Date(this.update).toLocaleString();
    }
  },
}
</script>

<style lang="scss">
.question_answers.plus {
  color: #1B5E20;
}
</style>
