import createApp from '@/app.js';

import Vue from 'vue'
// import App from './App.vue'
import VueClipboard from 'vue-clipboard2'

// import store from './store'
// import router from './router.js'


Vue.config.productionTip = false
Vue.use(VueClipboard)

//Загружаю данные из Vuex из Action
// store.dispatch('topQuestions/loadTop');
// store.dispatch('topQuestions/loadNew');

// store.dispatch('questions/loadQuestions');


createApp().then(({ app }) => {
	app.$mount('#app')
});