
<?php


    class Usuario {

        public static function resumirUsuario ($usuario_nomeCompleto, $usuario_nomeSocial, $usuario_documento, $usuario_profissao, $usuario_email, $usuario_senha, $usuario_dtNascimento) {
            echo(
                "Nome Completo: " . $_POST['usuario_nomeCompleto'] . ", <br>" .
                "Nome Social: " . $_POST['usuario_nomeSocial'] . ", <br>" .
                "Documento: " . $_POST['usuario_documento'] . ", <br>" .
                "Profissao: " . $_POST['usuario_profissao'] . ", <br>" .
                "E-mail: " . $_POST['usuario_email'] . ", <br>" .
                "Senha: " . $_POST['usuario_senha'] . ", <br>" .
                "Data de Nascimento: " . $_POST['usuario_dtNascimento']
            );          
        }

        public static function cadastrarUsuario ($usuario_nomeCompleto, $usuario_nomeSocial, $usuario_documento, $usuario_profissao, $usuario_email, $usuario_senha, $usuario_dtNascimento) {
            //include 'conectarBancoDados.php';
            include_once 'Utilitarios.php';

            $url = "http://localhost:8080/usuarios"; // Substitua pela URL real da sua API

            $data = [
                "nomeCompleto" => "$usuario_nomeCompleto",
                "nomeSocial" => "$usuario_nomeSocial",
                "dtNascimento" => "$usuario_dtNascimento",
                "documento" => "$usuario_documento",
                "profissao" => "$usuario_profissao",
                "senha" => "$usuario_senha",
                "email" => "$usuario_email"
            ];

            //var_dump($data);
            
            $payload = json_encode($data);
            
            $ch = curl_init($url);
            
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json"
            ]);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            curl_close($ch);
            
            if ($http_code === 201) {
                Utilitarios::eventoSucesso();
                Utilitarios::redirecionaLogin();
            } else {
                echo "Erro ao cadastrar usuário: " . $response;
            }
            
        }

        public static function conteUsuarios(){
            // URL da API
            $url = "http://localhost:8080/usuarios";

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
