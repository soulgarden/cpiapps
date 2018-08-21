local lead = {}

lead.rabbitmqPackage = require "resty.rabbitmqstomp"
lead.cjson = require "cjson"

function lead.rmqConnect(rmqHost, rmqPort, rmqUsername, rmqPass, rmqVhost)
    local opts = {
        username = rmqUsername,
        password = rmqPass,
        vhost = rmqVhost
    }

    lead.mq = lead.rabbitmqPackage:new(opts)

    local ok, err = lead.mq:connect(rmqHost, rmqPort)

    if not ok then
        ngx.log(ngx.CRIT, "rmq: failed to connect: ", err)
        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end
end

function lead.rmqSend(message)
    local headers = {}
    headers["destination"] = "/exchange/lead"
    headers["app-id"] = "luaresty"
    headers["persistent"] = "true"
    headers["content-type"] = "application/json"

    local ok, err = lead.mq:send(lead.cjson.encode(message), headers)
    if not ok then
        ngx.log(ngx.CRIT, "rmq: failed to send message: ", err)
        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end

    return true
end

return lead