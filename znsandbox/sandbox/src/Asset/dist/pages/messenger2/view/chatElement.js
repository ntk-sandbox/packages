define([
    'jquery',
    'vendor/jrails/event/eventService',
], function (
    $,
    EventService
) {

    var chatElement = {
        getFormElement: function () {
            return $('#messageForm');
        },
        getMessagesElement: function () {
            return $('.direct-chat-messages');
        },
        clearMessageText: function () {
            var textElement = chatElement.getFormElement().find('input[name=message]');
            textElement.val('');
        },
        getMessageText: function () {
            var textElement = chatElement.getFormElement().find('input[name=message]');
            return textElement.val();
        },
        getChatId: function () {
            var chatIdElement = chatElement.getFormElement().find('input[name=chatId]');
            return chatIdElement.val();
        },
        setMessageList: function (msg) {
            chatElement.getMessagesElement().html(msg);
        },
        scrollBottomMessageList: function () {
            var messageList = chatElement.getMessagesElement();
            messageList.scrollTop(messageList.prop("scrollHeight"));
        },
        init: function () {
            chatElement.getMessagesElement().show(function () {
                chatElement.scrollBottomMessageList();
                return false;
            });

            chatElement.getFormElement().submit(function () {
                var messageText = chatElement.getMessageText();
                var chatId = chatElement.getChatId();
                EventService.trigger('messenger.chatElement.submit', {
                    chatId: chatId,
                    messageText: messageText
                });
                return false;
            });

            EventService.registerHandler('messenger.chatService.sendMessageSuccess', function () {
                chatElement.clearMessageText();
            });

            EventService.registerHandler('messenger.chatService.updateMessageListSuccess', function (params) {
                chatElement.setMessageList(params.content);
                chatElement.scrollBottomMessageList();
            });
        }
    };

    return chatElement;

});