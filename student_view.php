<?php
include 'include\header.php';
include 'library\Student.php';
?>

<script type="text/javascript">
$(document).ready(function(){
  $("form").submit(function(){
    var roll=true;
    $(':radio').each(function(){
      name = $(this).attr('name');
      if(roll && !$(':radio[name="' + name + '"]:checked').length){
        alert(name + "Roll Missing !");

        roll=false;
      }
    });
    return roll;
  });
});

</script>

<?php
$stu = new Student();
$dt = $_GET['dt'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $attend = $_POST['attend'];
 $att_update = $stu->updateAttendace($dt,$attend);
}
 ?>
 <?php
       if (isset($att_update)) {
         echo $att_update;
       }
?>

   <div class="panel panel-default">
     <div class="panel-heading">
       <h2>
         <a class="btn btn-success" href="add.php">Add Student</a>
         <a class="btn btn-info pull-right" href="date_view.php">Back </a>
       </h2>
     </div>

     <div class="panel-body">
       <div class="well text-center" style="font-size:25px">
         <strong>Date:</strong> <?php  echo $dt; ?>
       </div>
       <form class="" action="" method="post">
         <table class="table table-striped">
           <tr>
             <th width="25%">Serial</th>
             <th width="25%">Student Name</th>
             <th width="25%">Student Roll</th>
             <th width="25%">Attendance</th>
           </tr>

           <?php

            $get_student = $stu->getAllData($dt);
            if ($get_student) {
              $i = 0;
              while ($value =  $get_student->fetch_assoc()) {
               $i++;

            ?>
            <tr>
              <td><?php echo $i; ?>1</td>
              <td><?php echo $value['name']; ?></td>
              <td><?php echo $value['roll']; ?></td>
              <td>
                <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="present" <?php if($value['attend'] == "present") {echo "checked";}
                 ?>>Present
                <input type="radio" name="attend[<?php echo $value['roll']; ?>]" value="absent" <?php if($value['attend'] == "absent") {echo "checked";}
                 ?>>Absent
              </td>
            </tr>

         <?php   } } ?>

         <tr>
          <td colspan="4">
            <input type="submit" class="btn btn-primary" name="submit" value="Update">
          </td>
         </tr>

         </table>
       </form>

     </div>
   </div>
<?php include 'include\footer.php'; ?>
