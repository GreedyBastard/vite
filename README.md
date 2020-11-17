# ViteX FullNode Online Checker

Can be started on any web server with php 7.2+ and no execution timeout restrictions.

v01:
- basic functionality
- preloader
- extreme address validation via vite block explorer (therefore quite slow)
- http response code validation (slow)
- direct API calls while fetching cycles (slow)

v02:
- HTTP validation mechanisms replaced (fast)
- Vite wallet address validation based on vitejs->function isValidAddress($address)
- fetching cycle json data during first query
- storing cycle json data on web server
- cleanup mechanism for cycle json files older than 7 days

v03:
- implemented Vite wallet address validation based on checksum calculation (together with Allen@ViteLabs)
- added error handling

HOW-TO:
1. Download and install Xampp on your windows machine.
2. Open Xampp control panel and start apache service.
3. Download latest version of FullNode Online Checker (eg. v3) and put it into C:\xampp\htdocs\
4. Open your web browser and navigate to:
https://localhost/vitex/v03/

Or...
just upload latest version to your webserver ;)
