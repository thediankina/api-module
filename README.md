# API user management module

This module is an example of a user management API. One part of the API contains public methods:
getting a list of users, creating and authorizing a user. The other part is only available using an access token, 
which is received from the response of the login and password authorization method and transmitted as part of the request headers.

## Database

The `user` table has the following attributes:

| Field         | Type                     | Description           |
|---------------|--------------------------|-----------------------|
| id            | bigint unsigned not null | ID                    |
| login         | varchar(255) not null    | Login                 |
| password_hash | varchar(255) not null    | Password hash         |
| access_token  | varchar(255) not null    | Access token          |
| created_at    | timestamp(0) not null    | Created at (datetime) |
| updated_at    | timestamp(0) null        | Updated at (datetime) |

## API methods

- Get list of users
- Create user
- Log in as user
- Change (current) user
- Delete (current) user

Read more via Swagger YAML: [web/docs/swagger/openapi.yaml](web/docs/swagger/openapi.yaml)
