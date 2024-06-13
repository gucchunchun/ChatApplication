FROM node:16-alpine as node
FROM nginx:1.22-alpine
SHELL ["/bin/ash", "-oeux", "pipefail", "-c"]

ARG WORKDIR \
    DOCKERDIR

ENV TZ={TZ}

RUN apk update && \
  apk add --update --no-cache --virtual=.build-dependencies g++
  
# node command
COPY --from=node /usr/local/bin /usr/local/bin
# npm command
COPY --from=node /usr/local/lib /usr/local/lib
# yarn command
COPY --from=node /opt /opt
# nginx config file
COPY ${DOCKERDIR}/nginx/*.conf /etc/nginx/conf.d/

WORKDIR ${WORKDIR}