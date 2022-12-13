define(['lodash', 'jrails/spa/helper', 'jrails/spa/layer', 'jrails/vue/vm', 'jrails/kernel/loader'], function(_, spaHelper, spaLayer, vm, kernelLoader) {

    var helper = {

        checkAccess: function (controller) {
            var access = controller.access();
            if(_.isEmpty(access)) {
                return true;
            }
            if(access.auth === '@' && ! container.authService.isLogin()) {
                bundle.module.user.service.authService.authRequired();
                return false;
            }
            if(access.auth === '?' && container.authService.isLogin()) {
                container.notify.info(lang.user.auth.alreadyAuthorizedMessage);
                bundle.spa.router.goBack();
                return false;
            }
            return true;
        },

        runController: function (controller, request) {
            var isAllow = false;
            if(_.isFunction(controller.access)) {
                isAllow = this.checkAccess(controller);
            }
            if(_.isFunction(controller.run) && isAllow) {
                controller.run(request);
            }
        },

    };

    return {

        request: null,

        loadTemplate: function (request, callback) {
            var templateUrl = spaHelper.getTemplateUrl(request);
            $.ajax({
                url: templateUrl,
                success: function (data) {
                    callback();
                    if (spaHelper.isTemplate(data)) {
                        spaLayer.add(data, request);
                    }
                }
            });
        },

        loadDepends: function (request, controller) {
            if(_.isEmpty(controller.depends)) {
                //d(controller);
                vm.ensure(controller);
                //spaHelper.getVueInstance(controller);
                //controller.onLoadDepends(request);
                helper.runController(controller, request);
                return;
            }
            var cbCount = 0;
            var cb = function () {
                cbCount++;
                if(cbCount === controller.depends.length) {
                    //d(cbCount);
                    //d(controller);
                    //spaHelper.getVueInstance(controller);
                    vm.ensure(controller);
                    //controller.onLoadDepends(request);
                    helper.runController(controller, request);
                }
            };
            for(var k in controller.depends) {
                var dependClass = controller.depends[k];
                if(dependClass.search(/\//g) !== -1) {
                    this.requireScript(dependClass, cb);
                } else {
                    this.requireClass(dependClass, cb);
                }
            }
        },

        run: function (requestSource) {
            //console.log(requestSource);
            var request = _.clone(requestSource);
            this.request = request;
            spaHelper.prepareRequest(request);

            //var className = spaHelper.getClassName(request, 'controller');
            //console.log(className);
            //spaLayer.show(request);
            var controller = request.controllerInstance;
            if( ! _.isEmpty(controller)) {
                if(_.isEmpty(controller.isInit)) {
                    controller.isInit = true;
                    controller.el = '#app-'+request.controller+'-'+request.action;

                    spaLayer.add222(controller.template, controller.el);
                    //this.loadDepends(request, controller);
                }
            }
            spaHelper.registerEventHandlers(request);
            /*if(kernelLoader.isDefined(className)) {
                cb();
            } else {
                kernelLoader.requireClass(className, cb);
            }*/

            //this.doRequest(request, callback);
        },

        /*doRequest: function (request, callback) {
            var isExists = spaLayer.has(request);
            if (isExists) {
                callback();
            } else {

                this.loadTemplate(request, callback);
            }
        },*/

    };

});