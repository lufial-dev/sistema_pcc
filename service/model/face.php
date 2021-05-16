<?php
    class Face{
        public int $id;
        function __construct() {
        }

        function save($conn){
            $sql = "INSERT INTO face () VALUES ();";
            
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM face ORDER BY id DESC LIMIT 1";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $this-> id = $row['id'];
                        return;
                    }
                } else {
                echo "0 results";
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
              
        }

        static function findId($conn,$id){
            $sql = "SELECT * FROM face WHERE id = '$id';";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $face = new Face();
                    $face->id = $row["id"];
                    return $face;
                }
            } else {
                echo "0 results";
            }
        }
    }

?>