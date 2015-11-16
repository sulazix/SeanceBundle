
seanceApp.controller('ContainerController', ['$scope', 'ContainerService',
	function($scope, ContainerService){
		$scope.init = function() {
			if ($scope.initialized)
				return;

			// Avoid resetting variables without needed
			$scope.initialized = true;
			$scope.currentDate = new Date();

			// Disabled for now until syncing algorithm is in place
			//if (ContainerService.getContainers().length == 0)
				ContainerService.fetchAll();
			//else {
			//	$scope.setVars();
			//}
		};

		$scope.setVars = function() {
			$scope.selectedContainer = ContainerService.getSelectedContainer();
			$scope.stack = $scope.selectedContainer.stack;
		};

		$scope.init();

		// $rootScope events
		$scope.$on('container:changed_selected', $scope.setVars());

	}]
);