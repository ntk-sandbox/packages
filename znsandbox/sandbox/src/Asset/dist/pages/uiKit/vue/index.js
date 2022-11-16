define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/index.html'
], function (
    Vue,
    Vuex,
    template
) {

    Vue.use(Vuex);

    return {
        data: function () {
            return {
                items: [
                    {
                        title: 'alert',
                        name: 'alert',
                    },
                    {
                        title: 'avatar',
                        name: 'avatar',
                    },
                    {
                        title: 'breadcrumb',
                        name: 'breadcrumb',
                    },
                    {
                        title: 'dropdown',
                        name: 'dropdown',
                    },
                    {
                        title: 'modal',
                        name: 'modal',
                    },
                    {
                        title: 'toast',
                        name: 'toast',
                    },
                    {
                        title: 'spinner',
                        name: 'spinner',
                    },
                ]
            };
        },
        template: template
    };

});
