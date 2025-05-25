
<?php


    class Publicacao {

        public static function tratarImagem ($diretorio_destino, $files) {

            // Cria o diretório caso ele não exista
            if (!is_dir($diretorio_destino)) {
                mkdir($diretorio_destino, 0777, true);
            }
            
            // Verifica se o arquivo foi enviado
            if (isset($files) && $files['error'] === UPLOAD_ERR_OK) {
            
                // Informações sobre o arquivo
                $nome_arquivo = $files['name'];  // Nome do arquivo original
                $caminho_temporario = $files['tmp_name'];  // Caminho temporário no servidor
            
                // Verificar o tipo de arquivo para garantir que é uma imagem
                $extensao = pathinfo($nome_arquivo, PATHINFO_EXTENSION);
                $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
            
                if (in_array(strtolower($extensao), $extensoes_permitidas)) {
            
                    // Gerar um novo nome único para evitar sobrescrever arquivos
                    $novo_nome_arquivo = uniqid() . '.' . $extensao;
            
                    // Caminho completo onde o arquivo será salvo
                    $caminho_destino = $diretorio_destino . $novo_nome_arquivo;
            
                    // Mover o arquivo do local temporário para o diretório final
                    if (move_uploaded_file($caminho_temporario, $caminho_destino)) {
                        return $caminho_destino;
                    } else {
                        return "Erro ao mover o arquivo para o destino final.";
                    }
                } else {
                    return "Tipo de arquivo não permitido. Apenas imagens JPG, JPEG, PNG e GIF são aceitas.";
                }
            } else {
                return "Nenhuma imagem foi enviada ou ocorreu um erro no envio.";
            }
        }

        public static function enviarPost ($publicacao_dtPublicada, $publicacao_criador, $publicacao_conteudo, $publicacao_imagem){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';

            if($publicacao_imagem == "Nenhuma imagem foi enviada ou ocorreu um erro no envio."){
                $publicacao_imagem = "";
            }

            $eventoJson = [
                "conteudo" => $publicacao_conteudo,
                "criador" => [
                    "id" => $_SESSION['usuario_id'] 
                ],
                "recursos" => [[
                    "link" => $publicacao_imagem 
                ]]
            ];
            $eventoJson = json_encode($eventoJson, JSON_UNESCAPED_UNICODE);  
            
            //echo($eventoJson);

            // URL do endpoint para atualizar o evento
            $url = "http://localhost:8080/publicacoes"; // ID do evento que irá atualizar
            
            // Inicializa o cURL
            $ch = curl_init($url);
            
            // Configurações da requisição
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); // Método PUT
            curl_setopt($ch, CURLOPT_POSTFIELDS, $eventoJson); // Corpo da requisição
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json",  // Define o tipo de conteúdo como JSON
                "Content-Length: " . strlen($eventoJson) // Tamanho do corpo da requisição
            ]);
            
            // Executa a requisição
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            // Fecha a conexão cURL
            curl_close($ch);

            Utilitarios::postSucesso();
            Utilitarios::redirecionaFeed();

            /*
            $sql = "INSERT INTO tbl_publicacao (`publicacao_dtPublicada`, `publicacao_curtida`, `publicacao_descurtida`, `publicacao_criador`, `publicacao_conteudo`) VALUES ('$publicacao_dtPublicada', '0', '0', '$publicacao_criador', '$publicacao_conteudo')";
            $stmt = $conn->prepare($sql);
            
            // Executa a query e verifica se foi bem-sucedida
            if ($stmt->execute()) {
                // Obter o ID do registro inserido
                $id_inserido = $conn->insert_id;
                Publicacao::enviarImagem($publicacao_imagem, $id_inserido);
                Utilitarios::postSucesso();
                Utilitarios::redirecionaFeed();
            } else {
                Utilitarios::postErro();
            }
                */            
        }

        public static function enviarImagem ($diretorio_destino, $publicacao_id) {
            include 'conectarBancoDados.php';
            $sql = "INSERT INTO tbl_recurso (`recurso_link`, `recurso_publicacao`) VALUES ('$diretorio_destino','$publicacao_id')";
            $result = $conn->query($sql);
        }

        public static function buscarPosts(){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';
            //$sql = "SELECT tbl_publicacao.publicacao_criador, tbl_publicacao.publicacao_id, tbl_publicacao.publicacao_dtPublicada, DATE_FORMAT(tbl_publicacao.publicacao_dtPublicada, '%d de %M de %Y às %H:%i:%s') AS data_formatada, tbl_publicacao.publicacao_curtida, tbl_publicacao.publicacao_descurtida, tbl_usuario.usuario_nomeCompleto, tbl_usuario.usuario_nomeSocial, LEFT(tbl_usuario.usuario_nomeCompleto, 1) AS primeira_letra, tbl_publicacao.publicacao_conteudo FROM tbl_publicacao INNER JOIN tbl_usuario ON tbl_publicacao.publicacao_criador = tbl_usuario.usuario_id ORDER BY tbl_publicacao.publicacao_dtPublicada DESC;";
            //$result = $conn->query($sql);
            //print_r($result);
            //if ($result->num_rows > 0) {
                // Exibe os dados em uma tabela HTML       
                // Itera sobre cada linha de resultado
            //    while($row = $result->fetch_assoc()) {
            //        Publicacao::construirPost($row['primeira_letra'], $row['usuario_nomeCompleto'],$row['usuario_nomeSocial'], Utilitarios::converteMes($row['data_formatada']), $row['publicacao_conteudo'], Publicacao::buscarImagem($row['publicacao_id']), $row['publicacao_id'], $_SESSION['usuario_id']);
            //    }
            //}
            
				// Inicia uma sessão cURL
				$ch = curl_init();
				$urlEventos = "http://localhost:8080/publicacoes";

				// Configurações da requisição cURL
				curl_setopt($ch, CURLOPT_URL, $urlEventos); // Definindo a URL
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar resposta como string

				// Executa a requisição cURL
				$response = curl_exec($ch);

				// Verifica se ocorreu erro
				if(curl_errno($ch)) {
					echo 'Erro: ' . curl_error($ch);
				} else {
					// Exibe a resposta da API

					$response = json_decode($response);
					
                    if(count($response)>0){
                        foreach($response as $eventoEncontrado) {
                            @$linkRecurso = $eventoEncontrado->recursos;
                            @$linkRecurso = $linkRecurso[0]; 
                            @$linkRecurso = $linkRecurso->link;
                            //echo($linkRecurso);
                            Publicacao::construirPost(substr($eventoEncontrado->criador->nomeCompleto, 0, 1), $eventoEncontrado->criador->nomeCompleto,$eventoEncontrado->criador->nomeSocial, Utilitarios::converteMes($eventoEncontrado->dtPublicada), $eventoEncontrado->conteudo, $linkRecurso, $eventoEncontrado->id, $_SESSION['usuario_id']);
                        }
                    }else{
                        echo('<div class="evento-item">Poxa, não há postagens dos seus amigos no momento. &#x1F622;</div>');
                    }
                }    


        }
        /*
        public static function buscarImagem($idPost){
            include 'conectarBancoDados.php';
            $sql = "SELECT tbl_recurso.recurso_id, tbl_recurso.recurso_link, tbl_recurso.recurso_publicacao FROM tbl_recurso WHERE tbl_recurso.recurso_publicacao = ".$idPost.";";
            $result = $conn->query($sql);
            //print_r($result);
            if ($result->num_rows > 0) {
                // Exibe os dados em uma tabela HTML       
                // Itera sobre cada linha de resultado
                while($row = $result->fetch_assoc()) {
                  return($row['recurso_link']);
                }
            }            
        }
        */
        public static function construirPost($primeira_letra, $usuario_nomeCompleto, $usuario_nomeSocial, $data_formatada, $publicacao_conteudo, $buscarImagem, $publicacao_id, $interacao_usuario){
            include_once 'Utilitarios.php';
            
            if($buscarImagem==""){
                $buscarImagemComposicao = '';
            }else{
                $buscarImagemComposicao = '<img src="'.$buscarImagem.'" alt="Imagem da postagem" />';
            }
            echo('
                <!-- Postagem 1 -->
                <session id='.$publicacao_id.'>
                    <div class="postagem">
                        <div class="postagem-header">
                            <div class="avatar">'.$primeira_letra.'</div> <!-- Avatar da postagem -->
                            <div>
                                <div class="nome">'.$usuario_nomeCompleto.' ('.$usuario_nomeSocial.')</div>
                                <div class="data">Publicado em '.$data_formatada.'</div>
                            </div>
                        </div>
                        <div class="postagem-conteudo">                        
                            '.$publicacao_conteudo.'
                        </div>
                        <div class="postagem-conteudo">
                            '.$buscarImagemComposicao.'
                        </div>                                       
                        <div class="interacoes">
                            <form action="feed.php#'.$publicacao_id.'" method="POST">
                                <input type="hidden" name="campo_invisivel" id="campo_invisivel" value="curtir">
                                <input type="hidden" name="publicacao_id" id="publicacao_id" value="'.$publicacao_id.'">
                                <button type="submit" id="btn_curtir" name="btn_curtir">
                                    <img src="assets\img\like.png" alt="Texto do botão" style="width: 20px; height: 20px;">
                                     '.Publicacao::pegarInteracoes($publicacao_id).'
                                </button>
                            </form>
                            <form action="feed.php#'.$publicacao_id.'" method="POST">
                                <input type="hidden" name="campo_invisivel" id="campo_invisivel" value="comentar">
                                <input type="hidden" name="publicacao_id" id="publicacao_id" value="'.$publicacao_id.'">
                                <button type="submit" id="btn_acionar_comentar" name="btn_acionar_comentar">
                                    <img src="assets\img\comentar.png" alt="Texto do botão" style="width: 20px; height: 20px;">
                                    Comentar '.Publicacao::pegarComentarios($publicacao_id).'
                                </button>
                            </form>                                                     
                        </div>
                        '.Publicacao::gerarAreaComentario (@$publicacao_id, @$_POST['publicacao_id']).'
                        '.Publicacao::registrarComentario(@$_POST['comentario_conteudo'], Utilitarios::capturarHora(), @$_POST['publicacao_id'], $_SESSION['usuario_id'], @$publicacao_id).'
                        <!-- Exemplos de comentários -->
                        '.Publicacao::construirComentario($publicacao_id).'
                    </div>
                </session>                
            ');
        }

        public static function triagemImagemPost($buscarImagem){
            if($buscarImagem == "Erro ao mover o arquivo para o destino final."){
                return "NÃO";
            }else{
                if($buscarImagem == "Tipo de arquivo não permitido. Apenas imagens JPG, JPEG, PNG e GIF são aceitas."){
                    return "NÃO";
                }else{
                    if($buscarImagem == "Nenhuma imagem foi enviada ou ocorreu um erro no envio."){
                        return "NÃO";
                    }else{
                        if($buscarImagem == 0){
                            return "NÃO";
                        }else{
                            return "SIM";
                        }
                        
                    }
                }
            }
        }

        public static function invoqueImagem($validador, $buscarImagem){

            //echo($buscarImagem);

            
            if($validador=="SIM"){
                return 
                '
                    <div class="postagem-conteudo">
                        <img src="'.$buscarImagem.'" alt="Imagem da postagem" />
                    </div>                 
                '; 
            }else{
                return '';
            }
            
        }

        public static function interagirPost($id_post, $interacao_usuario){

            $url = "http://localhost:8080/curtidas/alternar?usuarioId=$interacao_usuario&publicacaoId=$id_post";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            /*
            if ($httpCode === 200) {
                $data = json_decode($response, true);
                echo "Curtida processada com sucesso!";
                print_r($data); // Exibe os dados retornados
            } elseif ($httpCode === 204) {
                echo "Curtida removida.";
            } else {
                echo "Erro ao processar curtida. Código HTTP: $httpCode";
            }            
            */
        }

        public static function pegarInteracoes($id_post){
            $publicacaoId = $id_post; // ID da publicação que queremos contar curtidas
            $url = "http://localhost:8080/curtidas/contar/$publicacaoId";
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            
            if ($httpCode === 200) {
                $totalCurtidas = (int) $response;
                if($totalCurtidas>1){
                    return ($totalCurtidas." Curtidas");
                }else{
                    return ($totalCurtidas." Curtida");
                }
                //echo "A publicação {$publicacaoId} tem {$totalCurtidas} curtidas.";
            } else {
                return ("0 Curtida");
                //echo "Erro ao obter curtidas. Código HTTP: $httpCode";
            }           

        }

        public static function gerarAreaComentario ($id_publicacao_corrente, $id_publicacao){
            if(isset($_POST['btn_acionar_comentar']) && @$id_publicacao_corrente == @$id_publicacao){
                return ('
                <div class="postar">
                    <form action="feed.php#'.$id_publicacao.'" method="POST">
                        <textarea id="comentario_conteudo" name="comentario_conteudo"  required maxlength="200" placeholder="O que você acha sobre isso?"></textarea>
                        <input type="hidden" name="publicacao_id" id="publicacao_id" value="'.$id_publicacao.'">
                        <button id="btn_comentar" name="btn_comentar">Comentar</button>
                    </form>    
                </div>            
            ');
            }

        }

        public static function registrarComentario($comentario_conteudo, $comentario_dtCadastro, $comentario_publicacao, $comentario_usuario, $id_publicacao_corrente){
            include_once 'Utilitarios.php';
            include 'conectarBancoDados.php';
            if(isset($_POST['btn_comentar']) && @$id_publicacao_corrente == @$comentario_publicacao){

                include_once 'Utilitarios.php';

                // A URL da API
                $url = "http://localhost:8080/comentarios";
    
                // Os dados que você quer enviar para criar o comentário (ajuste conforme seu modelo)
                $data = [
                    "conteudo" => $comentario_conteudo,  // conteúdo do comentário
                    "publicacao" => [
                        "id" => $id_publicacao_corrente  // ID da publicação onde o comentário será feito
                    ],
                    "comentadoPor" => [
                        "id" => $comentario_usuario  // ID do usuário que comentou
                    ]
                ];
    
    
    
    
                // Inicia o cURL
                $ch = curl_init($url);
    
                // Configurações da requisição cURL
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Retorna a resposta como string
                curl_setopt($ch, CURLOPT_POST, true);  // Define o método POST
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Envia os dados em formato JSON
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',  // Define que o conteúdo enviado é em JSON
                ]);
    
                // Executa a requisição e obtém a resposta
                $response = curl_exec($ch);
                
                // Verifica se ocorreu algum erro
                if(curl_errno($ch)) {
                    echo 'Erro cURL: ' . curl_error($ch);
                } else {
                    // Resposta da API
                    Utilitarios::comentarioSucesso();
                    Utilitarios::redirecionaFeedAreaDeterminada($id_publicacao_corrente);
                }
                
                // Fecha a conexão cURL
                curl_close($ch);                    

            }
        }

        public static function pegarComentarios($id_publicacao){
            include_once 'Utilitarios.php';

            // O ID da publicação que você quer buscar os comentários
            $publicacaoId = $id_publicacao;  // Substitua pelo ID real da publicação

            // A URL da API, incluindo o ID da publicação
            $url = "http://localhost:8080/comentarios/publicacao/$publicacaoId";

            // Inicia o cURL
            $ch = curl_init($url);

            // Configurações da requisição cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Retorna a resposta como string
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',  // Define que o conteúdo é JSON
            ]);

            // Executa a requisição e obtém a resposta
            $response = curl_exec($ch);

            // Verifica se ocorreu algum erro
            if(curl_errno($ch)) {
                return(curl_error($ch));
            } else {
                $comentariosArray = json_decode($response, true);
                // Resposta da API
                return(count($comentariosArray));
            }

            // Fecha a conexão cURL
            curl_close($ch);            
            
        }

        public static function construirComentario($id_publicacao){
            include_once 'Utilitarios.php';

            // Inicia uma sessão cURL
            $ch = curl_init();
            $urlEventos = "http://localhost:8080/comentarios/publicacao/$id_publicacao";

            // Configurações da requisição cURL
            curl_setopt($ch, CURLOPT_URL, $urlEventos); // Definindo a URL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar resposta como string

            // Executa a requisição cURL
            $response = curl_exec($ch);

            $response = json_decode($response);

            $output = "";
            //print_r($result);
            if(count($response)>0){
                // Exibe os dados em uma tabela HTML       
                // Itera sobre cada linha de resultado
                foreach($response as $eventoEncontrado) {
                    $output .=('
                          <br>
                            <div style="background-color: #f0f0f0; border-radius: 10px; padding: 15px; border: 1px solid #ddd;">
                                <div class="postagem-header">
                                    <div class="avatar">'.substr($eventoEncontrado->comentadoPor->nomeSocial, 0, 1).'</div> <!-- Avatar da postagem -->
                                    <div>
                                        <div class="nome">'.$eventoEncontrado->comentadoPor->nomeCompleto.' ('.$eventoEncontrado->comentadoPor->nomeSocial.')</div>
                                        <div class="data">Comentou em '.Utilitarios::converteMes($eventoEncontrado->dtCadastro).'</div>
                                    </div>
                                </div>
                                <div class="postagem-conteudo">
                                    '.$eventoEncontrado->conteudo.'
                                </div>                        
                            </div>                                           
                    ');
                }
                return $output;
            }
            curl_close($ch);             
        }

    }
?>
