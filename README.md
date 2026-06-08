 ##Conteudo do htaccess
 --
      RewriteEngine On
      RewriteBase /Gerenciador/mvc/
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]

##Script do Banco de dados 
--

      CREATE DATABASE Gerenciador;
      \c Gerenciador;
      
      -- Tabela Professor
      CREATE TABLE professor (
          id SERIAL PRIMARY KEY,
          nome VARCHAR(100),
          email VARCHAR(100),
          senha VARCHAR(100)
      );
      
      -- Tabela Aluno
      CREATE TABLE aluno (
          id SERIAL PRIMARY KEY,
          nome VARCHAR(100),
          email VARCHAR(100),
          senha VARCHAR(100)
      );
      
      -- Tabela Permanência
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
      
      -- Tabela Usuário
      CREATE TABLE usuario (
          id SERIAL PRIMARY KEY,
          nome VARCHAR(50) NOT NULL,
          senha VARCHAR(50) NOT NULL
      );
      
      -- Dados iniciais
      INSERT INTO usuario (id, nome, senha)
      VALUES
      (1, 'admin', '21232f297a57a5a743894a0e4a801fc3');
      
      -- Ajusta a sequência do usuário
      SELECT setval(
          pg_get_serial_sequence('usuario', 'id'),
          (SELECT MAX(id) FROM usuario)
      );
