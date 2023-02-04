define(['crypto-js'], function(CryptoJS) {

    return {
        formatName: function () {
            return 'string';
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
            return j.s + j.iv + j.ct;
        },
        parse: function (jsonStr) {
            var j = {};
            j.s = jsonStr.substr(0, 16);
            j.iv = jsonStr.substr(16, 32);
            j.ct = jsonStr.substr(32 + 16);
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