
define(['lodash', 'jrails/helper/php'], function(_, phpHelper) {

    /**
     * Работа с классами
     */
    return {

        /**
         * Выполнить метод в массиве классов поочередно
         *
         * @param classes массив классов
         * @param method имя вызываемого метода
         * @param params параметры вызываемого метода
         */
        callMethodInClasses: function(classes, method, params) {
            var keys = _.keys(classes);
            for(var i in keys) {
                var key = keys[i];
                var controller = classes[key];
                controller[method](params);
            }
        },

        /**
         * Получить методы объекта
         *
         * @param object
         * @returns {[]}
         * @deprecated use _.functions
         */
        getMethods: function(object) {
            var methods = [];
            var keys = _.keys(object);
            for(var key in keys) {
                var item = keys[key];
                if(bundle.helper.php.is_function(object[item])) {
                    methods.push(item);
                }
            }
            return methods;
        },

        /**
         * Получить публичные методы объекта
         *
         * @param object
         * @returns {[]}
         */
        getPublicMethods: function(object) {
            var methods = [];
            var allMethods = _.functions(object);
            for(var key in allMethods) {
                var method = allMethods[key];
                if(method[0] !== '_') {
                    methods.push(method);
                }
            }
            return methods;
        },

        /**
         * Наследование объекта от родительского
         *
         * @param parent объект родитель
         * @param newClass объект потомок
         * @returns {*}
         */
        extends: function (parent, newClass, interfaceClass) {
            var instance = _.clone(parent);
            instance = _.assign(instance, newClass);
            if(interfaceClass !== undefined) {
                this.checkInterface(instance, interfaceClass);
            }
            //bundle.helper.class.setAttributes(instance, newClass);
            //instance.parent = parent;
            return instance;
        },

        /**
         * Проверка принадлежности объекта к интерфейсу.
         *
         * Если проверяемом объекте описаны не все методы из интерфейса,
         * то вызывается исключение.
         *
         * @param object
         * @param interfaceClass
         * @return {boolean}
         * @throws
         */
        checkInterface: function (object, interfaceClass) {
            var difference = this.checkInterfaceDiff(object, interfaceClass);
            if( ! _.isEmpty(difference)) {
                var message = 'Methods "' + difference.join(', ') + '" not found!';
                throw message;
            }
            return true;
        },

        /**
         * Получение списка недостающих методов.
         *
         * Если все методы, описанные в интерфейсе присутствуют,
         * то возвращается пустой массив.
         *
         * @param object проверяемый объект
         * @param interfaceClass интерфейс
         * @return {Array}
         */
        checkInterfaceDiff: function (object, interfaceClass) {
            if( ! _.isObject(object)) {
                throw 'Source class is not object!';
            }
            if( ! _.isObject(interfaceClass)) {
                throw 'Interface is not object!';
            }
            var methodNames = _.functions(interfaceClass);
            var difference = _.difference(methodNames, _.functions(object));
            return difference;
        },

        /**
         * Проверка принадлежности объекта к интерфейсу
         *
         * @param object проверяемый объект
         * @param interfaceClass интерфейс
         * @returns {boolean}
         */
        isInstanceOf: function (object, interfaceClass) {
            var difference = this.checkInterfaceDiff(object, interfaceClass);
            return _.isEmpty(difference);
        },

        /**
         * Создать новый экземляр объекта
         *
         * @param className класс
         * @param attributes назначаемые атрибуты
         * @param params параметры, передаваемые конструктору объекта
         * @returns {*}
         */
        create: function (className, attributes, params) {
            var instance = _.clone(className);
            instance = _.assign(instance, attributes);
            //bundle.helper.class.setAttributes(instance, attributes);
            this.callConstructor(instance, params);
            return instance;
        },

        /**
         * Создать новый экземляр объекта
         *
         * @param className класс
         * @param params параметры, передаваемые конструктору объекта
         * @returns {*}
         */
        createInstance: function(className, params) {
            var instance = _.clone(className);
            this.callConstructor(instance, params);
            return instance;
        },

        /**
         * Клонировать объект
         *
         * @param className
         * @returns {*}
         */
        /*clone: function(className) {
            return _.clone(className);
        },*/

        /**
         * Присвоить объекту атрибуты
         *
         * @param instance
         * @param attributes
         */
        setAttributes: function(instance, attributes) {
            return  _.assign(instance, attributes);
            /*if (typeof attributes === 'object') {
                for (var k in attributes) {
                    instance[k] = attributes[k];
                }
            }*/
        },

        /**
         * Вызвать метод конструктора объекта
         *
         * @param instance
         * @param params
         */
        callConstructor: function(instance, params) {
            if(phpHelper.method_exists(instance, '__construct')) {
                instance.__construct(params);
            }
        },
    };

});