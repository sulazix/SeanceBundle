
seanceApp.factory('Meeting', ['$filter', 'config',
	function($filter, config) {

		function Meeting(id, name, date, place, items) {
			this.id = id
			this.name = name
			this.rawDate = date;
			this.date = $filter('date')(date, config.dateFormat)
			this.place = place
			this.items = (items)? items : [];
		}

		/* Public methods through prototype */

		Meeting.prototype.getId = function() {
			return this.id;
		}

		Meeting.prototype.getName = function() {
			return this.name;
		}

		Meeting.prototype.getDate = function() {
			return this.date;
		}

		Meeting.prototype.getPlace = function() {
			return this.place;
		}

		Meeting.prototype.getItems = function() {
			return this.items;
		}

		Meeting.prototype.buildFromJson = function(json) {
			this.id = json.id;
			this.name = json.name;
			this.rawDate = json.date;
			this.date = $filter('date')(json.date, config.dateFormat)
			this.place = json.place;
			this.items = (json.items) ? json.items : [];

			return this;
		}

		return Meeting;
	}]
);