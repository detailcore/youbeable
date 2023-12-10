export default Api => ({
    namespaced: true,
    state: {
        itemTop: [],
    },
    getters: {
        allTop: state => state.itemTop,
    },
    mutations: {
        setItemTop(state, itemTop){
            state.itemTop = itemTop
        },
    },
    actions: {
        async loadTop(store, payload){
            let res = await Api.apiAnswerTop()
            store.commit('setItemTop', res)
        },
    }
});