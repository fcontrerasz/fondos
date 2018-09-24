<?php include("../conexion/conecta.php"); ?>
<?php

$variables = explode("?", $_SERVER['REQUEST_URI']);
parse_str($variables[1]);

if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "XMLHttpRequest"){ die("-5"); }


$arr = get_defined_vars();
//var_dump($arr);
//echo $variables[1];
//echo $variables[1];

$query = "select IDUSUARIO,IDPERFIL,USUARIO_NOMBRE,USUARIO_LOGIN from  USUARIOS where IDESTADOUSUARIO = 1 AND USUARIO_LOGIN = ".revisaSQL($nombre, "text")." AND USUARIO_CLAVE = ".revisaSQL($clave, "text");
//echo $query;

$result = $db->query($query);
if($result->num_rows == "0"){
	die("-1");
}
if($result){
    while ($row = $result->fetch_object()){
		$_SESSION["nombre"] = $row->USUARIO_NOMBRE;
		$_SESSION["usuario"] = $row->USUARIO_LOGIN;
		$_SESSION["idusuario"] = $row->IDUSUARIO;
		$_SESSION["perfil"] = $row->IDPERFIL;
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60 * 60) ;
    }
     $result->close();
     $db->next_result();
}
else echo($db->error);
echo "1";
$db->close();

?>