# EzyShort
Welcome to EzyShort, a simple link shortening tool built in PHP. This tool was specifically designed for creating shortened links for BIO pages, making it easier to share links on social media and other platforms with limited space. 

With EzyShort, all you need to do is input the desired long link and our tool will generate a shortened version for you. Simply copy and paste the shortened link wherever you need it and voila, your long link is now easily shareable. 

Please note that I am not actively seeking out vulnerabilities in this tool. If you do come across any issues, please let me know so I can address them promptly. 

Try out EzyShort today and see how it can simplify your link sharing process. 

## Setup
1. Clone this repository
2. Set up a web server with PHP support. 
3. Access the setup.php file and configure a unique token.
4. Remove the setup.php file from the server.
5. You're all set!

## How to Use
To create a shortened link using EzyShort, send a GET request to the create.php file with the following parameters:
- token: The unique token you set up during the initial setup process.
- name: The desired name for your shortened link.
- url: The destination URL for the shortened link.

Upon successful creation of the shortened link, a HTML page will be returned with the shortened link displayed. For example: 
"Link created. localhost?l=[name]"