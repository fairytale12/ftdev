#!/bin/bash

SCRIPT_NAME=$0;
DOCUMENT_ROOT=/home/bitrix/www;
PHP_PATH=/usr/bin/php;

echo ">>> start $SCRIPT_NAME";
$PHP_PATH $DOCUMENT_ROOT/test.php one;
$PHP_PATH $DOCUMENT_ROOT/test.php two;
$PHP_PATH $DOCUMENT_ROOT/test.php three;
echo ">>> end $SCRIPT_NAME";