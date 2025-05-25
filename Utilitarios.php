<?php
    @session_start();
    class Utilitarios {

        public static function capturarHora() {
            date_default_timezone_set('America/Sao_Paulo');
            $dataHoraAtual = date("Y-m-d H:i:s");
            return($dataHoraAtual);      
        }

        public static function eventoSucesso() {
            echo('
                    <div class="alert alert-success" role="alert">
                    Cadastro concluído com sucesso!
                    </div>
                ');
                       
        }

        public static function postSucesso() {
            echo('
                    <div class="alert alert-success" role="alert">
                    Post criado com sucesso!
                    </div>
                ');
                       
        }

        public static function comentarioSucesso() {
            echo('
                    <div class="alert alert-success" role="alert">
                    Post comentado com sucesso!
                    </div>
                ');
                       
        }

        public static function divulgacaoEventoSucesso() {
            echo('
                    <div class="alert alert-success" role="alert" id="divulgacaoEventoSucesso">
                    <font size="-1" text-align: center>Evento divulgado com sucesso!</font>
                    </div>
                ');
                       
        }
        
        public static function divulgacaoServicoSucesso() {
            echo('
                    <div class="alert alert-success" role="alert" id="divulgacaoEventoSucesso">
                    <font size="-1" text-align: center>Serviço divulgado com sucesso!</font>
                    </div>
                ');
                       
        }
        
        public static function divulgacaoEdicaoSucesso() {
            echo('
                    <div class="alert alert-success" role="alert" id="divulgacaoEventoSucesso">
                    <font size="-1" text-align: center>Edição realizada com sucesso!</font>
                    </div>
                ');
                       
        }
        
        public static function postErro() {
            echo('
                    <div class="alert alert-success" role="alert">
                    Erro ao criar o seu Post! Revise o conteúdo e tente novamente.
                    </div>
                ');
                       
        }          

        public static function eventoErroCredencial() {
            echo('
                    <div class="alert alert-danger" role="alert">
                        Usuário ou senha inválidos!
                    </div> 
                ');
                       
        }        

        public static function redirecionaLogin(){
            ?>
            <script>
                // Aguarda 5 segundos (5000 milissegundos) antes de redirecionar
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 5000);
            </script>            
            <?php
        }

        public static function redirecionaFeed(){
            ?>
            <script>
                // Aguarda 3 segundos (3000 milissegundos) antes de redirecionar
                setTimeout(function() {
                    window.location.href = 'Feed.php';
                }, 3000);
            </script>            
            <?php
        }
        
        public static function redirecionaFeedAreaDeterminada($areaDeterminada){
            @header("Location: $areaDeterminada");
        }          

        public static function questionarUsuario(){
            echo "O que você está pensando ".@$_SESSION['usuario_nomeSocial']."?";
        }

        public static function converteMes($data){
            $meses = [
                'January' => 'Janeiro',
                'February' => 'Fevereiro',
                'March' => 'Março',
                'April' => 'Abril',
                'May' => 'Maio',
                'June' => 'Junho',
                'July' => 'Julho',
                'August' => 'Agosto',
                'September' => 'Setembro',
                'October' => 'Outubro',
                'November' => 'Novembro',
                'December' => 'Dezembro'
            ];
            $data_formatada = strtr($data, $meses);
            return $data_formatada;

        }

        public static function formatarHora($data_hora_original){
            // Cria um objeto DateTime a partir da string original
            $dateTime = new DateTime($data_hora_original);

            // Formata a data e hora no formato desejado
            $data_hora_formatada = $dateTime->format('Y-m-d H:i:s');

            return $data_hora_formatada; // Saída: 2024-09-26 15:58:00
        }

    }
?>
