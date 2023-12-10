export default Api => ({
    namespaced: true,
    state: {
        item: [],
    },
    getters: {
        topTags: state => state.item,
    },
    mutations: {
        setItem(state, item){
            state.item = item
        },
    },
    actions: {
        async loadTagsTop(store){
            let res = await Api.apiTagsTop()
            store.commit('setItem', res)
        },
    }
});