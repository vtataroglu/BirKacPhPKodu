<?php

try {

function kontrolEt($contents,$file) {
        if(preg_match('/eval\((base64|eval|\$_|\$\$|\$[A-Za-z_0-9\{]*(\(|\{|\[))/i',$contents)) {
            echo $file."</br>";
        }
    }

function list_files($dir)
{
        $dizin = opendir($dir);

        while($dosya = readdir($dizin)) {
            if (strpos($dosya, '.') !== FALSE)
            {
                if($dosya !="." && $dosya !=".."){
                    $name = $dir."/".$dosya;
                    kontrolEt(file_get_contents($name),$name);
                }
            }       
            else{
                if($dosya !="." && $dosya !=".."){
                    list_files($dir."/".$dosya."");
                }
            }   
        }
}
    list_files(".");
} catch (Exception $e) {
    echo $e;
}
?>
