# PHP BASED OBJECT RELATIONAL MAPPING (ORM) PROFILING

Profile execution duration & memory consumption of PHP based ORM implementations.

Doctrine and Eloquent (name of ORM product) is chosen as sample since each of them implement Data Mapper and Active Record respectively.

There are three main parts: `App` directory, `Profiler` directory, and `profiler` file.

`App` directory contains ORM implementations. `Profiler` directory contains instrumentations that dictate how profiling process is done. `profiler` is a script that automate profiling process. The `profiler` script must be executed with `sudo` or admin privilege.

## Prequisite

Apache Server, PHP 8.2, MySQL, composer, xdebug, and git must be installed. For the convenience sake, Apache, PHP, and MySQL can be installed using [XAMPP](https://www.apachefriends.org/). For Composer, Xdebug, and git please visit their respective guide for installation: [Composer Installation Guide](https://getcomposer.org/download/), [Xdebug Installation Guide](https://xdebug.org/docs/install), [Git Installation Guide]().

## Installation

The commands that used in this section is intended to work in linux environment. For Windows or Mac, please use equivalent commands.

1. Clone the repository from github.com

```
git clone https://github.com/devmurean/orm-profiling
```

2. Open the directory and install required packages using composer

```
cd orm-profiling
composer install
```

3. Prepare a MySQL database
4. Copy `.env.example` dan rename it to `.env`

```
cp .env.example .env
```

5. Fill up the values in `.env`. The items is self explanatory or has explanation comment attached

## Profiling

### Single Iteration

```
sudo php profiler
```

### Multiple Iteration
```
sudo php profiler --n=10
```

## Profiling Result

Profiling results is automatically stored in `results` (default name). The results can be visualized using [KCachegrind](https://kcachegrind.github.io/html/Download.html) or similar tools.