<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="cssNew.css" rel="stylesheet" >
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="jvNew.js"></script>
<link href="assets/img/eventos.png" rel="icon">
<title>Login</title>
<!------ Include the above in your HEAD tag ---------->

<?php
    //include 'conectarBancoDados.php';
    include 'utilitarios.php';
    if(ISSET($_POST['usuario_email'])){
        //Usuario::logarUsuario(@$_POST['usuario_email'], @$_POST['usuario_senha']);
		//echo(@$_POST['usuario_email']." - ".@$_POST['usuario_senha']);

		// URL da API com parâmetros na query string
		$email = @$_POST['usuario_email'];
		$senha = @$_POST['usuario_senha'];
		$url = "http://localhost:8080/usuarios/login?email=$email&senha=$senha";

		// Inicia uma sessão cURL
		$ch = curl_init();

		// Configurações da requisição cURL
		curl_setopt($ch, CURLOPT_URL, $url); // Definindo a URL
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar resposta como string

		// Executa a requisição cURL
		$response = curl_exec($ch);

		// Verifica se ocorreu erro
		if(curl_errno($ch)) {
			echo 'Erro: ' . curl_error($ch);
		} else {
			// Exibe a resposta da API
			if($response=='true'){

				// Inicia uma sessão cURL
				$ch = curl_init();
				$url = "http://localhost:8080/usuarios/email?email=$email";

				// Configurações da requisição cURL
				curl_setopt($ch, CURLOPT_URL, $url); // Definindo a URL
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar resposta como string

				// Executa a requisição cURL
				$response = curl_exec($ch);

				// Verifica se ocorreu erro
				if(curl_errno($ch)) {
					echo 'Erro: ' . curl_error($ch);
				} else {
					// Exibe a resposta da API
					@session_start();
					$response = json_decode($response);
					$_SESSION['usuario_id'] = $response->id;
					$_SESSION['usuario_nomeCompleto'] = $response->nomeCompleto;
					$_SESSION['usuario_nomeSocial'] = $response->nomeSocial;
					$_SESSION['usuario_dtNascimento'] = $response->dtNascimento;
					$_SESSION['usuario_documento'] = $response->documento;
					$_SESSION['usuario_profissao'] = $response->profissao;
					$_SESSION['usuario_dtCadastro'] = $response->dtCadastro;
					
				}

				// Fecha a sessão cURL
				curl_close($ch);		
				header("Location: Feed.php");
				exit;				
			}else{
				Utilitarios::eventoErroCredencial();
			}
		}

		// Fecha a sessão cURL
		curl_close($ch);		

    }

?>

<div class="login-reg-panel">
							
		<div class="register-info-box">
			<h2 style="color: white;">Encurtando Caminhos</h2>
			<p style="color: white;">É muito bom te ver por aqui!</p>
			<a href="cadastroUsuario.php"><label style="color: white;" id="label-login">Criar conta</label></a>
			<input type="radio" name="active-log-panel" id="log-login-show">
		</div>
							
		<div class="white-panel">
			<div class="login-show">
				<h2>LOGIN</h2>
                <form action="login.php" method="POST">
                    <input type="text" placeholder="E-mail" id="usuario_email" name="usuario_email" maxlength="100">
                    <input type="password" placeholder="Senha" id="usuario_senha" name="usuario_senha" maxlength="20">
                    <input type="submit" class="btn btn-primary" value="Login">
                </form>
			</div>
		</div>
	</div>