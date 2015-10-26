
seanceApp.controller('MeetingController', ['$scope', 'MeetingService',
	function($scope, MeetingService){
		
		$scope.meeting = MeetingService.fetch(1);

		// TODO : Replace this by an ajax query
		$scope.points = $scope.meeting.items;

		
		$scope.updatePoint = function(data) {
			// TODO : Envoyer la requete de mise à jour sur le serveur
			return true;
		}

		$scope.removeTag = function(itemIndex, tagIndex) {
			//console.log(itemIndex, tagIndex);
			delete $scope.points[itemIndex].tags.splice(tagIndex, 1);
		}
	}]
);