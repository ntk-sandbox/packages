/**
 * Работа с пространствами имен
 *
 * Можно объявлять, получать пространства.
 * Пространства имен нужны для иерархичного расположения кода.
 * Есть бандл, это самодостаточный модуль, который содержит в себе все неоходимое для своей работы.
 * В бандле могут распологаться хэлперы, сервисы, хранилища, виджеты, драйвера...
 * В плоском списке содержать разные типы классов неудобно,
 * но можно легко выстроить иерархию, например:
 * - user
 *     - service
 *         - authService
 *         - registrationService
 *         - personService
 *     - helper
 *         - loginHelper
 *         - tokenHelper
 *     - store
 *         - identityStore
 *         - personStore
 *     - widget
 *         - avatarWidget
 * - notify
 *     - service
 *         - notifyService
 *     - driver
 *         - sms
 *             - smscDriver
 *             - a1Driver
 *             - beelineDriver
 *         - notify
 *             - pushDriver
 *             - socketDriver
 *             - firebaseDriver
 *
 * `user` и `notify` - это бандлы.
 *
 * notify.driver.sms.beelineDriver - это полное имя класса драйвера для отправки СМС через Beeline
 * 
 * Аналог "use" из PHP:
 *     var ArrayHelper = bundle.helper.array;
 *
 * Получить любой класс можно так:
 *     namespace.get('bundle.helper.url').setUrl('?post=123');
 * Для прозрачности кода, лучше обращаться к классам явно:
 *     bundle.helper.url.setUrl('?post=123');
 * Составные части:
 *     bundle.helper.url - полное имя класса
 *     bundle.helper - пространство имен
 *     setUrl - метод класса
 */

(function() {

    var registry = {
        isDomLoaded: false,
        classList: {},
        onDomLoaded: function (func) {

            var callback = function () {
                var classDefinition = func();
                if(_.isObject(classDefinition) && _.isFunction(classDefinition._onLoad)) {
                    classDefinition._onLoad();
                }
            };

            if(this.isDomLoaded) {
                callback();
            } else {
                document.addEventListener('DOMContentLoaded', callback);
            }
        },
        onWindowLoad: function() {
            registry.isDomLoaded = true;
            //console.log(registry.classList);
        },
        use: function (className) {
            var func = _.get(registry.classList, className);
            if(_.isFunction(func)) {
                func = func();
                _.set(registry.classList, className, func);
            }
            return func;
        },
        define: function (funcOrClassName, func) {
            if(_.isFunction(funcOrClassName)) {
                registry.onDomLoaded(funcOrClassName);
            } else if(_.isString(funcOrClassName) && _.isFunction(func)) {
                registry.onDomLoaded(function() {
                    //var args = [];
                    //var classDefinition = func.apply({}, args);
                    var classDefinition = func();
                    //classList[funcOrClassName] = classDefinition;
                    _.set(window, funcOrClassName, classDefinition);
                    _.set(registry.classList, funcOrClassName, classDefinition);
                });

            }

            //registry.classList[funcOrClassName] = func;
        },
    };

    window.addEventListener('load', registry.onWindowLoad);
    window.use = registry.use;
    window.space = registry.define;

})();

define([], function() {

    var store = {
        loaded: {},
        aliases: {},
    };

    var helper = {
        isDefined: function (namespaceArray, object) {
            for (var key in namespaceArray) {
                var item = namespaceArray[key];
                if (typeof object[item] === "object") {
                    object = object[item];
                } else if(typeof object[item] === "undefined") {
                    return false;
                }
            }
            return true;
        },
        define: function (namespaceArray, object, value) {
            for (var key in namespaceArray) {
                var item = namespaceArray[key];
                if (typeof object[item] !== "object") {
                    object[item] = {};
                }
                object = object[item];
            }
            object = value;
        },
        forgeNamespaceRecursive: function (namespaceArray, object) {
            for (var key in namespaceArray) {
                var item = namespaceArray[key];
                if (typeof object[item] !== "object") {
                    object[item] = {};
                }
                object = object[item];
            }
            return object;
        },

        /**
         * Получить значение по пути
         * @param namespace
         * @returns {*}
         */
        get: function(namespace) {
            //namespace = this.getAlias(namespace);
            var arr = namespace.split('.');
            return helper.forgeNamespaceRecursive(arr, window);
        },

    };

    return {
        /**
         * Объявлено ли пространство имен
         * @param path путь
         * @param value в каком значении искать
         * @returns {*|boolean}
         */
        isDefined: function(path, value) {
            //path = this.getAlias(path);
            value = value === undefined ? window : value;
            //value = bundle.helper.value.default(value, window);
            var arr = path.split('.');
            return helper.isDefined(arr, value);
        },
        _getAlias: function (className) {
            for(var i in store.aliases) {
                var from = i;
                var to = store.aliases[i];
                var isMatch = className.indexOf(from + '.') === 0;
                if(isMatch) {
                    return {
                        from: from,
                        to: to,
                    };
                }
            }
            return false;
        },

        setAlias: function (from, to) {
            store.aliases[from] = to;
        },

        getAlias: function (className) {
            var alias = this._getAlias(className);
            if(alias) {
                className = alias.to + className.substr(alias.from.length);
            }
            return className;
        },

        requireClasses: function(classesNameSource, callback) {
            for(var k in classesNameSource) {
                var className = classesNameSource[k];
                this.requireClass(className);
            }
        },

        requireClass: function(classNameSource, callback) {
            var className = classNameSource;
            callback = _.defaultTo(callback, function () {});
            if(this.isDefined(className)) {
                callback();
                return className;
            }
            className = this.getAlias(className);
            if(this.isDefined(className)) {
                callback();
                return className;
            }
            var scriptClassArr = className.split('.');
            var scriptUrl = '/' + scriptClassArr.join('/') + '.js';
            if(store.loaded[scriptUrl] === true) {
                callback();
                return className;
            }
            this.requireScript(scriptUrl, callback);
            store.loaded[scriptUrl] = true;
            console.info('Script loaded "' + scriptUrl + '"!');
            return helper.get(classNameSource);
        },

        requireScript: function(url, callback) {
            jQuery.ajax({
                url: url,
                dataType: 'script',
                complete: callback,
                async: true
            });
            //$('body').append('<script src="' + url + '"></script>');
        },

    };

});
