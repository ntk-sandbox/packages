define([], function() {

    /**
     * Виджет для табов
     */
    $.widget( "legalbet.tabsWidget", {

        /** Имя выделенного пункта */
        selected: null,
        /** Выделенный пункт */
        selectedItem: null,
        /** Массив пунктов */
        items: null,

        // Здесь задается список настроек и их значений по умолчанию
        options: {
            /** Селектор для пунктов */
            childSelector: null,
            /** Имя выделенного пункта */
            selected: null,
            /** Массив переопределений методов */
            override: {}
        },

        /**
         * Получить имя пункта
         *
         * @param it пункт
         * @returns {*}
         */
        _getName: function(it) {
            var item = $(it);
            var name = item.attr('name');
            name = this.prepareValue(name);
            return name;
        },

        /**
         * Вызов события клика
         *
         * @param item на каком пункте кликнули
         * @param force принудительно переключить выделение
         */
        triggerClick: function(item, force) {
            var it = this._forgeItem(item);
            var name = this._getName(it);
            var event = {
                name: name,
                item: item
            };
            bundle.helper.jqueryUi.eventTrigger(this, 'click', event);
            this.triggerChange(it, force);
        },

        /**
         * Вызов события переключения
         *
         * @param item на какой пункт переключили
         * @param force принудительно переключить выделение (даже если уже выделен)
         */
        triggerChange: function(item, force) {
            var name = this._getName(item);
            if(this.selected === name && _.isEmpty(force)) {
                return;
            }
            this.selectItem(name);
            var event = {
                name: name,
                item: item
            };
            bundle.helper.jqueryUi.eventTrigger(this, 'change', event);
        },

        /**
         * Приведение имени к нужному виду (типизации)
         *
         * @param name имя пункта
         * @returns {*}
         */
        prepareValue: function(name) {
            return name;
        },

        /**
         * Выделение пункта
         *
         * @param name имя пункта, который хотим выделить
         */
        selectItem: function(name) {
            name = this.prepareValue(name);
            if(this.selected === name) {
                return false;
            }
            this._resetActive();
            var plugin = this;
            this.items.each(function () {
                var item = $(this);
                var currentName = plugin._getName(item);
                currentName = plugin.prepareValue(currentName);
                if(currentName === name) {
                    item.addClass('active');
                    plugin.selected = currentName;
                    plugin.selectedItem = item;
                }
            });
        },

        /**
         * Функция, вызываемая при активации виджета на пункте
         */
        _create: function() {
            if( ! _.isEmpty(this.options.override)) {
                var keys = _.keys(this.options.override);
                for(var k in keys) {
                    var key = keys[k];
                    this[key] = this.options.override[key];
                }
            }
            this._initItems();
            this._registerHandlers();
            //console.log(this.items);
            if(this.options.selected != null) {
                this.selectItem(this.options.selected);
                this.triggerChange($(this.selectedItem), true);
            }
        },

        /**
         * Снять выделение со всех пунктов
         * @private
         */
        _resetActive: function() {
            this.items.each(function () {
                var item = $(this);
                item.removeClass('active');
            });
        },

        /**
         * Является ли нужным пунктом
         *
         * @param it пункт
         * @returns {boolean}
         */
        _isItem: function(it) {
            var item = $(it);
            //var plugin = this;
            var has = false;
            if(item.is(this.options.childSelector)) {
                has = true;
            }
            return has;
        },

        /**
         * Гарантированное получение пункта
         *
         * @param item пункт
         * @returns {jQuery|HTMLElement}
         */
        _forgeItem: function(item) {
            var it = $(item);
            while(!this._isItem(it)) {
                it = item.parent(this.options.childSelector);
            }
            return it;
        },

        /**
         * Инициализация пунктов
         */
        _initItems: function() {
            var plugin = this;
            this.items = this.element.find(this.options.childSelector);
            this.items.each(function (i, el) {
                var item = $(el);
                item.plugin = plugin;
            });
        },

        /**
         * Регмстрация обработчиов события клика
         */
        _registerHandlers: function() {
            var plugin = this;
            this.items.each(function (i, el) {
                var element = $(el);
                element.click(function (event) {
                    var item = $(event.target);
                    //item.widget = plugin;
                    plugin.triggerClick(item);
                    return false;
                });
            });
        }

    });

});
