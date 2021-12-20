## Task
Admin
- [+] Register
- [+] Login - info return token JWT stored localStorage 
- [+] Define Index Panel Admin
- [+] Create Product 
- [-] Settings account 
- [-] Settings recover password
- [+] Expired webNAme
- [-] Create Logo name of project
- [+] Visitory website
External pag 
- [+] Choose template
- [-] Pag main defition
Protection ande resources
- [+] Set Data injection create when get template
- [+] Send template id
- [+] Check if template id is free and account is free
- [+] Check in account is active block or not 
Resources of future
- [-] indicates and win bonus

Rules
- /opt/lampp/htdocs/lin2web/ Only One folder after folder public
- $baseUrl = 'http://localhost/lin2web/admin/';
- $baseUrlOne = 'http://localhost/lin2web/';

Permission folders linux ubuntu
- sudo chmod 777 -R htdocs
- https://stackoverflow.com/questions/17624936/xampp-ubuntu-cant-access-my-project-in-lampp-htdocs

Nex funtionaly for create 
- [-] If expired and more 3 days, website is deleted automaticaly

SETTINGS PHP MyAdmin
Maximum items in branch 150

RENAME TABLE old_db.table TO new_db.table;

\phpmyadmin\libraries\config.default.php
-$cfg['ExecTimeLimit'] = 300;
+$cfg['ExecTimeLimit'] = 0;