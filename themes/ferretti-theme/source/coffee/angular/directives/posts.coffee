module.exports = ->
    load = 
        controller: ['$rootScope', 'getPosts', "$scope", "$sce", ($rootScope, getPosts, $scope, $sce)->
            taxonomy =
                posts : 'cat'
                product : 'product_cat'
                ricette : 'recipe_cat'
            $rootScope.posts = []
            $rootScope.count = 0
            $scope.hideMore = off
            $rootScope.search = ''
            $rootScope.loadMorePosts = (t, c, l, m, s)->
                return if $rootScope.isLoading
                $rootScope.isLoading = true
                tax = taxonomy[t]
                term = if c then "&filter[#{taxonomy[t]}]=#{c}" else ''
                if t is 'product'
                    term = if $rootScope.productCat? and typeof $rootScope.productCat isnt 'undefined' and $rootScope.productCat isnt '' then $rootScope.productCat else term
                tag = if $rootScope.productTag? and typeof $rootScope.productTag isnt 'undefined' and $rootScope.productTag isnt '' then $rootScope.productTag else ''
                orderby = if $rootScope.filterData.orderby? and typeof $rootScope.filterData.orderby isnt 'undefined' and $rootScope.filterData.orderby isnt '' then $rootScope.filterData.orderby else 'date'
                order = if $rootScope.filterData.order? and typeof $rootScope.filterData.order isnt 'undefined' and $rootScope.filterData.order isnt '' then $rootScope.filterData.order else 'desc'
                $rootScope.count += posts_per_page
                $rootScope.search = if s? and typeof s isnt 'undefined' and s isnt "" then "&search=#{s}" else ''
                
                $rootScope.hideMore = if $rootScope.count >= m - posts_per_page then on else off    
                return if $rootScope.count >= m
                obj =
                    types: t, 
                    offset : $rootScope.count, 
                    term : term, 
                    lang: l, 
                    more : posts_per_page, 
                    tag : tag, 
                    order : order, 
                    orderby : orderby, 
                    checkbox: $rootScope.checkbox, 
                    search : $rootScope.search
                    
                getPosts.get obj, (res)->
                    $rootScope.posts = $rootScope.posts.concat res
                    $rootScope.isLoading = false
                    return
                return
            return
        ]