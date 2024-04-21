
# CRUD CODEIGNITER

a simple crud for stock werehouse


## Run Locally

Clone the project

```bash
  git clone https://github.com/rholanddeo/crud-ci.git
```

Go to the project directory

```bash
  cd crud-ci
```

Install dependencies

```bash
  composer install
```
Copy file `env` to `.env`

Generate Key

```bash
  php spark key:generate
```
Migration

```bash
  php spark migrate
```

or import file `db_ci_crud.sql` to your local database server manuali

Seeder (optional)

```bash
  php spark db:seed DatabaseSeeder
```

Start the server

```bash
  php spark serve
```

or type `crud-ci.test` right on browser url if you use laragon or herd


## Environment Variables

To run this project, you will need to add the following environment variables to your `.env` file

uncommand `CI_ENVIRONMENT = development`

uncommand `app.baseURL = ''` and add your base baseURL

if use php spark serve then `app.baseURL = 'http://localhost:8080'`

if use laragon or herd then `app.baseURL = 'http://crud-ci.test'`


uncommand:
```
database.default.hostname = localhost
database.default.database = db_ci_crud
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```
And Ready To Go
## Screenshots

Dashboard

![Dashboard-Front-Admin-Dashboard-Template-2](https://github.com/rholanddeo/crud-ci/assets/121206148/a9f3e927-c510-48bf-8137-67cfc28f8bf6)
# 
Barang

![image](https://github.com/rholanddeo/crud-ci/assets/121206148/2ad74674-68cf-4f07-b669-bf6048dcbac7)
#
Suplier

![image](https://github.com/rholanddeo/crud-ci/assets/121206148/8ba74463-2cae-4532-beb2-d6527169aa77)
#
Transaksi

![Dashboard-Front-Admin-Dashboard-Template](https://github.com/rholanddeo/crud-ci/assets/121206148/39c9790b-a4a3-41d8-9716-c95dd64bdbca)
#
Detail Transaksi

![image](https://github.com/rholanddeo/crud-ci/assets/121206148/94dfc214-075c-46bd-bb0e-3b3f876c7062)
#
Hutang

![image](https://github.com/rholanddeo/crud-ci/assets/121206148/83815153-0211-4592-9cc6-34837ec4202b)
