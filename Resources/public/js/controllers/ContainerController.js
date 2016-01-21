
seanceApp.controller('ContainerController', ['$scope', 'ContainerService', 'ItemService', 'APIService', 'Item',
	function($scope, ContainerService, ItemService, APIService, Item) {
		$scope.init = function() {
			if ($scope.initialized)
				return;

			// Avoid resetting variables without needed
			$scope.initialized = true;
			$scope.currentDate = new Date();
			$scope.search = "";
			$scope.form = {
				item:null
			};

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

		$scope.dropdownInit = function() {
		    $('.ui.dropdown').dropdown({
		    	transition: 'slide down'
		    });
		};

		$scope.addItem = function(event) {
			if ((event.type == "keypress" && event.keyCode != 13) || !$scope.form.item) return;

			stop = false;

			// Check if already contained
			angular.forEach($scope.selectedContainer.stack, function(item, key){
				if (item.title == $scope.form.item) {
					stop = true;
				}
			});

			if (stop) return;

			var pos = 1;
			if ($scope.selectedContainer.stack.length > 0) {
				prevPos = $scope.selectedContainer.stack.last().position;

				if (prevPos) pos = prevPos + 1;
			}

			var item = new Item(0, $scope.form.item, "", pos);
			var value = $scope.form.item;
			$scope.form.item = "";

			ItemService.createOnStack(item, $scope.selectedContainer.id).then(function(response){
					var id = APIService.idFromLocation(response.headers('Location'));

					item.id = id;

					$scope.selectedContainer.stack.push(item);
				}, function(response) {
					$scope.form.item = value;
				});

			event.preventDefault();
		};

		$scope.removeItem = function(item) {
			var index = -1;

			angular.forEach($scope.selectedContainer.stack, function(el, key){
				if (index == -1 && el.title == item.title) {
					index = key;
				}
			});

			if (index != -1) {
				ItemService.delete(item).then(function(response) {
					$scope.selectedContainer.stack.splice(index, 1);
				});
			}
		};

		$scope.init();

		// $rootScope events
		$scope.$on('container:changed_selected', $scope.setVars());

	}]
);