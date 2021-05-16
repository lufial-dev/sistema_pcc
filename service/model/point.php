<?php
    class Point{
        public int $id;
        public string $dados;
        public Capture $capture;
        function __construct( $dados, $capture) {
            $this->dados = $dados;
            $this->capture = $capture;
        }

        function save($conn){
            $capture_id = $this->capture->id;
            $sql = "INSERT INTO point (dados, capture_id) VALUES ('$this->dados','$capture_id');";
            
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM point ORDER BY id DESC LIMIT 1";
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