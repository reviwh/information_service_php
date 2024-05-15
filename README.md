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

#### Endpoint:

`POST /user/{id}`

Retrieve user information based on the provided user ID.

#### Path Parameter

| Name | Required | Datatype |
| :--- | :------: | :------: |
| id   |  `true`  |  number  |

#### Field

| Name  | Required | Datatype |
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

#### Endpoint:

`POST /user/login`

Authenticate a user.

#### Field

| Name     | Required | Datatype |
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

#### Endpoint:

`POST /user/register`

Register a new user.

#### Field

| Name     | Required | Datatype                     |
| :------- | :------: | :--------------------------- |
| name     |  `true`  | string                       |
| email    |  `true`  | string                       |
| no_telp  |  `true`  | string                       |
| id_card  |  `true`  | File: `pdf`                  |
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

#### Endpoint:

`POST /user/edit/{id}`

Edit user information.

#### Path Parameter

| Name | Required | Datatype |
| :--- | :------: | :------: |
| id   |  `true`  |  number  |

#### Field

| name     | Required | Datatype                     |
| :------- | :------: | :--------------------------- |
| name     |  `true`  | string                       |
| email    |  `true`  | string                       |
| no_telp  |  `true`  | string                       |
| id_card  | `false`  | File: `pdf`                  |
| password |  `true`  | string                       |
| address  |  `true`  | string                       |
| role     |  `true`  | Enum: `"admin"` `"customer"` |
| token    |  `true`  | string                       |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

### Get All Employee Complaints

#### Endpoint:

`GET /employee`

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
      "submitted_by": 0
    }
  ]
}
```

### Get Employee Complaint by User ID

#### Endpoint:

`GET /employee/list/{id}`

Retrieve the list of employee complaints for a specific user.

#### Path Parameter

| name | Required | Datatype |
| :--- | :------: | :------: |
| id   |  `true`  |  number  |

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
      "submitted_by": 0
    }
  ]
}
```

### Create Employee Complaint

#### Endpoint:

`POST /employee/create`

Create a new employee complaint.

#### Field

| Name             | Required | Datatype    |
| ---------------- | :------: | :---------- |
| reporter         |  `true`  | string      |
| no_telp          |  `true`  | string      |
| id_card          |  `true`  | File: `pdf` |
| id_number        |  `true`  | string      |
| complaint_report |  `true`  | File: `pdf` |
| submitted_by     |  `true`  | number      |
| token            |  `true`  | string      |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

### Update Employee Complaint

#### Endpoint:

`POST /employee/edit/{id}`

Update an existing employee complaint.

#### Path Parameter

| Name | Required | Datatype |
| ---- | :------: | -------- |
| id   |  `true`  | string   |

#### Field

| Name             | Required | Datatype    |
| ---------------- | :------: | :---------- |
| reporter         |  `true`  | string      |
| no_telp          |  `true`  | string      |
| id_card          | `false`  | File: `pdf` |
| id_number        |  `true`  | string      |
| complaint_report | `false`  | File: `pdf` |
| submitted_by     |  `true`  | number      |
| token            |  `true`  | string      |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

### Update Employee Complaint Status

#### Endpoint:

`POST /employee/edit/{id}/status/{status}`

Update the status of an employee complaint.

#### Path Parameter

| Name   | Required | Datatype                             |
| ------ | :------: | ------------------------------------ |
| id     |  `true`  | string                               |
| status |  `true`  | Enum: `pending` `approve` `rejected` |

#### Field

| Name         | Required | Datatype |
| ------------ | :------: | :------- |
| submitted_by |  `true`  | number   |
| token        |  `true`  | string   |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

## Contributors

| [![Revi Wardana Putra](https://avatars.githubusercontent.com/reviwh?s=100)<br /><sub>Revi Wardana Putra</sub>](https://github.com/reviwh) | [![Nathalia Bruno](https://avatars.githubusercontent.com/ihsan005?s=100)<br /><sub>Ihsan Shadiq</sub>](https://github.com/ihsan005) | <img src="https://avatars.githubusercontent.com/IkhsanoMulya" alt="Ikhsano Mulya" width=100 /><br /><sub>[Ikhsano Mulya](https://github.com/IkhsanoMulya)</sub> |
| :---------------------------------------------------------------------------------------------------------------------------------------: | :---------------------------------------------------------------------------------------------------------------------------------: | :-------------------------------------------------------------------------------------------------------------------------------------------------------------: |

## License

This project is licensed under the [MIT License](/LICENSE).
