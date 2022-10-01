#!/usr/bin/env bash
set -e

#################################################################
echo ""
# IF ENV VAR DOES NOT EXISTS OR IS EQUALS == 0, DISABLE XDEBUG
if [[ "0" == $XDEBUG_ENABLED || -z $XDEBUG_ENABLED ]]; then
    echo "======> Disabling XDEBUG";
    cp /home/xdebug/xdebug.off.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
else
  touch /tmp/xdebug.log
  chown www:www /tmp/xdebug.log
  chmod 777 /tmp/xdebug.log
  if [[ "windows" == $OS_PLATFORM || -z $OS_PLATFORM ]]; then
      echo "======> Enabling XDEBUG for WINDOWS";
      cp /home/xdebug/xdebug.on.windows.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
  else
      echo "======> Enabling XDEBUG for UNIX";
      cp /home/xdebug/xdebug.on.unix.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
  fi;
fi;
#################################################################


#################################################################
echo ""
# IF ENV VAR DOES NOT EXISTS OR IS EQUALS == PRODUCAO, ENABLE PRODUCTION
if [[ "TESTE" == $AMBIENTE || -z $AMBIENTE ]]; then
    echo "======> DEVELOPMENT ENV";
    cp /home/php-ini/php-development.ini /usr/local/etc/php/conf.d/php.ini
else
    echo "======> PRODUCTION ENV";
    cp /home/php-ini/php-production.ini /usr/local/etc/php/conf.d/php.ini
fi;
#################################################################

php-fpm