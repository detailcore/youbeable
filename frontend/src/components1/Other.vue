<template>
	<div class="other">
		<h1>Other page</h1>
		<hr>
		<div>
			<p v-for="product in products" :key="product.id">{{ product.title }}</p>
		</div>
	</div>
</template>
<script>
	import { mapGetters } from 'vuex';

	export default {
		computed: {
			...mapGetters('products', { products: 'all' })
		},
		created(){
			this.$store.dispatch('meta/setTitle', 'Products Page');
		}
	}
</script>