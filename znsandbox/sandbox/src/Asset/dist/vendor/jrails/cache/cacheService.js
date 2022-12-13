define([], function() {

    /**
     * Приватный контейнер для данных
     * @deprecated
     */
    var store = {};

    /**
     * Работа с кешированием данных
     */
    return {

        /**
         * Сохранить данные в кэш
         * @param key ключ
         * @param value данные
         */
        set: function (key, value) {
            var keyString = this.getKey(key);
            store[keyString] = value;
        },

        /**
         * Получить данные из кэша
         * @param key ключ
         * @returns {*}
         */
        get: function (key) {
            var keyString = this.getKey(key);
            return store[keyString];
        },

        /**
         * Существуют ли данные в кеше
         * @param key ключ
         * @returns {boolean}
         */
        has: function (key) {
            var keyString = this.getKey(key);
            return typeof store[keyString] === 'undefined';
        },

        /**
         * Удалить данные из кеша
         * @param key ключ
         */
        remove: function (key) {
            var keyString = this.getKey(key);
            delete store[keyString];
        },

        /**
         * Преобразовать ключ в строку
         * @param key ключ
         * @returns {string}
         */
        getKey: function (key) {
            var cacheKey = JSON.stringify(key);
            return cacheKey;
        },

    };

});