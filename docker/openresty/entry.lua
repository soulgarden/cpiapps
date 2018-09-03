local ck = require "resty.cookie"
local uuid = require 'resty.jit-uuid'
local stream = require('/var/www/cpiapps/docker/openresty/stream')
local rmq = require('/var/www/cpiapps/docker/openresty/rmq')

local streamUuid = ngx.var.uri:gsub("/", "")
if streamUuid == "" then
    ngx.exit(ngx.HTTP_NOT_FOUND)
end

stream.redisConnect(ngx.var.redisHost, ngx.var.redisPort);
local redirectUrl = stream.getRedirectUrl(streamUuid);

if redirectUrl == ngx.null then
    ngx.exit(ngx.HTTP_NOT_FOUND)
end

local hitInfo = {
    agent = ngx.var.http_user_agent,
    streamUuid = streamUuid,
    referrer = ngx.var.http_referer,
    ip = ngx.var.remote_addr,
    uuid = uuid.generate_v4()
}

rmq.rmqConnect(ngx.var.rmqHost, ngx.var.rmqPort, ngx.var.rmqUsername, ngx.var.rmqPass, ngx.var.rmqVhost)
rmq.rmqSend(hitInfo, "/exchange/hit")

local cookie, err = ck:new()

local hostUuid, err = cookie:get("stream:" .. streamUuid)
if hostUuid then
    return ngx.redirect(redirectUrl)
end

hostUuid = uuid.generate_v4()

local ok, err = cookie:set({
    key = "stream:" .. streamUuid,
    value = hostUuid,
    path = "/",
    httponly = true,
    expires = ngx.cookie_time(ngx.time() + 60 * 60 * 24)
})

local hostInfo = {
    agent = ngx.var.http_user_agent,
    streamUuid = streamUuid,
    referrer = ngx.var.http_referer,
    ip = ngx.var.remote_addr,
    uuid = hostUuid
}

rmq.rmqSend(hostInfo, "/exchange/host")
rmq.rmqSend({
    agent = ngx.var.http_user_agent,
    streamUuid = streamUuid,
    referrer = ngx.var.http_referer,
    ip = ngx.var.remote_addr,
    hostUuid = hostUuid
}, "/exchange/lead")

return ngx.redirect(redirectUrl)