/**
 * Wrapper class for the $http service. Takes route names and parameters
 * instead of a url.
 */
seanceApp.service('APIService',['$http',
	function ($http) {
		var that = this;
	
	
		that.delete = function(route, params, config) {
			var url = that.route(route, params)
			return $http.delete(url, config)
		}

		that.get = function(route, params, config) {

			var url = that.route(route, params)
			return $http.get(url, config)
		}

		that.jsonp = function(route, params, config) {
			var url = that.route(route, params)
			return $http.jsonp(url, config)
		}

		that.post = function(route, params, data, config) {
			var url = that.route(route, params)
			return $http.post(url, data, config)
		}

		that.defaults = $http.defaults;
		that.pendingRequests = $http.pendingRequests;

		that.route = function(route, params) {
			return Routing.generate(route, params);
		}

	}]
);