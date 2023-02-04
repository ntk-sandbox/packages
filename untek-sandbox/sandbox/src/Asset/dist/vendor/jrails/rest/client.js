define([
    'lodash',
    'jquery',
    'jrails/event/eventService',
    'pages/user/store/authStore',
    'axios'
], function (
    lodash,
    $,
    EventService,
    AuthStore,
    axios
) {

    var helper = {

        prepareRequestAuthorization: function (request) {
            var token = null;
            if(AuthStore.getters.getUser !== null) {
                token = AuthStore.getters.getUser.token
            }
            //dd();
            //var token = container.authService.getToken();
            //var token = 'werty';
            if (token) {
                request.headers.Authorization = token;
            }
        },

        getResponseHeaders: function (jqXHR) {
            var result = {};
            jqXHR.responseHeaders = {};
            var headers = jqXHR.getAllResponseHeaders();
            headers = headers.split("\n");
            headers.forEach(function (header) {
                header = header.split(":");
                var key = header.shift().trim();
                if (key.length === 0) return;
                // chrome60+ force lowercase, other browsers can be different
                key = key.toLowerCase();
                result[key] = header.join(":");
            });
            return result;
        }

    };

    return {

        baseUrl: null,

        __construct: function (params) {
            if (_.isEmpty(params.baseUrl)) {
                throw 'bundle.rest.client.__construct: baseUrl param not defined';
            }
            this.baseUrl = params.baseUrl;
        },

        get: function (url, query, headers) {
            var request = {
                url: url,
            };

            if (query) {
                request.data = _.defaultTo(query, {});
            }

            if (headers) {
                request.headers = _.defaultTo(headers, {});
            }

            //return axios.get(url, {Auth: 'qwqwqwq'});

            return this.sendRequest(request);
        },

        post: function (url, data, headers) {
            var request = {
                url: url,
                type: 'POST',
                data: data,
            };
            if (headers) {
                request.headers = _.defaultTo(headers, {});
            }
            return this.sendRequest(request);
        },

        put: function (url, data, headers) {
            var request = {
                url: url,
                type: 'PUT',
                data: data,
            };
            if (headers) {
                request.headers = _.defaultTo(headers, {});
            }
            return this.sendRequest(request);
        },

        del: function (url, query, headers) {
            var request = {
                url: url,
                type: 'DELETE',
            };
            if (headers) {
                request.headers = _.defaultTo(headers, {});
            }
            return this.sendRequest(request);
        },

        /*setBaseUrl: function (baseUrl) {
            this.baseUrl = baseUrl;
        },*/

        sendRequest: function (requestSource) {
            var request = _.clone(requestSource);
            this.prepareRequest(request);
            dd(request);
            var promiseCallback = function (resolve, reject) {
                request.success = function (data, textStatus, jqXHR) {
                    var response = {
                        status: jqXHR.status,
                        content: jqXHR.responseText,
                        data: jqXHR.responseJSON,
                        //headers: jqXHR.getAllResponseHeaders(),
                        xhr: jqXHR,
                    };

                    resolve(response);
                    //EventService.trigger('api.request.send.success', jqXHR);
                };
                request.error = function (jqXHR, textStatus, errorThrown) {
                    //EventService.trigger('api.request.send.error', jqXHR);
                    reject(jqXHR);
                };
                $.ajax(request);
            };
            return new Promise(promiseCallback);
        },

        prepareRequest: function (request) {
            request.headers = _.defaultTo(request.headers, {});
            request.data = _.defaultTo(request.data, {});
            //this.prepareRequestUrl(request);
            helper.prepareRequestAuthorization(request);
        },

        prepareRequestUrl: function (request) {
            request.url = this.baseUrl + '/' + request.url;
        },

        /**
         * Полученние сообщения об ошибке
         * @param response {*}
         * @returns {string}
         */
        getErrorMessage: function (response) {
            var msg = '';
            if (response.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (response.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (response.status == 500) {
                msg = 'Internal Server Error [500].';
            } else {
                msg = 'Uncaught Error.\n' + response.responseText;
            }
            return msg;
        },

    };

});