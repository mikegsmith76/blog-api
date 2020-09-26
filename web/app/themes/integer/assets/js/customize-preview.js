'use strict';

/**
 * Theme Customizer enhancements for a better user experience.
 */

/**
 * Live updating of the site title and description.
 */
(function (api, $) {
  // Site title text.
  api('blogname', function (value) {
    value.bind(function (to) {
      $('.site-title a').text(to);
    });
  });

  // Site description text.
  api('blogdescription', function (value) {
    value.bind(function (to) {
      $('.site-description').text(to);
    });
  });
})(wp.customize, jQuery);