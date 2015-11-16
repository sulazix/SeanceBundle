
seanceApp.factory('Item', [
	function() {

		function Item(id, title, description, position, tags) {
			this.id = id;
			this.title = title;
			this.description = description;
			this.position = position;
			this.tags = tags;
		}

		Item.prototype.getId = function() {
			return this.id;
		};

		Item.prototype.getTitle = function() {
			return this.title;
		};

		Item.prototype.getDescription = function() {
			return this.description;
		};

		Item.prototype.getPosition = function() {
			return this.position;
		};

		Item.prototype.getTags = function() {
			return this.tags;
		};

		Item.prototype.buildFromJson = function(json) {
			this.id = json.id;
			this.title = json.title;
			this.description = json.description;
			this.position = json.position;
			this.tags = json.tags;

			return this;
		};

		return Item;
	}]
);