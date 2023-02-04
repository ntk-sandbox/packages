define([
    'vendor/jrails/event/eventService',
], function (
    EventService
) {

    var SocketService = {
        handlers: {},
        connect: function (url) {
            var socket = new WebSocket(url);
            socket.onopen = function () {
                console.log("Соединение установлено.");
            };
            socket.onclose = function (event) {
                if (event.wasClean) {
                    console.log('Соединение закрыто чисто');
                } else {
                    console.log('Обрыв соединения');
                    // например, "убит" процесс сервера
                }
                console.log('Код: ' + event.code + ' причина: ' + event.reason);
            };
            socket.onmessage = function (event) {
                var data = JSON.parse(event.data);
                var eventName = data.name;
                var eventData = data.data;

                EventService.trigger('socketService.' + data.name, data.data);
                //SocketService.trigger(data.name, data.data);
                console.log("Получены данные " + event.data);
            };
            socket.onerror = function (error) {
                console.log("Ошибка " + error.message);
            };
        },
        addHandler: function (eventName, handler) {
            if (this.handlers[eventName] == undefined) {
                this.handlers[eventName] = [];
            }
            this.handlers[eventName].push(handler);
        },
        trigger: function (eventName, params) {
            //console.log(eventName, params);
            var handlers = this.handlers[eventName];
            for (var i in handlers) {
                var handler = handlers[i];
                handler.run(params);
            }
        },
    };

    return SocketService;
});