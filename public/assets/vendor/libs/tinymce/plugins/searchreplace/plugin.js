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
        o = n("string"),
        s = n("array"),
        a = r("boolean"),
        l = r("number"),
        i = () => {},
        c = e => () => e,
        d = c(!0),
        u = c("[!-#%-*,-\\/:;?@\\[-\\]_{}\xa1\xab\xb7\xbb\xbf;\xb7\u055a-\u055f\u0589\u058a\u05be\u05c0\u05c3\u05c6\u05f3\u05f4\u0609\u060a\u060c\u060d\u061b\u061e\u061f\u066a-\u066d\u06d4\u0700-\u070d\u07f7-\u07f9\u0830-\u083e\u085e\u0964\u0965\u0970\u0df4\u0e4f\u0e5a\u0e5b\u0f04-\u0f12\u0f3a-\u0f3d\u0f85\u0fd0-\u0fd4\u0fd9\u0fda\u104a-\u104f\u10fb\u1361-\u1368\u1400\u166d\u166e\u169b\u169c\u16eb-\u16ed\u1735\u1736\u17d4-\u17d6\u17d8-\u17da\u1800-\u180a\u1944\u1945\u1a1e\u1a1f\u1aa0-\u1aa6\u1aa8-\u1aad\u1b5a-\u1b60\u1bfc-\u1bff\u1c3b-\u1c3f\u1c7e\u1c7f\u1cd3\u2010-\u2027\u2030-\u2043\u2045-\u2051\u2053-\u205e\u207d\u207e\u208d\u208e\u3008\u3009\u2768-\u2775\u27c5\u27c6\u27e6-\u27ef\u2983-\u2998\u29d8-\u29db\u29fc\u29fd\u2cf9-\u2cfc\u2cfe\u2cff\u2d70\u2e00-\u2e2e\u2e30\u2e31\u3001-\u3003\u3008-\u3011\u3014-\u301f\u3030\u303d\u30a0\u30fb\ua4fe\ua4ff\ua60d-\ua60f\ua673\ua67e\ua6f2-\ua6f7\ua874-\ua877\ua8ce\ua8cf\ua8f8-\ua8fa\ua92e\ua92f\ua95f\ua9c1-\ua9cd\ua9de\ua9df\uaa5c-\uaa5f\uaade\uaadf\uabeb\ufd3e\ufd3f\ufe10-\ufe19\ufe30-\ufe52\ufe54-\ufe61\ufe63\ufe68\ufe6a\ufe6b\uff01-\uff03\uff05-\uff0a\uff0c-\uff0f\uff1a\uff1b\uff1f\uff20\uff3b-\uff3d\uff3f\uff5b\uff5d\uff5f-\uff65]");
    class h {
        constructor(e, t) {
            this.tag = e,
                this.value = t
        }
        static some(e) {
            return new h(!0, e)
        }
        static none() {
            return h.singletonNone
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
            return this.tag ? h.some(e(this.value)) : h.none()
        }
        bind(e) {
            return this.tag ? e(this.value) : h.none()
        }
        exists(e) {
            return this.tag && e(this.value)
        }
        forall(e) {
            return !this.tag || e(this.value)
        }
        filter(e) {
            return !this.tag || e(this.value) ? this : h.none()
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
            return null == e ? h.none() : h.some(e)
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
    h.singletonNone = new h(!1);
    const m = u;
    var g = tinymce.util.Tools.resolve("tinymce.Env"),
        f = tinymce.util.Tools.resolve("tinymce.util.Tools");
    const p = Array.prototype.slice,
        x = Array.prototype.push,
        y = (e, t) => {
            const n = e.length,
                r = new Array(n);
            for (let o = 0; o < n; o++) {
                const n = e[o];
                r[o] = t(n, o)
            }
            return r
        },
        w = (e, t) => {
            for (let n = 0, r = e.length; n < r; n++)
                t(e[n], n)
        },
        b = (e, t) => {
            for (let n = e.length - 1; n >= 0; n--)
                t(e[n], n)
        },
        v = (e, t) => (e => {
            const t = [];
            for (let n = 0, r = e.length; n < r; ++n) {
                if (!s(e[n]))
                    throw new Error("Arr.flatten item " + n + " was not an array, input: " + e);
                x.apply(t, e[n])
            }
            return t
        })(y(e, t)),
        C = Object.hasOwnProperty,
        E = (e, t) => C.call(e, t);
    "undefined" != typeof window ? window : Function("return this;")();
    const O = (3,
        e => 3 === (e => e.dom.nodeType)(e));
    const N = e => {
            if (null == e)
                throw new Error("Node cannot be null or undefined");
            return {
                dom: e
            }
        },
        T = N,
        k = (e, t) => ({
            element: e,
            offset: t
        }),
        A = (e, t) => {
            ((e, t) => {
                const n = (e => h.from(e.dom.parentNode).map(T))(e);
                n.each((n => {
                    n.dom.insertBefore(t.dom, e.dom)
                }))
            })(e, t),
            ((e, t) => {
                e.dom.appendChild(t.dom)
            })(t, e)
        },
        S = ((e, t) => {
            const n = t => e(t) ? h.from(t.dom.nodeValue) : h.none();
            return {
                get: t => {
                    if (!e(t))
                        throw new Error("Can only get text value of a text node");
                    return n(t).getOr("")
                },
                getOption: n,
                set: (t, n) => {
                    if (!e(t))
                        throw new Error("Can only set raw text value of a text node");
                    t.dom.nodeValue = n
                }
            }
        })(O),
        B = e => S.get(e);
    var F = tinymce.util.Tools.resolve("tinymce.dom.TreeWalker");
    const I = (e, t) => e.isBlock(t) || E(e.schema.getVoidElements(), t.nodeName),
        R = (e, t) => "false" === e.getContentEditable(t),
        M = (e, t) => !e.isBlock(t) && E(e.schema.getWhitespaceElements(), t.nodeName),
        D = (e, t) => ((e, t) => {
            const n = (e => y(e.dom.childNodes, T))(e);
            return n.length > 0 && t < n.length ? k(n[t], 0) : k(e, t)
        })(T(e), t),
        P = (e, t, n, r, o, s = !0) => {
            let a = s ? t(!1) : n;
            for (; a;) {
                const n = R(e, a);
                if (n || M(e, a)) {
                    if (n ? r.cef(a) : r.boundary(a))
                        break;
                    a = t(!0)
                } else {
                    if (I(e, a)) {
                        if (r.boundary(a))
                            break
                    } else
                        3 === a.nodeType && r.text(a);
                    if (a === o)
                        break;
                    a = t(!1)
                }
            }
        },
        W = (e, t, n, r, o) => {
            var s;
            if (((e, t) => I(e, t) || R(e, t) || M(e, t) || ((e, t) => "true" === e.getContentEditable(t) && t.parentNode && "false" === e.getContentEditableParent(t.parentNode))(e, t))(e, n))
                return;
            const a = null !== (s = e.getParent(r, e.isBlock)) && void 0 !== s ? s : e.getRoot(),
                l = new F(n, a),
                i = o ? l.next.bind(l) : l.prev.bind(l);
            P(e, i, n, {
                boundary: d,
                cef: d,
                text: e => {
                    o ? t.fOffset += e.length : t.sOffset += e.length,
                        t.elements.push(T(e))
                }
            })
        },
        $ = (e, t, n, r, o, s = !0) => {
            const a = new F(n, t),
                l = [];
            let i = {
                sOffset: 0,
                fOffset: 0,
                elements: []
            };
            W(e, i, n, t, !1);
            const c = () => (i.elements.length > 0 && (l.push(i),
                    i = {
                        sOffset: 0,
                        fOffset: 0,
                        elements: []
                    }),
                !1);
            return P(e, a.next.bind(a), n, {
                    boundary: c,
                    cef: e => (c(),
                        o && l.push(...o.cef(e)),
                        !1),
                    text: e => {
                        i.elements.push(T(e)),
                            o && o.text(e, i)
                    }
                }, r, s),
                r && W(e, i, r, t, !0),
                c(),
                l
        },
        V = (e, t) => {
            const n = D(t.startContainer, t.startOffset),
                r = n.element.dom,
                o = D(t.endContainer, t.endOffset),
                s = o.element.dom;
            return $(e, t.commonAncestorContainer, r, s, {
                text: (e, t) => {
                    e === s ? t.fOffset += e.length - o.offset : e === r && (t.sOffset += n.offset)
                },
                cef: t => {
                    return ((e, t) => {
                        const n = p.call(e, 0);
                        return n.sort(((e, t) => ((e, t) => ((e, t, n) => 0 != (e.compareDocumentPosition(t) & n))(e, t, Node.DOCUMENT_POSITION_PRECEDING))(e.elements[0].dom, t.elements[0].dom) ? 1 : -1)),
                            n
                    })(v((n = T(t),
                        ((e, t) => {
                            const n = void 0 === t ? document : t.dom;
                            return 1 !== (r = n).nodeType && 9 !== r.nodeType && 11 !== r.nodeType || 0 === r.childElementCount ? [] : y(n.querySelectorAll(e), T);
                            var r
                        })("*[contenteditable=true]", n)), (t => {
                        const n = t.dom;
                        return $(e, n, n)
                    })));
                    var n
                }
            }, !1)
        },
        j = (e, t) => t.collapsed ? [] : V(e, t),
        _ = (e, t) => {
            const n = e.createRng();
            return n.selectNode(t),
                j(e, n)
        },
        z = (e, t) => v(t, (t => {
            const n = t.elements,
                r = y(n, B).join(""),
                o = ((e, t, n = 0, r = e.length) => {
                    const o = t.regex;
                    o.lastIndex = n;
                    const s = [];
                    let a;
                    for (; a = o.exec(e);) {
                        const e = a[t.matchIndex],
                            n = a.index + a[0].indexOf(e),
                            l = n + e.length;
                        if (l > r)
                            break;
                        s.push({
                                start: n,
                                finish: l
                            }),
                            o.lastIndex = l
                    }
                    return s
                })(r, e, t.sOffset, r.length - t.fOffset);
            return ((e, t) => {
                const n = (r = e,
                    o = (e, n) => {
                        const r = B(n),
                            o = e.last,
                            s = o + r.length,
                            a = v(t, ((e, t) => e.start < s && e.finish > o ? [{
                                element: n,
                                start: Math.max(o, e.start) - o,
                                finish: Math.min(s, e.finish) - o,
                                matchId: t
                            }] : []));
                        return {
                            results: e.results.concat(a),
                            last: s
                        }
                    },
                    s = {
                        results: [],
                        last: 0
                    },
                    w(r, ((e, t) => {
                        s = o(s, e)
                    })),
                    s).results;
                var r, o, s;
                return ((e, t) => {
                    if (0 === e.length)
                        return []; {
                        let n = t(e[0]);
                        const r = [];
                        let o = [];
                        for (let s = 0, a = e.length; s < a; s++) {
                            const a = e[s],
                                l = t(a);
                            l !== n && (r.push(o),
                                    o = []),
                                n = l,
                                o.push(a)
                        }
                        return 0 !== o.length && r.push(o),
                            r
                    }
                })(n, (e => e.matchId))
            })(n, o)
        })),
        U = (e, t) => {
            b(e, ((e, n) => {
                b(e, (e => {
                    const r = T(t.cloneNode(!1));
                    ((e, t, n) => {
                        ((e, t, n) => {
                            if (!(o(n) || a(n) || l(n)))
                                throw console.error("Invalid call to Attribute.set. Key ", t, ":: Value ", n, ":: Element ", e),
                                    new Error("Attribute value was not simple");
                            e.setAttribute(t, n + "")
                        })(e.dom, t, n)
                    })(r, "data-mce-index", n);
                    const s = e.element.dom;
                    if (s.length === e.finish && 0 === e.start)
                        A(e.element, r);
                    else {
                        s.length !== e.finish && s.splitText(e.finish);
                        const t = s.splitText(e.start);
                        A(T(t), r)
                    }
                }))
            }))
        },
        q = e => e.getAttribute("data-mce-index"),
        G = (e, t, n, r) => {
            const o = e.dom.create("span", {
                "data-mce-bogus": 1
            });
            o.className = "mce-match-marker";
            const s = e.getBody();
            return te(e, t, !1),
                r ? ((e, t, n, r) => {
                    const o = n.getBookmark(),
                        s = e.select("td[data-mce-selected],th[data-mce-selected]"),
                        a = s.length > 0 ? ((e, t) => v(t, (t => _(e, t))))(e, s) : j(e, n.getRng()),
                        l = z(t, a);
                    return U(l, r),
                        n.moveToBookmark(o),
                        l.length
                })(e.dom, n, e.selection, o) : ((e, t, n, r) => {
                    const o = _(e, n),
                        s = z(t, o);
                    return U(s, r),
                        s.length
                })(e.dom, n, s, o)
        },
        K = e => {
            var t;
            const n = e.parentNode;
            e.firstChild && n.insertBefore(e.firstChild, e),
                null === (t = e.parentNode) || void 0 === t || t.removeChild(e)
        },
        H = (e, t) => {
            const n = [],
                r = f.toArray(e.getBody().getElementsByTagName("span"));
            if (r.length)
                for (let e = 0; e < r.length; e++) {
                    const o = q(r[e]);
                    null !== o && o.length && o === t.toString() && n.push(r[e])
                }
            return n
        },
        J = (e, t, n) => {
            const r = t.get();
            let o = r.index;
            const s = e.dom;
            n ? o + 1 === r.count ? o = 0 : o++ : o - 1 == -1 ? o = r.count - 1 : o--,
                s.removeClass(H(e, r.index), "mce-match-marker-selected");
            const a = H(e, o);
            return a.length ? (s.addClass(H(e, o), "mce-match-marker-selected"),
                e.selection.scrollIntoView(a[0]),
                o) : -1
        },
        L = (e, t) => {
            const n = t.parentNode;
            e.remove(t),
                n && e.isEmpty(n) && e.remove(n)
        },
        Q = (e, t, n, r, o, s) => {
            const a = e.selection,
                l = ((e, t) => {
                    const n = "(" + e.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&").replace(/\s/g, "[^\\S\\r\\n\\uFEFF]") + ")";
                    return t ? `(?:^|\\s|${m()})` + n + `(?=$|\\s|${m()})` : n
                })(n, o),
                i = a.isForward(),
                c = {
                    regex: new RegExp(l, r ? "g" : "gi"),
                    matchIndex: 1
                },
                d = G(e, t, c, s);
            if (g.browser.isSafari() && a.setRng(a.getRng(), i),
                d) {
                const a = J(e, t, !0);
                t.set({
                    index: a,
                    count: d,
                    text: n,
                    matchCase: r,
                    wholeWord: o,
                    inSelection: s
                })
            }
            return d
        },
        X = (e, t) => {
            const n = J(e, t, !0);
            t.set({
                ...t.get(),
                index: n
            })
        },
        Y = (e, t) => {
            const n = J(e, t, !1);
            t.set({
                ...t.get(),
                index: n
            })
        },
        Z = e => {
            const t = q(e);
            return null !== t && t.length > 0
        },
        ee = (e, t, n, r, o) => {
            const s = t.get(),
                a = s.index;
            let l, i = a;
            r = !1 !== r;
            const c = e.getBody(),
                d = f.grep(f.toArray(c.getElementsByTagName("span")), Z);
            for (let t = 0; t < d.length; t++) {
                const c = q(d[t]);
                let u = l = parseInt(c, 10);
                if (o || u === s.index) {
                    for (n.length ? (d[t].innerText = n,
                            K(d[t])) : L(e.dom, d[t]); d[++t];) {
                        if (u = parseInt(q(d[t]), 10),
                            u !== l) {
                            t--;
                            break
                        }
                        L(e.dom, d[t])
                    }
                    r && i--
                } else
                    l > a && d[t].setAttribute("data-mce-index", String(l - 1))
            }
            return t.set({
                    ...s,
                    count: o ? 0 : s.count - 1,
                    index: i
                }),
                r ? X(e, t) : Y(e, t),
                !o && t.get().count > 0
        },
        te = (e, t, n) => {
            let r, o;
            const s = t.get(),
                a = f.toArray(e.getBody().getElementsByTagName("span"));
            for (let e = 0; e < a.length; e++) {
                const t = q(a[e]);
                null !== t && t.length && (t === s.index.toString() && (r || (r = a[e].firstChild),
                        o = a[e].firstChild),
                    K(a[e]))
            }
            if (t.set({
                    ...s,
                    index: -1,
                    count: 0,
                    text: ""
                }),
                r && o) {
                const t = e.dom.createRng();
                return t.setStart(r, 0),
                    t.setEnd(o, o.data.length),
                    !1 !== n && e.selection.setRng(t),
                    t
            }
        },
        ne = (t, n) => {
            const r = (() => {
                const t = (t => {
                    const n = e(h.none()),
                        r = () => n.get().each(t);
                    return {
                        clear: () => {
                            r(),
                                n.set(h.none())
                        },
                        isSet: () => n.get().isSome(),
                        get: () => n.get(),
                        set: e => {
                            r(),
                                n.set(h.some(e))
                        }
                    }
                })(i);
                return {
                    ...t,
                    on: e => t.get().each(e)
                }
            })();
            t.undoManager.add();
            const o = f.trim(t.selection.getContent({
                    format: "text"
                })),
                s = e => {
                    e.setEnabled("next", ((e, t) => t.get().count > 1)(0, n)),
                        e.setEnabled("prev", ((e, t) => t.get().count > 1)(0, n))
                },
                a = (e, t) => {
                    w(["replace", "replaceall", "prev", "next"], (n => e.setEnabled(n, !t)))
                },
                l = (e, t) => {
                    g.browser.isSafari() && g.deviceType.isTouch() && ("find" === t || "replace" === t || "replaceall" === t) && e.focus(t)
                },
                c = e => {
                    te(t, n, !1),
                        a(e, !0),
                        s(e)
                },
                d = e => {
                    const r = e.getData(),
                        o = n.get();
                    if (r.findtext.length) {
                        if (o.text === r.findtext && o.matchCase === r.matchcase && o.wholeWord === r.wholewords)
                            X(t, n);
                        else {
                            const o = Q(t, n, r.findtext, r.matchcase, r.wholewords, r.inselection);
                            o <= 0 && (e => {
                                    e.redial(x(!0, e.getData()))
                                })(e),
                                a(e, 0 === o)
                        }
                        s(e)
                    } else
                        c(e)
                },
                u = n.get(),
                m = {
                    findtext: o,
                    replacetext: "",
                    wholewords: u.wholeWord,
                    matchcase: u.matchCase,
                    inselection: u.inSelection
                },
                p = e => {
                    const t = [{
                        type: "bar",
                        items: [{
                            type: "input",
                            name: "findtext",
                            placeholder: "Find",
                            maximized: !0,
                            inputMode: "search"
                        }, {
                            type: "button",
                            name: "prev",
                            text: "Previous",
                            icon: "action-prev",
                            enabled: !1,
                            borderless: !0
                        }, {
                            type: "button",
                            name: "next",
                            text: "Next",
                            icon: "action-next",
                            enabled: !1,
                            borderless: !0
                        }]
                    }, {
                        type: "input",
                        name: "replacetext",
                        placeholder: "Replace with",
                        inputMode: "search"
                    }];
                    return e && t.push({
                            type: "alertbanner",
                            level: "error",
                            text: "Could not find the specified string.",
                            icon: "warning"
                        }),
                        t
                },
                x = (e, r) => ({
                    title: "Find and Replace",
                    size: "normal",
                    body: {
                        type: "panel",
                        items: p(e)
                    },
                    buttons: [{
                        type: "menu",
                        name: "options",
                        icon: "preferences",
                        tooltip: "Preferences",
                        align: "start",
                        items: [{
                            type: "togglemenuitem",
                            name: "matchcase",
                            text: "Match case"
                        }, {
                            type: "togglemenuitem",
                            name: "wholewords",
                            text: "Find whole words only"
                        }, {
                            type: "togglemenuitem",
                            name: "inselection",
                            text: "Find in selection"
                        }]
                    }, {
                        type: "custom",
                        name: "find",
                        text: "Find",
                        primary: !0
                    }, {
                        type: "custom",
                        name: "replace",
                        text: "Replace",
                        enabled: !1
                    }, {
                        type: "custom",
                        name: "replaceall",
                        text: "Replace all",
                        enabled: !1
                    }],
                    initialData: r,
                    onChange: (t, r) => {
                        e && t.redial(x(!1, t.getData())),
                            "findtext" === r.name && n.get().count > 0 && c(t)
                    },
                    onAction: (e, r) => {
                        const o = e.getData();
                        switch (r.name) {
                            case "find":
                                d(e);
                                break;
                            case "replace":
                                ee(t, n, o.replacetext) ? s(e) : c(e);
                                break;
                            case "replaceall":
                                ee(t, n, o.replacetext, !0, !0),
                                    c(e);
                                break;
                            case "prev":
                                Y(t, n),
                                    s(e);
                                break;
                            case "next":
                                X(t, n),
                                    s(e);
                                break;
                            case "matchcase":
                            case "wholewords":
                            case "inselection":
                                (e => {
                                    const t = e.getData(),
                                        r = n.get();
                                    n.set({
                                        ...r,
                                        matchCase: t.matchcase,
                                        wholeWord: t.wholewords,
                                        inSelection: t.inselection
                                    })
                                })(e),
                                c(e)
                        }
                        l(e, r.name)
                    },
                    onSubmit: e => {
                        d(e),
                            l(e, "find")
                    },
                    onClose: () => {
                        t.focus(),
                            te(t, n),
                            t.undoManager.add()
                    }
                });
            r.set(t.windowManager.open(x(!1, m), {
                inline: "toolbar"
            }))
        },
        re = (e, t) => () => {
            ne(e, t)
        };
    t.add("searchreplace", (t => {
        const n = e({
            index: -1,
            count: 0,
            text: "",
            matchCase: !1,
            wholeWord: !1,
            inSelection: !1
        });
        return ((e, t) => {
                e.addCommand("SearchReplace", (() => {
                    ne(e, t)
                }))
            })(t, n),
            ((e, t) => {
                e.ui.registry.addMenuItem("searchreplace", {
                        text: "Find and replace...",
                        shortcut: "Meta+F",
                        onAction: re(e, t),
                        icon: "search"
                    }),
                    e.ui.registry.addButton("searchreplace", {
                        tooltip: "Find and replace",
                        onAction: re(e, t),
                        icon: "search"
                    }),
                    e.shortcuts.add("Meta+F", "", re(e, t))
            })(t, n),
            ((e, t) => ({
                done: n => te(e, t, n),
                find: (n, r, o, s = !1) => Q(e, t, n, r, o, s),
                next: () => X(e, t),
                prev: () => Y(e, t),
                replace: (n, r, o) => ee(e, t, n, r, o)
            }))(t, n)
    }))
}();
