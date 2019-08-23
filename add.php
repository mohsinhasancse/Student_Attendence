<?php
include 'include\header.php';
include 'library\Student.php';
?>
<?php
$stu = new Student();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // code...
  $name = $_POST['name'];
  $roll = $_POST['roll'];
  $insertdata = $stu->insertStudent($name,$roll);
}
 ?>
 <?php
       if (isset($insertdata)) {
         // code...
         echo $insertdata;
       }

  ?>

   <div class="panel panel-default">
     <div class="panel-heading">
       <h2>
         <a class="btn btn-success" href="add.php">Add Student</a>
         <a class="btn btn-info pull-right" href="index.php">Back</a>
       </h2>
     </div>

     <div class="panel-body">
       <form class="" action="" method="post">
             <div class="form-group">
               <label for="name">Student Name</label>
               <input type="text" class="form-control" name="name" id="name">
             </div>
             <div class="form-group">
               <label for="roll">Student Roll</label>
               <input type="text" class="form-control" name="roll" id="roll">
             </div>
             <div class="form-group">
               <input type="submit" class="btn btn-info" name="submit" value="Add Studnt">
             </div>
       </form>
     </div>
   </div>
<?php include 'include\footer.php'; ?>
