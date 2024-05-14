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

### Get User

Endpoint: `POST /user/{id}`

Retrieve user information based on the provided user ID.

#### Path Parameter

| id  | `required` | integer |
| :-: | :--------: | :-----: |

#### Body Query

| token | `required` | string |
| :---: | :--------: | :----: |

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
