
seanceApp.factory('Container', ['Meeting',
	function(Meeting) {

		function Container(id, title, description, meetings, items) {
			this.id = id
			this.title = title
			this.description = description
			this.meetings = [];

			var that = this;
			angular.forEach(meetings, function(meeting, key){
				that.meetings.push((new Meeting()).buildFromJson(meeting))
			});
			
			this.stack = items
		}

		/* Public methods through prototype */

		Container.prototype.getId = function() {
			return this.id;
		}

		Container.prototype.getTitle = function() {
			return this.title;
		}

		Container.prototype.getDescription = function() {
			return this.description;
		}

		Container.prototype.getMeetings = function() {
			return this.meetings;
		}

		Container.prototype.getStack = function() {
			return this.stack;
		}

		Container.prototype.buildFromJson = function(json) {
			this.id = json.id;
			this.title = json.title;
			this.description = json.description;
			this.meetings = [];

			var that = this;
			angular.forEach(json.meetings, function(meeting, key){
				that.meetings.push((new Meeting()).buildFromJson(meeting))
			});
			
			this.stack = json.stack_of_items;

			return this;
		}

		return Container;
	}]
);