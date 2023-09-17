<?php
header("Content-Type: text/xmlms");
try{
    $databaseBaglantisi = new PDO("mysql:host=localhost;dbname=project1;charset=UTF8", "root", "");
}
catch(PDOException $hata){
    echo $hata ->getMessage();
    die();
 }


echo "<?xml version='1.0' encoding='UTF8'?>
    <rss xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' version ='2.0'>
        <channel>
            <title>Document</title>
            <description>Urunler</description>
            <link>https://www.siberyavuzlar.com</link>
            <language>tr</language>"; 
    
    $sorgu = $databaseBaglantisi->prepare("SELECT * FROM urunler");
    $sorgu -> execute();
    $sorguSayisi = $sorgu -> rowCount();
    $sorguKayitlari = $sorgu -> fetchAll(PDO::FETCH_ASSOC);

    if($sorguSayisi>0){
        foreach($sorguKayitlari as $satirlar){
            echo "<item>
            <title>".$satirlar["urunAdi"]."</title>
            <price>".$satirlar["urunFiyati"]."</price>
            </item>";
        }
    }
        
        echo"
            </channel>
            </rss>";
$databaseBaglantisi = null;
?>