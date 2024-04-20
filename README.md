
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

or use `crud-ci.test` right on browser if you use laragon or herd

