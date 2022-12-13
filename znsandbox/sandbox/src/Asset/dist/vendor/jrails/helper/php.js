define([], function() {

    /**
     * Аналоги функций из PHP SPL
     */
    return {

        /**
         * Является ли целым числом
         * @param data
         */
        is_int: function (data) {
            return data === parseInt(data, 10);
        },

        /**
         * содержится ли ключ в объекте
         * @param key
         * @param array
         * @returns {number}
         */
        in_array: function (key, array) {
            return $.inArray(key, array) !== -1 ? 1 : 0;
        },

        /**
         * Получить тип данных
         * @param value
         * @returns {string}
         */
        get_type: function (value) {
            var type = null;
            if(this.is_function(value)) {
                return 'function';
            }
            if(this.is_object(value)) {
                return 'object';
            }
            if(this.is_array(value)) {
                return 'array';
            }
        },

        /**
         * Является ли функцией или методом
         * @param value
         * @returns {boolean}
         */
        is_function: function (value) {
            return typeof value === "function";
        },

        /**
         * Является ли объектом
         * @param value
         * @returns {boolean}
         */
        is_object: function (value) {
            if (value instanceof Array) {
                return false;
            } else {
                return (value !== null) && (typeof(value) === 'object');
            }
        },

        /**
         * Назначено ли значение
         * @param value
         * @returns {boolean}
         */
        isset: function (value) {
            //return element.length > 0;
            return typeof(value) !== "undefined" && value !== null;
        },

        /**
         * Является ли пустым
         * @param value
         * @returns {boolean|*}
         */
        empty: function (value) {
            if(typeof value === "undefined") {
                return true;
            }
            return (value === "" || value === 0 || value === "0" || value === null || value === false || (this.is_array(value) && value.length === 0));
        },

        /**
         * Является ли массивом
         * @param value
         * @returns {boolean}
         */
        is_array: function (value) {
            return (value instanceof Array);
        },

        /**
         * Существует ли метод в объекте
         * @param object
         * @param method
         * @returns {boolean}
         */
        method_exists: function (object, method) {
            return typeof object[method] === 'function';
        },
    };

});