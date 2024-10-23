# Expense-Trackr

Expense-Trackr is an API built with PHP to help users track their expenses. The system allows users to add transactions after logging in using JWT authentication. It follows RESTful API best practices and applies concepts such as OOP, MVC, SOLID principles, and Test-Driven Development (TDD).

## Features

- User authentication with JWT
- Add, view, edit, and delete transactions
- RESTful API design principles
- Full test coverage with Pest
- Follows SOLID principles and OOP best practices

## Tech Stack

- **PHP**: Backend development
- **Composer**: Dependency management
- **Docker**: Containerization
- **JWT**: Authentication
- **Pest**: Testing framework
- **MySQL**: Database

## Setup

To set up the project locally:

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/expense-trackr.git
    ```
2. Install dependencies:
    ```bash
    composer install
    ```
3. Setup your `.env` file by copying the example:
    ```bash
    cp .env.example .env
    ```
4. Spin up the Docker container:
    ```bash
    docker-compose up -d
    ```
5. Run tests:
    ```bash
    vendor/bin/pest
    ```

## Usage

### Authentication

To authenticate, make a `POST` request to `/api/login` with your credentials. Upon successful login, you will receive a JWT token to be used for further API requests.

### Transactions

Once authenticated, you can add, edit, view, or delete transactions by making requests to the following endpoints:

- **GET** `/api/transactions`: View all transactions
- **POST** `/api/transactions`: Add a new transaction
- **PUT** `/api/transactions/{id}`: Update an existing transaction
- **DELETE** `/api/transactions/{id}`: Remove a transaction

## Contributing

We welcome contributions to improve this project. Please read our Code of Conduct before submitting any pull requests.

## License
This project is licensed under the MIT License - see the LICENSE file for details.