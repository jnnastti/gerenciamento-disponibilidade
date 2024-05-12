
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
o PHP versão 8.0 está instalado, juntamente com o composer e o git.

Para esse trabalho, foi utilizado o Laravel v11.7.0. 

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

## Guia de Uso e exemplos

Este é um guia de uso para as rotas de um projeto Laravel. Abaixo estão listadas as rotas disponíveis e suas respectivas funcionalidades.

### Rotas para Profissionais

#### Listar todos os Profissionais

- **Rota**: <span style="color:blue">`GET`</span> /api/professionals
- **Descrição**: Retorna uma lista de todos os profissionais cadastrados.
- **Body**:
```
// Não é necessário
```
- **Retorno**:
```json
[
  {
    "id": 1,
    "name": "Kevin João",
    "specialization": "Psicologo",
    "description": "Um psico gente boa",
    "phone_number": "48 999443300",
    "email": "kevin@gmail.com",
    "created_at": "2024-05-12T16:56:53.000000Z",
    "updated_at": "2024-05-12T16:56:53.000000Z"
  }
]
```

#### Criar um novo Profissional

- **Rota**: <span style="color:green">`POST`</span> /api/professionals
- **Descrição**: Cria um novo profissional com os dados fornecidos dentro de um JSON.
- **Body**:
```json
{
    "name": "Kevin João P",
    "specialization": "Psicologo",
    "description": "Um psico gente boa",
    "phone_number": "48 999443300",
    "email": "kevin123@gmail.com"
}
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Professional created successfully.",
    "professional": {
        "name": "Kevin João P",
        "specialization": "Psicologo",
        "description": "Um psico gente boa",
        "phone_number": "48 999443300",
        "email": "kevin123@gmail.com",
        "updated_at": "2024-05-12T17:04:49.000000Z",
        "created_at": "2024-05-12T17:04:49.000000Z",
        "id": 2
    }
}
```

#### Mostrar detalhes de um Profissional

- **Rota**: <span style="color:blue">`GET`</span> /api/professionals/{id}
- **Descrição**: Retorna os detalhes do profissional com o ID especificado.
- **Body**:
```
// Não é necessário
```
- **Retorno**:
```json
{
    "id": 1,
    "name": "Kevin João",
    "specialization": "Psicologo",
    "description": "Um psico gente boa",
    "phone_number": "48 999443300",
    "email": "kevin@gmail.com",
    "created_at": "2024-05-12T16:56:53.000000Z",
    "updated_at": "2024-05-12T16:56:53.000000Z"
}
```

#### Atualizar os dados de um Profissional

- **Rota**: <span style="color:orange">`PUT`</span> /api/professionals/{id}
- **Descrição**: Atualiza os dados fornecidos no JSON do corpo do profissional com o ID especificado.
- **Body**:
```json
{
    "description": "Um psico muito muito muito gente boa"
}
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Professional updated successfully.",
    "professional": {
        "id": 1,
        "name": "Kevin João",
        "specialization": "Psicologo",
        "description": "Um psico muito muito muito gente boa",
        "phone_number": "48 999443300",
        "email": "kevin@gmail.com",
        "created_at": "2024-05-12T16:56:53.000000Z",
        "updated_at": "2024-05-12T17:16:06.000000Z"
    }
}
```
#### Excluir um Profissional

- **Rota**: <span style="color:red">`DELETE`</span> /api/professionals/{id}
- **Descrição**: Exclui o profissional com o ID especificado.
- **Body**:
```
// Não é necessário
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Professional deleted successfully.",
    "professional": {
        "id": 5,
        "name": "Kevin João P",
        "specialization": "Psicologo",
        "description": "Um psico gente boa",
        "phone_number": "48 999443300",
        "email": "kevin123@gmail.com",
        "created_at": "2024-05-12T17:33:38.000000Z",
        "updated_at": "2024-05-12T17:33:38.000000Z"
    }
}
```

### Rotas para Disponibilidade de Profissionais

#### Listar todas as Disponibilidades

- **Rota**: <span style="color:blue">`GET`</span> /api/availability
- **Descrição**: Retorna uma lista de todas as disponibilidades cadastradas dos profissionais.
- **Body**:
```
// Não é necessário
```
- **Retorno**:
```json
[
    {
        "id": 1,
        "professional_id": 1,
        "day_of_week": "Tuesday",
        "start_time": "09:00",
        "end_time": "12:00",
        "created_at": "2024-05-12T17:40:22.000000Z",
        "updated_at": "2024-05-12T17:40:22.000000Z"
    }
]
```

#### Criar uma nova Disponibilidade

- **Rota**: <span style="color:green">`POST`</span> /api/availability
- **Descrição**: Cria uma nova disponibilidade para um profissional com os dados do JSON.
- **Body**:
```json
{
    "professional_id": 1,
    "day_of_week": "Tuesday",
    "start_time": "09:00",
    "end_time": "12:00"
}
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Availability created successfully."
}
```

#### Mostrar detalhes de uma Disponibilidade

- **Rota**: <span style="color:blue">`GET`</span> /api/availability/{id}
- **Descrição**: Retorna os detalhes da disponibilidade com o ID especificado.
- **Body**:
```
// Não é necessário
```
- **Retorno**:
```json
{
    "id": 1,
    "professional_id": 1,
    "day_of_week": "Tuesday",
    "start_time": "09:00",
    "end_time": "12:00",
    "created_at": "2024-05-12T17:40:22.000000Z",
    "updated_at": "2024-05-12T17:40:22.000000Z"
}
```

#### Atualizar os dados de uma Disponibilidade

- **Rota**: <span style="color:orange">`PUT`</span> /api/availability/{id}
- **Descrição**: Atualiza os dados da disponibilidade com o ID especificado.
- **Body**:
```json
{
    "professional_id": 3,
    "day_of_week": "Friday",
    "start_time": "20:00",
    "end_time": "22:00"
}
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Availability updated successfully."
}
```

#### Excluir uma Disponibilidade

- **Rota**: <span style="color:red">`DELETE`</span> /api/availability/{id}
- **Descrição**: Exclui a disponibilidade com o ID especificado.
- **Body**:
```
// Não é necessário
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Availability deleted successfully.",
    "availability": {
        "id": 1,
        "professional_id": 1,
        "day_of_week": "Tuesday",
        "start_time": "09:30",
        "end_time": "12:00",
        "created_at": "2024-05-12T17:40:22.000000Z",
        "updated_at": "2024-05-12T17:43:34.000000Z"
    }
}
```
#### Filtrar disponibilidades

- **Rota**: <span style="color:red">`POST`</span> /api/availability/getHours
- **Descrição**: Filtra as disponibilidades por dia da semana, profissional
 e/ou intervalo de tempo.
- **Body**:
```json
{
   "day": "Friday",
   "professional": "3",
   "startTime": "15:00",
   "endTime": "22:00"
}
```
**Retorno**:
```json
{
    "Friday": {
        "3": [
            "21:30",
            "22:00"
        ]
    }
}
```
#### Reservar horário

- **Rota**: <span style="color:red">`POST`</span> /api/availability/reserve
- **Descrição**: Reservar um horário da agenda do profissional.
- **Body**:
```json
{
    "slot": 23, 
    "name": "Janna"
}
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Availability reserved successfully."
}
```
#### Cancelar Reserva

- **Rota**: <span style="color:red">`POST`</span> /api/availability/cancelSlot/{id}
- **Descrição**: Cancelar agendamento de horário do profissional.
- **Body**:
```
// não é necessário
```
- **Retorno**:
```json
{
    "status": "success",
    "message": "Slot canceled successfully."
}
```
## Contato
Para perguntas ou feedback, entre em contato através do email: janna.sangaletti6@gmail.com

