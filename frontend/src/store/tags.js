export default Api => ({
    namespaced: true,
    state: {
        item: '',
    },
    getters: {
        tagItem: state => state.item,
    },
    mutations: {
        setItem(state, item){
            state.item = item
        },
    },
    actions: {
        async load(store, payload){
            let res = await Api.apiTagList(payload)
            store.commit('setItem', res)
        },
    }
});