
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

    GET http://homestead.test/send_http_request?request_method=GET&url=https://google.com&http_headers={"Content-Type": "text/html; charset=ISO-8859-1"}

Another option

    GET http://homestead.test/send_http_request_with_json_parameters?q={"request_method":"GET","url":"https://google.com","http_headers":{"Content-Type": "text/html; charset=ISO-8859-1"}}

404 example

    GET http://homestead.test/send_http_request_with_json_parameters?q={"request_method":"GET","url":"https://httpbin.org/get_404","http_headers":{"Content-Type": "text/html; charset=ISO-8859-1"}}

JsonDecodeException example

    GET http://homestead.test/send_http_request_with_json_parameters?q={"request_method":"GET","url":"https://httpbin.org/get_404,"http_headers":{"Content-Type": "text/html; charset=ISO-8859-1"}}

WWW-FORM POST example from json body

    GET http://homestead.test/send_http_request_with_json_parameters_and_json_payload?q={"request_method":"POST","url":"https://httpbin.org/post","http_headers":{"Content-type": "application/x-www-form-urlencoded"}}

body

    {
        "ok": "1",
        "payload": [
            "data"
        ]
    }

Example response :

    {
        "ok": "1",
        "payload": {
            "function": "getSendJson",
            "request_method": "POST",
            "url": "https://httpbin.org/post",
            "http_request_headers": {
                "Content-type": "application/x-www-form-urlencoded",
                "Content-Length": "24"
            },
            "request_body": {
                "ok": "1",
                "payload": [
                    "data"
                ]
            },
            "http_response_headers": [
                "HTTP/1.1 200 OK",
                "Date: Mon, 24 Aug 2020 05:03:53 GMT",
                "Content-Type: application/json",
                "Content-Length: 395",
                "Connection: close",
                "Server: gunicorn/19.9.0",
                "Access-Control-Allow-Origin: *",
                "Access-Control-Allow-Credentials: true"
            ],
            "response_string": "{\n  \"args\": {}, \n  \"data\": \"\", \n  \"files\": {}, \n  \"form\": {\n    \"ok\": \"1\", \n    \"payload[0]\": \"data\"\n  }, \n  \"headers\": {\n    \"Content-Length\": \"24\", \n    \"Content-Type\": \"application/x-www-form-urlencoded\", \n    \"Host\": \"httpbin.org\", \n    \"X-Amzn-Trace-Id\": \"Root=1-5f434a39-490bae6da62a47568192293f\"\n  }, \n  \"json\": null, \n  \"origin\": \"124.183.144.55\", \n  \"url\": \"https://httpbin.org/post\"\n}\n",
            "response": {
                "args": [],
                "data": "",
                "files": [],
                "form": {
                    "ok": "1",
                    "payload[0]": "data"
                },
                "headers": {
                    "Content-Length": "24",
                    "Content-Type": "application/x-www-form-urlencoded",
                    "Host": "httpbin.org",
                    "X-Amzn-Trace-Id": "Root=1-5f434a39-490bae6da62a47568192293f"
                },
                "json": "",
                "origin": "124.183.144.55",
                "url": "https://httpbin.org/post"
            }
        }
    }

The final example - JSON

    GET http://homestead.test/send_http_request_with_json_parameters_and_json_payload?q={"request_method":"POST","url":"https://httpbin.org/post","http_headers":{"Authorization": "Bearer TOKEN", "Content-type": "application/json"}}

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
            "http_request_headers": {
                "Authorization": "Bearer TOKEN",
                "Content-type": "application/json",
                "Content-Length": "104"
            },
            "request_body": {
                "name": "Eugene",
                "email": "test@gmail.com",
                "url": "https://github.com/Eugene-Melbourne/-HTTP_client-"
            },
            "http_response_headers": [
                "HTTP/1.1 200 OK",
                "Date: Mon, 24 Aug 2020 05:05:05 GMT",
                "Content-Type: application/json",
                "Content-Length: 612",
                "Connection: close",
                "Server: gunicorn/19.9.0",
                "Access-Control-Allow-Origin: *",
                "Access-Control-Allow-Credentials: true"
            ],
            "response_string": "{\n  \"args\": {}, \n  \"data\": \"{\\\"name\\\":\\\"Eugene\\\",\\\"email\\\":\\\"test@gmail.com\\\",\\\"url\\\":\\\"https:\\\\/\\\\/github.com\\\\/Eugene-Melbourne\\\\/-HTTP_client-\\\"}\", \n  \"files\": {}, \n  \"form\": {}, \n  \"headers\": {\n    \"Authorization\": \"Bearer TOKEN\", \n    \"Content-Length\": \"104\", \n    \"Content-Type\": \"application/json\", \n    \"Host\": \"httpbin.org\", \n    \"X-Amzn-Trace-Id\": \"Root=1-5f434a81-dcabdce9f4602fa123679ebf\"\n  }, \n  \"json\": {\n    \"email\": \"test@gmail.com\", \n    \"name\": \"Eugene\", \n    \"url\": \"https://github.com/Eugene-Melbourne/-HTTP_client-\"\n  }, \n  \"origin\": \"124.183.144.55\", \n  \"url\": \"https://httpbin.org/post\"\n}\n",
            "response": {
                "args": [],
                "data": "{\"name\":\"Eugene\",\"email\":\"test@gmail.com\",\"url\":\"https:\\/\\/github.com\\/Eugene-Melbourne\\/-HTTP_client-\"}",
                "files": [],
                "form": [],
                "headers": {
                    "Authorization": "Bearer TOKEN",
                    "Content-Length": "104",
                    "Content-Type": "application/json",
                    "Host": "httpbin.org",
                    "X-Amzn-Trace-Id": "Root=1-5f434a81-dcabdce9f4602fa123679ebf"
                },
                "json": {
                    "email": "test@gmail.com",
                    "name": "Eugene",
                    "url": "https://github.com/Eugene-Melbourne/-HTTP_client-"
                },
                "origin": "124.183.144.55",
                "url": "https://httpbin.org/post"
            }
        }
    }