module.exports = ->
    filters =
        controller : ['$rootScope', "getSearch", ($rootScope, getSearch)->
            offset = posts_per_page
            $rootScope.isFiltered = false
            $rootScope.countFilters = 0
            $rootScope.filterData =
                orderby : 'date'
                order : 'desc'
                cat : []
                tag : []
                check : 
                    instock : []
                    onsale : []
            $rootScope.filters = (array, value, cond)->
                if cond
                    $rootScope.countFilters += 1
                    array.push value
                else
                    $rootScope.countFilters -= 1
                    idx = array.indexOf value
                    array.splice(idx, 1) if idx isnt -1
                return
            $rootScope.filtersText = (string)->
                value = if $rootScope.countFilters > 0 then "#{string}: <strong>#{$rootScope.countFilters}</strong> " else ''
            type = 'product'
            $rootScope.applyFilters = (lang)->
                return if $rootScope.isApplying
                $rootScope.isFiltered = true
                $rootScope.isApplying = true
                term = if $rootScope.filterData.cat.length > 0 then "&filter[product_cat]=#{$rootScope.filterData.cat.join()}" else ''
                tag = if $rootScope.filterData.tag.length > 0 then "&filter[product_tag]=#{$rootScope.filterData.tag.join()}" else ''
                $rootScope.productTag = tag
                $rootScope.productCat = term
                i = 0
                checkbox = ''
                for k, v of $rootScope.filterData.check
                    if k is 'instock'
                        value = if v.length > 0 then 'outofstock' else 'instock'
                        checkbox += "&filter[meta_query][#{i}][key]=_stock_status&filter[meta_query][#{i}][value]=#{value}"
                    if k is 'onsale'
                        sale_price = if v.length > 0 then "&filter[meta_query][#{i}][key]=_sale_price&filter[meta_query][#{i}][value]=1&filter[meta_query][#{i}][compare]=>=" else ''
                        checkbox += sale_price
                    i++
                checkbox = if checkbox isnt '' then "&filter[meta_query][relation]=and#{checkbox}" else ''  
                $rootScope.checkbox = checkbox
                obj =
                    type : type
                    term : $rootScope.productCat
                    tag : $rootScope.productTag
                    orderby : $rootScope.filterData.orderby
                    checkbox: checkbox
                    lang : lang
                    orer : $rootScope.filterData.order
                    offset : offset
                    search : $rootScope.search
                getSearch.get obj, (res)->
                    elements = document.querySelectorAll '.product-show-more'
                    angular.forEach elements, (i, el)->
                        item = angular.element i
                        item.removeAttr 'ng-sm'
                        item.remove()
                        return
                    $rootScope.posts = res
                    $rootScope.hideMore = if res.length <= posts_per_page then on else off
                    $rootScope.isOrderFilters = false
                    $rootScope.isFilters = false
                    $rootScope.count = 0
                    $rootScope.isApplying = false
                    return
                return
            return
        ]