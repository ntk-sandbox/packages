#!/bin/sh
cd ../../../untek-framework/console/bin
php zn db:migrate:down

#use --withConfirm=0 for skip dialog
