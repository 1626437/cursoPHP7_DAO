<?php 

require_once("config.php");

//Mostrar toda a tabela
/*$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);*/

//Carrega usuario
/*$root = new Usuario();
$root -> loadById(19);
echo $root;*/

/*CARREGAR UMA LISTA DO USUÁRIO
$lista = Usuario::getList();
echo json_encode($lista);*/

//cARREGA UMA LISTA PARA O USUÁRIO ATRAVÉS DO LOGIN
/*$searche = Usuario::buscarUsuario('jo');
echo json_encode($searche);*/

//Carrega usuario através de usuario e senha
/*$usuario = new Usuario();
$usuario -> loguin("root", "!@#$0");
echo $usuario;*/

/* Criando um novo usário
$aluno =  new Usuario("LOUCO","CHUVA");
$aluno -> insert();
echo $aluno;*/

/*Altera um usuário
$usuario =  new Usuario();
$usuario -> loadById(30);
$usuario -> update("professor","ksaksk");
echo $usuario;*/

$eliminar = new Usuario();
$eliminar->loadById(27);
$eliminar->delete();

echo $eliminar;


?>