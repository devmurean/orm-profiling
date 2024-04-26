# PHP BASED OBJECT RELATIONAL MAPPING (ORM) PROFILING

Profile execution duration & memory consumption of PHP based ORM implementations.

Doctrine and Eloquent (name of ORM product) is chosen as sample since each of them implement Data Mapper and Active Record respectively.

There are three main parts: `App` directory, `Profiler` directory, and `profiler` file.

`App` directory contains ORM implementations. `Profiler` directory contains instrumentations that dictate how profiling process is done. `profiler` file acted as command line interface.

## Prequisite

Apache Server, PHP 8.2, MySQL, composer, xdebug, and git must be installed. For the convenience sake, Apache, PHP, and MySQL can be installed using [XAMPP](https://www.apachefriends.org/). For Composer, Xdebug, and git please visit their respective guide for installation: [Composer Installation Guide](https://getcomposer.org/download/), [Xdebug Installation Guide](https://xdebug.org/docs/install), [Git Installation Guide]().

## Installation

The commands that used in this section is intended to work in linux environment. For Windows and Mac, please use equivalent commands.

1. Clone the repository from github.com

```
git clone https://github.com/devmurean/orm-profiling
```

2. Open the directory and install required packages using componser

```
cd orm-profiling
composer install
```

3. Prepare a MySQL database
4. Copy .env.example dan rename it to .env

```
cp .env.example .env
```

5. Fill up the values in `.env`. The items is self explanatory or has explanation comment attached
6. `XDEBUG_CONFIG_PATH` can be different depends on OS.

## Profiling

### Help

```
php profiler --help
```

### Execution Duration

```
sudo php profiler --n=10
```

### Memory Consumption

```
sudo php profiler --n=10 --memory"
```

### Xdebug

```
sudo php profiler --n=1 --xdebug"
```

## Profiling Report

Report is automatically stored in `reports` directory as CSV and also displayed in monitor. Report only be generated for execution duration and memory consumption profiling. For Xdebug, its results can be visualized using KCachegrind or related tools.
