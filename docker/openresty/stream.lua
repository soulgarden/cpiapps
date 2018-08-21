local stream = {}

stream.redisPackage = require "resty.redis"
stream.redis = stream.redisPackage:new()

function stream.redisConnect(redisHost, redisPort)
    local ok, err = stream.redis:connect(redisHost, redisPort)
    if not ok then
        ngx.log(ngx.CRIT, "redis: failed to connect: ", err)
        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end
end

function stream.getRedirectUrl(streamName)
    local res, err = stream.redis:get(streamName)
    if not res then
        ngx.log(ngx.WARN, "redis: failed to get stream: ", streamName, " ", err)

        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end

    if res == ngx.null then
        ngx.log(ngx.WARN, "redis: stream not found: ", streamName)
    end

    return res
end

return stream