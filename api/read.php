<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../connection.php';
    include_once '../class/buku.php';
    $database = new Database();
    $db = $database->getConnection();
    $items = new Buku($db);
    $stmt = $items->getBuku();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $bukuArr = array();
        $bukuArr["body"] = array();
        $bukuArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "judul buku" => $judul_buku,
                "penulis buku" => $pen_buku,
                "harga buku" => $hrg_buku,
                "gambar buku" => $gambar_buku,
            );
            array_push($bukuArr["body"], $e);
        }
        echo json_encode($bukuArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>