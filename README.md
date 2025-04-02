# SMH

1. Создать .env и скопировать в него содержимое файла .env.dev.

2. Создать docker/.env и скопировать в него содержимое файла docker/.env.dist.

3. Перейти в директорию проекта, выполнить в терминале "composer install".

4. Выполнить в терминале "make run_local" для первичной установки проекта (либо - "sudo make run_local").

5. Подключиться к базе с данными из файла .env (DATABASE_URL).

6. Открыть терминал PHP контейнера, в нем выполнить миграции - "php bin/console doctrine:migrations:migrate".

7. В браузере перейти по ссылке - "http://localhost/main".