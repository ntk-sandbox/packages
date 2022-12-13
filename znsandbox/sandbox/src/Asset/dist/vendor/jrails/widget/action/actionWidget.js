define([], function() {

    $.widget( "legalbet.actionWidget", {

        id: null,
        instance: null,

        // Здесь задается список настроек и их значений по умолчанию
        options: {
            id: null,
        },

        // Функция, вызываемая при активации виджета на элементе
        _create: function() {
            this.instance = $(this.element);
            this._registerEvents();
        },

        _getId: function () {
            var elementId = this.instance.attr('id');
            if(bundle.helper.php.empty(elementId)) {
                elementId = this.options.id;
            }
            return elementId;
        },

        _registerEvents: function() {
            var self = this;
            var onClick = function () {
                var elementId = self._getId();
                if( ! bundle.helper.php.empty(elementId)) {
                    var event = {
                        target: self.instance,
                    };
                    container.event.trigger('baseElementService.'+elementId+'.click', event);
                }
                return false;
            };
            this.instance.on('click', onClick);
        },

    });

});
