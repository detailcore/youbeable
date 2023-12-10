export default Api => ({
    namespaced: true,
    state: {
        item: '',
        itemDesc: ''
    },
    getters: {
        tagItem: state => state.item,
        tagItemDesc: state => state.itemDesc,
    },
    mutations: {
        setItem(state, item){
            state.item = item
        },
        setItemDesc(state, itemDesc){
            state.itemDesc = itemDesc
        },
    },
    actions: {
        async load(store, { tag, page }){
            let payload = encodeURIComponent(tag)
            let res = await Api.apiTag(payload, page)
            store.commit('setItem', res)
        },
        async loadDesc(store, source){
            let payload = encodeURIComponent(source)
            let res = await Api.apiTagDesc(payload)
            store.commit('setItemDesc', res)
        },
    }
});