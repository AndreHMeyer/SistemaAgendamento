CREATE DATABASE sistemaAgendamento;

USE sistemaAgendamento;

CREATE TABLE pessoa (
	id BIGINT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50),
    email VARCHAR(50),
    cpf VARCHAR(16),
    dataNascimento date,
    PRIMARY KEY (id)
);

CREATE TABLE usuario (
	id BIGINT NOT NULL AUTO_INCREMENT,
    nomeUsuario VARCHAR(50),
    senha VARCHAR(55),
    email VARCHAR(50),
    idPessoa BIGINT,
    PRIMARY KEY (id),
    FOREIGN KEY (idPessoa) REFERENCES pessoa(id)
);

CREATE TABLE profissional (
	id BIGINT NOT NULL AUTO_INCREMENT,
    numConselho VARCHAR(30),
    especialidade VARCHAR(200),
    idPessoa BIGINT,
    PRIMARY KEY (id),
    FOREIGN KEY (idPessoa) REFERENCES pessoa(id)
);

CREATE TABLE agenda (
	id BIGINT NOT NULL AUTO_INCREMENT,
    dataInicio DATE,
    dataFim DATE,
    idProfissional BIGINT,
    PRIMARY KEY (id),
    FOREIGN KEY (idProfissional) REFERENCES profissional(id)
);

CREATE TABLE consulta (
	id BIGINT NOT NULL AUTO_INCREMENT,
    data date,
    observacao VARCHAR(300),
    idPessoa BIGINT,
    idProfissional BIGINT,
    idAgenda BIGINT,
    PRIMARY KEY (id),
    FOREIGN KEY (idPessoa) REFERENCES pessoa(id),
    FOREIGN KEY (idProfissional) REFERENCES profissional(id),
    FOREIGN KEY (idAgenda) REFERENCES agenda(id)
);