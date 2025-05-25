<?php
  include 'conectarBancoDados.php';
  session_start();
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="cssNew.css" rel="stylesheet" >
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="jvNew.js"></script>
<link href="assets/img/eventos.png" rel="icon">

<!------ Include the above in your HEAD tag ---------->

<?php

	if(ISSET($_POST['nome'])){

		$query = (
			"
				INSERT INTO tbl_evento(
                    nome,
                    data,
                    cep,
                    rua,
                    numero,
                    bairro,
                    complemento,
                    cidade,
                    resumo,
                    organizador,
                    entrada) VALUES (
						'".@$_POST['nome']."',
                        '".@$_POST['dtevento']."',
                        '".@$_POST['cep']."',
                        '".@$_POST['rua']."',
                        '".@$_POST['numero']."',
                        '".@$_POST['bairro']."',
                        '".@$_POST['complemento']."',
                        '".@$_POST['cidade']."',
                        '".@$_POST['descricao']."',
                        '".@$_SESSION['id']."',
						'".@$_POST['entrada']."')
			"
		);
		$result = $conn->query($query);
		//echo($query);
        echo(
			'
				<div class="alert alert-success" role="alert">
				Cadastro concluído com sucesso!
				</div>
			'
		);
        header("Location: areaLogada.php");
	}
?>

<div class="login-reg-panel">
							
		<div class="register-info-box">
			<h1 style="color: white;">Eba!</h1>
			<p style="color: white;">Fiquei sabendo que vai ter evento novo?</p>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panelNew">
			<div class="login-show">
				<h2>Cadastro de Evento</h2>
                <form action="novoEvento.php" method="POST">
                    <input type="text" placeholder="Nome" id="nome" name="nome" required>
					<input type="text" placeholder="CEP" id="cep" name="cep" required>
					<input type="text" placeholder="Rua" id="rua" name="rua" required>
					<input type="text" placeholder="Número" id="numero" name="numero" required>
					<input type="text" placeholder="Bairro" id="bairro" name="bairro" required>
					<input type="text" placeholder="Complemento" id="complemento" name="complemento" required>
                    <input type="text" placeholder="Cidade" id="cidade" name="cidade" required>
                    <input type="text" placeholder="Descrição" id="descricao" name="descricao" required>
                    <input type="text" placeholder="Quanto será a Entrada?" id="entrada" name="entrada" required>
					<label value = "Data do Evento">Data do Evento</label>
					</br>
					<input type="date" placeholder="Data do Evento" id="dtevento" name="dtevento" required>
					</br></br>
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </form>
			</div>
		</div>
	</div>