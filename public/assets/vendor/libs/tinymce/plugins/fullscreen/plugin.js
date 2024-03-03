/*!
 * TinyMCE
 *
 * Copyright (c) 2023 Ephox Corporation DBA Tiny Technologies, Inc.
 * Licensed under the Tiny commercial license. See https://www.tiny.cloud/legal/
 *
 * Version: 6.4.1
 */
! function () {
    "use strict";
    const e = e => {
        let t = e;
        return {
            get: () => t,
            set: e => {
                t = e
            }
        }
    };
    var t = tinymce.util.Tools.resolve("tinymce.PluginManager");
    const n = e => t => (e => {
            const t = typeof e;
            return null === e ? "null" : "object" === t && Array.isArray(e) ? "array" : "object" === t && (n = r = e,
                (o = String).prototype.isPrototypeOf(n) || (null === (s = r.constructor) || void 0 === s ? void 0 : s.name) === o.name) ? "string" : t;
            var n, r, o, s
        })(t) === e,
        r = e => t => typeof t === e,
        o = e => t => e === t,
        s = n("string"),
        i = n("array"),
        l = o(null),
        a = r("boolean"),
        c = o(void 0),
        u = e => !(e => null == e)(e),
        d = r("function"),
        m = r("number"),
        h = () => {},
        g = e => () => e;

    function p(e, ...t) {
        return (...n) => {
            const r = t.concat(n);
            return e.apply(null, r)
        }
    }
    const f = g(!1),
        v = g(!0);
    class w {
        constructor(e, t) {
            this.tag = e,
                this.value = t
        }
        static some(e) {
            return new w(!0, e)
        }
        static none() {
            return w.singletonNone
        }
        fold(e, t) {
            return this.tag ? t(this.value) : e()
        }
        isSome() {
            return this.tag
        }
        isNone() {
            return !this.tag
        }
        map(e) {
            return this.tag ? w.some(e(this.value)) : w.none()
        }
        bind(e) {
            return this.tag ? e(this.value) : w.none()
        }
        exists(e) {
            return this.tag && e(this.value)
        }
        forall(e) {
            return !this.tag || e(this.value)
        }
        filter(e) {
            return !this.tag || e(this.value) ? this : w.none()
        }
        getOr(e) {
            return this.tag ? this.value : e
        }
        or(e) {
            return this.tag ? this : e
        }
        getOrThunk(e) {
            return this.tag ? this.value : e()
        }
        orThunk(e) {
            return this.tag ? this : e()
        }
        getOrDie(e) {
            if (this.tag)
                return this.value;
            throw new Error(null != e ? e : "Called getOrDie on None")
        }
        static from(e) {
            return u(e) ? w.some(e) : w.none()
        }
        getOrNull() {
            return this.tag ? this.value : null
        }
        getOrUndefined() {
            return this.value
        }
        each(e) {
            this.tag && e(this.value)
        }
        toArray() {
            return this.tag ? [this.value] : []
        }
        toString() {
            return this.tag ? `some(${this.value})` : "none()"
        }
    }
    w.singletonNone = new w(!1);
    const y = t => {
            const n = e(w.none()),
                r = () => n.get().each(t);
            return {
                clear: () => {
                    r(),
                        n.set(w.none())
                },
                isSet: () => n.get().isSome(),
                get: () => n.get(),
                set: e => {
                    r(),
                        n.set(w.some(e))
                }
            }
        },
        b = () => y((e => e.unbind())),
        S = Array.prototype.push,
        x = (e, t) => {
            const n = e.length,
                r = new Array(n);
            for (let o = 0; o < n; o++) {
                const n = e[o];
                r[o] = t(n, o)
            }
            return r
        },
        E = (e, t) => {
            for (let n = 0, r = e.length; n < r; n++)
                t(e[n], n)
        },
        F = (e, t) => {
            const n = [];
            for (let r = 0, o = e.length; r < o; r++) {
                const o = e[r];
                t(o, r) && n.push(o)
            }
            return n
        },
        O = (e, t) => ((e, t, n) => {
            for (let r = 0, o = e.length; r < o; r++) {
                const o = e[r];
                if (t(o, r))
                    return w.some(o);
                if (n(o, r))
                    break
            }
            return w.none()
        })(e, t, f),
        T = Object.keys,
        k = (e, t, n = 0, r) => {
            const o = e.indexOf(t, n);
            return -1 !== o && (!!c(r) || o + t.length <= r)
        },
        C = e => void 0 !== e.style && d(e.style.getPropertyValue),
        A = e => {
            if (null == e)
                throw new Error("Node cannot be null or undefined");
            return {
                dom: e
            }
        },
        R = A;
    "undefined" != typeof window ? window : Function("return this;")();
    const L = e => t => (e => e.dom.nodeType)(t) === e,
        M = L(1),
        N = L(3),
        P = L(9),
        D = L(11),
        W = (e, t) => {
            const n = e.dom;
            if (1 !== n.nodeType)
                return !1; {
                const e = n;
                if (void 0 !== e.matches)
                    return e.matches(t);
                if (void 0 !== e.msMatchesSelector)
                    return e.msMatchesSelector(t);
                if (void 0 !== e.webkitMatchesSelector)
                    return e.webkitMatchesSelector(t);
                if (void 0 !== e.mozMatchesSelector)
                    return e.mozMatchesSelector(t);
                throw new Error("Browser lacks native selectors")
            }
        },
        q = e => R(e.dom.ownerDocument),
        H = e => x(e.dom.childNodes, R),
        I = d(Element.prototype.attachShadow) && d(Node.prototype.getRootNode),
        B = g(I),
        V = I ? e => R(e.dom.getRootNode()) : e => P(e) ? e : q(e),
        _ = e => {
            const t = V(e);
            return D(n = t) && u(n.dom.host) ? w.some(t) : w.none();
            var n
        },
        j = e => R(e.dom.host),
        z = e => {
            const t = N(e) ? e.dom.parentNode : e.dom;
            if (null == t || null === t.ownerDocument)
                return !1;
            const n = t.ownerDocument;
            return _(R(t)).fold((() => n.body.contains(t)), (r = z,
                o = j,
                e => r(o(e))));
            var r, o
        },
        $ = (e, t) => {
            const n = e.dom.getAttribute(t);
            return null === n ? void 0 : n
        },
        U = (e, t) => {
            e.dom.removeAttribute(t)
        },
        K = (e, t) => {
            const n = e.dom;
            ((e, t) => {
                const n = T(e);
                for (let r = 0, o = n.length; r < o; r++) {
                    const o = n[r];
                    t(e[o], o)
                }
            })(t, ((e, t) => {
                ((e, t, n) => {
                    if (!s(n))
                        throw console.error("Invalid call to CSS.set. Property ", t, ":: Value ", n, ":: Element ", e),
                            new Error("CSS value must be a string: " + n);
                    C(e) && e.style.setProperty(t, n)
                })(n, t, e)
            }))
        },
        X = e => {
            const t = R((e => {
                    if (B() && u(e.target)) {
                        const t = R(e.target);
                        if (M(t) && u(t.dom.shadowRoot) && e.composed && e.composedPath) {
                            const t = e.composedPath();
                            if (t)
                                return ((e, t) => 0 < e.length ? w.some(e[0]) : w.none())(t)
                        }
                    }
                    return w.from(e.target)
                })(e).getOr(e.target)),
                n = () => e.stopPropagation(),
                r = () => e.preventDefault(),
                o = (s = r,
                    i = n,
                    (...e) => s(i.apply(null, e)));
            var s, i;
            return ((e, t, n, r, o, s, i) => ({
                target: e,
                x: t,
                y: n,
                stop: r,
                prevent: o,
                kill: s,
                raw: i
            }))(t, e.clientX, e.clientY, n, r, o, e)
        },
        Y = (e, t, n, r) => {
            e.dom.removeEventListener(t, n, r)
        },
        G = v,
        J = (e, t, n) => ((e, t, n, r) => ((e, t, n, r, o) => {
            const s = ((e, t) => n => {
                e(n) && t(X(n))
            })(n, r);
            return e.dom.addEventListener(t, s, o), {
                unbind: p(Y, e, t, s, o)
            }
        })(e, t, n, r, !1))(e, t, G, n),
        Q = () => Z(0, 0),
        Z = (e, t) => ({
            major: e,
            minor: t
        }),
        ee = {
            nu: Z,
            detect: (e, t) => {
                const n = String(t).toLowerCase();
                return 0 === e.length ? Q() : ((e, t) => {
                    const n = ((e, t) => {
                        for (let n = 0; n < e.length; n++) {
                            const r = e[n];
                            if (r.test(t))
                                return r
                        }
                    })(e, t);
                    if (!n)
                        return {
                            major: 0,
                            minor: 0
                        };
                    const r = e => Number(t.replace(n, "$" + e));
                    return Z(r(1), r(2))
                })(e, n)
            },
            unknown: Q
        },
        te = (e, t) => {
            const n = String(t).toLowerCase();
            return O(e, (e => e.search(n)))
        },
        ne = /.*?version\/\ ?([0-9]+)\.([0-9]+).*/,
        re = e => t => k(t, e),
        oe = [{
            name: "Edge",
            versionRegexes: [/.*?edge\/ ?([0-9]+)\.([0-9]+)$/],
            search: e => k(e, "edge/") && k(e, "chrome") && k(e, "safari") && k(e, "applewebkit")
        }, {
            name: "Chromium",
            brand: "Chromium",
            versionRegexes: [/.*?chrome\/([0-9]+)\.([0-9]+).*/, ne],
            search: e => k(e, "chrome") && !k(e, "chromeframe")
        }, {
            name: "IE",
            versionRegexes: [/.*?msie\ ?([0-9]+)\.([0-9]+).*/, /.*?rv:([0-9]+)\.([0-9]+).*/],
            search: e => k(e, "msie") || k(e, "trident")
        }, {
            name: "Opera",
            versionRegexes: [ne, /.*?opera\/([0-9]+)\.([0-9]+).*/],
            search: re("opera")
        }, {
            name: "Firefox",
            versionRegexes: [/.*?firefox\/\ ?([0-9]+)\.([0-9]+).*/],
            search: re("firefox")
        }, {
            name: "Safari",
            versionRegexes: [ne, /.*?cpu os ([0-9]+)_([0-9]+).*/],
            search: e => (k(e, "safari") || k(e, "mobile/")) && k(e, "applewebkit")
        }],
        se = [{
            name: "Windows",
            search: re("win"),
            versionRegexes: [/.*?windows\ nt\ ?([0-9]+)\.([0-9]+).*/]
        }, {
            name: "iOS",
            search: e => k(e, "iphone") || k(e, "ipad"),
            versionRegexes: [/.*?version\/\ ?([0-9]+)\.([0-9]+).*/, /.*cpu os ([0-9]+)_([0-9]+).*/, /.*cpu iphone os ([0-9]+)_([0-9]+).*/]
        }, {
            name: "Android",
            search: re("android"),
            versionRegexes: [/.*?android\ ?([0-9]+)\.([0-9]+).*/]
        }, {
            name: "macOS",
            search: re("mac os x"),
            versionRegexes: [/.*?mac\ os\ x\ ?([0-9]+)_([0-9]+).*/]
        }, {
            name: "Linux",
            search: re("linux"),
            versionRegexes: []
        }, {
            name: "Solaris",
            search: re("sunos"),
            versionRegexes: []
        }, {
            name: "FreeBSD",
            search: re("freebsd"),
            versionRegexes: []
        }, {
            name: "ChromeOS",
            search: re("cros"),
            versionRegexes: [/.*?chrome\/([0-9]+)\.([0-9]+).*/]
        }],
        ie = {
            browsers: g(oe),
            oses: g(se)
        },
        le = "Edge",
        ae = "Chromium",
        ce = "Opera",
        ue = "Firefox",
        de = "Safari",
        me = e => {
            const t = e.current,
                n = e.version,
                r = e => () => t === e;
            return {
                current: t,
                version: n,
                isEdge: r(le),
                isChromium: r(ae),
                isIE: r("IE"),
                isOpera: r(ce),
                isFirefox: r(ue),
                isSafari: r(de)
            }
        },
        he = () => me({
            current: void 0,
            version: ee.unknown()
        }),
        ge = me,
        pe = (g(le),
            g(ae),
            g("IE"),
            g(ce),
            g(ue),
            g(de),
            "Windows"),
        fe = "Android",
        ve = "Linux",
        we = "macOS",
        ye = "Solaris",
        be = "FreeBSD",
        Se = "ChromeOS",
        xe = e => {
            const t = e.current,
                n = e.version,
                r = e => () => t === e;
            return {
                current: t,
                version: n,
                isWindows: r(pe),
                isiOS: r("iOS"),
                isAndroid: r(fe),
                isMacOS: r(we),
                isLinux: r(ve),
                isSolaris: r(ye),
                isFreeBSD: r(be),
                isChromeOS: r(Se)
            }
        },
        Ee = () => xe({
            current: void 0,
            version: ee.unknown()
        }),
        Fe = xe,
        Oe = (g(pe),
            g("iOS"),
            g(fe),
            g(ve),
            g(we),
            g(ye),
            g(be),
            g(Se),
            (e, t, n) => {
                const r = ie.browsers(),
                    o = ie.oses(),
                    s = t.bind((e => ((e, t) => ((e, t) => {
                        for (let n = 0; n < e.length; n++) {
                            const r = t(e[n]);
                            if (r.isSome())
                                return r
                        }
                        return w.none()
                    })(t.brands, (t => {
                        const n = t.brand.toLowerCase();
                        return O(e, (e => {
                            var t;
                            return n === (null === (t = e.brand) || void 0 === t ? void 0 : t.toLowerCase())
                        })).map((e => ({
                            current: e.name,
                            version: ee.nu(parseInt(t.version, 10), 0)
                        })))
                    })))(r, e))).orThunk((() => ((e, t) => te(e, t).map((e => {
                        const n = ee.detect(e.versionRegexes, t);
                        return {
                            current: e.name,
                            version: n
                        }
                    })))(r, e))).fold(he, ge),
                    i = ((e, t) => te(e, t).map((e => {
                        const n = ee.detect(e.versionRegexes, t);
                        return {
                            current: e.name,
                            version: n
                        }
                    })))(o, e).fold(Ee, Fe),
                    l = ((e, t, n, r) => {
                        const o = e.isiOS() && !0 === /ipad/i.test(n),
                            s = e.isiOS() && !o,
                            i = e.isiOS() || e.isAndroid(),
                            l = i || r("(pointer:coarse)"),
                            a = o || !s && i && r("(min-device-width:768px)"),
                            c = s || i && !a,
                            u = t.isSafari() && e.isiOS() && !1 === /safari/i.test(n),
                            d = !c && !a && !u;
                        return {
                            isiPad: g(o),
                            isiPhone: g(s),
                            isTablet: g(a),
                            isPhone: g(c),
                            isTouch: g(l),
                            isAndroid: e.isAndroid,
                            isiOS: e.isiOS,
                            isWebView: g(u),
                            isDesktop: g(d)
                        }
                    })(i, s, e, n);
                return {
                    browser: s,
                    os: i,
                    deviceType: l
                }
            }
        ),
        Te = e => window.matchMedia(e).matches;
    let ke = (e => {
        let t, n = !1;
        return (...r) => (n || (n = !0,
                t = e.apply(null, r)),
            t)
    })((() => Oe(navigator.userAgent, w.from(navigator.userAgentData), Te)));
    const Ce = (e, t) => ({
            left: e,
            top: t,
            translate: (n, r) => Ce(e + n, t + r)
        }),
        Ae = Ce,
        Re = e => {
            const t = void 0 === e ? window : e;
            return ke().browser.isFirefox() ? w.none() : w.from(t.visualViewport)
        },
        Le = (e, t, n, r) => ({
            x: e,
            y: t,
            width: n,
            height: r,
            right: e + n,
            bottom: t + r
        }),
        Me = e => {
            const t = void 0 === e ? window : e,
                n = t.document,
                r = (e => {
                    const t = void 0 !== e ? e.dom : document,
                        n = t.body.scrollLeft || t.documentElement.scrollLeft,
                        r = t.body.scrollTop || t.documentElement.scrollTop;
                    return Ae(n, r)
                })(R(n));
            return Re(t).fold((() => {
                const e = t.document.documentElement,
                    n = e.clientWidth,
                    o = e.clientHeight;
                return Le(r.left, r.top, n, o)
            }), (e => Le(Math.max(e.pageLeft, r.left), Math.max(e.pageTop, r.top), e.width, e.height)))
        },
        Ne = (e, t, n) => Re(n).map((n => {
            const r = e => t(X(e));
            return n.addEventListener(e, r), {
                unbind: () => n.removeEventListener(e, r)
            }
        })).getOrThunk((() => ({
            unbind: h
        })));
    var Pe = tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),
        De = tinymce.util.Tools.resolve("tinymce.Env");
    const We = (e, t) => {
            e.dispatch("FullscreenStateChanged", {
                    state: t
                }),
                e.dispatch("ResizeEditor")
        },
        qe = ("fullscreen_native",
            e => e.options.get("fullscreen_native"));
    const He = e => {
            return e.dom === (void 0 !== (t = q(e).dom).fullscreenElement ? t.fullscreenElement : void 0 !== t.msFullscreenElement ? t.msFullscreenElement : void 0 !== t.webkitFullscreenElement ? t.webkitFullscreenElement : null);
            var t
        },
        Ie = (e, t, n) => ((e, t, n) => F(((e, t) => {
            const n = d(t) ? t : f;
            let r = e.dom;
            const o = [];
            for (; null !== r.parentNode && void 0 !== r.parentNode;) {
                const e = r.parentNode,
                    t = R(e);
                if (o.push(t),
                    !0 === n(t))
                    break;
                r = e
            }
            return o
        })(e, n), t))(e, (e => W(e, t)), n),
        Be = (e, t) => ((e, n) => {
            return F((e => w.from(e.dom.parentNode).map(R))(r = e).map(H).map((e => F(e, (e => {
                return t = e,
                    !(r.dom === t.dom);
                var t
            })))).getOr([]), (e => W(e, t)));
            var r
        })(e),
        Ve = "data-ephox-mobile-fullscreen-style",
        _e = "position:absolute!important;",
        je = "top:0!important;left:0!important;margin:0!important;padding:0!important;width:100%!important;height:100%!important;overflow:visible!important;",
        ze = De.os.isAndroid(),
        $e = e => {
            const t = ((e, t) => {
                const n = e.dom,
                    r = window.getComputedStyle(n).getPropertyValue(t);
                return "" !== r || z(e) ? r : ((e, t) => C(e) ? e.style.getPropertyValue(t) : "")(n, t)
            })(e, "background-color");
            return void 0 !== t && "" !== t ? "background-color:" + t + "!important" : "background-color:rgb(255,255,255)!important;"
        },
        Ue = Pe.DOM,
        Ke = Re().fold((() => ({
            bind: h,
            unbind: h
        })), (e => {
            const t = (() => {
                    const e = y(h);
                    return {
                        ...e,
                        on: t => e.get().each(t)
                    }
                })(),
                n = b(),
                r = b(),
                o = ((e, t) => {
                    let n = null;
                    return {
                        cancel: () => {
                            l(n) || (clearTimeout(n),
                                n = null)
                        },
                        throttle: (...t) => {
                            l(n) && (n = setTimeout((() => {
                                n = null,
                                    e.apply(null, t)
                            }), 50))
                        }
                    }
                })((() => {
                    document.body.scrollTop = 0,
                        document.documentElement.scrollTop = 0,
                        window.requestAnimationFrame((() => {
                            t.on((t => K(t, {
                                top: e.offsetTop + "px",
                                left: e.offsetLeft + "px",
                                height: e.height + "px",
                                width: e.width + "px"
                            })))
                        }))
                }));
            return {
                bind: e => {
                    t.set(e),
                        o.throttle(),
                        n.set(Ne("resize", o.throttle)),
                        r.set(Ne("scroll", o.throttle))
                },
                unbind: () => {
                    t.on((() => {
                            n.clear(),
                                r.clear()
                        })),
                        t.clear()
                }
            }
        })),
        Xe = (e, t) => {
            const n = document.body,
                r = document.documentElement,
                o = e.getContainer(),
                l = R(o),
                c = (e => {
                    const t = R(e.getElement());
                    return _(t).map(j).getOrThunk((() => (e => {
                        const t = e.dom.body;
                        if (null == t)
                            throw new Error("Body is not available yet");
                        return R(t)
                    })(q(t))))
                })(e),
                u = t.get(),
                d = R(e.getBody()),
                h = De.deviceType.isTouch(),
                g = o.style,
                p = e.iframeElement,
                f = null == p ? void 0 : p.style,
                v = e => {
                    e(n, "tox-fullscreen"),
                        e(r, "tox-fullscreen"),
                        e(o, "tox-fullscreen"),
                        _(l).map((e => j(e).dom)).each((t => {
                            e(t, "tox-fullscreen"),
                                e(t, "tox-shadowhost")
                        }))
                },
                y = () => {
                    h && (e => {
                            const t = ((e, t) => {
                                const n = document;
                                return 1 !== (r = n).nodeType && 9 !== r.nodeType && 11 !== r.nodeType || 0 === r.childElementCount ? [] : x(n.querySelectorAll(e), R);
                                var r
                            })("[" + Ve + "]");
                            E(t, (t => {
                                const n = $(t, Ve);
                                n && "no-styles" !== n ? K(t, e.parseStyle(n)) : U(t, "style"),
                                    U(t, Ve)
                            }))
                        })(e.dom),
                        v(Ue.removeClass),
                        Ke.unbind(),
                        w.from(t.get()).each((e => e.fullscreenChangeHandler.unbind()))
                };
            if (u)
                u.fullscreenChangeHandler.unbind(),
                qe(e) && He(c) && (e => {
                    const t = e.dom;
                    t.exitFullscreen ? t.exitFullscreen() : t.msExitFullscreen ? t.msExitFullscreen() : t.webkitCancelFullScreen && t.webkitCancelFullScreen()
                })(q(c)),
                f.width = u.iframeWidth,
                f.height = u.iframeHeight,
                g.width = u.containerWidth,
                g.height = u.containerHeight,
                g.top = u.containerTop,
                g.left = u.containerLeft,
                y(),
                b = u.scrollPos,
                window.scrollTo(b.x, b.y),
                t.set(null),
                We(e, !1),
                e.off("remove", y);
            else {
                const n = J(q(c), void 0 !== document.fullscreenElement ? "fullscreenchange" : void 0 !== document.msFullscreenElement ? "MSFullscreenChange" : void 0 !== document.webkitFullscreenElement ? "webkitfullscreenchange" : "fullscreenchange", (n => {
                        qe(e) && (He(c) || null === t.get() || Xe(e, t))
                    })),
                    r = {
                        scrollPos: Me(window),
                        containerWidth: g.width,
                        containerHeight: g.height,
                        containerTop: g.top,
                        containerLeft: g.left,
                        iframeWidth: f.width,
                        iframeHeight: f.height,
                        fullscreenChangeHandler: n
                    };
                h && ((e, t, n) => {
                        const r = t => n => {
                                const r = $(n, "style"),
                                    o = void 0 === r ? "no-styles" : r.trim();
                                o !== t && (((e, t, n) => {
                                        ((e, t, n) => {
                                            if (!(s(n) || a(n) || m(n)))
                                                throw console.error("Invalid call to Attribute.set. Key ", t, ":: Value ", n, ":: Element ", e),
                                                    new Error("Attribute value was not simple");
                                            e.setAttribute(t, n + "")
                                        })(e.dom, t, n)
                                    })(n, Ve, o),
                                    K(n, e.parseStyle(t)))
                            },
                            o = Ie(t, "*"),
                            l = (e => {
                                const t = [];
                                for (let n = 0, r = e.length; n < r; ++n) {
                                    if (!i(e[n]))
                                        throw new Error("Arr.flatten item " + n + " was not an array, input: " + e);
                                    S.apply(t, e[n])
                                }
                                return t
                            })(x(o, (e => Be(e, "*:not(.tox-silver-sink)")))),
                            c = $e(n);
                        E(l, r("display:none!important;")),
                            E(o, r(_e + je + c)),
                            r((!0 === ze ? "" : _e) + je + c)(t)
                    })(e.dom, l, d),
                    f.width = f.height = "100%",
                    g.width = g.height = "",
                    v(Ue.addClass),
                    Ke.bind(l),
                    e.on("remove", y),
                    t.set(r),
                    qe(e) && (e => {
                        const t = e.dom;
                        t.requestFullscreen ? t.requestFullscreen() : t.msRequestFullscreen ? t.msRequestFullscreen() : t.webkitRequestFullScreen && t.webkitRequestFullScreen()
                    })(c),
                    We(e, !0)
            }
            var b
        },
        Ye = (e, t) => n => {
            n.setActive(null !== t.get());
            const r = e => n.setActive(e.state);
            return e.on("FullscreenStateChanged", r),
                () => e.off("FullscreenStateChanged", r)
        };
    t.add("fullscreen", (t => {
        const n = e(null);
        return t.inline || ((e => {
                    (0,
                        e.options.register)("fullscreen_native", {
                        processor: "boolean",
                        default: !1
                    })
                })(t),
                ((e, t) => {
                    e.addCommand("mceFullScreen", (() => {
                        Xe(e, t)
                    }))
                })(t, n),
                ((e, t) => {
                    const n = () => e.execCommand("mceFullScreen");
                    e.ui.registry.addToggleMenuItem("fullscreen", {
                            text: "Fullscreen",
                            icon: "fullscreen",
                            shortcut: "Meta+Shift+F",
                            onAction: n,
                            onSetup: Ye(e, t)
                        }),
                        e.ui.registry.addToggleButton("fullscreen", {
                            tooltip: "Fullscreen",
                            icon: "fullscreen",
                            onAction: n,
                            onSetup: Ye(e, t)
                        })
                })(t, n),
                t.addShortcut("Meta+Shift+F", "", "mceFullScreen")),
            (e => ({
                isFullscreen: () => null !== e.get()
            }))(n)
    }))
}();
