$(function() {
  $('.shortcut.button').on('click', function(e) {
    e.preventDefault();
    var comment = $(this).attr('data-comment');
    addComment(comment);
  });
});

function addComment(comment) {
  var field = $('#CommentComment');
  var comments = field.val();
  if (comments.length > 0) {
    comments += "\n";
  }
  comments += comment;
  field.val(comments);
}
