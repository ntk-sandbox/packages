define([], function () {

    return {
        setErrors: function (errors) {
            var result = {};
            for (var k in errors) {
                var errorField = errors[k]['field'];
                var errorMessage = errors[k]['message'];
                if(result[errorField] === undefined) {
                    result[errorField] = '';
                }
                result[errorField] = result[errorField] + "\n" + errorMessage;
            }
            return result;
        }
    };

});
