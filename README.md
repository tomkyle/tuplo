# tuplo

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) [![Tests passing](https://github.com/tomkyle/tuplo/actions/workflows/php.yml/badge.svg)](https://github.com/tomkyle/tuplo/actions/workflows/php.yml)

**tuplo is a CLI upload tool. It can be configured with YAML files. Currently, these upload methods are supported:**

- FTP
- SFTP with username/password
- SFTP with SSH key

---

## Installation 

### Using Composer

Install *tuplo* as global command:

```bash
$ composer global require tomkyle/tuplo
```

Do not forget to make sure Composer’s global commands are available in `$PATH`:

```bash
# Unix, Linux, et al.
export PATH="/home/<Username>/.config/composer/vendor/bin:${PATH}"
# MacOS
export PATH="/Users/you/.composer/vendor/bin:${PATH}"
```

### Linux, Unix et.al.

Grab repo content and install dependencies. You may want to symlink it in your `~/bin` directory:

```bash
$ git clone git@github.com:tomkyle/tuplo.git
$ cd tuplo

# Symlink if needed
$ ln -s "${PWD}/bin/tuplo" ~/bin/tuplo
```

### MacOS

**To be done, I'm working on it.**

---

## Configuration

Upload configurations can be stored in a  `.tuplo.yaml` file, either in `$HOME` directory or in current work directory; with the latter preceding the first. See **[tuplo.dist.yaml](./tuplo.dist.yaml)** for examples – here an example for a plain old FTP upload. In this example, “typora” is the name of a single upload configuration, it is used as CLI parameter.

```yaml
typora:
	description : Just a plain FTP example
    method      : ftp
    downloadUrl : "https://test.com/typora"
    host        : 'ftp.test.com'
    port        : 21
    ssl         : false
    root        : 'path/to/typora'
    username    : 'ftp-username'
    password    : 'ftp-password'
```

---

## Usage

According to the above configuration sample, CLI usage goes like this. 

```bash
$ tuplo typora <file> [file] ...
```

---

## Development and testing

This repo contains **custom Git hooks** to automate *composer installs* after *composer.lock* has changed after *git pull*. Read more [here.](./git-hooks/README.md)

### Unit tests

Default configuration is **[phpunit.xml.dist](./phpunit.xml.dist).** If you like, create a custom **phpunit.xml** to apply your own settings. 
Also visit [phpunit.readthedocs.io](https://phpunit.readthedocs.io/) · [Packagist](https://packagist.org/packages/phpunit/phpunit)

```bash
$ composer phpunit
# ... or
$ vendor/bin/phpunit
```

### PhpStan

Default configuration is **[phpstan.neon.dist](./phpstan.neon.dist).** If you like, create a custom **phpstan.neon** to apply your own settings. 
Also visit [phpstan.org](https://phpstan.org/) · [GitHub](https://github.com/phpstan/phpstan) · [Packagist](https://packagist.org/packages/phpstan/phpstan)

```bash
$ composer phpstan
# ... which includes
$ vendor/bin/phpstan analyse
```

### PhpCS

Default configuration is **[.php-cs-fixer.dist.php](./.php-cs-fixer.dist.php).** If you like, create a custom **.php-cs-fixer.php** to apply your own settings. Also visit [cs.symfony.com](https://cs.symfony.com/) ·  [GitHub](https://github.com/FriendsOfPHP/PHP-CS-Fixer) · [Packagist](https://packagist.org/packages/friendsofphp/php-cs-fixer)

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



