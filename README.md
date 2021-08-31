# codechallenge-moolahgo-service

It is codeigniter based api for create referral code.

Framework - CodeIgniter (https://codeigniter.com/userguide3/installation/index.html)
Database - MySQL 8

1. Setup local dev environment taking reference of above link (PHP >= 7.3)
2. Import database from `database.sql`
3. Rename `exm.htaccess` to `.htaccess`
4. Endpoints : 
	- Create owner / user to get referral_code : http://localhost/codechallenge-moolahgo-service/api/owner 
	- Get detail owner / user by referral_code : http://localhost/codechallenge-moolahgo-service/api/process
5. For detail endpoints, please open `rest-api.http` file
6. If using phpstorm or similar for IDE, you can run `rest-api.http` in IDE without using POSTMAN.