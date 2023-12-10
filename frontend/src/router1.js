import Vue from 'vue'
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from './components/Home.vue'
import Other from './components/Other.vue'
import E404 from './components/Page404.vue'

let routes = [
	{
		path: '/',
		component: Home
	},
	{
		path: '/other',
		component: Other
	},
	{
		path: '*',
		component: E404
	}
]

export default function(){
	let router = new VueRouter({
		routes,
		mode: 'history'
	});

	return router
}