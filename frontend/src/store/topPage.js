export default Api => ({
    namespaced: true,
    state: {
        item: [],
    },
    getters: {
        getTop: state => state.item,
    },
    mutations: {
        setItem(state, item){
            state.item = item
        },
    },
    actions: {
        async load(store, { sort, page }){
            let res = await Api.apiTopPage(sort, page)
            store.commit('setItem', res)
        },
    }
});