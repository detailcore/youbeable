<template>
  <div class="tag-item">
    <div class="title">
      <router-link class="tag-link" :to="{ name: 'tag', params: { alias: title } }"> {{ title }} </router-link>
      <span>{{ count }} questions</span>
    </div>
    <div class="desc">
      {{ description }}
    </div>
  </div>
</template>

<script>
export default {
  name: 'tagsItem',

  props: {
    title: { type: String, default: '', },
    count: { type: Number, default: 0, },
    description: { type: String, default: '', }
  },

  created() {
    this.separateDesc(this.description)
  },

  computed: {
    desc() {
      return this.description
    }
  },

  watch: {
    desc() {
      this.separateDesc(this.description)
    }
  },

  methods: {
    separateDesc(params) {
      return params
        .replace(/<(?:.|\n)*?>/, '')
        .replace(/<\/(?:.|\n)*?>/, '')
        .replace(/<\/?[^>]+>/gi, '')
        .slice(0, 100)
        .concat('...')
    }
  },
}
</script>

<style lang="scss">

</style>
