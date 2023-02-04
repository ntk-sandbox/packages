define([
    'vue',
    'vuex',
    'pages/user/store/authStore'
], function (
    Vue,
    Vuex,
    AuthStore
) {

    return {
        auth: AuthStore
    };

});