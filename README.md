## Telepítés
0. Ne felejtsük el lepullolni a laradock submodulet. (`git submodule init` aztán `git submodule update`)
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
_Fontos: Hiba esetén: php artisan migrate error segítség lent._
11. Töltsük fel az adatbázist előre generált adatokkal `php artisan db:seed`  
_Info: A generált admin felhasználó neve: `admin` jelszava: `password`._
12. Generáljuk le a publikus asseteket az `npm run dev paranccsal`

### php artisan migrate error segítség
* Mindenekelőtt győződjünk meg arról, hogy fut a mysql konténer a `docker ps paranccsal`.
* Ha már használtunk laradockot mysql adatbázissal, akkor az új adatbázist nem fogja létrehozni, és a root felhasználó adatai sem fognak megváltozni.
    * Készítsünk egy biztonsági mentést a laradock data/mysql mappájáról. Elérési út a `DATA_PATH_HOST` env változó értéke, alapvetően: `~/.laradock/data`.
    * Állítsuk le a docker konténereket a `docker-compose down` paranccsal.
    * Töröljük ki a mysql mappát.
    * Buildeljük újra a mysql konténert a `docker-compose build --no-cache mysql` paranccsal.

## Telepítési parancsok listája

```
cp env-example .env
cp .env.example .env
docker-compose up -d --build workspace nginx mysql
docker-compose exec workspace bash
composer install
npm install
php artisan key:generate
php artisan migrate
php artisan db:seed
npm run dev
```