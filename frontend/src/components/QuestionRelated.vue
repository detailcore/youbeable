<template>
  <aside class="question_related" v-if="visible">
    <h4 class="header_related">
      Similar questions
    </h4>
    <ul class="list">
      <li class="item" v-for="(item, index) in related" :key="index">
        <h5 class="title">
          <router-link :to="{ name: 'question', params: { alias: item.related_post_id } }"> {{ item.related_title }} </router-link>
        </h5>
        <p class="desc_short">
          {{ item.related_body }}
        </p>
      </li>
    </ul>
  </aside>
</template>

<script>

export default {
  name: 'questionRelated',

  props: {
    related: { type: Array, default: [], },
  },

  computed: {
    visible() {
      return this.related.length > 0
    },
  },
}
</script>

<style lang="scss">
  .question_related {
    .header_related {
      font-size: 1.2em;
    }
    .list {
      list-style-type: disclosure-closed;
    }
    .title {
      font-size: 1.1em;
      margin-bottom: 0px;
    }
    .desc_short {
      margin-top: 8px;
    }
  }
  
</style>
