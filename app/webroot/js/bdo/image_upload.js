function readURL(input) {
  if (input.files && input.files[0] && FileReader) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(input).closest('.image-upload')
        .find('img.image-preview')
        .attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(function() {
  $(".image-upload .image-input").change(function() {
    readURL(this);
  });
});
