# Plataforma de Chamados de TI

## Descrição
Este projeto é uma plataforma de gerenciamento de chamados de TI para a prefeitura, permitindo que os funcionários registrem problemas técnicos, sugestões ou incidentes.

## Tecnologias Utilizadas
- Frontend: Bootstrap, jQuery
- Backend: PHP 8
- Banco de Dados: MySQL
- Controle de Versão: GIT

## Instalação
1. Clone o repositório:
    ```bash
    git clone https://github.com/seuusuario/plataforma-chamados.git
    ```

2. Configure o banco de dados MySQL:
    - Crie um banco de dados chamado `plataforma_chamados`.
    - Execute o script SQL fornecido em `database.sql` para criar as tabelas.

3. Configure o arquivo `config/config.php` com as informações do seu banco de dados.

4. Inicie o servidor Apache e MySQL através do XAMPP.

5. Acesse a aplicação via `http://localhost/plataforma-chamados`.

## Funcionalidades
- Cadastro e login de usuários
- Registro de novos chamados
- Upload de anexos e contatos associados ao chamado
- Visualização de chamados e histórico de ações

## Segurança
- Proteção contra SQL Injection
- Armazenamento seguro de senhas

## Contribuição
Sinta-se à vontade para fazer um fork do projeto e enviar pull requests com melhorias.

## Licença
Este projeto está licenciado sob a Licença MIT.
