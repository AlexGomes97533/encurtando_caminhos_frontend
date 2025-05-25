<link href="assets/img/eventos.png" rel="icon">  
<!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

<?php
    include 'conectarBancoDados.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Área do Parceiro</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/eventos.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Author: Alex Gomes da Silva
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

      <a href="arealogada.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Encurtando Caminhos - Área do Parceiro</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="areaLogada.php#hero" class="">Início</a></li>
          <li><a href="areaLogada.php#eventos">Gestão de Serviços</a></li>
          <li><a href="areaLogada.php#services">Gestão de Eventos</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="novoEvento.php">Novo Evento</a>
      <a class="btn-getstarted" href="novoServico.php">Novo Serviço</a>
      <a class="btn-getstarted" href="destruirSessao.php">Sair</a>

    </div>
  </header>

  <main class="main">

    <!-- inicio -->
    <section id="hero" class="hero section">

      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">Seja bem vindo(a) <?php echo($_SESSION['nome'])?>!</h2>
            <p data-aos="fade-up" data-aos-delay="200">Encurtamos a distância entre você e seu público!</p>
          </div>
        </div>
      </div>

    </section><!-- /inicio Section -->

    <!-- Services Section -->
    <section id="eventos" class="services section">

      <!-- Evento Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Meus Serviços</h2>
        <p>Confira todos os serviços prestados por você!</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

        <?PHP
            $sql = "SELECT * FROM tbl_servico WHERE tbl_usuario_id = ".$_SESSION['id'];
            $result = $conn->query($sql);
            //var_dump($result);
          ?></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <?php
            if ($result->num_rows > 0) {
              // Exibe os dados em uma tabela HTML       
              // Itera sobre cada linha de resultado
              while($row = $result->fetch_assoc()) {
                echo(
                '<div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
                  <div class="service-item d-flex">
                    <div>
                      <h4 class="title"><a class="stretched-link">'.$row["nome"].' - '.$row["bairro"].'</a></h4>
                      <p class="description"><strong>Local: </strong>'.$row["rua"].' '.$row["numero"].' '.$row["complemento"].' '.$row["cep"].'                    
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
                      <p class="description">Não encontramos serviços cadastrados por você.</p>                    
                      </div>
                  </div>
                </div>'
                );
            }
            // Fecha a conexão ao final do script                    
          ?>

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Evento Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Meus Eventos</h2>
        <p>Confira todos os eventos organizados por você!</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

        <?PHP
            $sql = "SELECT * FROM tbl_evento WHERE organizador = ".$_SESSION['id'];
            $result = $conn->query($sql);
            //var_dump($result);
          ?></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <?php
            if ($result->num_rows > 0) {
              // Exibe os dados em uma tabela HTML       
              // Itera sobre cada linha de resultado
              while($row = $result->fetch_assoc()) {
                echo(
                '<div class="col-lg-6 " data-aos="fade-up" data-aos-delay="100">
                  <div class="service-item d-flex">
                    <div>
                      <h4 class="title"><a class="stretched-link">'.$row["nome"].' - '.$row["data"].' - '.$row["bairro"].'</a></h4>
                      <p class="description"><strong>Resumo do Evento:</strong> '.$row["resumo"].'. </br><strong>Organzado Por: </strong>'.$row["nome"].'. </br> <strong>Local: </strong>'.$row["rua"].' '.$row["numero"].' '.$row["complemento"].' '.$row["cep"].'
                      </br><class="description"><strong>Entrada: </strong>'.$row["entrada"].'</p>                    
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
                      <p class="description">Não encontramos eventos cadastrados por você.</p>                    
                      </div>
                  </div>
                </div>'
                );
            }
            // Fecha a conexão ao final do script                    
          ?>         

        </div>

        </div>

      </div>

    </section><!-- /Services Section -->


  </main>

  <footer id="footer" class="footer position-relative">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">Encurtando Caminhos</span>
          </a>
          <p>Procuramos formas de tornar a sua vida mais bonita e simples.</p>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Confira Eventos</h4>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Confira Serviços</h4>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Confira Profissionais</h4>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <div class="credits">
        Desenvolvido por: Projeto Integrador Univesp
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>