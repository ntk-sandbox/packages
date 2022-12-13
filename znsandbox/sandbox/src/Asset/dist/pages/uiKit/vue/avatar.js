define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/avatar.html'
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
