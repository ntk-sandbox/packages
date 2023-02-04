define([], function() {

    /**
     * Базовый класс модуля
     */
    return {

        controllerNamespace: null,

        /**
         * Инициализация контроллеров
         */
        initControllers: function () {
            bundle.helper.class.callMethodInClasses(this.controllerNamespace, 'init');
        },

    };

});