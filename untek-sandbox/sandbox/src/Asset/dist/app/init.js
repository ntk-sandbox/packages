"use strict";

require([
    'app/service/socketService',
    'app/config/main',

    'bootstrap'
], function (
    SocketService,
    mainConfig
) {

    var url = mainConfig.webSocket.host + '?userId=1';
    SocketService.connect(url);

});