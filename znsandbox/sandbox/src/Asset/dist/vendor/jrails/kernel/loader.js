define(function() {

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