document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".tt-image-field").forEach(function (field) {
    var idInput = field.querySelector(".tt-image-id");
    var preview = field.querySelector(".tt-image-preview");
    var selectBtn = field.querySelector(".tt-image-select");
    var removeBtn = field.querySelector(".tt-image-remove");
    var frame;

    selectBtn.addEventListener("click", function () {
      if (frame) {
        frame.open();
        return;
      }
      frame = wp.media({
        title: "Select image",
        multiple: false,
        library: { type: "image" },
      });
      frame.on("select", function () {
        var attachment = frame.state().get("selection").first().toJSON();
        idInput.value = attachment.id;
        preview.src = attachment.sizes && attachment.sizes.medium ? attachment.sizes.medium.url : attachment.url;
        preview.style.display = "block";
        removeBtn.style.display = "inline-block";
        selectBtn.textContent = "Change image";
      });
      frame.open();
    });

    removeBtn.addEventListener("click", function () {
      idInput.value = "";
      preview.style.display = "none";
      removeBtn.style.display = "none";
      selectBtn.textContent = "Select image";
    });
  });
});
