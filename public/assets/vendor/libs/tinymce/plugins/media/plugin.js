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
    var e = tinymce.util.Tools.resolve("tinymce.PluginManager");
    const t = e => t => (e => {
            const t = typeof e;
            return null === e ? "null" : "object" === t && Array.isArray(e) ? "array" : "object" === t && (r = a = e,
                (o = String).prototype.isPrototypeOf(r) || (null === (s = a.constructor) || void 0 === s ? void 0 : s.name) === o.name) ? "string" : t;
            var r, a, o, s
        })(t) === e,
        r = t("string"),
        a = t("object"),
        o = t("array"),
        s = e => !(e => null == e)(e);
    class i {
        constructor(e, t) {
            this.tag = e,
                this.value = t
        }
        static some(e) {
            return new i(!0, e)
        }
        static none() {
            return i.singletonNone
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
            return this.tag ? i.some(e(this.value)) : i.none()
        }
        bind(e) {
            return this.tag ? e(this.value) : i.none()
        }
        exists(e) {
            return this.tag && e(this.value)
        }
        forall(e) {
            return !this.tag || e(this.value)
        }
        filter(e) {
            return !this.tag || e(this.value) ? this : i.none()
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
            return s(e) ? i.some(e) : i.none()
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
    i.singletonNone = new i(!1);
    const n = Array.prototype.push,
        c = (e, t) => {
            for (let r = 0, a = e.length; r < a; r++)
                t(e[r], r)
        },
        l = e => {
            const t = [];
            for (let r = 0, a = e.length; r < a; ++r) {
                if (!o(e[r]))
                    throw new Error("Arr.flatten item " + r + " was not an array, input: " + e);
                n.apply(t, e[r])
            }
            return t
        },
        m = Object.keys,
        u = Object.hasOwnProperty,
        d = (e, t) => h(e, t) ? i.from(e[t]) : i.none(),
        h = (e, t) => u.call(e, t),
        p = e => t => t.options.get(e),
        g = p("audio_template_callback"),
        b = p("video_template_callback"),
        w = p("iframe_template_callback"),
        v = p("media_live_embeds"),
        f = p("media_filter_html"),
        y = p("media_url_resolver"),
        x = p("media_alt_source"),
        _ = p("media_poster"),
        j = p("media_dimensions");
    var k = tinymce.util.Tools.resolve("tinymce.util.Tools"),
        O = tinymce.util.Tools.resolve("tinymce.dom.DOMUtils"),
        A = tinymce.util.Tools.resolve("tinymce.html.DomParser");
    const S = O.DOM,
        C = e => e.replace(/px$/, ""),
        D = e => {
            const t = e.attr("style"),
                r = t ? S.parseStyle(t) : {};
            return {
                type: "ephox-embed-iri",
                source: e.attr("data-ephox-embed-iri"),
                altsource: "",
                poster: "",
                width: d(r, "max-width").map(C).getOr(""),
                height: d(r, "max-height").map(C).getOr("")
            }
        },
        T = (e, t) => {
            let r = {};
            for (let a = A({
                    validate: !1,
                    forced_root_block: !1
                }, t).parse(e); a; a = a.walk())
                if (1 === a.type) {
                    const e = a.name;
                    if (a.attr("data-ephox-embed-iri")) {
                        r = D(a);
                        break
                    }
                    r.source || "param" !== e || (r.source = a.attr("movie")),
                        "iframe" !== e && "object" !== e && "embed" !== e && "video" !== e && "audio" !== e || (r.type || (r.type = e),
                            r = k.extend(a.attributes.map, r)),
                        "script" === e && (r = {
                            type: "script",
                            source: a.attr("src")
                        }),
                        "source" === e && (r.source ? r.altsource || (r.altsource = a.attr("src")) : r.source = a.attr("src")),
                        "img" !== e || r.poster || (r.poster = a.attr("src"))
                }
            return r.source = r.source || r.src || "",
                r.altsource = r.altsource || "",
                r.poster = r.poster || "",
                r
        },
        z = e => {
            var t;
            const r = null !== (t = e.toLowerCase().split(".").pop()) && void 0 !== t ? t : "";
            return d({
                mp3: "audio/mpeg",
                m4a: "audio/x-m4a",
                wav: "audio/wav",
                mp4: "video/mp4",
                webm: "video/webm",
                ogg: "video/ogg",
                swf: "application/x-shockwave-flash"
            }, r).getOr("")
        };
    var $ = tinymce.util.Tools.resolve("tinymce.html.Node"),
        M = tinymce.util.Tools.resolve("tinymce.html.Serializer");
    const F = (e, t = {}) => A({
            forced_root_block: !1,
            validate: !1,
            allow_conditional_comments: !0,
            ...t
        }, e),
        N = O.DOM,
        R = e => /^[0-9.]+$/.test(e) ? e + "px" : e,
        U = (e, t) => {
            const r = t.attr("style"),
                a = r ? N.parseStyle(r) : {};
            s(e.width) && (a["max-width"] = R(e.width)),
                s(e.height) && (a["max-height"] = R(e.height)),
                t.attr("style", N.serializeStyle(a))
        },
        P = ["source", "altsource"],
        E = (e, t, r, a) => {
            let o = 0,
                s = 0;
            const i = F(a);
            i.addNodeFilter("source", (e => o = e.length));
            const n = i.parse(e);
            for (let e = n; e; e = e.walk())
                if (1 === e.type) {
                    const a = e.name;
                    if (e.attr("data-ephox-embed-iri")) {
                        U(t, e);
                        break
                    }
                    switch (a) {
                        case "video":
                        case "object":
                        case "embed":
                        case "img":
                        case "iframe":
                            void 0 !== t.height && void 0 !== t.width && (e.attr("width", t.width),
                                e.attr("height", t.height))
                    }
                    if (r)
                        switch (a) {
                            case "video":
                                e.attr("poster", t.poster),
                                    e.attr("src", null);
                                for (let r = o; r < 2; r++)
                                    if (t[P[r]]) {
                                        const a = new $("source", 1);
                                        a.attr("src", t[P[r]]),
                                            a.attr("type", t[P[r] + "mime"] || null),
                                            e.append(a)
                                    }
                                break;
                            case "iframe":
                                e.attr("src", t.source);
                                break;
                            case "object":
                                const r = e.getAll("img").length > 0;
                                if (t.poster && !r) {
                                    e.attr("src", t.poster);
                                    const r = new $("img", 1);
                                    r.attr("src", t.poster),
                                        r.attr("width", t.width),
                                        r.attr("height", t.height),
                                        e.append(r)
                                }
                                break;
                            case "source":
                                if (s < 2 && (e.attr("src", t[P[s]]),
                                        e.attr("type", t[P[s] + "mime"] || null),
                                        !t[P[s]])) {
                                    e.remove();
                                    continue
                                }
                                s++;
                                break;
                            case "img":
                                t.poster || e.remove()
                        }
                }
            return M({}, a).serialize(n)
        },
        L = [{
            regex: /youtu\.be\/([\w\-_\?&=.]+)/i,
            type: "iframe",
            w: 560,
            h: 314,
            url: "www.youtube.com/embed/$1",
            allowFullscreen: !0
        }, {
            regex: /youtube\.com(.+)v=([^&]+)(&([a-z0-9&=\-_]+))?/i,
            type: "iframe",
            w: 560,
            h: 314,
            url: "www.youtube.com/embed/$2?$4",
            allowFullscreen: !0
        }, {
            regex: /youtube.com\/embed\/([a-z0-9\?&=\-_]+)/i,
            type: "iframe",
            w: 560,
            h: 314,
            url: "www.youtube.com/embed/$1",
            allowFullscreen: !0
        }, {
            regex: /vimeo\.com\/([0-9]+)/,
            type: "iframe",
            w: 425,
            h: 350,
            url: "player.vimeo.com/video/$1?title=0&byline=0&portrait=0&color=8dc7dc",
            allowFullscreen: !0
        }, {
            regex: /vimeo\.com\/(.*)\/([0-9]+)/,
            type: "iframe",
            w: 425,
            h: 350,
            url: "player.vimeo.com/video/$2?title=0&amp;byline=0",
            allowFullscreen: !0
        }, {
            regex: /maps\.google\.([a-z]{2,3})\/maps\/(.+)msid=(.+)/,
            type: "iframe",
            w: 425,
            h: 350,
            url: 'maps.google.com/maps/ms?msid=$2&output=embed"',
            allowFullscreen: !1
        }, {
            regex: /dailymotion\.com\/video\/([^_]+)/,
            type: "iframe",
            w: 480,
            h: 270,
            url: "www.dailymotion.com/embed/video/$1",
            allowFullscreen: !0
        }, {
            regex: /dai\.ly\/([^_]+)/,
            type: "iframe",
            w: 480,
            h: 270,
            url: "www.dailymotion.com/embed/video/$1",
            allowFullscreen: !0
        }],
        I = (e, t) => {
            const r = (e => {
                    const t = e.match(/^(https?:\/\/|www\.)(.+)$/i);
                    return t && t.length > 1 ? "www." === t[1] ? "https://" : t[1] : "https://"
                })(t),
                a = e.regex.exec(t);
            let o = r + e.url;
            if (s(a))
                for (let e = 0; e < a.length; e++)
                    o = o.replace("$" + e, (() => a[e] ? a[e] : ""));
            return o.replace(/\?$/, "")
        },
        B = (e, t) => {
            var r;
            const a = k.extend({}, t);
            if (!a.source && (k.extend(a, T(null !== (r = a.embed) && void 0 !== r ? r : "", e.schema)),
                    !a.source))
                return "";
            a.altsource || (a.altsource = ""),
                a.poster || (a.poster = ""),
                a.source = e.convertURL(a.source, "source"),
                a.altsource = e.convertURL(a.altsource, "source"),
                a.sourcemime = z(a.source),
                a.altsourcemime = z(a.altsource),
                a.poster = e.convertURL(a.poster, "poster");
            const o = (e => {
                const t = L.filter((t => t.regex.test(e)));
                return t.length > 0 ? k.extend({}, t[0], {
                    url: I(t[0], e)
                }) : null
            })(a.source);
            if (o && (a.source = o.url,
                    a.type = o.type,
                    a.allowfullscreen = o.allowFullscreen,
                    a.width = a.width || String(o.w),
                    a.height = a.height || String(o.h)),
                a.embed)
                return E(a.embed, a, !0, e.schema); {
                const t = g(e),
                    r = b(e),
                    o = w(e);
                return a.width = a.width || "300",
                    a.height = a.height || "150",
                    k.each(a, ((t, r) => {
                        a[r] = e.dom.encode("" + t)
                    })),
                    "iframe" === a.type ? ((e, t) => {
                        if (t)
                            return t(e); {
                            const t = e.allowfullscreen ? ' allowFullscreen="1"' : "";
                            return '<iframe src="' + e.source + '" width="' + e.width + '" height="' + e.height + '"' + t + "></iframe>"
                        }
                    })(a, o) : "application/x-shockwave-flash" === a.sourcemime ? (e => {
                        let t = '<object data="' + e.source + '" width="' + e.width + '" height="' + e.height + '" type="application/x-shockwave-flash">';
                        return e.poster && (t += '<img src="' + e.poster + '" width="' + e.width + '" height="' + e.height + '" />'),
                            t += "</object>",
                            t
                    })(a) : -1 !== a.sourcemime.indexOf("audio") ? ((e, t) => t ? t(e) : '<audio controls="controls" src="' + e.source + '">' + (e.altsource ? '\n<source src="' + e.altsource + '"' + (e.altsourcemime ? ' type="' + e.altsourcemime + '"' : "") + " />\n" : "") + "</audio>")(a, t) : "script" === a.type ? (e => '<script src="' + e.source + '"><\/script>')(a) : ((e, t) => t ? t(e) : '<video width="' + e.width + '" height="' + e.height + '"' + (e.poster ? ' poster="' + e.poster + '"' : "") + ' controls="controls">\n<source src="' + e.source + '"' + (e.sourcemime ? ' type="' + e.sourcemime + '"' : "") + " />\n" + (e.altsource ? '<source src="' + e.altsource + '"' + (e.altsourcemime ? ' type="' + e.altsourcemime + '"' : "") + " />\n" : "") + "</video>")(a, r)
            }
        },
        G = e => e.hasAttribute("data-mce-object") || e.hasAttribute("data-ephox-embed-iri"),
        W = {},
        q = e => t => B(e, t),
        H = (e, t) => {
            const r = y(e);
            return r ? ((e, t, r) => new Promise(((a, o) => {
                const s = r => (r.html && (W[e.source] = r),
                    a({
                        url: e.source,
                        html: r.html ? r.html : t(e)
                    }));
                W[e.source] ? s(W[e.source]) : r({
                    url: e.source
                }, s, o)
            })))(t, q(e), r) : ((e, t) => Promise.resolve({
                html: t(e),
                url: e.source
            }))(t, q(e))
        },
        J = (e, t) => {
            const r = {};
            return d(e, "dimensions").each((e => {
                    c(["width", "height"], (a => {
                        d(t, a).orThunk((() => d(e, a))).each((e => r[a] = e))
                    }))
                })),
                r
        },
        K = (e, t) => {
            const r = t && "dimensions" !== t ? ((e, t) => d(t, e).bind((e => d(e, "meta"))))(t, e).getOr({}) : {},
                o = ((e, t, r) => o => {
                    const s = () => d(e, o),
                        n = () => d(t, o),
                        c = e => d(e, "value").bind((e => e.length > 0 ? i.some(e) : i.none()));
                    return {
                        [o]: (o === r ? s().bind((e => a(e) ? c(e).orThunk(n) : n().orThunk((() => i.from(e))))) : n().orThunk((() => s().bind((e => a(e) ? c(e) : i.from(e)))))).getOr("")
                    }
                })(e, r, t);
            return {
                ...o("source"),
                ...o("altsource"),
                ...o("poster"),
                ...o("embed"),
                ...J(e, r)
            }
        },
        Q = e => {
            const t = {
                ...e,
                source: {
                    value: d(e, "source").getOr("")
                },
                altsource: {
                    value: d(e, "altsource").getOr("")
                },
                poster: {
                    value: d(e, "poster").getOr("")
                }
            };
            return c(["width", "height"], (r => {
                    d(e, r).each((e => {
                        const a = t.dimensions || {};
                        a[r] = e,
                            t.dimensions = a
                    }))
                })),
                t
        },
        V = e => t => {
            const r = t && t.msg ? "Media embed handler error: " + t.msg : "Media embed handler threw unknown error.";
            e.notificationManager.open({
                type: "error",
                text: r
            })
        },
        X = (e, t) => a => {
            if (r(a.url) && a.url.trim().length > 0) {
                const r = a.html,
                    o = {
                        ...T(r, t.schema),
                        source: a.url,
                        embed: r
                    };
                e.setData(Q(o))
            }
        },
        Y = (e, t) => {
            const r = e.dom.select("*[data-mce-object]");
            e.insertContent(t),
                ((e, t) => {
                    const r = e.dom.select("*[data-mce-object]");
                    for (let e = 0; e < t.length; e++)
                        for (let a = r.length - 1; a >= 0; a--)
                            t[e] === r[a] && r.splice(a, 1);
                    e.selection.select(r[0])
                })(e, r),
                e.nodeChanged()
        },
        Z = e => {
            const t = (e => {
                    const t = e.selection.getNode(),
                        r = G(t) ? e.serializer.serialize(t, {
                            selection: !0
                        }) : "";
                    return {
                        embed: r,
                        ...T(r, e.schema)
                    }
                })(e),
                r = (e => {
                    let t = e;
                    return {
                        get: () => t,
                        set: e => {
                            t = e
                        }
                    }
                })(t),
                a = Q(t),
                o = j(e) ? [{
                    type: "sizeinput",
                    name: "dimensions",
                    label: "Constrain proportions",
                    constrain: !0
                }] : [],
                s = {
                    title: "General",
                    name: "general",
                    items: l([
                        [{
                            name: "source",
                            type: "urlinput",
                            filetype: "media",
                            label: "Source"
                        }], o
                    ])
                },
                i = [];
            x(e) && i.push({
                    name: "altsource",
                    type: "urlinput",
                    filetype: "media",
                    label: "Alternative source URL"
                }),
                _(e) && i.push({
                    name: "poster",
                    type: "urlinput",
                    filetype: "image",
                    label: "Media poster (Image URL)"
                });
            const n = {
                    title: "Advanced",
                    name: "advanced",
                    items: i
                },
                c = [s, {
                    title: "Embed",
                    items: [{
                        type: "textarea",
                        name: "embed",
                        label: "Paste your embed code below:"
                    }]
                }];
            i.length > 0 && c.push(n);
            const m = {
                    type: "tabpanel",
                    tabs: c
                },
                u = e.windowManager.open({
                    title: "Insert/Edit Media",
                    size: "normal",
                    body: m,
                    buttons: [{
                        type: "cancel",
                        name: "cancel",
                        text: "Cancel"
                    }, {
                        type: "submit",
                        name: "save",
                        text: "Save",
                        primary: !0
                    }],
                    onSubmit: t => {
                        const a = K(t.getData());
                        ((e, t, r) => {
                            var a, o;
                            t.embed = E(null !== (a = t.embed) && void 0 !== a ? a : "", t, !1, r.schema),
                                t.embed && (e.source === t.source || (o = t.source,
                                    h(W, o))) ? Y(r, t.embed) : H(r, t).then((e => {
                                    Y(r, e.html)
                                })).catch(V(r))
                        })(r.get(), a, e),
                        t.close()
                    },
                    onChange: (t, a) => {
                        switch (a.name) {
                            case "source":
                                ((t, r) => {
                                    const a = K(r.getData(), "source");
                                    t.source !== a.source && (X(u, e)({
                                            url: a.source,
                                            html: ""
                                        }),
                                        H(e, a).then(X(u, e)).catch(V(e)))
                                })(r.get(), t);
                                break;
                            case "embed":
                                (t => {
                                    var r;
                                    const a = K(t.getData()),
                                        o = T(null !== (r = a.embed) && void 0 !== r ? r : "", e.schema);
                                    t.setData(Q(o))
                                })(t);
                                break;
                            case "dimensions":
                            case "altsource":
                            case "poster":
                                ((t, r) => {
                                    const a = K(t.getData(), r),
                                        o = B(e, a);
                                    t.setData(Q({
                                        ...a,
                                        embed: o
                                    }))
                                })(t, a.name)
                        }
                        r.set(K(t.getData()))
                    },
                    initialData: a
                })
        };
    var ee = tinymce.util.Tools.resolve("tinymce.Env");
    const te = e => {
            const t = e.name;
            return "iframe" === t || "video" === t || "audio" === t
        },
        re = (e, t, r, a = null) => {
            const o = e.attr(r);
            return s(o) ? o : h(t, r) ? null : a
        },
        ae = (e, t, r) => {
            const a = "img" === t.name || "video" === e.name,
                o = a ? "300" : null,
                s = "audio" === e.name ? "30" : "150",
                i = a ? s : null;
            t.attr({
                width: re(e, r, "width", o),
                height: re(e, r, "height", i)
            })
        },
        oe = (e, t) => {
            const r = t.name,
                a = new $("img", 1);
            return ie(e, t, a),
                ae(t, a, {}),
                a.attr({
                    style: t.attr("style"),
                    src: ee.transparentSrc,
                    "data-mce-object": r,
                    class: "mce-object mce-object-" + r
                }),
                a
        },
        se = (e, t) => {
            var r;
            const a = t.name,
                o = new $("span", 1);
            o.attr({
                    contentEditable: "false",
                    style: t.attr("style"),
                    "data-mce-object": a,
                    class: "mce-preview-object mce-object-" + a
                }),
                ie(e, t, o);
            const i = e.dom.parseStyle(null !== (r = t.attr("style")) && void 0 !== r ? r : ""),
                n = new $(a, 1);
            if (ae(t, n, i),
                n.attr({
                    src: t.attr("src"),
                    style: t.attr("style"),
                    class: t.attr("class")
                }),
                "iframe" === a)
                n.attr({
                    allowfullscreen: t.attr("allowfullscreen"),
                    frameborder: "0"
                });
            else {
                c(["controls", "crossorigin", "currentTime", "loop", "muted", "poster", "preload"], (e => {
                    n.attr(e, t.attr(e))
                }));
                const r = o.attr("data-mce-html");
                s(r) && ((e, t, r, a) => {
                    const o = F(e.schema).parse(a, {
                        context: t
                    });
                    for (; o.firstChild;)
                        r.append(o.firstChild)
                })(e, a, n, unescape(r))
            }
            const l = new $("span", 1);
            return l.attr("class", "mce-shim"),
                o.append(n),
                o.append(l),
                o
        },
        ie = (e, t, r) => {
            var a;
            const o = null !== (a = t.attributes) && void 0 !== a ? a : [];
            let s = o.length;
            for (; s--;) {
                const t = o[s].name;
                let a = o[s].value;
                "width" === t || "height" === t || "style" === t || (n = "data-mce-",
                    (i = t).length >= n.length && i.substr(0, 0 + n.length) === n) || ("data" !== t && "src" !== t || (a = e.convertURL(a, t)),
                    r.attr("data-mce-p-" + t, a))
            }
            var i, n;
            const l = M({
                    inner: !0
                }, e.schema),
                m = new $("div", 1);
            c(t.children(), (e => m.append(e)));
            const u = l.serialize(m);
            u && (r.attr("data-mce-html", escape(u)),
                r.empty())
        },
        ne = e => {
            const t = e.attr("class");
            return r(t) && /\btiny-pageembed\b/.test(t)
        },
        ce = e => {
            let t = e;
            for (; t = t.parent;)
                if (t.attr("data-ephox-embed-iri") || ne(t))
                    return !0;
            return !1
        },
        le = (e, t, r) => {
            const a = (0,
                    e.options.get)("xss_sanitization"),
                o = f(e);
            return F(e.schema, {
                sanitize: a,
                validate: o
            }).parse(r, {
                context: t
            })
        };
    e.add("media", (e => ((e => {
            const t = e.options.register;
            t("audio_template_callback", {
                    processor: "function"
                }),
                t("video_template_callback", {
                    processor: "function"
                }),
                t("iframe_template_callback", {
                    processor: "function"
                }),
                t("media_live_embeds", {
                    processor: "boolean",
                    default: !0
                }),
                t("media_filter_html", {
                    processor: "boolean",
                    default: !0
                }),
                t("media_url_resolver", {
                    processor: "function"
                }),
                t("media_alt_source", {
                    processor: "boolean",
                    default: !0
                }),
                t("media_poster", {
                    processor: "boolean",
                    default: !0
                }),
                t("media_dimensions", {
                    processor: "boolean",
                    default: !0
                })
        })(e),
        (e => {
            e.addCommand("mceMedia", (() => {
                Z(e)
            }))
        })(e),
        (e => {
            const t = () => e.execCommand("mceMedia");
            e.ui.registry.addToggleButton("media", {
                    tooltip: "Insert/edit media",
                    icon: "embed",
                    onAction: t,
                    onSetup: t => {
                        const r = e.selection;
                        return t.setActive(G(r.getNode())),
                            r.selectorChangedWithUnbind("img[data-mce-object],span[data-mce-object],div[data-ephox-embed-iri]", t.setActive).unbind
                    }
                }),
                e.ui.registry.addMenuItem("media", {
                    icon: "embed",
                    text: "Media...",
                    onAction: t
                })
        })(e),
        (e => {
            e.on("ResolveName", (e => {
                let t;
                1 === e.target.nodeType && (t = e.target.getAttribute("data-mce-object")) && (e.name = t)
            }))
        })(e),
        (e => {
            e.on("PreInit", (() => {
                    const {
                        schema: t,
                        serializer: r,
                        parser: a
                    } = e, o = t.getBoolAttrs();
                    c("webkitallowfullscreen mozallowfullscreen".split(" "), (e => {
                            o[e] = {}
                        })),
                        ((e, t) => {
                            const r = m(e);
                            for (let a = 0, o = r.length; a < o; a++) {
                                const o = r[a];
                                t(e[o], o)
                            }
                        })({
                            embed: ["wmode"]
                        }, ((e, r) => {
                            const a = t.getElementRule(r);
                            a && c(e, (e => {
                                a.attributes[e] = {},
                                    a.attributesOrder.push(e)
                            }))
                        })),
                        a.addNodeFilter("iframe,video,audio,object,embed,script", (e => t => {
                            let r, a = t.length;
                            for (; a--;)
                                r = t[a],
                                r.parent && (r.parent.attr("data-mce-object") || (te(r) && v(e) ? ce(r) || r.replace(se(e, r)) : ce(r) || r.replace(oe(e, r))))
                        })(e)),
                        r.addAttributeFilter("data-mce-object", ((t, r) => {
                            var a;
                            let o = t.length;
                            for (; o--;) {
                                const s = t[o];
                                if (!s.parent)
                                    continue;
                                const i = s.attr(r),
                                    n = new $(i, 1);
                                if ("audio" !== i && "script" !== i) {
                                    const e = s.attr("class");
                                    e && -1 !== e.indexOf("mce-preview-object") && s.firstChild ? n.attr({
                                        width: s.firstChild.attr("width"),
                                        height: s.firstChild.attr("height")
                                    }) : n.attr({
                                        width: s.attr("width"),
                                        height: s.attr("height")
                                    })
                                }
                                n.attr({
                                    style: s.attr("style")
                                });
                                const l = null !== (a = s.attributes) && void 0 !== a ? a : [];
                                let m = l.length;
                                for (; m--;) {
                                    const e = l[m].name;
                                    0 === e.indexOf("data-mce-p-") && n.attr(e.substr(11), l[m].value)
                                }
                                "script" === i && n.attr("type", "text/javascript");
                                const u = s.attr("data-mce-html");
                                if (u) {
                                    const t = le(e, i, unescape(u));
                                    c(t.children(), (e => n.append(e)))
                                }
                                s.replace(n)
                            }
                        }))
                })),
                e.on("SetContent", (() => {
                    const t = e.dom;
                    c(t.select("span.mce-preview-object"), (e => {
                        0 === t.select("span.mce-shim", e).length && t.add(e, "span", {
                            class: "mce-shim"
                        })
                    }))
                }))
        })(e),
        (e => {
            e.on("click keyup touchend", (() => {
                    const t = e.selection.getNode();
                    t && e.dom.hasClass(t, "mce-preview-object") && e.dom.getAttrib(t, "data-mce-selected") && t.setAttribute("data-mce-selected", "2")
                })),
                e.on("ObjectSelected", (e => {
                    "script" === e.target.getAttribute("data-mce-object") && e.preventDefault()
                })),
                e.on("ObjectResized", (t => {
                    const r = t.target;
                    if (r.getAttribute("data-mce-object")) {
                        let a = r.getAttribute("data-mce-html");
                        a && (a = unescape(a),
                            r.setAttribute("data-mce-html", escape(E(a, {
                                width: String(t.width),
                                height: String(t.height)
                            }, !1, e.schema))))
                    }
                }))
        })(e),
        (e => ({
            showDialog: () => {
                Z(e)
            }
        }))(e))))
}();
