<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location:./index.html");
}
?>

<html>  
      <head>  
           <title>PHP Ajax Crud - Insert Update Delete with Stored Procedure</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
      </head>  
      <body>  
      <nav class="navbar navbar-light bg-primary">
        
        <button type="button" class="btn btn-success" id="addcat">Add category</button>
        <button type="button" class="btn btn-success" id="addexp">Add expense</button>
        <a class="logout" href="./Controllers/logout.php" style="margin-left:50%;color:black">Logout</a>


      </nav>
        <select id="category" class="form-control form-control-lg mt-5" style="margin-top:5%;text-align-last:center;" > </select>
        

        
        <!-- category modal popup -->
        <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Add category</h4>
                 

            </div>
            <div class="modal-body">
            <div class="form-group">
                <label for="formGroupExampleInput">Category name</label>
                <input type="text" class="form-control" id="addCategory" name="category"  placeholder="Example input">
                </div>
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="insertcategory">Save changes</button>
            </div>
        </div>
    </div>
</div>
          <!-- <select name="category" id="category"></select> -->

          <!-- edit/add expense modal popup -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" id="myModalLabel">Edit expanse</h4>
                 

            </div>
            <div class="modal-body">
            <div class="form-group">
                <label for="formGroupExampleInput">Amount</label>
                <input type="text" class="form-control" name="amount" id="amount" placeholder="Example input">
                </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Date</label>
                <input type="date" class="form-control" name="date" id="date" placeholder="Another input">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update">Save changes</button>
            </div>
        </div>
    </div>
</div>
      
      <div class="col-sm-12 col-md-12" align="center" id="records">
          <table class="table table-striped mt-5">
            <thead>
              <tr>
                <th class="bg-primary" scope="col ">category</th>
                <th class="bg-primary" scope="col">Amount</th>
                <th class="bg-primary" scope="col">date</th>
                <th class="bg-primary" scope="col"></th>
                <th class="bg-primary" scope="col"></th>
               
              </tr>
            </thead>
            <tbody id="records_table">
              
            </tbody>
          </table>
        </div>

        <!-- <script src="js/fetch.js"></script> -->


        <script>  

sessionID = $('#category').find(":selected").data('uid');
async function fetchAPI() {
  const response = await fetch(
    "http://localhost/expensisTracker/Controllers/api/select.php?id=1"
  );
  if (!response.ok) {
    const message = "An Error has occured";
    throw new Error(message);
  }

  const results = await response.json();
  return results;
}
async function fetchCategoryAPI() {
  const response = await fetch(
    "http://localhost/expensisTracker/Controllers/api/selectCategory.php?id=1"
  );
  if (!response.ok) {
    const message = "An Error has occured";
    throw new Error(message);
  }

  const cat = await response.json();
  return cat;
}

async function postAjax(id) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensisTracker/Controllers/api/delete.php",
      data: { uid: id },
    });
  } catch (error) {
    console.log(error);
  }
}

async function updateCategoryAjax(names, id) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensisTracker/Controllers/api/addCategory.php",
      data: {
        userID: id,
        name: names
 
      },
    });
  } catch (error) {
    console.log(error);
  }
}

async function updateAjax(id, amo, dat) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensisTracker/Controllers/api/update.php",
      data: {
        uid: id,
        amount: amo,
        date: dat,
      },
    });
  } catch (error) {
    console.log(error);
  }
}


async function crreatExpenseAjax(id, amo, dat, cat_id) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensisTracker/Controllers/api/createExpense.php",
      data: {
        uid: id,
        amount: amo,
        date: dat,
        category_id: cat_id
      },
    });
  } catch (error) {
    console.log(error);
  }
}


$(document).ready(function () {
  getData();
});
function getData() {
  fetchCategoryAPI()
    .then((category) => {
      console.log(category);
      $.each(category, function (i, p) {
        console.log("category", category);
        //create options for select from json data for categories
        $("#category").append($('<option class="cat"  data-cat="' + p.id + '" data-uid="' + p.user_id + '"</option>').val(p.name).html(p.name));
      }); }).catch((error) => {
      console.log(error.message);
    })
      fetchAPI()
    .then((results) => {
      console.log(results);
     
     //create table from json data
      var trHTML = "";
      $.each(results, function (i, item) {
        trHTML +=
          "<tr><td>" +
          item.name +
          "</td><td>" +
          item.amount +
          "</td><td>" +
          item.date +
          "</td><td>" +
          '<button type="button" value="' +
          item.id +
          '" class="btn btn-danger delete">Delete</button>' +
          "</td><td>" +
          '<button type="button" value="' +
          item.id +
          '" class="btn btn-primary edit">edit</button>' +
          "</td></tr>";
      });
      $("#records_table").append(trHTML);

      //filters table according to select tag option
    $("#filter").change(function(){
    $("#records_table").children('tbody').children('tr').not(':first').each(function(){
        var match = false;
        $(this).children('td').each(function() {
            if($(this).text() == $("#filter").val()) match = true;
        });
        if(match) $(this).show();
        else $(this).hide();
    });
})


      $(".delete").click(function () {
        var cli = $(this).val();
        postAjax(cli);
     
        $(this).closest("tr").remove();
  
      });



      $(".edit").click(function () {
        var cli = $(this).val();
        $(".update").val(cli);
        $("#myModal").modal("show");
        $(".update").click(function () {
          amount = $("#amount").val();
          date = $("#date").val();
            console.log('date',date)
          updateAjax(cli, amount, date);
         
          $("#myModal").modal("hide");
         
         
        });
      
        row = $(this).closest('tr');
        row.find('td:eq(1)').text(amount)
        row.find('td:eq(2)').text(date)
        
      
      });

      $("#addexp").click(function () {
      
        $("#myModal").modal("show");
        $(".update").click(function () {
          amount = $("#amount").val();
          date = $("#date").val();
          userID = $('#category').find(":selected").data('uid');
          categoryID = $('#category').find(":selected").data('cat');
            console.log(userID, amount, date, categoryID)
            crreatExpenseAjax(userID, amount, date, categoryID);
         
          $("#myModal").modal("hide");
         
         
        });});


      $('#category').change(function() {
   
   var selection = $(this).val();
    var dataset = $('table').find('tr');
 
   dataset.show();
   
   dataset.filter(function(index, item) {
     return $(item).find('td:first-child').text().split(',').indexOf(selection) === -1;
   }).hide();

 });
      $("#addcat").click(function () {
        
        // $(".update").val(cli);
        $("#addmodal").modal("show");
        $("#insertcategory").click(function () {
          
          var name = $('#addCategory').val();
          var userID = $('.cat').data('uid');
          console.log(name,userID);
            updateCategoryAjax(name, userID);
         
          $("#addmodal").modal("hide");
         
         
        });
    })

      
    })
    .catch((error) => {
      console.log(error.message);
    });
}



      

  
 </script>  
      </body>  
 </html>  