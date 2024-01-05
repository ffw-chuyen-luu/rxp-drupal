#!/usr/bin/env bash

set -e

# Prepare system variables
red='\033[0;91m'
green='\033[0;32m'
green_bg='\033[42m'
yellow='\033[1;33m'
yellow_gold='\033[0;33m'
NC='\033[0m'

SITE=''
while (( "$#" )); do
  case "$1" in
    --site=*)
      if [ "${1##--site=}" != "$1" ]; then
        SITE="${1##--site=}"
        shift
      else
        SITE=$2
        shift 2
      fi
      ;;
    --surprise)
      echo "MUHAHAH! You've found a non explicitly declared option for this script which is going to give you an error!"
      exit 666
      ;;
    --)
      shift
      break
      ;;
    -*|--*=)
      echo "Error: Unsupported flag $1" >&2
      exit 1
      ;;
    *)
      shift
      ;;
  esac
done

if [[ "${SITE}" == "" ]]
then
  echo -e "${red} --site parameter is required!${NC}"
  exit 777
fi

SITE_SUBDIR=$SITE.rxp

if [ -d "/app/web/sites/$SITE_SUBDIR" ]; then
  echo -e "${red} ${SITE} already exists!${NC}"
  exit 888
fi

mkdir -p /app/web/sites/$SITE_SUBDIR
cp scripts/example.settings.php web/sites/$SITE_SUBDIR/settings.php
cp scripts/example.settings.config.php web/sites/$SITE_SUBDIR/settings.config.php
cp scripts/example.settings.local.php web/sites/$SITE_SUBDIR/settings.local.php

sed -i "s/{sitename}/${SITE}/" /app/web/sites/$SITE_SUBDIR/settings.config.php

echo -e "
Manual steps:

1. Add the ${green_bg}db${SITE}${NC} service under the ${green_bg}services${NC} section in ${green_bg}.lando.yml${NC}

${green}db{sitename}:
  type: mariadb
  creds:
    database: db{sitename}
    user: drupal10
    password: drupal10${NC}

2. Add the ${green_bg}${SITE}.rxp.lndo.site${NC} domain to the ${green_bg}proxy${NC} > ${green_bg}appserver${NC} section in ${green_bg}.lando.yml${NC}

3. Add the site Drush alias under in ${green_bg}drush/sites/self.site.yml${NC}

${green}{sitename}:
  root: /var/www/web
  uri: https://{sitename}.rxp.lndo.site${NC}

4. Add the site Drupal multi-sites alias in ${green_bg}web/sites/sites.php${NC}.

${green}\$sites['{sitename}.rxp.lndo.site'] = '{sitename}.rxp';${NC}

5. Apply new configuration with ${green_bg}lando rebuild -y${NC}

6. Install site with ${green_bg}lando fresh_install --site=${SITE}${NC}
" | sed -e "s/{sitename}/${SITE}/g"
