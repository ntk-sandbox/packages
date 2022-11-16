define([
    'pages/messenger/vue/index',
    'pages/messenger/vue/messages'
], function (
    Layout,
    Messages
) {

    return [
        {
            path: '/messenger',
            component: Layout,
            children: [
                {
                    path: ':chatId',
                    component: Messages
                }
            ]
        }
    ];

});
