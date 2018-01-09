# Apiary

I make [apiary](https://github.com/prilandini/Apiary/blob/master/blueprints/allRoot.apib) about endpoint [REST API](https://jsonplaceholder.typicode.com/). There are six endpoint with method **GET, **POST**, **PUT**, **PATCH**, and **DELETE** in each endpoint. But I didn't make Patch method, I just use Put. Below its endpoints list with methods.

1. /posts
    - GET	    /posts
    - GET	    /posts/1
    - GET	    /posts/1/comments
    - GET	    /posts?userId=1
    - POST	    /posts
    - PUT	    /posts/1
    - DELETE	/posts/1

2. /comments
    - GET	    /comments
    - GET	    /comments/1
    - GET	    /comments?postId=1
    - POST	    /comments
    - PUT	    /comments/1
    - DELETE	/comments/1

3. /albums
    - GET	    /albums
    - GET	    /albums/1
    - POST	    /albums
    - PUT	    /albums/1
    - DELETE	/albums/1

4. /photos
    - GET	    /photos
    - GET	    /photos/1
    - POST	    /photos
    - PUT	    /photos/1
    - DELETE	/photos/1

5. /todos
    - GET	    /todos
    - GET	    /todos/1
    - POST	    /todos
    - PUT	    /todos/1
    - DELETE	/todos/1

6. /users
    - GET	    /users
    - GET	    /users/1
    - POST	    /users
    - PUT	    /users/1
    - DELETE	/users/1

After that, I implemented the apiary in this project with framework laravel and database mysql. 

# How it works

You can clone this repo with ``git clone git@github.com:prilandini/Apiary.git`` or download, and then install ``composer install`` in the folder. After that there are some commands before use this project, like setup the databases, generate key in file ``.env``, migrate the tables and also seeders, and the last is make oauth for authentications. This project use [Oauth2](https://laravel.com/docs/5.5/passport#deploying-passport). Here is a more detailed explanation.

## Set Up Databases

You can setup your database in file ``.env`` with the name database, username, and password your databases.

## Generate Key

After you install laravel application, you need ``application key``. To get it you can run ``php artisan key:generate`` and input the key in ``APP_KEY`` there are in file ``.env``. If you run the server, you should to refresh it after input or change application key.

## Migration

You can do migration by ``php artisan migrate`` to input tables in you database.

## Seeder

I make example of the data in each tables, you can run ``php artisan db:seed`` to do seeder.

## Make Oauth

But to access the data, we need authentication. I've done some preparation to build Oauth, you just to run ``php artisan passport:install`` to get client id and client secret. After that you can request an access token by issuing a ``POST`` request to the ``/oauth/token`` route with email as username and password user. Use client id 2, because client id 1 is for a *personal access client*. Do as below.
```
{
	"grant_type": "password",
	"client_id": "2",
    "client_secret": "wnA9M6SCgDHm2ongk46MX1F7ChUSgxqfpCrIbnTA",
    "username": "pril@gmail.com",
    "password": "pril44",
    "scope": ""
}
```
Or if you need some referensi, you can to go in [laravel documentation](https://laravel.com/docs/5.5/passport#password-grant-tokens).


If you have done get token, you can use it in headers with the key ``authentication`` and the value ``Bearer <your token>``. 

## Run the Server

Run ``php artisan serve`` to run the server.

I make endpoint to test it ``/test``. If it success to authorization you will get a request ``Hello``. After that, you can use the token to access all endpoint.

