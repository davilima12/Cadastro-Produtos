<?php

namespace App;
session_start();
class Api{

    public static function mercado($dados){

        include_once("conexao.php");
        $nome = $dados['nome'] ?? '';
        $sku = $dados['sku'] ?? '';
        $preco = $dados['preco'] ?? '';
        $foto = $_FILES['foto']['name'] ?? '';
        $estoque = $dados['estoque'] ?? '';
        
        if($nome != '' && $sku != '' && $foto != '' && $preco != '' &&  $estoque != '' && isset($dados['button'])){
            $query = "INSERT INTO produto(nome,sku,foto,preco,estoque) VALUES('$nome','$sku','$foto',$preco,'$estoque')";
            $resultadoQuery = mysqli_query($conexao, $query);
            var_dump($resultadoQuery);
            if($resultadoQuery){
               $diretorio = 'imagens/'.$nome.'/';
               mkdir($diretorio,0755);
               move_uploaded_file($_FILES['foto']['tmp_name'],$diretorio.$foto);
                $_SESSION['msg'] = ' <h2 style=" color:green"> Produto Cadastrado Com Sucesso </h2>';
                    
            }else{
                $_SESSION['msg'] = ' <h2 style=" color:red"> Error No Cadastro </h2>' ;
            }
        $preco = $dados['preco'];
        }else if($nome == '' && $sku == '' && $foto == '' && $preco == '' &&  $estoque == '' && isset($_POST['button'])){

            $_SESSION['msg'] = ' <h2 style=" color:red"> Error Algum Campo Em Branco </h2>';
        }
    }


}


