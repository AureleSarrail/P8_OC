List of Paths
=============

|Action|Path|
|------|----|
|[homepage](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/homepage.md)|/|
|[login](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/login.md)|/login|
|[login_check](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/login_check.md)|/login_check|
|[logout](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/logout.md)|/logout|
|[task_list](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/task_list)|/tasks|
|[task_create](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/task_create.md)|/tasks/create|
|[task_edit](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/task_edit.md)|/tasks/{id}/edit|
|[task_toggle](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/task_toggle.md)|/tasks/{id}/toggle|
|[task_delete](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/task_delete.md)|/tasks/{id}/delete|
|[user_list](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/user_list.md)|/users|
|[user_create](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/user_create.md)|/users/create|
|[user_edit](https://github.com/AureleSarrail/P8_OC/blob/master/Documentation/user_edit.md)|/users/{id}/edit|


Controllers
===========

Controllers are the first files called when a user click on your application.
If you want to add a new features, first you have to create a controller and give him a route to catch it.
Use the maker to create that controller : 
```
php bin\console make:controller
```

The new Controller will be created in __src/Controller__. This is where all controllers belong.

Symfony will create a route for him but feel free to change it to your own.
Routes look like this :
```
/**
 * @Route("/", name="homepage")
 */
public function indexAction()
```

First parameter for Route is the url that will be displayed.
Second is the name that will be used in your templates or code.

Entities
========

Entities are objects that represent database tables.
They are hydrated automatically when Doctrine do some request in database.

If you want to create a new entity, you can use the maker :
```
php bin\console make:entity
```

When your new Entity is created, you have to update your database.
To do that, you have to create and execute a migration file. That file will create some sql and doctrine will update your database with this file.

So first, generate the migration file : 
```
php bin\console make:migration
```

And now we can tell to Doctrine to update database : 
```
php bin\console doctrine:migrations:migrate
```
You are now ready to use your newly created Entity.

Repositories
============

Repositories are the tool used in symfony to request your database.
Every repository is linked to an Entity.
Ex : with the __Article__ Entity you'll have the __ArticleRepository__.

With repositories, you can use magical function that are already created lile __findAll()__.
You can also create your own request using the QueryBuilder in the repository file.

You can have more informations in the Documentation Here :
[Doctrine Documentation](https://symfony.com/doc/current/doctrine.html)

Forms
=====

In a symfony environnement, forms are managed differently than in a traditional php/html application.
Forms are a class that belong in the __src/Forms__ directory.

You can here personalize your forms.
Forms are created directly in you controller and passed to your template by those lines of code :
```php
$form = $this->createForm(YourForm::class, $user);

return $this->render('yourTemplate.twig', ['form' => $form->createView()]);
```
First line create a form according to what is described in the class.
Second line pass the form to your template.

Now you have to display your template, so in it you'll have :
```
{{form_start(form)}}
{{form_end(form)}}
```

That will display __all the elements__ that can be displayed.

If you want more details on how you can manage your forms go to Symfony Documentation :
[Forms Documentation](https://symfony.com/doc/current/forms.html)

Authentication and Users
========================

In this application, Authentication is managed with a login form and the Security Component of Symfony.

Users are stored in the database in a table __user__.

When a user want to login, he will fill the login form and his informations will be passed to the Security Component.
In order to tell to the Security Component when he will be called and what to do, some configuration is needed.

That configuration is in the file __config/packages/security.yaml__ :

```yaml
security:
    encoders:
        App\Entity\User: bcrypt

    providers:
        doctrine:
            entity:
                class: App:User
                property: username

    firewalls:

        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false

        main:
            anonymous: ~
            pattern: ^/
            form_login:
                login_path: login
                check_path: login_check
                always_use_default_target_path:  true
                default_target_path:  /
            logout: ~

    access_control:
        - { path: ^/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
```

__Encoders__ : that lines tell to Symfony to use the Bcrypt algorithm to hash passwords.
__Providers__ : Those lines tell to Symfony where to look for the user informations. Here it will be with the Class User and with the username attribute.
__FireWalls__ : Here you will create some rules to tell how symfony will react in different environnements. Here, check the lines under the main firewall, specifically in form_login.
That will indicate that the Security process is a login. the login_path indicate the Route Name where your form is. This is the most important.
Default_target_path is where users will be redirected after the security process.

Access_control is where you want to add some specifications for your urls. In this example, we tell to Symfony that the Url /login can be accessed by an Anonymous User.

Now with this configuration, the Security Component can take the form informations, check if those informations are correct in database and if a user is existing.
If all that is done, User informations are stored in Sessions and the User is authenticated.
