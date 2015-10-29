/**
 * List of routes corresponding to the Symfony REST API
 *
 * The following pattern should be followed
 * 'group_name': {
 * 		'prefix' : '/route_prefix',
 * 	 	'route1' : '/route/one',
 * 	  	'route_with_param': 'route/with/{param}'
 * }
 *
 * After injecting the denpendency in your controllers you can use it like such :
 *
 * Accessing route : group_name.route1
 */
seanceApp.constant('routes', {
	'api_base': '/interne/seance',
	'tag' : {
		'prefix': '/tag',
		'all': '/all',
		'get': '/{id}'
	}
});