(function ($, Drupal, drupalSettings) {
	'use strict';
	Drupal.behaviors.jsDrupalPassTest = {
		attach: function(context, settings) {
			$('.js-var').once('jsDrupalPassTest').append('<button class="button">'+drupalSettings.pass_js.title+'</button>');
			console.log("test");
			}
		}
	})(jQuery, Drupal, drupalSettings);
