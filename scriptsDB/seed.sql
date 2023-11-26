USE sistemaAgendamento;

INSERT INTO pessoa (nome, email, cpf, dataNascimento) VALUES
    ('João Silva', 'joao@teste.com', '123.456.789-01', '1990-05-15'),
    ('Maria Souza', 'maria@teste.com', '987.654.321-01', '1985-09-22'),
    ('Carlos Santos', 'carlos@teste.com', '456.789.123-01', '1995-02-10'),
    ('Ana Pereira', 'ana@teste.com', '789.123.456-01', '1988-11-03'),
    ('Pedro Lima', 'pedro@teste.com', '654.321.987-01', '2000-07-18');

INSERT INTO usuario (nomeUsuario, senha, email) VALUES
    ('joao_silva', 'hashed_password1', 'joao@teste.com'),
    ('maria_souza', 'hashed_password2', 'maria@teste.com'),
    ('carlos_santos', 'hashed_password3', 'carlos@teste.com'),
    ('ana_pereira', 'hashed_password4', 'ana@teste.com'),
    ('pedro_lima', 'hashed_password5', 'pedro@teste.com');

INSERT INTO profissional (numConselho, especialidade, idPessoa) VALUES
    ('CRM12345', 'Cardiologia', 1),
    ('CRM67890', 'Dermatologia', 2),
    ('CRM54321', 'Ortopedia', 3),
    ('CRF98765', 'Farmácia', 4),
    ('CRF43210', 'Psicologia', 5);

INSERT INTO agenda (dataInicio, dataFim, idProfissional) VALUES
    ('2023-09-10', '2023-09-10', 1),
    ('2023-09-15', '2023-09-15', 2),
    ('2023-09-12', '2023-09-12', 3),
    ('2023-09-11', '2023-09-11', 4),
    ('2023-09-14', '2023-09-14', 5);

INSERT INTO consulta (data, observacao, idPessoa, idProfissional, idAgenda) VALUES
    ('2023-09-10', 'Consulta de rotina.', 1, 1, 1),
    ('2023-09-15', 'Avaliação de pele.', 2, 2, 2),
    ('2023-09-12', 'Avaliação ortopédica.', 3, 3, 3),
    ('2023-09-11', 'Retirada de receita.', 4, 4, 4),
    ('2023-09-14', 'Sessão de aconselhamento.', 5, 5, 5);


alter table pessoa add column numero_conselho varchar(50);
alter table pessoa add column tipo_conselho varchar(50);
alter table pessoa add column estado_conselho varchar(2);
alter table pessoa add column especialidade varchar(255);

update pessoa set especialidade = 'Dermatologia' where id = 1;
update pessoa set especialidade = 'Oftalmologia' where id = 2;
update pessoa set especialidade = 'Reumatologia' where id = 3;
update pessoa set especialidade = 'Clínico Geral' where id = 4;

ALTER TABLE `consulta` CHANGE `data` `data` DATETIME NULL DEFAULT NULL;