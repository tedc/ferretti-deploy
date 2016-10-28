module.exports = ()->
    serializeData = (data)->
        if not require('angular').isObject data
            string = if not data? then "" else data.toString()
            return string
        buffer = []
        for k, v of data
            if not data.hasOwnProperty k
                continue
            buffer.push "#{encodeURIComponent( k )}=#{encodeURIComponent( if not v? then '' else v )}"
        source = buffer.join( "&" ).replace( /%20/g, "+" )
        return source
    transformRequest = (data, getHeaders)->
        headers = getHeaders()
        headers[ "Content-type" ] = "application/x-www-form-urlencoded; charset=utf-8";
        serializeData data