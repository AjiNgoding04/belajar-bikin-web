# BELAJAR LARAVEL DASAR

## 1. SETUP

hal yang perlu dipersiapkan adalah:

a. Download PHP

linux:
```bash
sudo add-apt-repository ppa:ondrej/php

sudo apt install php8.1
 ```

windows:

Download xampp dengan mengklik link di bawah:

https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/8.2.12/xampp-windows-x64-8.2.12-0-VS16-installer.exe

b. Download Composer

linux:

```bash 
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'.PHP_EOL; } else { echo 'Installer corrupt'.PHP_EOL; unlink('composer-setup.php'); exit(1); }"
php composer-setup.php
php -r "unlink('composer-setup.php');"

sudo mv composer.phar /usr/local/bin/composer
```

windows:

Download composer versi binary dengan mengklik:

https://getcomposer.org/Composer-Setup.exe

## 2. Membuat Projek dan Menjalankan

1. Buat direktori projek dengan printah berikut pada linux:
```bash
mkdir <nama-folder>
cd <nama-folder>
```
2. kemudian buat projek dengan perintah:
```bash
composer create-project laravel/laravel=<nomor-versi> <nama-projek>
```
3. jalankan laravel dengan 3 cara:

    a. Web Server:
    
    Jalankan folder public dengan akses folder htdocs pada server apache xampp atau www pada server nginx.

    b. FrankenPHP:

    jika kita ingin menjalankan dengan runtime FrankenPHP kita dapat menggunakan octane, yang mana octane hanya dapat untuk laravel versi ^11.*, jika versi kita menggunakan versi laravel yang ada sedikit configurasi yang harus dilakukan.
    
    1. Tambahkan kode berikut pada file bootstrap/app.php:

     ```php
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
    $app = new Illuminate\Foundation\Application(
        $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
    );
     ```
    2. Tambahkan tanda ? pada type parameter _callback_ di vendor/laravel/src/illuminate/helpers.php pada fungsi optional dan with:

    ```php
    function optional($value = null, ?callable $callback = null)
    {
        if (is_null($callback)) {
            return new Optional($value);
        } elseif (! is_null($value)) {
            return $callback($value);
        }
    }
    ```
    
    ```php
    function with($value, ?callable $callback = null)
    {
        return is_null($callback) ? $value : $callback($value);
    }
    ```
    kemudian buat file caddyfile untuk menjalankan laravel di folder projek
    
    Caddyfile:

    ```caddyfile
    { 
        frankenphp
    }
    :8080 {
        root * /var/lib/<dir_projek>/<nama_projek>/public
        php_server
    }
    ```
    terakhir jalankan printah berikut 

    ```bash
    sudo frankenphp run --config Caddyfile --adapter caddyfile
    ```
    kemudian buka http://localhost:8080.

    c. Menggunakan php artisan

    laravel juga menyediakan server sendiri yang bernaman artisan kita dapat menjalankannya dengan cara membuka terminal pada direktori projek kemudian mengetikkan printah pada terminal:

    ```bash
    php artisan serve
    ```
    kemudian akses http://127.0.0.1:8000 pada browser.