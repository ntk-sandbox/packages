define([
    'vue',
    'vuex',
    'text!pages/uiKit/tpl/alert.html'
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
                dismissSecs: 10,
                dismissCountDown: 0,
                showDismissibleAlert: false
            }
        },
        methods: {
            countDownChanged: function(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            showAlert: function() {
                this.dismissCountDown = this.dismissSecs
            }
        }
    };

});