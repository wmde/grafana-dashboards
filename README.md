# grafana-dashboards
BACKUP of the JSON for the WMDE grafana dashboards hosted on https://grafana.wikimedia.org

Simply run the fetch script using one of the methods below and then make a new commit!

#### Running using local PHP

```php ./fetch.php```

#### Running using docker

```
docker run \
-it --rm --name wmde_grafana-dashboards_fetch \
-v /"$PWD"://usr/src/myapp -w //usr/src/myapp \
php:latest \
php fetch.php
```