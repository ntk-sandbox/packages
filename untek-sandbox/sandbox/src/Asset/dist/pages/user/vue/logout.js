define([
    'vue',
    'vuex',
    'pages/user/store/authStore'
], function (
    Vue,
    Vuex,
    AuthStore
) {

    Vue.use(Vuex);

    return {
        //state: AuthStore,
        created: function () {
            console.info('logout');
            AuthStore.commit('logout');
            this.$router.push('/');
        }
    };

});