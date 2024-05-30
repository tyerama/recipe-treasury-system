# serve_html.py
from http.server import HTTPServer, BaseHTTPRequestHandler
from subprocess import check_output

class SimpleHTTPRequestHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        self.send_response(200)
        self.send_header('Content-type', 'text/html')
        self.end_headers()

        # Run ML_rcmnd.py and capture its output
        output_bytes = check_output(['python', 'ML_rcmnd.py', 'chicken', '45', '6'])
        output_str = output_bytes.decode('utf-8')

        # Send the output as HTML response
        self.wfile.write(output_str.encode('utf-8'))

httpd = HTTPServer(('localhost', 8000), SimpleHTTPRequestHandler)
print('Serving HTTP on localhost port 8000...')
httpd.serve_forever()
