
seanceApp.controller('MeetingController', ['$scope', '$rootScope', '$stateParams', '$state', '$filter', 'config', 'ContainerService', 'MeetingService', 'ItemService', 'APIService', 'Meeting', 'Item',
	function($scope, $rootScope, $stateParams, $state, $filter, config, ContainerService, MeetingService, ItemService, APIService, Meeting, Item){

		$rootScope.$on('container:changed_selected', function(){
			$scope.meetings = MeetingService.getMeetings();
		});


		/* Form functions */
		$scope.newMeeting = function() {
			$scope.meeting = new Meeting();
			$scope.form = {
				name: "",
				date: "",
				place: "",
				items: [],
				errors: []
			};
		};

		$scope.editMeeting = function() {
			angular.copy($scope.meeting, $scope.form);
		};

		$scope.submitNew = function() {
			// Copy form values
			$scope.meeting.name = $scope.form.name;
			$scope.meeting.date = $scope.form.date;
			$scope.meeting.place = $scope.form.place;

			// Get current container
			container = ContainerService.getSelectedContainer();

			// Create the meeting
			MeetingService.create(container.id, $scope.meeting, function(response) {
				if (response) {
					var id = APIService.idFromLocation(response.headers('Location'));

					$scope.meeting.id = id;

					ItemService.fetchAll(id).then(function(response) {
						$scope.meeting.items = response.data;
						MeetingService.storeMeeting($scope.meeting);
						$state.go('root.meeting.view', {'id': id});
					});
				}
			}, function(response) {
				$scope.form.errors = response.data.errors.children;
			});

			return false;
		};

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

			var pos = 1;
			if ($scope.meeting.items.length > 0) {
				prevPos = $scope.meeting.items.last().position;

				if (prevPos) pos = prevPos + 1;
			}

			var item = new Item(0, $scope.form.item, "", pos);
			var value = $scope.form.item;
			$scope.form.item = "";

			if ($scope.meeting.id) {
				ItemService.create($scope.meeting.id, item).then(function(response){
					var id = APIService.idFromLocation(response.headers('Location'));

					item.id = id;

					$scope.meeting.items.push(item);
				}, function(response) {
					$scope.form.item = value;
				});
			} else {
				$scope.meeting.items.push(item);
			}

			event.preventDefault();
		};

		$scope.removeItem = function(item) {
			var index = -1;

			angular.forEach($scope.meeting.items, function(el, key){
				if (index == -1 && el.title == item.title) {
					index = key;
				}
			});

			if (index != -1) {
				if ($scope.meeting.id) {
					ItemService.delete(item).then(function(response) {
						$scope.meeting.items.splice(index, 1);
					});
				} else {
					$scope.meeting.items.splice(index, 1);
				}
			}
		};

		/* Saving functions */

		$scope.updateMeeting = function(data, meeting) {
			// avoid unnecessary traffic
			var tmp = angular.copy(meeting);
			delete tmp.items;

			MeetingService.update(tmp);

			// TODO : Implement loading state
			return true;
		};

		$scope.updateItem = function(data, item) {
			ItemService.update(item);
			
			return true;
		};

		$scope.deleteMeeting = function(meeting) {
			MeetingService.delete(meeting).then(function(response) {
				MeetingService.removeMeeting(meeting.id);
			});
		};

		/* Filtered values */

		$scope.activeMeetings = function() {
			return $filter('dateCompare')(MeetingService.getMeetings(), '>=', 'rawDate');
		};

		$scope.pastMeetings = function() {
			return $filter('dateCompare')(MeetingService.getMeetings(), '<', 'rawDate');
		};

		$scope.removeTag = function(itemIndex, tagIndex) {
			//console.log(itemIndex, tagIndex);
			$scope.items[itemIndex].tags.splice(tagIndex, 1);
		};

		$scope.init = function() {

			//if ($scope.initialized) return;

			$scope.tinymceOptions = {
				'menubar': false,
				'width': 'auto',
				'plugins': 'autoresize',
				'autoresize_bottom_margin': "30"
			};

			$scope.sortableOptions = {
			    update: function(e, ui) {
			    	console.log("[ui-sortable] Updating order!");
			    },
			    stop: function(e, ui) {
			    	console.log("[ui-sortable] Done !");
			    }
			};

			// Get route parameters (viewing a meeting)
			if ($stateParams.id) {
				$scope.meeting = MeetingService.getMeeting($stateParams.id);

				if (!$scope.meeting) {
					MeetingService.fetch($stateParams.id).then(function(response) {
	                       $scope.meeting = (new Meeting()).buildFromJson(response.data);
	                       $scope.items = $scope.meeting.items;
	                });
				} else {
					$scope.items = $scope.meeting.items;
				}

				$scope.editMeeting();
			}

			$scope.initialized = true;
		};

		$scope.init();
	}]
);