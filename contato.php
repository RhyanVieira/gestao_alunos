<div class="container text-center header-pages">
    <h1>Nossos Contatos</h1>
</div>


<section class="container mt-5 mb-5 contato">

    <?= funcoes::mensagem() ?>

    <h4 class="line-under mb-4 ">Informações de contato</h4>
    <p class="mb-4">Estamos prontos para ajudar sua instituição a crescer! Entre em contato para saber mais sobre nossas soluções em captação e gestão de alunos.
        Nossa equipe especializada está à disposição para responder suas perguntas, oferecer suporte e desenvolver uma estratégia personalizada para o sucesso da sua instituição.
    </p>
    <div class="row mb-5">
        <div class="col-12 col-md-12 col-lg-4 mb-3">
            <div class="contact-info">
                <i class="bi bi-geo-alt"></i>
                <p>Praça Aninna Bisegna, 40 - Centro<br>Muriaé - MG, 36888-000</p>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 mb-3">
            <div class="contact-info">
                <i class="bi bi-telephone"></i>
                <p>+55 (32) 99999-999<br>+55 (32) 3721-1111</p>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-4 mb-3">
            <div class="contact-info">
                <i class="bi bi-envelope"></i>
                <p>contato@smartclass.com<br> smartclass.com.br</p>
            </div>
        </div>
    </div>

    <h4 class="line-under mb-4">Onde estamos localizados</h4>
    <div class="col-12">
        <iframe class="map-responsive mb-4" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.4959657227805!2d-42.37084592388082!3d-21.13265188054282!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xbcc643c97a58d3%3A0x42632f00368c8ae3!2sPra%C3%A7a%20Irm%C3%A3%20Annina%20Bisegna%2C%2010-94%20-%20Muria%C3%A9%2C%20MG%2C%2036880-000!5e0!3m2!1spt-BR!2sbr!4v1731175424735!5m2!1spt-BR!2sbr" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <h4 class="line-under mt-4">Envie-nos uma mensagem</h4>
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
        .catch( error => {
            console.error(error);
        });

</script>