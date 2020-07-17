## Setting up

### Fresh installation

Clone the project `git clone https://github.com/joseluiselp/Chotel_Scrummers_API.git`
Create a database 
Execute `composer install`
Create the `.env` file and set the database connection
Execute `php artisan key:generate`
Execute `php artisan migrate`
Execute `php artisan db:seed`
Execute `php artisan passport:install`



### Methods

# Register


 _Register an user._

- **URL**<br>
/api/register

- **Method**<br>
`POST`

- **Sample Call**<br>

```yaml
var settings = {
  "url": "api/register",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "X-CSRF-TOKEN": "yvthwsztyeQkAPzeQ5gHgTvlyxHfs3AfE",//this is the key generated on .env file
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "name": "user",
    "email": "user@user.com",
    "password": "user123",
    "c_password": "user123",
    "lastname": "surname",
    "dob": "2020-01-01",
    "country_id": "1",
    "phone": "+584240000000"
  }
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

```

- **Success Response - Code 200**<br>
```yaml
{
  "token_type": "Bearer",
  "expires_in": 86399,
  "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhd....",
  "refresh_token": "def50200acb82...."
}
```
  
- **Error Response - Code 401**<br>
```yaml
{
    "error": {
        "address": [
            "The address field is required."
        ],
        "email": [
            "The email has already been taken."
        ]
    }
}
```

# Login


 _Method to grant access to an user_

- **URL** <br>
/api/login

- **Method**<br>
`POST`

- **Sample Call**<br>

```yaml
var settings = {
  "url": "/api/login",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "email": "admin@company.com",
    "password": "admin123"
  }
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

```
- **Success Response - Code 200**<br>
```yaml
{
    "token_type": "Bearer",
    "expires_in": 86399,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
    "refresh_token": "def50200acb823e2e26a73314df19fd76c7..."
}

```
  
- **Error Response - Code 401**<br>
```yaml
{
    "error": "Unauthorized"
}

```

# RefreshToken


 _Method to refresh the connection token of an user_

- **URL** <br>
/api/refreshtoken

- **Method**<br>
`POST`

- **Sample Call**<br>

```yaml
var settings = {
  "url": "/api/refreshtoken",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Refreshtoken": "def50200acb823e2e26a73314df19725a..."
  },
};

$.ajax(settings).done(function (response) {
  console.log(response);
});


```
- **Success Response - Code 200**<br>

```yaml
{
    "token_type": "Bearer",
    "expires_in": 86399,
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
    "refresh_token": "def50200acb823e2e26a73ka18c4022b6df..."
}

```
  
- **Error Response - Code 401**<br>
```yaml
{
    "error": "Unauthorized"
}

```


# Availabillity


 _Given a room type (1,2,3) Returns the rooms available for that type_
 
- **URL** <br>
/api/room/availability

- **Method**<br>
`GET`
- **Require auth**<br>
`YES`

- **Sample Call**<br>

```yaml
var settings = {
  "url": "/api/room/availability",
  "method": "GET",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "type": "1",
    "checkin": "2020-07-17",
    "checkout": "2020-07-18",
  }
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

```
- **Success Response - Code 200**<br>
```yaml
{
	[
	    {
	        "name": "101",
	        "floor": 1,
	        "type": {
	            "name": "Single"
	        }
	    },
	    {
	        "name": "104",
	        "floor": 1,
	        "type": {
	            "name": "Single"
	        }
	    },
	    {
	        "name": "105",
	        "floor": 2,
	        "type": {
	            "name": "Single"
	        }
	    }
	]
}

```

# Reservation


 _Given a room type, checkin and checkout creates a reservation for the first room of that type_
 
- **URL** <br>
/api/room/reservation

- **Method**<br>
`POST`
- **Require auth**<br>
`YES`

- **Sample Call**<br>

```yaml
var settings = {
  "url": "api/room/reservation",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "type": "1",
    "checkin": "2020-07-17",
    "checkout": "2020-07-18",
	}
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

```
- **Success Response - Code 200**<br>
```yaml
{
    "checkin": "2020-07-22",
    "checkout": "2020-07-25",
    "id": 16,
    "room": {
        "name": "203",
        "floor": 2
    }
}

```

# Update Reservation


 _Given a reservation id, room type, checkin and checkout updates a reservation with the fields given_
 
- **URL** <br>
/api/room/reservation

- **Method**<br>
`PUT`
- **Require auth**<br>
`YES`

- **Sample Call**<br>

```yaml
var settings = {
  "url": "api/room/reservation",
  "method": "PUT",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
  	"id": "1",
    "type": "1",
    "checkin": "2020-07-17",
    "checkout": "2020-07-18",
	}
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

```
- **Success Response - Code 200**<br>
```yaml
{
    "id": 16,
    "checkin": "2020-07-22",
    "checkout": "2020-07-25",
    "deleted": 0,
    "room": {
        "name": "101",
        "floor": 1
    }
}

```


# Delete Reservation


 _Mark the reservation object as deleted_
 
- **URL** <br>
/api/room/reservation

- **Method**<br>
`DELETE`
- **Require auth**<br>
`YES`

- **Sample Call**<br>

```yaml
var settings = {
  "url": "api/room/reservation",
  "method": "DELETE",
  "timeout": 0,
  "headers": {
    "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...",
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
  	"id": "1"
	}
};

$.ajax(settings).done(function (response) {
  console.log(response);
});

```
- **Success Response - Code 200**<br>
```yaml
{
    "id": 16,
    "checkin": "2020-07-22",
    "checkout": "2020-07-25",
    "deleted": true,
    "room": {
        "name": "101",
        "floor": 1
    }
}

```