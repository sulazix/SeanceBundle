
seanceApp.service('ContainerService',['$rootScope', '$localStorage', 'APIService', 'Container',
	function ($rootScope, $localStorage, APIService, Container) {
		var that = this;

		// TODO : Replace this by usage of local storage keys

		that.init = function() {
			that.$storage = $localStorage;

			if (!that.$storage.containers)
				that.$storage.containers = [];

			if (!that.$storage.selected)
				that.$storage.selected = 0;
		};

		/* Accessors */
		that.getContainer = function(index) {
			if (index < 0) return undefined;

			return that.$storage.containers[index];
		};

		that.getContainers = function() {
			return that.$storage.containers;
		};


		that.setContainers = function(containers) {
			// Empty array to keep reference !
			that.$storage.containers.splice(0, that.$storage.containers.length);

			angular.forEach(containers, function(container, key){
				that.$storage.containers.push((new Container()).buildFromJson(container));
			});

			$rootScope.$broadcast('container:list_updated');
		};

		that.getSelectedContainer = function() {
			return that.$storage.containers[that.$storage.selected];
		};

		that.setSelectedContainer = function(index) {
			if (that.$storage.containers.length > 0 && index >= 0 && index < that.$storage.containers.length) {
				that.$storage.selected = index;
				$rootScope.$broadcast('container:changed_selected');
				return true;
			}

			return false;
		};

		/* API Related functions */

		that.fetchAll = function(success, failure) {
			return APIService.get('get_containers').then(function(response) {
				that.setContainers(response.data);
				that.setSelectedContainer(0);
			}).then(success, failure);
		};

		/* Init */
		that.init();
	}]
);