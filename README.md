
# Online Store

RestfulAPI for Managing Items in Cart

### Setup Instructions

* `git`, `php`, `mysql` and `composer` are required as prerequisites.
* clone the repository in a folder, use
```
git clone https://github.com/ikjotKaur/OnlineStore.git
```
* change directory to the project directory
```
cd OnlineStore
```
* run command to dump the mysql database
```
mysql -u<your-username> -p<your-password> < sql/dump.sql

 In file config/database.php add your username and password for mysql
```
* run composer autoloader command to autoload classes
```
composer dump-autoload

in case you get error composer not found run following two commands before it
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

```
* replace database configurations in `config/database.php` file
* run command to start the server on localhost listening to 8000 port
```
php -S localhost:8000 index.php
```


### List of RestfulAPI methods

TEST USERNAME  :admin
TEST PASSWORD  :admin


| paths | params | methods | description  | response
|---|---|---|---|---|
| `/login` | username, password | POST | authenticate user | {"status":true,"message":"Already LoggedIn"} |
| `/item`  |  | GET | lists all the items | {"items":[{"itemId":"2","itemName":"Book1","price":"200"}]}
| `/item/{id}` | itemId | GET | shows details of item of given itemId | {"item":{"itemId":"3","itemName":"Book2","price":"3000"}} |
| `/item` | price, itemName | POST | adds a new item | {"item":{"itemName":"Book2","price":"3000","itemId":"3"}} |
| `/item/{id}` | itemId | POST | updates existing details of item |  {"item":{"itemId":"6","itemName":" Updated Book","price":"500"}} |
| `/item/{id}` | | DELETE | deletes a specific item | { "status": true } |


here is [link to postman][] for more details


[link to postman]: https://www.getpostman.com/collections/3a118cb196e1e2cd6f5e
