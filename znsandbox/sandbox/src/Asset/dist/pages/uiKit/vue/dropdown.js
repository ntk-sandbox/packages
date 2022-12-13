define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/dropdown.html'
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
