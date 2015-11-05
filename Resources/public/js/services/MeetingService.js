
seanceApp.service('MeetingService',['APIService', 'Meeting',
	function (APIService, Meeting) {
		var that = this;

		that.fetchAll = function(containerId) {
			// TODO : Use the container id
			return APIService.get('get_meetings');
		}

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
		}

		/**
		 * Posts a request with data related to a new Meeting entity
		 * 
		 * @param  json meeting The JSON object of the Meeting entity
		 * 
		 * @return Promise 	The resulting promise
		 */
		that.create = function(meeting) {
			// TODO : Send post request
		}


		/**
		 * Posts a request with data related to an existing Meeting entity.
		 * 
		 * @param  json meeting The JSON object of the Meeting entity, the 'id' property of the
		 * JSON MUST be an existing id!
		 * 
		 * @return Promise 	The resulting promise
		 */
		that.update = function(meeting) {
			// TODO : Send update request
		}


		/**
		 * Sends a request to delete an existing Meeting entity.
		 * 
		 * @param  int id The id of the meeting
		 * 
		 * @return Promise 	The resulting promise
		 */
		that.delete = function(id) {
			// TODO : Send a delete request
		}
	}]
);