
seanceApp.controller('TagController', ['$scope', 'TagService',
	function($scope, TagService){
		
		$scope.tags = TagService.fetchAll();
	}]
);