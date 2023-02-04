define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/toast.html'
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

            }
        },
        methods: {
            makeToast: function(variant) {
                this.$bvToast.toast('Toast body content', {
                    title: 'Variant' + (variant || 'default'),
                    variant: variant,
                    solid: true,
                    appendToast: true,
                    noAutoHide: true
                })
            }
        }
    };

});
