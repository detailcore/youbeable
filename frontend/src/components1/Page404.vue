<template>
	<div class="other">
		<h1>404</h1>
	</div>
</template>
<script>
	export default {
		created(){
			this.$store.dispatch('meta/setTitle', '404');
		}
	}
</script>