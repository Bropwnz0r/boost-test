DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      services/           contains services files
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.6.0.


INSTALLATION
------------

### Install with Docker

Run install.bat

    install.bat
    
Or run 

    docker-compose up -d    
    
And

    docker exec -u root -i -w /var/www/boost-test boost_test composer install --prefer-source --no-interaction

    
You can then access the application through the following URL:

    http://127.0.0.1:8000

**NOTES:** 
- Minimum required Docker engine version `17.04` for development (see [Performance tuning for volume mounts](https://docs.docker.com/docker-for-mac/osxfs-caching/))
- The default configuration uses a host-volume in your home directory `.docker-composer` for composer caches


Test Boos
-------------

Спроектувати просту форму, яка може приймати як поля (title, description, author)
так і можливість завантажити ці данні через файли в 3-х форматах(json, csv, yaml).


Уточнення:
1) Данні отримані з форми, мають зберігатись в SQLite(або файл) в ангалогічному форматі де є title, description, author.
2) Треба мати сторінку, на які можна проглянути додані через форму данні (прсто список з інформацією)
3) Можна використовувати будь які бібліотеки (як через compose так і просто додані в код)

Не обов’язкове:
- пагінація на сторінці /list.php
- розгорнути стек на docker

Test Resolve
-------------
Files:
   - services (parser for files) - опущено много моментов по парсерам (структура файлов не была озвучена.)
   - Controller (SiteController) Форма actionIndex, Список actionList
   - Models NewsForm (Работа с формой и загрузка данных после валидации), News (AR - БД);