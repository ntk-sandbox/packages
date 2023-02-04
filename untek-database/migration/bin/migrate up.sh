#!/bin/sh
cd ../../../untek-framework/console/bin
php zn db:migrate:up

#use --withConfirm=0 for skip dialog
