define(['config/main'], function(mainConfig) {

    window.dd = function(value1, value2, value3) {
        if(mainConfig.debug !== true) {
            return;
        }
        if(typeof value3 !== 'undefined') {
            console.log(value1, value2, value3);
            return;
        }
        if(typeof value2 !== 'undefined') {
            console.log(value1, value2);
            return;
        }
        console.log(value1);
    };

    window.dump = window.dd;

    window.info = function(value1, value2, value3) {
        if(mainConfig.debug !== true) {
            return;
        }
        if(typeof value3 !== 'undefined') {
            console.info(value1, value2, value3);
            return;
        }
        if(typeof value2 !== 'undefined') {
            console.info(value1, value2);
            return;
        }
        console.info(value1);
    };

});