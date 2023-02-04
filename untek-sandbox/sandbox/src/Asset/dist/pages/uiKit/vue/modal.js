define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/modal.html'
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
