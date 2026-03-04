<p align="center">
  <img src="https://cdn-icons-png.flaticon.com/512/744/744465.png" width="150" alt="FastCar Logo">
</p>

<h1 align="center">🚗 FastCar</h1>

<p align="center">
Sistema de gerenciamento de locadora de veículos desenvolvido com Laravel + MySQL.
</p>

<p align="center">
<img src="https://img.shields.io/badge/PHP-8.x-blue">
<img src="https://img.shields.io/badge/Laravel-10.x-red">
<img src="https://img.shields.io/badge/MySQL-8.x-orange">
<img src="https://img.shields.io/badge/Status-Em%20Desenvolvimento-yellow">
</p>

---

## 📌 Sobre o Projeto

O **FastCar** é um sistema web para gerenciamento de uma locadora de veículos.

O sistema permite o controle completo de:

- 🚘 Carros  
- 👤 Clientes  
- 📅 Locações  
- 🏷️ Marcas  
- 🚙 Modelos  

Projeto desenvolvido para fins acadêmicos utilizando Laravel e banco de dados relacional.

---

## 🛠️ Tecnologias Utilizadas

- PHP  
- Laravel  
- MySQL  
- MySQL Workbench  
- Blade Template Engine  

---

## 🗂️ Funcionalidades

### 🚘 Carros
- Cadastro
- Listagem
- Atualização
- Exclusão

### 👤 Clientes
- Cadastro
- Edição
- Remoção
- Listagem

### 📅 Locações
- Associação entre cliente e carro
- Registro de data de início e fim
- Histórico de locações

### 🏷️ Marcas
- Cadastro e gerenciamento

### 🚙 Modelos
- Associação com marcas
- Gerenciamento completo

---

## 🗄️ Banco de Dados

Principais tabelas:

- marcas  
- modelos  
- carros  
- clientes  
- locacoes  

### Relacionamentos

- Um modelo pertence a uma marca  
- Um carro pertence a um modelo  
- Uma locação pertence a um cliente  
- Uma locação pertence a um carro  

---

## ⚙️ Como Rodar o Projeto

### 1️⃣ Clonar o projeto

```bash
git clone https://github.com/seu-usuario/fastcar.git
