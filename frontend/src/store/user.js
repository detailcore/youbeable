export default Api => ({
    namespaced: true,
    state: {
        item: '',
    },
    getters: {
        userItem: state => state.item,
    },
    mutations: {
        setItem(state, item){
            state.item = item
        },
    },
    actions: {
        async loadUserName(store, payload){
            let res = await Api.apiUserName(payload)
            store.commit('setItem', res.display_name)
        },
    }
});