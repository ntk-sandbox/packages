jQuery(function ($) {

    var loader = {
        isShow: false,
        getElement: function() {
            return $('#loader');
        },
        show: function () {
            //console.log(window.ajaxLoaderStartTime);
            var ajaxLoaderStartTime = window.ajaxLoaderStartTime ? window.ajaxLoaderStartTime : 80;
            // console.log(ajaxLoaderStartTime);
            this.isShow = true;
            setTimeout(function(){
                loader.set();
            }, ajaxLoaderStartTime);
        },
        hide: function () {
            this.isShow = false;
            this.set();
        },
        set: function () {
            var loaderElement = this.getElement();
            if(this.isShow) {
                loaderElement.html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                loaderElement.removeClass();
                loaderElement.addClass('visible');
            } else {
                // loaderElement.html('');
                loaderElement.removeClass();
                loaderElement.addClass('invisible');
            }
        }
    };

    var view = {
        clickHandler: function () {
            var JElement = $(this);
            var href = JElement.prop('href');
            ajaxClient.sendRequest(href);
            return false;
        },
        isSelfLink: function(href) {
            return href.indexOf(window.location.origin) !== -1;
        },
        isHasAttrs: function(JElement, attrs) {
            for (var key in attrs) {
                var attrName = attrs[key];
                if(JElement.attr(attrName) !== undefined) {
                    return true;
                }
            }
            return false;
        },
        defineLinks: function (element) {
            var links = element.find('a');
            links.each(function (index, element) {
                var JElement = $(element);
                var href = JElement.prop('href');
                var isSelf = view.isSelfLink(href);

                var isDataToggle = view.isHasAttrs(JElement, ['data-toggle', 'data-target']);
                // var isDataToggle = JElement.attr('data-toggle') !== undefined;
                if(isSelf && !isDataToggle) {
                    JElement.click(view.clickHandler);
                }
                if(!isSelf) {
                    JElement.attr('target', '_blank');
                }
            });
        },
        defineForms: function (element) {
            var options = {
                beforeSubmit:  function () {
                    loader.show();
                },  // pre-submit callback
                success:       ajaxClient.responseHandler  // post-submit callback
            };
            // bind form using 'ajaxForm'
            var forms = element.find('form');
            forms.ajaxForm(options);
        },
        define: function (element) {
            this.defineLinks(element);
            this.defineForms(element);
        },
        setHtml: function (id, html) {
            var element = $('#'+id);
            element.html(html);
            this.define(element);
        },
        setHtmlBlocks: function (list) {
            for(var id in list) {
                var html = list[id];
                this.setHtml(id, html);
            }
        },
        init: function () {
            this.define($('body'));
        }
    };

    var ajaxClient = {
        responseHandler: function(data) {
            loader.hide();
            if(data.content !== undefined) {
                view.setHtmlBlocks(data.content);
            }
            if(data.url !== undefined) {
                data.title = data.title !== undefined ? data.title : null;
                history.pushState({}, data.title, data.url);
            }
        },
        sendRequest: function (href, method) {
            loader.show();
            method = typeof method === 'undefined' ? 'get' : method;
            $.ajax({
                url: href,
                method: method,
                success: ajaxClient.responseHandler,
            })/*.done(ajaxClient.responseHandler)*/;
        },
    };

    view.init();

});
