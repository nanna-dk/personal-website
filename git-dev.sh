#!/usr/bin/env bash

cd ~/Documents/personal-website

git add .

DATE=$(date)

git commit -m "Changes made on $DATE"

git push
