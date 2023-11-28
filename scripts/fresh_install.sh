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

SITE_ALIAS=@self.$SITE
SITE_SUBDIR=$SITE.rxp
SITE_DB=db$SITE

if [ ! -d "/app/web/sites/$SITE_SUBDIR" ]; then
  echo -e "${red} ${SITE_SUBDIR} subfolder is not found in the sites folder!${NC}"
  exit 888
fi

echo "Start fresh install ${SITE_ALIAS}!"

if [ ! -f "/app/web/sites/$SITE_SUBDIR/settings.local.php" ]
then
  cp scripts/example.settings.local.php web/sites/$SITE_SUBDIR/settings.local.php
fi

echo -e "${green_bg} STEP 1 ${NC} ${green}Composer install...${NC}"
composer install --no-interaction

echo -e "${green_bg} STEP 2 ${NC} ${green}Install site...${NC}"
drush $SITE_ALIAS si --sites-subdir=$SITE_SUBDIR standard --db-url=mysql://drupal10:drupal10@$SITE_DB/$SITE_DB --account-name=admin --account-pass=admin -y

echo -e "${green_bg} STEP 3 ${NC} ${green}Delete all shortcuts...${NC}"
drush $SITE_ALIAS entity:delete shortcut -y

echo -e "${green_bg} STEP 4 ${NC} ${green}Import config...${NC}"
drush $SITE_ALIAS cset system.site uuid 6b561dc5-cffe-4aff-b423-e044e392ccf0 -y
drush $SITE_ALIAS cim -y

echo -e "${green_bg} STEP 4 ${NC} ${green}Generate login link...${NC}"
drush $SITE_ALIAS uli
