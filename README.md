# codechallenge-moolahgo-service

## Overview

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

## HTTP Request

### Create owner / user to get referral_code

Method: POST

```
http://localhost/codechallenge-moolahgo-service/api/owner

Content-Type: application/json
Accept: application/json

```

request
```
{
  "name": "dudunk",
  "email": "haji.dudunk@gmail.com",
  "phone": "098765432"
}

```

response success
```
HTTP/1.1 200 OK
Date: Wed, 01 Sep 2021 05:26:02 GMT
Server: Apache/2.4.38 (Debian)
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Transfer-Encoding: chunked
Content-Type: application/json; charset=utf-8

{
  "status": 1,
  "message": "New referral code has been created",
  "referralcode": "DSNZLL"
}

Response code: 200 (OK); Time: 342ms; Content length: 83 bytes

```

### Show detail owner by Referral Code

Method: POST

```
http://localhost/codechallenge-moolahgo-service/api/process

Content-Type: application/json
Accept: application/json
```

request
```
{
  "referral_code": "3X532B"
}

```

response success
```
POST http://localhost/codechallenge-moolahgo-service/api/process

HTTP/1.1 200 OK
Date: Wed, 01 Sep 2021 06:17:28 GMT
Server: Apache/2.4.38 (Debian)
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Transfer-Encoding: chunked
Content-Type: application/json; charset=utf-8

{
  "status": 1,
  "message": "Code owner detail is found",
  "data": {
    "id": "3",
    "name": "dudunk",
    "email": "haji.dudunk@gmail.com",
    "phone": "098765432",
    "referralcode": "DSNZLL",
    "status": "1",
    "created_at": "2021-09-01 05:26:02"
  }
}

Response code: 200 (OK); Time: 214ms; Content length: 209 bytes


```


response not found
```
POST http://localhost/codechallenge-moolahgo-service/api/process

HTTP/1.1 404 Not Found
Date: Wed, 01 Sep 2021 06:16:33 GMT
Server: Apache/2.4.38 (Debian)
Keep-Alive: timeout=5, max=100
Connection: Keep-Alive
Transfer-Encoding: chunked
Content-Type: application/json; charset=utf-8

{
  "status": 0,
  "message": "Code not found",
  "data": null
}

Response code: 404 (Not Found); Time: 83ms; Content length: 51 bytes


```