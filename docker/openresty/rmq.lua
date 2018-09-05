local rmq = {}

rmq.rabbitmqPackage = require "resty.rabbitmqstomp"
rmq.cjson = require "cjson"

function rmq.rmqConnect(rmqHost, rmqPort, rmqUsername, rmqPass, rmqVhost)
    local opts = {
        username = rmqUsername,
        password = rmqPass,
        vhost = rmqVhost
    }

    local err;
    rmq.mq, err = rmq.rabbitmqPackage:new(opts)
    if err then
        ngx.log(ngx.ERR, 'rmq: error ', err)
        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end

    local ok, err = rmq.mq:connect(rmqHost, rmqPort)

    if not ok or err then
        ngx.log(ngx.CRIT, "rmq: failed to connect: ", err)
        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end
end

function rmq.rmqSend(message, destionation)
    local headers = {}
    headers["destination"] = destionation
    headers["app-id"] = "luaresty"
    headers["persistent"] = "true"
    headers["content-type"] = "application/json"

    local ok, err = rmq.mq:send(rmq.cjson.encode(message), headers)
    if not ok or err then
        ngx.log(ngx.CRIT, "rmq: failed to send message: ", err)
        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end

    ngx.log(ngx.DEBUG, "Message published" .. rmq.cjson.encode(message) .. " with headers" .. rmq.cjson.encode(headers))

    return true
end

return rmq