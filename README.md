# ORM PROFILING

## Instalasi
1. Buka command prompt / terminal, pastikan memiliki hak akses sebagai admin / `sudo`
2. Kloning repository dari github.com
```
git clone https://github.com/devmurean/orm-profiling
```
3. Buka direktori dan lakukan instalasi melalui composer
```
cd orm-profiling
composer install
```
4. Siapkan database pada MySQL
5. Copy .env.example dan rename menjadi .env
6. Ganti value pada tiap item DB_* sesuai dengan pengaturan database

## Operasi
1. Untuk melakukan profiling durasi eksekusi, gunakan perintah
```
php profiler --db=orm_profiling --db_username=developer --db_password=developer --host=profiling.orm.test --n=100
```
2. Untuk profiling terhadap konsumsi memori, gunakan perintah
```
php profiler --db=orm_profiling --db_username=developer --db_password=developer --host=profiling.orm.test --n=1 --memory"

```
3. Untuk profiling menggunakan Xdebug
```
sudo php profiler --db=orm_profiling --db_username=developer --db_password=developer --host=profiling.orm.test --n=1 --xdebug="/etc/php/8.2/cli/conf.d/20-xdebug.ini"
```

## Profiling Report
Perintah dasar
```
php reader
```
Gunakan flag `--dir=memory` untuk mendapatkan report untuk konsumsi memori

Gunakan flag `--csv` untuk mendapatkan report dalam format CSV.