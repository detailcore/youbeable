import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        topHomeQ: [],
        newHomeQ: [],
    },
    mutations: {
        SET_TOPHQ_TO_STATE: (state, topHomeQ) => {
            state.topHomeQ = topHomeQ
        },
        SET_NEWHQ_TO_STATE: (state, newHomeQ) => {
            state.newHomeQ = newHomeQ
        }
    },
    actions: {
        GET_TOP_API({ commit }) {
            return axios.get('http://127.0.0.1:8000/api/questions/tophome')
            .then((res) => {
                commit('SET_TOPHQ_TO_STATE', res.data)
                return res
            })
            .catch((e) => { console.log(e) })
        },
        GET_NEW_API({ commit }) {
            return axios.get('http://127.0.0.1:8000/api/questions/newhome')
            .then((res) => {
                commit('SET_NEWHQ_TO_STATE', res.data)
                return res
            })
            .catch((e) => { console.log(e) })
        }
    },
    getters: {
        TOPHQ(state) {
            return state.topHomeQ
        },
        NEWHQ(state) {
            return state.newHomeQ
        },
    }
})

export default store