define([], function() {

    /**
     * Ядро приложения
     *
     * Запускается 1 раз при запуске приложения
     */
    return {
        /**
         * Регистрация сервисов в контейнере
         */
        initContainer: function () {
            //container.env = bundle.env.envService;
            //container.log = bundle.log.logService;
        },

        /**
         * Конфигурация приложения
         */
        initConfig: function () {
            /** Конфигурация приложения */
        },

        /**
         * Запуск ядра приложения
         * @param params
         */
        run: function (params) {
            this.initContainer();
            this.initConfig();
            console.info('default kernel launch');

            /** Запуск приложения */
            //app.run();
        }
    };

});