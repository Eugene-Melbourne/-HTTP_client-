
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

the last example

http://homestead.test/send_http_request_with_json_parameters_and_json_payload?q={"request_method":"POST","url":"https://www.mydomain.com/assessment-endpoint.php","http_headers":["Authorization: Bearer TOKEN", "Content-type: application/json"]}

        {
          "name": "Eugene",
          "email": "test@gmail.com",
          "url": "https://github.com/Eugene-Melbourne/-HTTP_client-"
        }

Example response :

    400 Bad Request