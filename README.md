# Opossum CMS

## Get Started

### Requirements

* PHP = 7.4
* [Apache][1] Web Server with [mod_rewrite][2] enabled or [Nginx][3] Web Server
* Latest stable [Phalcon Framework release][4] extension enabled
* [MySQL][5] >= 5.5

### Installation

1. Copy project to local environment - `git clone git@github.com:oiv/ocms.git`
2. Copy file `cp .env.example .env`
3. Edit .env file with your DB connection and paths information
4. Install database by running DB migrations `vendor/bin/phalcon-migrations run --config=install/migrations.config.php`

[1]: http://httpd.apache.org/
[2]: http://httpd.apache.org/docs/current/mod/mod_rewrite.html
[3]: http://nginx.org/
[4]: https://github.com/phalcon/cphalcon/releases
[5]: https://www.mysql.com/
