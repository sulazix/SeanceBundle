
seanceApp.controller('ContainerController', ['$scope', 'ContainerService',
	function($scope, ContainerService){
		$scope.init = function() {
			if ($scope.initialized)
				return;

			// Avoid resetting variables without needed
			$scope.initialized = true;
			$scope.currentDate = new Date();

			ContainerService.fetchAll();
		}

		$scope.init();

		// $rootScope events
		$scope.$on('container:changed_selected', function(){
			$scope.selectedContainer = ContainerService.getSelectedContainer();
			$scope.stack = $scope.selectedContainer.stack;
		});

	}]
);