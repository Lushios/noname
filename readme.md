Hello. This is a readme file for the blog made with Laravel framework by Lushios.
I used the following setup:
Project was located in "C://xxamp/htdocs/noname" folder

I added the following lines to "C://xxamp/apache/conf/extra/httpd-vhosts.conf"

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs"
    ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/noname/public"
    ServerName noname.test
</VirtualHost>

I also added the following lines to "C://Windows/System32/drivers/etc/hosts" (you should open it as administrator)

127.0.0.1 localhost
127.0.0.1 noname.test

That's it. You will also need to run a migration with a "php artisan migrate" command. In case a database itself won't be created, create a database called "noname" manually.