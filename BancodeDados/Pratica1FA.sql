\l
create database alunos;
\l
\c alunos
\d
create table aluno (idAluno integer primary key, nomeAluno varchar(45), derecoAluno varchar(45), emailAluno varchar(45));
\d
insert into aluno values ( 1, 'Paulo Silva Rocha', 'Av. Brasil, 120 - São Paulo', 'paulorocha@gmail.com' );
insert into aluno values ( 20, 'Ana Antunes', 'Rua Aranha de Souza, 70 - 	Rio de Janeiro', 'anaantunes@uol.com.br' );
insert into aluno values ( 5, 'Pedro Xavier Silva', 'Rua Amazonas, 45 - São Paulo', 'pedroxavier@uol.com.br' );
insert into aluno values ( 7, 'Beatriz Carolina', 'Rua Saulo Silva, 70 - Rio Grande do Sul', 'beatriz@gmail.com' );
insert into aluno values ( 45, 'Paula Andressa Guedes', 'Rua Catanduva, 345 - MG', 'pauloguedes@gmail.com' );
select * from aluno;
select * from aluno group by nomeAluno;
select idAluno, nomeAluno from aluno group by nomeAluno;
delete from aluno where idAluno = 1;
select * from aluno;
delete from aluno;
select * from aluno;
insert into aluno values ( 1, 'Paulo Silva Rocha', 'Av. Brasil, 120 - São Paulo', 'paulorocha@gmail.com' ), ( 20, 'Ana Antunes', 'Rua Aranha de Souza, 70 - 	Rio de Janeiro', 'anaantunes@uol.com.br' ), ( 5, 'Pedro Xavier Silva', 'Rua Amazonas, 45 - São Paulo', 'pedroxavier@uol.com.br' ), ( 7, 'Beatriz Carolina', 'Rua Saulo Silva, 70 - Rio Grande do Sul', 'beatriz@gmail.com' ), ( 45, 'Paula Andressa Guedes', 'Rua Catanduva, 345 - Natal', 'pauloguedes@gmail' );
drop table aluno;
drop database alunos;
\l