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

CREATE TABLE disciplina (
    id_disciplina INT AUTO_INCREMENT NOT NULL,
    disciplina VARCHAR(45) NOT NULL,
    carga_horaria DECIMAL(5 , 2) NOT NULL,
    id_curso INT NOT NULL,
    PRIMARY KEY (id_disciplina),
    CONSTRAINT fk2_curso FOREIGN KEY (id_curso)
        REFERENCES curso (id_curso)
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



