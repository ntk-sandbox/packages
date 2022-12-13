define([
    'jsencrypt',
    'jrails/helper/file',
    'vendor/jszip/jszip',
    'text!pages/rsa/tpl/generator.html'
], function (
    JSEncrypt,
    File,
    JSZip,
    template
) {

    var generateKeys = function () {
        var keySize = parseInt(2048);
        var crypt = new JSEncrypt.JSEncrypt({default_key_size: keySize});
        var dto = {};
        dto.privateKey = crypt.getPrivateKey();
        dto.publicKey = crypt.getPublicKey();
        return dto;
    };

    var zipKeyPair = function (dto) {
        var zip = new JSZip();
        zip.file('priv.rsa', dto.privateKey);
        zip.file('pub.rsa', dto.publicKey);
        //img = zip.folder("images");
        //img.add("smile.gif", imgData, {base64: true});
        return zip.generateAsync({type: 'blob'});
    };

    return {
        template: template,
        data: function() {
            return {
                entity: {
                    privateKey: null,
                    publicKey: null,
                }
            };
        },
        methods: {
            generate: function() {
                this.entity = generateKeys();
            },
            download: function() {
                zipKeyPair(this.entity).then(function (zipContent) {
                    File.downloadContent('key.zip', zipContent, 'application/zip');
                });
            }
        },
        created: function () {

        }
    };

});