<ol>
<li>Clone this repository</li>
<li>Run: docker-compose up -d</li>
<li>cd src</li>
<li>Run: composer install</li>
<li>Set up .env file in folder /src. Take settings from env/mysql.env. DB_HOST = mysql</li>
<li>Run: docker-compose run artisan key:generate</li>
<li>Run: docker-compose run artisan migrate</li>
<li>The app is available on 127.0.0.1:8000</li>
</ol>