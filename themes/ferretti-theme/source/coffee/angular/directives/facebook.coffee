module.exports = ->
    facebook =
        controller : [ '$scope', 'FacebookReviews', ($scope, FacebookReviews)->
            $scope.range = (min, max)->
                input = []
                for i in [min..max]
                    input.push i
                return input
            FacebookReviews.get (res)->
                $scope.reviews = res
                $scope.max = res.length - 1
                console.log $scope.max
                return
            return
        
        ]
        templateUrl: (element, attrs)->
            return "#{assetsPath}/tpl/facebook.tpl.html"