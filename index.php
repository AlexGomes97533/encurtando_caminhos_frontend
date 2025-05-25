<?php
    include 'conectarBancoDados.php';
    include 'Usuario.php';
    include 'Evento.php';
    include 'Servico.php';   
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Encurtando Caminhos</title>
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

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1 class="sitename">Encurtando Caminhos</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php#hero" class="">Início</a></li>
          <li><a href="index.php#about">Sobre Nós</a></li>
          <li><a href="index.php#services">Eventos</a></li>
          <li><a href="index.php#faq">FAQ</a></li>
          <li><a href="index.php#contact">Notícias</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="login.php" target="_blank">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- inicio -->
    <section id="hero" class="hero section">

      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container">
        <div class="row">
          <div class="col-lg-10">
            <h2 data-aos="fade-up" data-aos-delay="100">Eventos e Serviços:</h2>
            <p data-aos="fade-up" data-aos-delay="200">Procurando algo especial?</p>
          </div>
          <div class="col-lg-12">
            <form action="pesquisa.php" method="POST" class="sign-up-form d-flex" data-aos="fade-up" data-aos-delay="300">
              <input type="text" class="form-control" placeholder="O que pretende buscar?" id="Buscar" name="valorBusca">
              <input type="submit" class="btn btn-primary" value="Buscar">
            </form>
          </div>
        </div>
      </div>

    </section><!-- /inicio Section -->

    <!-- Quem somos Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">

          <div class="col-xl-5 content">
            <h2>Quem somos?</h2>
            <p>O Encurtando Caminhos é destinado especialmente para o público idoso e para os profissionais que assim como nós, buscam proporcionar a melhor experiência de forma simples, segura e agradável, por meio da divulgação de eventos, serviços e notícias.</p>
            <a href="#" class="read-more"><span>Saber mais</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-xl-7">
            <div class="row gy-4 icon-boxes">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box">
                  <i class="bi bi-buildings"></i>
                  <h3>Serviços</h3>
                  <p>Profissionais capacitados para atender suas necessidades.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-clipboard-pulse"></i>
                  <h3>Qualidade de Vida</h3>
                  <p>Eventos para você aproveitar o melhor que a vida tem a oferecer.</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-command"></i>
                  <h3>Voluntariado</h3>
                  <p>Ações voluntárias pertinho de você!</p>
                </div>
              </div> <!-- End Icon Box -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-megaphone"></i>
                  <h3>Notícias</h3>
                  <p>Você conectado com as principais notícias do Brasil e do mundo!</p>
                </div>
              </div> <!-- End Icon Box -->

            </div>
          </div>

        </div>
      </div>

    </section><!-- /Quem somos Section -->

    <!-- Eventos Intermediario Section -->
    <section id="stats" class="stats section">

      <img src="assets/img/stats-bg.jpg" alt="" data-aos="fade-in">

      <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?PHP Evento::contarEventoProximosSite();?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Eventos Realizados</p>
            </div>
          </div><!-- End Stats Item -->
          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?PHP Servico::conteServicos();?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Serviços Ofertados</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-4 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="<?PHP Usuario::conteUsuarios();?>" data-purecounter-duration="1" class="purecounter"></span>
              <p>Usuários Ativos</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Eventos Intermediario Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Evento Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Eventos</h2>
        <p>Confira os próximos eventos organizados pelos nossos parceiros! Se abra para vida!</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">
        <?php Evento::buscarEventoProximosSite();?>

      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">    

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="content px-xl-5">
              <h3><span>Perguntas </span><strong>Frequentes</strong></h3>
              <p>
                Quer saber mais informações sobre quem somos e o que fazemos?
              </p>
            </div>
          </div>

          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

            <div class="faq-container">
              <div class="faq-item faq-active">
                <h3><span class="num">1.</span> <span>Pra quem é o Encurtando Caminhos?</span></h3>
                <div class="faq-content">
                  <p>O Encurtando Caminhos é destinado especialmente para o público idoso e para os profissionais que assim como nós, buscam proporcionar a melhor experiência de forma simples, segura e agradável, por meio da divulgação de eventos, serviços e notícias.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">2.</span> <span>Como posso encontrar profissionais e eventos próximos a mim?</span></h3>
                <div class="faq-content">
                  <p>Basta usar nossa barra de pesquisas na página inicial para encontrar os serviços e eventos oferecidos pelos profissionais parceiros.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">3.</span> <span>Como funciona a contratação de serviços?</span></h3>
                <div class="faq-content">
                  <p>O Encurtando Caminhos serve como um portal para conectar prestadores de serviços e o público idoso. Todo o processo de contratação e contato ocorre por meio dos canais disponibilizados pelos prestadores de forma direta.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">4.</span> <span>A plataforma é 100% gratuita?</span></h3>
                <div class="faq-content">
                  <p>O uso da plataforma é totalmente gratuito, tanto para o usuário quanto os prestadores de serviços.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

              <div class="faq-item">
                <h3><span class="num">5.</span> <span>Como a plataforma funciona para profissinais?</span></h3>
                <div class="faq-content">
                  <p>Os profissionais interessados fazem um cadastro na plataforma, assim sendo possível divulgarem seus serviços e eventos que serão encontrados pelos usuários por meio da plataforma.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div><!-- End Faq item-->

            </div>

          </div>
        </div>

      </div>

    </section><!-- /Faq Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section">

      <img src="assets/img/cta-bg.jpg" alt="">

      <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-10">
            <div class="text-center">
              <h3>Notícias, eventos, esportes e mais!</h3>
              <p>Nunca é tarde para aprender e se manter atualizado com o mundo ao nosso redor. Estamos em uma era emocionante, cheia de novas descobertas e tecnologias que podem enriquecer nossas vidas e expandir nossos horizontes, não importa a idade que tenhamos.</p>
            </div>
          </div>
        </div>
      </div>

    </section><!-- /Call To Action Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Notícias</h2>
        <p>Confira as últimas notícias!</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-12">

            <div class="row gy-4">
              <div class="col-md-4">
                <div class="info-item" data-aos="fade" data-aos-delay="200">
                  <img src="assets\img\news_idosos_transporte.jpg" width="100%" height="100%"></img>
                  <h3>Preconceito no transporte</h3>
                  <p>O transporte público é o local campeão de preconceito contra o idoso. As pessoas se incomodam em dar o lugar ou a preferência para pessoas idosas.</p>
                  <p><a target="_blank" href="https://g1.globo.com/bemestar/noticia/2019/10/01/preconceito-contra-idosos-e-comum-no-transporte-publico.ghtml" >G1 - Confira para mais detalhes!</a></p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-4">
                <div class="info-item" data-aos="fade" data-aos-delay="300">
                  <img src="assets\img\saude.jpeg" width="100%" height="100%"></img>
                  <h3>Saúde na Melhor Idade</h3>
                  <p>O número de pessoas na terceira idade está crescendo. Segundo o IBGE, em 2043, mais de um quarto dos cidadãos brasileiros terá mais de 60 anos.</p>
                  <p><a target="_blank" href="https://www.oestesaude.com.br/oestemaissaude/saude/cinco-dicas-para-manter-a-saude-na-terceira-idade.html" >Oeste Saúde - Confira para mais detalhes!</a></p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-4">
                <div class="info-item" data-aos="fade" data-aos-delay="400">
                  <img src="assets\img\inclusao.png" width="100%" height="100%"></img>
                  <h3>Inclusão Digital</h3>
                  <p>Atualmente, dois a cada 10 idosos usam a internet. Ainda, segundo as projeções da Organização Mundial de Saúde (OMS), o Brasil está envelhecendo e vai se tornar um país idoso até 2050 – passando de 12,5% para 30% a população com mais de 60 anos. </p>
                  <p><a target="_blank" href="https://happy.com.br/blog/importancia-da-inclusao-digital-na-terceira-idade/" >Happy - Confira para mais detalhes!</a></p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-4">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <img src="assets\img\passeio.jpg" width="100%" height="100%"></img>
                  <h3>Passeios Culturais</h3>
                  <p>Os passeios culturais são de grande importância para os idosos por uma série de motivos. Eles oferecem uma oportunidade de enriquecimento intelectual, interação social com outros membros da família, estimulação cognitiva e bem-estar emocional. </p>
                  <p><a target="_blank" href="https://equipeesperancaevida.com/passeios-culturais-para-idosos/" >Esperança e Vida - Confira para mais detalhes!</a></p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-4">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <img src="assets\img\investimentos.jpg" width="100%" height="100%"></img>
                  <h3>Investimentos depois dos 60</h3>
                  <p>O brasileiro está vivendo cada vez mais, e por isso saber como investir a partir dos 60 anos é crucial. Hoje, os brasileiros com 60 anos ou mais já são cerca de 15% da população total do país. Há uma década, esse percentual era de 11,3%</p>
                  <p><a target="_blank" href="https://www.suno.com.br/noticias/investimentos-depois-60-anos-estrategias/" >Suno - Confira para mais detalhes!</a></p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-4">
                <div class="info-item" data-aos="fade" data-aos-delay="500">
                  <img src="assets\img\familia.jpg" width="100%" height="100%"></img>
                  <h3>Relações Familiares</h3>
                  <p>A rede de suporte social da pessoa idosa precisa ser fortalecida, pois pode beneficiar e auxiliar na saúde socioemocional e ampliar as convivências de forma prazerosa. Tenha relações significativas.</p>
                  <p><a target="_blank" href="https://metodosupera.com.br/a-importancia-das-relacoes-familiares-e-sociais-para-a-pessoa-idosa/" >Supera - Confira para mais detalhes!</a></p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

        </div>

        

      </div>

    </section><!-- /Contact Section -->

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