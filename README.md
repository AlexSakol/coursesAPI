<ol>
<li>Clone this repository</li>
<li>Run: docker-compose up -d</li>
<li>Run: docker-compose run composer install</li>
<li>Set up .env file in folder /src. Take settings from env/mysql.env. DB_HOST = mysql</li>
<li>Run: docker-compose run artisan key:generate</li>
<li>Run: docker-compose run artisan migrate</li>
<li>The app is available on 127.0.0.1:8000</li>
<li>To see API methods run: docker-compose run artisan route:list</li>
</ol>
<p>All composer and artisan commands are available from docker-compose run. </p>