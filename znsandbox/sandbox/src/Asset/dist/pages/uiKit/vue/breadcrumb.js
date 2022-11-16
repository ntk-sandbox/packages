define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/breadcrumb.html'
], function (
    Vue,
    Vuex,
    template
) {

    Vue.use(Vuex);

    return {
        template: template,
        data: function() {
            return {
                items: [
                    {
                        text: 'Admin',
                        href: '#'
                    },
                    {
                        text: 'Manage',
                        href: '#'
                    },
                    {
                        text: 'Library',
                        active: true
                    }
                ]
            }
        }
    };

});
