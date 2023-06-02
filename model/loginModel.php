<?php
require_once ('class/usuario.php'); 
class LoginModel extends Model{
    function __construct(){
        parent::__construct();         
    }
    public function AuthUser($pass){
        try{
            //preparacion del query, ejecucion y creacion de objeto
            $item = new Usuario();
            $sql = $this->db->connect()->prepare('SELECT * FROM `usuarios` WHERE `password` = :Password AND `email` = :Email');
            $sql->execute($pass);

            //recorre y guarda los datos en el objeto
            while($row = $sql->fetch()){
                $item->cedula = $row["cedula"];
                $item->nombre = $row["nombre"];
                $item->apellidos = $row["apellidos"];
                $item->rol = $row["rol"];
                $item->email = $row["email"];
                $item->password = $row['password'];
                $item->estado = $row['estado'];
                $item->fechaRegistro = $row["fechaRegistro"];
            }
            return $item;
        }catch(PDOExeption $e){
            return [];
        }
    }
}
?>