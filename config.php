<?php

spl_autoload_register(function($nomeClasse){
 
 $dirClass="class";
 $filename=$dirClass.DIRECTORY_SEPARATOR.$nomeClasse.".php";

 if(file_exists($filename)){

    //var_dump($nomeClasse);

     require_once($filename);
 }


});


?>
