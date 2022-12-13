define([
    'text!pages/crypto/tpl/handshake.html',
    'jrails/crypto/axios',
    'jrails/crypto/session'
], function (
    template,
    axios,
    Session
) {

    var html = '';

    return {
        template: template,
        data: function() {
            return {
                text: 'hello',
                responseHtml: html
            };
        },
        methods: {
            reset: function() {
                Session.reset();
                this.responseHtml = '';
                html = '';
                info('Session reset success!');
            },
            ping: function() {
                var that = this;
                var message = Math.random().toString(36).slice(-8);
                axios.post('/test', {
                    "text": message
                }).then(function (response) {
                    var resultText = 'FAIL';
                    if(response.data.text === message + '123') {
                        var resultText = 'OK';
                    }
                    html = html + "\n" + resultText;
                    that.responseHtml = html;
                    info(response.data);
                }).catch(function (reason) {
                    html = html + "\n" + 'Error: ' + reason;
                    that.responseHtml = html;
                });
            },
            send: function() {
                var that = this;
                axios.post('/test', {
                    "text": that.text
                }).then(function (response) {
                    html = html + "\n" + JSON.stringify(response.data);
                    that.responseHtml = html;
                    info(response.data);
                }).catch(function (reason) {
                    html = html + "\n" + 'Error: ' + reason;
                    that.responseHtml = html;
                });
            }
        },
        created: function () {

        }
    };

});