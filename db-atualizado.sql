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


select * from aluno;
select * from mensalidade;

