$(document).ready(function () {
  dataTable = $("#myorders").DataTable({
    dom: "Brtp",
    responsive: true,
    fixedHeader: true,
    pageLength: 10,
    buttons: [
      {
        extend: "pdfHtml5",
        text: "Download Receipt",
        title: "Crimson Avenue Receipt",
        pageSize: "LEGAL",
        customize: function (doc) {
          doc.styles.tableHeader.fontSize = 11;
          doc.styles.tableHeader.fontStyle = "bold";
          doc.styles.tableHeader.fillColor = "#ffffff";
          doc.styles.tableHeader.color = "#000000";

          doc.styles.tableBodyOdd.fontSize = 11;
          doc.styles.tableBodyEven.fontSize = 11;
          doc.styles.tableBodyEven.fillColor = "#ffffff";
          doc.styles.tableBodyOdd.fillColor = "#ffffff";
        },
      },
    ],
    ordering: false,
  });
  dataTable.buttons().container().appendTo($("#MyButtons"));
});
