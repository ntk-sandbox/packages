define(['crypto-js'], function(CryptoJS) {

    return {
        formatName: function () {
            return 'token';
        },
        stringify: function (cipherParams) {
            var j = {};
            j.ct = cipherParams.ciphertext.toString(CryptoJS.enc.Base64);
            if (cipherParams.iv) {
                j.iv = cipherParams.iv.toString();
            }
            if (cipherParams.salt) {
                j.s = cipherParams.salt.toString();
            }
            return j.s + '.' + j.iv + '.' + j.ct;
        },
        parse: function (jsonStr) {
            var j = {};
            var parts = jsonStr.split('.');
            j.s = parts[0];
            j.iv = parts[1];
            j.ct = parts[2];
            j.sign = parts[2];
            var encodedContent = CryptoJS.enc.Base64.parse(j.ct);
            var cipherParams = CryptoJS.lib.CipherParams.create({ ciphertext: encodedContent });
            if (j.iv) {
                cipherParams.iv = CryptoJS.enc.Hex.parse(j.iv);
            }
            if (j.s) {
                cipherParams.salt = CryptoJS.enc.Hex.parse(j.s);
            }
            return cipherParams;
        }
    };

});