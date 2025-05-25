<?php
  //include 'conectarBancoDados.php';
  include 'Usuario.php';
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="cssNew.css" rel="stylesheet" >
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="jvNew.js"></script>
<link href="assets/img/eventos.png" rel="icon">

<!------ Include the above in your HEAD tag ---------->

<?php

if (isset($_POST['usuario_nomeCompleto'])) {
	
	//var_dump($_POST);
	Usuario::cadastrarUsuario(@$_POST['usuario_nomeCompleto'], @$_POST['usuario_nomeSocial'], @$_POST['usuario_documento'], @$_POST['usuario_profissao'], @$_POST['usuario_email'],@$_POST['usuario_senha'], @$_POST['usuario_dtNascimento']);
	
}

?>

<div class="login-reg-panel">
							
		<div class="register-info-box">
			<h2 style="color: white;">Oba!</h2>
			<p style="color: white;">Temos alguém novo por aqui!</p>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panelNew">
			<div class="login-show">
				<h2>Criação de Conta</h2>
                <form action="cadastroUsuario.php" method="POST">
                    <input type="text" placeholder="Nome Completo" id="usuario_nomeCompleto" name="usuario_nomeCompleto" required maxlength="100">
					<input type="text" placeholder="Nome Social - Como gosta de ser chamado(a)?" id="usuario_nomeSocial" name="usuario_nomeSocial" required maxlength="20">
					<input type="text" placeholder="CPF/CNPJ" id="usuario_documento" name="usuario_documento" required maxlength="20">
					<input type="text" placeholder="Profissão" id="usuario_profissao" name="usuario_profissao" required maxlength="50">
					<input type="text" placeholder="Email" id="usuario_email" name="usuario_email" required maxlength="100">
                    <input type="password" placeholder="Senha" id="usuario_senha" name="usuario_senha" required maxlength="20">
					<label value = "Data de Nascimento">Data de Nascimento</label>
					</br>
					<input type="date" placeholder="Data de Nascimento" id="usuario_dtNascimento" name="usuario_dtNascimento" required>
					</br></br>
                    <input type="submit" class="btn btn-primary" value="Login">
                </form>
			</div>
		</div>
	</div>