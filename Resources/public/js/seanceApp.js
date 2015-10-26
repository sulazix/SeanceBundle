/**
 * This file instantiates the main angular app and passes the main module
 * dependencies to it.
 * 
 * DO NOT FORGET TO LOAD THIS FILE BEFORE EVERY OTHER FILE (except angular itself)
 */

var seanceApp = angular.module('seanceApp', ['xeditable', 'ngSanitize', 'ui.tinymce'])
;

seanceApp.run(function(editableOptions, editableThemes) {
	editableOptions.theme = 'default';

	editableThemes['default'].submitTpl = '<button type="submit" class="editable-submit ui tiny circular green icon button"><i class="checkmark icon"></i></button>'
	editableThemes['default'].cancelTpl = '<button type="button" class="editable-cancel ui tiny circular red icon button"><i class="remove icon" ng-click="$form.$cancel()"></i></button>'

})