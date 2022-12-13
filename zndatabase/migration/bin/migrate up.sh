#!/bin/sh
cd ../../../znframework/console/bin
php zn db:migrate:up

#use --withConfirm=0 for skip dialog
