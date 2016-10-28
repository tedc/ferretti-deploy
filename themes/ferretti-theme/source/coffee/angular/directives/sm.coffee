em = (val)->
    val/16
module.exports = ($window)->
    sm =
        link: (scope, element, attrs)->
            #return off if require '../../core/isMobile'
            w = angular.element $window
            duration = if attrs.duration and attrs.duration.indexOf('%') isnt -1 then attrs.duration else (if attrs.duration then scope.$eval attrs.duration else off)
            trigger = if attrs.triggerElement then attrs.triggerElement else element[0]
            trigger = if trigger is 'parent' then element.parent()[0] else trigger
            el = if attrs.triggerElement and attrs.triggerElement.indexOf('#') isnt -1 then document.querySelector(attrs.triggerElement) else trigger
            hook = if attrs.triggerHook then attrs.triggerHook else 0.5
            if typeof hook is "number"
                winPer = hook + 1
            else
                if hook is 'onEnter'
                    winPer = 2
                else if hook is 'onLeave'
                    winPer = 1
                else if hook is 'onCenter'
                    winPer = 1.5
            duration = if attrs.heightDuration then el.offsetHeight * attrs.heightDuration + ( window.innerHeight * winPer ) else duration
            offset = if attrs.offset then scope.$eval attrs.offset else 0
            from = if attrs.from then scope.$eval attrs.from else off
            to = if attrs.to then scope.$eval attrs.to else off
            speed = if attrs.speed then scope.$eval attrs.speed else .5
            tween = if from and to then TweenMax.fromTo( element, speed, from, to ) else (if from then TweenMax.from(element, speed, from) else TweenMax.to element, .5, to)
            props = 'opacity,visibility,transform,zIndex'
            sm = new ScrollMagic.Scene
                        triggerElement : trigger
                        triggerHook : hook
                        offset : offset
                        duration : duration
                    .setTween tween
                    .addTo controller
            if not Modernizr.mq("screen and (min-width: #{em(850)}em)")
                controller.enabled off if controller.enabled()
                TweenMax.set element,
                    clearProps : props
            controller.update on
            w.bind 'resize', ->
                if Modernizr.mq("screen and (min-width: #{em(850)}em)")
                    controller.enabled on if not controller.enabled()
                else 
                    TweenMax.set element,
                        clearProps : props
                    controller.enabled off if controller.enabled()
                controller.update on
                return
            return