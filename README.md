## Run programs with debugger

```
docker-compose run -e PHP_IDE_CONFIG="serverName=server" -w /opt/project php-cli -dxdebug.remote_enable=1 -dxdebug.remote_mode=req -dxdebug.remote_port=9000 -dxdebug.remote_host=172.17.0.1 -dxdebug.remote_autostart=1 cli.php day10:part1
```
