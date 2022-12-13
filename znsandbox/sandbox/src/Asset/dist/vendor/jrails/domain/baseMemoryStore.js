define([], function() {

    /**
     * Базовый класс для хранилища состояния в ОЗУ
     */
    return {

        /**
         * Сохранить значение
         * @param key ключ
         * @param value данные
         */
        set: function (key, value) {
            this[key] = value;
        },

        /**
         * Получить значение
         * @param key ключ
         * @returns {*}
         */
        get: function (key) {
            return this[key];
        },

        /**
         * Установлено ли значение
         * @param key ключ
         * @returns {boolean}
         */
        has: function (key) {
            return typeof this[key] === 'undefined';
        },

        /**
         * Удалить значение
         * @param key ключ
         */
        remove: function (key) {
            delete this[key];
        },

    };

});