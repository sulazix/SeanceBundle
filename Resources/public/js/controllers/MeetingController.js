
seanceApp.controller('MeetingController', ['$scope', '$rootScope', '$stateParams', '$state', '$filter', 'ContainerService', 'MeetingService',
	function($scope, $rootScope, $stateParams, $state, $filter, ContainerService, MeetingService){

		$rootScope.$on('container:changed_selected', function(){
			$scope.meetings = MeetingService.getMeetings();
		});

		if ($stateParams) {
			MeetingService.fetch($stateParams.id).then(function(response) {
				$scope.meeting = response.data;
				$scope.items = $scope.meeting.items;
				console.log($scope.meeting);
			})
		}

		$scope.activeMeetings = function() {
			return $filter('dateCompare')($scope.meetings, '>=');
		}

		$scope.pastMeetings = function() {
			return $filter('dateCompare')($scope.meetings, '<');
		}
		
		$scope.updatePoint = function(data) {
			// TODO : Envoyer la requete de mise à jour sur le serveur
			console.log("Do someting before saving");
			return true;
		}

		$scope.removeTag = function(itemIndex, tagIndex) {
			//console.log(itemIndex, tagIndex);
			delete $scope.items[itemIndex].tags.splice(tagIndex, 1);
		}

		$scope.init = function() {

			if ($scope.initialized) return;

			$scope.initialized = true;

			$scope.tinymceOptions = {
				'menubar': false,
				'width': 'auto',
				'plugins': 'autoresize',
				'autoresize_bottom_margin': "30"
			};

			$scope.sortableOptions = {
			    update: function(e, ui) {
			    	console.log("[ui-sortable] Updating order!")
			    },
			    stop: function(e, ui) {
			    	console.log("[ui-sortable] Done !");
			    }
			};
		}

		$scope.init();
	}]
);