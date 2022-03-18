<?php 
session_start();
include_once("conexao.php");
$id = $_GET['id'] ?? '';
$sql = "SELECT * FROM produto WHERE id = $id";
$resultado = mysqli_query($conexao,$sql);

$registro = mysqli_fetch_array($resultado);

if(isset($_SESSION['msg'])){
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
    echo '<div style="text-align: center">';
    echo '<h1>Editar Produto</h1>';
    echo '<form action="" method="POST" enctype="multipart/form-data">';
    echo '<label for="">Nome Do Produto:</label>';
    echo '<input type="text" name="nome" id="nome" value="'.$registro['nome'].'"><br>';

    echo '<label for="">SKU:</label>';
    echo '<input type="text" name="sku" id="sku" value="'.$registro['sku'].'"><br>';

    echo '<label for="">Foto:</label>';
    echo '<input type="file" name="foto" id="foto" value="'.$registro['foto'].'"><br>';

    echo '<label for="">Preço:</label>';
    echo '<input type="number" name="preco" id="preco" value="'.$registro['preco'].'"><br>';

    echo '<label for="">Estoque:</label>';
    echo '<input type="number" name="estoque" id="estoque" value="'.$registro['estoque'].'"><br>';

    echo '<button type="submit" name="buttonEditar" value="buttonEditar">Editar</button>';
    echo '</form>';
    echo '</div>';

    $nome = $_POST['nome'] ?? '';
    $sku = $_POST['sku'] ?? '';
    $foto = $_FILES['foto']['name'] ?? '';
    $preco = $_POST['preco'] ?? '';
    $estoque = $_POST['estoque'] ?? '';

    if($nome != '' && $sku != '' && $foto != '' && $preco != '' &&  $estoque != '' && isset($_POST['buttonEditar'])){

        $query = "UPDATE produto SET nome = '$nome', sku = '$sku', foto = '$foto', preco = '$preco',estoque = '$estoque' WHERE id = $id";
        $resultadoQuery = mysqli_query($conexao, $query);
        var_dump($query);
        if($resultadoQuery){
            $diretorio = 'imagens/'.$nome.'/';
            mkdir($diretorio, 0755);
            move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio.$foto);
            $_SESSION['msg'] = ' <h2 style=" color:green"> Produto Editado Com Sucesso </h2>';
            header('Location: index.php');
        }else{
            $_SESSION['msg'] = ' <h2 style=" color:red"> Error Ao Tentar Editar Um Produto </h2>' ;
        }
    }else if($nome == '' && $sku == '' && $foto == '' && $preco == '' &&  $estoque == '' && isset($_POST['buttonEditar'])){

        $_SESSION['msg'] = ' <h2 style=" color:red"> Error Algum Campo Em Branco </h2>';
    }
