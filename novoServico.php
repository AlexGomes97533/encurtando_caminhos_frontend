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
				INSERT INTO tbl_servico(
                    nome,
                    tbl_usuario_id,
                    contato,
                    rua,
                    numero,
                    complemento,
                    cep,
                    bairro,
                    cidade,
                    tbl_tipoServico_id) VALUES (
						'".@$_POST['nome']."',
                        '".@$_SESSION['id']."',
                        '".@$_POST['contato']."',
                        '".@$_POST['rua']."',
                        '".@$_POST['numero']."',
                        '".@$_POST['complemento']."',
                        '".@$_POST['cep']."',
                        '".@$_POST['bairro']."',
                        '".@$_POST['cidade']."',
                        '".@$_POST['tbl_tipoServico_id']."')
			"
		);
		$result = $conn->query($query);
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
			<p style="color: white;">Fiquei sabendo que vamos ter mais um serviço para conta?</p>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panelNew">
			<div class="login-show">
				<h2>Cadastro de Serviço</h2>
                <form action="novoServico.php" method="POST">
                    <input type="text" placeholder="Nome" id="nome" name="nome" required>
                    <input type="text" placeholder="WhatsApp - 11900000000" id="contato" name="contato" required>
					<input type="text" placeholder="Rua" id="rua" name="rua" required>
					<input type="text" placeholder="Número" id="numero" name="numero" required>
					<input type="text" placeholder="Complemento" id="complemento" name="complemento" required>
                    <input type="text" placeholder="CEP" id="cep" name="cep" required>
                    <input type="text" placeholder="Bairro" id="bairro" name="bairro" required>
                    <input type="text" placeholder="Cidade" id="cidade" name="cidade" required>
					<label value = "">Tipo de Serviço:</label>
                    </br>
                    <select id="tbl_tipoServico_id" name="tbl_tipoServico_id">
                        <option value="1">Pago</option>
                        <option value="2">Gratuito</option>
                    </select>                    
					</br></br>
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </form>
			</div>
		</div>
	</div>