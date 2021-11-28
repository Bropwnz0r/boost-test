@echo off

echo ----------------- Stop and remove containers -----------------

FOR /F %%d IN ('docker stop boost-test') DO (docker rm %%d)

echo ------------------------ Build docker ------------------------

docker-compose up -d

echo ------------ Wait 50 seconds to initialize -------------

timeout /t 50

echo ---------------------- Composer install ----------------------

docker exec -u root -i -w /var/www/boost-test boost_test composer install --prefer-source --no-interaction
