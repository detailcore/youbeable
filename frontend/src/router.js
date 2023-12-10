import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './pages/Home'
import About from './pages/About'
import Contact from './pages/Contact'
import Tags from './pages/Tags'
import Top from './pages/Top'
import Tag from './pages/Tag'
import Question from './pages/Question'
import Page404 from './pages/Page404'

let routes = [
	{
		path: '/',
		name: 'home',
		component: Home,
		// component: () => import('./pages/Home')
	},
	{
		path: '/about',
		name: 'about',
		component: About,
		// component: () => import('./pages/About')
	},
	{
		path: '/contact',
		name: 'contact',
		component: Contact,
		// component: () => import('./pages/Contact')
	},
	{
		path: '/tags',
		name: 'tags',
		component: Tags,
		// component: () => import('./pages/Tags')
	},
	{
		path: '/top',
		name: 'top',
		component: Top,
		// component: () => import('./pages/Top')
	},
	{
		path: '/tag/:alias',
		name: 'tag',
		component: Tag,
		// component: () => import('./pages/Tag')
	},
	{
		path: '/question/:alias',
		name: 'question',
		component: Question,
		// component: () => import('./pages/Question')
	},

	{
		path: '/404/',
		name: 'page404',
		component: Page404,
		// component: () => import('./pages/Page404')
	},
	{
		path: '*',
		redirect: { name: 'page404' }
	}
]


export default function () {
	let router = new VueRouter({
		mode: 'history',
		routes,
		scrollBehavior(to, from, savedPosition) {
			if (savedPosition) {
				return savedPosition
			} else {
				return { x: 0, y: 0 }
			}
		}
	})

	return router
}