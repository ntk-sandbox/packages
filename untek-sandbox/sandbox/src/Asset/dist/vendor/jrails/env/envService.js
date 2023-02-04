define([], function() {

    var config = {};

    /**
     * Режим окружения
     * @deprecated
     */
    return {

        /**
         * Является ли режимом для разработки
         * @returns {boolean}
         */
        isDev: function () {
            return this.getMode() === bundle.env.envEnum.develop;
        },

        /**
         * Является ли боевым режимом
         * @returns {boolean}
         */
        isProd: function () {
            return this.getMode() === bundle.env.envEnum.production;
        },

        /**
         * Является ли тестовым режимом
         * @returns {boolean}
         */
        isTest: function () {
            return this.getMode() === bundle.env.envEnum.test;
        },

        /**
         * Установлен ли данный режим
         * @returns boolean
         */
        isMode: function (mode) {
            return this.getMode() === mode;
        },

        /**
         * Получить текущий режим
         * @returns {*}
         */
        getMode: function () {
            return bundle.helper.value.default(config.mode, bundle.env.envEnum.develop);
        },

        /**
         * Установить текущий режим
         * @param mode режим (см. список режимов тут - bundle.env.envEnum)
         */
        setMode: function (mode) {
            config.mode = mode;
        },
    };

});