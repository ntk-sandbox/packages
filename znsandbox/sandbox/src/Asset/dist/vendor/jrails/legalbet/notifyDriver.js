define([], function() {

    /**
     * Драйвер уведомлений для Legalbet
     */
    return {

        options: {},

        /**
         * Показать сообщение любого типа
         * @param entity сущность уведомления
         */
        show: function (entity) {
            intel.notify({
                status: entity.type,
                text: entity.message,
            });
        },

    };

});