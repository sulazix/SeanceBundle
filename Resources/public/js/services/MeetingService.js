
seanceApp.service('MeetingService',['$http', 'Meeting', 'Item', 'Tag',
	function ($http, Meeting, Item, Tag) {
		var that = this;

		that.fetch = function(id) {
			var lorem = '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris commodo turpis eget sapien semper tincidunt. Fusce id enim massa. In hac habitasse platea dictumst. Phasellus ut malesuada erat. Nulla in tempor ex. Nunc efficitur efficitur diam pharetra condimentum. Sed vitae diam nec tellus egestas ultrices et nec ligula. In erat velit, ultrices in euismod non, posuere vitae erat.</p>';

			var important = new Tag(1, "Important", "Marquer comme important", "red");

			var rediscuter = new Tag(2, "À rediscuter", "Marquer comme à rediscuter déplacera le point pour la prochaine réunion", "orange")

			var items = [
				new Item(1, 'Tour des branches', lorem + lorem, 1, [important, rediscuter] ),
				new Item(2, 'Soirée des parents', lorem, 2, [rediscuter]),
				new Item(3, 'Noël de groupe', lorem, 3, [rediscuter]),
				new Item(4, 'Formation J+S', lorem, 4, [rediscuter]),
				new Item(5, 'Informatique', lorem, 5, [rediscuter]),
				new Item(6, 'Rénouvellement du matériel', lorem, 6, [rediscuter]),

			];

			return new Meeting(1, 'Séance de Maîtrise', '2015-10-26', 'Lausanne', items)
		}
	}]
);