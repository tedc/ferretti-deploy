mapInit = require '../../core/map.coffee'
module.exports = ($timeout, loadGoogleMapAPI, $compile)->
    map =
        controller : ["$scope", "$rootScope", ($scope, $rootScope)->  
            $scope.zoom = (cond)->
                if cond
                    window.map.setZoom window.map.getZoom() + 1
                else
                    window.map.setZoom window.map.getZoom() - 1 
                return
            $scope.pin = (pinCond)->
                $rootScope.isInfo = pinCond
                return
            $scope.direction = (address, center)->
                console.log $scope.directionsDisplay, window.map
                waypts = 
                    location : address
                    stopover : on
                $scope.directionsService.route
                    origin: center,
                    destination: address,
                    waypoints: [waypts],
                    optimizeWaypoints: true,
                    travelMode: 'DRIVING'
                , (response, status)->
                    if status is 'OK'
                        $scope.directionsDisplay.setDirections response
                        route = response.routes[0]
                    else
                        console.log status
                return
            return
        ] 
        link: (scope, element, attrs)->
            map = document.getElementById attrs.mapId
            loadGoogleMapAPI.then ->
                mapInit map, scope.$eval(attrs.mapData), scope, $compile
                return
            return