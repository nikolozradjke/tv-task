<ul>
    <li>Install dependencies: <strong>composer install</strong></li>
    <li>Generate .env manually or run: <strong>cp .env.example .env</strong></li>
    <li>Generate a new application key: <strong>php artisan key:generate</strong></li>
    <li>Generate sqllite db file in /database directory: <strong>touch {project_directory}/database/database.sqlite</strong></li>
    <li>Run migration: <strong>php artisan migrate:fresh</strong></li>
    <li>Run seeder for default user (Optional): <strong>php artisan db:seed</strong></li>
    <li>
        <p>Generate passport Keys: <strong>php artisan passport:keys</strong></p>
        <p>Generate Grant type Client id and Client Secret: <strong>php artisan passport:client --password</strong></p>
        <p>Set them in .env as PASSPORT_CLIENT_ID and PASSPORT_CLIENT_SECRET</p>
    </li>
</ul>

# [Get API documentation](https://documenter.getpostman.com/view/23156310/2sAYX8Jgad)
