#!/bin/bash

echo "Running deploy script"

echo "[1/6] Pulling from GitHub"
git pull origin

echo "[2/6] Creating database if one isn't found"
touch database/database.sqlite

echo "[3/6] Installing packages using composer"
composer install

echo "[4/6] Installing packages using npm"
npm install

echo "[5/10] Installing packages using npm"
npm run build

echo "[6/6] Migrating database"
php artisan migrate --force

echo "The app has been built and deployed!!"
