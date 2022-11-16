define([
    'jquery',
    //'app/service/socketService',
    '../view/chatElement',
    '../service/chatService',
    'vendor/jrails/event/eventService',
], function (
    $,
    //SocketService,
    chatElement,
    chatService,
    EventService
) {

    return {
        init: function () {
            chatElement.init();
            EventService.registerHandler('messenger.chatElement.submit', function (params) {
                chatService.sendMessage(params.chatId, params.messageText);
            });
            EventService.registerHandler('socketService.sendMessage', function (params) {
                chatService.updateMessageList(params.chatId);
            });
        }
    };

});