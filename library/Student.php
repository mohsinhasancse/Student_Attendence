<?php
$filepath=realpath(dirname(__FILE__));
include_once ($filepath.'/Database.php');
 ?>

<?php

class Student{
private $db;

  public  function __construct(){
    $this->db = new Database();
  }
   public function getStudents()
  {
    $query = "SELECT * FROM tbl_student";
    $result= $this->db->select($query);
    return $result;
  }

public function insertStudent($name,$roll)
{
  $name = mysqli_real_escape_string($this->db->link, $name);
  $roll = mysqli_real_escape_string($this->db->link, $roll);
  if (empty($name) || empty($roll)) {
    // code...
    $msg = "<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty !</div>";
    return $msg;
  }else {
    $stu_query = "INSERT INTO tbl_student(name, roll) VALUES('$name','$roll')";
    $stu_insert = $this->db->insert($stu_query);

    $attend_query = "INSERT INTO tbl_attendance(roll) VALUES('$roll')";
    $stu_insert = $this->db->insert($attend_query);
    if ($stu_insert) {
      // code...
      $msg = "<div class='alert alert-success'><strong>Success !</strong> Student data inserted Successufully</div>";
      return $msg;
    }else {
      // code...
      $msg = "<div class='alert alert-danger'><strong>Success !</strong> Student data not inserted </div>";
      return $msg;
    }
  }

}
public function insertattendace($cur_date,$attend = array()){
  $query = "SELECT DISTINCT attend_time FROM tbl_attendance";
  $getdata = $this->db->select($query);
  while ($result =$getdata->fetch_assoc()) {
    // code...
    $db_date=$result['attend_time'];
    if ($cur_date==$db_date) {
      // code...
      $msg = "<div class='alert alert-danger'><strong>Error !</strong> Attendance already taken </div>";
      return $msg;
    }
  }
  foreach ($attend as $atn_key => $atn_value) {
    // code...
    if ($atn_value == "present") {
      // code...
      $stu_query = "INSERT INTO tbl_attendance(	roll,attend,attend_time)VALUES('$atn_key','present',now())";
      $data_insert=$this->db->insert($stu_query);
    }elseif ($atn_value == "absent") {
      // code...
      $stu_query = "INSERT INTO tbl_attendance(	roll,attend,attend_time)VALUES('$atn_key','absent',now())";
      $data_insert=$this->db->insert($stu_query);
    }
  }
  if ($data_insert) {
    // code...
    $msg = "<div class='alert alert-success'><strong>Success !</strong> Attendance data inserted Successufully</div>";
    return $msg;
  }else {
    // code...
    $msg = "<div class='alert alert-danger'><strong>Success !</strong> Attendance  data not inserted </div>";
    return $msg;
  }
}
     public function getDateList()
     {
       $query = "SELECT DISTINCT attend_time FROM tbl_attendance";
       $result = $this->db->select($query);
       return $result;
     }

            public function getAllData($dt){
              $query = "SELECT tbl_student.name, tbl_attendance.* FROM
                 tbl_student
                INNER JOIN tbl_attendance
                ON tbl_student.roll = tbl_attendance.roll
                WHERE attend_time ='$dt'";
              $result = $this->db->select($query);
              return $result;
            }

            public function updateAttendace($dt, $attend)
            {
              foreach ($attend as $atn_key => $atn_value) {
                // code...
                if ($atn_value == "present") {
                  $query ="UPDATE tbl_attendance
                  SET attend = 'present'
                  WHERE roll= '".$atn_key."' AND attend_time = '".$dt."'";
                  $data_update = $this->db->update($query);

                } elseif($atn_value == "absent") {
                $query ="UPDATE tbl_attendance
                SET attend = 'absent'
                WHERE roll= '".$atn_key."' AND attend_time = '".$dt."'";
                $data_update = $this->db->update($query);
                }
              }
              if ($data_update) {
                // code...
                $msg = "<div class='alert alert-success'><strong>Success !</strong> Attendance data updated Successufully</div>";
                return $msg;
              }else {
                // code...
                $msg = "<div class='alert alert-danger'><strong>Success !</strong> Attendance  data not updated </div>";
                return $msg;
              }
            }
}


 ?>
