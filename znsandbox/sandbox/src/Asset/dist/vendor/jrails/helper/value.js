define([], function() {

    /**
     * Работа с данными
     */
    return {

        /**
         * Получить значение по умолчанию, если значение не назначенное
         * @param value
         * @param defaultValue
         * @returns {*}
         */
        default: function(value, defaultValue) {
            return value === undefined ? defaultValue : value;
        },

        /**
         * Пустое ли значение
         * @param value
         * @returns {boolean}
         */
        isEmpty: function(value) {
            return value !== '' && value !== null && value !== [];
        },

        /**
         * Получить текущее время в виде TIMESTAMP
         * @returns {number}
         */
        nowTimestamp: function() {
            return ( new Date() ).getTime();
        },
        /*createInstance: function(className, params) {
            var instanceArray = FastClone.cloneArray([className]);
            var instance = instanceArray[0];
            this.callConstructor(instance, params);
            return instance;
        },
        setAttributes: function(instance, attributes) {
            if (typeof attributes === 'object') {
                for (var k in attributes) {
                    instance[k] = attributes[k];
                }
            }
        },
        callConstructor: function(instance, params) {
            if(bundle.helper.php.method_exists(instance, '__construct')) {
                instance.__construct(params);
            }
        },*/
    };

});