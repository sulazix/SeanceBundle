
seanceApp.service('ItemService',['APIService', 'Item', 'TagService',
	function (APIService, Item, TagService) {
		var that = this;

		that.fetchAll = function(meetingId) {
			return APIService.get('get_items', {id: meetingId});
		}

		that.create = function(tag) {
			// TODO : Send post request
		}

		that.delete = function(tag) {
			// TODO : Send delete request
		}
	}]
);