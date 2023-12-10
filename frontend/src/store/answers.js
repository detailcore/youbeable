export default Api => ({
    namespaced: true,
    state: {
        item: [],
    },
    getters: {
        answerItem: state => state.item,
    },
    mutations: {
        setItem(state, item){
            state.item = item
        },
    },
    actions: {
        async loadAnswerItem(store, payload){
            let res = await Api.apiAnswerItem(payload)
            store.commit('setItem', res)
        },
    }
});