define([], function() {

    var currentSessionId = null;

    var driver = {
        item: null,
        set: function (item) {
            this.item = item;
            item = JSON.stringify(item);
            localStorage.setItem('sessionData', item);
        },
        get: function () {
            if(this.item === null) {
                var item = localStorage.getItem('sessionData');
                this.item = JSON.parse(item);
            }
            if(typeof this.item !== 'object') {
                this.item = {};
            }
            return this.item;
        },
        reset: function () {
            this.set({});
        },
    };

    return {
        reset: function () {
            localStorage.setItem('sessionId', null);
            driver.reset();
        },
        start: function (sessionId) {
            this.reset();
            console.info('session started! ' + sessionId);
            localStorage.setItem('sessionId', sessionId);
            currentSessionId = sessionId;
        },
        set: function (key, value) {
            if( ! this.isStarted()) {
                throw new Error('Session not started!');
            }
            var item = driver.get();
            item[key] = value;
            driver.set(item);
        },
        get: function (key) {
            if( ! this.isStarted()) {
                throw new Error('Session not started!');
            }
            var item = driver.get();
            var value = item[key];
            if(typeof value === 'undefined') {
                return null;
            }
            return value;
        },
        getId: function () {
            if(currentSessionId === null) {
                currentSessionId = localStorage.getItem('sessionId');
            }
            return currentSessionId;
        },
        isStarted: function () {
            var id = this.getId();
            return typeof id === 'string';
        }
    };

});