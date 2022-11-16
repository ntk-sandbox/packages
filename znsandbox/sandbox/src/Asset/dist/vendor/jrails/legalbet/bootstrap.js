define([], function() {

    /**
     * Ядро приложения
     *
     * Запускается 1 раз при запуске приложения
     *
     * Todo: переименовать в bundle.legalbet.bootstrap
     */
    return {

        /**
         * Регистрация сервисов в контейнере
         */
        initContainer: function () {
            //container.cache = bundle.cache.cacheService;
            container.event = bundle.event.eventService;
            container.notify = bundle.notify.notifyService;
            //container.queue = bundle.queue.queueService;
            container.loader = container.instance(bundle.ui.baseElementService, {
                selector: '.js-loader',
            });
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
            bundle.kernel.bootstrap.run(params);
            this.initContainer();
            this.initConfig();
            console.info('legalbet kernel launch');
        }
    };

});