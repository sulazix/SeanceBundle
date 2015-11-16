/**
 * Configuration file for the frontend
 */
seanceApp.config(['$stateProvider', '$urlRouterProvider', 
	function($stateProvider, $urlRouterProvider) {
		$urlRouterProvider.otherwise('/home');

		$stateProvider
			/* HOMEPAGE ROUTES */
			.state('root', {
				abstract: true,
				url: '',
				templateUrl: Routing.generate('seance_frontend_template', {name: 'home'}),
				controller: 'ContainerController'
				
			})
			.state('root.home', {
				url: "/home",
				views: {
					"stackView" : { 
						templateUrl: Routing.generate('seance_frontend_template', {name:'stack'})
					},
					"meetingListActiveView" : { 
						templateUrl: Routing.generate('seance_frontend_template', {name:'meeting_list_active'}),
						controller: 'MeetingController'
					},
					"meetingListPastView" : { 
						templateUrl: Routing.generate('seance_frontend_template', {name:'meeting_list_past'}),
						controller: 'MeetingController'
					}
				}
				
			})

			/* MEETING ROUTES */
			.state('meeting', {
				abstract: true,
				url: '/meeting',
				templateUrl: Routing.generate('seance_frontend_template', {name: 'meeting_base'})
			})
			.state('meeting.add', {
				url: '/add',
				templateUrl: Routing.generate('seance_frontend_template', {name: 'new_meeting'}),
				controller: 'MeetingController'
			})
			.state('meeting.view', {
				url: '/:id',
				templateUrl: Routing.generate('seance_frontend_template', {name: 'view_meeting'}),
				controller: 'MeetingController'
			});
}]);