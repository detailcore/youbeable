export default Api => ({
    namespaced: true,
    state: {
        questions: [],
    },
    getters: {
        allQuestions: state => state.questions,
    },
    mutations: {
        setQuestions(state, questions){
            state.questions = questions
        },
    },
    actions: {
        async loadQuestions(store, payload){
            let res = await Api.apiQuestions(payload)
            store.commit('setQuestions', res)
        },
    }
});