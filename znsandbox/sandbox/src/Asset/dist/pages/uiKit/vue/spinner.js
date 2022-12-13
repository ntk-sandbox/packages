define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/spinner.html'
], function (
    Vue,
    Vuex,
    template
) {

    Vue.use(Vuex);

    return {
        template: template
    };

});
