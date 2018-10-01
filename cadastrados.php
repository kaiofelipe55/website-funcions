<?php 
require_once 'init.php';

header("Content-type:text/html; charset=utf-8"); 
// abre a conexão
$PDO = db_connect();
 
// SQL para contar o total de registros
// A biblioteca PDO possui o método rowCount(), mas ele pode ser impreciso.
// É recomendável usar a função COUNT da SQL
// Veja o Exemplo 2 deste link: http://php.net/manual/pt_BR/pdostatement.rowcount.php
$sql_count = "SELECT COUNT(*) AS total FROM usuarios ORDER BY nome ASC";
 
// SQL para selecionar os registros
$sql = "SELECT id, nome, email, admin FROM usuarios ORDER BY nome ASC";
 
// conta o toal de registros
$stmt_count = $PDO->prepare($sql_count);
$stmt_count->execute();
$total = $stmt_count->fetchColumn();
 
// seleciona os registros
$stmt = $PDO->prepare($sql);
$stmt->execute();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sistema de Cadastro</title>
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
					<h1>Lista de Usuários</h1> 
				    <p><a href="form-add.php">Adicionar Usuário</a></p> 
				    <h2>Lista de Usuários</h2> 
				    <p>Total de usuários: <?php echo $total ?></p> 
				    <?php if ($total > 0): ?>
				</center>    	
			    <table width="100%" border="0.5" class="table">
				<thead>
				    <tr>
				        <th>Nome</th>
				       	<th>Email</th>				        
				        <th>Admin</th>
				        <th>Ações</th>				        
				    </tr>
				</thead>       
				<tbody>
				    <?php while ($user = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
				    <tr>
				        <td><?php echo $user['nome'] ?></td>
				        <td><?php echo $user['email'] ?></td>
				        <td><?php echo $user['admin'] ?></td>
				        <td>
				        <a style="text-decoration: none; color: orange;" href="form-edit.php?id=<?php echo $user['id'] ?>">Editar</a> |
				        <a style="text-decoration: none; color: red;" href="delete.php?id=<?php echo $user['id'] ?>" onclick="return confirm('Tem certeza de que deseja remover?');">Remover</a>
				    </td>
				    </tr>
				        <?php endwhile; ?>
				</tbody>
				</table>
				    </div>    
			        <?php else: ?>
			        <p>Nenhum usuário registrado</p>
			        <?php endif; ?>
				</div>
				<div class="row">
					<div class="col-md-2" style="margin-left: 450px;">
						<a href="index.php" style="text-decoration: none;"><input type="submit" value="VOLTAR" class="btn btn-block btn-info"></a>
					</div>
				</div>	
			<div class="col-md-2"></div>
		</div>
	</div>      
</body>
</html>