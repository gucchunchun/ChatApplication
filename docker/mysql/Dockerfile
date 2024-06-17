FROM mysql/mysql-server:8.0

ARG WORKDIR \
    DOCKERDIR

COPY ${DOCKERDIR}/mysql/my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf

COPY ${DOCKERDIR}/mysql/init/init.sh /docker-entrypoint-initdb.d/init.sh
RUN chmod +x /docker-entrypoint-initdb.d/init.sh
