requirejs.config({
    urlArgs: 'bust=' + (new Date()).getTime(), // отмена кэширования скриптов браузером
    baseUrl: '/rjs',
    paths: {
        // apiDriver: 'app/lib/apiDriver',
        messenger: 'pages/messenger2',
        jrails: 'vendor/jrails',
        jquery: 'vendor/jquery3/jquery.min',
        text: 'vendor/text/text',
        axios: 'vendor/axios.min',
        bootstrap: 'vendor/bootstrap4/bootstrap.bundle.min',
        backbone: 'vendor/backbone.min',
        underscore: 'vendor/underscore.min',
        lodash: 'vendor/lodash/lodash.min',
        storage: 'vendor/jstorage',
        json: 'vendor/json2',
        jszip: 'vendor/jszip/jszip',
        toastr: 'vendor/toastr/toastr.min',
        'crypto-js': 'vendor/crypto-js/crypto-js',
        jsencrypt: 'vendor/jsencrypt/jsencrypt',
        restClient: 'vendor/jrails/rest/clientAxiosDriver',
        //popper: 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',

        director: 'vendor/director/director.min',
        redux: 'vendor/redux/redux.min',
        vue: 'vendor/vue/vue.min',
        vueRouter: 'vendor/vue-router/vue-router',
        vuex: 'vendor/vuex/vuex',
        i18next: 'https://cdnjs.cloudflare.com/ajax/libs/i18next/19.6.0/i18next.min',
        bootstrapVue: 'vendor/bootstrap-vue/bootstrap-vue',
        polyfill: 'vendor/polyfill/polyfill.min',
        'jquery-ui': 'vendor/jquery-ui/jquery-ui.min'
    },
    shim: {
        'director': {
            exports: 'Router'
        },
        'underscore': {
            exports: '_'
        },
        'lodash': {
            exports: '_'
        },
        'backbone': {
            deps: ['underscore', 'jquery'],
            exports: 'Backbone'
        },
        'json': {
            exports: 'JSON'
        },
        'axios': {
            exports: 'axios'
        },
        'storage': {
            deps: ['json', 'jquery']
        },
        'vue': {
            exports: 'Vue'
        },
        'vuex': {
            exports: 'Vuex',
            deps: ['vue']
        },
        'i18next': {
            exports: 'NextI18Next'
        },
        'vueRouter': {
            exports: 'VueRouter',
            deps: ['vue']
        },
        'bootstrapVue': {
            deps: ['vue']
        },
        bootstrap: {
            deps: ['jquery']
        }
    },
    deps: [
        'app/init'
    ]
});
