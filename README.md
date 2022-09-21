# tuplo

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

**tuplo is a CLI upload tool. It can be configured with YAML files. Currently, these upload methods are supported:**

- FTP
- SFTP with username/password
- SFTP with SSH key

## Installation 

Grab repo content and install dependencies. You may want to symlink it in your `~/bin` directory:

```bash
$ git clone git@github.com:tomkyle/tuplo.git
$ cd tuplo
$ composer install

# Symlink if needed
$ ln -s "${PWD}/bin/tuplo" ~/bin/tuplo
```

## Configuration

Upload configurations can be stored in a  `.tuplo.yaml` file, either in `$HOME` directory or in current work directory; with the latter preceding the first. See **[tuplo.dist.yaml](./tuplo.dist.yaml)** for examples – here an example for a plain old FTP upload. “typora” is the name of a single upload configuration, it is used as CLI parameter.

```yaml
typora:
    method      : ftp
    downloadUrl : "https://test.com/typora"
    host        : 'ftp.test.com'
    port        : 21
    ssl         : false
    root        : 'path/to/typora'
    username    : 'ftp-username'
    password    : 'ftp-password'
```

## Usage

According to the above configuration sample, CLI usage goes like this. 

```bash
$ tuplo typora <file> [file] ...
```


## Development and testing

### Unit tests

Default configuration is **[phpunit.xml.dist](./phpunit.xml.dist).** Create a custom **phpunit.xml** to apply your own settings. 
Also visit [phpunit.readthedocs.io](https://phpunit.readthedocs.io/) · [Packagist](https://packagist.org/packages/phpunit/phpunit)

```bash
$ composer phpunit
# ... or
$ vendor/bin/phpunit
```

### PhpStan

Default configuration is **[phpstan.neon.dist](./phpstan.neon.dist).** Create a custom **phpstan.neon** to apply your own settings. 
Also visit [phpstan.org](https://phpstan.org/) · [GitHub](https://github.com/phpstan/phpstan) · [Packagist](https://packagist.org/packages/phpstan/phpstan)

```bash
$ composer phpstan
# ... which includes
$ vendor/bin/phpstan analyse
```

### PhpCS

Default configuration is **[.php-cs-fixer.dist.php](./.php-cs-fixer.dist.php).** Create a custom **.php-cs-fixer.php** to apply your own settings. 
Also visit [cs.symfony.com](https://cs.symfony.com/) ·  [GitHub](https://github.com/FriendsOfPHP/PHP-CS-Fixer) · [Packagist](https://packagist.org/packages/friendsofphp/php-cs-fixer)

```bash
$ composer phpcs
# ... which aliases
$ vendor/bin/php-cs-fixer fix --verbose --diff --dry-run
```

Apply all CS fixes:

```bash
$ composer phpcs:apply
# ... which aliases 
$ vendor/bin/php-cs-fixer fix --verbose --diff
```



