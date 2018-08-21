local redis = require "resty.redis"

function redisConnect()
    local red = redis:new()

    local ok, err = red:connect(redisHost, redisPort)
    if not ok then
        ngx.log(ngx.CRIT, "failed to connect redis: ", err)
        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end
end

function getRedirectUrl()
    local res, err = red:get(streamName)
    if not res then
        ngx.log(ngx.WARN, "failed to get stream: ", streamName,  " ",err)

        ngx.exit(ngx.HTTP_SERVICE_UNAVAILABLE)
    end

    if res == ngx.null then
        ngx.log(ngx.WARN, "Stream not found: ", streamName)

        ngx.exit(ngx.HTTP_NOT_FOUND)
    end

    return res
end