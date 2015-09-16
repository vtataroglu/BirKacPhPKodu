<?php

try {

function list_files($dir)
{
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";

    try {

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 

        $dizin = opendir($dir);

        while($dosya = readdir($dizin)) {
            if (strpos($dosya, '.') !== FALSE)
            {
                if($dosya !="." && $dosya !=".."){
                    $name = $dir."/".$dosya;
                    $sql = "SELECT name FROM dizinler WHERE name = '".$name."' ";
                    $result = $conn->query($sql);
                    if (!($result->num_rows > 0)) {
                        echo $name." - bu dosya onceki veritabaninde yok kontrol etmek isteyebilirsiniz.</br>";
                    } 
                }
            }       
            else{
                if($dosya !="." && $dosya !=".."){
                    list_files($dir."/".$dosya."");
                }
            }   
        }
         $conn->close();
    } catch (Exception $e) {
        echo "Hata :";
    }

}
    list_files(".");
    
} catch (Exception $e) {
    echo $e;
    $conn->close();
}

?>
