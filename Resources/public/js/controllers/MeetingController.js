
seanceApp.controller('MeetingController', ['$scope',
	function($scope){
		var lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris commodo turpis eget sapien semper tincidunt. Fusce id enim massa. In hac habitasse platea dictumst. Phasellus ut malesuada erat. Nulla in tempor ex. Nunc efficitur efficitur diam pharetra condimentum. Sed vitae diam nec tellus egestas ultrices et nec ligula. In erat velit, ultrices in euismod non, posuere vitae erat.'

		// TODO : Replace this by an ajax query
		$scope.points = [
			{'title': "Tour des branches", 'description': lorem, 'id': 'p1', tags: [{'label':'Important', 'color':'red'}, {'label':'A rediscuter', 'color':'orange'}]},
			{'title': 'Soirée des parents', 'description': lorem, 'id': 'p2', 'tags': []},
			{'title': 'Noël de groupe', 'description': lorem, 'id': 'p3', 'tags': []},
			{'title': 'Formation J+S', 'description': lorem, 'id': 'p4', 'tags': []},
			{'title': 'Informatique', 'description': lorem, 'id': 'p5', 'tags': []},
			{'title': 'Rénouvellement du matériel', 'description': lorem, 'id': 'p6', 'tags': []},
		]

		
		$scope.updatePoint = function(data) {
			console.log("coucou");
			//$scope.points[index].title = data
			return true
		}
	}]
);