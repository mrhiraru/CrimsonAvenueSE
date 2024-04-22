$(document).ready(function () {
    dataTable = $("#myorders").DataTable({
      dom: "rtp",
      responsive: true,
      fixedHeader: true,
      pageLength: 10,
      buttons: [],
      ordering: false,
    });
  });