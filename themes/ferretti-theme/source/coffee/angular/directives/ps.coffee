module.exports = ($window)->
    ps =
        link : (scope, element, attrs)->
            jqWindow = angular.element $window
            scope.$evalAsync ->
                Ps.initialize element[0],
                    wheelPropagation : off
                    suppressScrollX : on
                return
            update = ->
                scope.$evalAsync ()->
                    Ps.update element[0]
                    return
                return
            element.bind 'mouseenter', update
            if attrs.refreshOnChange
                scope.$watchCollection attrs.refreshOnChange, ->
                    update()
                    return
            jqWindow.bind('resize', update) if attrs.refreshOnResize
            element.bind '$destroy', ()->
                jqWindow.unbind 'resize', update
                Ps.destroy element[0]
                return
#            element.bind 'ps-scroll-y', (event)->
#                console.log event
#                return
            return