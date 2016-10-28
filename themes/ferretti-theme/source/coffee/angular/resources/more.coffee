module.exports = ($resource, cacheService)->
        post = $resource "#{baseUrl}/wp-json/wp/v2/:types/?offset=:offset:term:tag&per_page=:more&filter[order]=:order&filter[orderby]=:orderby&lang=:lang:checkbox:search",
            {
                types : '@types'
                offset: '@offset'
                term: '@term'
                tag : '@tag'
                lang : '@lang'
                more : '@more'
                order : '@order'
                orderby : '@orderby'
                checkbox : '@checkbox'
            }
            {
                query:
                    method: 'GET'
                    cache: on
                    isArray: on
            }
        getPost = {
            get: (obj, cb)->
                cached = cacheService.getData "#{obj.types}_#{obj.offset}_#{obj.term}_#{obj.search}"
                if cached isnt off
                    cb cached.data if typeof cb isnt 'undefined'
                else
                    post.query {types: obj.types, offset : obj.offset, term : obj.term, lang: obj.lang, more : obj.more, tag : obj.tag, order : obj.order, orderby : obj.orderby, checkbox: obj.checkbox, search : obj.search}
                         .$promise.then (result)->
                            now = new Date()
                            exp = now.getTime() + 60 * 60 * 1000
                            cacheService.setData "#{obj.types}_#{obj.offset}_#{obj.term}_#{obj.search}",
                                {
                                    created: now.getTime()
                                    expiration : exp
                                    data : result
                                }
                            cb result if typeof cb isnt 'undefined'
                            return
                return
        }
    