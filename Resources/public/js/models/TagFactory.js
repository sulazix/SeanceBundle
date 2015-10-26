
seanceApp.factory('Tag', [
	function() {

		function Tag(id, title, description, color) {
			this.id = id
			this.title = title
			this.description = description
			this.color = color
		}

		Tag.prototype.getId = function() {
			return this.id;
		}

		Tag.prototype.getTitle = function() {
			return this.title;
		}

		Tag.prototype.getDescription = function() {
			return this.description;
		}

		Tag.prototype.getColor = function() {
			return this.color;
		}

		return Tag;
	}]
);