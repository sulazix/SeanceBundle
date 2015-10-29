
seanceApp.service('MeetingService',['$http', 'Meeting', 'Item', 'Tag',
	function ($http, Meeting, Item, Tag) {
		var that = this;

		that.fetch = function(id) {

			var important = new Tag(1, "Important", "Marquer comme important", "red");

			var rediscuter = new Tag(2, "À rediscuter", "Marquer comme à rediscuter déplacera le point pour la prochaine réunion", "orange")

			var items = [
				new Item(1, 'Tour des branches', "", 1, [important, rediscuter] ),
				new Item(2, 'Soirée des parents', "", 2, [rediscuter]),
				new Item(3, 'Noël de groupe', "", 3, [rediscuter]),
				new Item(4, 'Formation J+S', "", 4, [rediscuter]),
				new Item(5, 'Informatique', "", 5, [rediscuter]),
				new Item(6, 'Rénouvellement du matériel', "", 6, [rediscuter]),

			];

			return new Meeting(1, 'Séance de Maîtrise', '2015-10-26', 'Lausanne', items)
		}
	}]
);