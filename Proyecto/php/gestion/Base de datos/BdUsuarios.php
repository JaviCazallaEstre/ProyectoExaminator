<?php
include_once("../../entidades/usuarioObjeto.php");
class BdUsuario
{
    private static $conexion;
    public static function creaConexion()
    {
        self::$conexion = new PDO('mysql:host=localhost;dbname=examinador', 'root', '');
    }
    public static function insertaUsuario(Usuario $usuario)
    {
        $id = $usuario->id;
        $email = $usuario->email;
        $nombre = $usuario->nombre;
        $apellidos = $usuario->apellidos;
        $contrasena = $usuario->contrasena;
        $fechaNac = $usuario->fecha_nac;
        $foto = $usuario->foto;
        $rol = $usuario->rol->id;
        $sentencia = "INSERT INTO usuarios VALUES(:ID, :EMAIL, :NOMBRE, :APELLIDOS, :CONTRASENA, :FECHA_NAC, :FOTO, :ROL_ID)";
        $registros = self::$conexion->prepare($sentencia);
        $registros->bindParam(':ID', $id);
        $registros->bindParam(':EMAIL', $email);
        $registros->bindParam(':NOMBRE', $nombre);
        $registros->bindParam(':APELLIDOS', $apellidos);
        $registros->bindParam(':CONTRASENA', $contrasena);
        $registros->bindParam(':FECHA_NAC', $fechaNac);
        $registros->bindParam(':FOTO', $foto);
        $registros->bindParam('ROL_ID', $rol);
        $registros->execute();
    }
    public static function modificaUsuario(Usuario $usuario)
    {
        $id = $usuario->id;
        $email = $usuario->email;
        $nombre = $usuario->nombre;
        $apellidos = $usuario->apellidos;
        $contrasena = $usuario->contrasena;
        $fechaNac = $usuario->fecha_nac;
        $foto = $usuario->foto;
        $rol = $usuario->rol->id;
        $sentencia = "UPDATE usuarios SET id = ?, nombre = ?, apellidos = ?, contrasena = ?, fecha_nac = ?, foto = ?, rol_id = ? WHERE id LIKE '$id'";
        $registros = self::$conexion->prepare($sentencia);
        $registros->execute($id, $nombre, $apellidos, $contrasena, $fechaNac, $foto, $rol);
    }
    public static function existeUsuario($email, $contrasena)
    {
        $sentencia = "SELECT email, contrasena FROM usuarios WHERE email LIKE '$email'";
        $registros = self::$conexion->query($sentencia);
        while ($resultado = $registros->fetch()) {
            if ($resultado['email'] == $email && $resultado['contrasena'] == $contrasena) {
                return true;
            } else {
                return false;
            }
        }
    }
    public static function borraUsuario($id)
    {
        $sentencia = "DELETE FROM usuarios WHERE ID like '$id'";
        $registros = self::$conexion->query($sentencia);
    }
    public static function sacaUsuarios(){
        $sentencia = "SELECT * FROM usuarios";
        $registros=self::$conexion->query($sentencia);
        while($resultado=$registros->fetch(PDO::FETCH_OBJ)){
            $usuarios[]=$resultado;
        }
        return $usuarios;
    }
}
