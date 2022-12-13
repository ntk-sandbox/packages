define([
    'pages/uiKit/vue/index',
    'pages/uiKit/vue/alert',
    'pages/uiKit/vue/avatar',
    'pages/uiKit/vue/breadcrumb',
    'pages/uiKit/vue/dropdown',
    'pages/uiKit/vue/modal',
    'pages/uiKit/vue/toast',
    'pages/uiKit/vue/spinner'
], function (
    UiKitIndex,
    Alert,
    Avatar,
    Breadcrumb,
    Dropdown,
    Modal,
    Toast,
    Spinner
) {

    return [
        {path: '/ui-kit', component: UiKitIndex},
        {path: '/ui-kit/alert', component: Alert},
        {path: '/ui-kit/avatar', component: Avatar},
        {path: '/ui-kit/breadcrumb', component: Breadcrumb},
        {path: '/ui-kit/dropdown', component: Dropdown},
        {path: '/ui-kit/modal', component: Modal},
        {path: '/ui-kit/toast', component: Toast},
        {path: '/ui-kit/spinner', component: Spinner}
    ];

});
