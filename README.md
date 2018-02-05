# DM WordPress Layout

This is the WordPress layout we use at [Delicious Media](https://www.deliciousmedia.co.uk/) as a starting point for most of our projects.

It has been tested with WordPress 4.9+ and is written for PHP 7.x.

## Overview

- `wp-config.php` is in the root directory along with `local-config.php` file which holds environmet specific information such as database credentials and salts.
- WordPress iteself is installed in `/wp/` for neatness.
- The WordPress content folder is `/content/` (rather than wp-content) the themes, plugins and mu-plugins folder live here.
- The WordPress uploads folder is stored in `/shared/content/uploads/` and symlinked from `/content/uploads/`. Similarly a static folder in `/shared/content/static/` is symlinked to from `/static/`. This allows easy backups/synchronistion between multiple servers.

## Other packages

A composer.json file in the root will include the following:

- [DM-EI](https://github.com/DeliciousMedia/DM-EI) - Adds a node to the admin bar to indicate which environment you are in (dev/staging/live).
- [DM-MuLoader](https://github.com/DeliciousMedia/DM-MuLoader) - Automagically includes plugins from subdirectories under the mu-plugins folder.
- [Plugin Control](https://github.com/DeliciousMedia/Plugin-Control) - Force enable/disable plugins progmatically.
- [CMB2](https://github.com/CMB2/CMB2) - Custom Meta Boxes 2.
- [Extended CPTs](https://github.com/johnbillion/extended-cpts) - Configure custom post types & taxonomies with less code.
- [DM Customisations](https://github.com/DeliciousMedia/DM-Customisations) - Customisations to WP to suit our projects.
- [Mailgun](https://en-gb.wordpress.org/plugins/mailgun/) - A plugin to allow sending email via the Mailgun transactional SMTP service.

If you are going to use Composer to bring in the extra components, you'll also need [composer-wp](https://github.com/balbuf/composer-wp) available - you can install it with `composer global require balbuf/composer-wp`.

## Installation

### Via our VVV provisioning script

The best way to setup a project with this layout is to use [VVV our provisioning script](https://github.com/DeliciousMedia/DM-VVV2-Provision-Basic) which will setup a new [VVV](https://varyingvagrantvagrants.org/) site using this WordPress layout along with our [starter theme](https://github.com/DeliciousMedia/DM-Base-Theme) and various other customisations.

### Manually

You can set one up manually by cloning this repository, copying `local-config-sample.php` to `local-config.php` and editing the relevant settings there. You'll also need to create the "shared" folders with `mkdir -p shared/content/uploads && mkdir -p shared/content/static` and install the WordPress core files with `wp core download` (to avoid leaving any redundant code on your site, also remove the /wp/wp-content/ folder). Run a `composer update` and copy the `dm-muloader.php` file from `mu-plugins/dm-muloader` to the `mu-plugins` folder as per the [DM-MuLoader](https://github.com/DeliciousMedia/DM-MuLoader) installation instructions..

---
Built by the team at [Delicious Media](https://www.deliciousmedia.co.uk/), a specialist WordPress development agency based in Sheffield, UK.