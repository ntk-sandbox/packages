define([
    'vue',
    'pages/user/service/authService',
    'text!pages/user/tpl/auth.html',
    'jrails/rest/formHelper'
], function (
    Vue,
    AuthService,
    template,
    formHelper
) {

    return {
        template: template,
        data: function () {
            return {
                entity: {},
                errors: {}
            };
        },
        methods: {
            auth: function () {
                var that = this;
                AuthService.auth(this.entity).then(function (value) {
                    that.$router.push('/');
                }).catch(function (errors) {
                    that.errors = formHelper.setErrors(errors)
                });
            }
        }
    };

});
