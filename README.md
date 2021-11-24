## Fatec Araras, Curso DSM, Projeto Integrador 1º Semestre 


<!-- Logo -->
<h1 align="center">
    <img src="https://ik.imagekit.io/mnbr5uwksus/DoctorOn/LOGO_j-IGD2aXNCE.svg?updatedAt=1636410321224" height="130"/>
</h1>

Apresentação do Projeto
---
É comum termos acidentes no dia a dia e pensando nisso, surgiu a ideia da criação do DoctorOn.
Que consiste basicamente em um aplicativo no qual informa aos usuários quais médicos trabalham nos hospitais e quais se encontram disponíveis no momento.
Por exemplo:
Diante de um acidente no seu dia a dia,
podendo ser um corte, ou até mesmo uma analise periódica com um determinado especialista. Através do aplicativo, terei as informações dos médicos disponíveis nos hospitais mais próximo, também informações sobre as unidades mais próximas e quais médicos atuam em cada unidade, assim evitando a perda de tempo na procura de hospitais que não tenham médicos, ou que tenham médicos, mas que não atendam o meu caso.

<p align="center">
  <a href="#documentação">Documentação</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#layout">Layout</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#como-usar">Como usar</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#aplicação">Aplicação</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#licença">Licença</a>
</p>

## Documentação

Documentação do projeto:

- <a href="https://github.com/Apvictor/Fatec-DSM-Projeto_Integrador/blob/main/Docs/Documento_RequisitosV1.pdf" target="_blank">v1</a>
- <a href="https://github.com/Apvictor/Fatec-DSM-Projeto_Integrador/blob/main/Docs/Documento_RequisitosV2.pdf" target="_blank">v2</a>
- <a href="https://github.com/Apvictor/Fatec-DSM-Projeto_Integrador/blob/main/Docs/Documento_RequisitosV3.pdf" target="_blank">v3</a>
- <a href="https://github.com/Apvictor/Fatec-DSM-Projeto_Integrador/blob/main/Docs/Documento_RequisitosV4.pdf" target="_blank">v4</a>
- <a href="https://github.com/Apvictor/Fatec-DSM-Projeto_Integrador/blob/main/Docs/Documento_RequisitosV5.pdf" target="_blank">v5</a>
## Tecnologias

Este projeto foi desenvolvido com as seguintes tecnologias:

- [MySQL](https://www.mysql.com/)
- [Ionic](https://ionicframework.com/)
- [Angular](https://angular.io/)
- [TypeScript](https://www.typescriptlang.org/)
- [PHP](https://www.php.net/)
- [Laravel](https://laravel.com/)

## Layout

Para acessar o layout use o [Figma](https://www.figma.com/file/VPNCoCYiAdLfrX7bckOXWk/DoctorOn?node-id=0%3A1).

## Como usar

Para clonar e executar este aplicativo, você precisará do [Git](https://git-scm.com), [Node.js](https://nodejs.org/en/), [Composer](https://getcomposer.org/) instalados no seu computador.

Na sua linha de comando:

### Instalar API

```bash
# Clone este repositório
$ git clone https://github.com/Apvictor/Fatec-DSM-Projeto_Integrador.git

# Vá para o repositório 
$ cd DoctorOn_BackEnd

# Instalar dependências
$ composer install

# Soliciar .env para administrador do Projeto e Executar migrações
$ php artisan migrate

# Run Seeds
$ php artisan db:seed

# Run
$ php artisan serve
```

### Instalar Mobile

```bash
# Clone este repositório
$ git clone https://github.com/Apvictor/Fatec-DSM-Projeto_Integrador.git

# Vá para o repositório 
$ cd DoctorOn_App

# Instalar dependências
$ npm install

# Run
$ ionic serve
```

## Aplicação

Para acessar o Painel de Controle da Aplicação: [WEB](https://doctor-on.herokuapp.com/)

Para fazer o download do Aplicativo: [APP](https://drive.google.com/file/d/1bMQuCyYgRqm_RUITh7b8P-3OYzTjnifg/view?usp=sharing)

## Licença

Este projeto está sob a licença do MIT. Consulte a [LICENÇA](https://github.com/DanielObara/NLW-1.0/blob/master/LICENSE) para obter detalhes.

Feito com ♥ por Armando Pereira 👋 [Entrar em contato!](https://www.linkedin.com/in/armando-v%C3%ADctor-pereira-2021/)
