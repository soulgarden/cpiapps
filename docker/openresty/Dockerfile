FROM openresty/openresty:alpine

RUN apk update && apk add git make

RUN git clone https://github.com/wingify/lua-resty-rabbitmqstomp.git && cd lua-resty-rabbitmqstomp && make install