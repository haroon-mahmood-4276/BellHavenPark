/*!
 * TinyMCE
 *
 * Copyright (c) 2023 Ephox Corporation DBA Tiny Technologies, Inc.
 * Licensed under the Tiny commercial license. See https://www.tiny.cloud/legal/
 *
 * Version: 6.4.1
 */
!function() {
    "use strict";
    var e = tinymce.util.Tools.resolve("tinymce.PluginManager");
    const t = e=>t=>(e=>{
        const t = typeof e;
        return null === e ? "null" : "object" === t && Array.isArray(e) ? "array" : "object" === t && (n = r = e,
        (o = String).prototype.isPrototypeOf(n) || (null === (s = r.constructor) || void 0 === s ? void 0 : s.name) === o.name) ? "string" : t;
        var n, r, o, s
    }
    )(t) === e
      , n = e=>t=>typeof t === e
      , r = t("string")
      , o = t("object")
      , s = t("array")
      , i = n("boolean")
      , l = e=>!(e=>null == e)(e)
      , a = n("function")
      , d = n("number")
      , c = ()=>{}
      , u = (e,t)=>e === t
      , m = e=>t=>!e(t)
      , p = (!1,
    ()=>false);
    class g {
        constructor(e, t) {
            this.tag = e,
            this.value = t
        }
        static some(e) {
            return new g(!0,e)
        }
        static none() {
            return g.singletonNone
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
            return this.tag ? g.some(e(this.value)) : g.none()
        }
        bind(e) {
            return this.tag ? e(this.value) : g.none()
        }
        exists(e) {
            return this.tag && e(this.value)
        }
        forall(e) {
            return !this.tag || e(this.value)
        }
        filter(e) {
            return !this.tag || e(this.value) ? this : g.none()
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
            return l(e) ? g.some(e) : g.none()
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
    g.singletonNone = new g(!1);
    const h = Array.prototype.slice
      , f = Array.prototype.indexOf
      , y = Array.prototype.push
      , v = (e,t)=>{
        return n = e,
        r = t,
        f.call(n, r) > -1;
        var n, r
    }
      , C = (e,t)=>{
        for (let n = 0, r = e.length; n < r; n++)
            if (t(e[n], n))
                return !0;
        return !1
    }
      , b = (e,t)=>{
        const n = e.length
          , r = new Array(n);
        for (let o = 0; o < n; o++) {
            const n = e[o];
            r[o] = t(n, o)
        }
        return r
    }
      , S = (e,t)=>{
        for (let n = 0, r = e.length; n < r; n++)
            t(e[n], n)
    }
      , N = (e,t)=>{
        const n = [];
        for (let r = 0, o = e.length; r < o; r++) {
            const o = e[r];
            t(o, r) && n.push(o)
        }
        return n
    }
      , L = (e,t,n)=>(S(e, ((e,r)=>{
        n = t(n, e, r)
    }
    )),
    n)
      , O = (e,t,n)=>{
        for (let r = 0, o = e.length; r < o; r++) {
            const o = e[r];
            if (t(o, r))
                return g.some(o);
            if (n(o, r))
                break
        }
        return g.none()
    }
      , k = (e,t)=>O(e, t, p)
      , T = (e,t)=>(e=>{
        const t = [];
        for (let n = 0, r = e.length; n < r; ++n) {
            if (!s(e[n]))
                throw new Error("Arr.flatten item " + n + " was not an array, input: " + e);
            y.apply(t, e[n])
        }
        return t
    }
    )(b(e, t))
      , A = e=>{
        const t = h.call(e, 0);
        return t.reverse(),
        t
    }
      , x = (e,t)=>t >= 0 && t < e.length ? g.some(e[t]) : g.none()
      , w = e=>x(e, 0)
      , D = e=>x(e, e.length - 1)
      , E = (e,t)=>{
        const n = []
          , r = a(t) ? e=>C(n, (n=>t(n, e))) : e=>v(n, e);
        for (let t = 0, o = e.length; t < o; t++) {
            const o = e[t];
            r(o) || n.push(o)
        }
        return n
    }
      , B = (e,t,n=u)=>e.exists((e=>n(e, t)))
      , I = (e,t,n)=>e.isSome() && t.isSome() ? g.some(n(e.getOrDie(), t.getOrDie())) : g.none()
      , P = e=>{
        if (null == e)
            throw new Error("Node cannot be null or undefined");
        return {
            dom: e
        }
    }
      , M = (e,t)=>{
        const n = (t || document).createElement(e);
        return P(n)
    }
      , R = P
      , U = (e,t)=>e.dom === t.dom;
    "undefined" != typeof window ? window : Function("return this;")();
    const $ = e=>e.dom.nodeName.toLowerCase()
      , _ = (1,
    e=>1 === (e=>e.dom.nodeType)(e));
    const F = e=>t=>_(t) && $(t) === e
      , H = e=>g.from(e.dom.parentNode).map(R)
      , V = e=>b(e.dom.childNodes, R)
      , j = (e,t)=>{
        const n = e.dom.childNodes;
        return g.from(n[t]).map(R)
    }
      , K = e=>j(e, 0)
      , z = e=>j(e, e.dom.childNodes.length - 1)
      , Q = (e,t,n)=>{
        let r = e.dom;
        const o = a(n) ? n : p;
        for (; r.parentNode; ) {
            r = r.parentNode;
            const e = R(r);
            if (t(e))
                return g.some(e);
            if (o(e))
                break
        }
        return g.none()
    }
      , q = (e,t,n)=>((e,t,n,r,o)=>r(n) ? g.some(n) : a(o) && o(n) ? g.none() : t(n, r, o))(0, Q, e, t, n)
      , W = (e,t)=>{
        H(e).each((n=>{
            n.dom.insertBefore(t.dom, e.dom)
        }
        ))
    }
      , Z = (e,t)=>{
        e.dom.appendChild(t.dom)
    }
      , G = (e,t)=>{
        S(t, (t=>{
            Z(e, t)
        }
        ))
    }
      , J = e=>{
        e.dom.textContent = "",
        S(V(e), (e=>{
            X(e)
        }
        ))
    }
      , X = e=>{
        const t = e.dom;
        null !== t.parentNode && t.parentNode.removeChild(t)
    }
    ;
    var Y = tinymce.util.Tools.resolve("tinymce.dom.RangeUtils")
      , ee = tinymce.util.Tools.resolve("tinymce.dom.TreeWalker")
      , te = tinymce.util.Tools.resolve("tinymce.util.VK");
    const ne = e=>b(e, R)
      , re = Object.keys
      , oe = (e,t)=>{
        const n = re(e);
        for (let r = 0, o = n.length; r < o; r++) {
            const o = n[r];
            t(e[o], o)
        }
    }
      , se = (e,t)=>{
        const n = e.dom;
        oe(t, ((e,t)=>{
            ((e,t,n)=>{
                if (!(r(n) || i(n) || d(n)))
                    throw console.error("Invalid call to Attribute.set. Key ", t, ":: Value ", n, ":: Element ", e),
                    new Error("Attribute value was not simple");
                e.setAttribute(t, n + "")
            }
            )(n, t, e)
        }
        ))
    }
      , ie = e=>L(e.dom.attributes, ((e,t)=>(e[t.name] = t.value,
    e)), {})
      , le = e=>((e,t)=>R(e.dom.cloneNode(!0)))(e)
      , ae = (e,t)=>{
        const n = ((e,t)=>{
            const n = M(t)
              , r = ie(e);
            return se(n, r),
            n
        }
        )(e, t);
        ((e,t)=>{
            const n = (e=>g.from(e.dom.nextSibling).map(R))(e);
            n.fold((()=>{
                H(e).each((e=>{
                    Z(e, t)
                }
                ))
            }
            ), (e=>{
                W(e, t)
            }
            ))
        }
        )(e, n);
        const r = V(e);
        return G(n, r),
        X(e),
        n
    }
    ;
    var de = tinymce.util.Tools.resolve("tinymce.dom.DOMUtils")
      , ce = tinymce.util.Tools.resolve("tinymce.util.Tools");
    const ue = e=>t=>l(t) && t.nodeName.toLowerCase() === e
      , me = e=>t=>l(t) && e.test(t.nodeName)
      , pe = e=>l(e) && 3 === e.nodeType
      , ge = e=>l(e) && 1 === e.nodeType
      , he = me(/^(OL|UL|DL)$/)
      , fe = me(/^(OL|UL)$/)
      , ye = ue("ol")
      , ve = me(/^(LI|DT|DD)$/)
      , Ce = me(/^(DT|DD)$/)
      , be = me(/^(TH|TD)$/)
      , Se = ue("br")
      , Ne = (e,t)=>l(t) && t.nodeName in e.schema.getTextBlockElements()
      , Le = (e,t)=>l(e) && e.nodeName in t
      , Oe = (e,t)=>l(t) && t.nodeName in e.schema.getVoidElements()
      , ke = (e,t,n)=>{
        const r = e.isEmpty(t);
        return !(n && e.select("span[data-mce-type=bookmark]", t).length > 0) && r
    }
      , Te = (e,t)=>e.isChildOf(t, e.getRoot())
      , Ae = e=>t=>t.options.get(e)
      , xe = Ae("lists_indent_on_tab")
      , we = Ae("forced_root_block")
      , De = Ae("forced_root_block_attrs")
      , Ee = (e,t)=>{
        const n = e.dom
          , r = e.schema.getBlockElements()
          , o = n.createFragment()
          , s = we(e)
          , i = De(e);
        let l, a, d = !1;
        for (a = n.create(s, i),
        Le(t.firstChild, r) || o.appendChild(a); l = t.firstChild; ) {
            const e = l.nodeName;
            d || "SPAN" === e && "bookmark" === l.getAttribute("data-mce-type") || (d = !0),
            Le(l, r) ? (o.appendChild(l),
            a = null) : (a || (a = n.create(s, i),
            o.appendChild(a)),
            a.appendChild(l))
        }
        return !d && a && a.appendChild(n.create("br", {
            "data-mce-bogus": "1"
        })),
        o
    }
      , Be = de.DOM
      , Ie = F("dd")
      , Pe = F("dt")
      , Me = (e,t)=>{
        var n;
        Ie(t) ? ae(t, "dt") : Pe(t) && (n = t,
        g.from(n.dom.parentElement).map(R)).each((n=>((e,t,n)=>{
            const r = Be.select('span[data-mce-type="bookmark"]', t)
              , o = Ee(e, n)
              , s = Be.createRng();
            s.setStartAfter(n),
            s.setEndAfter(t);
            const i = s.extractContents();
            for (let t = i.firstChild; t; t = t.firstChild)
                if ("LI" === t.nodeName && e.dom.isEmpty(t)) {
                    Be.remove(t);
                    break
                }
            e.dom.isEmpty(i) || Be.insertAfter(i, t),
            Be.insertAfter(o, t);
            const l = n.parentElement;
            l && ke(e.dom, l) && (e=>{
                const t = e.parentNode;
                t && ce.each(r, (e=>{
                    t.insertBefore(e, n.parentNode)
                }
                )),
                Be.remove(e)
            }
            )(l),
            Be.remove(n),
            ke(e.dom, t) && Be.remove(t)
        }
        )(e, n.dom, t.dom)))
    }
      , Re = e=>{
        Pe(e) && ae(e, "dd")
    }
      , Ue = (e,t)=>{
        if (pe(e))
            return {
                container: e,
                offset: t
            };
        const n = Y.getNode(e, t);
        return pe(n) ? {
            container: n,
            offset: t >= e.childNodes.length ? n.data.length : 0
        } : n.previousSibling && pe(n.previousSibling) ? {
            container: n.previousSibling,
            offset: n.previousSibling.data.length
        } : n.nextSibling && pe(n.nextSibling) ? {
            container: n.nextSibling,
            offset: 0
        } : {
            container: e,
            offset: t
        }
    }
      , $e = e=>{
        const t = e.cloneRange()
          , n = Ue(e.startContainer, e.startOffset);
        t.setStart(n.container, n.offset);
        const r = Ue(e.endContainer, e.endOffset);
        return t.setEnd(r.container, r.offset),
        t
    }
      , _e = ["OL", "UL", "DL"]
      , Fe = _e.join(",")
      , He = (e,t)=>{
        const n = t || e.selection.getStart(!0);
        return e.dom.getParent(n, Fe, Ke(e, n))
    }
      , Ve = e=>{
        const t = e.selection.getSelectedBlocks();
        return N(((e,t)=>{
            const n = ce.map(t, (t=>e.dom.getParent(t, "li,dd,dt", Ke(e, t)) || t));
            return E(n)
        }
        )(e, t), ve)
    }
      , je = (e,t)=>{
        const n = e.dom.getParents(t, "TD,TH");
        return n.length > 0 ? n[0] : e.getBody()
    }
      , Ke = (e,t)=>{
        const n = e.dom.getParents(t, e.dom.isBlock)
          , r = k(n, (t=>{
            return n = e.schema,
            !he(r = t) && !ve(r) && C(_e, (e=>n.isValidChild(r.nodeName, e)));
            var n, r
        }
        ));
        return r.getOr(e.getBody())
    }
      , ze = (e,t)=>{
        const n = e.dom.getParents(t, "ol,ul", Ke(e, t));
        return D(n)
    }
      , Qe = (e,t)=>{
        const n = b(t, (t=>ze(e, t).getOr(t)));
        return E(n)
    }
      , qe = e=>/\btox\-/.test(e.className)
      , We = (e,t)=>O(e, he, be).exists((e=>e.nodeName === t && !qe(e)))
      , Ze = (e,t)=>null !== t && !e.dom.isEditable(t)
      , Ge = (e,t)=>{
        const n = e.dom.getParent(t, "ol,ul,dl");
        return Ze(e, n)
    }
      , Je = (e,t)=>{
        const n = e.selection.getNode();
        return t({
            parents: e.dom.getParents(n),
            element: n
        }),
        e.on("NodeChange", t),
        ()=>e.off("NodeChange", t)
    }
      , Xe = (e,t,n)=>e.dispatch("ListMutation", {
        action: t,
        element: n
    })
      , Ye = (et = /^\s+|\s+$/g,
    e=>e.replace(et, ""));
    var et;
    const tt = (e,t,n)=>{
        ((e,t,n)=>{
            if (!r(n))
                throw console.error("Invalid call to CSS.set. Property ", t, ":: Value ", n, ":: Element ", e),
                new Error("CSS value must be a string: " + n);
            (e=>void 0 !== e.style && a(e.style.getPropertyValue))(e) && e.style.setProperty(t, n)
        }
        )(e.dom, t, n)
    }
      , nt = (e,t)=>{
        Z(e.item, t.list)
    }
      , rt = (e,t)=>{
        const n = {
            list: M(t, e),
            item: M("li", e)
        };
        return Z(n.list, n.item),
        n
    }
      , ot = e=>((e,t)=>{
        const n = e.dom;
        if (1 !== n.nodeType)
            return !1;
        {
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
    }
    )(e, "OL,UL")
      , st = e=>K(e).exists(ot)
      , it = e=>e.depth > 0
      , lt = e=>e.isSelected
      , at = e=>{
        const t = V(e)
          , n = z(e).exists(ot) ? t.slice(0, -1) : t;
        return b(n, le)
    }
      , dt = e=>(S(e, ((t,n)=>{
        ((e,t)=>{
            const n = e[t].depth
              , r = e=>e.depth === n && !e.dirty
              , o = e=>e.depth < n;
            return O(A(e.slice(0, t)), r, o).orThunk((()=>O(e.slice(t + 1), r, o)))
        }
        )(e, n).fold((()=>{
            t.dirty && (e=>{
                e.listAttributes = ((e,t)=>{
                    const n = {};
                    var r;
                    return ((e,t,n,r)=>{
                        oe(e, ((e,o)=>{
                            (t(e, o) ? n : r)(e, o)
                        }
                        ))
                    }
                    )(e, t, (r = n,
                    (e,t)=>{
                        r[t] = e
                    }
                    ), c),
                    n
                }
                )(e.listAttributes, ((e,t)=>"start" !== t))
            }
            )(t)
        }
        ), (e=>{
            return r = e,
            (n = t).listType = r.listType,
            void (n.listAttributes = {
                ...r.listAttributes
            });
            var n, r
        }
        ))
    }
    )),
    e)
      , ct = (e,t,n,r)=>K(r).filter(ot).fold((()=>{
        t.each((e=>{
            U(e.start, r) && n.set(!0)
        }
        ));
        const o = ((e,t,n)=>H(e).filter(_).map((r=>({
            depth: t,
            dirty: !1,
            isSelected: n,
            content: at(e),
            itemAttributes: ie(e),
            listAttributes: ie(r),
            listType: $(r)
        }))))(r, e, n.get());
        t.each((e=>{
            U(e.end, r) && n.set(!1)
        }
        ));
        const s = z(r).filter(ot).map((r=>ut(e, t, n, r))).getOr([]);
        return o.toArray().concat(s)
    }
    ), (r=>ut(e, t, n, r)))
      , ut = (e,t,n,r)=>T(V(r), (r=>(ot(r) ? ut : ct)(e + 1, t, n, r)))
      , mt = (e,t)=>{
        const n = dt(t);
        return ((e,t)=>{
            const n = L(t, ((t,n)=>n.depth > t.length ? ((e,t,n)=>{
                const r = ((e,t,n)=>{
                    const r = [];
                    for (let o = 0; o < n; o++)
                        r.push(rt(e, t.listType));
                    return r
                }
                )(e, n, n.depth - t.length);
                var o;
                return (e=>{
                    for (let t = 1; t < e.length; t++)
                        nt(e[t - 1], e[t])
                }
                )(r),
                ((e,t)=>{
                    for (let t = 0; t < e.length - 1; t++)
                        tt(e[t].item, "list-style-type", "none");
                    D(e).each((e=>{
                        se(e.list, t.listAttributes),
                        se(e.item, t.itemAttributes),
                        G(e.item, t.content)
                    }
                    ))
                }
                )(r, n),
                o = r,
                I(D(t), w(o), nt),
                t.concat(r)
            }
            )(e, t, n) : ((e,t,n)=>{
                const r = t.slice(0, n.depth);
                return D(r).each((t=>{
                    const r = ((e,t,n)=>{
                        const r = M("li", e);
                        return se(r, t),
                        G(r, n),
                        r
                    }
                    )(e, n.itemAttributes, n.content);
                    ((e,t)=>{
                        Z(e.list, t),
                        e.item = t
                    }
                    )(t, r),
                    ((e,t)=>{
                        $(e.list) !== t.listType && (e.list = ae(e.list, t.listType)),
                        se(e.list, t.listAttributes)
                    }
                    )(t, n)
                }
                )),
                r
            }
            )(e, t, n)), []);
            return w(n).map((e=>e.list))
        }
        )(e.contentDocument, n).toArray()
    }
      , pt = (e,t,n)=>{
        const r = ((e,t)=>{
            const n = (e=>{
                let t = !1;
                return {
                    get: ()=>t,
                    set: e=>{
                        t = e
                    }
                }
            }
            )();
            return b(e, (e=>({
                sourceList: e,
                entries: ut(0, t, n, e)
            })))
        }
        )(t, (e=>{
            const t = b(Ve(e), R);
            return I(k(t, m(st)), k(A(t), m(st)), ((e,t)=>({
                start: e,
                end: t
            })))
        }
        )(e));
        S(r, (t=>{
            ((e,t)=>{
                S(N(e, lt), (e=>((e,t)=>{
                    switch (e) {
                    case "Indent":
                        t.depth++;
                        break;
                    case "Outdent":
                        t.depth--;
                        break;
                    case "Flatten":
                        t.depth = 0
                    }
                    t.dirty = !0
                }
                )(t, e)))
            }
            )(t.entries, n);
            const r = ((e,t)=>T(((e,t)=>{
                if (0 === e.length)
                    return [];
                {
                    let n = t(e[0]);
                    const r = [];
                    let o = [];
                    for (let s = 0, i = e.length; s < i; s++) {
                        const i = e[s]
                          , l = t(i);
                        l !== n && (r.push(o),
                        o = []),
                        n = l,
                        o.push(i)
                    }
                    return 0 !== o.length && r.push(o),
                    r
                }
            }
            )(t, it), (t=>w(t).exists(it) ? mt(e, t) : ((e,t)=>{
                const n = dt(t);
                return b(n, (t=>{
                    const n = ((e,t)=>{
                        const n = document.createDocumentFragment();
                        return S(e, (e=>{
                            n.appendChild(e.dom)
                        }
                        )),
                        R(n)
                    }
                    )(t.content);
                    return R(Ee(e, n.dom))
                }
                ))
            }
            )(e, t))))(e, t.entries);
            var o;
            S(r, (t=>{
                Xe(e, "Indent" === n ? "IndentList" : "OutdentList", t.dom)
            }
            )),
            o = t.sourceList,
            S(r, (e=>{
                W(o, e)
            }
            )),
            X(t.sourceList)
        }
        ))
    }
      , gt = (e,t)=>{
        const n = ne((e=>{
            const t = (e=>{
                const t = ze(e, e.selection.getStart())
                  , n = N(e.selection.getSelectedBlocks(), fe);
                return t.toArray().concat(n)
            }
            )(e);
            return Qe(e, t)
        }
        )(e))
          , r = ne((e=>N(Ve(e), Ce))(e));
        let o = !1;
        if (n.length || r.length) {
            const s = e.selection.getBookmark();
            pt(e, n, t),
            ((e,t,n)=>{
                S(n, "Indent" === t ? Re : t=>Me(e, t))
            }
            )(e, t, r),
            e.selection.moveToBookmark(s),
            e.selection.setRng($e(e.selection.getRng())),
            e.nodeChanged(),
            o = !0
        }
        return o
    }
      , ht = (e,t)=>!(e=>{
        const t = He(e);
        return Ze(e, t)
    }
    )(e) && gt(e, t)
      , ft = e=>ht(e, "Indent")
      , yt = e=>ht(e, "Outdent")
      , vt = e=>ht(e, "Flatten")
      , Ct = e=>"\ufeff" === e;
    var bt = tinymce.util.Tools.resolve("tinymce.dom.BookmarkManager");
    const St = de.DOM
      , Nt = e=>{
        const t = {}
          , n = n=>{
            let r = e[n ? "startContainer" : "endContainer"]
              , o = e[n ? "startOffset" : "endOffset"];
            if (ge(r)) {
                const e = St.create("span", {
                    "data-mce-type": "bookmark"
                });
                r.hasChildNodes() ? (o = Math.min(o, r.childNodes.length - 1),
                n ? r.insertBefore(e, r.childNodes[o]) : St.insertAfter(e, r.childNodes[o])) : r.appendChild(e),
                r = e,
                o = 0
            }
            t[n ? "startContainer" : "endContainer"] = r,
            t[n ? "startOffset" : "endOffset"] = o
        }
        ;
        return n(!0),
        e.collapsed || n(),
        t
    }
      , Lt = e=>{
        const t = t=>{
            let n = e[t ? "startContainer" : "endContainer"]
              , r = e[t ? "startOffset" : "endOffset"];
            if (n) {
                if (ge(n) && n.parentNode) {
                    const e = n;
                    r = (e=>{
                        var t;
                        let n = null === (t = e.parentNode) || void 0 === t ? void 0 : t.firstChild
                          , r = 0;
                        for (; n; ) {
                            if (n === e)
                                return r;
                            ge(n) && "bookmark" === n.getAttribute("data-mce-type") || r++,
                            n = n.nextSibling
                        }
                        return -1
                    }
                    )(n),
                    n = n.parentNode,
                    St.remove(e),
                    !n.hasChildNodes() && St.isBlock(n) && n.appendChild(St.create("br"))
                }
                e[t ? "startContainer" : "endContainer"] = n,
                e[t ? "startOffset" : "endOffset"] = r
            }
        }
        ;
        t(!0),
        t();
        const n = St.createRng();
        return n.setStart(e.startContainer, e.startOffset),
        e.endContainer && n.setEnd(e.endContainer, e.endOffset),
        $e(n)
    }
      , Ot = e=>{
        switch (e) {
        case "UL":
            return "ToggleUlList";
        case "OL":
            return "ToggleOlList";
        case "DL":
            return "ToggleDLList"
        }
    }
      , kt = (e,t)=>{
        ce.each(t, ((t,n)=>{
            e.setAttribute(n, t)
        }
        ))
    }
      , Tt = (e,t,n)=>{
        ((e,t,n)=>{
            const r = n["list-style-type"] ? n["list-style-type"] : null;
            e.setStyle(t, "list-style-type", r)
        }
        )(e, t, n),
        ((e,t,n)=>{
            kt(t, n["list-attributes"]),
            ce.each(e.select("li", t), (e=>{
                kt(e, n["list-item-attributes"])
            }
            ))
        }
        )(e, t, n)
    }
      , At = (e,t)=>l(t) && !Le(t, e.schema.getBlockElements())
      , xt = (e,t,n,r)=>{
        let o = t[n ? "startContainer" : "endContainer"];
        const s = t[n ? "startOffset" : "endOffset"];
        ge(o) && (o = o.childNodes[Math.min(s, o.childNodes.length - 1)] || o),
        !n && Se(o.nextSibling) && (o = o.nextSibling);
        const i = (t,n)=>{
            var o;
            const s = new ee(t,r)
              , i = n ? "next" : "prev";
            let l;
            for (; l = s[i](); )
                if (!Oe(e, l) && !Ct(l.textContent) && 0 !== (null === (o = l.textContent) || void 0 === o ? void 0 : o.length))
                    return g.some(l);
            return g.none()
        }
        ;
        if (n && pe(o))
            if (Ct(o.textContent))
                o = i(o, !1).getOr(o);
            else
                for (null !== o.parentNode && At(e, o.parentNode) && (o = o.parentNode); null !== o.previousSibling && (At(e, o.previousSibling) || pe(o.previousSibling)); )
                    o = o.previousSibling;
        if (!n && pe(o))
            if (Ct(o.textContent))
                o = i(o, !0).getOr(o);
            else
                for (null !== o.parentNode && At(e, o.parentNode) && (o = o.parentNode); null !== o.nextSibling && (At(e, o.nextSibling) || pe(o.nextSibling)); )
                    o = o.nextSibling;
        for (; o.parentNode !== r; ) {
            const t = o.parentNode;
            if (Ne(e, o))
                return o;
            if (/^(TD|TH)$/.test(t.nodeName))
                return o;
            o = t
        }
        return o
    }
      , wt = (e,t,n)=>{
        const r = e.selection.getRng();
        let o = "LI";
        const s = Ke(e, e.selection.getStart(!0))
          , i = e.dom;
        if ("false" === i.getContentEditable(e.selection.getNode()))
            return;
        "DL" === (t = t.toUpperCase()) && (o = "DT");
        const l = Nt(r)
          , a = ((e,t,n)=>{
            const r = []
              , o = e.dom
              , s = xt(e, t, !0, n)
              , i = xt(e, t, !1, n);
            let l;
            const a = [];
            for (let e = s; e && (a.push(e),
            e !== i); e = e.nextSibling)
                ;
            return ce.each(a, (t=>{
                var s;
                if (Ne(e, t))
                    return r.push(t),
                    void (l = null);
                if (o.isBlock(t) || Se(t))
                    return Se(t) && o.remove(t),
                    void (l = null);
                const i = t.nextSibling;
                bt.isBookmarkNode(t) && (he(i) || Ne(e, i) || !i && t.parentNode === n) ? l = null : (l || (l = o.create("p"),
                null === (s = t.parentNode) || void 0 === s || s.insertBefore(l, t),
                r.push(l)),
                l.appendChild(t))
            }
            )),
            r
        }
        )(e, r, s);
        ce.each(a, (r=>{
            let s;
            const l = r.previousSibling
              , a = r.parentNode;
            ve(a) || (l && he(l) && l.nodeName === t && ((e,t,n)=>{
                const r = e.getStyle(t, "list-style-type");
                let o = n ? n["list-style-type"] : "";
                return o = null === o ? "" : o,
                r === o
            }
            )(i, l, n) ? (s = l,
            r = i.rename(r, o),
            l.appendChild(r)) : (s = i.create(t),
            a.insertBefore(s, r),
            s.appendChild(r),
            r = i.rename(r, o)),
            ((e,t,n)=>{
                ce.each(["margin", "margin-right", "margin-bottom", "margin-left", "margin-top", "padding", "padding-right", "padding-bottom", "padding-left", "padding-top"], (n=>e.setStyle(t, n, "")))
            }
            )(i, r),
            Tt(i, s, n),
            Et(e.dom, s))
        }
        )),
        e.selection.setRng(Lt(l))
    }
      , Dt = (e,t,n)=>{
        return ((e,t)=>he(e) && e.nodeName === (null == t ? void 0 : t.nodeName))(t, n) && ((e,t,n)=>e.getStyle(t, "list-style-type", !0) === e.getStyle(n, "list-style-type", !0))(e, t, n) && (r = n,
        t.className === r.className);
        var r
    }
      , Et = (e,t)=>{
        let n, r = t.nextSibling;
        if (Dt(e, t, r)) {
            const o = r;
            for (; n = o.firstChild; )
                t.appendChild(n);
            e.remove(o)
        }
        if (r = t.previousSibling,
        Dt(e, t, r)) {
            const o = r;
            for (; n = o.lastChild; )
                t.insertBefore(n, t.firstChild);
            e.remove(o)
        }
    }
      , Bt = e=>"list-style-type"in e
      , It = (e,t,n)=>{
        const r = He(e);
        if (Ge(e, r) || (e=>C(e.selection.getSelectedBlocks(), m(e.dom.isEditable)))(e))
            return;
        const s = (e=>{
            const t = He(e)
              , n = e.selection.getSelectedBlocks();
            return ((e,t)=>l(e) && 1 === t.length && t[0] === e)(t, n) ? (e=>N(e.querySelectorAll(Fe), he))(t) : N(n, (e=>he(e) && t !== e))
        }
        )(e)
          , i = o(n) ? n : {};
        s.length > 0 ? ((e,t,n,r,o)=>{
            const s = he(t);
            if (s && t.nodeName === r && !Bt(o))
                vt(e);
            else {
                wt(e, r, o);
                const i = Nt(e.selection.getRng())
                  , l = s ? [t, ...n] : n;
                ce.each(l, (t=>{
                    ((e,t,n,r)=>{
                        if (t.nodeName !== n) {
                            const o = e.dom.rename(t, n);
                            Tt(e.dom, o, r),
                            Xe(e, Ot(n), o)
                        } else
                            Tt(e.dom, t, r),
                            Xe(e, Ot(n), t)
                    }
                    )(e, t, r, o)
                }
                )),
                e.selection.setRng(Lt(i))
            }
        }
        )(e, r, s, t, i) : ((e,t,n,r)=>{
            if (t !== e.getBody())
                if (t)
                    if (t.nodeName !== n || Bt(r) || qe(t)) {
                        const o = Nt(e.selection.getRng());
                        Tt(e.dom, t, r);
                        const s = e.dom.rename(t, n);
                        Et(e.dom, s),
                        e.selection.setRng(Lt(o)),
                        wt(e, n, r),
                        Xe(e, Ot(n), s)
                    } else
                        vt(e);
                else
                    wt(e, n, r),
                    Xe(e, Ot(n), t)
        }
        )(e, r, t, i)
    }
      , Pt = de.DOM
      , Mt = (e,t)=>{
        const n = ce.grep(e.select("ol,ul", t));
        ce.each(n, (t=>{
            ((e,t)=>{
                const n = t.parentElement;
                if (n && "LI" === n.nodeName && n.firstChild === t) {
                    const r = n.previousSibling;
                    r && "LI" === r.nodeName ? (r.appendChild(t),
                    ke(e, n) && Pt.remove(n)) : Pt.setStyle(n, "listStyleType", "none")
                }
                if (he(n)) {
                    const e = n.previousSibling;
                    e && "LI" === e.nodeName && e.appendChild(t)
                }
            }
            )(e, t)
        }
        ))
    }
      , Rt = (e,t,n,r)=>{
        let o = t.startContainer;
        const s = t.startOffset;
        if (pe(o) && (n ? s < o.data.length : s > 0))
            return o;
        const i = e.schema.getNonEmptyElements();
        ge(o) && (o = Y.getNode(o, s));
        const l = new ee(o,r);
        n && ((e,t)=>!!Se(t) && e.isBlock(t.nextSibling) && !Se(t.previousSibling))(e.dom, o) && l.next();
        const a = n ? l.next.bind(l) : l.prev2.bind(l);
        for (; o = a(); ) {
            if ("LI" === o.nodeName && !o.hasChildNodes())
                return o;
            if (i[o.nodeName])
                return o;
            if (pe(o) && o.data.length > 0)
                return o
        }
        return null
    }
      , Ut = (e,t)=>{
        const n = t.childNodes;
        return 1 === n.length && !he(n[0]) && e.isBlock(n[0])
    }
      , $t = (e,t,n)=>{
        let r;
        const o = t.parentNode;
        if (!Te(e, t) || !Te(e, n))
            return;
        he(n.lastChild) && (r = n.lastChild),
        o === n.lastChild && Se(o.previousSibling) && e.remove(o.previousSibling);
        const s = n.lastChild;
        s && Se(s) && t.hasChildNodes() && e.remove(s),
        ke(e, n, !0) && J(R(n)),
        ((e,t,n)=>{
            let r;
            const o = Ut(e, n) ? n.firstChild : n;
            if (((e,t)=>{
                Ut(e, t) && e.remove(t.firstChild, !0)
            }
            )(e, t),
            !ke(e, t, !0))
                for (; r = t.firstChild; )
                    o.appendChild(r)
        }
        )(e, t, n),
        r && n.appendChild(r);
        const i = ((e,t)=>{
            const n = e.dom
              , r = t.dom;
            return n !== r && n.contains(r)
        }
        )(R(n), R(t)) ? e.getParents(t, he, n) : [];
        e.remove(t),
        S(i, (t=>{
            ke(e, t) && t !== e.getRoot() && e.remove(t)
        }
        ))
    }
      , _t = (e,t)=>{
        const n = e.dom
          , r = e.selection
          , o = r.getStart()
          , s = je(e, o)
          , i = n.getParent(r.getStart(), "LI", s);
        if (i) {
            const o = i.parentElement;
            if (o === e.getBody() && ke(n, o))
                return !0;
            const l = $e(r.getRng())
              , a = n.getParent(Rt(e, l, t, s), "LI", s);
            if (a && a !== i)
                return e.undoManager.transact((()=>{
                    var n, r;
                    t ? ((e,t,n,r)=>{
                        const o = e.dom;
                        if (o.isEmpty(r))
                            ((e,t,n)=>{
                                J(R(n)),
                                $t(e.dom, t, n),
                                e.selection.setCursorLocation(n, 0)
                            }
                            )(e, n, r);
                        else {
                            const s = Nt(t);
                            $t(o, n, r),
                            e.selection.setRng(Lt(s))
                        }
                    }
                    )(e, l, a, i) : (null === (r = (n = i).parentNode) || void 0 === r ? void 0 : r.firstChild) === n ? yt(e) : ((e,t,n,r)=>{
                        const o = Nt(t);
                        $t(e.dom, n, r);
                        const s = Lt(o);
                        e.selection.setRng(s)
                    }
                    )(e, l, i, a)
                }
                )),
                !0;
            if (!a && !t && 0 === l.startOffset && 0 === l.endOffset)
                return e.undoManager.transact((()=>{
                    vt(e)
                }
                )),
                !0
        }
        return !1
    }
      , Ft = e=>{
        const t = e.selection.getStart()
          , n = je(e, t);
        return e.dom.getParent(t, "LI,DT,DD", n) || Ve(e).length > 0
    }
      , Ht = (e,t)=>{
        const n = e.selection;
        return !Ge(e, n.getNode()) && (n.isCollapsed() ? ((e,t)=>_t(e, t) || ((e,t)=>{
            const n = e.dom
              , r = e.selection.getStart()
              , o = je(e, r)
              , s = n.getParent(r, n.isBlock, o);
            if (s && n.isEmpty(s)) {
                const r = $e(e.selection.getRng())
                  , i = n.getParent(Rt(e, r, t, o), "LI", o);
                if (i) {
                    const l = e=>v(["td", "th", "caption"], $(e))
                      , a = e=>e.dom === o;
                    return !!((e,t,n=u)=>I(e, t, n).getOr(e.isNone() && t.isNone()))(q(R(i), l, a), q(R(r.startContainer), l, a), U) && (e.undoManager.transact((()=>{
                        ((e,t,n)=>{
                            const r = e.getParent(t.parentNode, e.isBlock, n);
                            e.remove(t),
                            r && e.isEmpty(r) && e.remove(r)
                        }
                        )(n, s, o),
                        Et(n, i.parentNode),
                        e.selection.select(i, !0),
                        e.selection.collapse(t)
                    }
                    )),
                    !0)
                }
            }
            return !1
        }
        )(e, t))(e, t) : (e=>!!Ft(e) && (e.undoManager.transact((()=>{
            e.execCommand("Delete"),
            Mt(e.dom, e.getBody())
        }
        )),
        !0))(e))
    }
      , Vt = e=>{
        const t = A(Ye(e).split(""))
          , n = b(t, ((e,t)=>{
            const n = e.toUpperCase().charCodeAt(0) - "A".charCodeAt(0) + 1;
            return Math.pow(26, t) * n
        }
        ));
        return L(n, ((e,t)=>e + t), 0)
    }
      , jt = e=>{
        if (--e < 0)
            return "";
        {
            const t = e % 26
              , n = Math.floor(e / 26);
            return jt(n) + String.fromCharCode("A".charCodeAt(0) + t)
        }
    }
      , Kt = e=>{
        const t = parseInt(e.start, 10);
        return B(e.listStyleType, "upper-alpha") ? jt(t) : B(e.listStyleType, "lower-alpha") ? jt(t).toLowerCase() : e.start
    }
      , zt = (e,t)=>()=>{
        const n = He(e);
        return l(n) && n.nodeName === t
    }
      , Qt = e=>{
        e.addCommand("mceListProps", (()=>{
            (e=>{
                const t = He(e);
                ye(t) && !Ge(e, t) && e.windowManager.open({
                    title: "List Properties",
                    body: {
                        type: "panel",
                        items: [{
                            type: "input",
                            name: "start",
                            label: "Start list at number",
                            inputMode: "numeric"
                        }]
                    },
                    initialData: {
                        start: Kt({
                            start: e.dom.getAttrib(t, "start", "1"),
                            listStyleType: g.from(e.dom.getStyle(t, "list-style-type"))
                        })
                    },
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
                    onSubmit: t=>{
                        (e=>{
                            switch ((e=>/^[0-9]+$/.test(e) ? 2 : /^[A-Z]+$/.test(e) ? 0 : /^[a-z]+$/.test(e) ? 1 : e.length > 0 ? 4 : 3)(e)) {
                            case 2:
                                return g.some({
                                    listStyleType: g.none(),
                                    start: e
                                });
                            case 0:
                                return g.some({
                                    listStyleType: g.some("upper-alpha"),
                                    start: Vt(e).toString()
                                });
                            case 1:
                                return g.some({
                                    listStyleType: g.some("lower-alpha"),
                                    start: Vt(e).toString()
                                });
                            case 3:
                                return g.some({
                                    listStyleType: g.none(),
                                    start: ""
                                });
                            case 4:
                                return g.none()
                            }
                        }
                        )(t.getData().start).each((t=>{
                            e.execCommand("mceListUpdate", !1, {
                                attrs: {
                                    start: "1" === t.start ? "" : t.start
                                },
                                styles: {
                                    "list-style-type": t.listStyleType.getOr("")
                                }
                            })
                        }
                        )),
                        t.close()
                    }
                })
            }
            )(e)
        }
        ))
    }
    ;
    var qt = tinymce.util.Tools.resolve("tinymce.html.Node");
    const Wt = e=>3 === e.type
      , Zt = e=>0 === e.length
      , Gt = e=>{
        const t = (t,n)=>{
            const r = qt.create("li");
            S(t, (e=>r.append(e))),
            n ? e.insert(r, n, !0) : e.append(r)
        }
          , n = L(e.children(), ((e,n)=>Wt(n) ? [...e, n] : Zt(e) || Wt(n) ? e : (t(e, n),
        [])), []);
        Zt(n) || t(n)
    }
      , Jt = (e,t)=>n=>Je(e, (r=>{
        n.setActive(We(r.parents, t)),
        n.setEnabled(!Ge(e, r.element))
    }
    ))
      , Xt = (e,t)=>n=>Je(e, (r=>n.setEnabled(We(r.parents, t) && !Ge(e, r.element))));
    e.add("lists", (e=>((e=>{
        (0,
        e.options.register)("lists_indent_on_tab", {
            processor: "boolean",
            default: !0
        })
    }
    )(e),
    (e=>{
        e.on("PreInit", (()=>{
            const {parser: t} = e;
            t.addNodeFilter("ul,ol", (e=>S(e, Gt)))
        }
        ))
    }
    )(e),
    e.hasPlugin("rtc", !0) ? Qt(e) : ((e=>{
        xe(e) && (e=>{
            e.on("keydown", (t=>{
                t.keyCode !== te.TAB || te.metaKeyPressed(t) || e.undoManager.transact((()=>{
                    (t.shiftKey ? yt(e) : ft(e)) && t.preventDefault()
                }
                ))
            }
            ))
        }
        )(e),
        (e=>{
            e.on("ExecCommand", (t=>{
                const n = t.command.toLowerCase();
                "delete" !== n && "forwarddelete" !== n || !Ft(e) || Mt(e.dom, e.getBody())
            }
            )),
            e.on("keydown", (t=>{
                t.keyCode === te.BACKSPACE ? Ht(e, !1) && t.preventDefault() : t.keyCode === te.DELETE && Ht(e, !0) && t.preventDefault()
            }
            ))
        }
        )(e)
    }
    )(e),
    (e=>{
        e.on("BeforeExecCommand", (t=>{
            const n = t.command.toLowerCase();
            "indent" === n ? ft(e) : "outdent" === n && yt(e)
        }
        )),
        e.addCommand("InsertUnorderedList", ((t,n)=>{
            It(e, "UL", n)
        }
        )),
        e.addCommand("InsertOrderedList", ((t,n)=>{
            It(e, "OL", n)
        }
        )),
        e.addCommand("InsertDefinitionList", ((t,n)=>{
            It(e, "DL", n)
        }
        )),
        e.addCommand("RemoveList", (()=>{
            vt(e)
        }
        )),
        Qt(e),
        e.addCommand("mceListUpdate", ((t,n)=>{
            o(n) && ((e,t)=>{
                const n = He(e);
                null === n || Ge(e, n) || e.undoManager.transact((()=>{
                    o(t.styles) && e.dom.setStyles(n, t.styles),
                    o(t.attrs) && oe(t.attrs, ((t,r)=>e.dom.setAttrib(n, r, t)))
                }
                ))
            }
            )(e, n)
        }
        )),
        e.addQueryStateHandler("InsertUnorderedList", zt(e, "UL")),
        e.addQueryStateHandler("InsertOrderedList", zt(e, "OL")),
        e.addQueryStateHandler("InsertDefinitionList", zt(e, "DL"))
    }
    )(e)),
    (e=>{
        const t = t=>()=>e.execCommand(t);
        e.hasPlugin("advlist") || (e.ui.registry.addToggleButton("numlist", {
            icon: "ordered-list",
            active: !1,
            tooltip: "Numbered list",
            onAction: t("InsertOrderedList"),
            onSetup: Jt(e, "OL")
        }),
        e.ui.registry.addToggleButton("bullist", {
            icon: "unordered-list",
            active: !1,
            tooltip: "Bullet list",
            onAction: t("InsertUnorderedList"),
            onSetup: Jt(e, "UL")
        }))
    }
    )(e),
    (e=>{
        const t = {
            text: "List properties...",
            icon: "ordered-list",
            onAction: ()=>e.execCommand("mceListProps"),
            onSetup: Xt(e, "OL")
        };
        e.ui.registry.addMenuItem("listprops", t),
        e.ui.registry.addContextMenu("lists", {
            update: t=>{
                const n = He(e, t);
                return ye(n) ? ["listprops"] : []
            }
        })
    }
    )(e),
    (e=>({
        backspaceDelete: t=>{
            Ht(e, t)
        }
    }))(e))))
}();
