<?php
    require("connection.php");
    require("model/capture.php");
    require("model/face.php");
    require("model/point.php");
    require("./imageResize.php");

    $params = $_POST['capture'];
    $array = json_decode($params, true);
    
    $face = new Face();
    $face->save($conn);

    foreach ($array as $item){
        
        
        $data = str_replace(" ", "+", $item["image"]);
        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);
        $data = base64_decode($data);
        
        $rand = rand(100000, 999999);
        $image_name = $face->id . "-".str_replace(" ", "_", $item["mimica"]). "-".date("d-m-Y-H-m-s-") . $rand . ".png";

        $capture = new Capture($image_name, $face, $item["mimica"]);

        file_put_contents('C:\xampp\htdocs\sistema_pcc\service\images\300\\' . $image_name, $data);
        $image = ImageResize::createFromString($data);
        $image->scale(50);
        file_put_contents('C:\xampp\htdocs\sistema_pcc\service\images\150\\' . $image_name, $image);
        $image = ImageResize::createFromString($data);
        $image->scale(16.7);
        file_put_contents('C:\xampp\htdocs\sistema_pcc\service\images\50\\' . $image_name, $image);
       
        $capture->save($conn);
        $point = new Point( json_encode($item["face"]["landmarks"]), $capture);
        $point->save($conn);

    }
    echo("Sucesso");
?>

