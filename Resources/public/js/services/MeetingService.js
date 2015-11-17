
seanceApp.service('MeetingService',['$rootScope', '$filter', 'APIService', 'Meeting', 'ContainerService',
	function ($rootScope, $filter, APIService, Meeting, ContainerService) {
		var that = this;

		that.form_name = "interne_seance_meeting";

		/* Helper methods */
		that.lookup = function(id) {
			var result = false;
			angular.forEach(that.getMeetings(), function(meeting, key){
				if (meeting.id == id)
					result = meeting;
			});

			return result;
		};

		/* Accessors */

		that.getMeetings = function() {
			return ContainerService.getSelectedContainer().meetings;
		};

		that.getMeeting = function(id) {
			var result = $filter('filter')(that.getMeetings(), {'id':id});

			if (result.length)
				return result[0];
			else
				return undefined;
		};

		that.removeMeeting = function(id) {
			var index = -1;
			angular.forEach(that.getMeetings(), function(meeting, key){
				if (index == -1 && meeting.id == id)
					index = key;
			});

			that.getMeetings().splice(index, 1);
		};

		that.storeMeeting = function(meeting) {
			var entry = (new Meeting()).buildFromJson(meeting);
			that.getMeetings().push(entry);
		};


		/* API related functions */

		that.fetchAll = function(containerId) {
			// TODO : Use the container id
			return APIService.get('get_meetings');
		};

		/**
		 * Sends a request for retrieving a Meeting entity corresponding to
		 * the id passed as parameter
		 * 
		 * @param int id The id of the Meeting to be retrieved
		 * 
		 * @return Promise The resulting promise
		 */
		that.fetch = function(id) {
			return APIService.get('get_meeting', {'id': id});
		};

		/**
		 * Posts a request with data related to a new Meeting entity
		 *
		 * @param  int 	container_id The id of the container to save the meeting into
		 * @param  json meeting The JSON object of the Meeting entity
		 * @param  callback success A function to call in case of success
		 * @param  callback failure A function to call in case of failure
		 * 
		 * @return Promise 	The resulting promise
		 */
		that.create = function(container_id, meeting, success, failure) {
			log = function(response) {
				console.log(response);
			};

			return APIService.post('new_meeting',{}, that.wrap(meeting, container_id))
				.then(success, failure);
		};


		/**
		 * Posts a request with data related to an existing Meeting entity.
		 * 
		 * @param  json meeting The JSON object of the Meeting entity, the 'id' property of the JSON MUST be an valid id!
		 * @param  callback success A function to call in case of success
		 * @param  callback failure A function to call in case of failure
		 * 
		 * @return Promise 	The resulting promise
		 */
		that.update = function(meeting, success, failure) {
			var wrapped_data = that.wrap(meeting);
			
			return APIService.put('edit_meeting', {'id': meeting.id}, wrapped_data)
				.then(success, failure);
		};


		/**
		 * Sends a request to delete an existing Meeting entity.
		 * 
		 * @param  int meeting The meeting entity with property id
		 * 
		 * @return Promise 	The resulting promise
		 */
		that.delete = function(meeting, success, failure) {
			return APIService.delete('delete_meeting', {'id': meeting.id})
				.then(success, failure);
		};

		/**
		 * Automatically copies and adds the correct JSON entry for the meeting object and removes unncessary fields (such as ids).
		 *
		 * Warning: Not following this format will result in failing to use the API correctly
		 *
		 * @param  JSON meeting The meeting object that is to be wrapped
		 * @return JSON 		The wrapped meeting object
		 */
		that.wrap = function(meeting, container_id) {
			// Make a deep copy
			var copy = angular.copy(meeting);

			// Remove un-necessary fields
			delete copy.id;
			angular.forEach(copy.items, function(item, key){
				delete item.id;
				delete item.position;
				delete item.tags;
			});

			if (copy.rawDate)
				delete copy.rawDate;

			// Add container id if required
			if (container_id)
				copy.container = container_id;

			return {
				'interne_seancebundle_meeting': copy
			};
		};
	}]
);