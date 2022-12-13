
var src = {
    script: {
        vendorRequired: [
            './node_modules/lodash/lodash.min.js',
        ],
        railsRequired: [
            './node_modules/jrails/kernel/namespace.js',
            './node_modules/jrails/kernel/container.js',
            './node_modules/jrails/kernel/bootstrap.js',
            './node_modules/jrails/kernel/func.js',

            './node_modules/jrails/helper/*.js',
            './node_modules/jrails/event/*.js',
        ],
    }
};

module.exports = src;
