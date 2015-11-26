
seanceApp.service('ItemService',['APIService', 'Item',
	function (APIService, Item) {
		var that = this;

		/* Local storage functions */
		that.store = function(item) {
			console.log("Will store item here");
		};

		/* API Related functions */
		that.fetchAll = function(meeting_id) {
			return APIService.get('get_items', {id: meeting_id});
		};

		that.create = function(meeting_id, item) {
			return APIService.post('new_item', {}, that.wrap(item, meeting_id));
		};

		that.update = function(item, success, failure) {
			return APIService.put('edit_item', {'id': item.id}, that.wrap(item))
				.then(success, failure);
		};

		that.delete = function(item, sucess, failure) {
			return APIService.delete('delete_item', {'id': item.id})
				.then(success, failure);
		};

		that.wrap = function(item, meeting_id) {
			var copy = angular.copy(item);

			delete copy.id;
			if (meeting_id)
				copy.meeting = meeting_id;

			return {
				'interne_seancebundle_item': copy
			};
		};
	}]
);