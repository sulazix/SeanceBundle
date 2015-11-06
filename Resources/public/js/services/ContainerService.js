
seanceApp.service('ContainerService',['$rootScope', 'APIService', 'Container',
	function ($rootScope, APIService, Container) {
		var that = this;

		that.containers = [];
		that.selected = 0;

		/* Local data related functions */

		that.setContainers = function(containers) {
			// Empty array to keep reference !
			that.containers.splice(0, that.containers.length);

			angular.forEach(containers, function(container, key){
				that.containers.push((new Container()).buildFromJson(container));
			});

			$rootScope.$broadcast('container:list_updated');
		}

		that.getSelectedContainer = function() {
			return that.containers[that.selected];
		}

		that.setSelectedContainer = function(index) {
			if (that.containers.length > 0 && index >= 0 && index < that.containers.length) {
				that.selected = index;
				$rootScope.$broadcast('container:changed_selected');
				return true;
			}

			return false;
		}

		/* API Related functions */

		that.fetchAll = function(success, failure) {
			return APIService.get('get_containers').then(function(response) {
				that.setContainers(response.data);
				that.setSelectedContainer(0);
			}).then(success, failure);
		}
	}]
);