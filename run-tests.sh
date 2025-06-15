#!/bin/bash

# Create test log folder if it doesn't exist
mkdir -p test-logs

# Check argument
MODE=$1

if [ "$MODE" == "unit" ]; then
    echo "🧪 Running unit tests only..."
    ./vendor/bin/phpunit --exclude-group selenium | tee test-logs/unit-tests.log

elif [ "$MODE" == "selenium" ]; then
    echo "🚀 Running Selenium tests only..."
    ./vendor/bin/phpunit --group selenium | tee test-logs/selenium-tests.log

else
    echo "🔁 Running all tests (unit + selenium)..."
    ./vendor/bin/phpunit | tee test-logs/all-tests.log
fi
