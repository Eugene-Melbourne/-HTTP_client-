
# -HTTP_client-

Makes HTTP requests.
No dependencies.
No external libraries have been used.
All code is hand-written.
No explicit use of CURL (e.g. curl_exec()) has been used.


#### It can

* Send HTTP requests to the given URL using different methods, such as GET, POST, etc.
* Retrieve/parse HTTP response headers
* Retrieve HTTP response payloads
* All JSON payloads have been returned as associative arrays
* Send custom HTTP headers
* Erroneous HTTP response codes (e.g. 4xx, 5xx) throw an exception
* Any JSON conversion errors throw an exception
* Send JSON payloads
* All JSON payloads can be passed in as associative arrays

#### Example of use 

    http://homestead.test/send_http_request?request_method=GET&url=https://google.com&http_headers=Content-Type: text/html; charset=ISO-8859-1

Another option

    http://homestead.test/send_http_request_with_json_parameters?q={"request_method":"GET","url":"https://google.com","http_headers":["Content-Type: text/html; charset=ISO-8859-1"]}

404 example

    http://homestead.test/send_http_request_with_json_parameters?q={"request_method":"GET","url":"https://httpbin.org/get_404","http_headers":["Content-Type: text/html; charset=ISO-8859-1"]}

JsonDecodeException example

    http://homestead.test/send_http_request_with_json_parameters?q={"request_method":"GET","url":"https://httpbin.org/get_404,"http_headers":["Content-Type: text/html; charset=ISO-8859-1"]}

POST example with json body

    http://homestead.test/send_http_request_with_json_parameters_and_json_payload?q={"request_method":"POST","url":"https://httpbin.org/post","http_headers":["Content-type: application/x-www-form-urlencoded"]}

body

    {
        "ok": "1",
        "payload": [
            "data"
        ]
    }

The final example

    http://homestead.test/send_http_request_with_json_parameters_and_json_payload?q={"request_method":"POST","url":"https://httpbin.org/post","http_headers":["Authorization: Bearer TOKEN", "Content-type: application/json"]}

body 

    {
      "name": "Eugene",
      "email": "test@gmail.com",
      "url": "https://github.com/Eugene-Melbourne/-HTTP_client-"
    }

Example response :

    {
        "ok": "1",
        "payload": {
            "function": "getSendJson",
            "request_method": "POST",
            "url": "https://httpbin.org/post",
            "http_request_headers": [
                "Authorization: Bearer TOKEN",
                "Content-type: application/json",
                "Content-Length: 98",
                "Host: httpbin.org"
            ],
            "request_body": {
                "name": "Eugene",
                "email": "test@gmail.com",
                "url": "https://github.com/Eugene-Melbourne/-HTTP_client-"
            },
            "http_response_headers": [
                "HTTP/1.1 200 OK",
                "Date: Mon, 24 Aug 2020 03:25:07 GMT",
                "Content-Type: application/json",
                "Content-Length: 470",
                "Connection: close",
                "Server: gunicorn/19.9.0",
                "Access-Control-Allow-Origin: *",
                "Access-Control-Allow-Credentials: true"
            ],
            "response_string": "{\n  \"args\": {}, \n  \"data\": \"name=Eugene&email=test%40gmail.com&url=https%3A%2F%2Fgithub.com%2FEugene-Melbourne%2F-HTTP_client-\", \n  \"files\": {}, \n  \"form\": {}, \n  \"headers\": {\n    \"Authorization\": \"Bearer TOKEN\", \n    \"Content-Length\": \"98\", \n    \"Content-Type\": \"application/json\", \n    \"Host\": \"httpbin.org\", \n    \"X-Amzn-Trace-Id\": \"Root=1-5f433313-d089c8ecd1826d68ad928ca8\"\n  }, \n  \"json\": null, \n  \"origin\": \"124.183.144.55\", \n  \"url\": \"https://httpbin.org/post\"\n}\n",
            "response": {
                "args": [],
                "data": "name=Eugene&email=test%40gmail.com&url=https%3A%2F%2Fgithub.com%2FEugene-Melbourne%2F-HTTP_client-",
                "files": [],
                "form": [],
                "headers": {
                    "Authorization": "Bearer TOKEN",
                    "Content-Length": "98",
                    "Content-Type": "application/json",
                    "Host": "httpbin.org",
                    "X-Amzn-Trace-Id": "Root=1-5f433313-d089c8ecd1826d68ad928ca8"
                },
                "json": "",
                "origin": "124.183.144.55",
                "url": "https://httpbin.org/post"
            }
        }
    }