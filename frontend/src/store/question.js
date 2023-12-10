export default Api => ({
    namespaced: true,
    state: {
        item: [],
        related: [],
    },
    getters: {
        questionItem: state => state.item,
        getRelated: state => state.related,
    },
    mutations: {
        setItem(state, item){
            state.item = item
        },
        setRelated(state, item){
            state.related = item
        },
    },
    actions: {
        async loadOneQuestion(store, payload){
            let res = await Api.apiOneQuestion(payload)
            store.commit('setItem', res)
        },
        async loadRelated(store, payload){
            let res = await Api.apiRelatedQuestion(payload)
            store.commit('setRelated', res)
        },
    }
});