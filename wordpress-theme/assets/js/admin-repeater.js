document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".tt-repeater").forEach(function (repeater) {
    var addBtn = repeater.querySelector(".tt-repeater-add");
    var rowsBody = repeater.querySelector(".tt-repeater-rows");
    var template = repeater.parentElement.querySelector(".tt-repeater-template");

    addBtn.addEventListener("click", function () {
      var index = rowsBody.children.length;
      var html = template.innerHTML.replace(/__INDEX__/g, index);
      var tmp = document.createElement("tbody");
      tmp.innerHTML = html;
      rowsBody.appendChild(tmp.firstElementChild);
    });

    repeater.addEventListener("click", function (e) {
      if (e.target.classList.contains("tt-repeater-remove")) {
        var row = e.target.closest(".tt-repeater-row");
        if (rowsBody.children.length > 1) {
          row.remove();
        } else {
          row.querySelectorAll("input, textarea").forEach(function (el) {
            el.value = "";
          });
        }
      }
    });
  });
});
