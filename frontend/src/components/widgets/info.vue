<template>
  <div class="info">

    <small class="name">
      <account-outline :size="16" />
      <b> {{ name }}</b>
      <i>({{ dateTime }})</i>
    </small>

    <a class="source-link" target="_blank" :href="source" rel="nofollow noreferrer" v-if="source.length">
      <source-branch :size="16" />
      <small>Source</small>
    </a>

    <div class="share">
      <share-variant-outline :size="16" />
      <small v-clipboard:copy="shareLink + '#' + id" 
             v-clipboard:success="onCopy" 
             v-clipboard:error="onError"
             title="Copy address">
        Share
      </small>
      <i class="copy" :class="{ show: isActive }">Copied!</i>
    </div>

  </div>
</template>

<script>
import SourceBranch from 'vue-material-design-icons/SourceBranch.vue';
import AccountOutline from 'vue-material-design-icons/AccountOutline.vue';
import ShareVariantOutline from 'vue-material-design-icons/ShareVariantOutline.vue';

export default {
  name: 'info',

  components: { AccountOutline, ShareVariantOutline, SourceBranch },

  props: {
    id: { type: Number, default: 0, },
    date: { type: String, default: '', },
    name: { type: String, default: '', },
    source: { type: String, default: '', },
  },

  data() {
    return {
      dateTime: '',
      isActive: false,
      shareLink: process.isClient ? location.origin + this.$route.path : ''
    }
  },

  created() {
    this.getTime()
  },

  methods: {
    getTime() {
      this.dateTime = new Date(this.date).toLocaleString();
    },

    onCopy: function (e) {
      console.log('Адрес скопирован: ' + e.text)
      this.isActive = true
      setTimeout( ()=> {
        this.isActive = false
      }, 600)
    },
    onError: function (e) {
      console.log('Ошибка. Скопировать адрес не удалось.', e)
    },

  },
}
</script>

<style lang="scss" scoped>
.info {
  display: flex;
  padding: 15px 0 0 0;
  justify-content: space-between;
  .name {
    b {
      padding-right: 0.5rem;
    }
  }
  .name,
  .share,
  .source-link {
    display: flex; 
    align-items: center; 
    flex-direction: row;
  }

  .share {
    cursor: pointer;
    position: relative;
    .copy {
      top: -22px;
      opacity: 0;
      color: #fff;
      font-size: 80%;
      padding: 3px 6px;
      position: absolute;
      visibility: hidden;
      border-radius: 0.25em;
      background-color: #4f5a6e;
      transition: all .8s ease-out;
    }
    .show {
      opacity: 1;
      visibility: visible;
    }
  }
}
</style>
