var $ = require('jquery');

$(function() {
  $('.js-add-button').on('click', function() {
    $('.add-form').css('visibility', 'visible');
  });

  $('.js-cancel-add-form').on('click', function() {
    $('.add-form').css('visibility', 'hidden');
  });

  $('.js-target-text').on('change', function() {
    console.log('ajax通信開始(編集)');
    var $targetText = $(this);
    var target = $targetText.val();
    var target_id = $targetText.siblings('.js-remain-id').text();
    console.log(target);
    console.log(target_id);

    $.ajax({
      url: './ajax_myPage.php',
      type: 'POST',
      dataType: 'json',
      data: {
        target: $targetText.val(),
        id: $targetText.siblings('.js-remain-id').text()
      }
    }).done(function(data) {
      console.log('通信成功');
      console.log(data);
      $targetText.text(data.target);
    })
  });

  $('.js-target-chk').on('click', function() {
    console.log('ajax通信開始(complete押下)');
    var $targetChk = $(this);
    var chkStatus;

    if ($(this).prop('checked')) {
      chkStatus = '1' //クリック時にチェックされている場合、チェック外す
    } else {
      chkStatus = '0' //クリック時にチェックされていない場合、チェックつける
    }

    $.ajax({
      url: './ajax_myPage.php',
      type: 'POST',
      dataType: 'json',
      data: {
        chk: chkStatus,
        id: $targetChk.siblings('.js-remain-id').text()
      }
    }).done(function(data) {
      var comp_sententce = $targetChk.parent('.sententce');
      console.log(comp_sententce);
      // $targetChk.parent('.sententce').css('display', 'none');
      location.reload();
    })
  });

  $('.js-target-date').on('change', function() {
    console.log('ajax通信開始(dateチェンジ)');
    var $targetDate = $(this);
    $.ajax({
      url: './ajax_myPage.php',
      type: 'POST',
      dataType: 'json',
      data: {
        date: $targetDate.val(),
        id: $targetDate.siblings('.js-remain-id').text()
      }
    }).done(function(data) {
      console.log('ajax通信終了(dateチェンジ)');
      location.reload();
    })
  });
});
