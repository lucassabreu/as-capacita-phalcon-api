<?php
$db = new PDO('mysql:host=localhost;dbname=as-capacita-phalcon', 'root', 'admin') or die("Erro");

$sql = "INSERT INTO moviments (iUserId, dtMoviment, sCategory, sDescription, nValue) VALUES ";

for($i = 0; $i < 1000; $i++){
    $sql .= "
    (:iUserId$i, :dtMoviment$i, :sCategory$i, :sDescription$i, :nValue$i), ";
}

$sql = substr($sql, 0 , -2).";";

$users = [3, 4, 5, 6, 7, 8];
$cats = ['Alimentacao', 'Lazer', 'Transporte'];

try {
    $stmt = $db->prepare($sql);

    for($i = 0; $i < 1000; $i++){

        $date = "2016-" . rand(1, 12) . '-' . rand(1,28).
        $cat = $cats[rand(0, count($cats) - 1)];

        $stmt->bindValue(":iUserId$i", $users[rand(0, count($users) - 1)]);
        $stmt->bindValue(":dtMoviment$i", $date);
        $stmt->bindValue(":sCategory$i", $cat);
        $stmt->bindValue(":sDescription$i", "Gasto com $cat");
        $stmt->bindValue(":nValue$i", rand(1, 99999) / -100);
    }

    try {
        $stmt->execute();
    } catch (Exception $e) {
        $stmt->debugDumpParams();
        echo "Código: 1 <br /> <pre>";
        print_r($e);
        exit();
    }

} catch (Exception $e) {
    echo "Código: 2 <br /> <pre>";
    print_r($e);
    exit();
}
echo "<br />Script finalizado! <br />";