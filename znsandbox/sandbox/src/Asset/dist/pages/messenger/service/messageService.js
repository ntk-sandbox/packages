define([
    'pages/messenger/store/chatStore',
    'pages/messenger/api/chatApi',
    'pages/messenger/api/messageApi'
], function (
    ChatStore,
    ChatApi,
    MessageApi
) {

    var messageCache = {};

    return {
        sendMessage: function(chatId, messageForm) {
            MessageApi.send(chatId, messageForm);
        },
        loadChatCollection: function() {
            var len = ChatStore.getters.getChatCollection.length;
            if(len === 0) {
                ChatApi.all().then(function (response) {
                    ChatStore.commit('setChatCollection', response.data);
                }).catch(function (response) {
                    //console.info(response.data);
                });
            }
        },
        loadChatMessages: function (chatId) {
            ChatStore.commit('setMessageCollection', []);
            chatId = parseInt(chatId);
            ChatStore.commit('setChatId', chatId);
            if(chatId > 0) {
                if(messageCache.hasOwnProperty(chatId)) {
                    ChatStore.commit('setMessageCollection', messageCache[chatId]);
                } else {
                    MessageApi.allByChatId(chatId).then(function (response) {
                        ChatStore.commit('setMessageCollection', response.data);
                        messageCache[chatId] = response.data;
                    }).catch(function (response) {
                        //console.info(response.data);
                    });
                }
            }
        }
    };

});