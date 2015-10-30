
seanceApp.service('TagService',['APIService', 'Tag',
	function (APIService, Tag) {
		var that = this;

		that.fetchAll = function() {
			success = function(data, status, header, config) {
				console.log("Success : ", data, status);

				return data;
			}

			failure = function(data, status, header, config) {
				console.log("Failure : ", data, status);

				return status;
			}

			APIService.get('_ajax_edit_tag').success(success).error(failure);
		}
	}]
);