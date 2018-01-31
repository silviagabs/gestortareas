<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Basic Project Template</h1>
    <br>
</p>

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources




INSTALLATION
------------

### Install via Composer

EJECUTA ESTE COMANDO:
~~~
composer create-project silviagabs/gestortareas carpeta
~~~

Donde pone carpeta pon el nombre con el que quieras identificar la carpeta de
este proyecto.



CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
Se adjunta un backup y un sql de la bd utilizada. Se llama gestortareas y está en la
carpeta data.
La bd tiene 4 usuarios creados que son los que sirven de ejemplo en la aplicación:
USERNAME * PASSWORD 
    root * root
   user1 * user1
   user2 * user2
   user3 * user3


Una vez descargado, EJECUTA ESTE COMANDO:

~~~
composer update
~~~
