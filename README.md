# TADS6-2025-2-GWS-Eliphaz-Leonardo-Jo-o-Victor-Jo-o-Gabriel-Vagner
Blog sobre Economia como projeto da matéria Gestão Web Sites

**Pré-requisitos**
Para rodar este projeto, você precisa ter um ambiente de desenvolvimento local com os seguintes componentes instalados:

Servidor Web: Apache (geralmente incluído em pacotes como XAMPP, WAMP ou MAMP).

PHP: Versão 7.4 ou superior.

MySQL: Versão 5.7 ou superior.

Passos para a Configuração

**1. Clonar o Repositório**
Clone este repositório para a pasta raiz do seu servidor web local.

**2. Configurar o Banco de Dados**
Crie um novo banco de dados no seu cliente MySQL (como phpMyAdmin) com o nome blog_db.

Execute as instruções SQL no arquivo blog_db.sql para criar as tabelas necessárias.

Configurar o Usuário Administrador:
login: admin
senha: admin123

**3. Configurar a Conexão com o Banco de Dados**
Abra o arquivo conexao.php na pasta includes e verifique se as credenciais do banco de dados estão corretas.

PHP

<?php
$host = "localhost";
$usuario = "root"; // Altere se o seu usuário não for 'root'
$senha = "";       // Altere se você tiver uma senha no MySQL
$banco = "blog_db";
...


**Como Usar**
Acesse http://localhost/blog/ em seu navegador para ver os posts.

