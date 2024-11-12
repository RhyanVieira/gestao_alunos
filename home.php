<?php

require_once "lib/Database.php";
require_once "lib/funcoes.php";

$db = new Database();

$servicos = $db->dbSelect("SELECT * FROM servicos WHERE status_registro = 1 ORDER BY posicao LIMIT 3");
$propostas = $db->dbSelect("SELECT * FROM propostas WHERE status_registro = 1 ORDER BY posicao LIMIT 3");

?>


<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="sample_0.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Estratégias Inovadoras para Aumentar a Captação de Alunos</h5>
                <p>Como ajudamos instituições a superar desafios.</p>
                <p><a href="index.php?pagina=blog" class="page-button" type="button">Saiba Mais</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="sample_2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Experiência do Aluno</h5>
                <p>Melhorando a experiência do aluno com ferramentas de suporte digital</p>
                <p><a href="index.php?pagina=blog" class="page-button" type="button">Saiba Mais</a></p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="sample_1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Automação</h5>
                <p>Como a automação pode transformar a gestão acadêmica na sua instituição</p>
                <p><a href="index.php?pagina=blog" class="page-button" type="button">Saiba Mais</a></p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
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
            <?php foreach ($servicos as $aServicos): ?>
                <div class="col-12 col-md-12 col-lg-4">
                    <a href="index.php?pagina=servicos" class="card-link">
                        <div class="card text-white text-center pb-2">
                            <div class="card-body">
                                <i class="<?= $aServicos['icone_bootstrap']?>"></i>
                                <h3 class="card-title"><?= $aServicos['subtitulo']?></h3>
                                <p class="lead"><?= $aServicos['texto_card']?></p>
                            </div>
                        </div>
                    </a>
                </div>                
            <?php endforeach; ?>
            </div>
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
                    <br> desde a inscrição até a formação do aluno.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($propostas as $aPropostas): ?>
                <div class="col-12 col-md-12 col-lg-4 mb-2">
                    <div class="card text-light text-center bg-white pb-2 h-100">
                        <div class="card-body text-dark d-flex flex-column">
                            <div class="img-area mb-4">
                                <img src="uploads/propostas/<?= $aPropostas['imagem'] ?>" class="img-fluid" alt="">
                            </div>
                            <h3 class="card-title"><?= $aPropostas['subtitulo']?></h3>
                            <p class="lead"><?= $aPropostas['texto_card']?></p>
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
<!-- portfolio ends -->
<!-- team starts -->
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
<!-- team ends -->
<!-- Contact starts -->
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
        <div class="row m-0">
            <div class="col-md-12 p-0 pt-4 pb-4">
                <form action="#" class="p-4 m-auto form-contato">
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
                                <textarea class="form-control " name="mensagem" id="mensagem" cols="30" rows="9" placeholder="Escreva sua mensagem"></textarea>
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
        .catch( error => {
            console.error(error);
        });

</script>