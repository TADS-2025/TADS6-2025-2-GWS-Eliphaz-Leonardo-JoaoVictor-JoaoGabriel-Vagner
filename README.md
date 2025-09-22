# 📖 Blog IF-Investe – Educação Financeira

<img src="img/logoif.png" alt="IFPR Logo" width="250" />

**Um projeto da disciplina de GWS desenvolvido por alunos do [Instituto Federal do Paraná (IFPR) - Campus Telêmaco Borba](https://telemaco.ifpr.edu.br/)**

---

## 💻 Equipe de Desenvolvedores

1. **Vagner Ferreira** – `euvagnerferreira@gmail.com`  
2. **Leonardo Timotio** – `leeonardo.silvat@gmail.com`  
3. **Eliphaz Gabriel** – `eliphazgabriel.volcano@outlook.com`  
4. **João Gabriel Castilho** – `joocastilho27@gmail.com`  
5. **João Victor Santos** – `jvictorsan@gmail.com`  

**Orientação:** Profª Melissa Silva de Oliveira  

---

## 🚀 Sobre o Projeto

Este projeto consiste na criação de um **Blog de Educação Financeira** com foco em **Finanças Pessoais e Investimentos**, desenvolvido em **PHP** e utilizando **MySQL (phpMyAdmin)** para gerenciamento do banco de dados.  

O objetivo é tornar o aprendizado sobre finanças mais acessível, prático e conectado com a realidade dos estudantes e da comunidade.  

O blog conta com:  
- Autenticação de administrador (login e dashboard).  
- CRUD de posts (criação, edição, exclusão).  
- Organização por categorias.  
- Upload de imagens para ilustrar conteúdos.  
- Layout responsivo e moderno.  

---

## 📚 Tópicos Abordados

O blog traz artigos sobre:  

- **Planejamento Financeiro:** organização de orçamento e definição de metas.  
- **Estratégias de Economia:** dicas práticas para o dia a dia.  
- **Investimentos:** renda fixa, ações, fundos imobiliários e mais.  
- **Criptomoedas:** introdução segura ao mercado digital.  
- **Renda Passiva:** como gerar ganhos automáticos.  
- **Educação e Cultura Financeira:** conceitos básicos para iniciantes.  

---

## ⚙️ Como Rodar o Projeto

Siga os passos abaixo para rodar o blog no seu ambiente local usando **XAMPP**:

### **1. Pré-requisitos**
- [XAMPP](https://www.apachefriends.org/) instalado (com Apache e MySQL ativos).  
- Navegador web.  

### **2. Clonar o Repositório**
No diretório `htdocs` do XAMPP, clone este repositório:  

```bash
cd C:\xampp\htdocs
git clone https://github.com/TADS-2025/TADS6-2025-2-GWS-Eliphaz-Leonardo-JoaoVictor-JoaoGabriel-Vagner.git
```
### 3. Configurar o Banco de Dados

- Abra o **phpMyAdmin**.  
- Crie um banco chamado **blog_db**.  
- Importe o arquivo **schema.sql** (contendo as tabelas `posts`, `usuarios`, `categorias`).  

---

### 4. Configuração de Conexão

Verifique o arquivo `includes/conexao.php` e ajuste caso necessário:  

```php
<?php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "blog_db";

$conn = new mysqli($host, $usuario, $senha, $banco);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
```
### 5. Executar o Projeto

- No **XAMPP**, inicie o **Apache** e o **MySQL**.  
- Abra no navegador:  

```php
http://localhost/TADS6-2025-2-GWS-Eliphaz-Leonardo-JoaoVictor-JoaoGabriel-Vagner
```


---

## 🛠️ Tecnologias Utilizadas
- **PHP 8**  
- **MySQL / phpMyAdmin**  
- **HTML5 / CSS3 (responsivo)**  
- **XAMPP**  

---

## 🎯 Resultado Esperado
O blog permite que administradores gerenciem artigos sobre educação financeira e que visitantes explorem os posts organizados por categoria, com interface intuitiva e amigável.

## 📂 Script do Banco de Dados (schema.sql)

```sql
-- ==========================================
-- 📦 SCHEMA DO BLOG IF-INVESTE
-- Banco: blog_db
-- ==========================================

-- Criar banco (caso ainda não exista)
CREATE DATABASE IF NOT EXISTS blog_db;
USE blog_db;

-- ==========================
-- Tabela de Usuários
-- ==========================
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Inserir usuário admin (senha: 123456)
-- OBS: A senha está em hash (password_hash no PHP)
INSERT INTO usuarios (usuario, senha) VALUES
('admin', '$2y$10$wH7lV6kQXx1B0qk4ZkJr2uQfMddwX7YbQ2fZlgCtO89t8ofgTGLjG'); 
-- Senha original: 123456

-- ==========================
-- Tabela de Categorias
-- ==========================
CREATE TABLE IF NOT EXISTS categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL
);

-- Categorias iniciais
INSERT INTO categorias (nome) VALUES
('Planejamento Financeiro'),
('Investimentos'),
('Criptomoedas'),
('Educação Financeira'),
('Renda Passiva');

-- ==========================
-- Tabela de Posts
-- ==========================
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    conteudo TEXT NOT NULL,
    imagem VARCHAR(255),
    autor VARCHAR(100) NOT NULL,
    categoria_id INT,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON DELETE SET NULL
);

-- Posts iniciais
INSERT INTO posts (titulo, conteudo, imagem, autor, categoria_id) VALUES
('Bem-vindo ao Blog IF-Investe',
 'Este é o primeiro post do nosso blog de Educação Financeira! Aqui vamos compartilhar dicas, artigos e conteúdos para ajudar você a organizar suas finanças e investir melhor.',
 'post1.jpg', 'Admin', 1),

('Dicas de Economia no Dia a Dia',
 'Pequenas mudanças de hábito podem gerar grandes economias. Neste artigo, mostramos como cortar gastos desnecessários e direcionar o dinheiro para seus objetivos.',
 'post2.jpg', 'Vagner', 2),

('Introdução ao Mundo das Criptomoedas',
 'As criptomoedas vêm ganhando destaque no mercado. Mas como começar com segurança? Aqui apresentamos os conceitos básicos e os cuidados essenciais.',
 'post3.jpg', 'Leonardo', 3);
```