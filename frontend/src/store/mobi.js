import { isMobile } from 'mobile-device-detect';

export default () => ({
	namespaced: true,
	state: {
		item: isMobile,
		opened: false,
	},
    getters: {
        getIsMobile: state => state.item,
		menuOpened: state => state.opened,
    },
    mutations: {
        setOpened(state, item){
            state.opened = item
        },
    },
    actions: {
        async opened(store, payload){
            await store.commit('setOpened', payload)
        },
    }
});