$(function() {
  $('.shortcut.button').on('click', function(e) {
    e.preventDefault();
    var comment = $(this).attr('data-comment');
    addComment(comment);
    setButtonStates();
  });
  $('#CommentComment').on('change', setButtonStates);
  $('#CommentComment').on('keyup', setButtonStates);
  setButtonStates();
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

var setButtonStates = debounce(function() {
  var comments = $('#CommentComment').val();
  $('.shortcut.button').each(function() {
    var comment = $(this).attr('data-comment');
    var conditionPart = escapeRegExp(comment).replace(new RegExp(' ', 'g'), ' +');
    var condition = new RegExp('^\\s*' + conditionPart + '\\s*$', 'mi');
    if (condition.test(comments)) {
      $(this).addClass('primary').removeClass('secondary');
    } else {
      $(this).addClass('secondary').removeClass('primary');
    }
  });
}, 250);


// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.
function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};

function escapeRegExp(str) {
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}
