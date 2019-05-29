#!/bin/bash

docker-compose stop

sleep 3;

docker-compose rm -f

echo "#----------------"
echo "#"
echo "# Suppression OK "
echo "#"
echo "#----------------"

exit 0