FROM openresty/openresty:alpine

RUN apk update && apk add git make

RUN git clone https://github.com/wingify/lua-resty-rabbitmqstomp.git && cd lua-resty-rabbitmqstomp && make install
RUN git clone https://github.com/thibaultcha/lua-resty-jit-uuid.git && cp /lua-resty-jit-uuid/lib/resty/jit-uuid.lua /usr/local/openresty/lualib/resty/jit-uuid.lua
RUN git clone https://github.com/cloudflare/lua-resty-cookie.git && cd lua-resty-cookie && make install PREFIX=/usr/local/openresty LUA_LIB_DIR=/usr/local/openresty/lualib