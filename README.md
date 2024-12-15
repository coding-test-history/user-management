
## Tech Stack

**Language:** PHP 8.3

**Framework:** Laravel 11

**Database:** MySQL | PostgreSQL
## Features

 - Login
 - Registrasi Pengguna
 - Logout
 - Manajemen Pengguna yang terdiri dari 
    - User
    - Role
    - Menu 
    - Permission
## Installation
clone repositories to your local machine
```bash
  git clone https://github.com/coding-test-history/user-management.git
```
install dependencies
```bash
  composer install
  npm install && npm run build
```
run migration
```bash
  php artisan migrate
```
run seeder
```bash
  php artisan db:seeder --class=DatabaseSeeder
```

## Run Locally

run the following command
```bash
    composer run dev
```
## Demo

- Email : user1@mail.com | user2@mail.com | user3@mail.com | user4@mail.com | user5@mail.com
- Password : password
## API Reference

### User
#### 1. Retrieve a list of all users.
```http
  GET /api/user/list
```

#### 2. Retrieve details of a specific user.
```http
  GET /api/user/list/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

#### 3. Create a new user.
```http
  POST /api/user/list/post
```
| Request Body.   | Type     | Description  |
| :---------------| :------- | :------------|
| `name`          | `string` | **Required**.|
| `email`         | `string` | **Required**.|
| `password`      | `string` | **Required**.|
| `role_id`       | `integer`| **Required**.|

#### 4. Update an existing user.
```http
  PUT /api/user/list/update/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

| Request Body.   | Type     | Description  |
| :---------------| :------- | :------------|
| `name`          | `string` | **Required**.|
| `email`         | `string` | **Required**.|
| `role_id`       | `integer`| **Required**.|

#### 5. Delete an user.
```http
  DELETE /api/user/list/delete/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

### Role and Permission
#### 1. Retrieve a list of all roles and permission.
```http
  GET /api/user/role-permission
```

#### 2. Retrieve details of a specific role and permission.
```http
  GET /api/user/role-permission/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

#### 3. Create a new role and permission.
```http
  POST /api/user/role-permission/post
```
| Request Body.   | Type     | Description  |
| :---------------| :------- | :------------|
| `role_name`     | `string` | **Required**.|
| `menu_id[]`     | `string` | **Required** array format.|

#### 4. Update an existing role and permission.
```http
  PUT /api/user/role-permission/update/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

| Request Body.   | Type     | Description  |
| :---------------| :------- | :------------|
| `role_name`     | `string` | **Required**.|
| `menu_id[]`     | `string` | **Required** array format.|

#### 5. Delete an user.
```http
  DELETE /api/user/role-permission/delete/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

### Menu
#### 1. Retrieve a list of all menus.
```http
  GET /api/user/menu
```

#### 2. Retrieve details of a specific menus.
```http
  GET /api/user/menu/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

#### 3. Create a new menu.
```http
  POST /api/user/menu/post
```
| Request Body.   | Type     | Description  |
| :---------------| :------- | :------------|
| `menu_name`     | `string` | **Required**.|
| `route`         | `string` | **Required**.|
| `parent_menu_id`| `string` | **Required**.|

#### 4. Update an existing menu.
```http
  PUT /api/user/menu/update/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|

| Request Body.   | Type     | Description  |
| :---------------| :------- | :------------|
| `menu_name`     | `string` | **Required**.|
| `route`         | `string` | **Required**.|
| `parent_menu_id`| `string` | **Required**.|

#### 5. Delete an menu.
```http
  DELETE /api/user/menu/delete/{id}
```
| Parameter | Type     | Description. |
| :-------- | :------- | :------------|
| `id`      | `int`    | **Required**.|