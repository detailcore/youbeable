import createTop from './top';
import createUser from './user';
import createTags from './tags';
import createAnswer from './answers';
import createQuestions from './questions';

import createOtherApi from './otherApi'; // All other Api query

export default HTTP => ({
	top: createTop(HTTP),
	user: createUser(HTTP),
	tags: createTags(HTTP),
	answers: createAnswer(HTTP),
	questions: createQuestions(HTTP),
	otherApi: createOtherApi(HTTP),
})

export const VueApi = {
	install(Vue){
		Vue.mixin({
			beforeCreate() {
				let options = this.$options

				if(options.api) {
					this.$api = options.api
				} else if (options.parent && options.parent.$api) {
					this.$api = options.parent.$api
				}
			},
		})
	}
}