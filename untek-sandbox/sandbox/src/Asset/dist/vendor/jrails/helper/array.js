define([], function() {

    /**
     * Работа с массивами и объектами
     */
    return {

        /**
         * Получить уникальные ключи объекта
         * @param keyList
         * @returns {*}
         */
        uniqueFilter: function(keyList) {
            keyList = keyList.filter(function(itm, i, a) {
                return i == a.indexOf(itm);
            });
            return keyList;
        },

        /**
         * Удалить значение из массива
         * @param arr
         * @param value
         * @returns {boolean}
         */
        removeByValue: function(arr, value) {
            var index = arr.indexOf(value);
            if (index >= 0) {
                arr.splice( index, 1 );
                return true;
            }
            return false;
        },

        /**
         * Получить ключи объекта
         * @param object
         * @returns {[]}
         * @deprecated use _.keys
         */
        getKeys: function(object) {
            return _.keys(object);
            /*var keys = [];
            for (var k in object) keys.push(k);
            return keys;*/
        },

        /**
         * Слить объекты
         * @param from
         * @param to
         */
        merge: function(from, to) {
            for (var k in from) {
                if(from.hasOwnProperty(k)) {
                    var route = from[k];
                    to.push(route);
                }
            }
        },
    };

});