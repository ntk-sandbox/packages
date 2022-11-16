define([], function() {

    /**
     * Визуальные элементы управления (кнопки, поля ввода)
     */
    return {

        id: null,
        instance: null,
        selector: null,

        /**
         * Метод конструктора
         * @param param
         * @private
         */
        __construct: function (param) {
            this.instance = $(this.selector);
            this._registerEvents();

            var self = this;
            this.on('click', function () {

                var elementId = self.instance.attr('id');
                if(bundle.helper.php.empty(elementId)) {
                    elementId = self.id;
                }
                if( ! bundle.helper.php.empty(elementId)) {
                    var event = {
                        target: self.instance,
                    };
                    container.event.trigger('baseElementService.'+elementId+'.click', event);
                }
                return false;

            });
            //dump(this.instance);
        },

        _getId: function() {

        },

        _registerEvents: function() {

        },

        /**
         * Назначить обработчик события
         * @param name имя события
         * @param handler обработчик (функция)
         */
        on: function(name, handler) {
            this.instance.on(name, handler);
        },

        /**
         * Вызвать обработчик события
         * @param name имя события
         */
        trigger: function(name) {
            this.instance.trigger(name);
        },

        /**
         * Показать элемент
         */
        show: function() {
            this.instance.show();
        },

        /**
         * Скрыть элемент
         */
        hide: function() {
            this.instance.hide();
        },

        /**
         * Сделать элемент доступным
         */
        enable: function() {
            this.instance.removeAttr('disabled');
        },

        /**
         * Сделать элемент не доступным
         */
        disable: function() {
            this.instance.attr('disabled','disabled');
        },

    };

});