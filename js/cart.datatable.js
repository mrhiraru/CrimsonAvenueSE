$(document).ready(function () {
  dataTable = $("#cart").DataTable({
    dom: "lrtp",
    responsive: true,
    fixedHeader: true,
    paging: false,
    buttons: [],
    ordering: false,
  });

  var counter = 0;
  while (true) {
    if ($("#cart" + counter).is("*")) {
      dataTable = $("#cart" + counter).DataTable({
        dom: "lrtp",
        responsive: true,
        fixedHeader: true,
        paging: false,
        buttons: [],
        ordering: false,
      });
      counter++;
    } else {
      break;
    }
  }
});
