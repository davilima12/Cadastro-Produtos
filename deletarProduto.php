<?php 
session_start();
include_once("conexao.php");
$id = $_GET['id'];
$sql = "DELETE FROM produto WHERE id = $id";
var_dump( $sql);
$resultado = mysqli_query($conexao,$sql);

if(mysqli_affected_rows($conexao)){
    $_SESSION['msg'] = ' <h2 style=" color:green"> produto Removido Com Sucesso </h2>';
    header("Location:index.php");
}else{
    $_SESSION['msg'] = ' <h2 style=" color:red"> Error ao tentar Apagar Um produto </h2>';
    header("Location:index.php");
    
}
