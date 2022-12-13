define(['lodash'], function(_) {

    return {

        compileElement: function (moduleElement, params) {
            var template = moduleElement.html();
            var html = this.compile(template, params);
            moduleElement.html(html);
        },

        compile: function (template, params) {
            var templateHtml = bundle.helper.string.unescapeHtml(template);
            return _.template(templateHtml)(params);
        },

    };

});