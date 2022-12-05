# Cloud Storage API

## Demo ip : 188.68.220.78

## Postman

See the postman collection [here](https://github.com/Leonid-lab/laravel-storage-api/blob/master/New%20Collection.postman_collection.json).


## How to start the service locally


```sh
git clone https://github.com/Leonid-lab/laravel-storage-api
cd laravel-storage-api

cp .env.example .env

# https://laravel.com/docs/9.x/sail#installing-composer-dependencies-for-existing-projects
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

./vendor/bin/sail up -d

./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate:fresh
```
## If you have issues with the permissions, then you can try the next solutions:
1. With user root:root . You try with command :
```sh

sudo chmod -R 777 storage/
```

2. With user www-data:www-data . You try with command :
```sh
sudo chown -R www-data:www-data storage/

sudo chmod -R 755 storage/
```

3.If you use Docker . You try with command :
```sh
sudo chown -R nginx:nginx storage/

sudo chmod -R 755 storage/
```
Also if there're some problems with migration, you can set DB_HOST=mysql in .env file

## API Routes

### Authentication

+ `/api/auth/register` - `POST` - user registers on platform and gets token for using storage.

Supported attributes:

| Attribute                | Type     | Required |
|:-------------------------|:---------|:---------|
| `name`                   | string  | Yes      | 
| `email`              | string | Yes       | 
| `password`              | string | Yes       | 

+ `/api/auth/login` - `POST` - user loginning

Supported attributes:

| Attribute                | Type     | Required |
|:-------------------------|:---------|:---------|
| `email`              | string | Yes       | 
| `password`              | string | Yes       | 


+ `/api/auth/logout` - `GET` - user logout

### Storage

You may add name of directory in {dirname} field to manage file located in this directory. 


+ `/api/file/{dirname?}` - `POST` - `uploading a file.`

Supported attributes:

| Attribute                | Type     | Required |
|:-------------------------|:---------|:---------|
| `file`                   | file     | Yes      | 
| `expires_in`             | int      | No       | 

+ `/api/file/{dirname?}/{name}` - `GET` - get file with specified name.
+ `/api/file/{dirname?}/{name}` - `PUT` - rename file with specified name ( `NewName` required | string type ).
+ `/api/file/{dirname?}/{name}` - `POST` - delete file with specified name.
+ `/api/file/publish/{dirname?}/{name}` - `POST` - publish file with specified name and get public link on file which can be used instead of attribute `name` in `GET` method of file.
+ `/file/list` - `GET` - get list of all files contained in user storage.

### Working with directories

+ `/api/directory/create` - `POST` - create new directory in user storage.

Supported attributes:

| Attribute                | Type     | Required |
|:-------------------------|:---------|:---------|
| `dirname`                   | string     | Yes      | 

+ `/api/directory/size/{dirname?}` - `GET` - get size of storage when no `dirname` attribute given otherwise get size of specifed directory.

### User information

+ `/api/user/info` - `GET` - get basic information about current user.

