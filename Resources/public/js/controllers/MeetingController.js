
seanceApp.controller('MeetingController', ['$scope', '$rootScope', '$stateParams', '$state', '$filter', 'ContainerService', 'MeetingService', 'Meeting', 'Item',
	function($scope, $rootScope, $stateParams, $state, $filter, ContainerService, MeetingService, Meeting, Item){

		$rootScope.$on('container:changed_selected', function(){
			$scope.meetings = MeetingService.getMeetings();
		});

		if ($stateParams.id) {
			MeetingService.fetch($stateParams.id).then(function(response) {
				$scope.meeting = response.data;
				$scope.items = $scope.meeting.items;
			})
		}

		$scope.newMeeting = function() {
			$scope.meeting = new Meeting();
			$scope.form = {
				name: "",
				date: "",
				place: "",
				items: []
			}
		}

		$scope.submitNew = function() {
			$scope.meeting.name = $scope.form.name;
			$scope.meeting.date = $scope.form.date;
			$scope.meeting.place = $scope.form.place;
			// Items are already objects

			container = ContainerService.getSelectedContainer();
			MeetingService.create(container, $scope.meeting);

			return false;
		}

		$scope.addItem = function(event) {
			if ((event.type == "keypress" && event.keyCode != 13) || !$scope.form.item) return;

			stop = false;

			// Check if already contained
			angular.forEach($scope.meeting.items, function(item, key){
				if (item.title == $scope.form.item) {
					stop = true;
				}
			});

			if (stop) return;

			var item = new Item(0, $scope.form.item);
			$scope.meeting.items.push(item);
			$scope.form.item = "";

			event.preventDefault();
		}

		$scope.removeItem = function(item) {
			var index = -1;

			angular.forEach($scope.meeting.items, function(el, key){
				if (index == -1 && el.title == item.title) {
					index = key;
				}
			});

			if (index != -1)
				$scope.meeting.items.splice(index, 1)
		}

		$scope.activeMeetings = function() {
			return $filter('dateCompare')($scope.meetings, '>=');
		}

		$scope.pastMeetings = function() {
			return $filter('dateCompare')($scope.meetings, '<');
		}
		
		$scope.updatePoint = function(data) {
			// TODO : Envoyer la requete de mise à jour sur le serveur
			console.log("Do someting before saving");
			return true;
		}

		$scope.removeTag = function(itemIndex, tagIndex) {
			//console.log(itemIndex, tagIndex);
			delete $scope.items[itemIndex].tags.splice(tagIndex, 1);
		}

		$scope.init = function() {

			if ($scope.initialized) return;

			$scope.initialized = true;

			$scope.tinymceOptions = {
				'menubar': false,
				'width': 'auto',
				'plugins': 'autoresize',
				'autoresize_bottom_margin': "30"
			};

			$scope.sortableOptions = {
			    update: function(e, ui) {
			    	console.log("[ui-sortable] Updating order!")
			    },
			    stop: function(e, ui) {
			    	console.log("[ui-sortable] Done !");
			    }
			};
		}

		$scope.init();
	}]
);