### Registry API Documentation

## Overview
The Registry API allows you to manage a set of items with endpoints to add, remove, check, invert, and compare items in the registry. The registry maintains its state using PHP sessions.

## Running the Application
1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/registry-api.git
   cd registry-api
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   ```

3. **Set Up Environment**:
   Copy the `.env.example` file to `.env` and configure your environment settings as needed.
   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Start the Application**:
   ```bash
   php artisan serve
   ```

## API Endpoints

### Set Session
- **Endpoint**: `/api/set-session`
- **Method**: `GET`
- **Description**: Sets a test session value.
- **Response**:
  ```json
  {
    "status": "Session set"
  }
  ```

### Get Session
- **Endpoint**: `/api/get-session`
- **Method**: `GET`
- **Description**: Gets the test session value.
- **Response**:
  ```json
  {
    "test_key": "test_value" // or "No session data"
  }
  ```

### Add Item
- **Endpoint**: `/api/add`
- **Method**: `POST`
- **Description**: Adds an item to the registry.
- **Request Body**:
  ```json
  {
    "item": "yellow"
  }
  ```
- **Response**:
  ```json
  {
    "status": "OK"
  }
  ```

### Remove Item
- **Endpoint**: `/api/remove`
- **Method**: `DELETE`
- **Description**: Removes an item from the registry.
- **Request Body**:
  ```json
  {
    "item": "yellow"
  }
  ```
- **Response**:
  ```json
  {
    "status": "OK"
  }
  ```

### Check Item
- **Endpoint**: `/api/check`
- **Method**: `GET`
- **Description**: Checks if an item is in the registry.
- **Query Parameters**:
  - `item`: The item to check.
- **Response**:
  ```json
  {
    "exists": true // or false
  }
  ```

### Diff
- **Endpoint**: `/api/diff`
- **Method**: `POST`
- **Description**: Compares a submitted set to the current registry.
- **Request Body**:
  ```json
  {
    "items": "red,blue,green"
  }
  ```
- **Response**:
  ```json
  {
    "diff": ["red", "green"]
  }
  ```

### Invert
- **Endpoint**: `/api/invert`
- **Method**: `POST`
- **Description**: Inverts the current registry.
- **Response**:
  ```json
  {
    "status": "OK"
  }
  ```

## Testing the API with `curl`
To test the API, use the following `curl` commands:

### Set Session Data
```bash
curl -X GET http://localhost:8000/api/set-session -c cookies.txt
```

### Get Session Data
```bash
curl -X GET http://localhost:8000/api/get-session -b cookies.txt
```

### Add Item
```bash
curl -X POST http://localhost:8000/api/add -d "item=yellow" -b cookies.txt
```

### Check Item
```bash
curl -X GET http://localhost:8000/api/check -G --data-urlencode "item=yellow" -b cookies.txt
```

### Remove Item
```bash
curl -X DELETE http://localhost:8000/api/remove -d "item=yellow" -b cookies.txt
```

### Diff
```bash
curl -X POST http://localhost:8000/api/diff -d "items=red,blue,green" -b cookies.txt
```

### Invert
```bash
curl -X POST http://localhost:8000/api/invert -b cookies.txt
```

## Additional Information
- **Session Handling**: The API uses PHP sessions to maintain the state of the registry. Ensure cookies are enabled and properly handled in your client.
- **Validation**: The API validates that items are alphanumeric strings.

### Conclusion
This documentation provides a comprehensive overview of the Registry API, including how to run the application, available endpoints, and how to test them using `curl`. If you have any questions or issues, please refer to the official Laravel documentation or contact the repository maintainer.

---

Save this documentation as `README.md` in your project root to provide clear instructions and API details for users and developers working with your Registry API.