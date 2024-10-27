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
    PRIMARY KEY (id_professor),
    UNIQUE INDEX email_UNIQUE (email ASC) VISIBLE
) ENGINE = InnoDB;

CREATE TABLE curso (
    id_curso INT AUTO_INCREMENT NOT NULL,
    curso VARCHAR(50) NOT NULL,
    descricao LONGTEXT,
    duracao_curso INT NOT NULL,
    valor_curso DECIMAL(10 , 2) NOT NULL,
    PRIMARY KEY (id_curso)
) ENGINE = InnoDB;

CREATE TABLE administrador (
    id_administrador INT AUTO_INCREMENT NOT NULL,
    nome_completo VARCHAR(75) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(250) NOT NULL,
    telefone VARCHAR(11) NOT NULL,
    nivel INT NOT NULL COMMENT '1=Administrador do Sistema;2=Coordenador Acadêmico,3=Secretário',
    PRIMARY KEY (id_administrador),
    UNIQUE INDEX email_UNIQUE (email ASC) VISIBLE
) ENGINE = InnoDB;

CREATE TABLE turma (
    id_turma INT NOT NULL AUTO_INCREMENT,
    ano_semestre VARCHAR(7) NOT NULL,
    nome_turma VARCHAR(45) NOT NULL,
    id_curso INT NOT NULL,
    id_professor INT NOT NULL,
    PRIMARY KEY (id_turma),
    CONSTRAINT fk1_curso_ FOREIGN KEY (id_curso)
        REFERENCES curso (id_curso),
    CONSTRAINT fk1_professor FOREIGN KEY (id_professor)
        REFERENCES professor (id_professor)
) ENGINE = InnoDB;

CREATE TABLE mensalidade (
	id_mensalidade INT NOT NULL AUTO_INCREMENT,
    valor DECIMAL(10 , 2) NOT NULL,
    data_vencimento DATE NOT NULL,
    data_pagamento DATE,
    status_pagamento INT NOT NULL DEFAULT '2' COMMENT '1=Pago;2=Pendente',
    id_aluno INT NOT NULL,
    PRIMARY KEY (id_mensalidade),
    CONSTRAINT fk1_aluno FOREIGN KEY (id_aluno)
        REFERENCES aluno (id_aluno)
) ENGINE = InnoDB;

CREATE TABLE frequencia (
    id_frequencia INT NOT NULL AUTO_INCREMENT,
    data_presenca DATE NOT NULL,
    status_presenca INT NOT NULL COMMENT '1=Presente;2=Ausente',
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    PRIMARY KEY (id_frequencia),
    CONSTRAINT fk2_aluno FOREIGN KEY (id_aluno)
        REFERENCES aluno (id_aluno),
    CONSTRAINT fk1_turma FOREIGN KEY (id_turma)
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
    CONSTRAINT fk2_turma FOREIGN KEY (id_turma)
        REFERENCES turma (id_turma),
    CONSTRAINT fk1_disciplina FOREIGN KEY (id_disciplina)
        REFERENCES disciplina (id_disciplina)
) ENGINE = InnoDB;

CREATE TABLE professor_disciplina (
    id_professor INT NOT NULL,
    id_disciplina INT NOT NULL,
    CONSTRAINT fk2_professor FOREIGN KEY (id_professor)
        REFERENCES professor (id_professor),
    CONSTRAINT fk2_disciplina FOREIGN KEY (id_disciplina)
        REFERENCES disciplina (id_disciplina)
) ENGINE = InnoDB;

CREATE TABLE matricula (
    id_matricula INT AUTO_INCREMENT NOT NULL,
    data_matricula TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status_matricula INT NOT NULL DEFAULT '1' COMMENT '1=Ativo;2=Inativo;3=Trancado;4=Cancelado;5=Aguardando Pagamento;6=Pendente de Documentação;7=Concluído;8=Egresso',
    id_aluno INT NOT NULL,
    id_turma INT NOT NULL,
    PRIMARY KEY (id_matricula),
    CONSTRAINT fk4_aluno FOREIGN KEY (id_aluno)
        REFERENCES aluno (id_aluno),
    CONSTRAINT fk3_turma FOREIGN KEY (id_turma)
        REFERENCES turma (id_turma)
) ENGINE = InnoDB;


    

    