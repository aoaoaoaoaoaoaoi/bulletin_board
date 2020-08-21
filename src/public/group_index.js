$(function() {
    /*クリックイベント*/
    $('.tab-menu').on('click', function() {
      $('.tab-item').removeClass('is-active-item');
      $($(this).attr("href")).addClass('is-active-item');
      $('.tab-menu').removeClass('is-active-btn');
      $(this).addClass('is-active-btn');
    });
  });