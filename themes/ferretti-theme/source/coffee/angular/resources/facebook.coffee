module.exports = ($resource, cacheService)->
        self.url = "/wp-json/api/v1/facebook"
        source = $resource self.url,
            {
                callback: 'JSON_CALLBACK'
            },
            {
                query: 
                    method: 'GET'
                    cache: on
                    isArray: on
            }
        getResults = {
            get: (cb)->
                cached = cacheService.getData "reviews"
                if cached isnt off
                    cb cached.data if typeof cb isnt 'undefined'
                else
                    source.query (result)->
                        now = new Date()
                        exp = now.getTime() + 60 * 60 * 1000
                        cacheService.setData 'instagram',
                            {
                                created: now.getTime()
                                expiration : exp
                                data : result
                            }
                        cb result if typeof cb isnt 'undefined'
                        return
                self.current++
                return
        }