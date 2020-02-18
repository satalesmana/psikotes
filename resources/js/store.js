import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        cmbDimensi:[],
        cmbDimensiMap:[]
    },
    mutations: {
        getCmbDimensi: function(state) {
            axios.get(APP_PATH + '/api/dimensi').then(function(r) {
                state.cmbDimensi = r.data
            })
        },
        getCmbDimensiMaping: function(state) {
            axios.get(APP_PATH + '/api/mapingdimensi').then(function(r) {
                state.cmbDimensiMap = r.data
            })
        },
        
    }
});