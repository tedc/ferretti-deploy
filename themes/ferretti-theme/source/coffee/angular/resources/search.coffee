module.exports = ($resource)->
        self = @
        self.url = "#{baseUrl}/wp-json/wp/v2/:type/?per_page=:offset:term:tag&filter[orderby]=:orderby&filter[order]=:order&lang=:lang:checkbox:search"
        search = $resource self.url,
            @url = 
            {
                term: '@term'
                tag: '@tag'
                checkbox: '@checkbox'
                orderby : '@orderby'
                lang : '@lang'
                order : '@order'
                offset : '@offset'
                search : '@search'
            }
            {
                query:
                    method: 'GET'
                    #cache: on
                    isArray: on
            }
        getSearch = {
            get: (obj, cb)->
                search.query {type: obj.type, term : obj.term, tag : obj.tag, orderby: obj.orderby, lang: obj.lang, order : obj.order, checkbox: obj.checkbox, offset : obj.offset, search : obj.search}
                     .$promise.then (result)->
                        console.log obj.checkbox
                        cb result if typeof cb isnt 'undefined'
                        return
                return
        }