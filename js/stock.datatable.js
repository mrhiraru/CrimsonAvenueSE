$(document).ready(function () {
  dataTable = $("#stocks").DataTable({
    dom: "Brtp",
    responsive: true,
    fixedHeader: true,
    pageLength: 10,
    buttons: [],
    columnDefs: [
      {
        targets: [0, 1, 2, 3, 4, 5, 6, 7] /* column index */,
        orderable: false /* true or false */,
      },
    ],
  });
  dataTable.buttons().container().appendTo($("#MyButtons"));

  var table = dataTable;
  var filter = createFilter(table, [0, 1, 2, 3, 4, 5, 6, 7]);

  function createFilter(table, columns) {
    var input = $("input#keyword").on("keyup", function () {
      table.draw();
    });

    $.fn.dataTable.ext.search.push(function (
      settings,
      searchData,
      index,
      rowData,
      counter
    ) {
      var val = input.val().toLowerCase();

      for (var i = 0, ien = columns.length; i < ien; i++) {
        if (searchData[columns[i]].toLowerCase().indexOf(val) !== -1) {
          return true;
        }
      }

      return false;
    });

    return input;
  }
});
