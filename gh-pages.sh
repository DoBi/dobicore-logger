#!/bin/bash

set -o errexit -o nounset

rev=$(git rev-parse --short HEAD)

cd doc/

git init
git config user.name "Dominik Bittner"
git config user.email "DoBi-tyndur@gmx.net"

git remote add upstream "https://$GH_TOKEN@github.com/DoBi/dobicore-logger.git"
git fetch upstream
git reset upstream/gh-pages

touch .

git add -A .
git commit -m "Documentation for ${rev}"
git push -q upstream HEAD:gh-pages
