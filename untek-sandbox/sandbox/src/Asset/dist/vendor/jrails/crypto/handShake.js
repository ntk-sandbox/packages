define([
    'crypto-js',
    //'jrails/crypto/crypto',
    //'jrails/crypto/tokenFormatter',
    'jrails/crypto/session',
    './axios',
    'jsencrypt',
    'jrails/crypto/certificateHelper'
], function(
    CryptoJS,
    //Crypto,
    //CryptoFormatter,
    Session,
    axios,
    JSEncrypt,
    certificateHelper
) {

    //Crypto.setFormatter(CryptoFormatter);

    var crypt = new JSEncrypt.JSEncrypt({default_key_size: 2048});
    var host = null;

    // console.log(crypt.getPrivateKey());
    // console.log(crypt.getPublicKey());

    var startSession = function (clientRandomKey) {
        var requestOptions = {
            method: 'post',
            url: host + '/crypto.php/v1/crypt-handshake/startSession',
            data: {
                clientRandomKey: clientRandomKey,
            },
            headers: {},
        };
        return axios(requestOptions);
    };

    var setSecretKey = function (encryptedSecretKey, encryptedSecretMac) {
        var requestOptions = {
            method: 'post',
            url: host + '/crypto.php/v1/crypt-handshake/setSecretKey',
            data: {
                encryptedSecretKey: encryptedSecretKey,
                encryptedSecretMac: encryptedSecretMac,
                sessionId: Session.getId(),
            },
            /*headers: {
                'X-Crypt-Session': Session.getId(),
            },*/
        };
        return axios(requestOptions);
    };
    var generateSecretKey = function () {
        var secretKey = Math.random().toString(36).slice(-8);
        secretKey = secretKey + Math.random().toString(36).slice(-8);
        secretKey = secretKey + Math.random().toString(36).slice(-8);
        return secretKey;
    };

    var convertSignatureToBase64 = function (signature, signatureFormat) {
        var signature64;
        if(signatureFormat === 'base64') {
            signature64 = signature;
        } else if(signatureFormat === 'hex') {
            var raw = CryptoJS.enc.Hex.parse(signature);
            signature64 = CryptoJS.enc.Base64.stringify(raw);
        } else if(signatureFormat === 'raw') {
            signature64 = CryptoJS.enc.Base64.stringify(signature);
        }
        return signature64;
    };

    var certificateEntity = {
        parse: function () {

        }
    };

    /*var buf = '111';
    var bufferedSecret = '222';
    var string = CryptoJS.HmacSHA512(buf, bufferedSecret).toString();

    console.log(string);*/

    /*var wordArr = CryptoJS.HmacSHA1(buf, bufferedSecret);
    var utf8Arr = convertWordArrayToUint8Array(wordArr);
    var string = new TextDecoder('utf-8').decode(utf8Arr);*/

    return {
        reset: function() {
            Session.reset();
        },
        run: function (hostUrl) {
            host = hostUrl;
            var secretKey = Session.get('secretKey');
            var secretMac = Session.get('secretMac');
            //var secretKey = null;

            console.info('Secret key from session: ', secretKey);
            var promiseCallback = function(resolve,reject){
                if(secretKey) {
                    resolve(secretKey);
                } else {

                    var clientRandomKey = generateSecretKey();
                    startSession(clientRandomKey).then(function (response) {
                        var sessionId = response.data.sessionId;
                        var data = response.data;

                        if(typeof sessionId !== 'string') {
                            throw new Error('Start session error! Empty session ID!');
                        }


                        if(data.clientRandomKey !== clientRandomKey) {
                            throw new Error('Start session error! No equal client random key!');
                        }


                        var certificate = response.data.certificate;
                        var certificateEntity = certificateHelper.parse(certificate);
                        var signature = data.signature;

                        var publicKey = certificateEntity.subject.publicKey;
                        crypt.setPublicKey(publicKey);

                        //certificateHelper.verify(cr)

                        var dataScope = data.sessionId + certificate + data.clientRandomKey + data.timestamp;


                        var signature64 = convertSignatureToBase64(signature.signature, signature.format);
                        if ( ! crypt.verify(dataScope, signature64, CryptoJS.SHA256)) {
                            throw new Error('Invalid signature!');
                        } else {
                            console.info('Valid signature!');
                        }


                        Session.start(sessionId);
                        Session.set('certificate', certificate);

                        secretKey = generateSecretKey();
                        secretMac = generateSecretKey();
                        var encryptedSecretKey = crypt.encrypt(secretKey);
                        var encryptedSecretMac = crypt.encrypt(secretMac);
                        if(typeof encryptedSecretKey !== 'string') {
                            throw new Error('Encrypt secret key error!');
                        }
                        setSecretKey(encryptedSecretKey, encryptedSecretMac).then(function (response) {
                            if(response.status === 200) {

                                Session.set('secretKey', secretKey);
                                Session.set('secretMac', secretMac);

                                //Crypto.setPassword(secretKey);
                                //Crypto.setMacSecret(secretMac);


                                console.log('--- secret key saved');
                            } else {
                                throw new Error('Send secret key error!');
                            }
                        });
                        resolve(secretKey, secretMac);
                    });
                }
            };
            return new Promise(promiseCallback);
        }
    };

});