#!/usr/bin/env bash

UNAMEOUT="$(uname -s)"

WHITE='\033[1;37m'
NC='\033[0m'

# Verify operating system is supported...
case "${UNAMEOUT}" in
    Linux*)             MACHINE=linux;;
    Darwin*)            MACHINE=mac;;
    *)                  MACHINE="UNKNOWN"
esac

if [ "$MACHINE" == "UNKNOWN" ]; then
    echo "Unsupported operating system [$(uname -s)]. Laravel Sail supports macOS, Linux, and Windows (WSL2)." >&2

    exit 1
fi

# Define environment variables...
export APP_SERVICE=${APP_SERVICE:-"php-fpm"}
export WWWUSER=${WWWUSER:-$UID}
export WWWGROUP=${WWWGROUP:-$(id -g)}

if [ "$MACHINE" == "linux" ]; then
    export SEDCMD="sed -i"
elif [ "$MACHINE" == "mac" ]; then
    export SEDCMD="sed -i .bak"
fi

# Ensure that Docker is running...
if ! docker info > /dev/null 2>&1; then
    echo -e "${WHITE}Docker is not running.${NC}" >&2

    exit 1
fi

# Determine if Sail is currently up...
PSRESULT="$(docker-compose ps -q)"

if docker-compose ps | grep 'Exit'; then
    echo -e "${WHITE}Shutting down old Sail processes...${NC}" >&2

    docker-compose down > /dev/null 2>&1

    EXEC="no"
elif [ -n "$PSRESULT" ]; then
    EXEC="yes"
else
    EXEC="no"
fi

# Function that outputs Sail is not running...
function sail_is_not_running {
    echo -e "${WHITE}Sail is not running.${NC}" >&2
    echo "" >&2
    echo -e "${WHITE}You may Sail using the following commands:${NC} './sail up' or './sail up -d'" >&2

    exit 1
}

if [ $# -gt 0 ]; then

    # Setup the project by running all necessary commands to do so...
    if [ "$1" == "setup-project" ]; then
        docker-compose up -d

        docker-compose exec \
            -u www-data \
            "$APP_SERVICE" \
            composer install

        echo -e "${WHITE}The project was successfully configured.${NC}" >&2

    # Proxy PHP commands to the "php" binary on the application container...
    elif [ "$1" == "php" ]; then
        shift 1

        if [ "$EXEC" == "yes" ]; then
            docker-compose exec \
                -u www-data \
                "$APP_SERVICE" \
                php "$@"
        else
            sail_is_not_running
        fi

    # Proxy Composer commands to the "composer" binary on the application container...
    elif [ "$1" == "composer" ]; then
        shift 1

        if [ "$EXEC" == "yes" ]; then
            docker-compose exec \
                -u www-data \
                "$APP_SERVICE" \
                composer "$@"
        else
            sail_is_not_running
        fi

    # Proxy the "test" command to run the composer test command...
    elif [ "$1" == "test" ]; then
        shift 1

        if [ "$EXEC" == "yes" ]; then
            docker-compose exec \
                -u www-data \
                "$APP_SERVICE" \
                composer test
        else
            sail_is_not_running
        fi

    # Initiate a Bash shell within the application container...
    elif [ "$1" == "shell" ] || [ "$1" == "bash" ]; then
        shift 1

        if [ "$EXEC" == "yes" ]; then
            docker-compose exec \
                -u www-data \
                "$APP_SERVICE" \
                bash
        else
            sail_is_not_running
        fi

    # Initiate a root user Bash shell within the application container...
    elif [ "$1" == "root-shell" ] ; then
        shift 1

        if [ "$EXEC" == "yes" ]; then
            docker-compose exec \
                "$APP_SERVICE" \
                bash
        else
            sail_is_not_running
        fi

    # Pass unknown commands to the "docker-compose" binary...
    else
        docker-compose "$@"
    fi
else
    docker-compose ps
fi
