<?php



//Com PDO - PHP DATA OBJECT
//$con= new PDO("mysql:dbname=dbphp7;host=localhost","root","");

require_once('config.php');


$usuario= new Usuario();



$usuario->loadUserById(1);

echo $usuario;


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