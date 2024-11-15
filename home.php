<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$aServicos = $db->dbSelect("SELECT * FROM servicos WHERE status_registro = 1 
                            ORDER BY posicao LIMIT 3"
);

$aPropostas = $db->dbSelect("SELECT * FROM propostas WHERE status_registro = 1 
                            ORDER BY posicao LIMIT 3"
);

$aNoticias = $db->dbSelect("SELECT * FROM noticias WHERE status_registro = 1 
                            ORDER BY data_postagem DESC LIMIT 3"
);


?>


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($aNoticias as $index => $noticias): ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
    </div>

    <div class="carousel-inner">
        <?php foreach ($aNoticias as $index => $noticias): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <img src="uploads/noticias/<?= ($noticias['imagem']) ?>" class="d-block w-100" alt="<?= ($noticias['titulo']) ?>">
                <div class="carousel-caption">
                    <h5><?= ($noticias['titulo']) ?></h5>
                    <p><a href="index.php?pagina=exibirNoticias&id_noticias=<?= $noticias['id_noticias'] ?>" class="page-button" type="button">Saiba Mais</a></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<section id="about" class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
                <div class="about-img">
                    <img src="assets/img/LogoNav.jpg" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                <div class="about-text">
                    <h2>A tecnologia que conecta<br /> instuições e resultados!</h2>
                    <p>Maximize o potencial de sua instituição com uma gestão simplificada e inteligente.
                        Transforme a administração escolar em um aliado para o aprendizado e o sucesso dos alunos.
                    </p>
                    <a href="index.php?pagina=sobreNos" class="page-button" type="button">Saiba Mais</a>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="custom-line">

<section class="services section-padding" id="services">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2 style="text-transform: uppercase;">Nossos Serviços</h2>
                    <p>Nossa plataforma oferece soluções que simplificam processos administrativos,<br>melhoram a comunicação e ajudam a acompanhar o desempenho dos alunos.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($aServicos as $servicos): ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <a href="index.php?pagina=servicos" class="card-link">
                        <div class="card text-white text-center pb-2">
                            <div class="card-body">
                                <i class="<?= $servicos['icone_bootstrap'] ?>"></i>
                                <h3 class="card-title"><?= $servicos['subtitulo'] ?></h3>
                                <p class="lead"><?= $servicos['texto_card'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<hr class="custom-line">

<section id="portfolio" class="portfolio section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2 style="text-transform: uppercase;">Nossas Propostas</h2>
                    <p>O sistema de captação e gestão de alunos foi desenvolvido para otimizar todos os processos de uma instituição de ensino,
                        <br> desde a inscrição até a formação do aluno.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($aPropostas as $propostas): ?>
                <div class="col-12 col-md-12 col-lg-4 mb-2">
                    <div class="card text-light text-center bg-white pb-2 h-100">
                        <div class="card-body text-dark d-flex flex-column">
                            <div class="img-area mb-4">
                                <img src="uploads/propostas/<?= $propostas['imagem'] ?>" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title"><?= $propostas['subtitulo'] ?></h3>
                            <p class="lead"><?= $propostas['texto_card'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-12">
                <a href="index.php?pagina=propostas" class="page-button button-propostas" type="button">Ler Mais</a>
            </div>
        </div>
    </div>
</section>
<hr class="custom-line">

<section class="team section-padding" id="team">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2 style="text-transform: uppercase;">Nosso Time</h2>
                    <p>Nosso time de desenvolvedores júnior é formado por profissionais talentosos e em constante evolução, apaixonados por aprender e crescer na área de tecnologia. Sob a orientação de mentores experientes, eles trazem novas ideias e uma abordagem criativa para o desenvolvimento de soluções inovadoras. Embora ainda em fase de aprendizado, nossa equipe está sempre disposta a enfrentar desafios, trabalhar em equipe e entregar resultados com qualidade e dedicação. Com foco no desenvolvimento contínuo, buscamos construir soluções que atendam às necessidades de nossos clientes e contribuir para o sucesso da sua instituição.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="img/team-1.jpg" alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Lucas Gonzáles</h3>
                        <p class="card-text">Lucas, desenvolvedor júnior especializado em HTML e CSS, trabalhou na construção da interface visual do projeto acadêmico, trazendo uma experiência de usuário fluida e responsiva. Ele aplicou seus conhecimentos para transformar o design em páginas interativas, aprimorando a acessibilidade e a navegação.</p>
                        <p class="socials">
                            <a href=""><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="img/team-2.jpg" alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">João Felipe</h3>
                        <p class="card-text">João contribuiu para o projeto acadêmico com suas habilidades em HTML e CSS, focando no design visual e na usabilidade. Sua atuação foi essencial para garantir uma interface atraente e intuitiva, onde estética e funcionalidade se alinham para facilitar a interação do usuário.</p>
                        <p class="socials">
                            <a href=""><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="img/team-3.jpg" alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Rebeca Bertolino</h3>
                        <p class="card-text">Rebeca ficou encarregada do banco de dados MySQL no projeto acadêmico, onde foi responsável por organizar e gerenciar as informações essenciais da aplicação. Ela criou estruturas eficientes para armazenamento de dados, garantindo que o sistema pudesse acessar informações com rapidez e precisão.</p>
                        <p class="socials">
                            <a href=""><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="img/team-4.jpg" alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Rhyan Vieira</h3>
                        <p class="card-text">Rhyan trabalhou na implementação da lógica do servidor em PHP, integrando o banco de dados ao front-end para que todas as funcionalidades operassem de forma coesa. Ele foi responsável por tornar a aplicação robusta e funcional, assegurando que o projeto fosse executado de forma ágil e segura.</p>
                        <p class="socials">
                            <a href=""><i class="bi bi-twitter text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-facebook text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-linkedin text-dark mx-1"></i></a>
                            <a href=""><i class="bi bi-instagram text-dark mx-1"></i></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<hr class="custom-line">

<section id="contact" class="contact section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>Venha Conosco!</h2>
                    <p>Faça parte dessa evolução na Gestão Escolar.<br>Estamos buscando instituições que desejam otimizar sua gestão!</p>
                </div>
            </div>
        </div>

        <?= funcoes::mensagem() ?>

        <div class="row m-0">
            <div class="col-md-12 p-0 pt-4 pb-4">
                <form action="contatoEmail.php" class="p-4 m-auto form-contato" method="post" id="contactForm" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="form-control" name="nome-instituicao" id="nome-instituicao" placeholder="Nome da Instituição" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="form-control" name="email" id="email" placeholder="E-mail" type="email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <input class="form-control" name="assunto" id="assunto" placeholder="Assunto" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <textarea class="form-control " name="mensagem" id="mensagem" placeholder="Escreva sua mensagem" required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="enviar-button">Enviar Agora</button>
                    </div>
                </form>
            </div>
        </div>
</section>

<script src="assets/ckeditor5/ckeditor5-build-classic/ckeditor.js"></script>

<script type="text/javascript">
    ClassicEditor
        .create(document.querySelector('#mensagem'))
        .catch(error => {
            console.error(error);
        });
</script>