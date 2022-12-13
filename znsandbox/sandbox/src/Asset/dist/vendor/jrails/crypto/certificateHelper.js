define([
    'crypto-js',
    'jsencrypt'
], function(
    CryptoJS,
    JSEncrypt
) {

    var ksort = function(array) {
        var result = {};
        Object.keys(array).sort().forEach(function(key) {
            result[key] = array[key];
        });
        return result;
    };

    var makeScope = function(subject) {
        var subjectSorted = ksort(subject);
        var scope = [];
        for (var key in subjectSorted) {
            var value = subjectSorted[key];
            scope.push(key + ':' + value);
        }
        return scope.join('|');
    };

    return {
        parse: function (certificate64) {
            if(typeof certificate64 !== 'string') {
                throw new Error('Start session error! Empty certificate!');
            }
            var certificateJson = CryptoJS.enc.Base64.parse(certificate64).toString(CryptoJS.enc.Utf8);
            var certificateEntity = JSON.parse(certificateJson);
            this.verify(certificateEntity);
            return certificateEntity;
        },
        verify: function (certificateEntity) {
            var publicKey = certificateEntity.issuer.subject.publicKey;
            var signature = certificateEntity.signature.signature;
            var crypt = new JSEncrypt.JSEncrypt({default_key_size: 2048});

            var dataScope = makeScope(certificateEntity.subject);

            crypt.setPublicKey(publicKey);

            if ( ! crypt.verify(dataScope, signature, CryptoJS.SHA256)) {
                throw new Error('Invalid signature!');
            } else {
                console.info('Valid signature!');
            }
        }
    };

});
