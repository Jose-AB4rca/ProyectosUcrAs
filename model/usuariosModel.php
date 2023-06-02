<?php

require_once ('class/usuario.php');  //para la referencia del objeto
    
class UsuariosModel extends Model{

    function __construct(){
        parent::__construct();         //constructor de libs/modelo, nos da la BD.
    }

    function addUser($data){
        //insert query
        $sql = $this->db->connect()->prepare('INSERT INTO `usuarios` (`cedula`,`nombre`,`apellidos`,`rol`,`email`,`password`,`estado`) VALUES (:Cedula,:Nombre,:Apellidos,:Rol,:Email,:Password,:Estado)');
        try{    
            //ejecutar y mandar confirmación
            $sql->execute($data);
            return true;
        }catch(PDOException $edb){
           return false;
        }
    }

    public function deleteUser($id){
        try{
            $query = $this->db->connect()->prepare('DELETE FROM `usuario` WHERE `cedula`= :Cedula');
            
            $query->execute(['Cedula'=>$id]);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }   

    public function listUser(){  
        $items = [];
        try{
            $query = $this->db->connect()->query("SELECT * FROM `usuarios`");
           
            while ($row = $query->fetch()){
                $item = new Usuario();
                
                $item->cedula = $row["cedula"];
                $item->nombre = $row["nombre"];
                $item->apellidos = $row["apellidos"];
                $item->rol = $row["rol"];
                $item->email = $row["email"];
                $item->password = $row['password'];
                $item->estado = $row['estado'];
                $item->fechaRegistro = $row["fechaRegistro"];

                array_push($items, $item);
                //array push requiere un nuevo array
            }   
            return $items;

        }catch(PDOException $e){
            return [];
        }
    }

    public function searchUser($Ced){
        try{
            //preparacion del query, ejecucion y creacion de objeto
            $item = new Usuario();
            $sql = $this->db->prepare('SELECT * FROM `usuarios` WHERE `cedula` = :Cedula');
            $sql->execute(['Cedula'=>$ced]);

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
        }catch(PDOException $e){
            return [];
        }
    }

    public function updateUser($data){
        try{
            $query = $this->db->connect()->prepare('UPDATE `usuarios` SET `cedula`= :Cedula,`nombre`= :Nombre,`apellido`= :Apellido,`rol`= :Rol,`email`= :Email,`password`= :Password,`estado`= :Estado WHERE `cedula`= :Cedula;');
            $query->execute($data);
            return true;
        }catch(PDOException $e){
            print_r('Error connection: ' . $e->getMessage());
            return false;
        }
    }
}
?>