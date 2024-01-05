# RXP: Drupal assignment.

## Purpose
Integrating tools such as:
* Dependency management with Composer
* Build process on Circle CI
* Deploy to pantheon

## Local development

### Project Requirements
* [Lando](https://lando.dev/download/)
* [Composer](https://getcomposer.org/download/)

### Project Setup
* `git clone git@github.com:ffw-chuyen-luu/rxp-drupal.git rxp-drupal`
* `cd rxp-drupal`
* `lando start`
* `lando composer install` to install dependencies and base config
* `lando fresh_install --site={sitename}` to fresh install site, replace `{sitename}` as `s1`, `s2` or `s3`
* Point your browser to: `https://{sitename}.rxp.lndo.site`
* Create a new site `lando create_new_site --site={sitename}` and follow to manual steps
