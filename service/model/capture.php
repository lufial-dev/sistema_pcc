<?php
     class Capture{
        public int $id;
        public String $image;
        public String $mimica;
        public Face $face;

        function __construct($image, $face, $mimica) {
           $this->image = $image;
           $this->face = $face;
           $this->mimica = $mimica;
        }

        function save($conn){
            $face_id = $this->face->id;
            $sql = "INSERT INTO capture (image, mimica, face_id) VALUES ('$this->image', '$this->mimica', '$face_id');";
            
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM capture WHERE image = '$this->image' AND face_id = '$face_id'";
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
    }
?>