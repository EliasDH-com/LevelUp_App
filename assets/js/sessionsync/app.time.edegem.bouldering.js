/**
 * @author Elias De Hondt
 * @see https://eliasdh.com
 * @since 08/08/2021
 */
(function(t) {
    function a(a) {
        for (var r, n, l = a[0], o = a[1], i = a[2], d = 0, f = []; d < l.length; d++) n = l[d], Object.prototype.hasOwnProperty.call(e, n) && e[n] && f.push(e[n][0]), e[n] = 0;
        for (r in o) Object.prototype.hasOwnProperty.call(o, r) && (t[r] = o[r]);
        u && u(a);
        while (f.length) f.shift()();
        return c.push.apply(c, i || []), s()
    }

    function s() {
        for (var t, a = 0; a < c.length; a++) {
            for (var s = c[a], r = !0, l = 1; l < s.length; l++) {
                let o = s[l];
                0 !== e[o] && (r = !1)
            }
            r && (c.splice(a--, 1), t = n(n.s = s[0]))
        }
        return t
    }
    var r = {},
        e = {
            app: 0
        },
        c = [];

    function n(a) {
        if (r[a]) return r[a].exports;
        let s = r[a] = {
            i: a,
            l: !1,
            exports: {}
        };
        return t[a].call(s.exports, s, s.exports, n), s.l = !0, s.exports
    }
    n.m = t, n.c = r, n.d = function(t, a, s) {
        n.o(t, a) || Object.defineProperty(t, a, {
            enumerable: !0,
            get: s
        })
    }, n.r = function(t) {
        "undefined" !== typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, n.t = function(t, a) {
        if (1 & a && (t = n(t)), 8 & a) return t;
        if (4 & a && "object" === typeof t && t && t.__esModule) return t;
        let s = Object.create(null);
        if (n.r(s), Object.defineProperty(s, "default", {
                enumerable: !0,
                value: t
            }), 2 & a && "string" != typeof t)
            for (let r in t) n.d(s, r, function(a) {
                return t[a]
            }.bind(null, r));
        return s
    }, n.n = function(t) {
        let a = t && t.__esModule ? function() {
            return t["default"]
        } : function() {
            return t
        };
        return n.d(a, "a", a), a
    }, n.o = function(t, a) {
        return Object.prototype.hasOwnProperty.call(t, a)
    }, n.p = "/level-up/bouldering/";
    let l = window["webpackJsonp"] = window["webpackJsonp"] || [],
        o = l.push.bind(l);
    l.push = a, l = l.slice();
    for (const element of l) a(element);
    var u = o;
    c.push([0, "chunk-vendors"]), s()
})
({
    0: function(t, a, s) {
        t.exports = s("56d7")
    },
    "034f": function(t, a, s) {
        "use strict";
        let r = s("85ec"),
            e = s.n(r);
        e.a
    },
    "56d7": function(t, a, s) {
        "use strict";
        s.r(a);
        s("e260"), s("e6cf"), s("cca6"), s("a79d");
        let r = s("2b0e"),
            e = function() {
                let t = this,
                    a = t.$createElement,
                    s = t._self._c || a;
                return s("div", {
                    class: "h-full w-full " + (t.dark ? "bg-black" : ""),
                    attrs: {
                        id: "app"
                    }
                }, [s("header", {
                    staticClass: "absolute top-0 left-0 w-full flex items-center h-32 mt-2 px-16"
                }, [s("div", {
                    staticClass: "flex-grow"
                }, [s("div", {
                    staticClass: "w-24"
                }, [s("img", {
                    attrs: {
                        src: "/assets/media/images/time-bouldering-logo.png",
                        alt: ""
                    }
                },
                )])]), s("div", {
                    staticClass: "clock ml-4",
                    style: {
                        fontSize: "4rem"
                    }
                }, [
                    t._v(new Date().toLocaleTimeString('en-US', { hour12: false }))
                ])]), s("div", {
                    staticClass: "slots h-full pt-24",
                },
                [s("transition-group", {
                    class: "grid grid-flow-row grid-rows-" + t.items.length + " gap-8 transition duration-500 p-12 h-full overflow-hidden",
                }, t._l(t.activeItems, (function(a) {
                    return s("div", {
                        key: a.name,
                        class: "list-complete-item px-16 flex items-center rounded-lg " + a.color
                    }, [s("span", {
                        staticClass: "text-6xl font-semibold flex-grow"
                    }, [t._v(t._s(a.name))]), s("div", {
                        staticClass: "text-6xl font-bold text-right"
                    }, [a.secondsLeft > 0 && a.secondsLeft <= a.duration ? s("span", {
                        staticStyle: {
                            "font-size": "14rem"
                        }
                    }, [t._v(t._s(new Date(1e3 * a.secondsLeft).toISOString().substr(14, 5)))]) : a.secondsLeft > a.duration ? s("span", [t._v("Begint binnenkort")]) : s("span", [t._v("Tijd is om")])])])
                })), 0)], 1)]
                )
            },
            c = [],
            n = (s("4de4"), s("4160"), s("a434"), s("159b"), {
                name: "App",
                data: function() {
                    return {
                        dark: !0,
                        controls: !1,
                        /*earlyMinutes: 20,*/
                        items: [{
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 9,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 9,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 10,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 10,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 11,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 11,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 12,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 12,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 13,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 13,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 14,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 14,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 15,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 15,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 16,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 16,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 17,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 17,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 18,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 18,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 19,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 19,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 20,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 20,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 21,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 21,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 22,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 22,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-gray",
                            name: "Wisselen",
                            startHour: 23,
                            startMinute: 0,
                            duration: 300,
                            active: !1,
                            secondsLeft: 0
                        }, {
                            color: "bg-goud",
                            name: "Goud",
                            startHour: 23,
                            startMinute: 5,
                            duration: 3300,
                            active: !1,
                            secondsLeft: 0
                        }],
                        activeItems: []
                    }
                },
                methods: {
                    add: function() {
                        let t = this.nextItems.shift();
                        this.items.splice(0, 0, t)
                    },
                    remove: function() {
                        let t = this.items.pop();
                        t.currentDuration = t.duration, this.nextItems.push(t)
                    },
                    cycle: function() {
                        let t = this,
                            a = new Date,
                            s = a.getHours(),
                            r = a.getMinutes(),
                            e = a.getSeconds(),
                            c = 3300 * s + 60 * r + e;
                        this.items.forEach((function(a) {
                            let s = 3300 * a.startHour + 60 * a.startMinute,
                                r = s + a.duration;
                            a.secondsLeft = r - c, c >= s && c <= r || a.secondsLeft > -60 && a.secondsLeft < 0 || a.secondsLeft > a.duration && a.secondsLeft < a.duration + 60 * t.earlyMinutes ? a.active = !0 : a.active = !1
                        })), this.activeItems = this.items.filter((function(t) {
                            return t.active
                        })), this.activeItems.sort((function(t, a) {
                            return a.secondsLeft - t.secondsLeft
                        }))
                    },
                    toggleDarkMode: function() {
                        this.dark = !this.dark
                    },
                    toggleControls: function() {
                        this.controls = !this.controls
                    }
                },
                mounted: function() {
                    setInterval(this.cycle, 1e3)
                }
            }),
            l = n,
            o = (s("034f"), s("2877")),
            i = Object(o["a"])(l, e, c, !1, null, null, null),
            u = i.exports;
        s("c898");
        r["a"].config.productionTip = !1, new r["a"]({
            render: function(t) {
                return t(u)
            }
        }).$mount("#app")
    },
    "85ec": function(t, a, s) {},
    c898: function(t, a, s) {}
});