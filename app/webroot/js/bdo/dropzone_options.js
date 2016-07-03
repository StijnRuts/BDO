Dropzone.options.scoreboardDropzone = {
  uploadMultiple: true,
  init: function() {
    this.on("successmultiple", function(event) {
      location.reload();
    });
  }
};
