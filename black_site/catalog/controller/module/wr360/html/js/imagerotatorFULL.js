(function ()
{
    WR360 = {}
})();
(function ()
{
    Function.prototype.bE = function (eB)
    {
        if (eB.constructor == Function)
        {
            this.prototype = new eB;
            this.prototype.constructor = this;
            this.prototype.ct = eB.prototype;
            this.prototype.iQ = 0;
            this.prototype.aB = function ()
            {
                var ct = this.ct;
                for (var i = this.iQ; i > 0; i--) {
                    ct = ct.ct
                }
                this.iQ++;
                return ct;
            }
        }
        else {
            this.prototype = eB;
            this.prototype.constructor = this;
            this.prototype.ct = eB
        }
        return this;
    };
    String.prototype.format = function ()
    {
        var aI = this;
        i = arguments.length;
        while (i--) {
            aI = aI.replace(new RegExp("\\{" + i + "\\}", "gm"), arguments[i])
        }
        return aI;
    };
    String.prototype.trim = function ()
    {
        return this.replace(/^\s+|\s+$/g, "");
    };
    String.prototype.dd = function ()
    {
        var aI = this;
        if (aI.length == 1) {
            aI = "0" + aI
        }
        return aI;
    };
    String.prototype.mI = function ()
    {
        var aI = this;
        if (aI.length == 1) {
            aI = "00" + aI
        }
        else if (aI.length == 2) {
            aI = "0" + aI
        }
        return aI;
    };
    String.prototype.aK = function ()
    {
        if (this == "auto") {
            return 0
        }
        return parseInt(this.replace("px", ""));
    };
    String.prototype.ad = function ()
    {
        var aI = this;
        aI = aI.replace(/\r\n/g, "<br>");
        aI = aI.replace(/\n\r/g, "<br>");
        aI = aI.replace(/\r/g, "<br>");
        aI = aI.replace(/\n/g, "<br>");
        return aI;
    }
})();
(function ()
{
    WR360.by = function () {};
    WR360.by.kf = null;
    WR360.by.kd = function ()
    {
        var Device = {};
        Device.UA = navigator.userAgent;
        Device.Type = false;
        Device.jf = ["iPhone", "iPod", "iPad", "android"];
        for (var d = 0; d < Device.jf.length; d++)
        {
            var t = Device.jf[d];
            Device[t] = !!Device.UA.match(new RegExp(t, "i"));
            Device.Type = Device.Type || Device[t]
        }
        return Device.Type ? true : false;
    };
    WR360.by.iR = WR360.by.kd();
    WR360.by.cz = function (string, defaultValue)
    {
        if (string == null || string.length == 0) {
            return defaultValue
        }
        return string;
    };
    WR360.by.dM = function (string, defaultValue)
    {
        if (string == null || string.length == 0) {
            return defaultValue
        }
        return parseFloat(string);
    };
    WR360.by.je = function (string, defaultValue)
    {
        if (string == null || string.length == 0) {
            return defaultValue
        }
        return parseFloat(string.replace(",", "."));
    };
    WR360.by.bX = function (string, defaultValue)
    {
        if (string == null || string.length == 0) {
            return defaultValue
        }
        return string.toLowerCase() == "true" || string.toLowerCase() == "1";
    };
    WR360.by.oe = function (data)
    {
        var e = /^((http|ftp):\/)?\/?([^:\/\s]+)((\/\w+)*\/)([\w\-\.]+\.[^#?\s]+)(#[\w\-]+)?$/;
        try
        {
            if (data.match(e))
            {
                var fH = 
                {
                    url : RegExp['$&'], protocol : RegExp.$2, host : RegExp.$3, path : RegExp.$4, file : RegExp.$6, 
                    hash : RegExp.$7
                };
                fH.fY = WR360.by.nh(fH.path);
                fH.iH = fH.fY + "/" + fH.file;
                return fH
            }
            else {
                return {
                    url : "", protocol : "", host : "", path : "", file : "", hash : "", fY : "", iH : ""
                }
            }
        }
        catch (ex) {
            return {
                url : "", protocol : "", host : "", path : "", file : "", hash : "", fY : "", iH : ""
            }
        }
    };
    WR360.by.ge = function ()
    {
        var charCode;
        var jd = "";
        var mq = 10 + parseInt(Math.random() * 10);
        for (var i = 0; i < mq; i++) {
            charCode = 97 + parseInt(Math.random() * 26);
            jd += String.fromCharCode(charCode)
        }
        return jd;
    };
    WR360.by.lp = function ()
    {
        if (WR360.by.kf == null)
        {
            WR360.by.kf = false;
            if (jQuery.browser.msie) {
                if (parseInt(jQuery.browser.version.substring(0, 1)) <= 8) {
                    WR360.by.kf = true;
                }
            }
        }
        return WR360.by.kf;
    };
    WR360.by.hL = function ()
    {
        if (jQuery.browser.msie == true) {
            return
        }
        var qk = false;
        var trident = /Trident\/7\./;
        if (trident.test(navigator.userAgent)) {
            qk = true
        }
        if (typeof jQuery.browser !== "undefined" && qk == true)
        {
            jQuery.browser.version = "99";
            jQuery.browser.msie = true;
            jQuery.browser.webkit = false;
            jQuery.browser.mozilla = false;
            jQuery.browser.opera = false;
        }
    };
    WR360.by.mG = function ()
    {
        if (jQuery.browser) {
            WR360.by.hL();
            return
        }
        var matched, browser;
        if (!jQuery.uaMatch)
        {
            jQuery.uaMatch = function (ua)
            {
                ua = ua.toLowerCase();
                var match = /(chrome)[ \/]([\w.]+)/.exec(ua) ||/(webkit)[ \/]([\w.]+)/.exec(ua) ||/(opera)(?:.*version|)[ \/]([\w.]+)/.exec(ua) ||/(msie) ([\w.]+)/.exec(ua) || ua.indexOf("compatible") < 0 &&/(mozilla)(?:.*? rv:([\w.]+)|)/.exec(ua) || [];
                return {
                    browser : match[1] || "", version : match[2] || "0"
                }
            }
        }
        matched = jQuery.uaMatch(navigator.userAgent);
        browser = {};
        if (matched.browser) {
            browser[matched.browser] = true;
            browser.version = matched.version
        }
        if (browser.chrome) {
            browser.webkit = true
        }
        else if (browser.webkit) {
            browser.safari = true
        }
        jQuery.browser = browser;
        WR360.by.hL()
    };
    WR360.by.jS = function (cdata)
    {
        var pattern = /\<(\w+?)\s+?/gim;
        var tagName;
        var gS = WR360.ImageRotator.mv();
        if (gS == null || gS.length == 0) {
            return ""
        }
        var fU = gS.split(",");
        if (fU.length == 0) {
            return ""
        }
        var tags = cdata.match(pattern);
        if (tags == null || tags.length == 0) {
            return ""
        }
        for (var i = 0; i < tags.length; i++)
        {
            if (tags[i].match(pattern))
            {
                tagName = RegExp.$1;
                var iI = false;
                for (var j = 0; j < fU.length; j++) {
                    if (tagName.toLowerCase() == fU[j]) {
                        iI = true;
                        break
                    }
                }
                if (!iI) {
                    return tagName;
                }
            }
        }
        return "";
    };
    WR360.by.nh = function (path)
    {
        var e = /.*?\/(\w+)\/$/;
        if (path.match(e)) {
            return RegExp.$1
        }
        else {
            return "";
        }
    };
    WR360.by.fS = function (e)
    {
        var fw = 0, gI = 0;
        var hU = typeof window.event !== "undefined" && typeof window.event.targetTouches !== "undefined";
        if (!WR360.by.iR && !hU)
        {
            if (e.pageX || e.pageY) {
                fw = e.pageX;
                gI = e.pageY
            }
            else if (e.clientX || e.clientY)
            {
                fw = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
                gI = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
            }
        }
        else
        {
            if (window.event.targetTouches) {
                fw = window.event.targetTouches[0].screenX;
                gI = window.event.targetTouches[0].screenY;
            }
        }
        return {
            x : fw, y : gI
        }
    };
    WR360.by.fA = function (cu, eJ)
    {
        var x = cu.offset().left;
        var y = cu.offset().top;
        var x2 = x + cu.outerWidth(false);
        var y2 = y + cu.outerHeight(false);
        return eJ.x >= x && eJ.x <= x2 && eJ.y >= y && eJ.y <= y2;
    };
    WR360.by.pA = function ()
    {
        var rlocalProtocol = /^(?:about|app|app\-storage|.+\-extension|file|res|widget):$/;
        var rurl = /^([\w\+\.\-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/;
        var ajaxLocation = "";
        try {
            ajaxLocation = location.href
        }
        catch (e)
        {
            ajaxLocation = document.createElement("a");
            ajaxLocation.href = "";
            ajaxLocation = ajaxLocation.href
        }
        var ajaxLocParts = rurl.exec(ajaxLocation.toLowerCase()) || [];
        var qm = rlocalProtocol.test(ajaxLocParts[1]);
        return qm;
    };
    WR360.by.qT = function (options)
    {
        try
        {
            if (!jQuery.browser.msie) {
                return false
            }
            var qW = window.ActiveXObject !== undefined;
            if (qW == false) {
                return false
            }
            if (!WR360.by.pA()) {
                return false
            }
            var xhr = null;
            try {
                xhr = new window.ActiveXObject("Microsoft.XMLHTTP")
            }
            catch (e) {}
            if (xhr == null) {
                return false
            }
            if (!options.async) {
                options.async = jQuery.ajaxSettings.async
            }
            xhr.open(options.type, options.url, options.async);
            var LocalCallback = function ()
            {
                try {
                    var text = xhr.responseText;
                    if (options.success) {
                        options.success(text)
                    }
                }
                catch (e) {
                    if (options.error) {
                        options.error(e)
                    }
                }
            };
            xhr.send(null);
            if (!options.async) {
                LocalCallback()
            }
            else if (xhr.readyState === 4) {
                setTimeout(LocalCallback, 0)
            }
            else {
                xhr.onreadystatechange = LocalCallback
            }
            return true
        }
        catch (e) {
            return false;
        }
    }
})();
(function ()
{
    WR360.J = function ()
    {
        this.dr = new Array;
    };
    WR360.J.prototype.iS = function (item)
    {
        var result =- 1;
        for (var i = 0; i < this.dr.length; i++) {
            if (this.dr[i] == item) {
                result = i;
                break
            }
        }
        return result;
    };
    WR360.J.prototype.bk = function (item)
    {
        var result = false;
        if (item != null) {
            this.dr.push(item);
            result = true
        }
        return result;
    };
    WR360.J.prototype.removeItem = function (item)
    {
        var result = false;
        var hN = this.iS(item);
        if (hN > -1) {
            this.dr.splice(hN, 1);
            result = true
        }
        return result;
    };
    WR360.J.prototype.clear = function ()
    {
        this.dr = new Array;
    };
    WR360.J.prototype.contains = function (item)
    {
        return this.iS(item) > -1;
    };
    WR360.J.prototype.mh = function (index)
    {
        return this.dr[index];
    };
    WR360.J.prototype.ds = function ()
    {
        return this.dr.length;
    };
    WR360.J.prototype.nz = function ()
    {
        return this.dr.length == 0;
    }
})();
(function ()
{
    WR360.gl = function ()
    {
        this.settings = new WR360.kT;
        this.bF = new Array;
        this.hi = new Array;
        this.aw = new Array;
        this.ky = new Array;
        this.aw.ep = 0;
        this.aw.eU = 0;
    };
    WR360.gl.prototype.iq = function ()
    {
        return this.aw.ep > 0 && this.aw.eU > 0;
    };
    WR360.gl.prototype.ly = function ()
    {
        for (var dj = 0; dj < this.bF.length; dj++)
        {
            var cd = this.bF[dj];
            if (cd.disabled == false && cd.dI == false && cd.id != "#logo") {
                return true;
            }
        }
        return false;
    };
    WR360.Control = function ()
    {
        this.gp = 0.12;
        this.ci = 200;
        this.lU = 200;
        this.mu = 100;
        this.dJ = false;
        this.iu = false;
        this.mouseHoverDrag = false;
        this.qc = true;
        this.hideHotspotsOnLoad = false;
        this.hideHotspotsOnZoom = true;
    };
    WR360.Margin = function ()
    {
        this.top = 0;
        this.right = 0;
        this.bottom = 0;
        this.left = 0;
    };
    WR360.Margin.prototype.parse = function (fG)
    {
        if (fG == null || fG.length == 0) {
            return
        }
        var aj = fG.split(",");
        for (var i = 0; i < aj.length; i++)
        {
            switch (i)
            {
                case 0:
                    this.top = WR360.by.dM(aj[i], this.top);
                    break;
                case 1:
                    this.right = WR360.by.dM(aj[i], this.right);
                    break;
                case 2:
                    this.bottom = WR360.by.dM(aj[i], this.bottom);
                    break;
                case 3:
                    this.left = WR360.by.dM(aj[i], this.left);
                    break;
                default:
                    break
            }
        }
    };
    WR360.Align = function ()
    {
        this.vertical = WR360.Align.TOP;
        this.horizontal = WR360.Align.LEFT;
    };
    WR360.Align.TOP =- 1;
    WR360.Align.CENTER = 0;
    WR360.Align.BOTTOM = 1;
    WR360.Align.LEFT =- 1;
    WR360.Align.CENTER = 0;
    WR360.Align.RIGHT = 1;
    WR360.Align.prototype.parse = function (bK)
    {
        if (bK == null || bK.length == 0) {
            return
        }
        var gP = bK.split(",");
        for (var i = 0; i < gP.length; i++)
        {
            switch (i)
            {
                case 0:
                    var verticalAlign = gP[i].toLowerCase().trim();
                    if (verticalAlign == "top" || verticalAlign == "-1") {
                        this.vertical = WR360.Align.TOP
                    }
                    else if (verticalAlign == "center" || verticalAlign == "0") {
                        this.vertical = WR360.Align.CENTER
                    }
                    else if (verticalAlign == "bottom" || verticalAlign == "1") {
                        this.vertical = WR360.Align.BOTTOM
                    }
                    break;
                case 1:
                    var ag = gP[i].toLowerCase().trim();
                    if (ag == "left" || ag == "-1") {
                        this.horizontal = WR360.Align.LEFT
                    }
                    else if (ag == "center" || ag == "0") {
                        this.horizontal = WR360.Align.CENTER
                    }
                    else if (ag == "right" || ag == "1") {
                        this.horizontal = WR360.Align.RIGHT
                    }
                    break;
                default:
                    break
            }
        }
    };
    WR360.ix = function ()
    {
        this.x = 0;
        this.y = 0;
        this.oP = false;
        this.nb = false;
    };
    WR360.ix.prototype.ot = function ()
    {
        return this.oP || this.nb;
    };
    WR360.ix.prototype.parse = function (offsetX, offsetY)
    {
        this.oP = offsetX != null && offsetX.length > 0;
        this.nb = offsetY != null && offsetY.length > 0;
        this.x = WR360.by.dM(offsetX, this.x);
        this.y = WR360.by.dM(offsetY, this.y);
    };
    WR360.kc = function ()
    {
        this.id = "";
        this.type = "";
        this.dI = false;
        this.className = "";
        this.color = "";
        this.alpha = 0;
        this.jN = "spot_circle_plus.png";
        this.disabled = false;
        this.bo = null;
        this.offset = new WR360.ix;
        this.margin = new WR360.Margin;
        this.align = new WR360.Align;
        this.ps = 0;
        this.activateOnClick = false;
    };
    WR360.HotspotInfo = function ()
    {
        this.src = "";
        this.qG = WR360.HotspotInfo.iE.NONE;
        this.qO = "";
        this.clickDataParam = "";
        this.url = "";
        this.eb = "_self";
        this.aI = "";
        this.ga = 242;
        this.gb = "#525B69";
        this.gk = "#FFFFFF";
        this.fO = 14;
        this.cdata = "";
        this.aC = false;
    };
    WR360.HotspotInfo.iE = {};
    WR360.HotspotInfo.iE.NONE = 0;
    WR360.HotspotInfo.iE.qq = 1;
    WR360.HotspotInfo.iE.mA = 2;
    WR360.HotspotInfo.iE.qx = 3;
    WR360.HotspotInfo.iE.sL = 4;
    WR360.HotspotInfo.iE.ss = 5;
    WR360.HotspotInfo.iE.rH = 6;
    WR360.HotspotInfo.iE.qP = 7;
    WR360.HotspotInfo.iE.pB = 8;
    WR360.HotspotInfo.iE.sr = 9;
    WR360.HotspotInfo.iE.sX = 10;
    WR360.lv = function ()
    {
        this.src = "";
        this.label = "";
        this.bF = new Array;
        this.hi = new Array;
        this.cS = null;
    };
    WR360.lq = function ()
    {
        this.source = "";
        this.offsetX = 0;
        this.offsetY = 0;
    };
    WR360.nu = function ()
    {
        this.image = "first";
    };
    WR360.jJ = function ()
    {
        this.fE = 0;
        this.rotate = "false";
        this.kC =- 1;
        this.oc = "false";
        this.gg = 7;
        this.bounce = false;
        this.op =- 1;
        this.pe = false;
        this.useInertia = true;
        this.inertiaRelToDragSpeed = true;
        this.inertiaTimeToStop = 700;
        this.inertiaMaxInterval = 120;
    };
    WR360.kT = function ()
    {
        this.eH = new WR360.nu;
        this.bI = new WR360.jH;
        this.control = new WR360.Control;
        this.bg = new WR360.jJ;
    };
    WR360.jH = function ()
    {
        this.hb = true;
        this.gj = true;
        this.gw = true;
        this.iT = true;
        this.hY = true;
        this.bY = true;
        this.iU = true;
        this.bz = true;
        this.gx = 0;
        this.kK = "";
        this.lh = "";
        this.gH = "#ffffff";
        this.iC = 0.9;
        this.gX = 0.9;
        this.gC = "#949494";
        this.hW = "";
        this.fullScreenBackColor = "#ffffff";
        this.showFullScreenToolbar = false;
    };
    WR360.kB = function ()
    {
        this.src = "";
    }
})();
(function ()
{
    WR360.dh = function ()
    {
        this.dw = {}
    };
    WR360.dh.prototype = 
    {
        constructor : WR360.dh,
        oK : function ()
        {
            return null;
        },
        addEventListener : function (type, cc, param)
        {
            if (typeof this.dw[type] == "undefined") {
                this.dw[type] = []
            }
            this.dw[type].push({
                cc : cc, param : param
            })
        },
        dispatchEvent : function (event)
        {
            if (typeof event == "string") {
                event = {
                    type : event
                }
            }
            if (!event.target) {
                event.target = this
            }
            if (!event.type) {
                throw new Error("Event object missing 'type' property.");
            }
            if (this.dw[event.type]instanceof Array)
            {
                var cs = this.dw[event.type];
                for (var i = 0, ia = cs.length; i < ia; i++) {
                    cs[i].cc.call(this, event, cs[i].param)
                }
            }
        },
        removeEventListener : function (type, cc)
        {
            if (this.dw[type]instanceof Array)
            {
                var cs = this.dw[type];
                for (var i = 0, ia = cs.length; i < ia; i++) {
                    if (cs[i].cc === cc) {
                        cs.splice(i, 1);
                        break
                    }
                }
            }
        }
    };
    WR360.Event = function (type, bubbles, cancelable)
    {
        this.type = type;
        this.bubbles = bubbles;
        this.cancelable = cancelable;
    }
})();
(function ()
{
    WR360.dY = function ()
    {
        this.aB().constructor.call(this);
        this.cQ = false;
        this.rootPath = "";
        this.gE = false;
    };
    WR360.dY.bE(WR360.dh);
    WR360.dY.prototype.Init = function (rootPath, V)
    {
        this.rootPath = rootPath;
        this.cQ = false;
    };
    WR360.dY.prototype.bO = function ()
    {
        if (this.cQ == true) {
            return
        }
        this.gE = true;
    }
})();
(function ()
{
    WR360.ba = function (image, index, rootPath, graphicsPath, oq)
    {
        this.aB().constructor.call(this);
        if (image == null) {
            throw new Error("ImageObject.ctor. null == hotspot");
        }
        this.image = image;
        this.F = new Image;
        this.bG = null;
        this.index = index;
        this.rootPath = rootPath;
        this.graphicsPath = graphicsPath;
        this.oq = oq;
        this.F.be = this;
        this.F.onload = this.gm;
        this.F.onerror = this.gc;
        this.aA();
        WR360.ba.lg++;
        this.pi = WR360.ba.lg;
    };
    WR360.ba.bE(WR360.dh);
    WR360.ba.lg = 0;
    WR360.ba.iK = "pixel.png";
    WR360.ba.prototype.aA = function ()
    {
        this.bG = new Image;
        this.bG.be = this;
        this.bG.cQ = false;
        this.bG.onload = this.lQ;
        this.bG.onerror = this.lL;
        this.bG.onabort = this.lG;
    };
    WR360.ba.prototype.gm = function ()
    {
        var bu = this.be;
        bu.dispatchEvent(new WR360.ah(WR360.ah.COMPLETE, true, false, bu, false, bu.index, true, ""))
    };
    WR360.ba.prototype.gc = function ()
    {
        var bu = this.be;
        bu.dispatchEvent(new WR360.ah(WR360.ah.ERROR, true, false, bu, false, bu.index, false, "Error loading image: " + this.src))
    };
    WR360.ba.prototype.lQ = function ()
    {
        var bu = this.be;
        if (bu.hx(this)) {
            return
        }
        this.cQ = true;
        bu.dispatchEvent(new WR360.ah(WR360.ah.eD, true, false, bu, true, bu.index, true, ""))
    };
    WR360.ba.prototype.lL = function ()
    {
        var bu = this.be;
        if (bu.hx(this)) {
            return
        }
        bu.dispatchEvent(new WR360.ah(WR360.ah.dU, true, false, bu, true, bu.index, false, "Error loading high-res image: " + this.src))
    };
    WR360.ba.prototype.lG = function ()
    {
        var bu = this.be;
        if (bu.hx(this)) {
            return
        }
        bu.dispatchEvent(new WR360.ah(WR360.ah.fD, true, false, bu, true, bu.index, false, "Abort loading high-res image: " + this.src))
    };
    WR360.ba.prototype.hx = function (image)
    {
        return image.src.indexOf(WR360.ba.iK) !=- 1;
    };
    WR360.ba.prototype.Load = function ()
    {
        var qv = this.oq ? this.image.cS.src : this.image.src;
        this.F.src = this.rootPath + qv;
    };
    WR360.ba.prototype.hS = function ()
    {
        if (this.bG == null) {
            this.aA()
        }
        this.bG.src = this.rootPath + this.image.cS.src;
    };
    WR360.ba.prototype.aE = function ()
    {
        if (this.bG == null) {
            return
        }
        this.hK()
    };
    WR360.ba.prototype.hK = function ()
    {
        if (this.bG == null) {
            throw new Error("forceUnloadHighRes: highresBitmapLoader==null");
        }
        this.bG.cQ = false;
        this.bG.src = this.graphicsPath + "/" + WR360.ba.iK;
    };
    WR360.ba.prototype.kz = function ()
    {
        if (this.bG == null) {
            return
        }
        if (this.bG.cQ == false) {
            return
        }
        else {
            this.hK()
        }
    };
    WR360.ah = function (type, bubbles, cancelable, af, ht, index, success, errorMessage)
    {
        this.aB().constructor.call(this, type, bubbles, cancelable);
        this.af = af;
        this.ht = ht;
        this.index = index;
        this.success = success;
        this.errorMessage = errorMessage;
    };
    WR360.ah.bE(WR360.Event);
    WR360.ah.COMPLETE = "ImageObject_complete";
    WR360.ah.ERROR = "ImageObject_error";
    WR360.ah.eD = "ImageObject_Highres_complete";
    WR360.ah.fD = "ImageObject_Highres_abort";
    WR360.ah.dU = "ImageObject_Highres_error";
})();
(function ()
{
    WR360.fC = function (bi, index, rootPath)
    {
        this.aB().constructor.call(this);
        if (bi == null) {
            throw new Error("HotspotObject.ctor. null == hotspot");
        }
        this.bi = bi;
        this.index = index;
        this.F = new Image;
        this.rootPath = rootPath;
        this.F.be = this;
        this.F.onload = this.gm;
        this.F.onerror = this.gc;
    };
    WR360.fC.bE(WR360.dh);
    WR360.fC.prototype.gm = function ()
    {
        var bu = this.be;
        bu.dispatchEvent(new WR360.da(WR360.da.COMPLETE, true, false, bu, bu.index, true, ""))
    };
    WR360.fC.prototype.gc = function ()
    {
        var bu = this.be;
        bu.dispatchEvent(new WR360.da(WR360.da.ERROR, true, false, bu, bu.index, false, "Error loading image: " + this.src))
    };
    WR360.fC.prototype.Load = function ()
    {
        this.F.src = this.rootPath + this.bi.bo.src;
    };
    WR360.da = function (type, bubbles, cancelable, aO, index, success, errorMessage)
    {
        this.aB().constructor.call(this, type, bubbles, cancelable);
        this.aO = aO;
        this.index = index;
        this.success = success;
        this.errorMessage = errorMessage;
    };
    WR360.da.bE(WR360.Event);
    WR360.da.COMPLETE = "HotspotObject_complete";
    WR360.da.ERROR = "HotspotObject_error";
})();
(function ()
{
    WR360.cL = function (bh)
    {
        this.aB().constructor.call(this);
        if (bh == null) {
            throw new Error("ImagePreloader: imageRotator is null");
        }
        this.image = null;
        this.bh = bh;
    };
    WR360.cL.bE(WR360.dY);
    WR360.cL.le = "first";
    WR360.cL.la = "none";
    WR360.cL.prototype.Load = function (rootPath, V)
    {
        this.ct.Init.call(this, rootPath, V);
        var hh = V.settings.eH.image;
        var av = typeof this.bh.qQ !== "undefined" && this.bh.qQ();
        var qI = this.bh.settings.fullScreenOnClick;
        if (!av)
        {
            if (this.bh.dV == true && this.bh.reloadImageIndex >= 0) {
                var bW = this.bh.reloadImageIndex;
                if (bW > V.aw.length - 1) {
                    bW = 0
                }
                hh = V.aw[bW].src
            }
            else if (V.settings.eH.image.length == 0 || V.settings.eH.image.toLowerCase() == WR360.cL.la) {
                this.dispatchEvent(new WR360.cO(WR360.cO.COMPLETE, true, false, null, true, ""));
                return
            }
        }
        else
        {
            if (V.aw.length == 0) {
                this.dispatchEvent(new WR360.cO(WR360.cO.COMPLETE, true, false, null, true, ""));
                return
            }
            var aF = qI == true ? V.settings.bg.fE : this.bh.pH.bV.ob();
            if (aF < 0 || aF > V.aw.length - 1) {
                aF = 0
            }
            hh = V.aw[aF].src;
            var oq = av && V.settings.control.qc && this.bh.bV.lc;
            if (oq) {
                hh = V.aw[aF].cS != null ? V.aw[aF].cS.src : V.aw[aF].src;
            }
        }
        this.image = new Image;
        this.image.be = this;
        this.image.onload = this.os;
        this.image.onerror = this.mj;
        this.image.src = this.rootPath + hh;
    };
    WR360.cL.prototype.os = function ()
    {
        this.be.dispatchEvent(new WR360.cO(WR360.cO.COMPLETE, true, false, this.be.image, true, ""))
    };
    WR360.cL.prototype.mj = function ()
    {
        this.be.dispatchEvent(new WR360.cO(WR360.cO.ERROR, true, false, null, false, "Preloader IO ERROR: " + this.src))
    };
    WR360.cO = function (type, bubbles, cancelable, image, success, errorMessage)
    {
        this.aB().constructor.call(this, type, bubbles, cancelable);
        this.image = image;
        this.success = success;
        this.errorMessage = errorMessage;
    };
    WR360.cO.bE(WR360.Event);
    WR360.cO.COMPLETE = "complete";
    WR360.cO.ERROR = "error";
})();
(function ()
{
    WR360.dP = function ()
    {
        this.aB().constructor.call(this);
        this.aw = new Array;
        this.cG = 0;
    };
    WR360.dP.bE(WR360.dY);
    WR360.dP.prototype.jq = function ()
    {
        return this.aw.length;
    };
    WR360.dP.prototype.Init = function (rootPath, graphicsPath, V, oq)
    {
        this.ct.Init.call(this, rootPath, V);
        this.ln(rootPath, graphicsPath, V, oq)
    };
    WR360.dP.prototype.ln = function (rootPath, graphicsPath, V, oq)
    {
        for (var i = 0; i < V.aw.length; i++) {
            this.aw[i] = new WR360.ba(V.aw[i], i, rootPath, graphicsPath, oq);
        }
    };
    WR360.dP.prototype.kE = function ()
    {
        this.cG = 0;
        for (var i = 0; i < this.aw.length; i++)
        {
            var af = this.aw[i];
            af.be = this;
            af.addEventListener(WR360.ah.COMPLETE, this.nU);
            af.addEventListener(WR360.ah.ERROR, this.ou);
            af.Load()
        }
    };
    WR360.dP.prototype.oB = function (index)
    {
        var af = aw[index];
        af.be = this;
        af.hS()
    };
    WR360.dP.prototype.oW = function (jM)
    {
        for (var i = 0; i < this.aw.length; i++) {
            if (i == jM) {
                continue
            }
            this.aw[i].kz()
        }
    };
    WR360.dP.prototype.bf = function ()
    {
        if (this.gE == true)
        {
            this.cQ = true;
            this.dispatchEvent(new WR360.cf(WR360.cf.bJ, true, false, null, Math.round(this.cG * 100 / this.aw.length), 
            false, ""));
            return true
        }
        return false;
    };
    WR360.dP.prototype.nU = function (e)
    {
        this.be.kA(e)
    };
    WR360.dP.prototype.kA = function (e)
    {
        if (this.bf() == true) {
            return
        }
        if (e.ht) {
            return
        }
        this.cG++;
        var eR = WR360.cf.PROGRESS;
        if (this.cG >= this.aw.length) {
            eR = WR360.cf.COMPLETE;
            this.cQ = true
        }
        this.dispatchEvent(new WR360.cf(eR, true, false, e.af, Math.round(this.cG * 100 / this.aw.length), 
        true, ""));
    };
    WR360.dP.prototype.ou = function (e)
    {
        var bu = this.be;
        bu.dispatchEvent(new WR360.cf(WR360.cf.ERROR, true, false, e.af, Math.round(bu.cG * 100 / bu.aw.length), 
        false, e.errorMessage))
    };
    WR360.cf = function (type, bubbles, cancelable, af, ee, success, errorMessage)
    {
        this.aB().constructor.call(this, type, bubbles, cancelable);
        this.af = af;
        this.ee = ee;
        this.errorMessage = errorMessage;
        this.success = success;
    };
    WR360.cf.bE(WR360.Event);
    WR360.cf.PROGRESS = "ImagesCache_progress";
    WR360.cf.COMPLETE = "ImagesCache_complete";
    WR360.cf.ERROR = "ImagesCache_error";
    WR360.cf.bJ = "ImagesCache_canceled";
})();
(function ()
{
    WR360.dc = function ()
    {
        this.aB().constructor.call(this);
        this.dH = 0;
        this.bF = new Array;
        this.hu =- 1
    };
    WR360.dc.bE(WR360.dY);
    WR360.dc.pg = "TEXT_HOTSPOT";
    WR360.dc.prototype.Init = function (rootPath, V)
    {
        this.ct.Init.call(this, rootPath, V);
        this.ku(rootPath, V)
    };
    WR360.dc.prototype.ku = function (rootPath, V)
    {
        var eW = 0;
        for (var i = 0; i < V.bF.length; i++)
        {
            if (!V.bF[i].disabled)
            {
                if (this.hu ==- 1) {
                    this.bF[eW] = new WR360.fC(V.bF[i], eW, rootPath)
                }
                else if (eW < this.hu) {
                    this.bF[eW] = new WR360.fC(V.bF[i], eW, rootPath)
                }
                eW++;
            }
        }
    };
    WR360.dc.prototype.kD = function ()
    {
        this.dH = 0;
        for (var i = 0; i < this.bF.length; i++)
        {
            var aO = this.bF[i];
            if (aO.bi.bo.src.length > 0)
            {
                aO.be = this;
                aO.addEventListener(WR360.da.COMPLETE, this.mN);
                aO.addEventListener(WR360.da.ERROR, this.og);
                aO.Load()
            }
            else {
                this.kq(new WR360.da(WR360.da.COMPLETE, true, false, aO, aO.index, true, ""))
            }
        }
    };
    WR360.dc.prototype.bf = function ()
    {
        if (this.gE == true)
        {
            this.cQ = true;
            this.dispatchEvent(new WR360.dK(WR360.dK.bJ, true, false, null, Math.round(this.dH * 100 / this.bF.length), 
            false, ""));
            return true
        }
        return false;
    };
    WR360.dc.prototype.mN = function (e)
    {
        this.be.kq(e)
    };
    WR360.dc.prototype.kq = function (e)
    {
        if (this.bf() == true) {
            return
        }
        this.dH++;
        var eR = WR360.dK.PROGRESS;
        if (this.dH >= this.bF.length) {
            eR = WR360.dK.COMPLETE;
            this.cQ = true
        }
        this.dispatchEvent(new WR360.dK(eR, true, false, e.aO, Math.round(this.dH * 100 / this.bF.length), 
        true, ""));
    };
    WR360.dc.prototype.og = function (e)
    {
        var bu = this.be;
        bu.dispatchEvent(new WR360.dK(WR360.dK.ERROR, true, false, e.aO, Math.round(bu.dH * 100 / bu.bF.length), 
        false, e.errorMessage))
    };
    WR360.dK = function (type, bubbles, cancelable, aO, ee, success, errorMessage)
    {
        this.aB().constructor.call(this, type, bubbles, cancelable);
        this.aO = aO;
        this.ee = ee;
        this.errorMessage = errorMessage;
        this.success = success;
    };
    WR360.dK.bE(WR360.Event);
    WR360.dK.PROGRESS = "HotspotsCache_progress";
    WR360.dK.COMPLETE = "HotspotsCache_complete";
    WR360.dK.ERROR = "HotspotsCache_error";
    WR360.dK.bJ = "HotspotsCache_canceled";
})();
(function ()
{
    WR360.cI = function (visible, aO, bV, bh, H)
    {
        this.df = visible;
        this.dz = 0;
        this.dg = 0;
        this.aO = aO;
        this.bV = bV;
        this.playing = false;
        this.bh = bh;
        this.H = H;
        this.bb = null;
        this.cb = this.bh.gK(this.aO.bi);
        this.H.append("<div class='wr360hotspot_" + this.bh.oY + "' id='" + this.cb + "'/>");
        this.bb = jQuery("#" + this.cb);
        this.aH(visible);
        this.bb.css("position", "absolute")
    };
    WR360.cI.prototype.cD = function (visible)
    {
        this.fR()
    };
    WR360.cI.prototype.jE = function (visible)
    {
        if (this.bH) {
            this.bH.cN(false)
        }
    };
    WR360.cI.prototype.aH = function (visible)
    {
        if (this.bb == null) {
            throw new Error("SetVisible: hotspotElement==null.");
        }
        this.df = visible;
        if (visible) {
            this.bb.show()
        }
        else {
            this.bb.hide()
        }
    };
    WR360.cI.prototype.eC = function (x)
    {
        this.dz = x;
    };
    WR360.cI.prototype.fv = function (y)
    {
        this.dg = y;
    };
    WR360.cI.prototype.mc = function ()
    {
        return this.dz;
    };
    WR360.cI.prototype.mB = function ()
    {
        return this.dg;
    };
    WR360.cI.prototype.nT = function ()
    {
        if (this.bH != null)
        {
            var aM = this.bV.oy(this.aO, this.bH.qh, this.bH.qw);
            this.dz = aM.x;
            this.dg = aM.y;
            this.bH.dv.Css("left", this.dz);
            this.bH.dv.Css("top", this.dg);
            if (this.aO.F.src.length > 0)
            {
                var aq = this.bH.aN.find("img");
                aq.css("width", this.aO.F.width * this.bV.lB);
                aq.css("height", this.aO.F.height * this.bV.lB)
            }
        }
    };
    WR360.cI.prototype.fR = function ()
    {
        if (this.bH == null)
        {
            this.bH = new WR360.bx(this.bV, WR360.hI.lD(), true, this.H, this.cb);
            this.bH.iZ(this.aO);
            this.bH.jB(this);
            this.bH.jw(this.gV())
        }
    };
    WR360.cI.prototype.gV = function ()
    {
        return {
            x : this.dz, y : this.dg
        }
    }
})();
(function ()
{
    WR360.aT = function (visible, aO, bV, bh, H)
    {
        this.df = visible;
        this.dz = 0;
        this.dg = 0;
        this.aO = aO;
        this.bV = bV;
        this.playing = false;
        this.bh = bh;
        this.H = H;
        this.bb = null;
        this.cb = "";
        this.kN = bh.settings.graphicsPath + "/" + this.aO.bi.jN;
        this.image = new Image;
        this.bH = null;
        this.fc = false;
        this.jx = 0;
        this.gB = 0;
        this.bh.addEventListener(WR360.Events.hG, jQuery.proxy(this.mC, this));
        this.image.onload = jQuery.proxy(this.nK, this);
        this.image.onerror = jQuery.proxy(this.nY, this);
        this.cb = this.bh.gK(this.aO.bi);
        this.H.append("<div class='hotspot_indicator wr360hotspot_" + this.bh.oY + "' id='" + this.cb + "'/>");
        this.bb = jQuery("#" + this.cb);
        this.aH(visible);
        this.bb.css("position", "absolute");
        if (this.aO.bi.activateOnClick == false) {
            this.bb.mouseover(jQuery.proxy(function (event)
            {
                this.OnMouseOver(event)
            }, this))
        }
        else {
            this.bb.click(jQuery.proxy(function (event)
            {
                this.OnMouseOver(event)
            }, this))
        }
        this.bb.mouseout(jQuery.proxy(function (event)
        {
            this.OnMouseOut(event)
        }, this));
        this.bb.bind("touchstart", jQuery.proxy(function (event)
        {
            this.pn(event)
        }, this));
        this.image.src = this.kN;
    };
    WR360.aT.prototype.nK = function (e)
    {
        this.eC(this.dz);
        this.fv(this.dg);
        var image;
        if (WR360.by.lp()) {
            image = this.image
        }
        else {
            image = e.target
        }
        this.bb.css("background-image", "url(" + image.src + ")");
        this.bb.css("width", image.width);
        this.bb.css("height", image.height)
    };
    WR360.aT.prototype.nY = function (e)
    {
        WR360.bZ.gA("DynamicHotspotPresenter. Error loading image: " + e.target.src)
    };
    WR360.aT.prototype.cD = function ()
    {
        var au = 800;
        var ll = this.aO.index;
        var bu = this;
        this.jx = setTimeout(function ()
        {
            bu.lf()
        },
        ll * au)
    };
    WR360.aT.prototype.jE = function ()
    {
        if (this.bH) {
            this.bH.cN(false)
        }
    };
    WR360.aT.prototype.aH = function (visible, aX)
    {
        if (this.bb == null) {
            throw new Error("SetVisible: hotspotElement==null.");
        }
        this.df = visible;
        if (visible) {
            if (aX && !WR360.by.lp()) {
                this.bb.fadeIn(300)
            }
            else {
                this.bb.show()
            }
        }
        else {
            if (aX && !WR360.by.lp()) {
                this.bb.fadeOut(300)
            }
            else {
                this.bb.hide()
            }
        }
    };
    WR360.aT.prototype.eC = function (x)
    {
        this.dz = x;
        this.bb.css("left", x - this.image.width / 2)
    };
    WR360.aT.prototype.fv = function (y)
    {
        this.dg = y;
        this.bb.css("top", y - this.image.height / 2)
    };
    WR360.aT.prototype.mc = function ()
    {
        return this.dz;
    };
    WR360.aT.prototype.lX = function ()
    {
        return this.image.width;
    };
    WR360.aT.prototype.lT = function ()
    {
        return this.image.height;
    };
    WR360.aT.prototype.mB = function ()
    {
        return this.dg;
    };
    WR360.aT.prototype.mE = function ()
    {
        return this.image.width;
    };
    WR360.aT.prototype.mr = function ()
    {
        return this.image.height;
    };
    WR360.aT.prototype.mx = function () {};
    WR360.aT.prototype.nl = function () {};
    WR360.aT.prototype.mQ = function () {};
    WR360.aT.prototype.jY = function (e)
    {
        if (this.playing == true)
        {
            this.playing = false;
            var cV = {
                x : this.bh.dO, y : this.bh.ei
            };
            if (WR360.by.fA(this.bb, cV) == true) {
                this.fc = true;
                var bu = this;
                this.gB = setInterval(function ()
                {
                    bu.mb()
                }, 200)
            }
            this.nl()
        }
    };
    WR360.aT.prototype.mC = function (e)
    {
        if (this.bH) {
            this.bH.cN(false)
        }
    };
    WR360.aT.prototype.OnMouseOut = function (e)
    {
        e.stopPropagation();
        this.fc = false;
    };
    WR360.aT.prototype.OnMouseOver = function (e)
    {
        e.stopPropagation();
        if (this.bh.fu == true) {
            return
        }
        if (this.playing == true) {
            return
        }
        if (this.fc == true) {
            return
        }
        this.mQ();
        if (this.aO == null) {
            throw new Error("ERROR: Cannot read HotspotObject from " + this.toString());
        }
        if (!this.bh.fu) {
            this.fR()
        }
    };
    WR360.aT.prototype.pn = function (e)
    {
        e.stopPropagation();
        this.OnMouseOver(e)
    };
    WR360.aT.prototype.nT = function ()
    {
        if (this.aO.bi.ps == 1 && this.bH != null)
        {
            var aM = this.bV.oy(this.aO, this.bH.qh, this.bH.qw);
            this.dz = aM.x;
            this.dg = aM.y;
            this.bH.dv.Css("left", this.dz);
            this.bH.dv.Css("top", this.dg);
            if (this.aO.F.src.length > 0)
            {
                var aq = this.bH.aN.find("img");
                aq.css("width", this.aO.F.width * this.bV.lB);
                aq.css("height", this.aO.F.height * this.bV.lB)
            }
        }
    };
    WR360.aT.prototype.fR = function ()
    {
        this.playing = true;
        this.bh.dispatchEvent(new WR360.Event(WR360.Events.hG, false, false));
        this.bh.cJ();
        if (this.bH == null)
        {
            var gv = false;
            if (this.aO.bi.ps == 1) {
                gv = true
            }
            this.bH = new WR360.bx(this.bV, this.bh.cF, gv, this.H, this.cb);
            this.bH.iZ(this.aO);
            this.bH.addEventListener(WR360.bx.ii, jQuery.proxy(this.jY, this));
            this.bH.jB(this);
            this.bH.jw(this.gV())
        }
        else {
            this.bH.jl(this.gV())
        }
    };
    WR360.aT.prototype.gV = function ()
    {
        return {
            x : this.dz, y : this.dg
        }
    };
    WR360.aT.prototype.mb = function ()
    {
        var cV = {
            x : this.bh.dO, y : this.bh.ei
        };
        if (WR360.by.fA(this.bb, cV) == false) {
            this.fc = false;
            clearInterval(this.gB);
            this.gB = 0;
        }
    };
    WR360.aT.prototype.lf = function ()
    {
        this.jx = 0;
        this.mx()
    };
    WR360.aT.prototype.fZ = function ()
    {
        return this.bb;
    }
})();
(function ()
{
    WR360.bx = function (bV, cF, cv, H, cb)
    {
        this.aB().constructor.call(this);
        this.bV = bV;
        this.cF = cF;
        this.cv = cv;
        this.H = H;
        this.cb = cb;
        this.ig = WR360.by.ge();
        this.jj = false;
        this.ca = false;
        this.hn = false;
        this.qG = "";
        this.qO = "";
        this.url = "";
        this.eb = "";
        this.ao = null;
        this.bq = null;
        this.aN = null;
        this.am = null;
        this.dW = null;
        this.eV = null;
        this.hf = 0;
        this.dR = 0;
        this.bv = 0;
        this.bs = 0;
        this.gL = 0;
        this.kh = 15;
        this.io = false;
        this.ps = 0;
        this.qh = 0;
        this.qw = 0;
        this.aO = null;
        this.H.append("<div class='hotspot_rollover wr360rollover_" + this.bV.bh.oY + "' id='" + this.ig + "'/>");
        this.ao = jQuery("#" + this.ig);
        this.dv = new WR360.ef(this);
        this.dv.aH(false);
        this.ao.css("position", "absolute");
        if (this.cv) {
            this.ao.css("left", 0);
            this.ao.css("top", 0)
        }
    };
    WR360.bx.bE(WR360.dh);
    WR360.bx.ii = "ROLLOVER_OUT_EVENT";
    WR360.ef = function (ab)
    {
        this.ab = ab;
        this.df = true;
    };
    WR360.ef.prototype.Bind = function (cg, kr)
    {
        var cu = this.ab.ca ? this.ab.bq : this.ab.aN;
        cu.bind(cg, kr)
    };
    WR360.ef.prototype.iY = function ()
    {
        return this.ab.ca ? this.ab.bq : this.ab.aN;
    };
    WR360.ef.prototype.Css = function (nc, value)
    {
        var cu = this.ab.ca ? this.ab.bq : this.ab.aN;
        cu.css(nc, value)
    };
    WR360.ef.prototype.aH = function (visible)
    {
        if (this.df == visible) {
            return
        }
        if (visible) {
            this.ab.ao.show()
        }
        else {
            this.ab.ao.hide()
        }
        this.df = visible;
    };
    WR360.ef.prototype.hC = function (visible, duration, hZ)
    {
        if (this.df == visible) {
            return
        }
        if (visible) {
            if (!WR360.by.lp()) {
                this.ab.ao.fadeIn(duration, hZ)
            }
            else {
                this.ab.ao.show();
                hZ()
            }
        }
        else {
            if (!WR360.by.lp()) {
                this.ab.ao.fadeOut(duration, hZ)
            }
            else {
                this.ab.ao.hide();
                hZ()
            }
        }
        this.df = visible;
    };
    WR360.ef.prototype.dX = function ()
    {
        return this.df;
    };
    WR360.bx.prototype.iZ = function (aO)
    {
        this.aO = aO;
        this.ps = aO.bi.ps;
        if (this.jj == false)
        {
            var cE = null;
            if (aO.bi.bo.cdata.length != 0)
            {
                this.hn = true;
                var ea = WR360.by.ge();
                this.ao.append("<div id='" + ea + "'/>");
                this.aN = jQuery("#" + ea);
                this.aN.css("position", "relative");
                if (aO.bi.bo.aC == true)
                {
                    this.aN.css("font-family", "Arial");
                    this.aN.css("color", "#FF0000");
                    this.aN.css("background-color", "#FFFF00");
                    this.aN.css("font-size", "14px")
                }
                this.aN.append(aO.bi.bo.cdata);
                cE = this.aN;
                this.aN.find("a").mousedown(jQuery.proxy(function (event)
                {
                    this.nA(event)
                }, this))
            }
            else
            {
                if (aO.F.src.length > 0)
                {
                    this.hn = true;
                    var ea = WR360.by.ge();
                    this.ao.append("<div id='" + ea + "'/>");
                    this.aN = jQuery("#" + ea);
                    this.aN.css("position", "relative");
                    this.aN.append("<img src='" + aO.F.src + "'/>");
                    this.ao.css("width", aO.F.width);
                    this.ao.css("height", aO.F.height);
                    cE = this.aN;
                    if (this.cv == true)
                    {
                        var aq = this.aN.find("img");
                        aq.css("width", aO.F.width * this.bV.lB);
                        aq.css("height", aO.F.height * this.bV.lB)
                    }
                }
                if (!this.cv || this.aN == null)
                {
                    if (aO.bi.bo.aI.length != 0)
                    {
                        var ib = WR360.by.ge();
                        this.ao.append("<div id='" + ib + "'/>");
                        this.bq = jQuery("#" + ib);
                        this.bq.css("position", "relative");
                        this.bq.css("z-index", 10002);
                        this.bq.css("font-family", "Arial");
                        this.bq.css("width", aO.bi.bo.ga + "px");
                        this.bq.css("color", aO.bi.bo.gb);
                        this.bq.css("background-color", aO.bi.bo.gk);
                        this.bq.css("font-size", aO.bi.bo.fO + "px");
                        this.bq.css("border", "1px #eeeeee solid");
                        this.bq.css("padding", "6px 8px 10px 8px");
                        this.bq.html(aO.bi.bo.aI.ad());
                        if (!cE) {
                            this.ca = true;
                            cE = this.bq
                        }
                        else{}
                    }
                }
            }
            if (cE == null) {
                return
            }
            if (this.cv == false)
            {
                cE.css("left", - (this.ao.css("width").aK() / 2));
                cE.css("top", - (this.ao.css("height").aK() / 2))
            }
            else
            {
                this.qh = this.ao.outerWidth();
                this.qw = this.ao.outerHeight();
                var aM = this.bV.oy(aO, this.qh, this.qw);
                cE.css("left", aM.x);
                cE.css("top", aM.y)
            }
            this.jj = true;
            if (aO.bi.bo.qG != WR360.HotspotInfo.iE.NONE || aO.bi.bo.url.length != 0)
            {
                this.qG = aO.bi.bo.qG;
                this.qO = aO.bi.bo.qO;
                this.url = aO.bi.bo.url;
                this.eb = aO.bi.bo.eb;
                this.dv.Css("cursor", "pointer")
            }
            this.dv.aH(false)
        }
    };
    WR360.bx.prototype.jB = function (cd)
    {
        this.dW = cd;
    };
    WR360.bx.prototype.jw = function (cU)
    {
        this.eV = cU;
        this.hf = this.ao.css("width").aK() / 2;
        this.dR = this.ao.css("height").aK() / 2;
        this.bv = this.ao.css("width").aK() / 5;
        this.bs = this.ao.css("height").aK() / 4;
        if (this.ps == 2 || this.cv == true) {
            this.hf = 1;
            this.dR = 1;
            this.ao.css("width", 1);
            this.ao.css("height", 1)
        }
        this.jl(this.eV)
    };
    WR360.bx.prototype.qp = function ()
    {
        if (!this.dv.dX()) {
            return
        }
        var cV = {
            x : this.bV.bh.dO, y : this.bV.bh.ei
        };
        if (WR360.by.fA(this.dW.fZ(), cV) == false) {
            var cu = this.ca ? this.bq : this.aN;
            if (WR360.by.fA(cu, cV) == false) {
                this.cN(true)
            }
        }
    };
    WR360.bx.prototype.kG = function (pl)
    {
        if (!this.cv || this.ps == 1) {
            this.qp()
        }
    };
    WR360.bx.prototype.ld = function (e)
    {
        e.stopPropagation();
        if (!this.cv || this.ps == 1) {
            this.cN(true)
        }
    };
    WR360.bx.prototype.lm = function (e)
    {
        e.stopPropagation();
        var pU = this.oi(e);
        if ((!this.cv || this.ps == 1) && !pU) {
            this.cN(true)
        }
    };
    WR360.bx.prototype.nA = function (e)
    {
        e.stopPropagation()
    };
    WR360.bx.prototype.oi = function (e)
    {
        if (this.qG == WR360.HotspotInfo.iE.NONE && this.url.length > 0)
        {
            var re = this.url.substr(this.url.lastIndexOf(".") + 1);
            if (re && re.length > 0 && re.toLowerCase() == "xml") {
                this.bV.bh.reload(this.url, this.bV.bh.settings.rootPath)
            }
            else {
                window.open(this.url, this.eb)
            }
            return true
        }
        switch (this.qG)
        {
            case WR360.HotspotInfo.iE.sX:
                if (this.bV.bh.pY == true) {
                    this.bV.bh.mp()
                }
                else {
                    this.bV.bh.mR()
                }
                break;
            case WR360.HotspotInfo.iE.qq:
                this.bV.bh.mp();
                this.bV.bh.mR();
                break;
            case WR360.HotspotInfo.iE.mA:
                this.bV.bh.mp();
                break;
            case WR360.HotspotInfo.iE.qx:
                this.bV.bh.mp();
                this.bV.iG(1);
                break;
            case WR360.HotspotInfo.iE.sL:
                this.bV.bh.mp();
                this.bV.iG(-1);
                break;
            case WR360.HotspotInfo.iE.ss:
                this.bV.qB(this.aO.bi.bo.qO, this.aO.bi.bo.clickDataParam);
                break;
            case WR360.HotspotInfo.iE.rH:
                this.bV.bh.mp();
                this.bV.qo(this.aO.bi.bo.qO);
                break;
            case WR360.HotspotInfo.iE.qP:
                this.bV.bh.mf();
                break;
            case WR360.HotspotInfo.iE.pB:
                this.bV.bh.mt();
                break;
            case WR360.HotspotInfo.iE.sr:
                this.bV.bh.rc(null);
                break;
            default:
        }
        return false;
    };
    WR360.bx.prototype.mi = function (it)
    {
        var bP = 10;
        var fI = this.hf + bP;
        var hv = 0;
        if (it + fI >= this.H.css("width").aK()) {
            return this.H.css("width").aK() - fI
        }
        else if (it - fI <= 0) {
            return fI
        }
        return it;
    };
    WR360.bx.prototype.lF = function (gR)
    {
        var bP = 5;
        var jv = 0;
        var iL = this.dR + jv + this.kh + bP;
        if (gR + iL >= this.H.css("height").aK()) {
            return this.H.css("height").aK() - iL
        }
        else if (gR - this.dR + bP <= 0) {
            return this.dR + bP
        }
        return gR;
    };
    WR360.bx.prototype.jl = function (cU)
    {
        this.unbindRolloverEvents();
        if (this.dv.dX()) {
            return
        }
        this.eV = cU;
        if (this.cv == false) {
            this.ao.css("left", this.mi(this.eV.x));
            this.ao.css("top", this.lF(this.eV.y))
        }
        if (this.cv || this.ca) {
            this.ao.css("width", this.hf * 2);
            this.ao.css("height", this.dR * 2)
        }
        if (this.hn == true) {
            this.dv.hC(true, 300, jQuery.proxy(this.jm, this))
        }
        else if (this.ca == true) {
            this.dv.hC(true, 300, jQuery.proxy(this.jm, this))
        }
        if (!WR360.by.iR) {
            var bu = this;
            this.gL = setInterval(function ()
            {
                bu.kG()
            }, 300)
        }
    };
    WR360.bx.prototype.cN = function (aX)
    {
        if (!WR360.by.iR) {
            clearInterval(this.gL);
            this.gL = 0
        }
        if (!this.dv.dX()) {
            return
        }
        if (WR360.by.lp()) {
            aX = false
        }
        if (aX) {
            this.dv.hC(false, 400, jQuery.proxy(this.kk, this))
        }
        else {
            this.dv.aH(false);
            this.kk()
        }
        this.unbindRolloverEvents();
        this.dispatchEvent(new WR360.Event(WR360.bx.ii, false, false))
    };
    WR360.bx.prototype.unbindRolloverEvents = function ()
    {
        if (this.bq) {
            this.bq.unbind()
        }
        if (this.aN) {
            this.aN.unbind()
        }
        this.H.unbind("touchstart.proxy" + this.ig);
        this.H.unbind("mousedown.proxy" + this.ig)
    };
    WR360.bx.prototype.jm = function ()
    {
        if (!WR360.by.iR)
        {
            this.dv.Bind("mousedown", jQuery.proxy(function (event)
            {
                this.lm(event)
            }, this));
            this.H.bind("mousedown.proxy" + this.ig, jQuery.proxy(function (event)
            {
                this.ld(event)
            }, this))
        }
        else
        {
            this.dv.Bind("touchstart", jQuery.proxy(function (event)
            {
                this.lm(event)
            }, this));
            this.H.bind("touchstart.proxy" + this.ig, jQuery.proxy(function (event)
            {
                this.ld(event)
            }, this))
        }
    };
    WR360.bx.prototype.kk = function () {};
    WR360.bx.prototype.iA = function () {}
})();
(function ()
{
    WR360.jI = function (id, visible)
    {
        this.Id = id;
        this.Visible = visible;
    }
})();
(function ()
{
    WR360.cP = function (id, dF, cn)
    {
        this.cj = false;
        this.df = false;
        this.id = id;
        this.dF = dF;
        this.cn = cn;
        this.K = jQuery("#" + this.id);
    };
    WR360.cP.prototype.iW = function ()
    {
        return this.cj;
    };
    WR360.cP.prototype.fi = function (fh)
    {
        if (this.cj == fh) {
            return
        }
        if (!this.cj) {
            this.K.attr("class", this.cn)
        }
        else {
            this.K.attr("class", this.dF)
        }
        this.cj = fh;
    };
    WR360.cP.prototype.aH = function (visible)
    {
        if (this.K == null) {
            throw new Error("SetVisible: buttonElement==null.");
        }
        this.df = visible;
        if (visible) {
            this.K.show()
        }
        else {
            this.K.hide()
        }
    };
    WR360.eI = function (id, cg, be, dF, ck, cn, cY, du)
    {
        this.aB().constructor.call(this, id, dF, cn);
        this.jn = false;
        this.cg = cg;
        this.ck = ck;
        this.cY = cY;
        this.du = du;
        this.be = be;
    };
    WR360.eI.bE(WR360.cP);
    WR360.eI.prototype.cD = function ()
    {
        if (this.jn) {
            return
        }
        this.K.bind(this.cg, jQuery.proxy(this.ck, this.be));
        this.jn = true;
    };
    WR360.eI.prototype.fi = function (fh)
    {
        if (this.cj == fh) {
            return
        }
        if (!this.cj)
        {
            this.K.unbind(this.cg);
            this.K.attr("class", this.cn);
            if (this.du == 0) {
                this.K.bind(this.cg, jQuery.proxy(this.cY, this.be))
            }
            else {
                var bu = this;
                setTimeout(function ()
                {
                    bu.ka()
                },
                this.du)
            }
        }
        else
        {
            this.K.unbind(this.cg);
            this.K.attr("class", this.dF);
            if (this.du == 0) {
                this.K.bind(this.cg, jQuery.proxy(this.ck, this.be))
            }
            else {
                var bu = this;
                setTimeout(function ()
                {
                    bu.lj()
                },
                this.du)
            }
        }
        this.cj = fh;
    };
    WR360.cP.prototype.ka = function ()
    {
        this.K.bind(this.cg, jQuery.proxy(this.cY, this.be))
    };
    WR360.cP.prototype.lj = function ()
    {
        this.K.bind(this.cg, jQuery.proxy(this.ck, this.be))
    };
    WR360.fb = function (id, cg, be, dF, ck, cn, cY, du)
    {
        this.aB().constructor.call(this, id, cg, be, dF, ck, cn, cY, du)
    };
    WR360.fb.bE(WR360.eI);
    WR360.fb.prototype.pb = function ()
    {
        return this.iW();
    };
    WR360.fb.prototype.ji = function (playing)
    {
        this.fi(playing)
    };
    WR360.ej = function (id, dF, cn)
    {
        this.aB().constructor.call(this, id, dF, cn)
    };
    WR360.ej.bE(WR360.cP);
    WR360.ej.prototype.nM = function ()
    {
        return this.iW();
    };
    WR360.ej.prototype.as = function (dn)
    {
        this.fi(dn)
    }
})();
(function ()
{
    WR360.bN = function ()
    {
        this.he = 1;
        this.aF =- 1;
        this.bU = null;
        this.bB = null;
        this.V = null;
        this.es = 0;
        this.fe = 0;
        this.bh = null;
        this.db = true;
        this.cA = null;
        this.hz = null;
        this.ce = null;
        this.en = false;
        this.hw = false;
        this.cX = new WR360.J;
        this.aU = null;
        this.dZ = 0;
        this.jr = true;
        this.lc = false;
        this.H = null;
        this.bd = null;
        this.jp = null;
        this.aG = null;
        this.kL = null;
        this.qH = null;
        this.kv =- 1;
        this.kl = "ready";
        this.lB = 1;
        this.rm = false;
        this.pJ = 0;
    };
    WR360.bN.prototype.nR = function ()
    {
        for (var ai in this.cA) {
            ai.aH(false);
            ai.jE()
        }
    };
    WR360.bN.prototype.iF = function (bh, bd, jp)
    {
        this.bh = bh;
        this.bd = bd;
        this.aG = bd;
        this.jp = jp;
    };
    WR360.bN.prototype.cD = function (bU, bB, V, es, fe, aU, H)
    {
        this.cA = new Array;
        this.hz = new Array;
        this.ce = new Array;
        this.bU = bU;
        this.bB = bB;
        this.V = V;
        this.aU = aU;
        this.H = H;
        this.lB = this.bh.lB;
        this.he = this.bh.bA.settings.bg.kC ==- 1 ? 1 :- 1;
        if (this.bh.pH != null && this.bh.pH.configFileFullScreenURL == "" && this.bh.settings.fullScreenOnClick == false) {
            this.es = this.bh.pH.dG;
            this.fe = this.bh.pH.dA
        }
        else {
            this.es = es;
            this.fe = fe
        }
        this.bh.addEventListener(WR360.Events.gM, jQuery.proxy(this.lO, this));
        this.bh.addEventListener(WR360.Events.gY, jQuery.proxy(this.mo, this));
        if (this.V.settings.control.hideHotspotsOnLoad) {
            this.db = false
        }
        for (var i = 0; i < this.bB.bF.length; i++)
        {
            var aO = this.bB.bF[i];
            if (aO.bi.disabled == true) {
                continue
            }
            var dj = aO.bi.id;
            var ai = null;
            if (aO.bi.dI == false) {
                ai = new WR360.aT(false, aO, this, this.bh, this.H)
            }
            else {
                ai = new WR360.cI(false, aO, this, this.bh, this.H)
            }
            this.cA[dj] = ai;
            this.hz[dj] = this.ce[i] = new WR360.jI(dj, true);
            ai.cD()
        }
    };
    WR360.bN.prototype.oy = function (aO, qb, rj)
    {
        var x = 0;
        var y = 0;
        var bi = aO.bi;
        var width = qb;
        var height = rj;
        if (aO.F.src.length > 0) {
            width = aO.F.width * this.lB;
            height = aO.F.height * this.lB
        }
        if (bi.offset.ot()) {
            return {
                x : bi.offset.x * this.lB, y : bi.offset.y * this.lB
            }
        }
        switch (bi.align.horizontal)
        {
            case WR360.Align.LEFT:
                x = bi.margin.left;
                break;
            case WR360.Align.CENTER:
                x = bi.margin.left + (this.H.css("width").aK() - bi.margin.left - bi.margin.right - width) / 2;
                break;
            case WR360.Align.RIGHT:
                x = this.H.css("width").aK() - bi.margin.right - width;
                break;
            default:
        }
        switch (bi.align.vertical)
        {
            case WR360.Align.TOP:
                y = bi.margin.top;
                break;
            case WR360.Align.CENTER:
                y = bi.margin.top + (this.H.css("height").aK() - bi.margin.top - bi.margin.bottom - height) / 2;
                break;
            case WR360.Align.BOTTOM:
                y = this.H.css("height").aK() - bi.margin.bottom - height;
                break;
            default:
        }
        return {
            x : x, y : y
        }
    };
    WR360.bN.prototype.fo = function ()
    {
        var dir = this.V.settings.bg.kC;
        if (this.V.settings.bg.oc == "true") {
            this.he = dir ==- 1 ? 1 :- 1
        }
        else {
            this.he = dir ==- 1 ?- 1 : 1
        }
        return this.iG(this.he);
    };
    WR360.bN.prototype.eT = function ()
    {
        var dir = this.V.settings.bg.kC;
        if (this.V.settings.bg.oc == "true") {
            this.he = dir ==- 1 ? 1 :- 1
        }
        else {
            this.he = dir ==- 1 ? 1 :- 1
        }
        return this.iG(this.he);
    };
    WR360.bN.prototype.ny = function ()
    {
        this.dE(0)
    };
    WR360.bN.prototype.nC = function ()
    {
        this.dE(this.bU.aw.length - 1)
    };
    WR360.bN.prototype.iG = function (jG)
    {
        return this.dE(this.aF + jG);
    };
    WR360.bN.prototype.qo = function (label)
    {
        if (label && label.length > 0)
        {
            for (var i = 0; i < this.bU.aw.length; i++)
            {
                if (this.bU.aw[i].image.label.toLowerCase() == label.toLowerCase()) {
                    return this.dE(i);
                }
            }
        }
        return false;
    };
    WR360.bN.prototype.qB = function (label, rF, hZ)
    {
        if (this.pJ != 0) {
            return true
        }
        this.bh.cJ();
        var targetIndex =- 1;
        if (label && label.length > 0)
        {
            for (targetIndex = 0; targetIndex < this.bU.aw.length; targetIndex++) {
                if (this.bU.aw[targetIndex].image.label.toLowerCase() == label.toLowerCase()) {
                    break
                }
            }
        }
        if (targetIndex ==- 1) {
            return false
        }
        if (targetIndex == this.aF) {
            return true
        }
        var pE = false;
        var pO = true;
        var lM = this;
        var pv = Math.abs(lM.aF - targetIndex);
        if (pv <= this.bU.aw.length / 2) {
            pO = lM.aF < targetIndex
        }
        else {
            pO = lM.aF > targetIndex
        }
        var qD = function ()
        {
            if (pE || lM.aF == targetIndex)
            {
                clearInterval(lM.pJ);
                lM.pJ = 0;
                lM.bh.removeEventListener(WR360.Events.mA, pV);
                lM.bh.eg.ji(false);
                lM.bh.pY = false;
                if (lM.aF == targetIndex && typeof hZ !== "undefined") {
                    if (hZ != null) {
                        hZ(label)
                    }
                }
                return
            }
            lM.rm = true;
            pO ? lM.eT() : lM.fo();
            lM.rm = false;
        };
        var pV = function ()
        {
            pE = true;
        };
        this.bh.addEventListener(WR360.Events.mA, pV);
        this.bh.eg.ji(true);
        this.bh.pY = true;
        var gg = WR360.by.dM(rF, 1);
        var eo = gg / this.bU.aw.length * 1000;
        this.pJ = setInterval(function ()
        {
            qD()
        }, eo);
        return true;
    };
    WR360.bN.prototype.ob = function ()
    {
        return this.aF;
    };
    WR360.bN.prototype.lV = function (index)
    {
        var kj = false;
        if (index < 0) {
            index =- index;
            kj = true
        }
        if (index > this.bU.aw.length - 1) {
            index = index % this.bU.aw.length
        }
        if (index > 0 && kj) {
            index = this.bU.aw.length - index
        }
        return index;
    };
    WR360.bN.prototype.nk = function (index)
    {
        if (!this.rm && this.V.settings.bg.bounce)
        {
            if (index >= this.bU.aw.length - 1) {
                return this.bU.aw.length - 1
            }
            else if (index <= 0) {
                return 0;
            }
        }
        return this.lV(index);
    };
    WR360.bN.prototype.fK = function (bW, deltaX, deltaY)
    {
        var fL = this.bU.aw[bW].bG;
        if (fL == null) {
            return
        }
        if (deltaX == null) {
            deltaX = 0
        }
        if (deltaY == null) {
            deltaY = 0
        }
        var dC = 0;
        var cK = 0;
        if (this.bh.bA.iq()) {
            dC = this.bh.bA.aw.ep;
            cK = this.bh.bA.aw.eU
        }
        else {
            dC = fL.width;
            cK = fL.height
        }
        this.aG.css("width", dC);
        this.aG.css("height", cK);
        if (this.jr)
        {
            this.aG.css("margin-left", this.aU['_viewPort.x'] + (this.aU['_viewPort.width'] - dC) / 2 + deltaX);
            this.aG.css("margin-top", this.aU['_viewPort.y'] + (this.aU['_viewPort.height'] - cK) / 2 + deltaY);
            if (this.dZ == 0) {
                this.dZ = dC / this.aU['_viewPort.width']
            }
            if (this.bh.fm - dC < 0) {
                this.bh.eL.eY = this.bh.fm - dC;
                this.bh.eL.fd = 0
            }
            else {
                this.bh.eL.eY = 0;
                this.bh.eL.fd = this.bh.fm - dC
            }
            if (this.bh.fJ - cK < 0) {
                this.bh.eL.ev = this.bh.fJ - cK;
                this.bh.eL.fM = 0
            }
            else {
                this.bh.eL.ev = 0;
                this.bh.eL.fM = this.bh.fJ - cK
            }
            this.jr = false
        }
        this.hs(fL.src);
        if (!this.bh.eG()) {
            this.eh(bW)
        }
        this.aU['_viewPort.zoomedInX'] = this.aG.css("margin-left").aK();
        this.aU['_viewPort.zoomedInY'] = this.aG.css("margin-top").aK();
        this.aU['_viewPort.zoomedInWidth'] = this.aG.css("width").aK();
        this.aU['_viewPort.zoomedInHeight'] = this.aG.css("height").aK();
        this.hw = true;
    };
    WR360.bN.prototype.dE = function (index, deltaX, deltaY)
    {
        var ic = this.aF;
        var returnValue = true;
        this.aF = parseInt(this.nk(index));
        if (ic >= 0 && this.aF == ic) {
            returnValue = false
        }
        var af = this.bU.aw[this.aF];
        if (this.en && af.image.cS != null)
        {
            if (af.bG != null && af.bG.cQ == true) {
                this.aS(null);
                this.fK(this.aF)
            }
            else
            {
                this.aS(af);
                if (!this.cX.contains(af))
                {
                    this.cX.bk(af);
                    af.addEventListener(WR360.ah.eD, jQuery.proxy(this.hm, this), {
                        deltaX : deltaX, deltaY : deltaY
                    });
                    af.addEventListener(WR360.ah.dU, jQuery.proxy(this.eK, this));
                    af.addEventListener(WR360.ah.fD, jQuery.proxy(this.eK, this));
                    af.hS();
                    if (af.bG == null || af.bG.cQ == false) {
                        this.bh.hc(true);
                        this.bh.er(this.cX.ds().toString())
                    }
                }
                if (af.bG == null || af.bG.cQ == false) {
                    this.iM(this.aF, true)
                }
            }
        }
        else {
            this.iM(this.aF, this.hw)
        }
        return returnValue;
    };
    WR360.bN.prototype.aS = function (iw)
    {
        var bC = 0;
        if (this.cX.contains(iw)) {
            bC = 1
        }
        while (this.cX.ds() > bC)
        {
            var af = this.cX.mh(0);
            if (af != iw)
            {
                af.removeEventListener(WR360.ah.eD, this.hm);
                af.removeEventListener(WR360.ah.dU, this.eK);
                af.removeEventListener(WR360.ah.fD, this.eK);
                af.aE();
                this.cX.removeItem(af)
            }
        }
        if (this.cX.ds() == 0) {
            this.bh.hc(false)
        }
        this.bh.er(this.cX.ds().toString())
    };
    WR360.bN.prototype.iM = function (bW, jT)
    {
        if (this.bU == null) {
            return
        }
        if (this.bU.aw[bW].F.src.length == 0) {
            return
        }
        this.hs(this.bU.aw[bW].F.src);
        if (!this.bh.eG()) {
            this.eh(bW)
        }
        if (jT) {
            this.hw = false;
        }
    };
    WR360.bN.prototype.kg = function ()
    {
        if (this.ce != null) {
            for (var i = 0; i < this.ce.length; i++) {
                this.ce[i].Visible = false;
            }
        }
    };
    WR360.bN.prototype.eh = function (bW, aX)
    {
        if (!this.db) {
            return
        }
        if (this.aG.is(":visible") != true) {
            var bn = this;
            setTimeout(function ()
            {
                bn.eh(bW, aX)
            }, 400);
            return
        }
        this.kg();
        if (!this.bU) {
            return
        }
        var af = this.bU.aw[bW];
        if (!af) {
            return
        }
        for (var i = 0; i < af.image.bF.length; i++)
        {
            var al = af.image.bF[i];
            if (al != null)
            {
                var ai = this.cA[al.source];
                if (ai != null)
                {
                    ai.eC(this.aG.css("left").aK() + this.aG.css("margin-left").aK() + al.offsetX * (this.aG.css("width").aK() / this.es));
                    ai.fv(this.aG.css("top").aK() + this.aG.css("margin-top").aK() + al.offsetY * (this.aG.css("height").aK() / this.fe));
                    ai.aH(true, aX);
                    this.hz[al.source].Visible = true;
                }
            }
        }
        for (var i = 0; i < this.ce.length; i++)
        {
            var bi = this.ce[i];
            if (typeof bi !== undefined && bi != null)
            {
                ai = this.cA[bi.Id];
                if (ai != null) {
                    var aO = ai.aO;
                    if (aO != null && (aO.bi.dI == true || aO.bi.ps == 1)) {
                        ai.nT()
                    }
                }
            }
        }
        this.kQ()
    };
    WR360.bN.prototype.kQ = function ()
    {
        for (var i = 0; i < this.ce.length; i++) {
            var jg = this.ce[i];
            if (!jg.Visible) {
                this.cA[jg.Id].aH(false)
            }
        }
    };
    WR360.bN.prototype.kM = function (duration, left, top, marginLeft, marginTop, width, height)
    {
        if (!this.db) {
            return
        }
        var af = this.bU.aw[this.aF];
        for (var i = 0; i < af.image.bF.length; i++)
        {
            var al = af.image.bF[i];
            if (al != null)
            {
                var ai = this.cA[al.source];
                if (ai != null)
                {
                    var aO = ai.aO;
                    if (aO.bi.dI == false)
                    {
                        ai.bb.animate(
                        {
                            left : left + marginLeft + al.offsetX * (width / this.es) - ai.lX() / 2, top : top + marginTop + al.offsetY * (height / this.fe) - ai.lT() / 2
                        }, duration)
                    }
                }
            }
        }
    };
    WR360.bN.prototype.lx = function (aX)
    {
        for (var i = 0; i < this.ce.length; i++) {
            this.cA[this.ce[i].Id].aH(false, aX)
        }
        this.bh.R = false;
    };
    WR360.bN.prototype.hs = function (src)
    {
        if (!this.bh.eG()) {
            this.bd.attr("src", src)
        }
        else
        {
            var jO = this;
            if (this.aG == this.bd)
            {
                this.kl = "busy";
                this.aG = this.jp;
                this.kL = this.bd;
                this.pK(this.bd, this.jp);
                this.jp.css("z-index", 0);
                var oldSrc = this.bd.attr("src");
                jO.mZ(jO.jp, jO.bd, jO);
                this.jp.attr("src", src)
            }
            else if (this.aG == this.jp)
            {
                this.kl = "busy";
                this.aG = this.bd;
                this.kL = this.jp;
                this.pK(this.jp, this.bd);
                this.bd.css("z-index", 0);
                var oldSrc = this.bd.attr("src");
                jO.mZ(jO.bd, jO.jp, jO);
                this.bd.attr("src", src)
            }
        }
    };
    WR360.bN.prototype.pK = function (fromElement, toElement)
    {
        toElement.css("margin-left", fromElement.css("margin-left"));
        toElement.css("margin-top", fromElement.css("margin-top"));
        toElement.css("width", fromElement.css("width"));
        toElement.css("height", fromElement.css("height"));
        toElement.css("left", fromElement.css("left"));
        toElement.css("top", fromElement.css("top"));
        toElement.css("display", fromElement.css("display"))
    };
    WR360.bN.prototype.rd = function (src)
    {
        this.qH = src;
        this.kv = this.aF;
        var jO = this;
        setTimeout(function ()
        {
            if (jO.kl != "busy" && jO.kv == jO.aF) {
                jO.hs(jO.qH)
            }
        }, 100)
    };
    WR360.bN.prototype.mZ = function (oh, pk, jO)
    {
        setTimeout(function ()
        {
            oh.css("z-index", 2002);
            pk.css("z-index", 0);
            jO.kl = "ready";
            jO.eh(jO.aF)
        }, 10)
    };
    WR360.bN.prototype.lO = function (e)
    {
        this.db = true;
        this.eh(this.aF, true);
        this.bh.ih(true)
    };
    WR360.bN.prototype.mo = function (e)
    {
        this.db = false;
        this.lx(true);
        this.bh.ih(false)
    };
    WR360.bN.prototype.fP = function ()
    {
        this.eh(this.aF)
    };
    WR360.bN.prototype.hm = function (e, offset)
    {
        if (e.af == null) {
            return
        }
        this.cX.removeItem(e.af);
        if (this.cX.ds() == 0) {
            this.bh.hc(false)
        }
        this.bh.er(this.cX.ds().toString());
        if (!this.en) {
            return
        }
        e.af.removeEventListener(WR360.ah.eD, this.hm);
        e.af.removeEventListener(WR360.ah.dU, this.eK);
        e.af.removeEventListener(WR360.ah.fD, this.eK);
        if (e.af.index != this.aF) {
            return
        }
        this.fK(this.aF, offset.deltaX, offset.deltaY)
    };
    WR360.bN.prototype.eK = function (e)
    {
        if (e.af == null) {
            return
        }
        this.cX.removeItem(e.af);
        if (this.cX.ds() == 0) {
            this.bh.hc(false)
        }
        this.bh.er(this.cX.ds().toString());
        e.af.removeEventListener(WR360.ah.eD, this.hm);
        e.af.removeEventListener(WR360.ah.dU, this.eK);
        e.af.removeEventListener(WR360.ah.fD, this.eK)
    }
})();
(function ()
{
    WR360.by.mG();
    var hT = false;
    var jR = true;
    document.ondragstart = function ()
    {
        return false;
    };
    jQuery(window).unload(function ()
    {
        jQuery.each(lH.ew, function ()
        {
            if (this.av) {
                this.pR(null)
            }
        })
    });
    jQuery(window).resize(function ()
    {
        jQuery.each(lH.ew, function ()
        {
            if (this.or == true) {
                this.pS()
            }
        })
    });
    function ra()
    {
        jQuery.each(lH.ew, function ()
        {
            this.qn()
        })
    }
    jQuery(document).ready(function ()
    {
        hT = true;
        jQuery.each(lH.ew, function ()
        {
            this.jy()
        })
    });
    var ko = "ECAwQFBgcICQAB";
    var fp = "";
    WR360.jX = function ()
    {
        this.eY = 0;
        this.ev = 0;
        this.fd = 0;
        this.fM = 0;
    };
    WR360.ImageRotator = function (cR)
    {
        this.aB().constructor.call(this);
        if (cR != null && cR.length > 0) {
            this.cR = "#" + cR;
            this.oY = cR
        }
        lH.add(this);
        this.settings = new WR360.jQ;
        this.jP = 0;
        this.fm = 0;
        this.fJ = 0;
        this.dO = 0;
        this.ei = 0;
        this.hl = false;
        this.oX = 0;
        this.cp = 0;
        this.ha = 0;
        this.hg = 0;
        this.qe = 0;
        this.eu = false;
        this.eS = 0;
        this.eO = 0;
        this.ri = false;
        this.nJ = 0;
        this.kU = false;
        this.pY = false;
        this.oS = false;
        this.bU = null;
        this.bB = null;
        this.eE = null;
        this.eP = 0;
        this.dG = 0;
        this.dA = 0;
        this.loaded = false;
        this.viewerBackgroundColor = "";
        this.bA = new WR360.gl;
        this.nL = "";
        this.configFileFullScreenURL = "";
        this.fN = "";
        this.gf = "";
        this.rootPath = "";
        this.cq = null;
        this.toolbar = new WR360.Toolbar(this);
        this.dV = false;
        this.reloadImageIndex =- 1;
        this.aU = new Array;
        this.dn = false;
        this.qY = true;
        this.R = false;
        this.bd = null;
        this.jp = null;
        this.jW = 0;
        this.jt = 0;
        this.eL = new WR360.jX;
        this.bV = new WR360.bN;
        this.fs = 0;
        this.fX = 0;
        this.db = true;
        this.cF = new WR360.hI;
        this.fu = false;
        this.jo = true;
        this.or = false;
        this.av = false;
        this.reloadCallback = null;
        this.pj = null;
        this.fl = 0;
        this.ak = 0;
        this.aV = 0;
        this.fq = 0;
        this.oa = 0;
        this.pp = 0;
        this.O = 50 * this.hE();
        this.eo = 500 * this.hE();
        this.gy = 0;
        this.gQ =- 1;
        this.bw = 300;
        this.licenseFileURL = "license.lic";
        this.cr = null;
        this.cZ = null;
        this.oV = false;
        this.fT = true;
        this.fQ = false;
        this.pL = true;
        this.eg = null;
        this.dN = null;
        this.bY = null;
        this.qZ = null;
        this.hB = false;
        this.bS = false;
        this.ey = false;
        this.gT = false;
        this.bM = false;
        this.qX = false;
        this.lB = 1;
        this.gu = "b1";
        this.oD = "i8ujXOfyQKsb0ntiQLRJNqDYT9/9OTL6lvTpPB41YFAxMZ9Rt1pBpA==";
        this.hV = "pEObvaqAslGmqYSI1iZngQ3MF/Ar3ZGxZ78TLJ1LZW4kqxU0";
        this.pD = "ohtdbI/Ul1vCoSNkyoMEAlSUbVOqLNdSbs9XJPekPzilsNp6DFHMI/E=";
        this.qN = "WXau8tyNHUiBQE1xmrkAdTYP/ZKx+Vu92rRIkbli1cMxbsyz";
        this.gF = "RamEB6nl1dIeNBEZm7QDsOVb3dGGYWkwNVHWuvJ94wp9G3vW5SHvOOlX44oxMBX7X1vxUANM+tmDqjoqhA==";
        this.ju = "GlSkJBzsD5RcCjrwLEVCJ7mIFwJDyCqGGD5NdA==";
        this.bc = "eLD7JUtPYvyJvsxgrAnCsNSQCgEM7pIfT94HS1rOoLcL2MwyCMuro5pRUlZ5d1RS1DrWjP6l1qNzk6TlHh9omapeMmUV8/FkXCK0FPgIoU9yitzubDz5YmpAWEZAouM9ortgcOiOj734L22h//27xDhbGQa+VU9RGknhdPZN5uqrsOrF0a+kMfYYNxSxRbS7OsmPnBTwGkcq4HiLvnc=";
        this.ap = "TwxktOdX72sNWYxdOZklOOQODD3v/24BL/L3TqfGHTdXH1FgV4B3p0l369uDHjcukAzhbGZGeHpcIcE0hYFO+RQdLIzsG/rzmx37a88D+HbdTlQrliszG4ssH4QdWjuUYEAu1q5Z4kswmvKFVxbERVldXQrZzLX9wzrZGoej0bkEwuw5";
        this.aY = "Q3al7L/L0P9pKODM8KKroGEN0uVXShCvTyhMM6e/SVOR3++eyV0lzeMt9srGcZIhVUNQw5ilDRPYx4WQE9wm0zp6XDihvR7PyNMi6Kf2ejGoVPg3WPY9hNN1dqrqaEaaSsRQvU1kSATMxl7M9Y5KYC7xtB2jhpb47MLtMyVDDsXPWNws9x9aYbFHXmNFywwJ2aYUoA7kCgGBaKajtCCNdXmK+jJXm3a7";
        this.bj = "HBxXgwukRpBsuvZcuDhoAlS7QJKv3fqMVC6hPzKuX6bxLD57uiXEN4s+TsbGT+PVr97SoEnk5qVnLihaVLyvY7s6cd2oBhvpsPEfJRiXTofF0atdDzoFJgkrSUPb1Gk7CUn/E4kcVidBATbFSAqXuToe55CMy0DX1ACkFWwtvIrDX/CYGw31M/OIVxEIZHXkNj9LOexPqp33jeQj7hEpzGUdv0qsmJdtydHpAXSGiyIeXj9bZA==";
        this.aQ = "W7rMSKsW9MaGeot+2i175+dODmvU77QTH4r7nbbbHaYtwpgCIbCkAHxjP2TEULx8R6SO5WujzE4H+gskhOTj/gH8SchaFibUWdh6ZWoa5TyB1v0snPyH1gOhLiJdxHqY9Fnd4gpjHGyn+EbOOT+tvSAj20D7ZbduDQ/w45q2ETE/KOrNuLY5rYrwYVSPOIzt0H8TA+ZWMRkhfmczD/MSBtm9EU7YCy/OXWxPyuYE/WQVKTMYIg==";
        this.hq = "CE5WQFjMWoXIqJM96X2TgU1Zno0u6NzcBR5NJQzcCnh6aLx0jbxlaRPwn23afzHaH0PznBiCZ0lDce+LCiBOsh6d8iQ/78e5DT2xkuCR0oZ4svuWHzfHXMOnGjea5DEZgrcmoKPPZ/1AQDYmIfog2qS+iLXffCi6AfBAGH3i5atEbEWTzNbZVKTc+czWAg9K2d+K1JU4YKaCJJLu0U6OxhJfKuGd/O7R1Uw4Kbd8ytef/QhfOorY6lzvtGRsiJSdj7HsaEUqPPoXMxSHbDqbVJNaS4HUEzpuLVT/tYCaTpcAhtQL6FzvISKN7W+wMtKCLogNAqITfVyvlAywc/N7RvE5HZnkBVVs8yUGA139CBfKdsbvAsN/fmLL5qlTu1bqSNJM2dYuGsVnC88WwMqvAl8jhNiregSonOIBO2F5JpdH/BSKT/2YLTEvHLOkUow+yGMPAqDX+D3mAb5iEeHGIgUfov5T8pIyyzENjwPSKsPrhpF5sonxIaMPXbQmATZjjkHyDUbLul+79/xeAWuRCAo9uW+pJhCqopFL6KuxlWEr1LcA5hHL3soUkHIBLrUwplCxDEsz2Px1cRLQiOOaLolpdnHt/DH3c97zeofte92zzy0D+Di8wqU+vWZTnVfxPM0T01UZFfeZ/7C4gjRSAASHYtwFTw0DSMsoAY4pRy4VjXdv888STtiIxSSjTnWNTXvjr/zPJqVb+uFslxxyvPDXcUW7HYvOhMSEEA3S1/PlGKIO/datgZgI5tge+a/IwbXaS/LCg95KhBkp6Dlenx9CCXJ8y/yOz2TNzTNG4ULUHwDm2ohcMkg1aQjdyS9yZF0nu51IdiXLSXs8tmE1fzFLu/I5VnxIXScQdG/uDFgsRREhMQK+zBYTkP8tDrcT8al4Sma69AK3ud4GVxvsVLp0dK8tG7+ELIMA9jdFxEvfnJYHdOWqvgYnBUYSmq6x1u0alDr+HxuNBznWOrtjEfGOuwOFkx1OU09JAY1OFuA+iaCDOcDRip9xJpSt2S1oz0bAo+56uKlUA8sMf+wIVR8uIW/5N04yaxhnMu2LXxPV4tzu/3oqwzMmFr5VPcyDL4JD1FZfX2B7/Qrr4JgAtkyy4tY0a/pckoZCugR3VL0HW38EVJMuAZoO7jmoeApqhFnXeEeI9mosIrbMOXvsw1XdilTlNUOLPUrLTsY3jOhK9Iciq1QsoiNXdqSbJk3bnOqF9A9bs5PKmicW6bDXa/wHLOVFZumZJQazPY1eAblal3FfN8Taq+o5vwlqtODHMh2bILVcWv/lQbB1tWUh8p7FwLVEbU0dSxvLjbplkOnZz/5KEb4Q4GDOhw5D0q/MM6RqGGNJFMKbK3qBuQHK0Y9E16F4ZDCDOmoErVGwRkhCDMYUxH8M69WyM49KgECj4p5gAJFAy06Q2HKUispuQu/3Jb1hFe1RA5DTkH0fBrDokm5dOooZg5HubZ7qsoDD9xsX+maN0F9uFSCXS+oyBFgjTfGz4oqM8cHNly3AK3P/T/Z96AqZrNaSZoNQhQpQWlTxR+FDCa/jt+F5XWYkj8H7rCXxvKZFUwbMDgkv5XLDQgARb/sI";
        this.cl = "dktqJEFqoPEq0tpyHW+t+g0A5z1CM2WYZjA=";
        this.cB = "R/l5GGs2Xaf3cRvrvK1nanLt6096Idh0";
        this.ay = "QNwfbJZzxJbLJoAS6wD5rjfHAwo=";
        this.eN = "+TRK8gwDasJDqGQwNufuXbi0Y6X3EzfY";
        this.eQ = "Afj02wTB6swmDOMmUBKl0YqPUGAmx3mj";
        this.ft = "wCGtg+3u3OfUBYPdq/af6ZVoYJ7/UddZbmK1Zw==";
        this.iO = "sU1SxZ+bTWPPsst0n2G3qVvXmytz72GF/Dk7IouwuME=";
        this.gZ = "UWNbywprZj418vl75nvvduad1DXwSOjFCo6Ehv6sWqoQKzts8y/bduk2OBO6w/Ob3XV9U4EiAQ2r0l6ceDhoTqSK";
        this.gq = "cW56SgPLG88nDk0oTcc44H6Wnkw3TZr3iPKk4aa9SGp8GxIRAURjmfeen+Cw7oZ4i62ZoFszodE3nXLf";
        this.pr = "rDRrdT/G3CyWJhlFPwJyqargFHqHSCgKoUMu3HDGhxn7WohEA1YONuK2TagGaNDqG8vk2Z7RQ7WLc3ZWG8L0mOstNa/bYPwAKhefJqWqoSJnQ1i6myiTb8fStXxQR9ptNBlonx9ez4seVsruQea7mLfWlfFPH7rus+XJepIsSrTTh4v6GiYq1xkcCHSwEK6cEHGm09Leu2MQRCiRQ8U7zGCQjcdS9Xsj0/XDmsVyPW2Kk9EblA4atSsaaxnAiyxX/SZEnbn3L/cPI0AqMGWumQBN+kDQYr9Ez5H3aVhMIyKE0JCD/8NfLpSvSVP/XnzvFdFdpORN7xW7z4iiR683ef+wu4CsNyVYpDIe6rpupAFcsv8uXOuzXyfI67HfvIWNYMD8iZD/whCQ3AEh2u7TCIUoI6L4gw==";
        this.oG = "XOwh26ByinkEBUnj6JYyAyG6Pogtg8f5ZIeHJwEuLX3zRu/HhwD8pXT4p3rMXhURL06HWGS+mRJED6xdIPObueNhlPDsnAA+Jp+xVBwlDfqEeQ3gQZhbTJK7Tsc6uDVhE3JlkB6+PUEDdTBq1zaWJgpGWPkJFmAFM0lcAyeEY4L75+M4wgYVmOOXesWfVFlWlJgx9j6RqhvlgwrOmo6UwNLU/sqsxK7dQw1vKslg3qYko6saw9snTERvFoCfy4/JBdLtWPYkEgFu7OAbWUjTXfPQvuSNCBMYxfHJEU5/sGlqPhlFPbIdM6IogZbtGxoHMi7DPPl7XxhGDeJVu47VZqggct/pXoq6m30yK8BA3lp3fsDpFOzWyzZvhbqkqNVE2KIxFXL4aG+TWVRqjDfhMvYv5662n0HfQyvVhI3ViyE6eNSXUmo0cSDdCH+s5fcq20G2vKS0QLAXUUVO966s+2VxCN+4/M1N0ZgkbnaSHQ92M9gPbQZqstX7VCXXUuT9cWYmNnogsrJoXtp+C3eaTsyr+A7Psjc6hJzoHLwW9W0Qd69RiHH4WwOi/H4H77pMJOI1ux46B9QGKMJglscX9j0dam1+Lw==";
        this.pf = "Xj/4NHvML4pcsq3MvkaM3AhqEAHI30bVi+sjPrV7rQ==";
        this.nF = "74jKbQgCCCSweCxY5xm3RfzymxqRs40kgKxSqA==";
        this.po = "aejT9R7nMP19KhITxmBxBaOBaJgGqR6+y4ZzYDYmBTjUY7nw7TGGm7Hp438XllTR";
        this.oz = "A8qo8fCMEFHG785164bZu5KlOzaZbE/92zINLNcQ+c2z+PBCNSRT/nkAObS7v9HLu3KzZR0=";
        this.nB = "v8yhMDISy8CQJF073b9a6xB2lMix";
        this.oO = "4IIhiEFPgpBJmPziEDdMl+hEws/AK+6ACB9P";
    };
    WR360.ImageRotator.bE(WR360.dh);
    WR360.ImageRotator.km = 4;
    var oH = false;
    WR360.ImageRotator.Create = function (cR)
    {
        if (!oH) {
            var nf = lH.get(0);
            if (cR != null && cR.length > 0) {
                nf.cR = "#" + cR;
                nf.oY = cR
            }
            oH = true;
            return nf
        }
        return new WR360.ImageRotator(cR);
    };
    WR360.ImageRotator.kR = function ()
    {
        if (fp.length > 0) {
            return fp
        }
        fp = kP + ko + kZ;
        return fp;
    };
    WR360.ImageRotator.prototype.bm = function ()
    {
        if (!jR || this.bM == true) {
            return
        }
        var ns = WR360.ImageRotator.kR();
        var bQ = ac.fk.bL(ns);
        this.gu = ac.G.aD(this.gu, bQ);
        this.oD = ac.G.aD(this.oD, bQ);
        this.hV = ac.G.aD(this.hV, bQ);
        this.pD = ac.G.aD(this.pD, bQ);
        this.qN = ac.G.aD(this.qN, bQ);
        this.gF = ac.G.aD(this.gF, bQ);
        this.ju = ac.G.aD(this.ju, bQ);
        this.bc = ac.G.aD(this.bc, bQ);
        this.ap = ac.G.aD(this.ap, bQ);
        this.aY = ac.G.aD(this.aY, bQ);
        this.bj = ac.G.aD(this.bj, bQ);
        this.aQ = ac.G.aD(this.aQ, bQ);
        this.hq = ac.G.aD(this.hq, bQ);
        this.cl = ac.G.aD(this.cl, bQ);
        this.cB = ac.G.aD(this.cB, bQ);
        this.ay = ac.G.aD(this.ay, bQ);
        this.eN = ac.G.aD(this.eN, bQ);
        this.eQ = ac.G.aD(this.eQ, bQ);
        this.ft = ac.G.aD(this.ft, bQ);
        this.iO = ac.G.aD(this.iO, bQ);
        this.gZ = ac.G.aD(this.gZ, bQ);
        this.gq = ac.G.aD(this.gq, bQ);
        this.pr = ac.G.aD(this.pr, bQ);
        this.oG = ac.G.aD(this.oG, bQ);
        this.pf = ac.G.aD(this.pf, bQ);
        this.nF = ac.G.aD(this.nF, bQ);
        this.po = ac.G.aD(this.po, bQ);
        this.oz = ac.G.aD(this.oz, bQ);
        this.nB = ac.G.aD(this.nB, bQ);
        this.oO = ac.G.aD(this.oO, bQ);
        this.bM = true;
    };
    WR360.ImageRotator.prototype.rh = function ()
    {
        ra()
    };
    WR360.ImageRotator.nn = function (align, defaultValue)
    {
        if (align == null) {
            return defaultValue
        }
        if (align.toLocaleLowerCase() == "left") {
            return - 1
        }
        if (align.toLocaleLowerCase() == "right") {
            return 1
        }
        return defaultValue;
    };
    WR360.ImageRotator.prototype.reload = function (configFileURL, rootPath, hZ, reloadImageIndex)
    {
        this.kI(false);
        this.ri = true;
        if (configFileURL && configFileURL.length > 0) {
            this.settings.configFileURL = configFileURL
        }
        this.settings.rootPath = rootPath;
        this.hB = false;
        this.co();
        this.cJ();
        this.ff();
        this.hD();
        this.mU();
        this.loaded = false;
        this.eP = 0;
        this.jP = 0;
        this.jo = true;
        this.db = true;
        this.nV = null;
        this.fN = this.settings.configFileURL;
        this.gf = this.settings.rootPath;
        this.fX = 0;
        this.bA = new WR360.gl;
        this.bV = new WR360.bN;
        this.reloadCallback = null;
        this.dV = true;
        this.reloadImageIndex = typeof reloadImageIndex !== "undefined" ? reloadImageIndex :- 1;
        if (typeof hZ !== "undefined" && hZ != null) {
            this.reloadCallback = hZ
        }
        this.gN(null);
    };
    WR360.ImageRotator.prototype.ih = function (db)
    {
        if (db == null) {
            throw new Error("ImageRotator.SetHotspotsOnProperty: hotspotsOn == null");
        }
        this.db = db;
        if (this.bY) {
            this.bY.fi(!this.db)
        }
    };
    WR360.ImageRotator.prototype.lz = function ()
    {
        if (this.hX()) {
            this.dispatchEvent(new WR360.Event(WR360.Events.gY, false, false))
        }
    };
    WR360.ImageRotator.prototype.iV = function ()
    {
        if (this.hX()) {
            this.dispatchEvent(new WR360.Event(WR360.Events.gM, false, false))
        }
    };
    WR360.ImageRotator.prototype.hX = function ()
    {
        if (this.bA.bF.length > 0) {
            this.hA = true
        }
        if (this.bA.settings.bI.bY && this.hA) {
            return true
        }
        return false;
    };
    WR360.ImageRotator.prototype.runImageRotator = function (cR)
    {
        if (this.cR == null || this.cR.length == 0)
        {
            if (cR == null || cR.length == 0) {
                throw new Error("Player ID parameter is empty.");
            }
            this.cR = "#" + cR;
            this.oY = cR
        }
        if (this.settings.fullScreenOnClick == true && this.pH === undefined) {
            this.bm();
            var bn = this;
            jQuery(this.cR).click(function ()
            {
                bn.rg()
            });
            return
        }
        this.gU = "#" + this.aR("wr360LeftButton", "wr360LeftButton");
        this.hd = "#" + this.aR("wr360RightButton", "wr360RightButton");
        this.jA = "#" + this.aR("wr360ZoomButton", "wr360ZoomButton");
        this.jD = "#" + this.aR("wr360PlayButton", "wr360PlayButton");
        this.kp = "#" + this.aR("wr360HotspotsButton", "wr360HotspotsButton");
        this.pQ = "#" + this.aR("wr360FullScreenButton", "wr360FullScreenButton");
        this.ja = "#" + this.aR("wr360ThemePanel_", "wr360ThemePanel_");
        this.ie = "#" + this.aR("wr360ToolBar", "wr360ToolBar");
        this.nQ = "#" + this.aR("wr360ThemePanelBack", "wr360ThemePanelBack");
        this.kW = "#" + this.aR("wr360ProgressBar", "wr360ProgressBar");
        this.fj = "#" + this.aR("wr360ProgressNum", "wr360ProgressNum");
        jQuery(this.cR).removeClass("wr360_player").addClass("wr360_player");
        this.fm = this.settings.viewWidthJQFix ? this.settings.viewWidthJQFix : jQuery(this.cR).innerWidth();
        this.fJ = this.settings.viewHeightJQFix ? this.settings.viewHeightJQFix : jQuery(this.cR).innerHeight();
        this.viewerBackgroundColor = jQuery(this.cR).css("backgroundColor");
        if (WR360.by.iR) {
            this.cF.gD = false
        }
        if (this.settings.responsiveBaseHeight == 0) {
            this.settings.responsiveBaseHeight = this.fJ
        }
        this.gf = this.settings.rootPath;
        this.fN = this.settings.configFileURL;
        this.gN(null);
        this.or = true;
    };
    WR360.ImageRotator.prototype.gN = function (hQ)
    {
        if (!hQ || hQ.success == false) {
            this.bS = true;
            this.jy()
        }
    };
    WR360.ImageRotator.prototype.aR = function (stringToChange, oA)
    {
        return stringToChange.replace(oA, oA + "_" + this.oY);
    };
    WR360.ImageRotator.prototype.oQ = function ()
    {
        if (this.qX) {
            return
        }
        this.ap = this.aR(this.ap, this.cl.replace("#", ""));
        this.aY = this.aR(this.aY, this.cB.replace("#", ""));
        this.bj = this.aR(this.bj, this.eN.replace("#", ""));
        this.aQ = this.aR(this.aQ, this.eQ.replace("#", ""));
        this.hq = this.aR(this.hq, "wr360container");
        this.hq = this.aR(this.hq, "wr360image");
        this.hq = this.aR(this.hq, "wr360image2");
        this.hq = this.aR(this.hq, "wr360placer");
        this.hq = this.aR(this.hq, "wr360LeftButton");
        this.hq = this.aR(this.hq, "wr360RightButton");
        this.hq = this.aR(this.hq, "wr360ZoomButton");
        this.hq = this.aR(this.hq, "wr360PlayButton");
        this.hq = this.aR(this.hq, "wr360HotspotsButton");
        this.hq = this.aR(this.hq, "wr360FullScreenButton");
        this.hq = this.aR(this.hq, "wr360ThemePanel_");
        this.hq = this.aR(this.hq, "wr360ToolBar");
        this.hq = this.aR(this.hq, "wr360ThemePanelBack");
        this.hq = this.aR(this.hq, "wr360ProgressBar");
        this.hq = this.aR(this.hq, "wr360ProgressNum");
        this.cB = this.aR(this.cB, this.cB.replace("#", ""));
        this.eN = this.aR(this.eN, this.eN.replace("#", ""));
        this.eQ = this.aR(this.eQ, this.eQ.replace("#", ""));
        this.ft = this.aR(this.ft, "wr360placer");
        this.pf = this.aR(this.pf, "wr360container");
        this.qX = true;
    };
    WR360.ImageRotator.prototype.jy = function ()
    {
        if (this.bS == false || hT == false || this.hB == true) {
            return
        }
        this.hB = true;
        this.bm();
        this.oQ();
        this.lk();
        this.pS();
        this.kO()
    };
    WR360.ImageRotator.mv = function ()
    {
        return this.gq;
    };
    WR360.ImageRotator.oJ = function ()
    {
        return "id,class";
    };
    WR360.ImageRotator.ov = function ()
    {
        return ac;
    };
    WR360.ImageRotator.oZ = function ()
    {
        return WR360.ImageRotator.kR();
    };
    WR360.ImageRotator.prototype.hj = function ()
    {
        return this.rootPath;
    };
    WR360.ImageRotator.prototype.lk = function ()
    {
        if (this.dV == false) {
            jQuery(this.cR).append(this.hq)
        }
        jQuery(this.pf).css("width", this.settings.viewWidthJQFix ? this.settings.viewWidthJQFix : jQuery(this.cR).innerWidth());
        jQuery(this.pf).css("height", this.settings.viewHeightJQFix ? this.settings.viewHeightJQFix : jQuery(this.cR).innerHeight());
        if (this.qr) {
            this.qr()
        }
        if (this.qU) {
            this.qU()
        }
        this.toolbar.cD();
        this.bd = jQuery("#wr360image_" + this.oY);
        this.jp = jQuery("#wr360image2_" + this.oY);
        this.bd.hide();
        this.jp.hide();
        if (!this.eG()) {
            this.jp = null
        }
        this.bV.iF(this, this.bd, this.jp);
        jQuery(this.ja).hide();
        WR360.bZ.od(this.gu + "" + this.settings.version)
    };
    WR360.ImageRotator.prototype.eG = function ()
    {
        return (jQuery.browser.mozilla || jQuery.browser.opera) && this.settings.zIndexLayersOn == true;
    };
    jQuery.ajaxSetup(
    {
        error : function (XMLHttpRequest, fr, ec)
        {
            WR360.bZ.gA(fr);
            WR360.bZ.gA(ec);
            WR360.bZ.gA(XMLHttpRequest.responseText)
        }
    });
    WR360.ImageRotator.prototype.im = function ()
    {
        this.aL();
        var aW = this.fN.length != 0;
        if (aW) {
            if (!this.mY()) {
                WR360.bZ.gA("Could not parse XML config path.");
                return
            }
        }
        this.fs = 0;
        this.dn = false;
        if (this.dN) {
            this.dN.as(false)
        }
        this.qY = true;
        this.R = false;
        if (!this.av && this.pL) {
            if (this.fT == true && this != lH.get(0)) {
                return
            }
        }
        if (this.av && this.fT && this.pL) {
            return
        }
        if (this.qS()) {
            return
        }
        if (aW) {
            this.ki()
        }
        else {
            this.dq()
        }
    };
    WR360.ImageRotator.prototype.kO = function ()
    {
        var bu = this;
        var options = 
        {
            type : "GET", url : this.licenseFileURL, dataType : "text",
            success : function (gi)
            {
                bu.nd(gi)
            },
            error : function (e)
            {
                bu.lW(e)
            }
        };
        if (!WR360.by.qT(options)) {
            jQuery.ajax(options)
        }
    };
    WR360.ImageRotator.prototype.md = function ()
    {
        this.pj = new Image;
        this.pj.src = this.gZ;
    };
    WR360.ImageRotator.prototype.nd = function (gi)
    {
        if (this.qS()) {
            return
        }
        this.jK(gi);
        this.im()
    };
    WR360.ImageRotator.prototype.lW = function (e)
    {
        if (this.qS()) {
            return
        }
        this.dQ();
        this.im()
    };
    WR360.ImageRotator.prototype.ek = function ()
    {
        return this.fT == false;
    };
    WR360.ImageRotator.prototype.gz = function ()
    {
        return this.fQ == true;
    };
    WR360.ImageRotator.prototype.qS = function ()
    {
        if (this.pL) {
            return false
        }
        var lu = this.jh(document.location.hostname);
        var qt = this.jh(this.hV);
        var pP = this.jh(this.pD);
        var qV = this.jh(this.qN);
        if (lu.indexOf(qt) ==- 1 && lu.indexOf(pP) ==- 1 && lu.indexOf(qV) ==- 1) {
            return true
        }
        return false;
    };
    WR360.ImageRotator.prototype.jh = function (eA)
    {
        var gr = 0;
        if (eA.substr(0, 10) == "http://www") {
            gr = 11
        }
        else if (eA.substr(0, 7) == "http://") {
            gr = 7
        }
        else if (eA.substr(0, 4) == "www.") {
            gr = 4
        }
        var gG = eA.indexOf("/", gr);
        if (gG ==- 1) {
            gG = eA.length
        }
        var pa = eA.substring(gr, gG);
        return pa;
    };
    WR360.ImageRotator.prototype.az = function ()
    {
        if (location.href.indexOf("http://") ==- 1 || location.href.indexOf("localhost") !=- 1 || location.href.indexOf("127.0.0") !=- 1) {
            return true
        }
        var lu = this.jh(document.location.hostname);
        var kH = this.jh(this.cZ);
        if (lu != kH)
        {
            if (this.cZ.indexOf(".") ==- 1) {
                if (this.cZ.length >= 4 && lu.indexOf(this.cZ) !=- 1) {
                    return true;
                }
            }
            return false
        }
        else {
            return true;
        }
    };
    WR360.ImageRotator.prototype.dQ = function ()
    {
        this.fQ = false;
        this.fT = true;
    };
    WR360.ImageRotator.prototype.jK = function (gW)
    {
        if (gW == null || gW.length == 0) {
            this.dQ();
            return
        }
        var mW = WR360.ImageRotator.kR();
        try {
            var hy = getBrowserId(gW, mW)
        }
        catch (kV) {
            this.dQ();
            return
        }
        if (hy == null || hy.length == 0) {
            this.dQ();
            return
        }
        var fW = hy.split("^^");
        if (fW.length < 3) {
            this.dQ();
            return
        }
        this.cr = fW[0];
        if (this.cr.length == 0) {
            this.dQ();
            return
        }
        this.cZ = fW[2];
        if (this.cZ.length == 0) {
            this.dQ();
            return
        }
        var hF = fW[1];
        if (hF.length != 12) {
            this.dQ();
            return
        }
        try
        {
            var an = this.cr + this.cZ;
            var aa = 0;
            for (var i = 0; i < an.length; i++) {
                aa += an.charCodeAt(i)
            }
            var bD = hF.substr(0, 4);
            var ae = parseInt(bD, 16);
            if (aa != ae) {
                this.dQ();
                return
            }
            var kS = hF.substr(6, 1);
            var kJ = Number(kS);
            this.fQ = kJ == 1
        }
        catch (kV) {
            this.dQ();
            return
        }
        if (this.gz() && this.az() == false) {
            this.dQ();
            return
        }
        this.fT = false;
    };
    WR360.ImageRotator.prototype.mz = function ()
    {
        jQuery(this.iO).show()
    };
    WR360.ImageRotator.prototype.hD = function ()
    {
        if (this.oa != 0) {
            clearInterval(this.oa);
            this.oa = 0
        }
        if (this.pp != 0) {
            clearInterval(this.pp);
            this.pp = 0;
        }
    };
    WR360.ImageRotator.prototype.oT = function ()
    {
        if (jQuery(this.pf).find(this.iO).length == 0) {
            jQuery(this.pf).append(this.po.format(this.nF, this.iO.replace("#", "")))
        }
        var p = jQuery(this.iO);
        p.attr(this.nB, this.pr);
        p.show();
        if (jQuery(this.iO).find(this.ft).length == 0) {
            p.append(this.oz.format(this.ft.replace("#", ""), this.hV, this.gu))
        }
        var y = jQuery(this.ft);
        y.attr(this.nB, this.oG);
        var z = y.html();
        if (z != this.oD) {
            y.html(this.oD)
        }
        y.show()
    };
    WR360.ImageRotator.prototype.nI = function ()
    {
        if (!jQuery(this.cl).is(":visible"))
        {
            jQuery(this.cl).remove();
            this.aL();
            jQuery(this.cl).unbind(this.oO);
            jQuery(this.pf).unbind(this.oO);
            jQuery(this.pf).bind(this.oO, function (event)
            {
                ow(event)
            });
            jQuery(this.cl).bind(this.oO, function (event)
            {
                ow(event)
            });
            var bn = this;
            jQuery(this.cl).unbind("mousemove");
            jQuery(this.cl).unbind("mouseout");
            jQuery(this.cl).bind("mousemove", function (event)
            {
                bn.gT = true;
            });
            jQuery(this.cl).bind("mouseout", function (event)
            {
                bn.gT = false;
            })
        }
    };
    WR360.ImageRotator.prototype.mY = function ()
    {
        var configFileURL = this.fN;
        if (null != configFileURL && configFileURL.length > 0)
        {
            var el = configFileURL.lastIndexOf("/");
            if (-1 == el) {
                el = configFileURL.lastIndexOf("\\")
            }
            if (-1 != el)
            {
                var path = this.gf;
                if (null != path && path.length > 0 && this.ek() == true) {
                    this.rootPath = path
                }
                else {
                    this.rootPath = configFileURL.substr(0, el + 1)
                }
                this.nL = configFileURL.substr(el + 1);
                this.jF = configFileURL;
                return true;
            }
        }
        this.jF = this.rootPath + this.nL;
        return true;
    };
    WR360.ImageRotator.prototype.ki = function ()
    {
        var bu = this;
        var options = 
        {
            type : "GET", url : this.jF, dataType : "xml",
            success : function (di)
            {
                bu.mO(di)
            },
            error : function (jk, fr, ec)
            {
                bu.mH(jk, fr, ec)
            }
        };
        if (!WR360.by.qT(options)) {
            jQuery.ajax(options)
        }
    };
    WR360.ImageRotator.prototype.dq = function ()
    {
        this.cq = new WR360.lE(this.bA, this);
        this.eP = this.bA.settings.bg.fE;
        if (this.bA.aw.length > 0 && this.bA.aw[0].cS != null) {
            this.bV.lc = true
        }
        if (this.av == true) {
            jQuery(this.cR).css({
                'background-color' : this.bA.settings.bI.fullScreenBackColor
            })
        }
        else {
            jQuery(this.pf).css({
                'background-color' : this.viewerBackgroundColor
            })
        }
        this.eE = new WR360.cL(this);
        this.eE.addEventListener(WR360.cO.COMPLETE, jQuery.proxy(this.lZ, this));
        this.eE.addEventListener(WR360.cO.ERROR, jQuery.proxy(this.lK, this));
        this.eE.Load(this.hj(), this.bA);
        this.bB = new WR360.dc;
        if (this.ek() == false) {
            this.bB.hu = WR360.ImageRotator.km
        }
        this.bB.addEventListener(WR360.dK.PROGRESS, jQuery.proxy(this.nN, this));
        this.bB.addEventListener(WR360.dK.ERROR, jQuery.proxy(this.pq, this));
        this.bB.addEventListener(WR360.dK.COMPLETE, jQuery.proxy(this.nZ, this));
        this.bB.Init(this.hj(), this.bA);
        this.bU = new WR360.dP;
        this.bU.addEventListener(WR360.cf.PROGRESS, jQuery.proxy(this.mP, this));
        this.bU.addEventListener(WR360.cf.COMPLETE, jQuery.proxy(this.lP, this));
        this.bU.addEventListener(WR360.cf.ERROR, jQuery.proxy(this.ml, this));
        this.bU.Init(this.hj(), this.settings.graphicsPath, this.bA, this.av && this.bA.settings.control.qc && this.bV.lc);
        this.fX += this.bU.aw.length;
        this.fX += this.bB.bF.length;
        this.bB.kD();
        this.bU.kE()
    };
    WR360.ImageRotator.prototype.mO = function (di)
    {
        var bn = this;
        var V = this.bA;
        if (jQuery.browser.msie && WR360.by.pA()) {
            di = jQuery.parseXML(di)
        }
        var ip = jQuery(di).find("settings");
        if (ip && ip.length == 0) {
            WR360.bZ.gA("ERROR: Cannot read config section 'settings'.");
            return
        }
        jQuery(di).find("preloader").each(function ()
        {
            V.settings.eH.image = jQuery(this).attr("image");
        });
        jQuery(di).find("userInterface").each(function ()
        {
            V.settings.bI.hb = WR360.by.bX(jQuery(this).attr("showArrows"), V.settings.bI.hb);
            V.settings.bI.gj = WR360.by.bX(jQuery(this).attr("showTogglePlayButton"), V.settings.bI.gj);
            V.settings.bI.gw = WR360.by.bX(jQuery(this).attr("showZoomButtons"), V.settings.bI.gw);
            V.settings.bI.iT = WR360.by.bX(jQuery(this).attr("showFullScreenButton"), V.settings.bI.iT);
            V.settings.bI.hY = WR360.by.bX(jQuery(this).attr("showScrollbar"), V.settings.bI.hY);
            V.settings.bI.bY = WR360.by.bX(jQuery(this).attr("showHotspotsButton"), V.settings.bI.bY);
            V.settings.bI.iU = WR360.by.bX(jQuery(this).attr("showToolTips"), V.settings.bI.iU);
            V.settings.bI.bz = WR360.by.bX(jQuery(this).attr("showProgressNumbers"), V.settings.bI.bz);
            V.settings.bI.gx = WR360.ImageRotator.nn(jQuery(this).attr("toolbarAlign"), V.settings.bI.gx);
            V.settings.bI.kK = WR360.by.cz(jQuery(this).attr("toolbarForeColor"), V.settings.bI.kK);
            V.settings.bI.lh = WR360.by.cz(jQuery(this).attr("toolbarHoverColor"), V.settings.bI.lh);
            V.settings.bI.gH = WR360.by.cz(jQuery(this).attr("toolbarBackColor"), V.settings.bI.gH);
            V.settings.bI.iC = WR360.by.je(jQuery(this).attr("toolbarAlpha"), V.settings.bI.iC);
            V.settings.bI.gX = WR360.by.je(jQuery(this).attr("toolbarBackAlpha"), V.settings.bI.gX);
            V.settings.bI.gC = WR360.by.cz(jQuery(this).attr("progressNumColor"), V.settings.bI.gC);
            V.settings.bI.hW = WR360.by.cz(jQuery(this).attr("progressLoopColor"), V.settings.bI.hW);
            V.settings.bI.fullScreenBackColor = WR360.by.cz(jQuery(this).attr("fullScreenBackColor"), 
            V.settings.bI.fullScreenBackColor);
            V.settings.bI.showFullScreenToolbar = WR360.by.bX(jQuery(this).attr("showFullScreenToolbar"), 
            V.settings.bI.showFullScreenToolbar);
        });
        jQuery(di).find("control").each(function ()
        {
            V.settings.control.gp = WR360.by.je(jQuery(this).attr("dragSpeed"), V.settings.control.gp);
            V.settings.control.ci = WR360.by.dM(jQuery(this).attr("maxZoom"), V.settings.control.ci);
            V.settings.control.lU = WR360.by.dM(jQuery(this).attr("maxZoomFullScreen"), V.settings.control.lU);
            V.settings.control.mu = WR360.by.dM(jQuery(this).attr("fullScreenStretch"), V.settings.control.mu);
            V.settings.control.dJ = WR360.by.bX(jQuery(this).attr("disableMouseControl"), V.settings.control.dJ);
            V.settings.control.iu = WR360.by.bX(jQuery(this).attr("doubleClickZooms"), V.settings.control.iu);
            V.settings.control.qc = WR360.by.bX(jQuery(this).attr("showHighresOnFullScreen"), V.settings.control.qc);
            V.settings.control.mouseHoverDrag = WR360.by.bX(jQuery(this).attr("mouseHoverDrag"), V.settings.control.mouseHoverDrag);
            V.settings.control.hideHotspotsOnLoad = WR360.by.bX(jQuery(this).attr("hideHotspotsOnLoad"), 
            V.settings.control.hideHotspotsOnLoad);
            V.settings.control.hideHotspotsOnZoom = WR360.by.bX(jQuery(this).attr("hideHotspotsOnZoom"), 
            V.settings.control.hideHotspotsOnZoom);
        });
        jQuery(di).find("rotation").each(function ()
        {
            V.settings.bg.fE = WR360.by.cz(jQuery(this).attr("firstImage"), V.settings.bg.fE);
            V.settings.bg.rotate = WR360.by.cz(jQuery(this).attr("rotate"), V.settings.bg.rotate);
            V.settings.bg.kC = WR360.by.dM(jQuery(this).attr("rotateDirection"), V.settings.bg.kC);
            V.settings.bg.oc = WR360.by.cz(jQuery(this).attr("forceDirection"), V.settings.bg.oc);
            V.settings.bg.gg = WR360.by.dM(jQuery(this).attr("rotatePeriod"), V.settings.bg.gg);
            V.settings.bg.bounce = WR360.by.bX(jQuery(this).attr("bounce"), V.settings.bg.bounce);
            V.settings.bg.op = WR360.by.dM(jQuery(this).attr("stopPlaybackOn"), V.settings.bg.op);
            V.settings.bg.pe = WR360.by.bX(jQuery(this).attr("playbackForceRestart"), V.settings.bg.pe);
            V.settings.bg.useInertia = WR360.by.bX(jQuery(this).attr("useInertia"), V.settings.bg.useInertia);
            V.settings.bg.inertiaRelToDragSpeed = WR360.by.bX(jQuery(this).attr("inertiaRelToDragSpeed"), 
            V.settings.bg.inertiaRelToDragSpeed);
            V.settings.bg.inertiaTimeToStop = WR360.by.dM(jQuery(this).attr("inertiaTimeToStop"), V.settings.bg.inertiaTimeToStop);
            V.settings.bg.inertiaMaxInterval = WR360.by.dM(jQuery(this).attr("inertiaMaxInterval"), V.settings.bg.inertiaMaxInterval);
        });
        var hH = jQuery(di).find("hotspots");
        if (hH && hH.length > 0)
        {
            var kw = 0;
            hH.each(function ()
            {
                jQuery(this).find("hotspot").each(function ()
                {
                    var bi = new WR360.kc;
                    bi.id = jQuery(this).attr("id");
                    bi.type = jQuery(this).attr("type");
                    bi.dI = WR360.by.bX(jQuery(this).attr("absolutePosition"), bi.dI);
                    bi.ps = WR360.by.dM(jQuery(this).attr("renderMode"), bi.ps);
                    bi.className = jQuery(this).attr("className");
                    bi.color = WR360.by.cz(jQuery(this).attr("color"), bi.color);
                    bi.alpha = WR360.by.je(jQuery(this).attr("alpha"), bi.alpha);
                    bi.jN = WR360.by.cz(jQuery(this).attr("indicatorImage"), bi.jN);
                    bi.disabled = WR360.by.bX(jQuery(this).attr("disabled"), bi.disabled);
                    bi.activateOnClick = WR360.by.bX(jQuery(this).attr("activateOnClick"), bi.activateOnClick);
                    bi.offset.parse(jQuery(this).attr("offsetX"), jQuery(this).attr("offsetY"));
                    bi.margin.parse(jQuery(this).attr("margin"));
                    bi.align.parse(jQuery(this).attr("align"));
                    jQuery(this).find("spotinfo").each(function ()
                    {
                        bi.bo = new WR360.HotspotInfo;
                        bi.bo.src = WR360.by.cz(jQuery(this).attr("src"), bi.bo.src);
                        bi.bo.url = WR360.by.cz(jQuery(this).attr("url"), bi.bo.url);
                        bi.bo.eb = WR360.by.cz(jQuery(this).attr("urlTarget"), bi.bo.eb);
                        bi.bo.aI = WR360.by.cz(jQuery(this).attr("txt"), bi.bo.aI);
                        bi.bo.ga = WR360.by.dM(jQuery(this).attr("txtWidth"), bi.bo.ga);
                        bi.bo.gb = WR360.by.cz(jQuery(this).attr("txtColor"), bi.bo.gb);
                        bi.bo.gk = WR360.by.cz(jQuery(this).attr("txtBkColor"), bi.bo.gk);
                        bi.bo.fO = WR360.by.dM(jQuery(this).attr("fntHeight"), bi.bo.fO);
                        bi.bo.qG = WR360.by.dM(jQuery(this).attr("clickAction"), bi.bo.qG);
                        bi.bo.qO = WR360.by.cz(jQuery(this).attr("clickData"), bi.bo.qO);
                        bi.bo.clickDataParam = WR360.by.dM(jQuery(this).attr("clickDataParam"), bi.bo.clickDataParam);
                        jQuery(this).find("cdata").each(function ()
                        {
                            bi.bo.cdata = WR360.by.cz(jQuery(this).text(), bi.bo.cdata);
                        })
                    });
                    if (bi.disabled == false) {
                        V.bF[kw] = bi;
                        V.hi[bi.id] = bi;
                        kw++
                    }
                })
            })
        }
        else {
            return
        }
        var fV = jQuery(di).find("images");
        if (fV && fV.length > 0)
        {
            var bW = 0;
            fV.each(function ()
            {
                V.aw.ep = WR360.by.dM(jQuery(this).attr("highresWidth"), V.aw.ep);
                V.aw.eU = WR360.by.dM(jQuery(this).attr("highresHeight"), V.aw.eU);
                jQuery(this).find("image").each(function ()
                {
                    var dp = new WR360.lv;
                    dp.src = jQuery(this).attr("src");
                    dp.label = WR360.by.cz(jQuery(this).attr("label"), dp.label);
                    var hO = 0;
                    jQuery(this).find("hotspot").each(function ()
                    {
                        var al = new WR360.lq;
                        al.source = WR360.by.cz(jQuery(this).attr("source"), al.source);
                        al.offsetX = WR360.by.dM(jQuery(this).attr("offsetX"), al.offsetX);
                        al.offsetY = WR360.by.dM(jQuery(this).attr("offsetY"), al.offsetY);
                        dp.bF[hO] = al;
                        dp.hi[al.source] = al;
                        hO++
                    });
                    jQuery(this).find("highres").each(function ()
                    {
                        dp.cS = new WR360.kB;
                        dp.cS.src = WR360.by.cz(jQuery(this).attr("src"), dp.cS.src);
                    });
                    V.aw[bW] = dp;
                    V.ky[dp.src] = dp;
                    bW++
                })
            })
        }
        else {
            WR360.bZ.gA("ERROR: Cannot read config section 'images'.");
            return
        }
        this.dq()
    };
    WR360.ImageRotator.prototype.mP = function (e)
    {
        this.dS()
    };
    WR360.ImageRotator.prototype.nN = function (e)
    {
        this.dS()
    };
    WR360.ImageRotator.prototype.lP = function (e)
    {
        this.dS();
        this.jb(e)
    };
    WR360.ImageRotator.prototype.nZ = function (e)
    {
        this.dS();
        this.jb(e)
    };
    WR360.ImageRotator.prototype.ml = function (e)
    {
        WR360.bZ.gA(e.errorMessage)
    };
    WR360.ImageRotator.prototype.pq = function (e)
    {
        WR360.bZ.gA(e.errorMessage)
    };
    WR360.ImageRotator.prototype.dS = function ()
    {
        this.fs++;
        var kt = Math.round(this.fs / this.fX * 100);
        this.cq.il(kt)
    };
    WR360.ImageRotator.prototype.jb = function (e)
    {
        if (this.qS()) {
            return
        }
        if (this.fs < this.fX) {
            return
        }
        this.jo = false;
        try
        {
            this.cq.il(99);
            this.jV(this.bU.aw[this.eP].F);
            this.bV.cD(this.bU, this.bB, this.bA, this.dG, this.dA, this.aU, jQuery(this.pf));
            if (this.dV == true && this.reloadImageIndex >= 0) {
                this.bV.dE(this.reloadImageIndex)
            }
            else if (this.settings.fullScreenOnClick == true || typeof this.qz === "undefined" || !this.qz()) {
                this.bV.dE(this.bA.settings.bg.fE)
            }
            this.cq.destroy();
            this.lo();
            var qL = this.jp ? this.jp : this.bd;
            qL.fadeIn(600, jQuery.proxy(function ()
            {
                this.ke()
            }, this));
            if (this.settings.apiReadyCallback != null && this.dV != true) {
                this.settings.apiReadyCallback(new WR360.API(this))
            }
            if (this.dV == true && this.reloadCallback != null) {
                this.reloadCallback();
                this.reloadCallback = null
            }
            this.dV = false
        }
        catch (ex) {
            WR360.bZ.gA("Exception: " + ex.message)
        }
    };
    WR360.ImageRotator.prototype.fK = function (deltaX, deltaY)
    {
        this.bV.en = true;
        this.bV.dE(this.bV.aF, deltaX, deltaY)
    };
    WR360.ImageRotator.prototype.lZ = function (e)
    {
        if (!this.jo) {
            return
        }
        var image = e.image;
        if (image == null) {
            return
        }
        this.jV(this.eE.image);
        this.bV.hs(image.src);
        var qL = this.jp ? this.jp : this.bd;
        qL.fadeIn(600)
    };
    WR360.ImageRotator.prototype.lK = function (e)
    {
        WR360.bZ.gA(e.errorMessage)
    };
    WR360.ImageRotator.prototype.mH = function (jk, fr, ec)
    {
        WR360.bZ.gA("Could not load configuration file '" + this.fN + "': " + fr + ", " + ec.toString())
    };
    WR360.ImageRotator.prototype.lo = function ()
    {
        this.dG = this.bU.aw[this.eP].F.width;
        this.dA = this.bU.aw[this.eP].F.height;
        this.loaded = true;
        this.kY();
        this.nx();
        this.toolbar.mV(this.bA, this);
        if (this.qa) {
            this.qa()
        }
        this.nt();
        this.pS();
        if (this.ek() == false)
        {
            if (location.href.indexOf("http://") !=- 1 && location.href.indexOf("localhost") ==- 1 && location.href.indexOf("127.0.0") ==- 1) {
                var lM = this;
                setTimeout(function ()
                {
                    lM.md()
                }, 2000)
            }
        }
    };
    WR360.ImageRotator.prototype.gK = function (bi)
    {
        var ax = bi.id;
        if (ax != null) {
            ax = ax.replace(/ /g, "_")
        }
        if (bi.dI == true) {
            return "wr360StaticSpot_" + ax + "_" + this.oY
        }
        else {
            return "wr360DynamicSpot_" + ax + "_" + this.oY;
        }
    };
    WR360.ImageRotator.prototype.mU = function ()
    {
        jQuery(".wr360hotspot_" + this.oY).remove();
        jQuery(".wr360rollover_" + this.oY).remove()
    };
    WR360.ImageRotator.prototype.nt = function ()
    {
        var bn = this;
        if (bn.dV == false)
        {
            jQuery(this.pf).bind("selectstart", function (event)
            {
                bn.na(event)
            });
            jQuery(this.pf).bind("mousemove", function (event)
            {
                bn.onMouseMove(event)
            });
            jQuery(this.pf).bind("mousedown", function (event)
            {
                bn.onMouseDown(event)
            });
            jQuery(this.pf).bind("mouseup", function (event)
            {
                bn.onMouseUp(event)
            });
            jQuery(this.pf).bind("mouseleave", function (event)
            {
                bn.onMouseLeave(event)
            });
            this.bd.bind("dblclick", function (event)
            {
                bn.lJ(event, this)
            });
            if (this.jp) {
                this.jp.bind("dblclick", function (event)
                {
                    bn.lJ(event, this)
                })
            }
            jQuery(this.pf).bind(this.oO, function (event)
            {
                ow(event)
            });
            jQuery(this.cl).bind(this.oO, function (event)
            {
                ow(event)
            });
            jQuery(this.pf).bind("touchstart", function (event)
            {
                bn.mk(event)
            });
            jQuery(this.pf).bind("touchmove", function (event)
            {
                bn.nm(event)
            });
            jQuery(this.pf).bind("touchend", function (event)
            {
                bn.mL(event)
            });
            jQuery(this.pf).bind("touchcancel", function ()
            {
                bn.ma(event)
            });
            jQuery(this.bc).bind("mousedown", function (event)
            {
                bn.ph()
            });
            jQuery(this.cl).bind("mouseover", function (event)
            {
                bn.gT = true;
            });
            jQuery(this.cl).bind("mouseout", function (event)
            {
                bn.gT = false;
            })
        }
    };
    WR360.ImageRotator.prototype.nx = function ()
    {
        var bn = this;
        if (bn.dV == false)
        {
            jQuery(this.gU).bind(
            {
                mousedown : function ()
                {
                    bn.np()
                },
                mouseup : function ()
                {
                    bn.nr()
                },
                mouseout : function ()
                {
                    bn.lY()
                }
            });
            jQuery(this.hd).bind(
            {
                mousedown : function ()
                {
                    bn.nv()
                },
                mouseup : function ()
                {
                    bn.mT()
                },
                mouseout : function ()
                {
                    bn.mK()
                }
            });
            jQuery(this.jA).bind({
                mousedown : function (event)
                {
                    bn.mt(event)
                }
            });
            this.dN = new WR360.ej(this.jA.replace("#", ""), "zoomin_button", "zoomout_button");
            jQuery(this.kp).bind({
                click : function (event)
                {
                    bn.mf(event)
                }
            });
            jQuery(this.pQ).bind({
                click : function (event)
                {
                    if (bn.rc) {
                        bn.rc(event)
                    }
                }
            });
            this.bY = new WR360.cP(this.kp.replace("#", ""), "hotspotson_button", "hotspotsoff_button");
            this.qZ = new WR360.cP(this.pQ.replace("#", ""), "fullscreenon_button", "fullscreenoff_button");
            this.eg = new WR360.fb(this.jD.replace("#", ""), "click", this, "play_button", bn.mR, "pause_button", 
            bn.mp, 500);
            this.eg.cD();
            jQuery(this.ja).mousedown(function (event)
            {
                bn.nj(event)
            });
            jQuery(this.ja).mousemove(function (event)
            {
                bn.nD(event)
            });
            jQuery(this.ja).mouseleave(function (event)
            {
                bn.oj(event)
            })
        }
        this.ih(!this.bA.settings.control.hideHotspotsOnLoad)
    };
    WR360.ImageRotator.prototype.pS = function ()
    {
        if (this.pW) {
            if (this.pW()) {
                if (this.bV) {
                    this.bV.eh(this.bV.aF, false)
                }
                return
            }
        }
        if (this.settings.viewWidthJQFix == 0 && this.settings.viewHeightJQFix == 0)
        {
            this.kI(false);
            this.fm = jQuery(this.cR).innerWidth();
            if (this.settings.responsiveBaseWidth == 0)
            {
                this.fJ = jQuery(this.cR).innerHeight();
                jQuery(this.pf).css({
                    width : this.fm, height : this.fJ
                });
                this.lB = 1
            }
            else
            {
                var ratio = this.settings.responsiveBaseHeight / this.settings.responsiveBaseWidth;
                this.fJ = this.fm * ratio;
                jQuery(this.pf).css({
                    width : this.fm, height : this.fJ
                });
                jQuery(this.cR).css({
                    height : this.fJ
                });
                jQuery(this.cR).parent().css({
                    height : this.fJ
                });
                this.lB = this.fm / this.settings.responsiveBaseWidth;
            }
        }
        if (this.bV != null) {
            this.gs();
            if (this.bV.H != null) {
                this.bV.eh(this.bV.aF, !this.av);
                this.bV.lB = this.lB;
            }
        }
    };
    WR360.ImageRotator.prototype.gs = function ()
    {
        var cW = this.settings.viewWidthJQFix ? this.settings.viewWidthJQFix : jQuery(this.pf).innerWidth();
        var dk = this.settings.viewHeightJQFix ? this.settings.viewHeightJQFix : jQuery(this.pf).innerHeight();
        var jU = dk / cW;
        var ks = this.dA / this.dG;
        var fB = 0, cw = 0, fa = 0, fF = 0;
        if (this.dG < cW && this.dA < dk) {
            fB = this.dG;
            cw = this.dA;
            fa = (cW - this.dG) / 2;
            fF = (dk - this.dA) / 2
        }
        else
        {
            if (jU >= ks) {
                fB = cW;
                cw = cW / this.dG * this.dA;
                fa = 0;
                fF = (dk - cw) / 2
            }
            else {
                cw = dk;
                fB = dk / this.dA * this.dG;
                fa = (cW - fB) / 2;
                fF = 0;
            }
        }
        if (this.settings.qs !=- 1) {
            fa = this.settings.qs
        }
        if (this.settings.rf !=- 1) {
            fF = this.settings.rf
        }
        if (this.settings.qJ !=- 1)
        {
            fB = this.settings.qJ;
            if (this.settings.imageViewportHeight ==- 1) {
                cw = fB / this.dG * this.dA;
            }
        }
        if (this.settings.imageViewportHeight !=- 1)
        {
            cw = this.settings.imageViewportHeight;
            if (this.settings.qJ ==- 1) {
                fB = cw / this.dA * this.dG;
            }
        }
        jQuery(this.pf).css("text-align", "left");
        this.bd.css("margin-left", fa);
        this.bd.css("margin-top", fF);
        this.bd.css("width", fB);
        this.bd.css("height", cw);
        if (this.jp)
        {
            this.jp.css("margin-left", fa);
            this.jp.css("margin-top", fF);
            this.jp.css("width", fB);
            this.jp.css("height", cw)
        }
        this.aU['_viewPort.x'] = fa;
        this.aU['_viewPort.y'] = fF;
        this.aU['_viewPort.width'] = fB;
        this.aU['_viewPort.height'] = cw;
        if (this.bA.iq()) {
            this.bV.dZ = this.bA.aw.ep / this.aU['_viewPort.width'];
        }
    };
    var kP = "AQIDBAUGBwgJAA";
    WR360.ImageRotator.prototype.aP = function ()
    {
        if (this.dV == false)
        {
            jQuery(this.pf).append(this.ap);
            jQuery(this.cl).append(this.aY);
            jQuery(this.cB).append(this.bj);
            jQuery(this.cB).append(this.aQ)
        }
    };
    WR360.ImageRotator.prototype.aL = function ()
    {
        var eZ = "";
        var gn = this.gu;
        var bp = 6;
        var fg = 0;
        this.mz();
        this.aP();
        if (this.ek()) {}
        else {
            gn = this.gF
        }
        if (eZ.length != 0)
        {
            fg = Math.max(eZ.length * bp, fg);
            jQuery(this.cB).css("width", fg);
            var ij = "";
            if (this.cZ != null && this.cZ.length > 0)
            {
                if (this.gz() && this.cZ.indexOf(".") ==- 1) {
                    ij = document.location.hostname
                }
                else {
                    ij = this.cZ;
                }
            }
            jQuery(this.eN).html(this.bc.format(ij, eZ))
        }
        else {
            jQuery(this.eN).hide()
        }
        if (!this.gz())
        {
            fg = Math.max(gn.length * bp, fg);
            jQuery(this.cB).css("width", fg);
            jQuery(this.eQ).html(this.bc.format(this.hV, gn))
        }
        else {
            jQuery(this.eQ).hide()
        }
    };
    WR360.ImageRotator.prototype.lw = function (iX, delay)
    {
        if (jQuery.browser.webkit || jQuery.browser.mozilla || jQuery.browser.opera || jQuery.browser.msie && jQuery.browser.version == "99") {
            jQuery(iX).fadeIn(delay);
            return true
        }
        else {
            jQuery(iX).show();
            return false;
        }
    };
    WR360.ImageRotator.prototype.jV = function (image)
    {
        this.dG = image.width;
        this.dA = image.height;
        this.pS()
    };
    WR360.ImageRotator.prototype.ng = function ()
    {
        var fB = this.aU['_viewPort.width'];
        if (fB > this.dG) {
            return 1
        }
        return this.dG / fB;
    };
    WR360.ImageRotator.prototype.mJ = function ()
    {
        if (this.bV.dZ == 0) {
            return this.ng()
        }
        else {
            return this.bV.dZ;
        }
    };
    WR360.ImageRotator.prototype.hE = function ()
    {
        return 1;
    };
    WR360.ImageRotator.prototype.kY = function ()
    {
        if (this.bA.aw.length > 0 && this.bA.settings.bg.gg > 0)
        {
            this.eo = this.bA.settings.bg.gg / this.bA.aw.length * 1000;
            this.O = this.eo;
            if (this.bA.settings.control.gp > 0) {
                this.O *= this.bA.settings.control.gp
            }
            this.O *= this.hE();
            this.eo *= this.hE()
        }
    };
    WR360.ImageRotator.prototype.mR = function (e)
    {
        this.gJ()
    };
    WR360.ImageRotator.prototype.mp = function (e)
    {
        this.cJ()
    };
    WR360.ImageRotator.prototype.lY = function (e)
    {
        if (this.pY == false) {
            this.co()
        }
    };
    WR360.ImageRotator.prototype.np = function (e)
    {
        this.bV.eT();
        this.cJ();
        this.co();
        this.hl = true;
        var bu = this;
        this.ak = setTimeout(function ()
        {
            bu.jz()
        },
        this.bw)
    };
    WR360.ImageRotator.prototype.mt = function (e)
    {
        if (this.eG()) {
            this.ri = true;
            if (this.pY == true) {
                this.cJ();
                if (this.dn && this.bV.lc) {
                    return
                }
            }
        }
        this.jL(false, e)
    };
    WR360.ImageRotator.prototype.nr = function (e)
    {
        this.co()
    };
    WR360.ImageRotator.prototype.mK = function (e)
    {
        if (this.pY == false) {
            this.co()
        }
    };
    WR360.ImageRotator.prototype.nv = function (e)
    {
        this.bV.fo();
        this.cJ();
        this.co();
        this.hl = false;
        var bu = this;
        this.ak = setTimeout(function ()
        {
            bu.jz()
        },
        this.bw)
    };
    WR360.ImageRotator.prototype.mT = function (e)
    {
        this.co()
    };
    WR360.ImageRotator.prototype.mf = function (e)
    {
        if (this.R) {
            return
        }
        this.dispatchEvent(new WR360.Event(this.db ? WR360.Events.gY : WR360.Events.gM, false, false))
    };
    WR360.ImageRotator.prototype.nj = function (e)
    {
        e.stopPropagation();
        this.dispatchEvent(new WR360.Event(WR360.Events.hG, false, false))
    };
    WR360.ImageRotator.prototype.nD = function (e)
    {
        this.kU = true;
    };
    WR360.ImageRotator.prototype.oj = function (e)
    {
        this.kU = false;
    };
    WR360.ImageRotator.prototype.na = function (e)
    {
        e.preventDefault();
        e.stopPropagation()
    };
    WR360.ImageRotator.prototype.onMouseDown = function (e)
    {
        if (e.button == mg()) {
            this.pm(e);
            if (this.bA.settings.control.dJ) {
                return
            }
            this.kx(e)
        }
        else if (e.button == mD()) {
            e.preventDefault();
            this.nP(e)
        }
    };
    WR360.ImageRotator.prototype.kx = function (e)
    {
        this.fu = true;
        this.ri = true;
        this.cJ();
        this.eu = true;
        if (!e) {
            e = window.event
        }
        var cC = WR360.by.fS(e);
        this.dO = cC.x;
        this.ei = cC.y;
        this.jW = this.bV.aG.css("margin-left").aK();
        this.jt = this.bV.aG.css("margin-top").aK();
    };
    var kZ = "AgMEBQYHCAkAAQI=";
    WR360.ImageRotator.prototype.onMouseUp = function (e)
    {
        if (this.bA.settings.control.dJ) {
            return
        }
        this.fu = false;
        this.eu = false;
        this.ff()
    };
    WR360.ImageRotator.prototype.onMouseLeave = function (e)
    {
        if (this.bA.settings.control.dJ) {
            return
        }
        jQuery(this.pf).css("cursor", "default");
        this.fu = false;
        this.eu = false;
        this.ff()
    };
    WR360.ImageRotator.prototype.lJ = function (e, target)
    {
        e.preventDefault();
        if (this.pM) {
            if (!this.pM()) {
                return
            }
        }
        if (!this.bA.settings.control.iu) {
            return
        }
        this.jL(true, e, target)
    };
    WR360.ImageRotator.prototype.onMouseMove = function (e)
    {
        if (this.qS()) {
            return
        }
        if (this.bA.settings.control.dJ) {
            return
        }
        jQuery(this.pf).css("cursor", "pointer");
        if (!e) {
            e = window.event
        }
        var cC = WR360.by.fS(e);
        this.cp = cC.x;
        this.ha = cC.y;
        this.hg += Math.abs(this.cp - this.dO);
        this.qe += Math.abs(this.ha - this.ei);
        if (this.eu == false && this.bA.settings.control.mouseHoverDrag == false) {
            this.dO = this.cp;
            this.ei = this.ha;
            return
        }
        if (this.eu == false && this.bA.settings.control.mouseHoverDrag == true)
        {
            if (this.pY == true || this.dn == true || this.kU == true) {
                this.dO = this.cp;
                this.ei = this.ha;
                return
            }
        }
        if (this.qY || this.av && !this.settings.fullScreenOnClick) {
            this.kF()
        }
        else {
            this.ff();
            this.nq(e)
        }
    };
    WR360.ImageRotator.prototype.nq = function (e)
    {
        var et = this.jW + (this.cp - this.dO);
        var gO = this.jt + (this.ha - this.ei);
        if (et < this.eL.eY) {
            et = this.eL.eY
        }
        else if (et > this.eL.fd) {
            et = this.eL.fd
        }
        if (gO < this.eL.ev) {
            gO = this.eL.ev
        }
        else if (gO > this.eL.fM) {
            gO = this.eL.fM
        }
        if (this.eG()) {
            if (this.jp == this.bV.aG) {
                this.bd.hide()
            }
            else {
                this.jp.hide()
            }
        }
        this.bV.aG.css("margin-left", et);
        this.bV.aG.css("margin-top", gO);
        this.bV.fP()
    };
    WR360.ImageRotator.prototype.mk = function (e)
    {
        if (this.bA.settings.control.dJ) {
            return
        }
        this.eS = Date.now();
        this.eO = this.hg;
        this.kx(e)
    };
    WR360.ImageRotator.prototype.mL = function (e)
    {
        if (this.bA.settings.control.dJ) {
            return
        }
        this.onMouseUp(e);
        this.oC()
    };
    WR360.ImageRotator.prototype.nm = function (e)
    {
        if (this.bA.settings.control.dJ) {
            return
        }
        var qg = this.hg;
        var qK = this.qe;
        this.onMouseMove(e);
        if (this.hg - qg > 8 && this.qe - qK < 20 || this.av == true || this.dn == true) {
            e.preventDefault()
        }
        else {
            this.ri = true;
        }
    };
    WR360.ImageRotator.prototype.ma = function (e)
    {
        if (this.bA.settings.control.dJ) {
            return
        }
        this.onMouseLeave(e);
        this.ri = true;
    };
    WR360.ImageRotator.prototype.ke = function ()
    {
        if (this.bA.settings.bg.rotate == "false") {
            return
        }
        if (this.bA.settings.bg.rotate == "once") {
            this.gQ = this.bA.settings.bg.bounce ? this.bU.jq() * 2 - 2 : this.bU.jq()
        }
        this.gJ();
    };
    WR360.ImageRotator.prototype.kF = function ()
    {
        if (this.fl == 0)
        {
            var bu = this;
            this.fl = setInterval(function ()
            {
                bu.lN()
            },
            this.O);
            this.eS = Date.now();
            this.eO = this.hg;
        }
    };
    WR360.ImageRotator.prototype.ff = function ()
    {
        if (this.fl == 0) {
            return
        }
        clearInterval(this.fl);
        this.fl = 0;
        this.oC()
    };
    WR360.ImageRotator.prototype.oC = function ()
    {
        if (!this.bA.settings.bg.useInertia) {
            return
        }
        if (this.dn) {
            return
        }
        this.ri = false;
        this.eS = Date.now() - this.eS;
        this.eO = this.hg - this.eO;
        var gp = this.eO / this.eS;
        if (gp > 0.1 && this.nJ < 120) {
            this.qM(0, gp)
        }
    };
    WR360.ImageRotator.prototype.qM = function (startTime, pu)
    {
        var ox = this.O;
        if (startTime > 0)
        {
            var relativeToSpeed = this.bA.settings.bg.inertiaRelToDragSpeed;
            var pI = relativeToSpeed == true ? this.bA.settings.bg.inertiaTimeToStop * pu : this.bA.settings.bg.inertiaTimeToStop;
            var py = this.bA.settings.bg.inertiaMaxInterval;
            var nH = Date.now() - startTime;
            ox = py * (nH /= pI) * nH + this.O;
            if (ox > py) {
                return
            }
        }
        else {
            startTime = Date.now()
        }
        var bu = this;
        setTimeout(function ()
        {
            if (bu.ri) {
                return
            }
            bu.qf();
            bu.qM(startTime, pu)
        }, ox)
    };
    WR360.ImageRotator.prototype.me = function ()
    {
        if (this.gy++== this.gQ) {
            this.cJ();
            return
        }
        this.ql()
    };
    WR360.ImageRotator.prototype.qf = function ()
    {
        var oM = this.bA.settings.bg.kC ==- 1 ? 1 :- 1;
        if (this.bV.he == oM) {
            if (this.bV.eT() == false) {
                this.bV.fo()
            }
        }
        else {
            if (this.bV.fo() == false) {
                this.bV.eT()
            }
        }
    };
    WR360.ImageRotator.prototype.ql = function ()
    {
        if (this.pY == false) {
            return
        }
        var oM = this.bA.settings.bg.kC ==- 1 ? 1 :- 1;
        if (this.bA.settings.bg.op > 0 || this.bV.he == oM) {
            if (this.bV.eT() == false) {
                this.bV.fo()
            }
        }
        else {
            if (this.bV.fo() == false) {
                this.bV.eT()
            }
        }
        if (this.bA.settings.bg.op > 0 && this.bV.aF == this.bA.settings.bg.op) {
            this.cJ()
        }
    };
    WR360.ImageRotator.prototype.gJ = function ()
    {
        if (this.pY) {
            return
        }
        this.eg.ji(true);
        this.pY = true;
        this.gy = 0;
        if (this.bA.settings.bg.op > 0) {
            if (this.bA.settings.bg.pe && this.bV.aF >= this.bA.settings.bg.op) {
                this.bV.ny()
            }
        }
        else if (this.bA.settings.bg.pe) {
            this.bV.ny()
        }
        var bu = this;
        this.fq = setInterval(function ()
        {
            bu.me()
        },
        this.eo)
    };
    WR360.ImageRotator.prototype.cJ = function ()
    {
        this.dispatchEvent(new WR360.Event(WR360.Events.mA, false, false));
        if (!this.pY) {
            return
        }
        this.eg.ji(false);
        this.pY = false;
        this.gQ =- 1;
        this.gy = 0;
        if (this.fq != 0) {
            clearInterval(this.fq);
            this.fq = 0;
        }
    };
    WR360.ImageRotator.prototype.co = function ()
    {
        if (this.ak != 0) {
            clearTimeout(this.ak);
            this.ak = 0
        }
        if (this.aV != 0) {
            clearInterval(this.aV);
            this.aV = 0;
        }
    };
    WR360.ImageRotator.prototype.jz = function ()
    {
        var bu = this;
        this.aV = setInterval(function ()
        {
            bu.iJ()
        },
        this.O)
    };
    WR360.ImageRotator.prototype.lN = function ()
    {
        if (this.cp > this.dO) {
            this.bV.fo();
            this.nJ = 0
        }
        else if (this.cp < this.dO) {
            this.bV.eT();
            this.nJ = 0
        }
        else {
            this.nJ += this.O
        }
        this.dO = this.cp;
    };
    WR360.ImageRotator.prototype.iJ = function ()
    {
        if (this.hl) {
            this.bV.eT()
        }
        else {
            this.bV.fo()
        }
    };
    WR360.ImageRotator.prototype.hc = function (show)
    {
        if (show) {
            this.cq.show()
        }
        else {
            this.cq.hide()
        }
    };
    WR360.ImageRotator.prototype.er = function (text)
    {
        this.cq.lb(text)
    };
    WR360.lE = function (V, bh)
    {
        this.bh = bh;
        this.bz = V.settings.bI.bz;
        jQuery(bh.kW).show();
        jQuery(bh.fj).html("");
        if (jQuery.browser.msie) {
            jQuery(bh.fj).css("margin-top", "1px")
        }
        if (this.bz == false) {
            jQuery(bh.fj).hide()
        }
        else {
            jQuery(bh.fj).show()
        }
        this.il = function (percent)
        {
            if (this.bz == true) {
                jQuery(bh.fj).html(percent + "%")
            }
        };
        this.lb = function (text) {};
        this.destroy = function ()
        {
            if (this.bz == true) {
                jQuery(bh.fj).html("");
                jQuery(bh.fj).hide()
            }
            jQuery(bh.kW).hide();
            jQuery(bh.ja).show()
        };
        this.show = function ()
        {
            jQuery(bh.kW).show()
        };
        this.hide = function ()
        {
            jQuery(bh.kW).hide()
        }
    };
    WR360.bZ = function () {};
    WR360.bZ.od = function (text)
    {
        this.eF("INFO", text)
    };
    WR360.bZ.pd = function (text)
    {
        this.eF("DBG", text)
    };
    WR360.bZ.gA = function (text)
    {
        this.eF("ERR", text)
    };
    WR360.bZ.oU = function (text)
    {
        this.eF("CRI", text)
    };
    WR360.bZ.nG = function (text)
    {
        this.eF("WRN", text)
    };
    WR360.bZ.eF = function (lA, text)
    {
        if (window.console)
        {
            var date = new Date;
            var kn = "{0}:{1}:{2}.{3}".format(date.getHours().toString().dd(), date.getMinutes().toString().dd(), 
            date.getSeconds().toString().dd(), date.getMilliseconds().toString().mI());
            window.console.log(kn + " " + lA + " " + text + "\n")
        }
    };
    function mg()
    {
        if (jQuery.browser.msie)
        {
            if (parseInt(jQuery.browser.version.substring(0, 1)) < 9 && jQuery.browser.version.substring(1, 
            2) == ".") {
                return 1;
            }
        }
        return 0
    }
    function mD()
    {
        return 2
    }
    WR360.ImageRotator.prototype.qn = function ()
    {
        this.ey = false;
        this.gT = false;
        jQuery(this.cl).css("display", "none")
    };
    WR360.ImageRotator.prototype.pm = function (e)
    {
        if (this.ey) {
            if (this.gT == false) {
                this.qn();
                return true
            }
            return true
        }
        return false;
    };
    WR360.ImageRotator.prototype.ph = function ()
    {
        this.ey = false;
        this.gT = false;
        jQuery(this.cl).css("display", "none")
    };
    WR360.ImageRotator.prototype.mF = function ()
    {
        var scrollX = 0, scrollY = 0;
        if (typeof window.pageYOffset == "number") {
            scrollX = window.pageXOffset;
            scrollY = window.pageYOffset
        }
        else if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
            scrollX = document.body.scrollLeft;
            scrollY = document.body.scrollTop
        }
        else if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop))
        {
            scrollX = document.documentElement.scrollLeft;
            scrollY = document.documentElement.scrollTop
        }
        return {
            scrollX : scrollX, scrollY : scrollY
        }
    };
    WR360.ImageRotator.prototype.nP = function (e)
    {
        var cC = WR360.by.fS(e);
        jQuery(this.cl).css("left", cC.x - jQuery(this.pf).offset().left);
        jQuery(this.cl).css("top", cC.y - jQuery(this.pf).offset().top);
        jQuery(this.cl).css("display", "");
        jQuery(this.eN).css("backgroundColor", "#FFFFFF");
        jQuery(this.eQ).css("backgroundColor", "#FFFFFF");
        this.ey = true;
        return false;
    };
    function ow(e)
    {
        e.preventDefault();
        return false
    }
    WR360.Toolbar = function (bh)
    {
        this.hM = 0;
        this.iz = 0;
        this.ik = 0;
        this.iy = 0;
        this.rk = 0;
        this.jZ = 0;
        this.bh = bh;
        this.iB = false;
    };
    WR360.Toolbar.prototype.cD = function ()
    {
        if (this.iB == false)
        {
            this.hM = jQuery(this.bh.gU).outerWidth(true);
            this.iz = jQuery(this.bh.hd).outerWidth(true);
            this.ik = jQuery(this.bh.jA).outerWidth(true);
            this.iy = jQuery(this.bh.jD).outerWidth(true);
            this.rk = jQuery(this.bh.pQ).outerWidth(true);
            this.jZ = jQuery(this.bh.kp).outerWidth(true);
            this.iB = true;
        }
    };
    WR360.Toolbar.prototype.Translate = function (V, bh)
    {
        if (V.settings.bI.iU == true)
        {
            jQuery(this.bh.gU).attr("title", bh.settings.i18n.arrowLeftButtonTooltip);
            jQuery(this.bh.hd).attr("title", bh.settings.i18n.arrowRightButtonTooltip);
            jQuery(this.bh.jA).attr("title", bh.settings.i18n.zoomButtonsTooltip);
            jQuery(this.bh.jD).attr("title", bh.settings.i18n.togglePlayButtonTooltip);
            jQuery(this.bh.pQ).attr("title", bh.settings.i18n.fullScreenButtonTooltip);
            jQuery(this.bh.kp).attr("title", bh.settings.i18n.hotspotButtonTooltip)
        }
    };
    WR360.Toolbar.prototype.mV = function (V, bh)
    {
        var align = V.settings.bI.gx;
        if (align == 0) {
            jQuery(bh.ie).css("float", "none")
        }
        else if (align ==- 1) {
            jQuery(bh.ie).css("float", "left")
        }
        else if (align == 1) {
            jQuery(bh.ie).css("float", "right")
        }
        jQuery(bh.nQ).css("background-color", V.settings.bI.gH);
        jQuery(bh.nQ).css("opacity", V.settings.bI.gX);
        jQuery(bh.ie).css("opacity", V.settings.bI.iC);
        var cT = 0;
        if (V.settings.bI.hb == true) {
            cT += this.hM;
            cT += this.iz;
            jQuery(bh.gU).show();
            jQuery(bh.hd).show()
        }
        else {
            jQuery(bh.gU).hide();
            jQuery(bh.hd).hide()
        }
        if (V.settings.bI.gw == true && bh.av == false) {
            cT += this.ik;
            bh.dN.aH(true)
        }
        else {
            bh.dN.aH(false)
        }
        if (V.settings.bI.gj == true) {
            cT += this.iy;
            jQuery(bh.jD).show()
        }
        else {
            jQuery(bh.jD).hide()
        }
        if (V.settings.bI.iT == true && bh.av == false) {
            cT += this.rk;
            bh.qZ.aH(true)
        }
        else {
            bh.qZ.aH(false)
        }
        if (V.settings.bI.bY == true && V.ly()) {
            cT += this.jZ;
            bh.bY.aH(true)
        }
        else {
            bh.bY.aH(false)
        }
        jQuery(this.bh.ie).css("width", bh.settings.toolbarWidthJQFix ? bh.settings.toolbarWidthJQFix : cT);
        this.Translate(V, bh)
    };
    WR360.nX = function ()
    {
        this.zoomButtonsTooltip = "Zoom in / out";
        this.hotspotButtonTooltip = "Hot-spots on / off";
        this.fullScreenButtonTooltip = "Full Screen on / off";
        this.togglePlayButtonTooltip = "Play / Stop";
        this.arrowLeftButtonTooltip = "Rotate left";
        this.arrowRightButtonTooltip = "Rotate right";
    };
    WR360.jQ = function ()
    {
        this.jsScriptOnly = true;
        this.graphicsPath = "";
        this.configFileURL = "";
        this.rootPath = "";
        this.responsiveBaseWidth = 0;
        this.responsiveBaseHeight = 0;
        this.viewWidthJQFix = 0;
        this.viewHeightJQFix = 0;
        this.toolbarWidthJQFix = 0;
        this.zIndexLayersOn = true;
        this.qs =- 1;
        this.rf =- 1;
        this.qJ =- 1;
        this.imageViewportHeight =- 1;
        this.fullScreenOnClick = false;
        this.apiReadyCallback = null;
        this.version = "";
        this.i18n = new WR360.nX;
    };
    WR360.Events = function () {};
    WR360.Events.gM = "SET_HOTSPOTS_ON";
    WR360.Events.gY = "SET_HOTSPOTS_OFF";
    WR360.Events.hG = "HIDE_ROLLOVER";
    WR360.Events.mA = "IR_STOP_PLAYBACK";
    WR360.Events.LOADED = "IR_LOADED";
    WR360.hI = function ()
    {
        this.ed = true;
        this.js = true;
        this.hk = false;
        this.gD = true;
    };
    WR360.hI.lD = function ()
    {
        var ez = new WR360.hI;
        ez.ed = false;
        ez.js = false;
        ez.hk = false;
        ez.gD = false;
        return ez;
    };
    WR360.lC = function ()
    {
        this.ew = [];
    };
    WR360.lC.prototype = 
    {
        constructor : WR360.lC,
        add : function (rotator)
        {
            if (!(rotator instanceof WR360.ImageRotator)) {
                throw new Error("Added object is not an ImageRotator object.");
            }
            for (var i = 0, ia = this.ew.length; i < ia; i++) {
                if (this.ew[i] === rotator) {
                    throw new Error("Added ImageRotator already exists.");
                }
            }
            this.ew.push(rotator)
        },
        remove : function (rotator)
        {
            for (var i = 0, ia = this.ew.length; i < ia; i++) {
                if (this.ew[i] === rotator) {
                    this.ew.splice(i, 1);
                    break
                }
            }
        },
        get : function (index)
        {
            if (index < 0 || index > this.ew.length - 1) {
                return null
            }
            else {
                return this.ew[index];
            }
        }
    };
    var lH = new WR360.lC;
})();
var _imageRotator = new WR360.ImageRotator;
(function ()
{
    jQuery.fn.rotator = function (options)
    {
        var oR = jQuery.extend({}, jQuery.fn.rotator.defaults, options);
        return this.each(function ()
        {
            var o = jQuery.metadata ? jQuery.extend({}, oR, jQuery.metadata.get(this)) : oR;
            qu(this, o)
        })
    };
    function qu(qd, oR)
    {
        var cR = qd.attributes.id.value;
        if (cR == null || (typeof cR).toString().toLowerCase() != "string" || cR.length == 0) {
            throw new Error("Can't get Player ID from the jQuery selected element.");
        }
        var ir = WR360.ImageRotator.Create(cR);
        if (ir == null) {
            return
        }
        ir.licenseFileURL = oR.licenseFileURL;
        ir.settings.graphicsPath = oR.graphicsPath;
        ir.settings.configFileURL = oR.configFileURL;
        ir.settings.rootPath = oR.rootPath;
        ir.settings.responsiveBaseWidth = oR.responsiveBaseWidth;
        ir.settings.responsiveBaseHeight = oR.responsiveBaseHeight;
        ir.settings.viewWidthJQFix = oR.viewWidthJQFix;
        ir.settings.viewHeightJQFix = oR.viewHeightJQFix;
        ir.settings.toolbarWidthJQFix = oR.toolbarWidthJQFix;
        ir.settings.zIndexLayersOn = oR.zIndexLayersOn;
        ir.settings.qs = oR.qs;
        ir.settings.rf = oR.rf;
        ir.settings.qJ = oR.qJ;
        ir.settings.imageViewportHeight = oR.imageViewportHeight;
        ir.settings.i18n = oR.i18n;
        ir.settings.fullScreenOnClick = oR.fullScreenOnClick;
        ir.settings.apiReadyCallback = oR.apiReadyCallback;
        if (ir.qC) {
            ir.qC(oR.configFileFullScreenURL)
        }
        ir.runImageRotator()
    }
    jQuery.fn.rotator.defaults = 
    {
        licenseFileURL : "license.lic", graphicsPath : "", configFileURL : "", configFileFullScreenURL : "", 
        rootPath : "", responsiveBaseWidth : 0, responsiveBaseHeight : 0, viewWidthJQFix : 0, viewHeightJQFix : 0, 
        toolbarWidthJQFix : 0, zIndexLayersOn : true, qs :- 1, rf :- 1, qJ :- 1, imageViewportHeight :- 1, 
        fullScreenOnClick : false, i18n : new WR360.nX, apiReadyCallback : null
    }
})();
(function ()
{
    var c = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
    var d = window.ac = {};
    var a = d.fk = 
    {
        iv : function (h, g)
        {
            return h << g | h >>> 32 - g;
        },
        om : function (h, g)
        {
            return h << 32 - g | h >>> g;
        },
        endian : function (h)
        {
            if (h.constructor == Number) {
                return a.iv(h, 8) & 16711935 | a.iv(h, 24) & 4278255360
            }
            for (var g = 0; g < h.length; g++) {
                h[g] = a.endian(h[g])
            }
            return h;
        },
        mw : function (h)
        {
            for (var g = []; h > 0; h--) {
                g.push(Math.floor(Math.random() * 256))
            }
            return g;
        },
        ar : function (h)
        {
            for (var k = [], j = 0, g = 0; j < h.length; j++, g += 8) {
                k[g >>> 5] |= h[j] << 24 - g % 32
            }
            return k;
        },
        iP : function (i)
        {
            for (var h = [], g = 0; g < i.length * 32; g += 8) {
                h.push(i[g >>> 5] >>> 24 - g % 32 & 255)
            }
            return h;
        },
        aZ : function (g)
        {
            for (var j = [], h = 0; h < g.length; h++) {
                j.push((g[h] >>> 4).toString(16));
                j.push((g[h] & 15).toString(16))
            }
            return j.join("");
        },
        oI : function (h)
        {
            for (var g = [], i = 0; i < h.length; i += 2) {
                g.push(parseInt(h.substr(i, 2), 16))
            }
            return g;
        },
        aJ : function (h)
        {
            if (typeof btoa == "function")
            {
                return btoa(e.T(h))
            }
            for (var g = [], l = 0; l < h.length; l += 3)
            {
                var m = h[l] << 16 | h[l + 1] << 8 | h[l + 2];
                for (var k = 0; k < 4; k++) {
                    if (l * 8 + k * 6 <= h.length * 8) {
                        g.push(c.charAt(m >>> 6 * (3 - k) & 63))
                    }
                    else {
                        g.push("=")
                    }
                }
            }
            return g.join("");
        },
        bL : function (h)
        {
            if (typeof atob == "function")
            {
                return e.de(atob(h))
            }
            h = h.replace(/[^A-Z0-9+\/]/gi, "");
            for (var g = [], j = 0, k = 0; j < h.length; k =++j % 4)
            {
                if (k == 0) {
                    continue
                }
                g.push((c.indexOf(h.charAt(j - 1)) & Math.pow(2, - 2 * k + 8) - 1) << k * 2 | c.indexOf(h.charAt(j)) >>> 6 - k * 2)
            }
            return g;
        }
    };
    d.mode = {};
    var b = d.charenc = {};
    var f = b.UTF8 = 
    {
        de : function (g)
        {
            return e.de(unescape(encodeURIComponent(g)));
        },
        T : function (g)
        {
            return decodeURIComponent(escape(e.T(g)));
        }
    };
    var e = b.Binary = 
    {
        de : function (j)
        {
            for (var g = [], h = 0; h < j.length; h++) {
                g.push(j.charCodeAt(h))
            }
            return g;
        },
        T : function (g)
        {
            for (var j = [], h = 0; h < g.length; h++) {
                j.push(String.fromCharCode(g[h]))
            }
            return j.join("");
        }
    }
})();
(function ()
{
    var f = ac, a = f.fk, b = f.charenc, e = b.UTF8, d = b.Binary;
    var c = f.SHA1 = function (i, g)
    {
        var h = a.iP(c.mn(i));
        return g && g.asBytes ? h : g && g.asString ? d.T(h) : a.aZ(h);
    };
    c.mn = function (o)
    {
        if (o.constructor == String) {
            o = e.de(o)
        }
        var v = a.ar(o), x = o.length * 8, p = [], r = 1732584193, q =- 271733879, k =- 1732584194, h = 271733878, 
        g =- 1009589776;
        v[x >> 5] |= 128 << 24 - x % 32;
        v[(x + 64 >>> 9 << 4) + 15] = x;
        for (var z = 0; z < v.length; z += 16)
        {
            var E = r, D = q, C = k, B = h, A = g;
            for (var y = 0; y < 80; y++)
            {
                if (y < 16) {
                    p[y] = v[z + y]
                }
                else {
                    var u = p[y - 3]^p[y - 8]^p[y - 14]^p[y - 16];
                    p[y] = u << 1 | u >>> 31
                }
                var s = (r << 5 | r >>> 27) + g + (p[y] >>> 0) + (y < 20 ? (q & k | ~q & h) + 1518500249 : y < 40 ? (q^k^h) + 1859775393 : y < 60 ? (q & k | q & h | k & h) - 1894007588 : (q^k^h) - 899497514);
                g = h;
                h = k;
                k = q << 30 | q >>> 2;
                q = r;
                r = s
            }
            r += E;
            q += D;
            k += C;
            h += B;
            g += A
        }
        return [r, q, k, h, g];
    };
    c.dB = 16;
})();
(function ()
{
    var e = ac, a = e.fk, b = e.charenc, d = b.UTF8, c = b.Binary;
    e.HMAC = function (l, m, k, h)
    {
        if (m.constructor == String) {
            m = d.de(m)
        }
        if (k.constructor == String) {
            k = d.de(k)
        }
        if (k.length > l.dB * 4) {
            k = l(k, {
                asBytes : true
            })
        }
        var g = k.slice(0), n = k.slice(0);
        for (var j = 0; j < l.dB * 4; j++) {
            g[j]^ = 92;
            n[j]^ = 54
        }
        var f = l(g.concat(l(n.concat(m), {
            asBytes : true
        })), {
            asBytes : true
        });
        return h && h.asBytes ? f : h && h.asString ? c.T(f) : a.aZ(f);
    }
})();
function getBrowserId(t, k)
{
    var kb = ac.fk.bL(k);
    return ac.G.aD(t, kb)
}
(function ()
{
    var e = ac, a = e.fk, b = e.charenc, d = b.UTF8, c = b.Binary;
    e.PBKDF2 = function (q, o, f, t)
    {
        if (q.constructor == String) {
            q = d.de(q)
        }
        if (o.constructor == String) {
            o = d.de(o)
        }
        var s = t && t.hasher || e.SHA1, k = t && t.iterations || 1;
        function p(i, j)
        {
            return e.HMAC(s, j, i, 
            {
                asBytes : true
            })
        }
        var h = [], g = 1;
        while (h.length < f)
        {
            var l = p(q, o.concat(a.iP([g])));
            for (var r = l, n = 1; n < k; n++) {
                r = p(q, r);
                for (var m = 0; m < l.length; m++) {
                    l[m]^ = r[m]
                }
            }
            h = h.concat(l);
            g++
        }
        h.length = f;
        return t && t.asBytes ? h : t && t.asString ? c.T(h) : a.aZ(h);
    }
})();
(function ()
{
    ac.mode.OFB = {
        jc : a, aD : a
    };
    function a(c, b, d)
    {
        var g = c.dB * 4, f = d.slice(0);
        for (var e = 0; e < b.length; e++) {
            if (e % g == 0) {
                c.mX(f, 0)
            }
            b[e]^ = f[e % g]
        }
    }
})();
(function ()
{
    var l = ac, a = l.fk, u = l.charenc, s = u.UTF8, j = u.Binary;
    var v = [99, 124, 119, 123, 242, 107, 111, 197, 48, 1, 103, 43, 254, 215, 171, 118, 202, 130, 201, 
    125, 250, 89, 71, 240, 173, 212, 162, 175, 156, 164, 114, 192, 183, 253, 147, 38, 54, 63, 247, 204, 
    52, 165, 229, 241, 113, 216, 49, 21, 4, 199, 35, 195, 24, 150, 5, 154, 7, 18, 128, 226, 235, 39, 178, 
    117, 9, 131, 44, 26, 27, 110, 90, 160, 82, 59, 214, 179, 41, 227, 47, 132, 83, 209, 0, 237, 32, 252, 
    177, 91, 106, 203, 190, 57, 74, 76, 88, 207, 208, 239, 170, 251, 67, 77, 51, 133, 69, 249, 2, 127, 
    80, 60, 159, 168, 81, 163, 64, 143, 146, 157, 56, 245, 188, 182, 218, 33, 16, 255, 243, 210, 205, 
    12, 19, 236, 95, 151, 68, 23, 196, 167, 126, 61, 100, 93, 25, 115, 96, 129, 79, 220, 34, 42, 144, 
    136, 70, 238, 184, 20, 222, 94, 11, 219, 224, 50, 58, 10, 73, 6, 36, 92, 194, 211, 172, 98, 145, 149, 
    228, 121, 231, 200, 55, 109, 141, 213, 78, 169, 108, 86, 244, 234, 101, 122, 174, 8, 186, 120, 37, 
    46, 28, 166, 180, 198, 232, 221, 116, 31, 75, 189, 139, 138, 112, 62, 181, 102, 72, 3, 246, 14, 97, 
    53, 87, 185, 134, 193, 29, 158, 225, 248, 152, 17, 105, 217, 142, 148, 155, 30, 135, 233, 206, 85, 
    40, 223, 140, 161, 137, 13, 191, 230, 66, 104, 65, 153, 45, 15, 176, 84, 187, 22];
    for (var n = [], r = 0; r < 256; r++) {
        n[v[r]] = r
    }
    var q = [], p = [], m = [], h = [], g = [], e = [];
    function f(y, x)
    {
        for (var w = 0, z = 0; z < 8; z++) {
            if (x & 1) {
                w^ = y
            }
            var A = y & 128;
            y = y << 1 & 255;
            if (A) {
                y^ = 27
            }
            x >>>= 1
        }
        return w
    }
    for (var r = 0; r < 256; r++) {
        q[r] = f(r, 2);
        p[r] = f(r, 3);
        m[r] = f(r, 9);
        h[r] = f(r, 11);
        g[r] = f(r, 13);
        e[r] = f(r, 14)
    }
    var k = [0, 1, 2, 4, 8, 16, 32, 64, 128, 27, 54];
    var c = [[], [], [], []], d, b, t;
    var o = l.G = 
    {
        jc : function (A, z, y)
        {
            var i = s.de(A), x = a.mw(o.dB * 4), w = z.constructor == String ? l.PBKDF2(z, x, 32, {
                asBytes : true
            }) : z;
            mode = y && y.mode || l.mode.OFB;
            o.jC(w);
            mode.jc(o, i, x);
            return a.aJ(x.concat(i));
        },
        aD : function (z, y, x)
        {
            var A = a.bL(z), w = A.splice(0, o.dB * 4), i = y.constructor == String ? l.PBKDF2(y, w, 32, 
            {
                asBytes : true
            }) : y;
            mode = x && x.mode || l.mode.OFB;
            o.jC(i);
            mode.aD(o, A, w);
            return s.T(A);
        },
        dB : 4,
        mX : function (w, x)
        {
            for (var D = 0; D < o.dB; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i] = w[x + i * 4 + D];
                }
            }
            for (var D = 0; D < 4; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i]^ = t[i][D]
                }
            }
            for (var C = 1; C < b; C++)
            {
                for (var D = 0; D < 4; D++) {
                    for (var i = 0; i < 4; i++) {
                        c[D][i] = v[c[D][i]];
                    }
                }
                c[1].push(c[1].shift());
                c[2].push(c[2].shift());
                c[2].push(c[2].shift());
                c[3].unshift(c[3].pop());
                for (var i = 0; i < 4; i++)
                {
                    var B = c[0][i], A = c[1][i], z = c[2][i], y = c[3][i];
                    c[0][i] = q[B]^p[A]^z^y;
                    c[1][i] = B^q[A]^p[z]^y;
                    c[2][i] = B^A^q[z]^p[y];
                    c[3][i] = p[B]^A^z^q[y]
                }
                for (var D = 0; D < 4; D++) {
                    for (var i = 0; i < 4; i++) {
                        c[D][i]^ = t[C * 4 + i][D]
                    }
                }
            }
            for (var D = 0; D < 4; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i] = v[c[D][i]];
                }
            }
            c[1].push(c[1].shift());
            c[2].push(c[2].shift());
            c[2].push(c[2].shift());
            c[3].unshift(c[3].pop());
            for (var D = 0; D < 4; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i]^ = t[b * 4 + i][D]
                }
            }
            for (var D = 0; D < o.dB; D++) {
                for (var i = 0; i < 4; i++) {
                    w[x + i * 4 + D] = c[D][i];
                }
            }
        },
        oE : function (x, w)
        {
            for (var D = 0; D < o.dB; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i] = x[w + i * 4 + D];
                }
            }
            for (var D = 0; D < 4; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i]^ = t[b * 4 + i][D]
                }
            }
            for (var C = 1; C < b; C++)
            {
                c[1].unshift(c[1].pop());
                c[2].push(c[2].shift());
                c[2].push(c[2].shift());
                c[3].push(c[3].shift());
                for (var D = 0; D < 4; D++) {
                    for (var i = 0; i < 4; i++) {
                        c[D][i] = n[c[D][i]];
                    }
                }
                for (var D = 0; D < 4; D++) {
                    for (var i = 0; i < 4; i++) {
                        c[D][i]^ = t[(b - C) * 4 + i][D]
                    }
                }
                for (var i = 0; i < 4; i++)
                {
                    var B = c[0][i], A = c[1][i], z = c[2][i], y = c[3][i];
                    c[0][i] = e[B]^h[A]^g[z]^m[y];
                    c[1][i] = m[B]^e[A]^h[z]^g[y];
                    c[2][i] = g[B]^m[A]^e[z]^h[y];
                    c[3][i] = h[B]^g[A]^m[z]^e[y];
                }
            }
            c[1].unshift(c[1].pop());
            c[2].push(c[2].shift());
            c[2].push(c[2].shift());
            c[3].push(c[3].shift());
            for (var D = 0; D < 4; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i] = n[c[D][i]];
                }
            }
            for (var D = 0; D < 4; D++) {
                for (var i = 0; i < 4; i++) {
                    c[D][i]^ = t[i][D]
                }
            }
            for (var D = 0; D < o.dB; D++) {
                for (var i = 0; i < 4; i++) {
                    x[w + i * 4 + D] = c[D][i];
                }
            }
        },
        jC : function (i)
        {
            d = i.length / 4;
            b = d + 6;
            o.ni(i)
        },
        ni : function (w)
        {
            t = [];
            for (var x = 0; x < d; x++) {
                t[x] = [w[x * 4], w[x * 4 + 1], w[x * 4 + 2], w[x * 4 + 3]]
            }
            for (var x = d; x < o.dB * (b + 1); x++)
            {
                var i = [t[x - 1][0], t[x - 1][1], t[x - 1][2], t[x - 1][3]];
                if (x % d == 0)
                {
                    i.push(i.shift());
                    i[0] = v[i[0]];
                    i[1] = v[i[1]];
                    i[2] = v[i[2]];
                    i[3] = v[i[3]];
                    i[0]^ = k[x / d]
                }
                else {
                    if (d > 6 && x % d == 4) {
                        i[0] = v[i[0]];
                        i[1] = v[i[1]];
                        i[2] = v[i[2]];
                        i[3] = v[i[3]];
                    }
                }
                t[x] = [t[x - d][0]^i[0], t[x - d][1]^i[1], t[x - d][2]^i[2], t[x - d][3]^i[3]];
            }
        }
    }
})();
(function ()
{
    WR360.ImageRotator.prototype.jL = function (gh, e, target)
    {
        var aX = true;
        if (this.R) {
            return
        }
        if (!this.dn) {
            this.kX(this.mJ(), aX, gh, e, target)
        }
        else {
            this.kI(aX)
        }
    };
    WR360.ImageRotator.prototype.kX = function (ratio, aX, gh, e, target)
    {
        var fz = 300;
        if (!this.dn)
        {
            var deltaX = 0;
            var deltaY = 0;
            var hJ = false;
            var af = this.bU.aw[this.bV.aF];
            if (af.image.cS != null) {
                this.lz();
                hJ = true
            }
            if (this.bA.settings.control.hideHotspotsOnZoom) {
                this.lz()
            }
            var gd = this.aU['_viewPort.x'] - (this.aU['_viewPort.width'] * ratio - this.aU['_viewPort.width']) / 2 + deltaX;
            var ho = this.aU['_viewPort.y'] - (this.aU['_viewPort.height'] * ratio - this.aU['_viewPort.height']) / 2 + deltaY;
            var dC = this.aU['_viewPort.width'] * ratio;
            var cK = this.aU['_viewPort.height'] * ratio;
            if (!aX)
            {
                this.bV.aG.css("margin-left", gd);
                this.bV.aG.css("margin-top", ho);
                this.bV.aG.css("width", dC);
                this.bV.aG.css("height", cK);
                this.bV.aG.css("left", 0);
                this.bV.aG.css("top", 0);
                this.eL.eY =- (dC - this.fm);
                this.eL.ev =- (cK - this.fJ);
                this.eL.fd = 0;
                this.eL.fM = 0;
                this.qY = false;
                this.dn = true;
                this.dN.as(true);
                if (hJ) {
                    this.fK(deltaX, deltaY)
                }
                this.bV.fP()
            }
            else
            {
                this.bV.aG.animate({
                    marginLeft : gd, marginTop : ho, width : dC, height : cK, left : 0, top : 0
                },
                fz, jQuery.proxy(function ()
                {
                    if (this.fm - dC < 0) {
                        this.eL.eY = this.fm - dC;
                        this.eL.fd = 0
                    }
                    else {
                        this.eL.eY = 0;
                        this.eL.fd = this.fm - dC
                    }
                    if (this.fJ - cK < 0) {
                        this.eL.ev = this.fJ - cK;
                        this.eL.fM = 0
                    }
                    else {
                        this.eL.ev = 0;
                        this.eL.fM = this.fJ - cK
                    }
                    this.dn = true;
                    this.dN.as(true);
                    if (hJ) {
                        this.fK(deltaX, deltaY)
                    }
                    this.bV.fP();
                    this.R = false;
                }, this));
                this.bV.kM(fz, this.bV.aG.css("left").aK(), this.bV.aG.css("top").aK(), gd, ho, dC, cK);
                this.R = true;
                this.qY = false;
            }
        }
    };
    WR360.ImageRotator.prototype.kI = function (aX)
    {
        var fz = 300;
        if (this.dn)
        {
            this.bV.aS(null);
            this.bV.en = false;
            this.bV.dE(this.bV.aF);
            if (this.bV.kL != null) {
                this.bV.kL.hide()
            }
            if (!aX)
            {
                this.bV.aG.css("margin-left", this.aU['_viewPort.x']);
                this.bV.aG.css("margin-top", this.aU['_viewPort.y']);
                this.bV.aG.css("width", this.aU['_viewPort.width']);
                this.bV.aG.css("height", this.aU['_viewPort.height']);
                this.bV.aG.css("left", 0);
                this.bV.aG.css("top", 0);
                this.qY = true;
                this.dn = false;
                this.dN.as(false);
                this.iV()
            }
            else
            {
                this.bV.aG.animate(
                {
                    marginLeft : this.aU['_viewPort.x'], marginTop : this.aU['_viewPort.y'], width : this.aU['_viewPort.width'], 
                    height : this.aU['_viewPort.height'], left : 0, top : 0
                },
                fz, jQuery.proxy(function ()
                {
                    this.qY = true;
                    this.dn = false;
                    this.dN.as(false);
                    this.iV();
                    this.R = false;
                }, this));
                this.bV.kM(fz, 0, 0, this.aU['_viewPort.x'], this.aU['_viewPort.y'], this.aU['_viewPort.width'], 
                this.aU['_viewPort.height']);
                this.R = true;
            }
        }
    }
})();
(function ()
{
    WR360.ImageRotator.prototype.getAPI = function ()
    {
        return new WR360.API(this);
    };
    WR360.API = function (L)
    {
        this.toolbar = new WR360.API.Tools(L);
        this.images = new WR360.API.Images(L);
        this.configuration = new WR360.API.Config(L);
        this.L = L;
    };
    WR360.API.prototype.reload = function (configFileURL, rootPath, hZ, reloadImageIndex)
    {
        this.L.reload(configFileURL, rootPath, hZ, reloadImageIndex)
    };
    WR360.API.Tools = function (L)
    {
        this.L = L;
    };
    WR360.API.Tools.prototype.zoomToggle = function ()
    {
        this.L.mt()
    };
    WR360.API.Tools.prototype.hotspotToggle = function ()
    {
        this.L.mf()
    };
    WR360.API.Tools.prototype.openFullScreen = function ()
    {
        this.L.rc(null)
    };
    WR360.API.Tools.prototype.playbackToggle = function ()
    {
        if (this.L.pY == true) {
            this.L.mp()
        }
        else {
            this.L.mR()
        }
    };
    WR360.API.Tools.prototype.playbackStop = function ()
    {
        this.L.mp()
    };
    WR360.API.Tools.prototype.playbackStart = function ()
    {
        this.L.mp();
        this.L.mR()
    };
    WR360.API.Tools.prototype.startLeftArrowRotate = function ()
    {
        this.L.mp();
        this.L.np()
    };
    WR360.API.Tools.prototype.startRightArrowRotate = function ()
    {
        this.L.mp();
        this.L.nv()
    };
    WR360.API.Tools.prototype.stopArrowRotate = function ()
    {
        this.L.co()
    };
    WR360.API.Images = function (L)
    {
        this.L = L;
    };
    WR360.API.Images.prototype.getTotalImageCount = function ()
    {
        return this.L.bV.bU.aw.length - 1;
    };
    WR360.API.Images.prototype.getCurrentImageIndex = function ()
    {
        return this.L.bV.ob();
    };
    WR360.API.Images.prototype.showImageByIndex = function (index)
    {
        this.L.bV.dE(index)
    };
    WR360.API.Images.prototype.showImageByDelta = function (jG)
    {
        this.L.bV.iG(jG)
    };
    WR360.API.Images.prototype.playToLabel = function (label, period, hZ)
    {
        this.L.bV.qB(label, period, hZ)
    };
    WR360.API.Images.prototype.jumpToLabel = function (label)
    {
        this.L.bV.qo(label)
    };
    WR360.API.Config = function (L)
    {
        this.L = L;
    }
})();