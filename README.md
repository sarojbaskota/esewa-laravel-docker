# Laravel - Docker Repository

- PHP: 8.1
- Laravel: 10.13.5
- phpMyAdmin: 5.2.1
- MariaDB: 11.0.2

## Project Structure

The repository is structured as follows:

├── backend/<br>
│ ├── Dockerfile<br>
│ └── ...<br>
│ <br>
│ <br>
├── docker/<br>
│ ├── mariadb/<br>
│ └── nginx/<br>
│ <br>
└── docker-compose.yml<br>


- The `backend/` directory contains the Laravel backend code, including the `app/` directory for Laravel application files, and a `Dockerfile` for building the backend Docker image.
- The `docker/` directory contains subdirectories for Docker-related files, such as `mariadb/` for MariaDB configuration and `nginx/` for Nginx configuration.
- The `docker-compose.yml` file is responsible for defining and orchestrating the Docker containers.

## Getting Started

To run the project locally using Docker, follow these steps:

1. Clone the repository:

   ```bash
   git clone https://github.com/sarojbaskota/esewa-laravel-docker.git
   ```
2. Change into the project directory:

   ```bash
   cd esewa-laravel-docker
   ```
3. Build and start the Docker containers:

   ```bash
   docker compose up -d --build

4. Access the backend application in your browser:

   - Open http://localhost:8000 in your browser to access the Laravel backend.

## Running Laravel Commands

To run Laravel commands such as migrations or artisan commands, you can access the Laravel backend container using the following command:

```bash
docker exec -it laravel-app bash
```

Once inside the container, you can run Laravel commands as you would on a regular Laravel installation. For example, to run migrations, use the following command:

```bash
php artisan migrate
```

Remember to exit the container after running the desired commands.