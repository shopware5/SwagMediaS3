#!/bin/bash

lastTag=$(git tag | tail -n 1)
customTag=$1

if [ "$customTag" != "" ]; then lastTag=$customTag; fi

rm -rf Frontend/SwagMediaS3
mkdir -p Frontend/SwagMediaS3
git archive $lastTag | tar -x -C Frontend/SwagMediaS3
cd Frontend/SwagMediaS3
composer install -o
cd ../../
zip -r SwagMediaS3-${lastTag}.zip Frontend