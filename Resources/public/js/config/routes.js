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
				views: {
					"headerView" : {
						templateUrl: Routing.generate('seance_frontend_template', {name:'header'})
					}
				},
				
			})
			.state('root.home', {
				url: "/home",
				views: {
					"baseView@" : {
						templateUrl: Routing.generate('seance_frontend_template', {name:'home'})
					},
					"stackView@root.home" : { 
						templateUrl: Routing.generate('seance_frontend_template', {name:'stack'})
					},
					"meetingListActiveView@root.home" : { 
						templateUrl: Routing.generate('seance_frontend_template', {name:'meeting_list_active'}),
						controller: 'MeetingController'
					},
					"meetingListPastView@root.home" : { 
						templateUrl: Routing.generate('seance_frontend_template', {name:'meeting_list_past'}),
						controller: 'MeetingController'
					}
				}
				
			})

			/* MEETING ROUTES */
			.state('root.meeting', {
				url: '/meeting',
				views: {
					"baseView@" : {
						templateUrl: Routing.generate('seance_frontend_template', {name: 'meeting_base'})
					}
				}
			})
			.state('root.meeting.add', {
				url: '/add',
				views : {
					"": {
						templateUrl: Routing.generate('seance_frontend_template', {name: 'new_meeting'}),
						controller: "MeetingController"
					}
				}
			})
			.state('root.meeting.view', {
				url: '/:id',
				views : {
					"": {
						templateUrl: Routing.generate('seance_frontend_template', {name: 'view_meeting'}),
						controller: "MeetingController"
					}
				}
			});
}]);