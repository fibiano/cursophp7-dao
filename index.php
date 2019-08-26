<?php



//Com PDO - PHP DATA OBJECT
//$con= new PDO("mysql:dbname=dbphp7;host=localhost","root","");

require_once('config.php');


$usuario= new Usuario();

//$usuario->loadUserById(1);

//Método estático, chama todos os usuários
//$listUsuario=$usuario::loadAllUsers();

//$listaUsuarioByLogin=$usuario::searchUserByLogin("r");
//echo json_encode($listaUsuarioByLogin);

//$usuario->setDeslogin("aluno");
// $usuario->setDessenha("@lun0");

// $usuario->insert();

$usuario->loadUserById(10);


if($usuario->getIdusuario()==""){
    //echo "Usuario não existe!";
}else{
$usuario->delete();
}



$name="images"; 

//Escaneia um diretorio
$diretorio= scandir($name);



$imagesArr=array();



foreach ($diretorio as $image) {
    if(!in_array($image,array(".",".."))){
        $filename="images".DIRECTORY_SEPARATOR.$image;
        $info=pathinfo($filename);

        //A palavra tamanho não importa e sim filesize
        $info['tamanho']=filesize($filename);        
        $info['modified']=date("d/m/Y H:i:s",filemtime($filename));   
        $info['url']='http://10.168.0.53:81/dao/'.str_replace("\\","/",$filename);
       array_push($imagesArr,$info);


    }
}

if(!empty($imagesArr)){
   //echo json_encode($imagesArr);
}


//Se o diretório  não existe
if(!is_dir($name)){
    //Cria o diretorio
    mkdir($name);
}else{
    //rmdir($name);
}
    
//a+ insere após a ultima linha
//w+ cria o arquivo se ele não existir, mas reseta os dados
$file= fopen("log.txt","a+");

for($i=0;$i<10;$i++){


fwrite($file,date("Y-m-d H:i:s")."\r\n\t");

}


fclose($file);

//unlink("log.txt");

//echo "Arquivo criado com sucesso";

$sql= new Sql();
$usuarios=$sql->select("SELECT * FROM tb_usuarios order by deslogin");

$dados= array();

foreach ($usuarios as $row) {

//echo "<br>";

    foreach ($row as $key => $value) {
       array_push($dados,$value);

      // echo $key.":".$value."<br>";       
    }  
}
 

$headers=array();


foreach ($usuarios[0] as $key =>$valor) {
  array_push($headers,ucfirst($key));    
}

//Cria o arquivo e permitir escrever
$file= fopen("usuarios.csv","w+");

//Escreve no arquivo
fwrite($file,implode(",",$headers)."\r\n");


foreach ($usuarios as $row) {

    $data=array();

    foreach ($row as $key => $value) {
       array_push($data,$value);
    }

fwrite($file,implode(",",$data)."\r\n");

}

fclose($file);



if(!is_dir("images"))
mkdir("images");



foreach (scandir("images") as $item) {
    if(!in_array($item,array(".",".."))){
       // unlink("images/".$item);
    }
}


//Trabalhando com leitura de arquivos

$filename= "usuarios.csv";

if(file_exists($filename)){

$file= fopen($filename,"r");

$headers=explode(",",fgets($file));

$data=array();

//fgets pega linha por linha
while($row=fgets($file)){

$rowData=(explode(",",$row));
$linha= array();

for($i=0;$i < count($headers);$i++){

    $linha[$headers[$i]]=$rowData[$i];

}

array_push($data,$linha);


  
};


fclose($file);

};



$filename= "images/foto.jpg";

if(file_exists($filename)){
    $base64=base64_encode(file_get_contents($filename));
    $fileinfo= new finfo(FILEINFO_MIME_TYPE);

    $mimetype=$fileinfo->file($filename);

    $base64encode= "data:". $mimetype .";base64,". $base64;

//echo $base64encode;

}


?>

<form method="POST" enctype="multipart/form-data">
<input type="file" name="fileUpload">
<button type="submit">Send</button>


</form>

<!--<a href="<?php echo $base64encode?>" target="_blank">Aqui</a>
<img src="<?=$base64encode?>" alt="" width="100%" height="80%"> 

--->

<?php

//Se tiver um metódo post enviado
if($_SERVER['REQUEST_METHOD']==="POST"){

$file=$_FILES["fileUpload"];

//É possível pegar o mimetype dessa forma tambem
$fileinfo= new finfo(FILEINFO_MIME_TYPE);
$mimetype=$fileinfo->file($file['tmp_name']);

//mas com é o upload de um arquivo, posso pegar direto
$mimetype=$file['type'];
var_dump($mimetype);

//Se gerar algum erro, entra nesse if
if($file['error']){
    throw new Exception("Error:".$file["error"]);
    
}

$dirUploads="uploads";

//Criar o diretorio se não existir
if(!is_dir($dirUploads)){
    mkdir($dirUploads);
}

//E por fim pega da memoria e grava no disco
if(move_uploaded_file($file['tmp_name'],$dirUploads.DIRECTORY_SEPARATOR.$file['name']))
{
    echo "Image salva com sucesso!";

}else{
    throw new Exception("Não foi possível realizar o download");
    
}


}

?>






