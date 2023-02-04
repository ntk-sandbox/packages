define('app', function() {

    /**
     * Приватный контейнер для данных
     */
    var store = {
        init: false
    };

    /**
     * Приложение
     * @deprecated
     */
    return {
        config: {},

        /**
         * Запуск приложения
         * @param params
         */
        /*run: function (params) {
            if(this.isInit()) {
                console.error('The application has already been launched!');
                return;
            }
            store.init = true;
            console.info('application launch');
        },*/

        /**
         * Запущено ли приложение
         * @returns {boolean}
         */
        /*isInit: function () {
            return store.init;
        },*/
    };

});