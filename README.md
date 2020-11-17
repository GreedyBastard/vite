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
-implemented Vite wallet address validation
based on checksum calculation (together with Allen@ViteLabs)
- added error handling

