import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

import createProductsModule from './products';
import createMetaModule from './meta';

export default () => new Vuex.Store({
	modules: {
		products: createProductsModule(),
		meta: createMetaModule()
	},
	strict: process.env.NODE_ENV !== 'production'
});