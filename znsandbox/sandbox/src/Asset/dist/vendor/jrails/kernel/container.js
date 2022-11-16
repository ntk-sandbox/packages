define(['lodash', 'jrails/helper/class'], function(_, classHelper) {

    /**
     * Контейнер
     */
    window.container = {
        /**
         * Создать экземпляр объекта
         *
         * @param className класс
         * @param attributes назначаемые атрибуты
         * @param params параметры конструктора
         * @returns {Object}
         */
        instance: function (className, attributes, params) {
            if(_.isString(className)) {
                className = require([className]);
            }
            return classHelper.create(className, attributes, params);
        },

        /**
         * Объявлен ли класс в контейнере
         *
         * @param className
         * @returns {Boolean}
         */
        has: function (className) {
            return bundle.kernel.loader.isDefined(className, this);
        },

    };

    return window.container;

});