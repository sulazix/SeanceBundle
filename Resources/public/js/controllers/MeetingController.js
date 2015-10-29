
seanceApp.controller('MeetingController', ['$scope', 'MeetingService',
	function($scope, MeetingService){
		
		$scope.meeting = MeetingService.fetch(1);

		// TODO : Replace this by an ajax query
		$scope.points = $scope.meeting.items;

		
		$scope.updatePoint = function(data) {
			// TODO : Envoyer la requete de mise à jour sur le serveur
			console.log("Do someting before saving");
			return true;
		}

		$scope.removeTag = function(itemIndex, tagIndex) {
			//console.log(itemIndex, tagIndex);
			delete $scope.points[itemIndex].tags.splice(tagIndex, 1);
		}

		$scope.tinymceOptions = {
			'menubar': false,
			'width': 'auto',
			'plugins': 'autoresize',
			'autoresize_bottom_margin': "30"
		};

		$scope.sortableOptions = {
		    update: function(e, ui) {
		      var logEntry = $scope.points.map(function(i){
		        return i.value;
		      }).join(', ');
		      console.log('Update: ', logEntry);
		    },
		    stop: function(e, ui) {
		      // this callback has the changed model
		      var logEntry = $scope.points.map(function(i){
		        return i.value;
		      }).join(', ');
		    }
		};
	}]
);