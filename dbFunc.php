<?php  
//session_start();
require_once 'dbConnect.php';  

    class dbFunc {
        private $db;
        public function __construct() {  
            $this->db = new dbConnect();   
        }  

        function Insertdata($table,$field,$data)
        {
            $field_values= implode(',',$field);
            $data_values=implode("','",$data);
        
            $sql= "INSERT INTO $table (".$field_values.")
        VALUES ('".$data_values."') ";
            $result = mysqli_query($this->db->conn,$sql);
            if($result)
            {
                return 1;
//                echo "<script>location.href='login.php'</script>";
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
die;
                return 0;
            }
        }
        function loginprocess($eid,$password)
        {
            $ret = mysqli_query($this->db->conn, "SELECT * FROM login_details WHERE username='$eid'");
            $row = mysqli_fetch_assoc($ret);
            $pasw=$row['password'];
            $id=$row['username'];
            $_SESSION['username']=$row['username'];
            if (password_verify($password,$pasw))
            {
              $row = mysqli_fetch_assoc($ret);
            }
            else
            {
                echo "<script>alert('Wrong password or username);</script>";
                echo "<script>location.href='login.php'</script>";
            }
            return $id;
        }
        
        function getdata($table,$field,$where,$id)
        {
            $field_values= implode(',',$field);
            $sql= "SELECT $field_values FROM $table where $where='$id'";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                $num = sizeof($field);
                $row = mysqli_fetch_assoc($result);
                for ($i=0;$i<$num;$i++)
                {
                    $_SESSION[$field[$i]] = $row[$field[$i]];
                }

                echo "<script>location.href='index.php'</script>";
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }
        }
        function fetch_data($seid,$field,$table)
        {
         $sql = "select * from $table where username='$seid'";
         $result = mysqli_query($this->db->conn, $sql);
         if($result)
            {
                $row = mysqli_fetch_assoc($result);
                return $row;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }

<?php
class db{
  private $server = "localhost";
  private $dbuser = "root";
  private $dbpassword = "root";
  private $dbname="Travel";
  public $conn;

  public function dbconnector()  {
      $this->conn = new mysqli($this->server,$this->dbuser,$this->dbpassword,$this->dbname);
      return $this->conn;
  }

  function update_data($table_name, $form_data,$story_id)
        {
        $valueSets = array();
        foreach($form_data as $key => $value) {
        $valueSets[] = $key . " = '" . $value . "'";
        }
        $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE story_id = '".$story_id."'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_query($this->conn, $sql)) {
        }
        else
        {
            $sql = " Select id,sid,name,body,date from comments where sid = $sid order by  id desc  ;";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                while($row = mysqli_fetch_assoc($result))
                {
//                    print_r($row);die;
                    $solutions[$row['id']] = $row;
                }
                return $solutions;
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        echo "Error: " . $sql . "" . mysqli_error($conn);
        }
      }

      function delete_image($table_name, $form_data,$story_id,$travel_id)
        {
        $valueSets = array();
        foreach($form_data as $key => $value) {
        $valueSets[] = $key . " = '" . $value . "'";
        }
        $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE story_id = '".$story_id."'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_query($this->conn, $sql)) {
         header('location:delete_images.php?travel_id=' . $travel_id);
        }
        else
        {
            $sql = " Select $select from reaction where sid = $sid and user = '$user'";
            $result = mysqli_query($this->db->conn, $sql);
            if($result)
            {
                if($row = mysqli_fetch_assoc($result))
                {
                    $solutions = $row;
                    return $solutions;
                }
                
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                exit(1);
            }
        echo "Error: " . $sql . "" . mysqli_error($conn);
        }
      }

      function delete_user($table_name, $form_data,$story_id,$travel_id)
        {
        $valueSets = array();
        foreach($form_data as $key => $value) {
        $valueSets[] = $key . " = '" . $value . "'";
        }
        function like_count($sid,$check)
        $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE story_id = '".$story_id."'";
        $result = mysqli_query($this->conn, $sql);
        if (mysqli_query($this->conn, $sql)) {
         header('location:delete_images.php?travel_id=' . $travel_id);
        }
        else
        {
        echo "Error: " . $sql . "" . mysqli_error($conn);
        }
        public function insertstories($table_name, $data)
        {

            $string = "INSERT INTO ".$table_name." (";
            $string .= implode(",", array_keys($data)) . ') VALUES (';
            $string .= "'" . implode("','", array_values($data)) . "')";
            try{
                $res =  mysqli_query($this->db->conn, $string);
                print_r($res);
                header("Location: stories.php");
            }catch(Exception $e){
                echo $e->getMessage(); die;
            }
        }

        public function search(){
            $check = mysqli_query($this->db->conn, "SELECT * FROM stories");

            // $result = mysqli_fetch_array($check);
            return $check;

        }

        public function viewdetail($id){
            $check = mysqli_query($this->db->conn, "SELECT * FROM stories where id='$id'");
            return $check;
        }

        public function takesdetail($id){
            $check = mysqli_query($this->db->conn, "SELECT * FROM stories where id='$id'");
            return $check;
        }

        public function updatestories($table_name, $form_data,$story_id)
        {
            {
                $valueSets = array();
                foreach($form_data as $key => $value) {
                    $valueSets[] = $key . " = '" . $value . "'";
                }
                $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE id = '".$story_id."'";
                $result = mysqli_query($this->db->conn, $sql);
                if (mysqli_query($this->db->conn, $sql)) {

                }
                else
                {
                    echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
                }
            }
        }
        function update_data($table_name, $form_data,$story_id)
        {
            $valueSets = array();
            foreach($form_data as $key => $value) {
                $valueSets[] = $key . " = '" . $value . "'";
            }
            $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE story_id = '".$story_id."'";
            $result = mysqli_query($this->db->conn, $sql);
            if (mysqli_query($this->db->conn, $sql)) {

            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }
        }

        function delete_image($table_name, $form_data,$story_id,$travel_id)
        {
            $valueSets = array();
            foreach($form_data as $key => $value) {
                $valueSets[] = $key . " = '" . $value . "'";
            }
            $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE story_id = '".$story_id."'";
            $result = mysqli_query($this->db->conn, $sql);
            if (mysqli_query($this->db->conn, $sql)) {
                header('location:delete_images.php?travel_id=' . $travel_id);
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }
        }

        function delete_user($table_name, $form_data,$story_id,$travel_id)
        {
            $valueSets = array();
            foreach($form_data as $key => $value) {
                $valueSets[] = $key . " = '" . $value . "'";
            }
            $sql = "UPDATE $table_name SET ". join(",",$valueSets) . " WHERE story_id = '".$story_id."'";
            $result = mysqli_query($this->db->conn, $sql);
            if (mysqli_query($this->db->conn, $sql)) {
                header('location:delete_images.php?travel_id=' . $travel_id);
            }
            else
            {
                echo "Error: " . $sql . "" . mysqli_error($this->db->conn);
            }
        }

    }

$k = new dbFunc();

?>  
      }


      

     

}

?>
