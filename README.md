# SMH

1. Перейти в директорию проекта, выполнить в терминале "composer install".

2. Создать .env.local и скопировать в него содержимое файла .env.dev.

3. Создать docker/.env и скопировать в него содержимое файла docker/.env.dist.

4. Выполнить в терминале "make run_local" для первичной установки проекта (либо - "sudo make run_local").

5. Открыть терминал PHP контейнера (либо просто терминале), в нем выполнить миграции - "php bin/console doctrine:migrations:migrate".

6. В браузере перейти по ссылке - "http://localhost/main".