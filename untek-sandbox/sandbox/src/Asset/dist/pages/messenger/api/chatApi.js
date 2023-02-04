define([
    'jrails/rest/client',
    'config/main'
], function (
    Client,
    mainConfig
) {

    var baseUrl = mainConfig.apiHost + '/api/v1/messenger-chat';

    return {
        all: function () {
            return Client.get(baseUrl, {expand: "members"});
        }
    };

});