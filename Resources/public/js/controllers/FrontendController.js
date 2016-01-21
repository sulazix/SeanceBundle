
seanceApp.controller('FrontendController', ['$scope', '$location', 'config',
	function($scope, $location, config){
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

		$scope.toDatetimePicker = function() {
	        $('.datetimepicker').datetimepicker({
	        	format: config.datetimePickerFormat,
	        	step: 15
	        });
		};

		$scope.toTabs = function() {
    		$('.ui.tab_controller .item').tab();
		};

		$scope.toSticky = function() {
			angular.element(document).ready(function() {
				$('.ui.sticky')
			        .sticky({
			            context: '#stickyContext',
			            offset: 100
			        });	
			});
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