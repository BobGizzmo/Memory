#!/bin/bash

# Vérifie que le fichier .env est bien défini
if [ -e .env ]; then
    source .env
else
    echo "Please set up your .env file before starting your environment."
    echo "Veuillez renommer le fichier .env.sample en .env"
    exit 1
fi


# Construit les images et les conteneurs selon les indications indiqués 
# dans docker/Dockerfile et dans le docker-compose.yml
docker-compose build

docker-compose -f docker-compose.yml up -d

sleep 4;
sleep 4;

# Execute le script de création de table
docker exec $CONTAINER_NAME /bin/sh -c 'cd /var/www/ && commande/createsql'

echo
echo "#-----------------------------------------------------------"
echo "#"
echo "# Please check your browser at http://localhost:$APP_PORT   "
echo "# Or at $VIRTUAL_HOST (if you are using a webproxy)               "
echo "#"
echo "#-----------------------------------------------------------"
echo

exit 0
