define([
    'vue',
    'vuex',
    'vueRouter',
    'config/router'
], function (
    Vue,
    Vuex,
    VueRouter,
    routerConfig
) {

    Vue.use(VueRouter);

    // Создаём экземпляр маршрутизатора
    return new VueRouter(routerConfig);

});