define([], function() {

    /**
     * Логер
     * @deprecated
     */
    return {
        config: {},

        /**
         * Печатать инфо в консоль
         * @param value
         */
        info: function (value) {
            window.console.info(value);
        },

        /**
         * Печатать данные в консоль
         * @param value
         */
        dump: function (value) {
            window.console.log(value);
        },
    };

});