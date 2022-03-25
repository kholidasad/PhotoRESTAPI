# Photo REST API Documentation

The REST API to the photo app is described below.

## Register

### Request 

`POST /api/register`

    https://photorestapi.herokuapp.com/api/register
    
    Content-Type: multipart/form-data
    Connection: keep-alive
    
### Body

    "name": String,
    "email": String(email),
    "password": String(min 8, max 16)
    
### Response 

    HTTP/1.1 201 Created
    Status: 201 Created
    Connection: close
    Content-Type: application/json

    {"id":1,"name":"John","email":"inijohn@local.com","password":"pass123"}

## Login

### Request 

`POST /api/login`

    https://photorestapi.herokuapp.com/api/login
    
    Content-Type: multipart/form-data
    Connection: keep-alive
    
### Body

    "email": String(email),
    "password": String(min 8, max 16)
    
### Response 

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {"name":"John","token":"tokenhere","tokentype":"Bearer"}

## Get All Photos

### Request 

`GET /api/photos`

    https://photorestapi.herokuapp.com/api/photos
        
    Connection: keep-alive
    
### Response 

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    []
    
## Create Photo

### Request 

`POST /api/photos`

    https://photorestapi.herokuapp.com/api/photos
        
    Authorization: Bearer Token
    Content-Type: multipart/form-data
    Connection: keep-alive
    
### Body

    "photo": File,
    "caption": String,
    "tags": String
    
### Response 

    HTTP/1.1 201 Created
    Status: 201 Created
    Connection: close
    Content-Type: application/json

    {"id":1,"photo":"file","caption":"new photo","tags":"Design"}
    
## Get Detail Photo

### Request 

`GET /api/photos/id`

    https://photorestapi.herokuapp.com/api/photos/1
            
    Connection: keep-alive
    
### Response 

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {"id":1,"photo":"file","caption":"new photo","tags":"Design"}
    
## Update Photo

### Request 

`PUT /api/photos/id`

    https://photorestapi.herokuapp.com/api/photos/1
            
    Authorization: Bearer Token
    Content-Type: multipart/form-data
    Connection: keep-alive
    
### Body

    "caption": String,
    "tags": String
    
### Response 

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
    Content-Type: application/json

    {"id":1,"photo":"file","caption":"photo caption","tags":"Tech"}
    
## Delete Photo

### Request 

`DELETE /api/photos/id`

    https://photorestapi.herokuapp.com/api/photos/1        
    Authorization: Bearer Token
    Content-Type: multipart/form-data
    Connection: keep-alive
    
### Response 

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close

## Like Photo

### Request 

`POST /api/photos/id/like`

    https://photorestapi.herokuapp.com/api/photos/1/like
            
    Authorization: Bearer Token
    Content-Type: multipart/form-data
    Connection: keep-alive
    
### Response 

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close

## Unlike Photo

### Request 

`POST /api/photos/id/unlike`

    https://photorestapi.herokuapp.com/api/photos/1/unlike
            
    Authorization: Bearer Token
    Content-Type: multipart/form-data
    Connection: keep-alive
    
### Response 

    HTTP/1.1 200 OK
    Status: 200 OK
    Connection: close
