
seanceApp.factory('Meeting', [
	function() {

		function Meeting(id, name, date, place, items) {
			this.id = id
			this.name = name
			this.date = date
			this.place = place
			this.items = items
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

		return Meeting;
	}]
);