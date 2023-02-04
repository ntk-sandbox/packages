define([], function() {

    /**
     * Работа с ссылками
     */
    return {

        /**
         * Изменить URL страницы без перезагрузки
         * @param url относительный URL
         */
        setUrl: function (url) {
            var state = {};
            var title = '';
            history.pushState(state, title, url);
        },
    };

});