define([
    'crypto-js',
    'jsencrypt'
], function(
    CryptoJS,
    JSEncrypt
) {

    var localPassword;
    var localFormatter;
    var localMacSecret;

    /**
     * Работа с шифрованием
     */
    return {

        setMacSecret: function(mac) {
            localMacSecret = mac;
        },

        setFormatter: function(formatter) {
            localFormatter = formatter;
        },

        setPassword: function(password) {
            localPassword = password;
        },

        encrypt: function (message) {
            var stringifyMessage = JSON.stringify(message);
            var config = {
                mode: CryptoJS.mode.CBC,
            };
            var encrypted = CryptoJS.AES.encrypt(stringifyMessage, localPassword, config);
            //encrypted.ct = this.sign(encrypted.ct);
            var encrypted64 = localFormatter.stringify(encrypted);

            return encrypted64;
        },

        decrypt: function (encrypted64) {
            var config = {
                mode: CryptoJS.mode.CBC,
            };
            var encrypted = localFormatter.parse(encrypted64);
            var decrypted = CryptoJS.AES.decrypt(encrypted, localPassword, config);
            return decrypted.toString(CryptoJS.enc.Utf8);
        },

        sign: function (ct) {
            var signature = CryptoJS.HmacSHA512(ct, localMacSecret).toString();
            return signature;
        },

        verify: function (ct, dataSignature) {
            if(dataSignature === this.sign(ct)) {
                throw new Error('Invalid signature');
            }
        },
    };

});
