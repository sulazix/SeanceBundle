
seanceApp.controller('MeetingController', ['$scope', '$rootScope', '$filter', 'ContainerService', 'MeetingService',
	function($scope, $rootScope, $filter, ContainerService, MeetingService){

		$rootScope.$on('container:changed_selected', function(){
			$scope.meetings = ContainerService.getSelectedContainer().meetings;
			$scope.points = $scope.meetings.items;
		});

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
			delete $scope.points[itemIndex].tags.splice(tagIndex, 1);
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