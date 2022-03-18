<?php 
require __DIR__.'/vendor/autoload.php';

use App\Api;

$dados =  $_POST;
$cadastro = Api::mercado($dados);
?>


 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title></title>
 </head>
 <body>


<div style="text-align: center;">
    
     <div id="conteudo" style="display: inline-block; margin:0px; text-align: center; background-color:silver">
            <h1>Cadastrar Produtos</h1>
    
            <?php
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
    
            ?>
    
            <form action="." method="POST" enctype="multipart/form-data">
                <label for="">Nome Do Produto:</label>
                <input type="text" name="nome" id="nome"><br>
    
                <label for="">SKU:</label>
                <input type="text" name="sku" id="sku"><br>
    
                <label for="">Foto:</label>
                <input type="file" name="foto"><br>
    
                <label for="">Preço:</label>
                <input type="number" name="preco" id="preco"><br>
    
                <label for="">Estoque:</label>
                <input type="number" name="estoque" id="estoque"><br>
    
                <button type="submit" name="button" value="send">Cadastrar Produto</button>
            </form>
            <a href=""></a>
    
        </div>
    
        <div style="display: inline-block; margin:0 px">
    
        <?php
        echo '<table border=1>';
        echo "<tr>";
        echo "<th>Nome Do Produto</th>";
        echo "<th>SKU</th>";
        echo "<th>Foto</th>";
        echo "<th>Preco</th>";
        echo "<th>Estoque</th>";
        echo "</tr>";
        
        include("conexao.php");

        $sql = "SELECT * FROM produto";
        $resultado = mysqli_query($conexao,$sql);
    
        while ($registro = mysqli_fetch_array($resultado))
        {
            $id = $registro['id'];
            echo "<tr>";
            echo "<td>".$registro['nome']."</td>";
            echo "<td>".$registro['sku']."</td>";
            echo "<td>".$registro['foto']."</td>";
            echo "<td>".$registro['preco']."</td>";
            echo "<td>".$registro['estoque']."</td>";
            echo "<td> <a href='editarProduto.php?id=".$id."'>Editar</a></td>";
            echo "<td> <a href='deletarProduto.php?id=".$id."'>Deletar</a> </td>";
            echo "</tr>";
        }
        mysqli_close($conexao);
        echo "</table>";
     ?>
    </div>
</div>

   



 </body>
 </html>