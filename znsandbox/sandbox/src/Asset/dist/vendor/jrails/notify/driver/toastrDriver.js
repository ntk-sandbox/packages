define(['lodash', 'toastr'], function(_, toastr) {

    /**
     * Драйвер уведомлений для вендора toastr
     */
    return {

        options: {},

        /**
         * Показать сообщение любого типа
         * @param entity сущность уведомления
         */
        show: function (entity) {
            entity.options = _.defaultTo(entity.options, this.options);
            if( ! _.isObject(toastr)) {
                console.info('Notify driver not defined!');
                return;
            }
            var method = toastr[entity.type];
            method(entity.message, entity.options);
        },

    };

});