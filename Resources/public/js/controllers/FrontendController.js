
seanceApp.controller('FrontendController', ['$scope', '$location',
	function($scope, $location){
		$scope.init = function() {
		};

		$scope.toCheckbox = function(options) {
			$('.ui.checkbox').checkbox(options);
		};

		$scope.toAccordion = function(options) {
			$('.ui.accordion')
			  .accordion(options)
			;
		};

		$scope.toPopup = function(options) {

			$('.ui.popup-activate')
			  .popup(options)
			;
		};

		$scope.getActiveMenuItemClass = function(path) {
			if ($location.path().substr(0, path.length) === path) {
				return 'active';
			} else {
				return '';
			}
		};

		$scope.init();

	}]
);