export default Api => ({
    namespaced: true,
    state: {
        itemTop: [],
        itemNew: [],
    },
    getters: {
        allTop: state => state.itemTop,
        allNew: state => state.itemNew
    },
    mutations: {
        setItemTop(state, itemTop){
            state.itemTop = itemTop
        },
        setItemNew(state, itemNew){
            state.itemNew = itemNew
        },
    },
    actions: {
        async loadTop(store){
            let res = await Api.apiTopHome()
            store.commit('setItemTop', res)
        },
        async loadNew(store){
            let res = await Api.apiNewHome()
            store.commit('setItemNew', res)
        }
    }
});