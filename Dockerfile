FROM centos:latest
COPY index.php /var/www/html
COPY db_conn.php /var/www/html
COPY app.sql /tmp/app.sql 
RUN yum install -y httpd mysql 
CMD start mysqld 
ADD db_import.sh /tmp/db_import.sh
RUN chmod +x /tmp/db_import.sh && /tmp/db_import.sh
EXPOSE 80
CMD start httpd
