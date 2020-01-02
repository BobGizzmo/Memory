#!/bin/bash

docker-compose stop

sleep 3;

docker-compose rm -f

echo "#-----------------------------------------------------------"
echo "#"
echo "#  $CONTAINER_NAME && $CONTAINER_MYSQL && $CONTAINER_MAIL &&"
echo "#  $CONTAINER_ADMINER ont bien été arrétés et supprimés."
echo "#"
echo "#-----------------------------------------------------------"
echo
exit 0