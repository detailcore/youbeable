export default () => ({
	namespaced: true,
	state: {
		title: '',
		// metatags
	},
	getters: {
		title: state => state.title
	},
	mutations: {
		setTitle: (state, title) => state.title = title
	},
	actions: {
		setTitle({ state, commit }, title){
			commit('setTitle', title);

			if(process.isClient){
				document.title = state.title;
			}
		}
	}
});