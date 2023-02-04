define([
    'jquery',
    'app/lib/apiDriver',
    'app/service/socketService',
    '../api/chatApiDriver',
    'vendor/jrails/event/eventService',
], function (
    $,
    ApiDriver,
    SocketService,
    ChatApiDriver,
    EventService
) {

    return {
        sendMessage: function (chatId, messageText) {
            ChatApiDriver
                .sendMessage(chatId, messageText)
                .then(function (content) {
                    EventService.trigger('messenger.chatService.sendMessageSuccess', {
                        content: content
                    });
                });
        },
        updateMessageList: function (chatId) {
            ChatApiDriver
                .updateMessageList(chatId)
                .then(function (content) {
                    EventService.trigger('messenger.chatService.updateMessageListSuccess', {
                        content: content
                    });
                });
        },
    };

});