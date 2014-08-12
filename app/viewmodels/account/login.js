(function (global) {
    var LoginViewModel,
        app = global.app = global.app || {};

    LoginViewModel = function () {
        return kendo.observable({
            isLoggedIn: false,
            email: "",
            password: "",

            onLogin: function (e) {
                if (e != null) {
                    e.preventDefault();
                }
                var that = this,
                    email = that.get("email").trim(),
                    password = that.get("password").trim();

                if (email === "" || password === "") {
                    app.alert("Login failed", "Both fields are required!");

                    return;
                }

                this.login(email, password);
            },

            onLogout: function () {
                this.clearForm();
                app.logOut();
            },

            clearForm: function () {
                var that = this;

                that.set("email", "");
                that.set("password", "");
            },

            checkEnter: function (e) {
                var that = this;

                if (e.keyCode == 13) {
                    $(e.target).blur();
                    that.onLogin();
                }
            },
            
            login: function (email, password) {
                var that = this;
    			//-- Loader
                //app.application.changeLoadingMessage('Attempting to log you in...');
    			app.application.showLoading();
    			//-- Hash the pass
    			password_sha = new jsSHA(password);
    			password_hashed = password_sha.getHash('SHA-256', 'HEX');				
    		
    			var attrs, req;
    			attrs = {
    				'data': {
    					'auth_users_email': email,
    					'auth_users_password': password
    				},
    				'dataType': 'json'
    			};
                
    			req = $.post(
    				app.remoteHostSSL + '/api/users/login', 
    				attrs.data,
                    null,
                    attrs.dataType
    			);
    			req.done(app.setToken).done(function(resp) {
    				app.application.hideLoading();
    				if (resp.success) {
                        app.session.loggedIn = true;
                        that.loggedIn = true;
                        app.saveSession();
                        
                        // go to request
                        app.application.navigate('views/calendar/day.html');
    				} else {
                        app.alert("Login failed", "Invalid email or password entered.");
    				}
    			});
            },
            
    		getUUID: function(callback) {
    			var attrs, req;
    			attrs = {
    				'data': {},
    				'handleAs': 'json'
    			};
    			req = $.post(
    				app.remoteHost + '/api/get-uuid', 
    				attrs
    			);

    			return req.done(app.setToken).done(function(resp) {
                    app.session.token = resp.token;
    				app.saveSession();

                    return callback(resp);
    			});
    		},
    	});
    };

    app.accountLoginService = {
        auth: function (e) {
            if (app.isLoggedIn()) {
                app.application.navigate('views/calendar/day.html');
                e.preventDefault();
            }
        },
        show: function (e) {
            if (app.isLoggedIn()) {
                app.application.navigate('views/calendar/day.html');
                return;
            }
            var service = app.accountLoginService;
            var viewModel = service.viewModel;
            
            if (app.session.loggedIn) {
                viewModel.set('isLoggedIn', true);
            } else {
                viewModel.set('isLoggedIn', false);
            }
        },
        viewModel: new LoginViewModel()
    };
})(window);