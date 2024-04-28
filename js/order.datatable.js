$(document).ready(function () {
  dataTable = $("#myorders").DataTable({
    dom: "rtp",
    responsive: true,
    fixedHeader: true,
    pageLength: 10,
    buttons: [],
    ordering: false,
  });

  var table = dataTable;
  var filter = createFilter(table, [0, 1, 2, 3, 4]);

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

  dataTable = $("#mysales").DataTable({
    dom: "rtp",
    responsive: true,
    fixedHeader: true,
    pageLength: 10,
    buttons: [],
    ordering: false,
  });

  var table = dataTable;
  var filter = createFilter(table, [0, 1, 2, 3]);

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
