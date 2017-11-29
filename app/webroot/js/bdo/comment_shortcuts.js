$(function() {
  $('.shortcut.button').on('click', function(e) {
    e.preventDefault();
    var comment = $(this).attr('data-comment');
    toggleComment(comment);
    setButtonStates();
  });
  $('#CommentComment').on('change', setButtonStates);
  $('#CommentComment').on('keyup', setButtonStates);
  setButtonStates();
});

function toggleComment(comment) {
  if (isCommentPresent(comment)) {
    removeComment(comment);
  } else {
    addComment(comment);
  }
}

function addComment(comment) {
  var field = $('#CommentComment');
  var comments = field.val();
  if (comments.length > 0) {
    comments += "\n";
  }
  comments += comment;
  field.val(comments);
}

function removeComment(comment) {
  var condition = getCommentRegexp(comment);
  var field = $('#CommentComment');
  var comments = splitLines(field.val());
  comments = comments.filter(function(item) {
    return !condition.test(item);
  });
  field.val(joinLines(comments));
}

function isCommentPresent(comment) {
  var condition = getCommentRegexp(comment);
  var comments = splitLines($('#CommentComment').val());
  return comments.some(function(item) {
    return condition.test(item);
  })
}

function getCommentRegexp(comment) {
  var conditionPart = escapeRegExp(comment).replace(new RegExp(' ', 'g'), ' +');
  var condition = new RegExp('^\\s*' + conditionPart + '\\s*$', 'i');
  return condition;
}

var setButtonStates = debounce(function() {
  $('.shortcut.button').each(function() {
    var comment = $(this).attr('data-comment');
    if (isCommentPresent(comment)) {
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

function splitLines(string) {
  return string.split(/\r?\n/);
}

function joinLines(lines) {
  return lines.join('\n');
}
