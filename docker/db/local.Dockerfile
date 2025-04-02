FROM mysql:8.0

COPY files/initial.sql.tpl /docker-entrypoint-initdb.d/init.sql.tpl
COPY files/mysql.cnf /etc/percona-server.conf.d/cutom.cnf
COPY files/envsubst /usr/local/bin/envsubst

ARG MYSQL_USER
ARG MYSQL_DATABASE

USER root
RUN chmod +x /usr/local/bin/envsubst
RUN envsubst '${MYSQL_USER},${MYSQL_DATABASE}' < '/docker-entrypoint-initdb.d/init.sql.tpl' > '/docker-entrypoint-initdb.d/init.sql'

USER mysql
