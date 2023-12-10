import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import createTag from './tag';
import createTags from './tags';
import createMenu from './menu';
import createUser from './user';
import createSearch from './search';
import createAnswers from './answers';
import createTopPage from './topPage';
import createMetaModule from './meta';
import createMobiModule from './mobi';
import createQuestion from './question';
import createQuestions from './questions';
import createTopAnswers from './topAnswers';
import createTopQuestions from './topQuestions';


export default api =>  {
	const store = new Vuex.Store({
		modules: {
			tag: createTag(api.tags),
			tags: createTags(api.tags),
			meta: createMetaModule(),
			mobi: createMobiModule(),
			menu: createMenu(api.top),
			user: createUser(api.user),
			search: createSearch(api.otherApi),
			topPage: createTopPage(api.top),
			answers: createAnswers(api.answers),
			question: createQuestion(api.questions),
			questions: createQuestions(api.questions),
			topAnswers: createTopAnswers(api.top),
			topQuestions: createTopQuestions(api.top),
		},
		strict: process.env.NODE_ENV !== 'production'
	});

	return store;
}