# 🍰 Rosendo's Delícias Artesanais - Vitrine e Encomendas Web

![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## 📌 Sobre o Projeto
Este projeto é uma aplicação web estática (Front-End) desenvolvida como **Atividade Somativa 1** para a disciplina de Fundamentos de Programação Web do curso de **Análise e Desenvolvimento de Sistemas (PUCPR)**. 

A aplicação funciona como uma vitrine virtual e um sistema de simulação de encomendas para a confeitaria da minha família, gerida por Rita e Mariana. O foco principal é a venda de pães de mel, oferecendo uma interface amigável para que o cliente possa conhecer a história do negócio, visualizar os produtos e fazer pedidos personalizados.

## 🚀 Funcionalidades
* **Navegação Consistente:** Estrutura semântica com menu e rodapé padronizados em todas as páginas.
* **Layout Responsivo Base:** Utilização de CSS Grid e Flexbox para organizar o conteúdo de forma harmoniosa.
* **Cálculo Dinâmico:** O subtotal do pedido é calculado em tempo real utilizando JavaScript, baseando-se no produto e na quantidade selecionada.
* **Interface Condicional:** Os campos de endereço de entrega só são exibidos e tornam-se obrigatórios se o usuário selecionar a opção "Entrega".
* **Validação de Regras de Negócio:** Prevenção de envio do formulário (`event.preventDefault()`) caso o sabor "Misto" seja escolhido sem as devidas observações.
* **Geração de Recibo:** Leitura de parâmetros via método GET utilizando a interface `URLSearchParams` para injetar os dados dinamicamente no DOM e exibir o resumo do pedido.

## 🛠️ Tecnologias Utilizadas
Este projeto foi construído utilizando as tecnologias base da web (Vanilla), sem a utilização de frameworks ou bibliotecas externas:
* **HTML5:** Estruturação semântica do conteúdo (`<header>`, `<nav>`, `<main>`, `<aside>`, `<section>`, etc).
* **CSS3:** Estilização externa (`style.css`), manipulação de especificidade (como a coloração dinâmica de tabelas), variáveis e pseudo-classes.
* **JavaScript (Vanilla):** Manipulação do DOM (`document.getElementById`, `innerHTML`, `classList`), captura de eventos (`addEventListener`) e lógica de programação condicional/loops.

## 📁 Estrutura de Arquivos

    📦 rosendos-delicias-artesanais
     ┣ 📂 css
     ┃ ┗ 📜 style.css
     ┣ 📂 img
     ┃ ┣ 🖼️ logo_rosendos.png
     ┃ ┣ 🖼️ hora_do_cafe.png
     ┃ ┣ 🖼️ tamanhos.png
     ┃ ┣ 🖼️ produtos.png
     ┃ ┣ 🖼️ demais_produtos.png
     ┃ ┣ 🖼️ recheio.png
     ┃ ┣ 🖼️ na-bandeja.png
     ┃ ┗ 🖼️ caixas.png
     ┣ 📂 script
     ┃ ┗ 📜 script.js
     ┣ 📜 index.html
     ┣ 📜 about.html
     ┣ 📜 form.html
     ┗ 📜 formAction.html

## ⚙️ Como executar o projeto
1. Faça o clone deste repositório em sua máquina local:

    git clone https://github.com/SEU-USUARIO/rosendos-delicias-artesanais.git

2. Navegue até a pasta do projeto.
3. Abra o arquivo `index.html` diretamente em seu navegador (Google Chrome, Firefox, Edge, etc.) dando um duplo clique.
   * *Opcional:* Se estiver utilizando o **Visual Studio Code**, você pode utilizar a extensão **Live Server** para rodar o projeto localmente.

## 👨‍💻 Autor
**Michel Urban Rosendo de Lima**
Estudante de Análise e Desenvolvimento de Sistemas (PUCPR) - 2º Período.

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)]