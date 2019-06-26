var $ = require('jquery');

$(function() {
  $('.js-add-button').on('click', function() {
    $('.add-form').css('visibility', 'visible');
  });

  $('.js-cancel-add-form').on('click', function() {
    $('.add-form').css('visibility', 'hidden');
  });
});
