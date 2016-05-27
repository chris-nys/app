#!/bin/bash
sleep 5
mysql -u root -e "CREATE DATABASE app"
mysql -u root app < /tmp/app.sql
