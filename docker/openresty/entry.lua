local stream = require('/var/www/cpiapps/docker/openresty/stream')
local lead = require('/var/www/cpiapps/docker/openresty/lead')

local streamUuid = ngx.var.uri:gsub("/", "")
if streamUuid == "" then
    ngx.exit(ngx.HTTP_NOT_FOUND)
end

stream.redisConnect(ngx.var.redisHost, ngx.var.redisPort);
local redirectUrl = stream.getRedirectUrl(streamUuid);

if redirectUrl == ngx.null then
    ngx.exit(ngx.HTTP_NOT_FOUND)
end

lead.rmqConnect(ngx.var.rmqHost, ngx.var.rmqPort, ngx.var.rmqUsername, ngx.var.rmqPass, ngx.var.rmqVhost)
lead.rmqSend({
    agent = ngx.var.http_user_agent,
    streamUuid = streamUuid,
    referrer = ngx.var.http_referer,
    ip = ngx.var.remote_addr
})

return ngx.redirect(redirectUrl)