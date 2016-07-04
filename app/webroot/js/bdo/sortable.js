$(function() {

  $('.connectedSortable').sortable({
    connectWith: '.connectedSortable',
    update: function() {
      var selected = $('.connectedSortable.main').sortable('toArray');
      console.log(selected);
      $(this).closest('form').find('.sortable.input').val(JSON.stringify(selected));
    }
  }).disableSelection();

});


//var url = $(this).closest('form').attr('action');
//$.post(url, $('.connectedSortable.main').sortable('serialize'));
