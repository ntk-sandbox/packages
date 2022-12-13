define([
    'jrails/rest/client',
    'pages/user/store/authStore',
    'pages/user/api/authApi'
], function (
    Client,
    AuthStore,
    AuthApi
) {

    return {
        auth: function (form) {
            var promiseCallback = function (resolve, reject) {
                AuthApi.getTokenByAuthForm(form).then(function (token) {
                    AuthApi.getUserInfoByToken(token).then(function (subResponse) {
                        var user = subResponse;
                        user.username = user.login;
                        user.token = token;
                        AuthStore.commit('auth', user);
                        //info('auth success', user);
                        resolve(user);
                    }).catch(function (subResponse) {

                    });
                }).catch(function (jqXHR) {
                    if(jqXHR.status === 422) {
                        reject(jqXHR.responseJSON);
                        //console.info(jqXHR.responseJSON);
                    }
                });
            };
            return new Promise(promiseCallback);
        },
        logout: function () {

        }
    };

});