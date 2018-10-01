<?php
session_start();

require 'init.php';
header("Content-type:text/html; charset=utf-8");
 
// pega o ID da URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
 
// valida o ID
if (trim($id)=='')
{
    $_SESSION['msg'] = "ID para alteração não definido";
    header("location:form-edit.php");
    exit;
}
 
// busca os dados du usuário a ser editado
$PDO = db_connect();
$sql = "SELECT nome, email, admin FROM usuarios WHERE id = :id";
$stmt = $PDO->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
 
$stmt->execute();
 
$user = $stmt->fetch(PDO::FETCH_ASSOC);
 
// se o método fetch() não retornar um array, significa que o ID não corresponde a um usuário válido
if (!is_array($user))
{
    $_SESSION['msg'] = "Nenhum usuário encontrado";
    header("location:form-edit.php");
    exit;
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Edit</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <center>
                        <br>
                        <h1>Sistema de Cadastro</h1>
                        <h2>Edição de Usuário</h2>
                    </center>
                    <div class="jumbotron">
                        <?php
                            if(isset($_SESSION['msg'])){
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            }
                        ?>      
                        <form action="edit.php" method="post" name="form1">
                            <label for="name">Nome: </label>
                            <br>
                            <input type="text" class="form-control" name="nome" id="name" value="<?php echo $user['nome'] ?>">
                            <br>
                            <label for="email">Email: </label>
                            <br>
                            <input type="text" class="form-control" name="email" id="email" value="<?php echo $user['email'] ?>">
                            <br>
                            <label>Admin: </label>
                            <br>
                            <input type="text" class="form-control" name="admin" onchange="verifica(admin.value)" value="<?php echo $user['admin'] ?>">
                            <br>
                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <center>
                                <input class="btn btn-block btn-info" type="submit" value="Alterar">
                            </center>
                        </form>  
                    </div>      
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        <script type="text/javascript">
        function verifica(admin){
            if(admin <= "0" || admin > "1"){
                form1.admin.value = "0";
            }
        }
        </script>

    </body>
</html>