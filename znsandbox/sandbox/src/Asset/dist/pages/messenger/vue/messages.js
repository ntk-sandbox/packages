define([
    'pages/messenger/store/chatStore',
    'pages/messenger/service/messageService',
    'text!pages/messenger/tpl/messages.html',
    'app/store/container'
], function (
    ChatStore,
    MessageService,
    template,
    containerStore
) {

    return {
        template: template,
        created: function () {
            var chatId = this.$route.params.chatId;
            MessageService.loadChatMessages(chatId);
        },
        watch: {
            $route: function (to, from) {
                var chatId = to.params.chatId;
                MessageService.loadChatMessages(chatId);
            }
        },
        computed: {
            messageCollection: function () {
                return ChatStore.state.messageCollection;
            },
            user: function () {
                return containerStore.auth.state.user;
            }
        },
        updated: function () {
            var elem = this.$el.querySelector("#messageList");
            //var messageContainer = this.$el.querySelector("#message-container");
            elem.scrollTop = 100000000;
        },
    };

});