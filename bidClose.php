<?php
    require "admin/Database.php";
    $prod_exist = verify_product_exist($_POST['id_produit']);
    if($prod_exist == null){
        $db = Database::connect();
        $sql = 'INSERT INTO vendre (id_produit,id_login,prix_vendre) VALUES(?,?,?)';
        $stmt = $db->prepare($sql);
        $stmt->execute([$_POST['id_produit'],$_POST['id_login'],$_POST['prix_bid']]);
        Database::disconnect();
    }
    
    
    function verify_product_exist($prod_id){
        $db = Database::connect();
        $sql = " SELECT * FROM vendre WHERE id_produit=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$prod_id]);
        $exist = $stmt->fetch();
        if(!$exist) return null;
        return $exist;
        Database::disconnect();
    }
?>