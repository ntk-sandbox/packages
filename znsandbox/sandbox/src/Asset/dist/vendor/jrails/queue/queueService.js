define([], function() {

    /**
     * Базовый класс очередей
     * @deprecated
     */
    return {
        collection: [],

        /**
         * Добавить команду в очередь
         * @param command объект команды с методом "run"
         * @param params параметры команды
         */
        add: function(command, params) {

        },

        /**
         * Выполнить стек команд
         */
        run: function() {

        },
    };

});