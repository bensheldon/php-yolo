#!/bin/bash

set -ex

YOLO_BIN_DIR=${YOLO_BIN_DIR-builds}

# the Behat test suite will pick up the executable found in $YOLO_BIN_DIR
mkdir -p $YOLO_BIN_DIR
php -dphar.readonly=0 utils/make-phar.php yolo.phar --quiet
mv yolo.phar $YOLO_BIN_DIR/yolo.phar
cp $YOLO_BIN_DIR/yolo.phar $YOLO_BIN_DIR/yolo
chmod +x $YOLO_BIN_DIR/yolo.phar
chmod +x $YOLO_BIN_DIR/yolo
