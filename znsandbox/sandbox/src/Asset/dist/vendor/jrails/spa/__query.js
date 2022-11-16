define(function() {

    var store = {};

    return {
        set: function (query) {
            store = _.defaultTo(query, {});
        },
        get: function () {
            return store;
        },
    };

});