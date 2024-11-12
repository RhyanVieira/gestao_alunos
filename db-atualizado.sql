CREATE DATABASE gestao_escolar;

CREATE TABLE aluno (
    id_aluno INT AUTO_INCREMENT NOT NULL,
    nome_completo VARCHAR(75) NOT NULL,
    data_nascimento DATE NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    cidade VARCHAR(40) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    logradouro VARCHAR(75) NOT NULL,
    numero VARCHAR(5) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(250) NOT NULL,
    statusRegistro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo',
    data_matricula TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_aluno),
	UNIQUE INDEX email_UNIQUE (email ASC) VISIBLE
) ENGINE = InnoDB;

CREATE TABLE professor(
    id_professor INT AUTO_INCREMENT NOT NULL,
    nome_completo VARCHAR(75) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    cidade VARCHAR(40) NOT NULL,
    estado VARCHAR(20) NOT NULL,
    cep VARCHAR(9) NOT NULL,
    logradouro VARCHAR(75) NOT NULL,
    numero VARCHAR(5) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    salario DECIMAL(10 , 2) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(250) NOT NULL,
    statusRegistro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo',
    PRIMARY KEY (id_professor),
    UNIQUE INDEX email_UNIQUE (email ASC) VISIBLE
) ENGINE = InnoDB;

CREATE TABLE curso (
    id_curso INT AUTO_INCREMENT NOT NULL,
    curso VARCHAR(50) NOT NULL,
    descricao LONGTEXT,
    duracao_curso INT NOT NULL,
    valor_curso DECIMAL(10 , 2) NOT NULL,
    status_registro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo',
    PRIMARY KEY (id_curso)
) ENGINE = InnoDB;



CREATE TABLE administrador (
    id_administrador INT AUTO_INCREMENT NOT NULL,
    nome_completo VARCHAR(75) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
	telefone VARCHAR(11) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(250) NOT NULL,
    statusRegistro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo',
    nivel INT NOT NULL DEFAULT '1' COMMENT '1=Administrador do Sistema;2=Coordenador Acadêmico,3=Secretário',
    PRIMARY KEY (id_administrador),
    UNIQUE INDEX email_UNIQUE (email ASC) VISIBLE
) ENGINE = InnoDB;

CREATE TABLE turma (
    id_turma INT NOT NULL AUTO_INCREMENT,
    ano_semestre VARCHAR(7) NOT NULL,
    nome_turma VARCHAR(45) NOT NULL,
    id_curso INT NOT NULL,
    id_administrador INT NOT NULL,
    PRIMARY KEY (id_turma),
    CONSTRAINT fk1_curso_ FOREIGN KEY (id_curso)
        REFERENCES curso (id_curso),
    CONSTRAINT fk1_administrador FOREIGN KEY (id_administrador)
        REFERENCES administrador (id_administrador)
) ENGINE = InnoDB;

CREATE TABLE mensalidade (
    id_mensalidade INT NOT NULL AUTO_INCREMENT,
    valor DECIMAL(10 , 2 ) NOT NULL,
    data_vencimento DATE NOT NULL,
    data_pagamento DATE,
    status_pagamento INT NOT NULL DEFAULT '2' COMMENT '1=Pago;2=Pendente',
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    PRIMARY KEY (id_mensalidade),
    CONSTRAINT fk1_aluno FOREIGN KEY (id_aluno)
        REFERENCES aluno (id_aluno),
    CONSTRAINT fk1_turma FOREIGN KEY (id_turma)
        REFERENCES turma (id_turma)
)  ENGINE=INNODB;

CREATE TABLE frequencia (
    id_frequencia INT NOT NULL AUTO_INCREMENT,
    data_presenca DATE NOT NULL,
    status_presenca INT NOT NULL COMMENT '1=Presente;2=Ausente',
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    PRIMARY KEY (id_frequencia),
    CONSTRAINT fk2_aluno FOREIGN KEY (id_aluno)
        REFERENCES aluno (id_aluno),
    CONSTRAINT fk2_turma FOREIGN KEY (id_turma)
        REFERENCES turma (id_turma)
) ENGINE = InnoDB;

CREATE TABLE disciplina (
    id_disciplina INT AUTO_INCREMENT NOT NULL,
    disciplina VARCHAR(45) NOT NULL,
    carga_horaria DECIMAL(5 , 2) NOT NULL,
    id_curso INT NOT NULL,
    PRIMARY KEY (id_disciplina),
    CONSTRAINT fk2_curso FOREIGN KEY (id_curso)
        REFERENCES curso (id_curso)
) ENGINE = InnoDB;

CREATE TABLE nota (
    id_nota INT NOT NULL AUTO_INCREMENT,
    nota DECIMAL(3 , 1) NOT NULL,
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    id_disciplina INT NOT NULL,
    PRIMARY KEY (id_nota),
    CONSTRAINT fk3_aluno FOREIGN KEY (id_aluno)
        REFERENCES aluno (id_aluno),
    CONSTRAINT fk3_turma FOREIGN KEY (id_turma)
        REFERENCES turma (id_turma),
    CONSTRAINT fk1_disciplina FOREIGN KEY (id_disciplina)
        REFERENCES disciplina (id_disciplina)
) ENGINE = InnoDB;

CREATE TABLE professor_disciplina (
    id_professor_disciplina INT NOT NULL AUTO_INCREMENT,
    id_professor INT NOT NULL,
    id_disciplina INT NOT NULL,
    PRIMARY KEY(id_professor_disciplina),
    CONSTRAINT fk1_professor FOREIGN KEY (id_professor)
        REFERENCES professor (id_professor),
    CONSTRAINT fk2_disciplina FOREIGN KEY (id_disciplina)
        REFERENCES disciplina (id_disciplina)
) ENGINE = InnoDB;

CREATE TABLE matricula (
    id_matricula INT AUTO_INCREMENT NOT NULL,
    data_matricula TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status_matricula INT NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo;3=Trancado;4=Cancelado;5=Aguardando Pagamento;6=Pendente de Documentação;7=Egresso',
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    PRIMARY KEY (id_matricula),
    CONSTRAINT fk4_aluno FOREIGN KEY (id_aluno)
        REFERENCES aluno (id_aluno),
    CONSTRAINT fk4_turma FOREIGN KEY (id_turma)
        REFERENCES turma (id_turma)
) ENGINE = InnoDB;

CREATE TABLE sobre_nos (
    id_sobre_nos INT AUTO_INCREMENT NOT NULL,
    icone_bootstrap VARCHAR(30) NOT NULL,
    subtitulo VARCHAR(50) NOT NULL,
    texto TEXT NOT NULL,
    posicao INT NOT NULL DEFAULT '1',
    status_registro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo, 2=Inativo',
    PRIMARY KEY (id_sobre_nos)
) ENGINE = InnoDB;

CREATE TABLE servicos (
    id_servicos INT AUTO_INCREMENT NOT NULL,
    icone_bootstrap VARCHAR(30) NOT NULL,
    subtitulo VARCHAR(50) NOT NULL,
    texto TEXT NOT NULL,
    texto_card TEXT NOT NULL,
    posicao INT NOT NULL DEFAULT '1',
    status_registro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo, 2=Inativo',
    PRIMARY KEY (id_servicos)
) ENGINE = InnoDB;

CREATE TABLE propostas (
    id_propostas INT AUTO_INCREMENT NOT NULL,
    icone_bootstrap VARCHAR(30) NOT NULL,
    subtitulo VARCHAR(50) NOT NULL,
    texto TEXT NOT NULL,
    texto_card TEXT NOT NULL,
    posicao INT NOT NULL DEFAULT '1',
    imagem VARCHAR(200) NOT NULL,
    status_registro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo, 2=Inativo',
    PRIMARY KEY (id_propostas)
) ENGINE = InnoDB;

CREATE TABLE noticias (
    id_noticias INT AUTO_INCREMENT NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    texto TEXT NOT NULL,
    texto_card TEXT NOT NULL,
	data_postagem TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    imagem VARCHAR(200) NOT NULL,
    status_registro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo, 2=Inativo',
    PRIMARY KEY (id_noticias)
) ENGINE = InnoDB;

CREATE TABLE administrador_pagina (
	id_administrador_pagina INT AUTO_INCREMENT NOT NULL,
    nome VARCHAR(75) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(250) NOT NULL,
    statusRegistro INT NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo',
    PRIMARY KEY (id_administrador_pagina),
    UNIQUE INDEX email_UNIQUE (email ASC) VISIBLE
) ENGINE = InnoDB;


INSERT INTO propostas (icone_bootstrap, subtitulo, texto, posicao, imagem, status_registro) 
VALUES
('bi bi-speedometer2', 'Painel Administrativo Completo', '<p>Tenha controle total sobre todas as operações acadêmicas da sua instituição com o nosso Painel Administrativo. Em uma única plataforma, você pode gerenciar turmas, professores, alunos e muito mais, de forma prática e intuitiva. O painel oferece uma visão clara e consolidada de todas as informações, permitindo que você organize o calendário acadêmico, controle frequência e gerencie notas dos alunos de maneira eficiente e sem complicação.
        </p>
        <p>Nosso sistema foi desenvolvido para otimizar a administração escolar, tornando processos como o lançamento de notas, o controle de presença e a comunicação com os responsáveis mais rápidos e sem erros. O objetivo é proporcionar uma gestão fluida, onde as informações estão sempre ao alcance de um clique, sem sobrecarregar a equipe administrativa.
        </p>', 1, '', 1),
('bi bi-graph-up', 'Monitoramento de Desempenho Escolar', '<p>Facilite o acompanhamento do desempenho escolar de cada aluno com nossa plataforma de monitoramento avançado. A SmartClass permite que você registre e acompanhe notas e feedbacks personalizados, proporcionando um panorama completo do progresso de cada estudante. Relatórios detalhados de desempenho podem ser gerados e compartilhados com pais e responsáveis, permitindo uma comunicação eficaz sobre o desempenho acadêmico de seus filhos.
        </p>
        <p>Acompanhamentos periódicos são facilitados através de gráficos interativos e comparações de dados ao longo do ano letivo, oferecendo insights valiosos para professores e gestores. Nossa plataforma permite que a gestão de desempenho seja precisa, objetiva e fácil de entender, ajudando a promover uma educação mais personalizada e de qualidade.
        </p>', 2, '', 1),
('bi bi-cash-stack', 'Gestão Financeira Eficiente', '<p>Com a Gestão Financeira Eficiente da SmartClass, a administração das finanças da sua instituição torna-se mais simples e organizada. A plataforma permite o controle de mensalidades, emissão de boletos e acompanhamento do histórico de pagamentos e inadimplência de forma automática, garantindo uma visão clara da saúde financeira da sua instituição.
        </p>
        <p>Além disso, com nossos relatórios financeiros detalhados, você pode visualizar facilmente o fluxo de caixa e analisar a performance financeira ao longo do tempo. A SmartClass proporciona mais controle e agilidade, permitindo que você tome decisões financeiras mais informadas e seguras, com menos esforço administrativo.
        </p>
    </div>', 3, '', 1);


INSERT INTO servicos (icone_bootstrap, subtitulo, texto, texto_card, posicao, status_registro) 
VALUES
('bi bi-laptop', 'Captação Eficiente de Alunos', '<p>A captação de alunos nunca foi tão fácil e eficaz. Com a plataforma SmartClass, você tem acesso a um conjunto completo de ferramentas de automação e segmentação que tornam a atração de novos alunos mais estratégica e assertiva. 
            Utilizamos tecnologia de ponta para identificar o perfil ideal do estudante, segmentando campanhas publicitárias de acordo com comportamentos e interesses específicos.
        </p>
        <p>A automação das campanhas permite que você alcance os potenciais alunos de forma personalizada, com mensagens ajustadas aos seus interesses, tudo isso sem sobrecarregar sua equipe. Nossa plataforma otimiza as campanhas em tempo real, 
            ajustando os anúncios conforme os dados coletados, aumentando a taxa de conversão e reduzindo significativamente os custos de captação. 
            Isso garante que você tenha um fluxo constante de novos alunos com um retorno sobre investimento (ROI) cada vez maior.
        </p>', 'Nossa plataforma permite uma captação simplificada e eficiente de novos alunos. 
                                    Com ferramentas de automação, segmentação e personalização, atraímos o público certo e otimizamos 
                                    os esforços para alcançar quem realmente se interessa pela sua instituição, reduzindo custos e melhorando os resultados de cada campanha.', 1, 1),
('bi bi-intersect', 'Gestão Integrada e Inteligente', '<p>Gerenciar a vida acadêmica dos alunos não precisa ser um desafio. A SmartClass oferece uma solução completa e integrada para o gerenciamento acadêmico, com uma plataforma centralizada que simplifica a administração e melhora a eficiência. 
            Com ela, sua instituição pode acompanhar todas as etapas da jornada do aluno, desde a matrícula até a conclusão do curso.
        </p>
        <p>Nosso sistema de gestão inclui o controle de matrículas, onde você pode facilmente verificar o status de cada inscrição e gerenciar dados de forma segura e organizada. 
            Além disso, oferece funcionalidades de acompanhamento de desempenho acadêmico, permitindo que você acesse relatórios detalhados sobre notas, frequência e progresso de cada estudante, com dados em tempo real.
        </p>
        <p>Para otimizar a gestão administrativa, nossa plataforma também gera relatórios customizados, que oferecem uma visão clara e detalhada do desempenho de cada área da instituição. Isso facilita a tomada de decisões estratégicas, melhorando o planejamento e o acompanhamento das metas institucionais. 
            Nossa solução promove a agilidade e a praticidade no dia a dia da sua equipe, permitindo que mais tempo seja dedicado ao que realmente importa: o sucesso dos seus alunos.
        </p>', 'Organize, gerencie e acompanhe o histórico dos alunos em uma plataforma centralizada. 
                                Com funcionalidades para controle de matrículas, acompanhamento de desempenho e geração de relatórios 
                                detalhados, ajudamos a garantir uma experiência de gestão eficiente e completa, trazendo praticidade e agilidade para o dia a dia.', 2, 1),
('bi bi-person-check', 'Comunicação e Fidelização', '<p>A comunicação eficaz com os alunos e seus responsáveis é essencial para construir um relacionamento sólido e aumentar a satisfação. A SmartClass oferece ferramentas poderosas de comunicação que permitem um fluxo contínuo de informações, mantendo todos sempre informados e engajados.
        </p>
        <p>Com a nossa plataforma, você pode enviar notificações personalizadas, mensagens em tempo real e alertas sobre prazos importantes, eventos, resultados acadêmicos e muito mais. 
            O envio de comunicados se torna mais ágil e direcionado, pois as mensagens podem ser segmentadas para grupos específicos de alunos, com base em suas necessidades ou interesses. Isso garante uma comunicação mais relevante e eficaz.
        </p>
        <p>Além disso, a plataforma possibilita a criação de canais de comunicação exclusivos para alunos e responsáveis, tornando o relacionamento mais próximo e acessível. 
            Através desses canais, sua instituição pode fidelizar os alunos, promovendo uma jornada educacional mais satisfatória e personalizada, o que resulta em maior retenção e no fortalecimento da imagem da instituição. Com a SmartClass, você não apenas mantém seus alunos informados, mas também os motiva a continuar a sua trajetória educacional, criando um ciclo contínuo de sucesso.
        </p>', 'Aumente a satisfação e retenção dos alunos com comunicação personalizada e eficiente. 
                                Nossa plataforma possibilita o envio de notificações, atualizações e mensagens em tempo real, 
                                mantendo alunos e responsáveis informados e engajados. Fidelize alunos e garanta uma jornada satisfatória do início ao fim.', 3, 1),
('bi bi-person-check', 'Resumo dos Benefícios SmartClass', '<ul>
            <li class="mb-2"><strong class="subtitulo-item">Automação de Marketing: </strong><span>Captação de alunos mais eficaz e sem desperdício de recursos.</span></li>
            <li class="mb-2"><strong class="subtitulo-item">Personalização da Comunicação: </strong><span>Mensagens adaptadas ao perfil de cada aluno, aumentando a retenção e satisfação.</span></li>
            <li class="mb-2"><strong class="subtitulo-item">Gestão Centralizada e Eficiente: </strong><span>Relatórios completos e funcionalidades para um gerenciamento ágil.</span></li>
            <li class="mb-2"><strong class="subtitulo-item">Acompanhamento em Tempo Real: </strong><span> Análise do desempenho de alunos, ajudando na tomada de decisões estratégicas.</span></li>
            <li class="mb-2"><strong class="subtitulo-item">Fidelização e Satisfação: </strong><span>Manutenção de um relacionamento contínuo e de confiança com alunos e responsáveis.</span></li>
        </ul>', 'vazio', 4, 1);

INSERT INTO sobre_nos (icone_bootstrap, subtitulo, texto, posicao, status_registro) 
VALUES
('bi bi-bullseye','Nossa Missão', '<p>Nossa missão é simplificar e otimizar todo o processo de captação e gestão de alunos, utilizando tecnologia de ponta para criar um sistema ágil, integrado e que atenda às necessidades específicas de cada instituição. Acreditamos que a educação é o alicerce para um futuro melhor, e nosso compromisso é ajudar as instituições de ensino a alcançar seu potencial máximo, garantindo uma gestão eficaz e um aumento contínuo no número de alunos matriculados.</p>', 1, 1),
('bi bi-gear','O que fazemos', '<p>Oferecemos uma plataforma completa para captação e gestão de alunos, que inclui desde ferramentas para atrair novos estudantes até soluções para acompanhar o progresso e a retenção dos mesmos. Nosso sistema é projetado para simplificar o processo de inscrição, facilitar o acompanhamento acadêmico e financeiro e melhorar a comunicação entre a instituição e seus alunos.</p><p>Além disso, nossa equipe de especialistas trabalha ao lado das instituições, oferecendo consultoria e estratégias personalizadas para garantir que seus objetivos educacionais e financeiros sejam alcançados. Nossa solução se adapta às necessidades de cada cliente, seja uma escola de ensino básico, uma universidade ou uma instituição de cursos técnicos e profissionalizantes.</p>', 2, 1),
('bi bi-lightbulb','Por que escolher a SmartClass?', '<ul>
            <li class="mb-2"><strong class="subtitulo-item">Tecnologia de Ponta: </strong><span>Usamos as ferramentas mais avançadas para garantir que o processo de captação e gestão de alunos seja eficiente, seguro e de fácil acesso.</span></li>
            <li class="mb-2"><strong class="subtitulo-item">Solulções Personalizadas: </strong><span>Entendemos que cada instituição tem suas próprias necessidades. Por isso, oferecemos soluções personalizadas, adaptando nossos serviços à realidade de cada cliente.</span></li>
            <li class="mb-2"><strong class="subtitulo-item">Equipe Especializada: </strong><span>Contamos com um time altamente capacitado, com vasta experiência no setor educacional, para fornecer o melhor suporte e orientação.</span></li>
        </ul>', 3, 1),
('bi bi-file-text','Nosso Compromisso', '<p>Na SmartClass, temos um compromisso constante com a excelência e inovação, buscando sempre melhorar nossos serviços para atender melhor às necessidades de nossos clientes. Estamos aqui para ser seu parceiro de confiança, ajudando sua instituição a crescer e a impactar positivamente o futuro de seus alunos.</p>', 4, 1);

INSERT INTO 

INSERT INTO aluno (nome_completo, data_nascimento, cpf, cidade, estado, cep, logradouro, numero, telefone, email, senha, statusRegistro)
VALUES 
('João Silva', '1995-05-10', '123.456.789-00', 'São Paulo', 'SP', '01010-010', 'Rua A', '100', '11999999999', 'joao@gmail.com', 'senha123', 1),
('Maria Oliveira', '1998-11-20', '987.654.321-00', 'Rio de Janeiro', 'RJ', '20020-020', 'Avenida B', '200', '21999999999', 'maria@gmail.com', 'senha123', 1),
('Carlos Pereira', '2000-08-15', '321.654.987-00', 'Belo Horizonte', 'MG', '30130-030', 'Rua C', '300', '31999999999', 'carlos@gmail.com', 'senha123', 1),
('Fernanda Santos', '2001-07-25', '444.555.666-77', 'Curitiba', 'PR', '80040-040', 'Rua D', '400', '41988887777', 'fernanda@gmail.com', 'senha123', 1),
('Bruna Costa', '1999-12-15', '222.333.444-55', 'Fortaleza', 'CE', '60030-030', 'Avenida E', '500', '85977776666', 'bruna@gmail.com', 'senha123', 1),
('Lucas Almeida', '2002-04-10', '666.777.888-99', 'Porto Alegre', 'RS', '90010-010', 'Rua F', '600', '51988887777', 'lucas@gmail.com', 'senha123', 1),
('Ana Souza', '1997-05-22', '123.123.123-12', 'Recife', 'PE', '50050-050', 'Avenida G', '700', '81999999999', 'ana.souza@gmail.com', 'senha123', 1),
('Pedro Silva', '2001-09-30', '555.666.777-88', 'Salvador', 'BA', '40010-010', 'Rua H', '800', '71988887777', 'pedro.silva@gmail.com', 'senha123', 1),
('Carla Lima', '2000-01-13', '111.222.333-44', 'Maceió', 'AL', '57010-010', 'Rua I', '900', '82799999999', 'carla.lima@gmail.com', 'senha123', 1),
('Eduardo Rocha', '1996-02-28', '999.888.777-66', 'São Luís', 'MA', '65010-010', 'Avenida J', '1000', '98799999999', 'eduardo@gmail.com', 'senha123', 1);

INSERT INTO professor (nome_completo, cpf, cidade, estado, cep, logradouro, numero, telefone, salario, email, senha, statusRegistro)
VALUES 
('Ana Souza', '111.222.333-44', 'Curitiba', 'PR', '80010-010', 'Rua D', '400', '41999999999', 3000.00, 'ana.souza@gmail.com', 'senha123', 1),
('Pedro Santos', '555.666.777-88', 'Fortaleza', 'CE', '60020-020', 'Avenida E', '500', '85999999999', 2500.00, 'pedro.santos@gmail.com', 'senha123', 1),
('Lucas Almeida', '333.444.555-66', 'São Paulo', 'SP', '01020-020', 'Rua F', '600', '11988887777', 3500.00, 'lucas.almeida@gmail.com', 'senha123', 1),
('Carla Lima', '444.555.666-77', 'Belo Horizonte', 'MG', '30120-020', 'Rua G', '700', '31988887777', 3200.00, 'carla.lima@gmail.com', 'senha123', 1),
('Felipe Souza', '555.666.777-88', 'Porto Alegre', 'RS', '90020-020', 'Avenida H', '800', '51999999999', 2800.00, 'felipe.souza@gmail.com', 'senha123', 1),
('Roberta Costa', '666.777.888-99', 'Recife', 'PE', '50030-030', 'Rua I', '900', '81999999999', 2700.00, 'roberta.costa@gmail.com', 'senha123', 1),
('Marcos Pereira', '777.888.999-00', 'Salvador', 'BA', '40020-020', 'Avenida J', '1000', '71999999999', 3000.00, 'marcos.pereira@gmail.com', 'senha123', 1),
('Sandra Oliveira', '888.999.000-11', 'Maceió', 'AL', '57020-020', 'Rua K', '1100', '82799999999', 2600.00, 'sandra.oliveira@gmail.com', 'senha123', 1),
('Juliana Rocha', '999.000.111-22', 'São Luís', 'MA', '65020-020', 'Avenida L', '1200', '98799999999', 2900.00, 'juliana.rocha@gmail.com', 'senha123', 1),
('Eduardo Martins', '111.222.333-44', 'Rio de Janeiro', 'RJ', '20030-030', 'Rua M', '1300', '21999999999', 3300.00, 'eduardo.martins@gmail.com', 'senha123', 1);

 INSERT INTO curso (curso, descricao, duracao_curso, valor_curso)
VALUES 
('Engenharia de Software', 'Curso de graduação em Engenharia de Software', 60, 5000.00),
('Medicina', 'Curso de graduação em Medicina', 72, 15000.00),
('Design Gráfico', 'Curso de graduação em Design Gráfico', 48, 3000.00),
('Direito', 'Curso de graduação em Direito', 60, 7000.00),
('Arquitetura', 'Curso de graduação em Arquitetura', 60, 8000.00),
('Ciência da Computação', 'Curso de graduação em Ciência da Computação', 60, 5500.00),
('Pedagogia', 'Curso de graduação em Pedagogia', 48, 2500.00),
('Fisioterapia', 'Curso de graduação em Fisioterapia', 72, 10000.00),
('Psicologia', 'Curso de graduação em Psicologia', 60, 6500.00),
('Administração', 'Curso de graduação em Administração', 48, 4000.00);

INSERT INTO administrador (nome_completo, cpf, telefone, email, senha, statusRegistro, nivel)
VALUES 
('Lucas Almeida', '123.321.123-45', '11988887777', 'lucas.almeida@gmail.com', 'senha123', 1, 1),
('Carla Lima', '987.654.321-00', '11977776666', 'carla.lima@gmail.com', 'senha123', 1, 2),
('Roberto Silva', '123.456.789-00', '11966665555', 'roberto.silva@gmail.com', 'senha123', 1, 1),
('Mariana Costa', '987.654.321-11', '11955554444', 'mariana.costa@gmail.com', 'senha123', 1, 3),
('Felipe Souza', '123.321.123-22', '11944443333', 'felipe.souza@gmail.com', 'senha123', 1, 2),
('Juliana Rocha', '987.654.321-33', '11933332222', 'juliana.rocha@gmail.com', 'senha123', 1, 3),
('Eduardo Lima', '123.321.123-44', '11922221111', 'eduardo.lima@gmail.com', 'senha123', 1, 1),
('Sandra Oliveira', '987.654.321-55', '11911110000', 'sandra.oliveira@gmail.com', 'senha123', 1, 2),
('Ricardo Pereira', '123.321.123-66', '11900009999', 'ricardo.pereira@gmail.com', 'senha123', 1, 3),
('Marcos Costa', '987.654.321-77', '11888887777', 'marcos.costa@gmail.com', 'senha123', 1, 1);

INSERT INTO turma (ano_semestre, nome_turma, id_curso, id_administrador)
VALUES 
('2024-1', 'Turma A', 1, 17),
('2024-1', 'Turma B', 2, 20),
('2024-1', 'Turma C', 3, 20),
('2024-1', 'Turma D', 4, 20),
('2024-2', 'Turma E', 5, 17),
('2024-2', 'Turma F', 6, 17),
('2024-2', 'Turma G', 7, 20),
('2024-2', 'Turma H', 8, 17),
('2024-1', 'Turma I', 9, 17),
('2024-2', 'Turma J', 10, 17);

INSERT INTO mensalidade (valor, data_vencimento, id_aluno, id_turma)
VALUES 
(1000.00, '2024-12-10', 1, 11),
(1500.00, '2024-12-10', 2, 12),
(1200.00, '2024-12-10', 3, 13),
(2000.00, '2024-12-10', 4, 14),
(1300.00, '2024-12-10', 5, 15),
(1500.00, '2024-12-10', 6, 16),
(1400.00, '2024-12-10', 7, 17),
(1600.00, '2024-12-10', 8, 18),
(1800.00, '2024-12-10', 9, 19),
(1700.00, '2024-12-10', 10, 20);

INSERT INTO disciplina (disciplina, carga_horaria, id_curso)
VALUES 
('Matemática', 60, 1),
('Física', 60, 1),
('Anatomia', 80, 2),
('Biologia', 50, 3),
('Química', 60, 4),
('Linguística', 40, 5),
('Cálculo', 60, 6),
('História', 40, 7),
('Psicologia', 60, 8),
('Administração', 80, 9);

INSERT INTO nota (nota, id_aluno, id_turma, id_disciplina)
VALUES 
(8.5, 1, 11, 1),
(7.2, 2, 12, 2),
(9.0, 3, 13, 3),
(6.5, 4, 14, 4),
(7.8, 5, 15, 5),
(8.0, 6, 16, 6),
(9.5, 7, 17, 7),
(7.0, 8, 18, 8),
(6.0, 9, 19, 9),
(8.7, 10, 20, 10);

INSERT INTO professor_disciplina (id_professor, id_disciplina)
VALUES 
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO matricula (status_matricula, id_aluno, id_turma)
VALUES 
(1, 1, 11),
(1, 2, 12),
(1, 3, 13),
(1, 4, 14),
(1, 5, 15),
(1, 6, 16),
(1, 7, 17),
(1, 8, 18),
(1, 9, 19),
(1, 10, 20);

INSERT INTO aluno (nome_completo, data_nascimento, cpf, cidade, estado, cep, logradouro, numero, telefone, email, senha, statusRegistro, data_matricula)
VALUES 
('João Silva', '2000-01-15', '123.456.789-00', 'São Paulo', 'SP', '01010-000', 'Rua A', '123', '11987654321', 'joao.silva@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Maria Oliveira', '1998-03-20', '234.567.890-11', 'Rio de Janeiro', 'RJ', '20020-111', 'Rua B', '456', '21987654322', 'maria.oliveira@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Carlos Pereira', '2001-07-30', '345.678.901-22', 'Belo Horizonte', 'MG', '30130-222', 'Rua C', '789', '31987654323', 'carlos.pereira@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Ana Costa', '1999-11-12', '456.789.012-33', 'Fortaleza', 'CE', '60060-333', 'Rua D', '101', '85987654324', 'ana.costa@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Pedro Santos', '2002-06-05', '567.890.123-44', 'Salvador', 'BA', '40040-444', 'Rua E', '202', '71987654325', 'pedro.santos@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Juliana Rocha', '2000-12-25', '678.901.234-55', 'Curitiba', 'PR', '80080-555', 'Rua F', '303', '41987654326', 'juliana.rocha@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Ricardo Almeida', '1997-09-10', '789.012.345-66', 'Manaus', 'AM', '69070-666', 'Rua G', '404', '92987654327', 'ricardo.almeida@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Fernanda Lima', '2001-04-17', '890.123.456-77', 'Recife', 'PE', '50050-777', 'Rua H', '505', '81987654328', 'fernanda.lima@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Marcos Pereira', '1996-05-22', '901.234.567-88', 'Porto Alegre', 'RS', '90090-888', 'Rua I', '606', '51987654329', 'marcos.pereira@example.com', 'senha123', 1, CURRENT_TIMESTAMP),
('Larissa Martins', '1998-08-10', '012.345.678-99', 'Florianópolis', 'SC', '88080-999', 'Rua J', '707', '48987654330', 'larissa.martins@example.com', 'senha123', 1, CURRENT_TIMESTAMP);

UPDATE aluno
SET estado = 'São Paulo' WHERE id_aluno = 1 AND estado = 'SP';

UPDATE aluno
SET estado = 'Rio de Janeiro' WHERE id_aluno = 2 AND estado = 'RJ';

UPDATE aluno
SET estado = 'Minas Gerais' WHERE id_aluno = 3 AND estado = 'MG';

UPDATE aluno
SET estado = 'Paraná' WHERE id_aluno = 4 AND estado = 'PR';

UPDATE aluno
SET estado = 'Ceará' WHERE id_aluno = 5 AND estado = 'CE';

UPDATE aluno
SET estado = 'Rio Grande do Sul' WHERE id_aluno = 6 AND estado = 'RS';

UPDATE aluno
SET estado = 'Pernambuco' WHERE id_aluno = 7 AND estado = 'PE';

UPDATE aluno
SET estado = 'Bahia' WHERE id_aluno = 8 AND estado = 'BA';

UPDATE aluno
SET estado = 'Alagoas' WHERE id_aluno = 9 AND estado = 'AL';

UPDATE aluno
SET estado = 'Maranhão' WHERE id_aluno = 10 AND estado = 'MA';

UPDATE aluno
SET estado = 'São Paulo' WHERE id_aluno = 11 AND estado = 'SP';

UPDATE aluno
SET estado = 'Rio de Janeiro' WHERE id_aluno = 12 AND estado = 'RJ';

UPDATE aluno
SET estado = 'Minas Gerais' WHERE id_aluno = 13 AND estado = 'MG';

UPDATE aluno
SET estado = 'Ceará' WHERE id_aluno = 14 AND estado = 'CE';

UPDATE aluno
SET estado = 'Bahia' WHERE id_aluno = 15 AND estado = 'BA';

UPDATE aluno
SET estado = 'Paraná' WHERE id_aluno = 16 AND estado = 'PR';

UPDATE aluno
SET estado = 'Amazonas' WHERE id_aluno = 17 AND estado = 'AM';

UPDATE aluno
SET estado = 'Pernambuco' WHERE id_aluno = 18 AND estado = 'PE';

UPDATE aluno
SET estado = 'Rio Grande do Sul' WHERE id_aluno = 19 AND estado = 'RS';

UPDATE aluno
SET estado = 'Santa Catarina' WHERE id_aluno = 20 AND estado = 'SC';

UPDATE professor
SET estado = 'Paraná'
WHERE id_professor = 1;

UPDATE professor
SET estado = 'Ceará'
WHERE id_professor = 2;

UPDATE professor
SET estado = 'São Paulo'
WHERE id_professor = 3;

UPDATE professor
SET estado = 'Minas Gerais'
WHERE id_professor = 4;

UPDATE professor
SET estado = 'Rio Grande do Sul'
WHERE id_professor = 5;

UPDATE professor
SET estado = 'Pernambuco'
WHERE id_professor = 6;

UPDATE professor
SET estado = 'Bahia'
WHERE id_professor = 7;

UPDATE professor
SET estado = 'Alagoas'
WHERE id_professor = 8;

UPDATE professor
SET estado = 'Maranhão'
WHERE id_professor = 9;

UPDATE professor
SET estado = 'Rio de Janeiro'
WHERE id_professor = 10;


select * from matricula;
select * from mensalidade;
select * from aluno;
select * from professor;
select * from curso;
select * from turma;
select * from administrador_pagina;
select * from propostas;
SELECT * FROM sobre_nos ORDER BY id_sobre_nos;
$2y$10$hFn36gtnrB3sBXQN6d5RceUTcZMjxs2poK1k8T1cEPAttsdP/W7LK
$2y$10$hFn36gtnrB3sBXQN6d5RceUTcZMjxs2poK1k8T1cEPAttsdP/W7LK
$2y$10$fKqqjzn4QlUqjcfAgY2CTOFBRhf61ZN8pOnnxEjR364bMa9V.QmXS


