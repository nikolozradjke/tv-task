<ul>
    <li>Install dependencies: <strong>composer install</strong></li>
    <li>Generate .env manually ro run: <strong>cp .env.example .env</strong></li>
    <li>Generates a new application key: <strong>php artisan key:generate</strong></li>
    <li>Generate sqllite db file in /database directory: <strong>touch {project_directory}/database/database.sqlite</strong></li>
    <li>Run migration: <strong>php artisan migrate:fresh</strong></li>
    <li>Run seeder for default user (Optional): <strong>php artisan db:seed</strong></li>
    <li>
        <p>Generate passport migrations and assets: <strong>php artisan passport:install</strong></p>
        <p>It will generate grant type Client Id and Client Secret, Set them in .env as PASSPORT_CLIENT_ID and PASSPORT_CLIENT_SECRET</p>
    </li>
</ul>

# [Get API documentation](https://documenter.getpostman.com/view/23156310/2sAYX8Jgad)