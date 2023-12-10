<template>
  <div class="votes">
    <div class="up"> <chevron-up :size="26" /> </div>

    <div class="vote" :class="[ score > 0 ? { plus: score > 0 } : { minus: score < 0 }]"> {{ score }} </div>

    <check-all v-if="accept" :class="{ accept: accept }" />

    <div class="down"> <chevron-down :size="26" /> </div>
  </div>
</template>

<script>
import ChevronUp from 'vue-material-design-icons/ChevronUp.vue';
import ChevronDown from 'vue-material-design-icons/ChevronDown.vue';
import CheckAll from 'vue-material-design-icons/CheckAll.vue';



export default {
  name: 'votes',

  components: { ChevronUp, ChevronDown, CheckAll },

  props: {
    score: { type: Number, default: 0, },
    accept: { type: Boolean, default: false, }
  },
}
</script>

<style lang="scss">
  .votes {
    display: flex;
    font-size: 120%;
    padding: 12px 0;
    min-width: 58px;
    text-align: center;
    align-self: flex-start;
    flex-direction: column;
    .up {
    }
    .vote {
      padding: 6px 0;
      color: inherit;
    }
    .plus {
      color: #1B5E20;
    }
    .minus {
      color: #B00020;
    }
    .down {
    }
  }
  .accept {
    background-color: rgba(33, 167, 29, 0.5);
    color: #fff;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    svg {
      margin: 0 auto;
    }
  }
</style>
