define(['lodash', 'jrails/helper/php'], function(_, PhpHelper) {

    /**
     * Работа с событиями
     */
    return {

        handlers: {},
        holdList: {},

        /**
         * Регистрация обработчика события
         *
         * @param eventName {String|Array} имя события или массив имен
         * @param handler обработчик (функция или класс с методом "run")
         */
        registerHandler: function(eventName, handler) {
            if(_.isArray(eventName)) {
                for(var k in eventName) {
                    var eventNameItem = eventName[k];
                    this.registerHandler(eventNameItem, handler);
                }
            }
            this._initEventArray(eventName);
            this.handlers[eventName].push(handler);
            console.info('Register handler (' + PhpHelper.get_type(handler) + ') for event "' + eventName + '"');
        },

        /**
         * Удаление обработчика события
         *
         * @param eventName имя события
         * @param handler обработчик (функция или класс с методом "run")
         */
        removeHandler: function(eventName, handler) {
            this._initEventArray(eventName);
            var isRemoved = bundle.helper.array.removeByValue(this.handlers[eventName], handler);
            if(isRemoved) {
                console.info('Remove handler for event "' + eventName + '"');
            }
        },

        /**
         * Отключить обработку события
         *
         * @param eventName имя события
         */
        hold: function(eventName) {
            this.holdList[eventName] = true;
        },

        /**
         * Включить обработку события
         *
         * @param eventName имя события
         */
        unHold: function(eventName) {
            this.holdList[eventName] = false;
        },

        /**
         * Отключена ли обработка события
         *
         * @param eventName имя события
         * @returns {boolean}
         */
        isHold: function(eventName) {
            return ! _.isEmpty(this.holdList[eventName]);
        },

        /**
         * Вызов события
         *
         * @param eventName имя события
         * @param params параметры события
         */
        trigger: function(eventName, params) {
            if(this.isHold(eventName)) {
                console.info('Event "' + eventName + '" is hold!');
                return;
            }
            this._initEventArray(eventName);
            var handlers = this.handlers[eventName];
            this._runHandlersForEvent(eventName, handlers, params);
        },

        _initEventArray: function(eventName) {
            if(!PhpHelper.isset(this.handlers[eventName])) {
                this.handlers[eventName] = [];
            }
        },

        _runHandlersForEvent: function (eventName, handlers, params) {
            if(PhpHelper.empty(handlers)) {
                console.info('Not found handlers for event "' + eventName + '"');
                return;
            }

            var self = this;
            handlers.forEach(function(handler) {
                self._runHandler(eventName, handler, params);
            });

            /*for (var key in handlers) {
                var handler = handlers[key];
                this._run(handler, params);
            }*/
        },
        _runHandler: function (eventName, handler, params) {
            if(PhpHelper.is_object(handler)) {
                handler.run(params);
                console.info('Run handler (object) for event "' + eventName + '"');
            } else if(PhpHelper.is_function(handler)) {
                handler(params);
                console.info('Run handler (function) for event "' + eventName + '"');
            }
        }
    };

});