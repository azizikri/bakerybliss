#!/bin/bash

echo "Running deploy script"

# Check if running as root, if not, restart with sudo
if [ "$EUID" -ne 0 ]; then
    echo "Please run as root"
    exec sudo "$0" "$@"
fi

echo "[1/6] Pulling from GitHub"
git pull origin

echo "[2/6] Creating database if one isn't found"
touch database/database.sqlite
chown www-data:www-data database/database.sqlite

echo "[3/6] Installing packages using composer"
composer install

# Load NVM if it exists
export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"

# If that doesn't work, try common NVM paths
if ! command -v npm &> /dev/null; then
    if [ -f "/root/.nvm/nvm.sh" ]; then
        source /root/.nvm/nvm.sh
    elif [ -f "$HOME/.nvm/nvm.sh" ]; then
        source $HOME/.nvm/nvm.sh
    fi
fi

echo "[4/6] Installing packages using npm"
if command -v npm &> /dev/null; then
    npm install
else
    echo "ERROR: npm not found. Please ensure NVM/Node.js is properly installed"
    exit 1
fi

echo "[5/6] Building assets"
npm run build

echo "[6/6] Migrating database"
php artisan migrate --force

echo "The app has been built and deployed!"
