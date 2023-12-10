<template>
  <div class="loading-block">
    <div class="circle">
      <svg class="spinner" viewBox="0 0 50 50">
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
      </svg>
    </div>
    <div class="text">Loading...</div>
  </div>
</template>

<script>
export default {
  name: 'spinner',
}
</script>

<style lang="scss">
.loading-block {
    position: relative;
  .circle {
    height: 50px;
  }
  .text {
    margin-top: 20px;
    text-align: center;
  }
  .spinner {
    animation: rotate 2s linear infinite;
    z-index: 2;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -25px 0 0 -25px;
    width: 50px;
    height: 50px;
    
    & .path {
      stroke: rgb(55, 72, 88);
      stroke-linecap: round;
      animation: dash 1.5s ease-in-out infinite;
    }
    
  }

  @keyframes rotate {
    100% {
      transform: rotate(360deg);
    }
  }

  @keyframes dash {
    0% {
      stroke-dasharray: 1, 150;
      stroke-dashoffset: 0;
    }
    50% {
      stroke-dasharray: 90, 150;
      stroke-dashoffset: -35;
    }
    100% {
      stroke-dasharray: 90, 150;
      stroke-dashoffset: -124;
    }
  }
}
</style>
