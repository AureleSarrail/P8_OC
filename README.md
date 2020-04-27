[![Maintainability](https://api.codeclimate.com/v1/badges/a9aa22b3b12014157a83/maintainability)](https://codeclimate.com/github/AureleSarrail/P8_OC/maintainability)

ToDoList
========

Base du projet #8 : Améliorez un projet existant

https://openclassrooms.com/projects/ameliorer-un-projet-existant-1

Install Guide :
==============

First you can clone this project or download it from this github.

When the project is cloned, you must install it by running this command : 

```
composer install
```

After that, you want to create the database. Go to files __.env__ and enter your databse informations.
When it's done, you can run those commands :
```
php bin\console doctine:database:create
php bin\console doctrine:migrations:migrate
```

After all that, you're ready to use application.
