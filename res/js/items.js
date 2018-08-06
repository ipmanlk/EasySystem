// data table settings
const dataTable = $('.table').DataTable( {
  dom: 'Bfrtip',
  buttons: [
    {
      extend: 'pdfHtml5',
      exportOptions: {
        columns: [ 0, ':visible' ]
      }
    },
    {
      extend: 'excelHtml5',
      exportOptions: {
        columns: [ 0, 1, 2, 3, 4]
      }
    },
    {
      extend: 'print',
      exportOptions: {
        columns: [ 0, 1, 2, 3, 4]
      }
    }
  ],
  responsive: true
});

$(document).ready(function() {
  //submit form
  submit();
} );

//load items to data table
function loadItems() {
  dataTable.clear();
  $.get("./tasks/getItems.php" , function(data) {
    const itemsData = JSON.parse(data);
    for (item in itemsData) {
      dataTable.row.add([
        itemsData[item].itemID,
        itemsData[item].itemDes,
        itemsData[item].stockingUM,
        itemsData[item].partNum,
        itemsData[item].qty,
        `<button type="button" class="btn btn-primary" onclick="editItem('${itemsData[item].itemID}')">Edit</button> <button type="button" class="btn btn-danger" onclick="deleteItem('${itemsData[item].itemID}')">Delete</button>`
      ]).draw();
    }
  });
}

function submit() {
  $("#addItemModalForm").submit(function(e) {
    e.preventDefault();
  });

  $("#receiveItemModalForm").submit(function(e) {
    e.preventDefault();
  });

}

//hide output alerts when user type on input field
$('input').on('keyup', function(){
  $("#addItemModalOutput").fadeOut();
  $("#receiveItemModalOutput").fadeOut();
});

function addItems() {
  $("#addItemBtn").show();
  $("#updateItemBtn").hide();
  $("#itemID").val("");
  $("#itemDes").val("");
  $("#stockingUM").val("");
  $("#partNum").val("");
  $("#qty").val("");
  $("#addItemModalOutput").hide();
  $("#addItemModal").modal('show');
}

function addItem() {
  $.ajax({
    type: 'POST',
    url: './tasks/addItem.php',
    data: $('#addItemModalForm').serialize(),
    dataType: "html",
    async: true,
    success: function(msg) {
      $("#addItemModalOutput").fadeIn();
      if (msg == 1) {
        loadItems();
        showOutputMsg("#addItemModalOutput","good","Item added.");
        //clear input form
        $('#addItemModalForm').find('input').val('');
      } else if (msg == 2) {
        showOutputMsg("#addItemModalOutput","bad","Item ID is already in the database!.");
      } else {
        showOutputMsg("#addItemModalOutput","bad","Input details are missing!.");
      }
    }
  });
}

// edit item
function editItem(itemID) {
  $.get("./tasks/getItem.php?itemID=" + itemID, function(data) {
    let itemData = JSON.parse(data);
    $("#itemID").val(itemData[0].itemID);
    $("#itemDes").val(itemData[0].itemDes);
    $("#stockingUM").val(itemData[0].stockingUM);
    $("#partNum").val(itemData[0].partNum);
    $("#qty").val(itemData[0].qty);
    $("#addItemBtn").hide();
    $("#updateItemBtn").show();
    $("#addItemModalOutput").hide();
    $("#addItemModal").modal('show');
  });
}

//update item
function updateItem() {
  $.ajax({
    type: 'POST',
    url: './tasks/updateItem.php',
    data: $('#addItemModalForm').serialize(),
    dataType: "html",
    async: true,
    success: function(msg) {
      $("#addItemModalOutput").fadeIn();
      if (msg == 1) {
        loadItems();
        showOutputMsg("#addItemModalOutput","good","Item updated.");
      } else if (msg == 4) {
        showOutputMsg("#addItemModalOutput","bad","Error.");
      } else {
        showOutputMsg("#addItemModalOutput","bad","Input details are missing!.");
      }
    }
  });
}

//delete item
function deleteItem(itemID) {
  $('#confirmModal').modal('show');
  $('#confirmDelete').click(function() {
    $.get("./tasks/deleteItem.php?itemID=" + itemID, function(data) {
      if (data == '1') {
        dataTable.clear().draw();
        loadItems();
        $('#confirmModal').modal('hide');
      } else {
        alert("Something went wrong!");
      }
    });
  })
}

function receiveItems() {
  $("#receiveItemModal").modal('show');
}

function receiveItem() {
  $.ajax({
    type: 'POST',
    url: './tasks/receiveItem.php',
    data: $('#receiveItemModalForm').serialize(),
    dataType: "html",
    async: true,
    success: function(msg) {
      $("#receiveItemModalOutput").fadeIn();
      if (msg == 1) {
        loadItems();
        showOutputMsg("#receiveItemModalOutput","good","New stock added!");
        $('#receiveItemModalForm').find('input').val('');

      } else if (msg == 4) {
        showOutputMsg("#receiveItemModalOutput","bad","Error.");
      } else {
        showOutputMsg("#receiveItemModalOutput","bad","Input details are missing!.");
      }
    }
  });
}

//show suggestions
$('#receiveItemID').on('input propertychange', function(){
  $('#receiveItemIDSuggestions').empty();
  suggestItemIDs();
});

function suggestItemIDs() {
  if (notEmpty($('#receiveItemID').val())) {
    $.get("./tasks/suggestItemID.php?itemID=" + $('#receiveItemID').val(), function(data) {
      const itemIDs = JSON.parse(data);
      if (itemIDs[0] !== null) {
        for (item in itemIDs) {
          $('#receiveItemIDSuggestions').append(`<a href="#"><li class="list-group-item" onclick="setReceiveItemID('${itemIDs[item]}')">${itemIDs[item]}</li></a>`);
        }
      }
    });
  }
}

function setReceiveItemID(val) {
  $('#receiveItemID').val(val);
  $('#receiveItemIDSuggestions').empty();
}

//show output msg
function showOutputMsg(id,type,msg) {
  if (type == "bad") {
    $(id).removeClass("alert-success");
    $(id).addClass("alert-danger");
  } else {
    $(id).removeClass("alert-danger");
    $(id).addClass("alert-success");
  }
  $(id).text(msg);
  $(id).fadeIn();
}

// //on modal Close
// $('#addItemModal').on('hidden.bs.modal', function () {
//   loadItems();
// })
//
// $('#receiveItemModal').on('hidden.bs.modal', function () {
//   loadItems();
// })

//check values is not null & empty
function notEmpty(val) {
  if (val !== null && val!=="") {
    return true;
  } else {
    return false;
  }
}
