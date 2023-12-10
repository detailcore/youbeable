export default Api => ({
    namespaced: true,
    state: {
        search: [],
    },
    getters: {
        getSearch: state => state.search,
    },
    mutations: {
        setSearch(state, item){
            state.search = item
        },
    },
    actions: {
        async loadSearch(store, payload){
            console.log(payload);
            let res = await Api.apiSearch(payload)
            store.commit('setSearch', res)
        },
    }
});