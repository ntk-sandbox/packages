define([
    'app/lib/apiDriver'
], function (
    ApiDriver
) {

    var ChatApiDriver = {
        sendMessage: function (chatId, messageText) {
            return ApiDriver.request('POST', '/messenger/send-message', {
                'chatId': chatId,
                'text': messageText,
            });
        },
        updateMessageList: function (chatId) {
            var uri = '/messenger/message-list/?chatId=' + chatId;
            return ApiDriver.request('GET', uri);
        },
    };

    return ChatApiDriver;

});