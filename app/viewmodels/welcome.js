(function (global) {
    var Model,
        app = global.app = global.app || {};

    Model = function () {
        return kendo.observable({
        });
    };

    var service = {
        init: function (e) {
        	console.log('init', e);
            var viewModel = service.viewModel;

            //-- Fast Click Content
            FastClick.attach(e.view.content[0]);
        },
        beforeShow: function (e) {
        	console.log('beforeShow', e);
        },
        beforeHide: function (e) {
        	console.log('beforeHide', e);
        },
        show: function (e) {
        	console.log('show', e);
            var viewModel = service.viewModel;
            var params = e.view.params;

        },
        afterShow: function (e) {
        	console.log('afterShow', e);
        },
        hide: function (e) {
        	console.log('hide', e);
            var viewModel = service.viewModel;
        },
        transitionStart: function (e) {
        	console.log('transitionStart', e);
        },
        transitionEnd: function (e) {
        	console.log('transitionEnd', e);
        },
        viewModel: new Model()
    };

    app.welcomeService = service;
})(window);