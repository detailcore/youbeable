import Vue from 'vue'
import VueMeta from 'vue-meta'
import App from './App.vue'
import createRouter from './router'
import createStore from './store'
import createHTTP from '@/http.js'
import createApi, { VueApi } from '@/api/index.js';

Vue.use(VueApi)
Vue.use(VueMeta)
Vue.config.productionTip = false

export default context => new Promise(async resolve => {
	let HTTP = createHTTP();
	let api = createApi(HTTP)
	let store = createStore(api);
	let router = createRouter(store);
	// let productsPromise = store.dispatch('products/load');

	if(process.isServer){
		// await store.dispatch('topQuestions/loadTop');
		// await store.dispatch('topQuestions/loadNew');
		await store.dispatch('menu/loadTagsTop');
		await store.dispatch('topAnswers/loadTop');
		// await store.dispatch('questions/loadQuestions');
		router.push(context.url, render);
	}
	else{
		// await productsPromise;
		if(window.__INITIAL_STATE__) {
			store.replaceState(window.__INITIAL_STATE__)
		} else {
			// await store.dispatch('topQuestions/loadTop');
			// await store.dispatch('topQuestions/loadNew');
			await store.dispatch('menu/loadTagsTop');
			await store.dispatch('topAnswers/loadTop');
			// await store.dispatch('questions/loadQuestions');
		}
		render();
	}

	function render() {
		new Vue({
			router,
			store,
			api,
			render: h => h(App),
			created(){
				resolve({ app: this, router, store });
			}
		})
	}
});

