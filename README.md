# Grandbuy

GrandBuy is a website where users can order products and wait for confirmation on their order.
There are two roles. The roles are a user role and an admin role.

The user will be able to create an account and order products and they will
receive confirmation in real time.

The admin will be able to create an account and create products for the users to view and order.
The admin will also take care of orders for the users. They can either accept an order or cancel an order. Whether they accept an order or cancel an order the user will receive a notification on the
status of their order in real time.

---
## Software I Used:
* Laravel
* VueJS
* Pusher
* Vuex
* TailwindCSS
---


## How To Use grandbuy.

1. Open A Command Line And Run
```
composer install &&
npm install &&
php artisan key:generate &&
php artisan migrate &&
php artisan db:seed --class=UserSeeder
```
---

2. Open A __Second__ Command Line And Run

```
php artisan serve --host 192.168.1.114
```
---

3. Open A __Third__ Command Line And Run

```
npm run watch
```
---

4. Open A __Forth__ Command Line and Run

```
php websockets:serve
```
---

___*Notes:*___

These are the dependency versions that worked for this project. So please be sure to have this (package.json).
```
"laravel-echo": "^1.10.0",
"pusher-js": "^4.3.1"

```