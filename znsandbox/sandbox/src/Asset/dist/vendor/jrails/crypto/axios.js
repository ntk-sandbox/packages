define([
    'crypto-js',
    'jrails/crypto/crypto',
    'jrails/crypto/tokenFormatter',
    './axios',
    'jrails/crypto/handShake',
    'jrails/crypto/session',
    'jquery',
    'config/main'
], function (
    CryptoJS,
    Crypto,
    CryptoFormatter,
    axios,
    HandShake,
    Session,
    $,
    mainConfig
) {

    Crypto.setFormatter(CryptoFormatter);

    /*var wordArr = CryptoJS.HmacSHA1(buf, bufferedSecret);
    var utf8Arr = convertWordArrayToUint8Array(wordArr);
    var string = new TextDecoder('utf-8').decode(utf8Arr);*/

    var cryptoClient = {
        send: function (request) {
            var stateCount = 1;
            var sessionId = Session.getId();

            if(typeof sessionId !== 'string') {
                HandShake.reset();
                HandShake.run(mainConfig.apiHost).then(function (secretKey) {
                    if (stateCount > 0) {
                        cryptoClient.send(request);
                        stateCount--;
                    }
                });
                return ;
            }

            var promiseCallback = function (resolve, reject) {
                var url = mainConfig.apiHost + '/';
                var requestConfig = {
                    method: 'post',
                    url: url,
                    data: Crypto.encrypt(request),
                    headers: {
                        'X-Crypt-Session': sessionId,
                        'X-Crypt-Format': CryptoFormatter.formatName(),
                    },
                    success: function (encryptedContent) {
                        console.info('Response: ', encryptedContent);
                        var responseData = Crypto.decrypt(encryptedContent);
                        responseData = JSON.parse(responseData);
                        var contentType = responseData.headers['content-type'];
                        if (contentType.toLowerCase() === 'application/json') {
                            responseData.data = JSON.parse(responseData.content);
                        }
                        resolve(responseData);
                    },
                    statusCode: {
                        401: function () {
                            HandShake.reset();
                            HandShake.run(mainConfig.apiHost).then(function (secretKey) {
                                if (stateCount > 0) {
                                    cryptoClient.send(request);
                                    stateCount--;
                                }
                            });
                        }
                    }
                };
                $.ajax(requestConfig);
            };
            return new Promise(promiseCallback);
        }
    };

    return {
        post: function (uri, body) {
            var request = {
                method: "post",
                uri: uri,
                headers: {},
                body: body
            };
            var promiseCallback = function (resolve, reject) {
                HandShake.run(mainConfig.apiHost).then(function (secretKey, secretMac) {
                    console.info('secretKey: ' + secretKey);
                    console.info('secretMac: ' + secretMac);
                    Crypto.setPassword(secretKey);
                    Crypto.setMacSecret(secretMac);
                    cryptoClient.send(request).then(function (response) {
                        resolve(response)
                    }).catch(function (reason) {
                        reject(reason);
                    });
                });
            };
            return new Promise(promiseCallback);
        }
    };

});