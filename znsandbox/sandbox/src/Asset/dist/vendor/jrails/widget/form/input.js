/**
 * Дайвера для работы с input-элементами
 */

define([], function() {

    /**
     * Интерфейс драйвера
     */
    return {
        removeValue: function (formInstance, name) {},
        getValue: function (formInstance, name) {},
        setValue: function (formInstance, name, value) {},
    };

});

define([], function() {

    /**
     * Хэлпер
     */
    return {

        getByName: function (formInstance, name) {
            return $(formInstance).find('input[name='+name+']');
        },

        isArrayByName: function (formInstance, name) {
            var input = bundle.widget.form.helper.element.getByName(formInstance, name);
            return input.length > 1;
        },

        setCheckedValue: function (input, value) {
            if(value == 1) {
                input.attr("checked","checked");
            } else {
                input.removeAttr("checked");
            }
        },

    };

});

define([], function() {

    /**
     * Checkbox-элемент
     */
    return {

        removeValue: function (formInstance, name) {
            this.setValue(formInstance, name, []);
        },

        setValue: function (formInstance, name, value) {
            var isArray = bundle.widget.form.helper.element.isArrayByName(formInstance, name);
            if(isArray) {
                this._setListValue(formInstance, name, value);
            } else {
                this._setOneValue(formInstance, name, value);
            }
        },

        getValue: function (formInstance, name) {
            var isArray = bundle.widget.form.helper.element.isArrayByName(formInstance, name);
            var value = null;
            if(isArray) {
                value = this._getListValue(formInstance, name);
            } else {
                value = this._getOneValue(formInstance, name);
            }
            return value;
        },

        _setOneValue: function (formInstance, name, value) {
            var input = bundle.widget.form.helper.element.getByName(formInstance, name);
            bundle.widget.form.helper.element.setCheckedValue(input, value);
        },

        _setListValue: function (formInstance, name, value) {
            $(formInstance).find('input[name=' + name + ']').each(function () {
                var input = $(this);
                var key = input.attr('value');
                //var val = $.inArray(key, value) != -1 ? 1 : 0;
                //var val = _.findIndex(value, key);
                var val = bundle.helper.php.in_array(key, value);
                bundle.widget.form.helper.element.setCheckedValue(input, val);
            });
        },

        _getOneValue: function (formInstance, name) {
            var input = bundle.widget.form.helper.element.getByName(formInstance, name);
            return input.is(":checked") ? 1 : 0;
        },

        _getListValue: function (formInstance, name) {
            var checked = [];
            $(formInstance).find('input[name=' + name + ']:checked').each(function () {
                checked.push($(this).attr('value'));
            });
            return checked;
        },

    };

});

define([], function() {

    /**
     * Radio-элемент
     */
    return {

        removeValue: function (formInstance, name) {
            this.setValue(formInstance, name, undefined);
        },

        getValue: function (formInstance, name) {
            var value = null;
            $(formInstance).find('input[name=' + name + ']:checked').each(function () {
                if ($(this).is(":checked")) {
                    value = $(this).attr('value');
                }
            });
            return value;
        },

        setValue: function (formInstance, name, value) {
            var input = $(formInstance).find('input[name=' + name + ']');
            input.each(function () {
                var input = $(this);
                var inputValue = input.val();
                var isChecked = inputValue == value;
                bundle.widget.form.helper.element.setCheckedValue(input, isChecked);
            });
        },

    };

});

define([], function() {

    /**
     * Text-элемент
     */
    return {

        removeValue: function (formInstance, name) {
            this.setValue(formInstance, name, '');
        },

        getValue: function (formInstance, name) {
            var input = bundle.widget.form.helper.element.getByName(formInstance, name);
            return input.val();
        },

        setValue: function (formInstance, name, value) {
            var input = bundle.widget.form.helper.element.getByName(formInstance, name);
            input.val(value);
        },

    };

});

define([], function() {

    /**
     * Hidden-элемент
     */
    return _.clone(window.bundle.widget.form.input.text);

});

define([], function() {

    /**
     * Number-элемент
     */
    return {

        removeValue: function (formInstance, name) {
            this.setValue(formInstance, name, 0);
        },

        getValue: function (formInstance, name) {
            var input = bundle.widget.form.helper.element.getByName(formInstance, name);
            var value = input.val();
            return Number(value);
        },

        setValue: function (formInstance, name, value) {
            value = parseInt(value);
            var input = bundle.widget.form.helper.element.getByName(formInstance, name);
            input.val(value);
        },

    };

});
