## Laravel Vue Demo
A demonstrable task list (to-do's) web-app using laravel and vuejs

## Demo
[Live Preview](http://laravel-vue-demo.herokuapp.com/)

## Usage
Generate application key
```
php artisan key:generate
```
Setup environment config vars (eg. database)
```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Run migrations
```
php artisan migrate
php artisan db:seed
php artisan db:seed --class=TagSeeder
```
Server via composer
``` 
php artisan serve
```

or if you prefer to use the embedded docker (laradock)
```
cd laradock
cp env-example .env
```

Run containers
```
docker-compose up -d nginx mysql phpmyadmin redis workspace 
```

Setup environment config vars (eg. containers settings)
```
DB_HOST=mysql
REDIS_HOST=redis
QUEUE_HOST=beanstalkd
```

Serve via docker
```
docker-compose exec workspace bash
~/bash: php artisan serve
```

## Author
[Joshua de Guzman](https://bit.ly/jodeio)

## License
```
MIT License

Copyright (c) 2018 Joshua de Guzman

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
© 2018 GitHub, Inc.
```





