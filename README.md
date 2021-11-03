# DevTalks - App 1
Applicazione demo usabile per i DevTalks e come base per esperimenti didattici

## Prerequisiti
- PHP 7.4+
- estensione PHP XML
- estensione PHP Zip
- estensione PHP curl
- estensione PHP MBSTRING
- [composer](https://getcomposer.org/)
- [Symfony](https://symfony.com/download)
- [nvm](https://github.com/nvm-sh/nvm)

NOTA: l'installazione dei prerequisiti dipende dal sistema operativo o dalla distribuzione specifica utilizzata

NOTA: dopo aver installato Symfony accertarsi che il comando sia disponibile globalmente. Controllare bene il testo di output al momento dell'installazione.

### Clonare il repository
```shell
git clone https://github.com/slope-it/devtalks-app-1.git
```
e spostarsi all'interno della cartella `devtalks-app-1`

### Installare dipendenze
```shell
composer install
nvm use
npm install
```

### Generare bundle frontend
```shell
npm run dev
```

### Servire App
```shell
symfony serve --port=8080
```
L'app è accessibile all'indirizzo: http://127.0.0.1:8080

### Eseguire i test

#### Linting
```shell
php vendor/bin/phpcs
php vendor/bin/phpstan analyse -l 6 -c phpstan.neon src tests
```
Il primo comando esegue il processo di linting con [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) secondo la configurazione definita nel file `phpcs.xml`.
Il secondo comando esegue ulteriori controlli sul codice tramite [PHPStan](https://phpstan.org/user-guide/getting-started)

#### Test unitari
```shell
php vendor/bin/phpunit --testsuite Unit
```

#### Test d'integrazione
```shell
php vendor/bin/phpunit --testsuite Integration
```

#### Test funzionali
Prima di eseguire i test funzionali è necessario verificare il supporto al web driver (è sufficiente farlo solo la prima volta).
```shell
php vendor/bin/bdi detect drivers
```

```shell
php vendor/bin/phpunit --testsuite Functional
```
