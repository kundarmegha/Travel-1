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
        echo "Error: " . $sql . "" . mysqli_error($conn);
        }
      }

      function delete_user($table_name, $form_data,$story_id,$travel_id)
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
        echo "Error: " . $sql . "" . mysqli_error($conn);
        }
      }


      

     

}

?>