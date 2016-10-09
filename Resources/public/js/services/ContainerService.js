
seanceApp.service('ContainerService',['$rootScope', '$localStorage', 'APIService', 'Container',
	function ($rootScope, $localStorage, APIService, Container) {
		var that = this;

		that.init = function() {
			that.$storage = $localStorage;

			if (!that.$storage.containers)
				that.$storage.containers = {};

			if (!that.$storage.selected)
				that.$storage.selected = 0;
		};

		/**
		 * Retrieve a specific container related to the index parameter
		 * @param  {mixed} index The key value the container is stored under
		 * @return {Container} The queried container or undefined
		 */
		that.getContainer = function(index) {
			return that.$storage.containers[index];
		};

		/**
		 * Returns all stored containers as an object
		 * @return {object} An object containing all of Container instances
		 */
		that.getContainers = function() {
			return that.$storage.containers;
		};

		/**
		 * Sets the stored list of containers to a completely new one
		 * @param {array} containers An array of JSON encoded containers
		 */
		that.setContainers = function(containers) {
			// Do nothing if the list is empty or no parameter was given
			if (!containers || containers.length <= 0) return;

			// Empty object but keep reference !
			that.$storage.containers.length = 0;
			for (var member in that.$storage.containers) {
				delete that.$storage.containers[member];
			}

			// Store every containers in the localStorage
			angular.forEach(containers, function(element, key){
				var container = (new Container()).buildFromJson(element);
				that.$storage.containers[container.id] = container;
			});

			// Default selected container is the first one
			that.$storage.selected = containers[0].id;

			$rootScope.$broadcast('container:list_updated');
		};

		that.getSelectedContainer = function() {
			return that.$storage.containers[that.$storage.selected];
		};

		that.setSelectedContainer = function(index) {
			console.log("setSelectedContainer", index);
			if (that.$storage.containers[index]) {
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