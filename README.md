
=============================
Application Requirements:
=============================
- PHP 5.3 or greater
- MySQL


=============================
Deployment
=============================

Extract Zip File:
-----------------------------
- Extract provided zip file to your php project directory;

Example: (project directory)
$ cd /var/www/html/boarding/

Create Database:
-----------------------------
- Create your database in mysql manually and set any name.
- After creating database, add your mysql configuration in database.php file.

Setting Database Credentials:
-----------------------------
Add your database credentials and details by opening a file in edit mode.
$  vim config/database.php

Run Migrations and Seeds:
-----------------------------
After creating and connecting db, run migration first

$  php db/migrations.php

After migration, run seeds

$  php db/seeds.php


=============================
Execute Tests:
=============================
Open project directory on terminal and execute tests by using below command:

$  vendor/eher/phpunit/bin/phpunit test/reservations_test.php


=============================
API Calling:
=============================
You can call API via Rest Client

**ROUTE:** http://localhost/boarding/app.php/reservation
**METHOD:** POST
**REQUEST JSON:** {"boarding_passes":[112233,221144,330055,441166]}
**RESPINSE JSON:** {"results":["Your train from Madrid to Barcelona. Sit in 45B.","Take the bus from Barcelona to Gerona Airport. No seat assignment."]}


=============================
Features:
=============================
- Developed a MC (Model & Controller) architecture for API
- Have routes option to add more.
- Have applied OOP.
- Have applied TDD approch.
- Added phpunit class for unit tests
- Added APIdocs


=============================
Note: 
=============================
- I developed a simple and lite Framework for APIs
- Need to run migrations and seeds before test anything.
- APIdocs added with main API route's method.
- All unit tests are added in 'test/reservations_test.php' file.
- Main Boarding pass controller added in 'app/controllers/reservations.php' file.
- Sorting is not applied as per initial requirements.
- Have developed a database table with 'type', so we can extend this in future. Similarly; we have handled all types by its patterns, you may have a look on our code (inside: 'app/models/reservations.php').
- It's a limited version.


