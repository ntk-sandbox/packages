define([], function() {

    $.widget( "legalbet.formWidget", {

        inputs: null,
        resetButton: null,
        showButton: null,

        // Здесь задается список настроек и их значений по умолчанию
        options: {
            inputSelector: 'input',
            values: null,
        },

        triggerChange: function(plugin) {
            //container.event.trigger('filter.change');
            bundle.helper.jqueryUi.eventTrigger(this, 'change', {plugin: this});
            return false;
        },

        setValues: function (values) {
            var nameList = this._getNameList();
            for (var key in nameList) {
                var name = nameList[key];
                var value = values[name];
                if(typeof value === 'undefined') {
                    this.resetValue(name);
                } else {
                    this._setValue(name, value);
                }
            }
        },

        getValue: function (name) {
            var input = bundle.widget.form.helper.element.getByName(this.element, name);
            var type = input.attr('type');
            var driver = this.getDriver(type);
            return driver.getValue(this.element, name);
        },

        resetValues: function () {
            var nameList = this._getNameList();
            for (var index in nameList) {
                var name = nameList[index];
                this.resetValue(name);
            }
        },

        getValues: function () {
            var nameList = this._getNameList();
            var result = {};

            for (var index in nameList) {
                var name = nameList[index];
                var value = this.getValue(name);
                if(bundle.helper.value.isEmpty(value)) {
                    result[name] = value;
                }
            }
            return result;
        },

        resetValue: function (key) {
            var input = bundle.widget.form.helper.element.getByName(this.element, key);
            var type = input.attr('type');
            var driver = this.getDriver(type);
            driver.removeValue(this.element, key);
        },

        _setValue: function (key, value) {
            var input = bundle.widget.form.helper.element.getByName(this.element, key);
            var type = input.attr('type');
            var driver = this.getDriver(type);
            driver.setValue(this.element, key, value);
        },

        // Функция, вызываемая при активации виджета на элементе
        _create: function() {
            this._initInputs();
            //this._initActions();
            this._registerHandlers();
            if(this.options.values) {
                this.setValues(this.options.values);
            }
        },

        _initInputs: function() {
            this.inputs = this.element.find(this.options.inputSelector);
            var plugin = this;
            this.inputs.each(function (i, el) {
                var item = $(el);
                item.widget = plugin;
            });
        },

        _getNameList: function () {
            var nameList = $.map(this.inputs, function(element, index) {
                return $(element).attr('name');
            });
            return bundle.helper.array.uniqueFilter(nameList);
        },

        _registerHandlers: function() {
            var plugin = this;

            this.inputs.each(function (i, el) {
                var element = $(el);
                element.bind('change', function (event) {
                    plugin.triggerChange(plugin);
                    return false;
                });
            });
        },

        hasDriver: function (type) {
            var inputHandlers = bundle.widget.form.input;
            var isExists = !bundle.helper.php.empty(inputHandlers[type]);
            if(!isExists) {
                return false;
            }
            var driver = inputHandlers[type];
            return bundle.helper.class.checkInterface(driver, bundle.widget.form.interface.driver);
        },

        getDriver: function (type) {
            if(!this.hasDriver(type)) {
                console.error('Driver "bundle.widget.form.input.' + type + '" not found!');
            } else {
                return bundle.widget.form.input[type];
            }
        },

    });

});