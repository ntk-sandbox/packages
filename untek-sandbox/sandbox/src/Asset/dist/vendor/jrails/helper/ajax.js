define([], function() {

    /**
     * Работа с AJAX-запросами
     */
    return {

        errorCallback: function (jqXHR, exception) {
            var msg = window.bundle.helper.ajax.getErrorMessage(jqXHR, exception);
            container.notify.error('Произошла ошибка запроса!' + "<br/>" + msg);
        },

        /**
         * Подготовка запроса
         *
         * По умолчанию, при ошибке запроса,
         * пользователю будет показано всплывающее уведомление с ошибкой
         *
         * @param request объект запроса
         * @returns {*}
         */
        prepareRequest: function(request) {
            var complete = function () {
                //container.loader.hide();
            };
            if(!bundle.helper.php.is_function(request.error)) {
                request.error = this.errorCallback;
            }
            if(!bundle.helper.php.is_function(request.complete)) {
                request.complete = complete;
            }
            request.dataType = bundle.helper.value.default(request.dataType, 'json');
            return request;
        },

        /**
         * Оправить AJAX-запрос с ограничением частоты вызова
         *
         * Отложенная отправка запроса нужна для предотвращения посылки множества бессмысленных запросв
         * и снижения нагрузки на сервер при промежуточных изменениях.
         * Например, при перемещении ползунка, значения инпутов обновляются очень быстро.
         *
         * @param request объект запроса
         * @param groupName имя группы схожих запросов
         * @param interval интервал времени, регулирующий частоту вызовов
         */
        sendAtInterval: function(request, groupName, interval) {
            if(!_.isInteger(interval)) {
                interval = 1000;
            }
            interval = bundle.helper.value.default(interval, 1000);
            var func = function () {
                return bundle.helper.ajax.send(request);
            };
            bundle.helper.func.callAtInterval(groupName, func, interval);
        },

        /**
         * Оправить AJAX-запрос
         * @param request
         * @returns {*}
         */
        send: function(request) {
            //container.loader.show();

            var cloneRequest = _.clone(request);
            this.prepareRequest(cloneRequest);

            var promiseCallback = function(resolve,reject){
                cloneRequest.success = function(data) {
                    if(_.isFunction(request.success)) {
                        request.success(data);
                    }
                    resolve(data);
                };
                cloneRequest.error = function(data) {
                    if(_.isFunction(request.error)) {
                        request.error(data);
                    }
                    reject(data);
                };
                $.ajax(cloneRequest);
            };

            var promise = new Promise(promiseCallback);
            return promise;
        },

        /**
         * Полученние сообщения об ошибке
         * @param jqXHR
         * @param exception
         * @returns {string}
         */
        getErrorMessage: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            return msg;
        },
    };

});