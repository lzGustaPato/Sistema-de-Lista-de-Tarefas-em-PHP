# Sistema de Lista de Tarefas (To-Do List) em PHP

Este é um projeto de uma lista de tarefas feito em PHP. Ele foi dividido em duas partes para testar duas formas de salvar os dados: primeiro usando um arquivo de texto comum .txt e em banco de dados relacional MySQL.

## Estrutura das Pastas

todo-list/
├── fase1/ Versão que salva as tarefas direto em um arquivo de texto
│   └── index.php
├── fase2/ Versão que salva as tarefas no banco de dados usando PDO
│   ├── db.php
│   └── index.php
├── script.sql Comandos para criar o banco de dados e a tabela da Fase 2.
└── README.md Este arquivo

## Pré-requisitos
- Ter o **Laragon** instalado no computador.


## Como rodar a Fase 1

Nesta fase, as tarefas são armazenadas no arquivo de texto tarefas.txt localizado no mesmo diretório do index.php

1. Abra a pasta de instalação do seu Laragon que geralmente fica em C:\laragon
2. Entre na pasta `www` e cole a pasta do projeto completa lá dentro ex: C:\laragon\www\todo-list
3. Abra o painel do Laragon e clique em **"Start All"** para ligar o servidor
4. No seu navegador, acesse: http://localhost/todo-list/fase1/
5. Pronto, pode testar. O arquivo tarefas.txt vai aparecer na pasta assim que você criar a primeira tarefa


## Como rodar a Fase 2

Aqui o sistema foi refatorado para salvar tudo no MySQL de forma mais segura

### Passo 1: Criar o Banco de Dados pelo Terminal
1. No painel do Laragon, clique no botão **"Terminal"**.
2. Digite o comando abaixo para entrar no MySQL (como o padrão do Laragon é não ter senha, basta dar Enter quando pedir a senha):
   ```bash
   mysql -u root -p
   CREATE DATABASE IF NOT EXISTS todo_db;
   USE todo_db;
   CREATE TABLE IF NOT EXISTS tarefas ( id INT AUTO_INCREMENT PRIMARY KEY, titulo VARCHAR(255) NOT NULL, status VARCHAR(50) NOT NULL DEFAULT 'Pendente' );
   exit
3. No seu navegador, acesse: http://localhost/todo-list/fase2/
4. Pronto, pode testar