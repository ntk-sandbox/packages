define([
    'jrails/rest/client',
    'config/main'
], function (
    Client,
    mainConfig
) {

    var baseUrl = mainConfig.apiHost + '/api/v1/messenger-messages';

    return {
        allByChatId: function (chatId) {
            return Client.get(baseUrl + '?chat_id=' + chatId);
        },
        send: function (chatId, messageForm) {
            return Client.post(baseUrl + '/' + chatId, messageForm);
        }
    };

});