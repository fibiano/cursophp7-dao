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



$data=array();



foreach ($diretorio as $image) {
    if(!in_array($image,array(".",".."))){
        $filename="images".DIRECTORY_SEPARATOR.$image;
        $info=pathinfo($filename);

        //A palavra tamanho não importa e sim filesize
        $info['tamanho']=filesize($filename);        
        $info['modified']=date("d/m/Y H:i:s",filemtime($filename));   
        $info['url']='http://10.168.0.53:81/dao/'.str_replace("\\","/",$filename);
       array_push($data,$info);


    }
}

if(!empty($data)){
   // echo json_encode($data);
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

echo "<br>";

    foreach ($row as $key => $value) {
       array_push($dados,$value);

       echo $key.":".$value."<br>";       
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

var_dump(scandir("images"));

foreach (scandir("images") as $item) {
    if(!in_array($item,array(".",".."))){
        unlink("images/".$item);
    }
}


//$usuario->update("novo_2019","123457");


/*
$con=$sql->getConn();
$con->beginTransaction();

$argum=array();
$id=6;

array_push($argum,$id);



//$stmt=$sql->prepare("DELETE FROM tb_usuarios WHERE idusuario= ?");
$query="DELETE FROM tb_usuarios WHERE idusuario in ?";

echo $sql->delete($query,$argum);


//$login="jose";
//$password="123";

/*
//$stmt->bindParam(":LOGIN",$login);
//$stmt->bindParam(":PASSWORD",$password);

if($stmt->execute(array($id))){
    ECHO "DELETADO COM SUCESSO COM O PDO";
    //$con->rollBack();
    $con->commit();
    
}else{
    ECHO "ERRO AO DELETAR COM O PDO";
}





//$con= new Sql();


/*
$stmt=$con->prepare("select * from tb_usuarios order by deslogin");

$stmt->execute();

//cada linha é um array;
$results =$stmt->fetchAll(PDO::FETCH_ASSOC);


foreach ($results as $key => $value) {
   foreach ($value as $arrow => $value) {
       echo "<strong>".$arrow."</strong>:".$value."<br/>";
   }
   echo "============";
}

*/

//$stmt=$con->prepare("INSERT INTO tb_usuarios(deslogin,dessenha) VALUES(:LOGIN,:PASSWORD)");
//$stmt=$con->prepare("UPDATE tb_usuarios SET dessenha=:PASSWORD WHERE deslogin=?);
//$stmt=$con->prepare("UPDATE tb_usuarios SET dessenha=:PASSWORD WHERE deslogin=:LOGIN");



//Com mysqli
//$con= new mysqli("localhost","root","","dbphp7");
/*
if($con->connect_error){
    echo "Error". $con->connect_error;
    exit;
}
*/



//Comando para inserir no banco de dados mysql usando mysqli
/*
$stmt= $con->prepare("insert into tb_usuarios (deslogin,dessenha)values(?,?)");
$login="user";
$senha="123456";

$stmt->bind_param("ss",$login,$senha);

$stmt->execute();

$login="root";
$senha="1234567";

$stmt->execute();
*/


//Fazer um select e exibir na tela 
/*
$result= $con->query("select * from tb_usuarios order by deslogin");
$data= array();

while($row= $result->fetch_array())
{
   array_push($data,$row);
}

echo json_encode($data);
*/




?>