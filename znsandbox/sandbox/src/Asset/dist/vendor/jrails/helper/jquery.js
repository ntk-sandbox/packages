define([], function() {

    /**
     * Работа с JQuery
     */
    window.bundle.helper.jquery = {

    };

    /**
     * Работа с JQuery UI
     */
    return {

        eventTrigger: function (widget, eventType, data) {
            var names = this.getElementEventNames(widget, eventType);
            names.forEach(function(item) {
                container.event.trigger(item, data);
            });
        },

        getElementEventNames: function (widget, eventType) {
            var elementId = widget.element.attr('id');
            var names = [];
            if(!bundle.helper.php.empty(elementId)) {
                names.push(widget.widgetEventPrefix+'.'+elementId+'.'+eventType);
            }
            names.push(widget.widgetEventPrefix+'.'+eventType);
            return names;
        },

    };

});