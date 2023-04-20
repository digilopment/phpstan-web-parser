# CODING STANDARD
### CLONE PACKAGE
```sh
git clone git@github.com/digilopment/phpstan-web-parser /var/lib/www/tools/phpstan-web-parser
```
### SETUP .BASHHRC `nano ~/.bashrc`
#### add this function inside 
```sh
stan () {
   LIB_TYPE=nette-app
   LEVEL=8
   TEST_PATH=/var/lib/www/tools
   
   if [[ -n "$1" ]]; then
     if [[ "$1" = "src/" ]] || [[ "$1" = "src"  ]] ; then
         path=nette-lib
     fi
   fi
   
   if [[ -n "$3" ]]; then
     LEVEL=$3
   fi
   
   if [[ "$2" = "json" ]] || [[ "$2" = "web" ]]; then
      php -d memory_limit=-1 $TEST_PATH/src/phpstan/vendor/bin/phpstan analyse $1 -c $TEST_PATH/src/phpstan/vendor/efabrica/phpstan-config/conf/${LIB_TYPE}/level.${LEVEL}.neon --no-progress --error-format=json > $TEST_PATH/src/phpstan-web-parser/data/data.json
      google-chrome http://localhost:8888?path=$1 </dev/null >/dev/null 2>&1 & disown
      php -S localhost:8888 -t $TEST_PATH/src/phpstan-web-parser/public
   else
      php -d memory_limit=-1 $TEST_PATH/src/phpstan/vendor/bin/phpstan analyse $1 -c $TEST_PATH/src/phpstan/vendor/efabrica/phpstan-config/conf/${LIB_TYPE}/level.${LEVEL}.neon --no-progress
   fi
}
```

#### save, restart terminal and run command bellow
```sh
cd /var/lin/www/{projectRepo}
stan app/ web 5 #stan level 5, folder "app", response "web"
stan src/ web 8 #stan level 8, folder "src", response "web"
stan app/ console 8 #stan level 8, folder "app", response "console"
stan #default stan level 8, default folder "app", default response "console"
```

# CODING STANDARD LATTE
#### add this function inside 
```sh
stan-latte () {
   LEVEL=8
   TEST_PATH=/var/lib/www/tools
   
   if [[ -n "$3" ]]; then
     LEVEL=$3
   fi
   
   if [[ -n "$1" ]]; then
     if [[ "$2" = "json" ]] || [[ "$2" = "web" ]]; then
     	php -d memory_limit=-1 $TEST_PATH/src/phpstan-latte/vendor/bin/phpstan analyse $1 -c $TEST_PATH/src/phpstan-latte/vendor/efabrica/phpstan-config/conf/nette-app/level.${LEVEL}.neon --no-progress --error-format=json > $TEST_PATH/src/phpstan-web-parser/data/data.json
     	google-chrome http://localhost:8888?path=$1 </dev/null >/dev/null 2>&1 & disown
        php -S localhost:8888 -t $TEST_PATH/src/phpstan-web-parser/public
     else
     	php -d memory_limit=-1 $TEST_PATH/src/phpstan-latte/vendor/bin/phpstan analyse $1 -c $TEST_PATH/src/phpstan-latte/vendor/efabrica/phpstan-config/conf/nette-app/level.${LEVEL}.neon --no-progress
     fi
   else
     echo "Zadaj source src|app|..."
   fi
}
```

#### save, restart terminal and run command bellow
```sh
cd /var/lin/www/{projectRepo}
stan-latte app/ web 5 #stan level 5, folder "app", response "web"
stan-latte src/ web 8 #stan level 8, folder "src", response "web"
stan-latte #default stan level 8, default folder "full_project", default response "console"
```

#### FILTRED BY DEFAULT SOURCE
[![N|Solid](https://raw.githubusercontent.com/digilopment/phpstan-web-parser/master/public/img/stan-latte.png)]

#### FILTRED BY USER
[![N|Solid](https://raw.githubusercontent.com/digilopment/phpstan-web-parser/master/public/img/stan-latte-2.png)]

