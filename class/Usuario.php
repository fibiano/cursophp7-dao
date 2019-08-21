<?php

class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

 

    /**
     * Get the value of idusuario
     */ 
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * Set the value of idusuario
     *
     * @return  self
     */ 
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * Get the value of deslogin
     */ 
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * Set the value of deslogin
     *
     * @return  self
     */ 
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;

        return $this;
    }

    /**
     * Get the value of dessenha
     */ 
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * Set the value of dessenha
     *
     * @return  self
     */ 
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;

        return $this;
    }

    /**
     * Get the value of dtcadastro
     */ 
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }

    /**
     * Set the value of dtcadastro
     *
     * @return  self
     */ 
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;

        return $this;
    }


    public function loadUserById($id){
        $sql= new Sql();
        $results= $sql->select("SELECT * FROM tb_usuarios where idusuario=:ID",array(":ID"=>$id));
    
        if(count($results)>0){

        $this->setData($results[0]);
       
        }


    }

    public static function loadAllUsers(){
       $sql= new Sql();
       return  $sql->select("SELECT * FROM tb_usuarios");
      
    }


    public static function searchUserByLogin($login){
       $sql= new Sql();
       return $sql->select("SELECT * FROM tb_usuarios where deslogin like :LOGIN", 
       array(':LOGIN'=>"%".$login."%"));
    }


    public function setData($data){
        
        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new Datetime($data['dtcadastro']));
    }
    
    public function insert(){
    
    $sql= new Sql();
    
    $results= $sql->select("CALL sp_usuarios_insert(:LOGIN,:SENHA)",array(
        ':LOGIN'=>$this->getDeslogin(),
        ':SENHA'=>$this->getDessenha()       
    ));

    if(count($results[0])>0){
          $this->setData($results[0]);
    }else{
        throw new Exception("Error Processing Request", 1);
        
    }
    
    }


    public function update($login,$senha){

       $this->setDeslogin($login);
       $this->setDessenha($senha);


        $sql= new Sql();

        $sql->query("UPDATE tb_usuarios set deslogin=:LOGIN, dessenha=:SENHA WHERE idusuario=:ID",array(

        ':LOGIN'=>$this->getDeslogin(),
        ':SENHA'=>$this->getDessenha(),
        ':ID'=>$this->getIdusuario()


        ));


    }
    

public function delete(){
    $sql= new Sql();

    $sql->query("DELETE FROM tb_usuarios where idusuario=:ID",array('ID'=>$this->getIdusuario()));

    echo "Usuario deletado com sucesso!";

}


    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }





}


?>