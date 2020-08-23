
# -HTTP_client-

Makes HTTP requests.
No dependencies.
No external libraries have been used.
All code is hand-written.
No explicit use of CURL (e.g. curl_exec()) has been used.


Example of use 

Send HTTP requests to the given URL using different methods, such as GET, POST, etc.
Retrieve/parse HTTP response headers
Retrieve HTTP response payloads
All JSON payloads have been returned as associative arrays
Send custom HTTP headers

     http://homestead.test/send_http_request?request_method=GET&url=https://google.com&http_headers=Content-Type: text/html; charset=ISO-8859-1


Comming soon

Send JSON payloads
All JSON payloads must be passed in as associative arrays
Any JSON conversion errors must throw an exception
Erroneous HTTP response codes (e.g. 4xx, 5xx) must throw an exception




