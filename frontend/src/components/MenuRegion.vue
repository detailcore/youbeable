<template>
  <aside class="sidebar">
    <nav class="menu">
      <ul class="menu__main">
        <li class="menu__title"><router-link :to="{ name: 'home' }">All questions</router-link></li>
        <ul class="menu__item">
          <li><router-link :to="{ name: 'top', query: { sort: 'topnew', page: 1 } }">New</router-link></li>
          <li><router-link :to="{ name: 'top', query: { sort: 'toptop', page: 1 } }">Popular</router-link></li>
        </ul>
        <div class="menu__title">Popular tags</div>
        <ul class="menu__item">
          <li v-for="item in topTags" :key="item.id">
            <router-link :to="{ name: 'tag', params: { alias: item.tag_name, page: 1 } }"> {{ item.tag_name }} <span>({{item.count}})</span> </router-link>
          </li>
        </ul>
        <li class="menu__title"><router-link :to="{ name: 'tags' }">All tags</router-link></li>
      </ul>
    </nav>

    <section class="promo">
      <h3 class="promo__title">You be able</h3>
      <p class="promo__desc">
        Find answers to questions on any topic in the field of IT from experts in this topic.
      </p>
      <router-link :to="{ name: 'about' }">More details...</router-link>
    </section>
  </aside>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'menuRegion',

  computed: {
    ...mapGetters('menu', { topTags: 'topTags' }),
  },

}
</script>

<style lang="scss">
.sidebar {
  background-color: #4f5a6e;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 250px;
  min-height: 100vh;
}

.menu {
  font-size: 15px;
  color: #a7b3cb;
  line-height: 1.5em;
  a {
    color: #a7b3cb;
    text-decoration: none;
    &:hover {
      color: #fff;
      text-decoration: underline;
    }
  }
  &__main {
    list-style-type: none;
  }
  &__item {
    list-style-type: disclosure-closed;
    li {
      margin-bottom: 6px;
    }
  }
  &__title {
    height: 36px;
    display: flex;
    align-items: center;
  }
}

.promo {
  // width: 250px;
  padding: 20px;
  bottom: 0rem;
  text-align: center;
  align-self: flex-end;
  position: sticky;
  position: -webkit-sticky;
  background-color: #303b44;
  &__title {
    color: #fff;
    font-size: 15px;
    margin-bottom: 12px;
  }
  &__desc {
    color: #a7b3cb;
    font-size: 14px;
    margin-bottom: 20px;
  }
  a {
    color: ivory;
    &:hover {
      color: #fffff0b5;
    }
  }
}
</style>
