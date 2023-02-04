define([
    'vue',
    //'vuex',
    'bootstrapVue',
    //'vueRouter',
    'app/lib/router',
    //'pages/user/store/authStore',
    'app/store/container',
    'text!widgets/navbar/tpl/index.html'
], function (
    Vue,
    //Vuex,
    BootstrapVue,
    //VueRouter,
    router,
    //AuthStore,
    containerStore,
    template
) {

    //Vue.use(Vuex);
    //Vue.use(i18next);
    //Vue.use(VueRouter);
    Vue.use(BootstrapVue);

    new Vue({
        el: "#app-navbar",
        router: router,
        template: template,
        created: function () {
            //console.info('navbar created');
        },
        computed: {
            user: function () {
                return containerStore.auth.state.user;
            }
        }
    });

});