$(function() {

  $('#ContestUsers .sortable').sortable().disableSelection();

  $('#ContestUsers .sortable').on('sortupdate', function() {
    var selected = $('.sortable').sortable('toArray');
    $(this).closest('form').find('.sortable.input').val(JSON.stringify(selected));
  });

  $('#ContestUsers input[type="checkbox"]').change(function(){
    var id = $(this).val();
    if ($(this).is(':checked')) {
      $('#ContestUsers .sortable').append(
        '<li id="'+id+'">'+ $(this).attr('data-label') +'</li>'
      )
    } else {
      $('#ContestUsers .sortable li#'+id).remove();
    }
    $('#ContestUsers .sortable').trigger('sortupdate');
  });

});
