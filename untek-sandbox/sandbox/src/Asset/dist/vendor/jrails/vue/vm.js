define(['lodash', 'vue'], function(_, Vue) {

    var store = {};

    return {

        has: function (key) {
            return ! _.isEmpty(store[key]);
        },

        get: function (key) {
            return store[key];
        },

        set: function (key, definition) {
            store[key] = definition;
        },

        ensure: function (definition) {
            var instance;
            var selector = definition.el;
            if( ! this.has(selector)) {
                instance = new Vue(definition);
                this.set(selector, instance);
            }
            return instance;
        },

    };

});