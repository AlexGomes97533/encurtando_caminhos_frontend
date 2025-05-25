<?php
    include 'Utilitarios.php';
    include 'Publicacao.php';
    include 'Evento.php';
    include 'Servico.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Feed</title>
    <style>
        body {
            font-family: var(--default-font);
            background-color: #e9ebee;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #e84545;
            color: white;
            padding: 10px 0;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            position: relative;
        }
        .titulo {
            position: absolute;
            left: 20px;
            top: 10px;
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
        .logout {
            position: absolute;
            right: 20px;
            top: 10px;
            color: white;
            text-decoration: none;
            font-size: 0.9em;
        }
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px; /* Espaçamento entre as colunas */
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
            box-sizing: border-box;
        }
        .feed {
            width: 50%; /* Mantida em 50% */
            box-sizing: border-box;
        }
        .sidebar-left, .sidebar-right {
            width: 25%; /* Mantida em 25% */
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: fit-content;
            box-sizing: border-box;
        }
        .postar, .postagem {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 15px;
            box-sizing: border-box; /* Inclui padding na largura */
        }
        .postar {
            display: flex;
            flex-direction: column;
            align-items: stretch; /* Alinha todos os itens para a largura total */
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #e84545;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5em;
            margin-right: 10px;
        }
        .postar textarea {
            width: 100%; /* Largura total */
            height: 50px;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
            resize: none;
            margin-bottom: 10px;
            box-sizing: border-box; /* Inclui o padding e a borda na largura total */
        }
        .postar input[type="file"] {
            display: none; /* Esconde o campo de input padrão */
        }
        .upload-label {
            display: block; /* Garante que o botão do upload ocupe uma linha completa */
            background-color: #e84545; /* Cor de fundo */
            color: white; /* Cor do texto */
            border-radius: 20px; /* Bordas arredondadas */
            padding: 10px 15px; /* Espaçamento interno */
            cursor: pointer; /* Cursor de mão */
            text-align: center; /* Centraliza o texto */
            width: 100%; /* Largura total do botão */
            margin-top: 10px; /* Espaço acima */
            box-sizing: border-box; /* Inclui o padding e a borda na largura total */
        }
        .upload-label:hover {
            background-color: #e84545; /* Cor de fundo ao passar o mouse */
        }
        .postagem img {
            width: 100%;
            height: 100%;
            border-radius: 3%;
            margin-right: 10px;
        }
        .postagem-header {
            display: flex;
            align-items: center;
        }
        .postagem-header .nome {
            font-weight: bold;
        }
        .postagem-header .data {
            color: #777;
            font-size: 0.9em;
        }
        .postagem-conteudo {
            margin-top: 10px;
        }
        .interacoes {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        .interacoes button {
            background: none;
            border: none;
            color: #4267B2;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .interacoes button:hover {
            text-decoration: underline;
        }
        .interacoes button img {
            width: 18px;
            height: 18px;
            margin-right: 5px;
        }
        /* Estilos para a barra lateral de lembretes e eventos */
        .lembretes, .eventos {
            margin-bottom: 20px;
        }
        .lembretes h2, .eventos h2 {
            margin-bottom: 15px;
            font-size: 1.2em;
            color: #333;
        }     
        .lembretes form textarea, .eventos form textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: vertical;
            box-sizing: border-box;
            margin-bottom: 5%;
        }
        .lembretes form button, .eventos form button {
            background-color: #e84545;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            border-radius: 8px;
            cursor: pointer;
            box-sizing: border-box;
        }
        .lembrete-item, .evento-item {
            font-size: 70%;
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        /* Estilos para comentários */
        .comentarios {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
        .comentario {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .comentario img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .comentario-texto {
            background-color: #f4f4f4;
            border-radius: 5px;
            padding: 5px 10px;
            max-width: 80%;
        }
        .postar button {
            background-color: #e84545;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 10px; /* Espaço acima do botão */
            width: 100%; /* Largura total do botão */
            border-radius: 8px; /* Bordas arredondadas */
            cursor: pointer; /* Cursor de mão */
        }
        #evento_nome, #evento_entrada, #servico_nome, #servico_valor, #servico_contato, #servico_email{
            width: 100%;
            height: 30px;
            padding: 10px;
            margin-bottom: 5%;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: none;
            box-sizing: border-box;
        }
        #evento_dtInicio, #evento_dtFim, #servico_valor{
            width: 100%;
            height: 30px;
            padding: 10px;
            margin-bottom: 5%;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: none;
            box-sizing: border-box;           
        }
        #divulgacaoEventoSucesso{
            text-align: center;
        }
        a {
            color: black; /* Defina a cor desejada para todos os links */
            text-decoration: none; /* Remove o sublinhado padrão dos links */
        }

        a:hover {
            color: #e84545; /* Cor ao passar o mouse sobre o link */
            text-decoration: underline; /* Adiciona sublinhado ao passar o mouse */
        }          
    </style>
    <link href="assets/img/eventos.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
</head>
<body>

<header>
    <a href="feed.php"><div class="titulo">Encurtando Caminhos</div></a> <!-- Nome do site -->
    Meu Feed
    <a class="logout" href="destruirSessao.php">Sair</a> <!-- Link para sair -->
</header>
<?php
    if (isset($_POST['btn_postar'])) {
        // Diretório onde as imagens serão salvas
        $diretorio_destino = 'uploads/';
        $files = @$_FILES['file-upload'];       
        Publicacao::enviarPost (Utilitarios::capturarHora(), @$_SESSION['usuario_id'], @$_POST['publicacao_conteudo'], Publicacao::tratarImagem ($diretorio_destino, $files));
    }
    if(isset($_POST['btn_curtir'])){
        Publicacao::interagirPost(@$_POST['publicacao_id'], @$_SESSION['usuario_id']);
    }
?>
<div class="container">

    <!-- Barra lateral de eventos (Esquerda) -->
    <aside class="sidebar-left">
        <div class="eventos">
            <h2>Divulgue Seu Evento</h2>
            <form action="feed.php" method="POST">
                <button id="btn_divulgarEvento" name="btn_divulgarEvento">Divulgar Evento</button>
            </form>
            <br>
            <?php
                if(isset($_POST['btn_btn_editarEvento'])){
                    Evento::editarEvento($_POST['evento_nome'], Utilitarios::formatarHora($_POST['evento_dtInicio']), Utilitarios::formatarHora($_POST['evento_dtFim']), $_POST['evento_resumo'], $_POST['evento_entrada'], $_POST['evento_id']);
                }            
                if(isset($_POST['btn_divulgarEvento'])){
                    Evento::chamarFormEvento();
                }
                if(isset($_POST['btn_btn_salvarEvento'])){
                    Evento::promoverEvento($_POST['evento_nome'], Utilitarios::formatarHora($_POST['evento_dtInicio']), Utilitarios::formatarHora($_POST['evento_dtFim']), $_POST['evento_resumo'], $_POST['evento_entrada'], $_SESSION['usuario_id'], Utilitarios::capturarHora());
                }
                if(@$_GET['evento_id']<>""){
                    Evento::chamarFormEdicaoEvento(Evento::buscarEventoEspecifico(@$_GET['evento_id'])['id'], Evento::buscarEventoEspecifico(@$_GET['evento_id'])['titulo'], Evento::buscarEventoEspecifico(@$_GET['evento_id'])['resumo'], Evento::buscarEventoEspecifico(@$_GET['evento_id'])['valorEntrada'], Evento::buscarEventoEspecifico(@$_GET['evento_id'])['dtInicio'], Evento::buscarEventoEspecifico(@$_GET['evento_id'])['dtFim']);
                }             
            ?>
            <h6>Meus Eventos &#128266;</h6>
            <?php Evento::buscarEventos($_SESSION['usuario_id']);?>
        </div>
    </aside>

    <!-- Feed de postagens -->
    <div class="feed">
        <div class="postar">
            <form action="feed.php" method="POST" enctype="multipart/form-data">
                <textarea id="publicacao_conteudo" name="publicacao_conteudo"  required maxlength="500" placeholder="<?php Utilitarios::questionarUsuario()?>"></textarea>
                <label class="upload-label" for="file-upload">Selecionar imagem</label>
                <input type="file" id="file-upload" name="file-upload"/>
                <button id="btn_postar" name="btn_postar">Postar</button>
            </form>    
        </div>
        <?php Publicacao::buscarPosts();?>
    </div>

    <!-- Barra lateral de lembretes (Direita) -->
    <aside class="sidebar-right">
        <div class="lembretes">
            <h2>Ofereceça Serviços</h2>
            <form action="feed.php" method="POST">
                <button id="btn_divulgarServico" name="btn_divulgarServico">Novo Serviço</button>
            </form>
            <br>
            <?php
                if(isset($_POST['btn_btn_editarServico'])){
                    Servico::editarServico($_POST['servico_id'], $_POST['servico_nome'], $_POST['servico_resumo'], $_POST['servico_valor'], $_POST['servico_contato'], $_POST['servico_email']);
                }            
                if(isset($_POST['btn_divulgarServico'])){
                    Servico::chamarFormServico();
                }
                if(isset($_POST['btn_btn_salvarServico'])){
                    Servico::ofertarServico($_POST['servico_nome'], $_POST['servico_resumo'], $_POST['servico_valor'], $_POST['servico_contato'], $_POST['servico_email'], $_SESSION['usuario_id'],  Utilitarios::capturarHora());
                }
                if(@$_GET['servico_id']<>""){
                    Servico::chamarFormEdicaoServico(Servico::buscarServicoEspecifico(@$_GET['servico_id'])['id'],Servico::buscarServicoEspecifico(@$_GET['servico_id'])['titulo'],Servico::buscarServicoEspecifico(@$_GET['servico_id'])['resumo'],Servico::buscarServicoEspecifico(@$_GET['servico_id'])['valor'],Servico::buscarServicoEspecifico(@$_GET['servico_id'])['contato'],Servico::buscarServicoEspecifico(@$_GET['servico_id'])['email']);
                }            
            ?>
            <h6>Serviços Ofertados &#128105;&#8205;&#127981;</h6>
            <?php Servico::buscarServicos($_SESSION['usuario_id']);?>
        </div>
    </aside>
</div>

</body>
</html>
