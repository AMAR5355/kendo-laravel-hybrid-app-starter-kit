(function (global) {
    var AccountRegisterModel,
        app = global.app = global.app || {},
        NEW_GROUP = 'new',
        EXISTING_GROUP = 'existing';

    AccountRegisterModel = function () {
        return kendo.observable({
            email: "",
            password: "",
            errors: {
                email: false,
                password: false
            },
            
            onRegister: function (evt) {
                var that = this;
                //-- Loader
                app.application.showLoading();          
            
                var attrs, req;
                attrs = {
                    'data':  app.accountRegisterService.viewModel.toJSON(),
                    'dataType': 'json'
                };

                req = $.post(
                    app.remoteHostSSL + '/api/user/register', 
                    attrs.data,
                    null,
                    attrs.dataType
                );
                req.done(function(resp) {
                    app.application.hideLoading();

                    app.accountRegisterService.viewModel.set('errors', resp.messages);
                    if (!resp.success) {
                        for (var key in resp.messages) {
                           var viewNode = $('#accounts-register-view');
                            var elem = viewNode.find('[data-bind*="' + key + '"]');
                            var scroller = viewNode.getKendoMobileView().scroller;
                            scroller.scrollTo(0, -1 * elem.position().top);
                            break;
                        }
                        
                        app.alert("Registration failed", "Sorry looks like you have some errors, please review the form.", null, 'OK');
                        return;
                    }

                    //-- Log In User
                    
                    // app.session.loggedIn = true;
                    // app.saveSession();
                    //app.application.navigate('views/calendar/day.html');
                });
            }
        });
    };

    app.accountRegisterService = {
        init: function (e) {
            var service = app.accountRegisterService;
            var viewModel = service.viewModel;
            $(function() {
                FastClick.attach(e.view.container[0]);
            });
        },
        show: function (e) {
            var service = app.accountRegisterService;
            var viewModel = service.viewModel;
            // viewModel.refreshOrders();

            //app.application.showLoading();
            //$.get(app.remoteHost + '/api/members/orders/view', {
            //    shop_orders_id: e.view.params.id,
            //    shop_orders_transaction_id: e.view.params.trans,
            //}, null, 'json').done(app.setToken).done(app.isAuth).done(function (resp) {
            //    viewModel.set('order', resp.order);
            //});
        },
        hide: function (e) {
            var service = app.accountRegisterService;
            var viewModel = service.viewModel;
            // e.view.find('.view-content').empty();
        },
        viewModel: new AccountRegisterModel()
    };
})(window);