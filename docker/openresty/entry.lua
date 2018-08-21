local lead = require "/var/www/cpiapps/docker/openresty/lead.lua"
local stream = require "/var/www/cpiapps/docker/openresty/stream.lua"

local redisHost = "160.10.101.4";
local redisPort = "6379";

local rmqHost = "160.10.101.5";
local rmqPort = "61613";

local streamName = "stream";



return ngx.redirect(res);