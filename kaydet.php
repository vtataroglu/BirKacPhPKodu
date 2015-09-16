<?php
//kaydet.php ile tüm dizinlerinizi kaydedin. 
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

                    $sql = "INSERT INTO dizinler (name) VALUES ('".$name."')";
                    if ($conn->query($sql) === TRUE) {
                        echo "OK : ".$name."</br>";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
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
