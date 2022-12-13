#!/bin/sh
cd ../../../znframework/console/bin
php zn db:migrate:generate

#use --withConfirm=0 for skip dialog
