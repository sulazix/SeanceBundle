
seanceApp.directive("sceErrors", [
	function() {
		return {
			restrict: 'A',
			scope : {
				errors: "=sceErrors"
			},
			link: function(scope, element, attrs) {
				console.log("watching");

				var update = function() {
					if (!scope.errors) return;

					var field = scope.errors[attrs.sceField];

					if (!field) return;

					var text = "";
					if (typeof field == 'object') {
						angular.forEach(field.errors, function(err, key){
							text += '<div class="item">' + err + '</div>';
						});
					} else {
						text = field;
					}

					if (text) {
						element.html('<div class="list">' + text + '</div>');
						element.show();
					} else {
						element.hide();
					}
				};

				element.hide();
				scope.$watch('errors', update);
			}
		};
}]);