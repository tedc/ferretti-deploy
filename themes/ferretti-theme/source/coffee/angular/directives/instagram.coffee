module.exports = ->
    instagram =
        controller : [ '$scope', 'InstagramPosts', ($scope, InstagramPosts)->
            $scope.resize = (url)->
                return url.replace('150x150/', '640x640/')
            $scope.insta = instUrl
            InstagramPosts.get (res)->
                $scope.items = res.data
                console.log $scope.items
                return
            return
        
        ]
        templateUrl: (element, attrs)->
            return "#{assetsPath}/tpl/instagram.tpl.html"