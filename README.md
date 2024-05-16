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

### Delete Employee Complaint

#### Endpoint:

`POST /employee/delte/{id}`

Delete an employee complaint.

#### Path Parameter

| Name   | Required | Datatype |
| ------ | :------: | -------- |
| id     |  `true`  | string   |

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

### Get All Corruption Complaints

#### Endpoint:

`GET /corruption`

Retrieve list of corruption complaints.

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
      "report_brief": "string",
      "complaint_report": "string",
      "status": "string",
      "submitted_by": 0
    }
  ]
}
```

### Get Corruption Complaint by User ID

#### Endpoint:

`GET /corruption/list/{id}`

Retrieve the list of corruption complaints for a specific user.

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
      "report_brief": "string",
      "complaint_report": "string",
      "status": "string",
      "submitted_by": 0
    }
  ]
}
```

### Create Corruption Complaint

#### Endpoint:

`POST /corruption/create`

Create a new corruption complaint.

#### Field

| Name             | Required | Datatype    |
| ---------------- | :------: | :---------- |
| reporter         |  `true`  | string      |
| no_telp          |  `true`  | string      |
| id_card          |  `true`  | File: `pdf` |
| id_number        |  `true`  | string      |
| report_brief     |  `true`  | string      |
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

### Update Corruption Complaint

#### Endpoint:

`POST /corruption/edit/{id}`

Update an existing corruption complaint.

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
| report_brief     | `false`  | File: `pdf` |
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

### Update Corruption Complaint Status

#### Endpoint:

`POST /corruption/edit/{id}/status/{status}`

Update the status of a corruption complaint.

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

### Delete Corruption Complaint

#### Endpoint:

`POST /corruption/delte/{id}`

Delete a corruption complaint.

#### Path Parameter

| Name   | Required | Datatype |
| ------ | :------: | -------- |
| id     |  `true`  | string   |

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

### Get All JMS

#### Endpoint:

`GET /jms`

Retrieve list of JMS.

#### Response

```json
{
  "message": "string",
  "data": [
    {
      "id": 0,
      "intended_school": "string",
      "applicant": "string",
      "status": "string",
      "submitted_by": 0
    }
  ]
}
```

### Get JMS by User ID

#### Endpoint:

`GET /jms/list/{id}`

Retrieve the list of JMS for a specific user.

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
      "intended_school": "string",
      "applicant": "string",
      "status": "string",
      "submitted_by": 0
    }
  ]
}
```

### Create JMS

#### Endpoint:

`POST /jms/create`

Create a new JMS.

#### Field

| Name             | Required | Datatype    |
| ---------------- | :------: | :---------- |
| intented_school  |  `true`  | string      |
| applicant        |  `true`  | string      |
| submitted_by     |  `true`  | number      |
| token            |  `true`  | string      |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

### Update JMS

#### Endpoint:

`POST /jms/edit/{id}`

Update an existing JMS.

#### Path Parameter

| Name | Required | Datatype |
| ---- | :------: | -------- |
| id   |  `true`  | string   |

#### Field

| Name             | Required | Datatype    |
| ---------------- | :------: | :---------- |
| intented_school  |  `true`  | string      |
| applicant        |  `true`  | string      |
| submitted_by     |  `true`  | number      |
| token            |  `true`  | string      |

#### Response

```json
{
  "message": "string",
  "data": null
}
```

### Update JMS Status

#### Endpoint:

`POST /jms/edit/{id}/status/{status}`

Update the status of a JMS.

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

### Delete JMS

#### Endpoint:

`POST /jms/delte/{id}`

Delete an JMS.

#### Path Parameter

| Name   | Required | Datatype |
| ------ | :------: | -------- |
| id     |  `true`  | string   |

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
| :---: | :---: | :---: |

## License

This project is licensed under the [MIT License](/LICENSE).
