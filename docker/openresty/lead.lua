local rabbitmq = require "resty.rabbitmqstomp"
local cjson = require "cjson"

local strlen =  string.len


function rmq_connect()
    local msg = {key="value1", key2="value2"}
    local headers = {}
    headers["destination"] = "/exchange/test/binding"
    headers["receipt"] = "msg#1"
    headers["app-id"] = "luaresty"
    headers["persistent"] = "true"
    headers["content-type"] = "application/json"

    local ok, err = mq:send(cjson.encode(msg), headers)
    if not ok then
        return
    end
    ngx.log(ngx.INFO, "Published: " .. msg)local msg = {key="value1", key2="value2"}
    local headers = {}
    headers["destination"] = "/exchange/test/binding"
    headers["receipt"] = "msg#1"
    headers["app-id"] = "luaresty"
    headers["persistent"] = "true"
    headers["content-type"] = "application/json"

    local ok, err = mq:send(cjson.encode(msg), headers)
    if not ok then
        return
    end
    ngx.log(ngx.INFO, "Published: " .. msg)
end


function rmq_publish()
    local msg = {key="value1", key2="value2"}
    local headers = {}
    headers["destination"] = "/exchange/test/binding"
    headers["receipt"] = "msg#1"
    headers["app-id"] = "luaresty"
    headers["persistent"] = "true"
    headers["content-type"] = "application/json"

    local ok, err = mq:send(cjson.encode(msg), headers)
    if not ok then
        return
    end
    ngx.log(ngx.INFO, "Published: " .. msg)
end