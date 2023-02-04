define([
    'vue',
    'vuex',
    'pages/messenger/service/messageService',
    'pages/messenger/store/chatStore',
    'text!pages/messenger/tpl/index.html'
], function (
    Vue,
    Vuex,
    MessageService,
    ChatStore,
    template
) {

    Vue.use(Vuex);

    return {
        template: template,
        data: function () {
            return {
                form: {
                    text: ''
                }
            };
        },
        created: function () {
            MessageService.loadChatMessages(null);
            MessageService.loadChatCollection();
        },
        methods: {
            sendMessage: function () {
                if(this.form.text) {
                    MessageService.sendMessage(ChatStore.state.chatId, this.form);
                    info(this.form);
                    this.form = {};
                }
            }
        },
        computed: {
            chatCollection: function () {
                return ChatStore.state.chatCollection;
            },
            chatId: function () {
                return ChatStore.state.chatId;
            }
        }
    };

});