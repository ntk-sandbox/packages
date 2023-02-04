define([
    'vue',
    'vuex'
], function (
    Vue,
    Vuex
) {

    Vue.use(Vuex);

    return  new Vuex.Store({
        state: {
            chatId: null,
            chatCollection: [],
            messageCollection: []
        },
        mutations: {
            setChatCollection: function (state, chatCollection) {
                state.chatCollection = chatCollection;
                //console.info(state.chatCollection);
            },
            setMessageCollection: function (state, messageCollection) {
                state.messageCollection = messageCollection;
                //console.info(messageCollection);
            },
            setChatId: function (state, chatId) {
                state.chatId = chatId;
                dd(chatId);
                //console.info(messageCollection);
            },
        },
        getters: {
            getChatCollection: function (state) {
                return state.chatCollection;
            }
        }
    });

});