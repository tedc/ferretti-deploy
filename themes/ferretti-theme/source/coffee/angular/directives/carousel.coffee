module.exports = ->
    carousel = 
        scope: on
        controller : ['$scope', "$element", "$attrs", "$timeout", "$window", ($scope, $element, $attrs, $timeout, $window)->
            $scope.pos = 0
            speed = 1
            w = angular.element $window
            $scope.dir = (cond, pos, max)->
                #return if (pos - 1 < 0 and not cond) or (pos + 1 > max and cond)
                return if $scope.isSliding
                $scope.isSliding = on
                if cond
                    pos += 1
                else
                    pos -= 1
                pos = if pos < 0 then max else (if pos > max then 0 else pos)
                $scope.pos = pos
                TweenMax
                    .staggerTo $element[0].querySelectorAll('.carousel-item'), speed,
                        x : "-#{100*$scope.pos}%"
                        #ease: Power3.easeOut
                classTimeout = $timeout ->
                    $timeout.cancel classTimeout
                    $scope.isSliding = off
                    return
                , speed*1000
                return
             return
        ]