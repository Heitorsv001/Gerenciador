 ##Conteudo do htaccess
 --
      RewriteEngine On
      RewriteBase /Gerenciador/mvc/
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

##Script do Banco de dados

CREATE TABLE professor (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE aluno (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100),
    foto VARCHAR(255) DEFAULT NULL
);


CREATE TABLE permanencia (
    id SERIAL PRIMARY KEY,
    id_professor INTEGER NOT NULL,
    dia_semana VARCHAR(30),
    hora_inicio TIME,
    hora_fim TIME,
    sala VARCHAR(20),

    CONSTRAINT fk_professor
        FOREIGN KEY (id_professor)
        REFERENCES professor(id)
        ON DELETE CASCADE
);

CREATE TABLE disciplina (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    codigo VARCHAR(20) NOT NULL
);

CREATE TABLE aluno_disciplina (
    id_aluno INTEGER NOT NULL,
    id_disciplina INTEGER NOT NULL,

    PRIMARY KEY (id_aluno, id_disciplina),

    CONSTRAINT fk_aluno
        FOREIGN KEY (id_aluno)
        REFERENCES aluno(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_disciplina
        FOREIGN KEY (id_disciplina)
        REFERENCES disciplina(id)
        ON DELETE CASCADE
);

CREATE TABLE usuario (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    senha VARCHAR(50) NOT NULL
);

INSERT INTO usuario (id, nome, senha)
VALUES (
    1,
    'admin',
    '21232f297a57a5a743894a0e4a801fc3'
);

SELECT setval(
    pg_get_serial_sequence('usuario', 'id'),
    (SELECT MAX(id) FROM usuario)
);

create table aluno_permanencia(
    id serial primary key, 
    id_aluno integer not null references aluno(id) On delete cascade,
    id_permanencia integer not null references permanencia(id) on delete cascade,
    UNIQUE (id_aluno, id_permanencia)
);


      ##USuario e senha do admin
      --admin
      --admin
