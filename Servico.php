
<?php

    class Servico {

        public static function chamarFormServico () {
            echo
            ('
                <form action="feed.php" method="POST">
                    <input type="text" placeholder="Nome do Serviço" id="servico_nome" name="servico_nome" required maxlength="100">
                    <textarea id="servico_resumo" name="servico_resumo"  required maxlength="600" placeholder="Resuma os detalhes do seu serviço?"></textarea>
                    <input type="number" step="0.01" placeholder="Quanto custa o serviço?" id="servico_valor" name="servico_valor" required>
                    <input type="text" placeholder="Telefone de Contato" id="servico_contato" name="servico_contato" required maxlength="40">
                    <input type="email" placeholder="E-mail de Contato" id="servico_email" name="servico_email" required maxlength="200">
                    <button id="btn_btn_salvarServico" name="btn_btn_salvarServico">Salvar</button>
                </form>
                <br>
            ');          
        }

        public static function chamarFormEdicaoServico($servico_id, $servico_nome, $servico_resumo, $servico_valor, $servico_contato, $servico_email) {
            //echo("Acionado edição");
            
            echo
            ('
                <form action="feed.php" method="POST">
                    <input type="hidden" name="servico_id" id="servico_id" value="'.$servico_id.'">
                    <input type="text" value="'.$servico_nome.'" placeholder="Nome do Serviço" id="servico_nome" name="servico_nome" required maxlength="100">
                    <textarea id="servico_resumo" name="servico_resumo"  required maxlength="600" placeholder="Resuma os detalhes do seu serviço?">'.$servico_resumo.'</textarea>
                    <input type="number" step="0.01" value="'.$servico_valor.'" placeholder="Quanto custa o serviço?" id="servico_valor" name="servico_valor" required>
                    <input type="text" value="'.$servico_contato.'" placeholder="Telefone de Contato" id="servico_contato" name="servico_contato" required maxlength="40">
                    <input type="email" value="'.$servico_email.'" placeholder="E-mail de Contato" id="servico_email" name="servico_email" required maxlength="200">
                    <button id="btn_btn_editarServico" name="btn_btn_editarServico">Salvar</button>
                </form>
                <br>
            ');     
        }        

        public static function ofertarServico($servico_nome, $servico_resumo, $servico_valor, $servico_contato, $servico_email, $servico_prestador, $evento_dtCadastro){
            //include 'conectarBancoDados.php';
            //include_once 'Utilitarios.php';
            //$sql = "INSERT INTO tbl_servico(servico_nome, servico_resumo, servico_valor, servico_contato, servico_email, servico_prestador, servico_dtCadastro) VALUES ('$servico_nome', '$servico_resumo', '$servico_valor','$servico_contato', '$servico_email', '$servico_prestador', '$evento_dtCadastro')";
            //echo($sql);
            //$stmt = $conn->prepare($sql);
            //$stmt->execute();
            //Utilitarios::divulgacaoServicoSucesso();

            //include_once 'conectarBancoDados.php';
            include_once 'Utilitarios.php';


            $eventoJson = [
                "titulo" => "$servico_nome",
                "resumo" => "$servico_resumo",
                "valor" => "$servico_valor",
                "contato" => "$servico_contato",
                "email" => $servico_email,
                "prestador" => [
                    "id" => $servico_prestador
                ]
            ];
            $eventoJson = json_encode($eventoJson, JSON_UNESCAPED_UNICODE);
            
            // URL da API onde você deseja cadastrar o evento
            $url = 'http://localhost:8080/servicos'; // Substitua pela URL real da sua API


            // Inicializando o cURL
            $ch = curl_init();

            // Configurações do cURL para enviar uma requisição POST
            curl_setopt($ch, CURLOPT_URL, $url); // Definindo a URL da API
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornando a resposta como string
            curl_setopt($ch, CURLOPT_POST, true); // Método POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, $eventoJson); // Enviando os dados codificados em JSON
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json', // Definindo o tipo de conteúdo como JSON
            ]);

            // Executando a requisição
            $response = curl_exec($ch);

            // Verificando se ocorreu algum erro durante a requisição
            if(curl_errno($ch)) {
                echo 'Erro cURL: ' . curl_error($ch);
            } else {
                // Sucesso, mostrando a resposta da API
                Utilitarios::divulgacaoServicoSucesso();
            }

            // Fechando o cURL
            curl_close($ch);


        }

        public static function editarServico($servico_id, $servico_nome, $servico_resumo, $servico_valor, $servico_contato, $servico_email){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';
            //$sql = "UPDATE tbl_servico SET servico_nome = '$servico_nome', servico_resumo ='$servico_resumo', servico_valor ='$servico_valor', servico_contato ='$servico_contato', servico_email ='$servico_email' WHERE servico_id = '$servico_id'";
            //$stmt = $conn->prepare($sql);
            //$stmt->execute();
            //Utilitarios::divulgacaoEdicaoSucesso();

            //include_once 'conectarBancoDados.php';
            include_once 'Utilitarios.php';

            // Formatar para o formato esperado pelo backend
        
            
            $eventoJson = [
                "titulo" => "$servico_nome",
                "resumo" => "$servico_resumo",
                "valor" => "$servico_valor",
                "contato" => "$servico_contato",
                "email" => $servico_email,
                "prestador" => [
                    "id" => $_SESSION['usuario_id']
                ]
            ];
            $eventoJson = json_encode($eventoJson, JSON_UNESCAPED_UNICODE);
            //echo($eventoJson);

            // URL do endpoint para atualizar o evento
            $url = "http://localhost:8080/servicos/$servico_id"; // ID do evento que irá atualizar
            
            // Inicializa o cURL
            $ch = curl_init($url);
            
            // Configurações da requisição
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Método PUT
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
            Utilitarios::divulgacaoEdicaoSucesso();
            Utilitarios::redirecionaFeed();


        }

        public static function buscarServicos($usuario_id){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';

				// Inicia uma sessão cURL
				$ch = curl_init();
				$urlEventos = "http://localhost:8080/servicos/fornecedor/$usuario_id";

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
                            @$output .=('                         
                                <div class="evento-item"><a href="Feed.php?servico_id='.$eventoEncontrado->id.'">
                                    &#128105;&#8205;&#127981; <b>Serviço:</b> '.$eventoEncontrado->titulo.'<br>
                                    &#x1F4B0; <b>Valor:</b> R$'.$eventoEncontrado->valor.'<br>
                                    &#x1F4F1; <b>Contato:</b> '.$eventoEncontrado->contato.'<br>
                                    &#x2709; <b>E-mail:</b> '.$eventoEncontrado->email.'<br>
                                    &#x270E; <b>Criação:</b> '.Utilitarios::converteMes($eventoEncontrado->dtCadastro).'<br></a>
                                </div>                                
                            ');
                        }
                        echo @$output;
                    }else{
                        echo('<div class="evento-item">Poxa, você não possui eventos divulgados. &#x1F622;</div>');
                    }
				}

				// Fecha a sessão cURL
				curl_close($ch);		
        }        

        public static function buscarServicoEspecifico($servico_id){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';
            //$output="";
            //$sql = "SELECT tbl_servico.servico_id, tbl_servico.servico_nome, tbl_servico.servico_resumo, tbl_servico.servico_valor, tbl_servico.servico_contato, tbl_servico.servico_email, tbl_servico.servico_prestador, tbl_usuario.usuario_nomeCompleto, tbl_usuario.usuario_nomeSocial, tbl_usuario.usuario_profissao, tbl_servico.servico_dtCadastro, DATE_FORMAT(tbl_servico.servico_dtCadastro, '%d de %M de %Y') AS dataCadastro_formatada FROM tbl_servico INNER JOIN tbl_usuario ON tbl_usuario.usuario_id = tbl_servico.servico_prestador WHERE tbl_servico.servico_id = '$servico_id'";
            //$result = $conn->query($sql);
            //if ($result->num_rows > 0) {
                // Exibe os dados em uma tabela HTML       
                // Itera sobre cada linha de resultado
            //    while($row = $result->fetch_assoc()) {
            //        return($row);
            //    }
            //}

				// Inicia uma sessão cURL
				$ch = curl_init();
				$urlEvento = "http://localhost:8080/servicos/$servico_id";

				// Configurações da requisição cURL
				curl_setopt($ch, CURLOPT_URL, $urlEvento); // Definindo a URL
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar resposta como string

				// Executa a requisição cURL
				$response = curl_exec($ch);

				// Verifica se ocorreu erro
				if(curl_errno($ch)) {
					echo 'Erro: ' . curl_error($ch);
				} else {
					// Exibe a resposta da API

					$response = json_decode($response, true);
                    return $response;
				}

				// Fecha a sessão cURL
				curl_close($ch);            
            
        }
        
        public static function buscarServicoEspecificoSite($servico_nome){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';
            $output="";

            $url = "http://localhost:8080/servicos/busca?titulo=$servico_nome";

            // Inicializa a sessão cURL
            $ch = curl_init();

            // Configurações do cURL
            curl_setopt($ch, CURLOPT_URL, $url); // Definir a URL do serviço
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar a resposta como string
            curl_setopt($ch, CURLOPT_HTTPGET, true); // Método GET

            // Executa a requisição e armazena a resposta
            $response = curl_exec($ch);

            // Verifica se houve erro na requisição cURL
            if(curl_errno($ch)) {
                echo 'Erro cURL: ' . curl_error($ch);
            }

            // Fecha a conexão cURL
            curl_close($ch);

            // Verifica o código de status da resposta
            $status_code = http_response_code();

            // Se a resposta não estiver vazia, processa o JSON
            if (!empty($response)) {
                $servicos = json_decode($response, true); // Decodifica a resposta JSON para um array associativo

                // Verifica se há serviços retornados
                if ($servicos) {

                    foreach ($servicos as $servico) {
                    // Itera sobre os serviços utilizando foreach

                        echo(
                            '<div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item d-flex">
                                <div>
                                <h4 class="title"><a href="#" class="stretched-link">'.$servico['titulo'].'&#128105;&#8205;&#127981;</a></h4>
                                </br><class="description"><strong>Resumo: </strong>'.$servico['resumo'].'</br></br>
                                <p class="description"><strong>Prestador de Serviço: </strong></br>&#128100;'
                                .$servico['prestador']['nomeCompleto'].'. </br>&#128179; R$ '
                                .$servico['valor'].'. </br>&#128241;'
                                .$servico['contato'].'. </br>&#9993;'
                                .$servico['email'].'. </br>&#128188;'
                                .$servico['prestador']['profissao'].'. </br>
                                </p>                    
                                </div>
                            </div>
                            </div>'
                            );
                    }
                } else {
                    echo(
                        '<div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
                          <div class="service-item d-flex">
                            <div>
                              <h4 class="title"><a href="#" class="stretched-link">Ops!</a></h4>
                              <p class="description">Não encontramos profissionais com essa chave de busca.</p>                    
                              </div>
                          </div>
                        </div>'
                        );
                    
                }
            } else {
                echo(
                    '<div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
                      <div class="service-item d-flex">
                        <div>
                          <h4 class="title"><a href="#" class="stretched-link">Ops!</a></h4>
                          <p class="description">Não encontramos profissionais com essa chave de busca.</p>                    
                          </div>
                      </div>
                    </div>'
                    );
            }



        }

        public static function conteServicos(){
            // URL da API
            $url = "http://localhost:8080/servicos";

            // Inicializa o cURL
            $ch = curl_init();

            // Configurações do cURL
            curl_setopt($ch, CURLOPT_URL, $url); // Define a URL da API
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta como string
            curl_setopt($ch, CURLOPT_HEADER, false); // Não incluir cabeçalhos na resposta

            // Executa a requisição e armazena a resposta
            $response = curl_exec($ch);

            // Verifica se ocorreu algum erro na requisição
            if(curl_errno($ch)) {
                echo "Erro cURL: " . curl_error($ch);
            } else {
                // Converte a resposta JSON em um array associativo
                $servicos = json_decode($response, true);
                echo(count($servicos));
                // Verifica se a resposta tem dados
                /*
                if ($servicos) {
                    // Exibe a quantidade de serviços
                    echo "Quantidade de serviços encontrados: " . count($servicos) . "<br>";

                    // Exibe os dados dos serviços
                    foreach ($servicos as $servico) {
                        echo "ID do Serviço: " . $servico['id'] . "<br>";
                        echo "Título: " . $servico['titulo'] . "<br>";
                        echo "Resumo: " . $servico['resumo'] . "<br>";
                        echo "Valor: " . $servico['valor'] . "<br>";
                        echo "Contato: " . $servico['contato'] . "<br>";
                        echo "Email: " . $servico['email'] . "<br>";
                        echo "Data de Cadastro: " . $servico['dtCadastro'] . "<br>";

                        // Informações do prestador
                        $prestador = $servico['prestador'];
                        echo "<strong>Informações do Prestador:</strong><br>";
                        echo "ID do Prestador: " . $prestador['id'] . "<br>";
                        echo "Nome Completo: " . $prestador['nomeCompleto'] . "<br>";
                        echo "Nome Social: " . $prestador['nomeSocial'] . "<br>";
                        echo "Data de Nascimento: " . $prestador['dtNascimento'] . "<br>";
                        echo "Documento: " . $prestador['documento'] . "<br>";
                        echo "Profissão: " . $prestador['profissao'] . "<br>";
                        echo "Email do Prestador: " . $prestador['email'] . "<br>";
                        echo "Data de Cadastro do Prestador: " . $prestador['dtCadastro'] . "<br>";
                        echo "<hr>";
                    }
                } else {
                    echo "Nenhum serviço encontrado.";
                }
                    */
            }

            // Fecha o recurso cURL
            curl_close($ch);
        
        }



    }
?>