/*****************************************************
event分 start doing stop

dx 水平移动量，小于是向左，否则向右
dy 垂直移动量，小于向下，否则向上

return false可以随时停止事件callback

config.listen 可选：
 1、a：所有方向的事件
 2、x：监听x方向的事件
 3、y：监听y方向的事件

example:
------------------------------------------------------
$('#test').touchwipe({
    listen : 'x',
    start  :  function(result){
        alert('开始触屏了');
    },
    move   : function(result){
        alert('正在滑动:'+result.dx+"____"+result.dy);
    },
    stop   : function(result){
        alert('结束了');
    }
});
version:1.0
copyright: http://www.mjix.com，测试页面：http://test.mjix.com
*******************************************************/

(function($) {
    $.fn.touchwipe = function(settings) {
        var startX, startY, isMoving = false;
        var dx = 0,
            dy = 0;
        var objs = this;
        var is_y = 0;

        var config = {
            listen: 'a', //监听所有事件 ，可选 x,y
            min_distance: 6, //最小触发距离
            start: function() {},
            move: function() {},
            stop: function() {}
        };

        if (settings) $.extend(config, settings);

        var has_winphone8 = window.navigator.msPointerEnabled;
        if (has_winphone8) { //如果是winphone8
            var START_EV = 'MSPointerDown',
                MOVE_EV = 'MSPointerMove',
                END_EV = 'MSPointerOut',
                CANCEL_EV = 'MSPointerUp';
        } else {
            var has_touch = 'ontouchstart' in window;
            var START_EV = has_touch ? 'touchstart' : 'mousedown',
                MOVE_EV = has_touch ? 'touchmove' : 'mousemove',
                END_EV = has_touch ? 'touchend' : 'mouseup',
                CANCEL_EV = has_touch ? 'touchcancel' : 'mouseout';
        }

        this.each(function() {
            var startX = 0,
                startY = 0,
                _stime = 0,
                _etime = 0,
                dx = 0,
                dy = 0,
                speed = 0,
                du = '',
                dr = 0;

            var _start = function(e, undf) {
                dx = dy = 0;
                du = '';
                this.prevent = true;

                if (e.pageX !== undf || e.targetTouches || (e.touches && e.touches.length == 1)) {
                    this.moving = true;

                    var xe = e.touches || e.targetTouches || [e];
                    startX = xe[0].pageX;
                    startY = xe[0].pageY;
                    _stime = new Date().getTime();

                    config.start.call(this, {
                        'x': startX,
                        'y': startY,
                        'dx': dx,
                        'dy': dy,
                        'du': du
                    });
                }

                e.stopPropagation();
            };

            var _moving = function(e, undf) {
                if (!this.moving) return;

                var xe = e.touches || e.targetTouches || [e];
                dx = startX - xe[0].pageX;
                dy = startY - xe[0].pageY;
                dr = Math.abs(dy) - Math.abs(dx);

                if (du == '') {
                    du = dr > 0 ? 'y' : 'x';
                }

                if (config.listen == 'a' || du == config.listen) {
                    var data = {
                        'x': xe[0].pageX,
                        'y': xe[0].pageY,
                        'dx': dx,
                        'dy': dy,
                        'du': du
                    };
                    if (Math.abs(data['d' + du]) > config.min_distance) {
                        config.move.call(this, {
                            'x': xe[0].pageX,
                            'y': xe[0].pageY,
                            'dx': dx,
                            'dy': dy,
                            'du': du
                        });
                    }
                    if (this.prevent) {
                        e.preventDefault();
                    }
                    return;
                }

                e.stopPropagation();
            };

            var _stop = function(e) {
                if (this.moving) {
                    _etime = new Date().getTime();
                    speed = Math.sqrt((dx * dx + dy * dy), 2) * 1000 / (_etime - _stime);
                    config.stop.call(this, {
                        'dx': dx,
                        'dy': dy,
                        'speed': speed
                    });
                }
                this.moving = false;
            };

            $(this).on(START_EV, _start).on(MOVE_EV, _moving)
            $(this).on(END_EV, _stop).on(CANCEL_EV, _stop);
        });

    };
})($);

/*****************************************************
example:
------------------------------------------------------
$('#test').tabwipe({
    callback : function(index){
        $('.list-style').removeClass('cur').eq(index).addClass('cur');
    }
});

version:1.0
copyright: http://www.mjix.com，测试页面：http://test.mjix.com
*******************************************************/

(function($) {
    $.fn.tabwipe = function(settings) {
        var config = {
            done_process: 0.4, //超过0.4则跳转
            ani_time: 300, //动画时间
            max_speed: 800, //超过速度跳转
            is_circle: true, //循环滚动
            callback: function() {}
        };
        if (settings) $.extend(config, settings);
        var that = $(this).eq(0);

        var main_box = that,
            box_width, tauching = false,
            tauch_stop = 0;
        var index = 0,
            lis = main_box.children(),
            li_len = lis.length;

        var init = function() {
            if (!config.is_circle) return;
            main_box.append(lis.eq(0).clone());
        };

        var _move = function(_index) {
            var o_index = index,
                dis;
            index = _index;
            if (_index < 0) {
                if (config.is_circle) {
                    _index = li_len - 1;
                    index = li_len - 1;
                } else {
                    index = _index = 0;
                }
            } else if (_index >= li_len) {
                if (config.is_circle) {
                    _index = li_len;
                    index = 0;
                } else {
                    index = _index = li_len - 1;
                }
            }
            dis = -box_width * _index;
            $(main_box).animate({
                marginLeft: dis
            }, config.ani_time, 'ease-out', function() {
                if (o_index == index % li_len) return;
                config.callback.call(this, index % li_len);
            });
        };
        var add_listen = function() {
            box_width = main_box.parent().width();
            main_box.children().css({
                'width': box_width
            });
            main_box.css({
                'marginLeft': 0
            }).show();
            config.callback.call(this, 0);

            var change_env = function(obj, data) {
                if (index == li_len && data.dx > 0 && config.is_circle) {
                    index = 0;
                } else if (index == 0 && data.dx < 0 && config.is_circle) {
                    index = li_len;
                }

                var dis = -index * box_width - data.dx;
                $(obj).css({
                    'marginLeft': dis
                });
            };

            var clear_env = function(obj, data) {
                var dis = 0,
                    adx = Math.abs(data.dx);
                var mspeed = data.speed > config.max_speed;
                if (mspeed || adx / box_width > config.done_process) {
                    var flag = data.dx > 0 ? 1 : -1;
                    var dex = index + flag;
                    _move(dex);
                } else {
                    _move(index);
                }
            };

            main_box.touchwipe({
                listen: 'x',
                start: function() {
                    tauching = true;
                },

                stop: function(data) {
                    tauching = false;
                    tauch_stop = new Date().getTime();
                    clear_env(this, data);
                    return;
                },

                move: function(data) {
                    //改变当前状态
                    return change_env(this, data);
                }
            });
        };

        init.call(that);
        add_listen.call(that);

        $(window).bind('resize', function() {
            add_listen.call(that);
        });

        return {
            move: function(_indx) {
                _indx = _indx < 0 ? (_indx % li_len) + li_len : _indx;
                _move(_indx);
            },

            next: function() {
                if (config.is_circle) {
                    index == 0 && main_box.css({
                        'marginLeft': 0
                    });
                } else {
                    index = index + 1 >= li_len ? -1 : index;
                }

                _move(index + 1);
            },

            prev: function() {
                _move(index - 1);
            },

            interval: function(time, touch_delay_loop) {
                time = time || 3000;
                touch_delay_loop = touch_delay_loop || 2000;
                var that = this;
                setInterval(function() {
                    if (tauching) return;
                    if (new Date().getTime() - tauch_stop < touch_delay_loop) return;

                    that.next();
                }, time);
            }
        };
    };

})($);