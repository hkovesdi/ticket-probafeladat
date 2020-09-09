## Telepítés (Docker-ral)
0. Ne felejtsük el lepullolni a laradock submodulet. (`git submodule update`)
1. Menjünk a laradock mappába és készítsük el a laradock `.env` fájlját a `cp env-example .env` commanddal.
2. Igény szerint állítsuk át a `MySQL` alá tartozó változókat az előbb készített `.env` fájlban.
3. Navigáljunk a projekt főmappájába majd készítsük el a laravel `.env` fájlját a `cp .env.example .env` paranccsal.
4. Állitsuk át a `MySQL` alá tartozó változókat a laradockos `.env` fájl alapján.

   ```
   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT= ugyanaz mint laradock .env-ben szereplő MYSQL_PORT
   DB_DATABASE= ugyanaz mint laradock .env-ben szereplő MYSQL_DATABASE változó
   DB_USERNAME= ugyanaz mint laradock .env-ben szereplő MYSQL_USER változó (vagy root, ha azzal szerepnénk belépni)
   DB_PASSWORD= ugyanaz mint laradock .env-ben szereplő MYSQL_PASSWORD, vagy ha root-tal léptünk be MYSQL_ROOT_PASSWORD változó
   ```
5. Navigáljunk a laradock mappába és indítsuk el a konténereket a `docker-compose up -d --build workspace nginx mysql` paranccsal.  
_Megjegyzés: Ez eltarthat 5-10 percig_
6. Basheljünk bele a workspace konténerbe a `docker-compose exec workspace bash` paranccsal.
7. Telepítsük fel a composer csomagokat a `composer install` paranccsal.
8. Telepítsük fel az npm csomagokat az `npm install` paranccsal.
9. Generáljuk le az application key-t a `php artisan key:generate` paranccsal.
10. Futtassuk le az adatbázis migrációkat a `php artisan migrate` paranccsal.  
_Fontos: Ha ezen parancs futása során hibát kapunk akkor elképzelhető, hogy manuálisan kell létrehoznunk az adatbázist. Bővebben erről lent._

## Telepítés (Docker nélkül)
0. Győződjünk meg róla, hogy minden laravelhez szükséges [előkövetelmény](https://laravel.com/docs/8.x/installation#server-requirements 'Laravel előkövetelmények') teljesül.
1. Készítsük el a laravel `.env` fájlját a `cp .env.example .env` paranccsal.
2. Állítsuk be a `.env` fájlban található környezeti változókat a nekünk megfelelő módon.
3. Telepítsük fel a composer csomagokat a `composer install` paranccsal.
4. Telepítsük fel az npm csomagokat az `npm install` paranccsal.
5. Generáljuk le az application key-t a `php artisan key:generate` paranccsal.
6. Futtassuk le az adatbázis migrációkat a `php artisan migrate` paranccsal.  
_Fontos: Ha ezen parancs futása során hibát kapunk, nézzük meg, hogy nem e írtunk el valamit a `.env` fájl DB-vel kezdődő változóiban_
7. Futtassuk le a következő parancsot a beépített dev server elindításához: `php artisan serve`
8. Az applikáció a `http://localhost:8000` címen fog futni.

## Telepítési parancsok listája

### Docker
```
cp env-example .env
cp .env.example .env
docker-compose up -d --build workspace nginx mysql
docker-compose exec workspace bash
composer install
npm install
php artisan key:generate
php artisan migrate
```

### Docker nélkül
```
cp .env.example .env
composer install
npm install
php artisan migrate
php artisan key:generate
php artisan serve
```

### php artisan migrate error segítség
* Mindenekelőtt győződjünk meg arról, hogy fut a mysql konténer a `docker ps paranccsal`.
* Ha nem találja az adatbázist, manuálisan kell létrehoznunk azt.
    0. Győződjünk meg róla, hogy a laravel `.env` fájlban szereplő `DB_DATABASE` változó értéke megegyezik a laradock .env fájljában szereplő `MYSQL_DATABASE` változóéval.
    1. Basheljünk a mysql konténerbe a `docker-compose exec mysql bash` paranccsal.
    2. Jelentkezzünk be rootként a `mysql -u root -p` paranccsal.
    3. Győződjünk meg róla, hogy tényleg nem létezik az adatbázis a `SHOW DATABASES;` paranccsal.
    4. Hozzuk létre a `.env` fájlban megadott adatbázist a `CREATE DATABASE adatbázisnév;` paranccsal.
    5. A 3. pontban szereplő utasítással győződjünk meg róla, hogy most tényleg létrehozta az adatbázist.
* Ha nem tud az adatbázisba bejelentezni
    0. Győződjünk meg arról, hogy a laraveles `.env` fájlban található `DB_USERNAME` és `DB_PASSWORD` változó megegyezik a laradock `.env` fájljában található `MYSQL_USER` és `MYSQL_PASSWORD` változó értékével. Ha rootként szeretnénk bejelentkezni akkor `DB_USERNAME`=root és a `DB_PASSWORD`= a laradockos `MYSQL_ROOT_PASSWORD` értékével.
    1. Basheljünk a mysql konténerbe a `docker-compose exec mysql bash` paranccsal.
    2. Próbáljunk meg bejelentkezni a `mysql -u felhasznalonev -p` paranccsal a `.env` fájlban szereplő adatok alapján.
        * Ha így működik akkor futtassuk le a workspace konténerben a `php artisan config:clear` parancsot.
* Ha semmi sem működik:
    0. Ellenőrizzük, hogy az előbbi pontokban található 0. lépésekben leírtak teljesülnek.
    1. Navigáljunk a saját gépünkön a laradock data mappájába. Alapból: `~/.laradock/data` helyen fogjuk ezt megtalálni.
    2. Készítsünk egy biztonsági mentést az itt található mysql mappáról.
    3. Töröljük ki a mappát.
    4. Buildeljük újra a mysql konténert a `docker-compose build mysql --no-cache` paranccsal.