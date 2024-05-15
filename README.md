# INFORMATION SERVICE API

Welcome to the Information Service API, a Restful API designed for a simple yet effective information service application.

## Getting Started

### Clone the project

Clone the project repository using the following command:

```bash
git clone https://github.com/reviwh/information_service_api.git
```

### Import database

Import the provided [database file](/db_information_service_5_13_24.sql) to set up your database.

## Documentation

### Get User by ID

Endpoint: `POST /user/{id}`

Retrieve user information based on the provided user ID.

#### Path Parameter

| name | required | datatype |
| :--- | :------: | :------: |
| id   |  `true`  | integer  |

#### Field

| name  | required | datatype |
| :---- | :------: | :------: |
| token |  `true`  |  string  |

#### Response

```json
{
  "message": "string",
  "data": {
    "id": 0,
    "name": "string",
    "email": "string",
    "no_telp": "string",
    "id_card": "string",
    "address": "string",
    "role": "string"
  }
}
```

### Login User

Endpoint: `POST /user/login`

login user

#### Field

| name     | required | datatype |
| :------- | :------: | :------: |
| email    |  `true`  |  string  |
| password |  `true`  |  string  |

#### Response

```json
{
  "message": "string",
  "data": {
    "id": 0,
    "name": "string",
    "email": "string",
    "no_telp": "string",
    "id_card": "string",
    "role": "string",
    "token": "string"
  }
}
```

### Register User

Endpoint: `POST /user/register`

register user

#### Field

| name     | required | datatype                     |
| :------- | :------: | :--------------------------- |
| name     |  `true`  | string                       |
| email    |  `true`  | string                       |
| no_telp  |  `true`  | string                       |
| password |  `true`  | string                       |
| address  |  `true`  | string                       |
| role     |  `true`  | Enum: `"admin"` `"customer"` |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

### Edit User

Endpoint: `POST /user/edit/{id}`

edit user

#### Path Parameter

| name | required | datatype |
| :--- | :------: | :------: |
| id   |  `true`  | integer  |

#### Field

| name     | required | datatype                     |
| :------- | :------: | :--------------------------- |
| name     |  `true`  | string                       |
| email    |  `true`  | string                       |
| no_telp  |  `true`  | string                       |
| password |  `true`  | string                       |
| address  |  `true`  | string                       |
| role     |  `true`  | Enum: `"admin"` `"customer"` |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

### Get All Employee Complaints

Endpoint: `GET /employee`

Retrieve list of employee complaints.

#### Response

```json
{
  "message": "string",
  "data": [
    {
      "id": 0,
      "reporter": "string",
      "no_telp": "string",
      "id_card": "string",
      "id_number": "string",
      "complaint_report": "string",
      "status": "string",
      "submitted_by": 1
    }
  ]
}
```

## Contributors

| [![Revi Wardana Putra](https://avatars.githubusercontent.com/reviwh?s=100)<br /><sub>Revi Wardana Putra</sub>](https://github.com/reviwh) | [![Nathalia Bruno](https://avatars.githubusercontent.com/ihsan005?s=100)<br /><sub>Ihsan Shadiq</sub>](https://github.com/ihsan005) | <img src="https://avatars.githubusercontent.com/IkhsanoMulya" alt="Ikhsano Mulya" width=100 /><br /><sub>[Ikhsano Mulya](https://github.com/IkhsanoMulya)</sub> |
| :---------------------------------------------------------------------------------------------------------------------------------------: | :---------------------------------------------------------------------------------------------------------------------------------: | :-------------------------------------------------------------------------------------------------------------------------------------------------------------: |

## License

This project is licensed under the [MIT License](/LICENSE).
