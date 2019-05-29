#!/bin/bash

docker-compose build

docker-compose -f docker-compose.yml up -d

echo "#---------------------------------------------------"
echo "#"
echo "# Please check your browser to see if it is running "
echo "#"
echo "#---------------------------------------------------"

exit 0