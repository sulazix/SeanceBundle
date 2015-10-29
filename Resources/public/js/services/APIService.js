/**
 * Wrapper class for the $http service. Takes route names and parameters
 * instead of url.
 */
seanceApp.service('APIService',['$http', 'routes',
	function ($http, routes) {
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
			return $http.post(url, config)
		}

		that.defaults = $http.defaults;
		that.pendingRequests = $http.pendingRequests;


		/**
		 * Generates an url based on the given route name, its parameters.
		 * 
		 * @param  string route The name of a route
		 * @return string		The corresponding URL
		 * @throws string 		If no matching route was found or if missing a parameter
		 */
		that.route = function(route, params) {
			var steps = route.split('.');
			var index = steps.pop();

			var url = routes;
			angular.forEach(steps, function(value, key){
				url = url[value];
			});

			var suffix = url[index];
			var prefix = (url['prefix'])? url['prefix'] : '';

			var final = routes.api_base + prefix + suffix;

			angular.forEach(params, function(value, key){
				var regex = new RegExp('\{'+key+'\}', 'i')
				final = final.replace(regex, value)
			});

			if (final.match(/\{(.+)\}/)) {
				throw "Missing parameters to route " + route;
			}

			return final;
		}
	}]
);