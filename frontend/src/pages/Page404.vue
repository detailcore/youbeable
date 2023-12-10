<template>
  <div class="hello">
    <h3>Wrong, the page is not found! </h3>
    <p>
      Page not found! Error 404. Go to the home page.
    </p>
  </div>
</template>

<script>
export default {
  name: 'page404',

  metaInfo: {
    title: 'Page not found!',
    meta: [
      { name: 'description', content: 'Page not found! Error 404. Go to the home page' }
    ]
  }
}
</script>