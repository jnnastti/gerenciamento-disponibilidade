
## Descrição do Projeto - Gerenciamento de Disponibilidade de Profissionais

Desenvolver uma API para permitir que profissionais gerenciem sua 
disponibilidade de forma eficiente, facilitando a reserva de sessões por 
parte dos clientes.

### Gerenciamento de Disponibilidade:

- Os profissionais podem definir os dias da semana em que estão disponíveis.
- Eles podem especificar intervalos de tempo disponíveis para cada dia selecionado.

### Reserva de Sessões:

- Os clientes podem reservar sessões com os profissionais através da API.
- Ao reservar uma sessão, os slots de tempo correspondentes são bloqueados 
para evitar conflitos com outras reservas.


## Instruções de Instalação

Antes de seguir os passos apresentados, garanta que 
o PHP versão 8.0 está instalado, juntamente com o composer.

Acesse o arquivo php.info e descomente a linha referente ao sqlite3.

 ### Clonar o Repositório
- Abra o terminal ou prompt de comando e navegue até o diretório onde 
deseja instalar o projeto.
- Execute o seguinte comando para clonar o repositório do GitHub:

```
git clone https://github.com/jnnastti/gerenciamento-disponibilidade.git
```

### Instalar Dependências do Composer:
- Após clonar o repositório, navegue até o diretório do projeto no terminal.
- Execute o seguinte comando para instalar as dependências do Composer:

```
composer install
```

### Copiar o Arquivo de Configuração do Ambiente:
- Faça uma cópia do arquivo ".env.example" e renomeie-o para ".env":
```
cp .env.example .env
```
- Abra o arquivo ".env" e configure as variáveis de ambiente, 
como banco de dados, URL, etc., de acordo com a sua configuração.

### Gerar a Chave de Criptografia do Laravel:
- Execute o seguinte comando para gerar uma chave de 
criptografia para o Laravel:

```
php artisan key:generate
```

### Executar as Migrações do Banco de Dados:
- execute o seguinte comando para executar as migrações:
```
php artisan migrate
```

### Servir o Aplicativo Localmente:
- Você pode servir o aplicativo localmente usando o 
servidor de desenvolvimento do Laravel. Execute o seguinte comando:

```
php artisan serve
```
- Isso iniciará um servidor de desenvolvimento local. Você poderá acessar 
o aplicativo no seu navegador visitando o endereço http://localhost:8000 
(ou o endereço indicado pelo comando).

## Guia de Uso

Este é um guia de uso para as rotas de um projeto Laravel. Abaixo estão listadas as rotas disponíveis e suas respectivas funcionalidades.

### Rotas para Profissionais

#### Listar todos os Profissionais

- **Rota**: <span style="color:blue">`GET`</span> /professionals
- **Descrição**: Retorna uma lista de todos os profissionais cadastrados.

#### Criar um novo Profissional

- **Rota**: <span style="color:green">`POST`</span> /professionals
- **Descrição**: Cria um novo profissional com os dados fornecidos dentro de um JSON.

#### Mostrar detalhes de um Profissional

- **Rota**: <span style="color:blue">`GET`</span> /professionals/{id}
- **Descrição**: Retorna os detalhes do profissional com o ID especificado.

#### Atualizar os dados de um Profissional

- **Rota**: <span style="color:orange">`PUT`</span> /professionals/{id}
- **Descrição**: Atualiza os dados fornecidos no JSON do corpo do profissional com o ID especificado.

#### Excluir um Profissional

- **Rota**: <span style="color:red">`DELETE`</span> /professionals/{id}
- **Descrição**: Exclui o profissional com o ID especificado.

### Rotas para Disponibilidade de Profissionais

#### Listar todas as Disponibilidades

- **Rota**: <span style="color:blue">`GET`</span> /availability
- **Descrição**: Retorna uma lista de todas as disponibilidades cadastradas dos profissionais.

#### Criar uma nova Disponibilidade

- **Rota**: <span style="color:green">`POST`</span> /availability
- **Descrição**: Cria uma nova disponibilidade para um profissional com os dados do JSON.

#### Mostrar detalhes de uma Disponibilidade

- **Rota**: <span style="color:blue">`GET`</span> /availability/{id}
- **Descrição**: Retorna os detalhes da disponibilidade com o ID especificado.

#### Atualizar os dados de uma Disponibilidade

- **Rota**: <span style="color:orange">`PUT`</span> /availability/{id}
- **Descrição**: Atualiza os dados da disponibilidade com o ID especificado.

#### Excluir uma Disponibilidade

- **Rota**: <span style="color:red">`DELETE`</span> /availability/{id}
- **Descrição**: Exclui a disponibilidade com o ID especificado.

## Exemplos ou Demonstração

## Contato
Para perguntas ou feedback, entre em contato através do email: janna.sangaletti6@gmail.com
