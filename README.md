# Opossum CMS

## Get Started

### Requirements

* PHP >= 7.4 && < 8.0
* [Apache][1] Web Server with [mod_rewrite][2] enabled or [Nginx][3] Web Server
* Latest stable [Phalcon Framework release][4] extension enabled
* [MySQL][5] >= 8.0 or [MariaDB][6] >= 10.3

### Installation

1. Create OCMS project: `composer create-project ocms/ocms-core` or
2. Get OCMS source code: `git clone https://github.com/olegiv/Ocms.git && composer install`
3. Create configuration file: `cp .env.example .env`
4. Create database and database user account.
5. Edit configuration file (.env) by updating your DB connection (from the previous item) and paths information
6. Create database schema and initial data by running DB migrations `vendor/bin/phalcon-migrations run --config=install/migrations.config.php`
7. Set web server document root to html directory.

[1]: https://httpd.apache.org/
[2]: https://httpd.apache.org/docs/current/mod/mod_rewrite.html
[3]: https://nginx.org/
[4]: https://github.com/phalcon/cphalcon/releases
[5]: https://www.mysql.com/
[6]: https://mariadb.org/
