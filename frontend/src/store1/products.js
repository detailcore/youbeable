import axios from 'axios';

export default () => ({
	namespaced: true,
	state: {
		items: null
	},
	getters: {
		all: state => state.items
	},
	mutations: {
		set: (state, products) => state.items = products
	},
	actions: {
		async load({ commit }){
			let { data } = await axios('http://faceprog.ru/vuecourseapi2/products.php');
			commit('set', data);
		}
	}
});