define([
    'vue',
    'vuex'
], function (
    Vue,
    Vuex
) {

    Vue.use(Vuex);

    var Storage = {
        set: function (user) {
            localStorage.setItem('appUser', JSON.stringify(user));
        },
        get: function () {
            return JSON.parse(localStorage.getItem('appUser'));
        }
    };

    var store = new Vuex.Store({
        state: {
            user: null
        },
        mutations: {
            auth: function (state, user) {
                user.id = parseInt(user.id);
                state.user = user;
                Storage.set(state.user);
                console.info(state.user);
            },
            logout: function (state) {
                state.user = null;
                Storage.set(state.user);
            },
            init: function (state) {
                state.user = Storage.get();
            }
        },
        getters: {
            getUser: function (state) {
                return state.user;
            }
        }
    });

    store.commit('init');

    return store;

});