$(function() {

  $('#RoundUsers .sortable').sortable().disableSelection();

  $('#RoundUsers .sortable').on('sortupdate', function() {
    var selected = $('.sortable').sortable('toArray');
    $(this).closest('form').find('.sortable.input').val(JSON.stringify(selected));
  });

  $('#RoundUsers input[type="checkbox"]').change(function(){
    var id = $(this).val();
    if ($(this).is(':checked')) {
      $('#RoundUsers .sortable').append(
        '<li id="'+id+'">'+ $(this).attr('data-label') +'</li>'
      )
    } else {
      $('#RoundUsers .sortable li#'+id).remove();
    }
    $('#RoundUsers .sortable').trigger('sortupdate');
  });

});
