define([
    'jrails/rest/client',
    'config/main'
], function (
    Client,
    mainConfig
) {

    var baseUrl = mainConfig.apiHost + '/api/v1/auth';

    return {
        getTokenByAuthForm: function (form) {
            var promiseCallback = function (resolve, reject) {
                Client.post(baseUrl, form).then(function (response) {
                    var token = response.xhr.getResponseHeader('Authorization');
                    resolve(token);
                }).catch(function (jqXHR) {
                    reject(jqXHR);
                });
            };
            return new Promise(promiseCallback);
        },
        getUserInfoByToken: function (token) {
            var promiseCallback = function (resolve, reject) {
                Client.get(baseUrl, {}, {Authorization: token}).then(function (response) {
                    resolve(response.data);
                }).catch(function (jqXHR) {
                    reject(jqXHR);
                });
            };
            return new Promise(promiseCallback);
        }
    };

});