
<?php


    class Evento {

        public static function chamarFormEvento () {
            echo
            ('
                <form action="feed.php" method="POST">
                    <input type="text" placeholder="Nome do Evento" id="evento_nome" name="evento_nome" required maxlength="100">
                    <textarea id="evento_resumo" name="evento_resumo"  required maxlength="600" placeholder="Do que se trata seu evento?"></textarea>
                    <input type="number" step="0.01" placeholder="Quanto custa a entrada?" id="evento_entrada" name="evento_entrada" required>
                    <h6>Início: </h6>
                    <input type="datetime-local" id="evento_dtInicio" name="evento_dtInicio" required>
                    <h6>Final: </h6>
                    <input type="datetime-local" id="evento_dtFim" name="evento_dtFim" required>
                    <button id="btn_salvarEvento" name="btn_btn_salvarEvento">Salvar</button>
                </form>
                <br>
            ');          
        }

        public static function chamarFormEdicaoEvento ($evento_id, $evento_nome, $evento_resumo, $evento_entrada, $evento_dtInicio, $evento_dtFim) {
            echo($evento_nome);
            
            echo
            ('
                <form action="feed.php" method="POST">
                    <input type="hidden" name="evento_id" id="evento_id" value="'.$evento_id.'">
                    <input type="text" placeholder="Nome do Evento" id="evento_nome" name="evento_nome" required maxlength="100" value="'.$evento_nome.'"/>
                    <textarea id="evento_resumo" name="evento_resumo" required maxlength="600" placeholder="Do que se trata seu evento?">'.$evento_resumo.'</textarea>
                    <input type="number" step="0.01" placeholder="Quanto custa a entrada?" id="evento_entrada" name="evento_entrada" required value="'.$evento_entrada.'"/>
                    <h6>Início: </h6>
                    <input type="datetime-local" id="evento_dtInicio" name="evento_dtInicio" required value="'.$evento_dtInicio.'"/>
                    <h6>Final: </h6>
                    <input type="datetime-local" id="evento_dtFim" name="evento_dtFim" required value="'.$evento_dtFim.'"/>
                    <button id="btn_editarEvento" name="btn_btn_editarEvento">Salvar</button>
                </form>
                <br>
            ');          
        }        

        public static function promoverEvento($evento_nome, $evento_dtInicio, $evento_dtFim, $evento_resumo, $evento_entrada, $evento_organizador, $evento_dtCadastro){
            //include_once 'conectarBancoDados.php';
            include_once 'Utilitarios.php';

            $evento_dtInicio = new DateTime($evento_dtInicio);
            $evento_dtFim = new DateTime($evento_dtFim);
            
            // Formatar para o formato esperado pelo backend
            $evento_dtInicioFormatted = $evento_dtInicio->format('Y-m-d\TH:i:s');
            $evento_dtFimFormatted = $evento_dtFim->format('Y-m-d\TH:i:s');


            $eventoJson = [
                "titulo" => "$evento_nome",
                "dtInicio" => "$evento_dtInicioFormatted",
                "dtFim" => "$evento_dtFimFormatted",
                "resumo" => "$evento_resumo",
                "valorEntrada" => $evento_entrada,
                "organizador" => [
                    "id" => $evento_organizador
                ]
            ];
            $eventoJson = json_encode($eventoJson, JSON_UNESCAPED_UNICODE);
            
            // URL da API onde você deseja cadastrar o evento
            $url = 'http://localhost:8080/eventos'; // Substitua pela URL real da sua API


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
                Utilitarios::divulgacaoEventoSucesso();
            }

            // Fechando o cURL
            curl_close($ch);                        

        }

        public static function editarEvento($evento_nome, $evento_dtInicio, $evento_dtFim, $evento_resumo, $evento_entrada, $evento_id){
            //include_once 'conectarBancoDados.php';
            include_once 'Utilitarios.php';

            // Formatar para o formato esperado pelo backend
        
            $evento_dtInicio = new DateTime($evento_dtInicio); // Sem $this->
            $evento_dtFim = new DateTime($evento_dtFim);       // Sem $this->
            
            $evento_dtInicioFormatted = $evento_dtInicio->format('Y-m-d\TH:i:s');
            $evento_dtFimFormatted = $evento_dtFim->format('Y-m-d\TH:i:s');
            
            $eventoJson = [
                "titulo" => $evento_nome,
                "dtInicio" => $evento_dtInicioFormatted,
                "dtFim" => $evento_dtFimFormatted,
                "resumo" => $evento_resumo,
                "valorEntrada" => $evento_entrada,
                "organizador" => [
                    "id" => $_SESSION['usuario_id'] 
                ]
            ];
            $eventoJson = json_encode($eventoJson, JSON_UNESCAPED_UNICODE);
            //echo($eventoJson);

            // URL do endpoint para atualizar o evento
            $url = "http://localhost:8080/eventos/$evento_id"; // ID do evento que irá atualizar
            
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

        public static function buscarEventos($usuario_id){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';

				// Inicia uma sessão cURL
				$ch = curl_init();
				$urlEventos = "http://localhost:8080/eventos/organizador/$usuario_id";

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
                                <div class="evento-item"><a href="Feed.php?evento_id='.$eventoEncontrado->id.'">
                                    <b>Evento:</b> '.$eventoEncontrado->titulo.'<br>
                                    <b>Início:</b> '.$eventoEncontrado->dtInicio.'<br>
                                    <b>Fim:</b> '.$eventoEncontrado->dtFim.'<br>
                                    <b>Criação:</b> '.Utilitarios::converteMes($eventoEncontrado->dtCadastro).'<br></a>
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

        public static function buscarEventoEspecifico($evento_id){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';
            //$output="";

				// Inicia uma sessão cURL
				$ch = curl_init();
				$urlEvento = "http://localhost:8080/eventos/$evento_id";

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
        
        public static function buscarEventoBuscaSite($evento_nome){
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';
            // URL do serviço REST
            $url = "http://localhost:8080/eventos/busca?titulo=$evento_nome";

            // Inicializa o cURL
            $ch = curl_init();

            // Configurações da requisição cURL
            curl_setopt($ch, CURLOPT_URL, $url);  // URL do serviço
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Retorna a resposta como string
            curl_setopt($ch, CURLOPT_HTTPGET, true);  // Define o método HTTP GET

            // Executa a requisição e captura a resposta
            $response = curl_exec($ch);

            // Verifica se houve algum erro na requisição
            if(curl_errno($ch)) {
                echo 'Erro cURL: ' . curl_error($ch);
            }

            // Fecha a conexão cURL
            curl_close($ch);

            // Verifica o código de status da resposta
            $status_code = http_response_code();

            // Se a resposta não estiver vazia, você pode decodificar o JSON
            if (!empty($response)) {
                $eventos = json_decode($response, true);  // Decodifica o JSON em um array

                // Verifica se a resposta contém eventos
                if ($eventos) {

                    
                    // Usando foreach para iterar sobre os eventos
                    foreach ($eventos as $evento) {
                        echo(
                        '<div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item d-flex">
                                <div>
                                    <h4 class="title"><a href="#" class="stretched-link">Evento: '.$evento['titulo'].' &#128266;</br>Início: '.Utilitarios::converteMes($evento['dtInicio']).' </br>Fim: '.Utilitarios::converteMes($evento['dtFim']).'</a></h4>
                                    <p class="description"><strong>Resumo do Evento:</strong> '.$evento['resumo'].'. </br></br>
                                    <strong>Organização:</br> </strong>
                                    &#128100; Responsável: '.$evento['organizador']['nomeCompleto'].' ('.$evento['organizador']['nomeSocial'].'). </br>
                                    &#128188; Profissão: '.$evento['organizador']['profissao'].'</br>
                                    &#9993; Contato: '.$evento['organizador']['email'].'</br>
                                    &#128179; Entrada: R$'.$evento['valorEntrada'].'</br>                  
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
                                    <p class="description">Não encontramos eventos com essa chave de busca.</p>                    
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
                          <p class="description">Não encontramos eventos com essa chave de busca.</p>                    
                          </div>
                      </div>
                    </div>'
                    );
            }

    
        }
 
        public static function buscarEventoProximosSite() {
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';
            $output = "";
        
            // URL da API
            $url = "http://localhost:8080/eventos/ordenados";

            // Inicializa a sessão cURL
            $ch = curl_init();

            // Define a URL e as opções para a requisição GET
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que o cURL retorne a resposta ao invés de imprimi-la
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json" // Definindo o tipo de conteúdo como JSON
            ));

            // Executa a requisição e armazena a resposta
            $response = curl_exec($ch);

            // Verifica se houve erro na requisição
            if(curl_errno($ch)) {
                echo 'Erro cURL: ' . curl_error($ch);
            } else {
                // Decodifica a resposta JSON para um array associativo
                $eventos = json_decode($response, true);

                // Verifica se a resposta contém eventos
                if ($eventos) {

                    foreach ($eventos as $evento) {
                        /*
                        echo "<li>";
                        echo "<strong>Título:</strong> " . $evento['titulo'] . "<br>";
                        echo "<strong>Data de Início:</strong> " . date("d/m/Y H:i", strtotime($evento['dtInicio'])) . "<br>";
                        echo "<strong>Data de Fim:</strong> " . date("d/m/Y H:i", strtotime($evento['dtFim'])) . "<br>";
                        echo "<strong>Resumo:</strong> " . $evento['resumo'] . "<br>";
                        echo "<strong>Valor da Entrada:</strong> R$ " . number_format($evento['valorEntrada'], 2, ',', '.') . "<br>";
                        */
                        // Exibe as informações do organizador
                        $organizador = $evento['organizador'];
                        /*
                        echo "<strong>Organizador:</strong> " . $organizador['nomeCompleto'] . " (" . $organizador['nomeSocial'] . ")<br>";
                        echo "<strong>Email:</strong> " . $organizador['email'] . "<br>";
                        echo "<strong>Data de Cadastro do Organizador:</strong> " . date("d/m/Y H:i", strtotime($organizador['dtCadastro'])) . "<br>";
                        */
                        

                        echo(
                            '<div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
                                <div class="service-item d-flex">
                                    <div>
                                        <h4 class="title"><a href="#" class="stretched-link">Evento: '.$evento['titulo'].' &#128266;</br>Início: '. date("d/m/Y H:i", strtotime($evento['dtInicio'])) .' </br>Fim: '.date("d/m/Y H:i", strtotime($evento['dtFim'])).'</a></h4>
                                        <p class="description"><strong>Resumo do Evento:</strong> '.$evento['resumo'].'. </br></br>
                                        <strong>Organização:</br> </strong>
                                        &#128100; Responsável: '.$organizador['nomeCompleto'].' ('.$organizador['nomeSocial'].'). </br>
                                        &#128188; Profissão: '.$organizador['profissao'].'</br>
                                        &#9993; Contato: '.$organizador['email'].'</br>
                                        &#128179; Entrada: R$'.$evento['valorEntrada'].'</br>                  
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
                                    <p class="description">Não encontramos eventos próximos a você.</p>                    
                                </div>
                            </div>
                        </div>'
                    );
                }
            }

            // Fecha a sessão cURL
            curl_close($ch);
        }    
           
            public static function contarEventoProximosSite() {
                //include 'conectarBancoDados.php';
                include_once 'Utilitarios.php';
                $output = "";
            
                // URL da API
                $url = "http://localhost:8080/eventos/ordenados";
    
                // Inicializa a sessão cURL
                $ch = curl_init();
    
                // Define a URL e as opções para a requisição GET
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Para que o cURL retorne a resposta ao invés de imprimi-la
                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type: application/json" // Definindo o tipo de conteúdo como JSON
                ));
    
                // Executa a requisição e armazena a resposta
                $response = curl_exec($ch);
    
                // Verifica se houve erro na requisição
                if(curl_errno($ch)) {
                    echo 'Erro cURL: ' . curl_error($ch);
                } else {
                    // Decodifica a resposta JSON para um array associativo
                    $eventos = json_decode($response, true);
    
                    // Verifica se a resposta contém eventos
                    echo(count($eventos));
                
            }

            
        }
               
        public static function conteEventos(){
            include_once 'Utilitarios.php';
            include 'conectarBancoDados.php';
            $sql="SELECT COUNT(*) AS 'QTD' FROM tbl_evento";
            $result = $conn->query($sql);
            //print_r($result);
            if ($result->num_rows > 0) {
                // Exibe os dados em uma tabela HTML       
                // Itera sobre cada linha de resultado
                while($row = $result->fetch_assoc()) {
                    echo($row['QTD']);
                }
            }
        
        }

    }
?>
