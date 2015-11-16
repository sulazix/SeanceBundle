/**
 * This file instantiates the main angular app and passes the main module
 * dependencies to it.
 * 
 * DO NOT FORGET TO LOAD THIS FILE BEFORE EVERY OTHER FILE (except angular itself)
 */

if(!Array.prototype.last) {
	Array.prototype.last = function() {
		return this[this.length - 1];
	};
}

var seanceApp = angular.module('seanceApp', ['xeditable', 'ngSanitize', 'ui.sortable', 'ui.tinymce', 'ui.router', 'ngStorage']);

seanceApp.run(['editableOptions', 'editableThemes', 
	function(editableOptions, editableThemes) {
		editableOptions.theme = 'default';

		editableThemes['default'].submitTpl = '<button type="submit" class="ui tiny circular green icon button"><i class="white checkmark icon"></i></button>';
		editableThemes['default'].cancelTpl = '<button type="button" ng-click="$form.$cancel()" class="ui tiny circular red icon button"><i class="white remove icon"></i></button>';
	}
]);