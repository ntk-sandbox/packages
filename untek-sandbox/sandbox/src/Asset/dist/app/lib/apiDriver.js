define([
    //'jquery'
], function (
   // $
) {

    return {
        request: function (method, uri, data) {
            var promiseCallback = function (resolve, reject) {
                $.ajax({
                    type: method,
                    url: uri,
                    data: data,
                    success: function (response) {
                        resolve(response);
                    },
                    error: function (error) {
                        reject(response);
                    }
                });
            };
            return new Promise(promiseCallback);
        }
    };

});