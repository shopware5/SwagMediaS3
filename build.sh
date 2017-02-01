#!/bin/bash

lastTag=$(git tag | tail -n 1)
customTag=$1

if [ "$customTag" != "" ]; then lastTag=$customTag; fi
if [ "$lastTag" = "" ]; then lastTag="master"; fi

rm -f SwagMediaS3-${lastTag}.zip
rm -rf SwagMediaS3
mkdir -p SwagMediaS3
git archive $lastTag | tar -x -C SwagMediaS3

cd SwagMediaS3
composer install --no-dev -n -o
cd ../
zip -r SwagMediaS3-${lastTag}.zip SwagMediaS3
rm -r SwagMediaS3
