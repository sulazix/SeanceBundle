
seanceApp.service('TagService',['APIService', 'Tag',
	function (APIService, Tag) {
		var that = this;

		that.fetchAll = function() {
			success = function(data, status, header, config) {
				console.log("Success : ", data, status);

				return data;
			};

			failure = function(data, status, header, config) {
				console.log("Failure : ", data, status);

				return status;
			};

			//APIService.get('_ajax_edit_tag').success(success).error(failure);
		};

		that.fetchForItem = function(itemId) {
			// TODO : Send a get request to retrieve tags for an item
		};

		that.create = function(tag) {
			// TODO : Send a post request to create a new tag
		};

		that.delete = function(tag) {
			// TODO : Send a delete request to delete an existing tag
		};
	}]
);