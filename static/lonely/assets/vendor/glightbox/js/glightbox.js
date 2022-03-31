(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, global.GLightbox = factory());
}(this, (function () { 'use strict';

  function _typeof(obj) {
    "@babel/helpers - typeof";

    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
      _typeof = function (obj) {
        return typeof obj;
  ***REMOVED***;
***REMOVED*** else {
      _typeof = function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
  ***REMOVED***;
***REMOVED***

    return _typeof(obj);
  }

  function _classCallCheck(instance, Constructor) {
    if (!(instance instanceof Constructor)) {
      throw new TypeError("Cannot call a class as a function");
***REMOVED***
  }

  function _defineProperties(target, props) {
    for (var i = 0; i < props.length; i++) {
      var descriptor = props[i***REMOVED***;
      descriptor.enumerable = descriptor.enumerable || false;
      descriptor.configurable = true;
      if ("value" in descriptor) descriptor.writable = true;
      Object.defineProperty(target, descriptor.key, descriptor);
***REMOVED***
  }

  function _createClass(Constructor, protoProps, staticProps) {
    if (protoProps) _defineProperties(Constructor.prototype, protoProps);
    if (staticProps) _defineProperties(Constructor, staticProps);
    return Constructor;
  }

  var uid = Date.now();
  function extend() {
    var extended = {};
    var deep = true;
    var i = 0;
    var length = arguments.length;

    if (Object.prototype.toString.call(arguments[0***REMOVED***) === '[object Boolean***REMOVED***') {
      deep = arguments[0***REMOVED***;
      i++;
***REMOVED***

    var merge = function merge(obj) {
      for (var prop in obj) {
        if (Object.prototype.hasOwnProperty.call(obj, prop)) {
          if (deep && Object.prototype.toString.call(obj[prop***REMOVED***) === '[object Object***REMOVED***') {
            extended[prop***REMOVED*** = extend(true, extended[prop***REMOVED***, obj[prop***REMOVED***);
      ***REMOVED*** else {
            extended[prop***REMOVED*** = obj[prop***REMOVED***;
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED***;

    for (; i < length; i++) {
      var obj = arguments[i***REMOVED***;
      merge(obj);
***REMOVED***

    return extended;
  }
  function each(collection, callback) {
    if (isNode(collection) || collection === window || collection === document) {
      collection = [collection***REMOVED***;
***REMOVED***

    if (!isArrayLike(collection) && !isObject(collection)) {
      collection = [collection***REMOVED***;
***REMOVED***

    if (size(collection) == 0) {
      return;
***REMOVED***

    if (isArrayLike(collection) && !isObject(collection)) {
      var l = collection.length,
          i = 0;

      for (; i < l; i++) {
        if (callback.call(collection[i***REMOVED***, collection[i***REMOVED***, i, collection) === false) {
          break;
    ***REMOVED***
  ***REMOVED***
***REMOVED*** else if (isObject(collection)) {
      for (var key in collection) {
        if (has(collection, key)) {
          if (callback.call(collection[key***REMOVED***, collection[key***REMOVED***, key, collection) === false) {
            break;
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED***
  }
  function getNodeEvents(node) {
    var name = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : null;
    var fn = arguments.length > 2 && arguments[2***REMOVED*** !== undefined ? arguments[2***REMOVED*** : null;
    var cache = node[uid***REMOVED*** = node[uid***REMOVED*** || [***REMOVED***;
    var data = {
      all: cache,
      evt: null,
      found: null
***REMOVED***;

    if (name && fn && size(cache) > 0) {
      each(cache, function (cl, i) {
        if (cl.eventName == name && cl.fn.toString() == fn.toString()) {
          data.found = true;
          data.evt = i;
          return false;
    ***REMOVED***
  ***REMOVED***);
***REMOVED***

    return data;
  }
  function addEvent(eventName) {
    var _ref = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : {},
        onElement = _ref.onElement,
        withCallback = _ref.withCallback,
        _ref$avoidDuplicate = _ref.avoidDuplicate,
        avoidDuplicate = _ref$avoidDuplicate === void 0 ? true : _ref$avoidDuplicate,
        _ref$once = _ref.once,
        once = _ref$once === void 0 ? false : _ref$once,
        _ref$useCapture = _ref.useCapture,
        useCapture = _ref$useCapture === void 0 ? false : _ref$useCapture;

    var thisArg = arguments.length > 2 ? arguments[2***REMOVED*** : undefined;
    var element = onElement || [***REMOVED***;

    if (isString(element)) {
      element = document.querySelectorAll(element);
***REMOVED***

    function handler(event) {
      if (isFunction(withCallback)) {
        withCallback.call(thisArg, event, this);
  ***REMOVED***

      if (once) {
        handler.destroy();
  ***REMOVED***
***REMOVED***

    handler.destroy = function () {
      each(element, function (el) {
        var events = getNodeEvents(el, eventName, handler);

        if (events.found) {
          events.all.splice(events.evt, 1);
    ***REMOVED***

        if (el.removeEventListener) {
          el.removeEventListener(eventName, handler, useCapture);
    ***REMOVED***
  ***REMOVED***);
***REMOVED***;

    each(element, function (el) {
      var events = getNodeEvents(el, eventName, handler);

      if (el.addEventListener && avoidDuplicate && !events.found || !avoidDuplicate) {
        el.addEventListener(eventName, handler, useCapture);
        events.all.push({
          eventName: eventName,
          fn: handler
    ***REMOVED***);
  ***REMOVED***
***REMOVED***);
    return handler;
  }
  function addClass(node, name) {
    each(name.split(' '), function (cl) {
      return node.classList.add(cl);
***REMOVED***);
  }
  function removeClass(node, name) {
    each(name.split(' '), function (cl) {
      return node.classList.remove(cl);
***REMOVED***);
  }
  function hasClass(node, name) {
    return node.classList.contains(name);
  }
  function closest(elem, selector) {
    while (elem !== document.body) {
      elem = elem.parentElement;

      if (!elem) {
        return false;
  ***REMOVED***

      var matches = typeof elem.matches == 'function' ? elem.matches(selector) : elem.msMatchesSelector(selector);

      if (matches) {
        return elem;
  ***REMOVED***
***REMOVED***
  }
  function animateElement(element) {
    var animation = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : '';
    var callback = arguments.length > 2 && arguments[2***REMOVED*** !== undefined ? arguments[2***REMOVED*** : false;

    if (!element || animation === '') {
      return false;
***REMOVED***

    if (animation == 'none') {
      if (isFunction(callback)) {
        callback();
  ***REMOVED***

      return false;
***REMOVED***

    var animationEnd = whichAnimationEvent();
    var animationNames = animation.split(' ');
    each(animationNames, function (name) {
      addClass(element, 'g' + name);
***REMOVED***);
    addEvent(animationEnd, {
      onElement: element,
      avoidDuplicate: false,
      once: true,
      withCallback: function withCallback(event, target) {
        each(animationNames, function (name) {
          removeClass(target, 'g' + name);
    ***REMOVED***);

        if (isFunction(callback)) {
          callback();
    ***REMOVED***
  ***REMOVED***
***REMOVED***);
  }
  function cssTransform(node) {
    var translate = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : '';

    if (translate == '') {
      node.style.webkitTransform = '';
      node.style.MozTransform = '';
      node.style.msTransform = '';
      node.style.OTransform = '';
      node.style.transform = '';
      return false;
***REMOVED***

    node.style.webkitTransform = translate;
    node.style.MozTransform = translate;
    node.style.msTransform = translate;
    node.style.OTransform = translate;
    node.style.transform = translate;
  }
  function show(element) {
    element.style.display = 'block';
  }
  function hide(element) {
    element.style.display = 'none';
  }
  function createHTML(htmlStr) {
    var frag = document.createDocumentFragment(),
        temp = document.createElement('div');
    temp.innerHTML = htmlStr;

    while (temp.firstChild) {
      frag.appendChild(temp.firstChild);
***REMOVED***

    return frag;
  }
  function windowSize() {
    return {
      width: window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth,
      height: window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight
***REMOVED***;
  }
  function whichAnimationEvent() {
    var t,
        el = document.createElement('fakeelement');
    var animations = {
      animation: 'animationend',
      OAnimation: 'oAnimationEnd',
      MozAnimation: 'animationend',
      WebkitAnimation: 'webkitAnimationEnd'
***REMOVED***;

    for (t in animations) {
      if (el.style[t***REMOVED*** !== undefined) {
        return animations[t***REMOVED***;
  ***REMOVED***
***REMOVED***
  }
  function whichTransitionEvent() {
    var t,
        el = document.createElement('fakeelement');
    var transitions = {
      transition: 'transitionend',
      OTransition: 'oTransitionEnd',
      MozTransition: 'transitionend',
      WebkitTransition: 'webkitTransitionEnd'
***REMOVED***;

    for (t in transitions) {
      if (el.style[t***REMOVED*** !== undefined) {
        return transitions[t***REMOVED***;
  ***REMOVED***
***REMOVED***
  }
  function createIframe(config) {
    var url = config.url,
        allow = config.allow,
        callback = config.callback,
        appendTo = config.appendTo;
    var iframe = document.createElement('iframe');
    iframe.className = 'vimeo-video gvideo';
    iframe.src = url;
    iframe.style.width = '100%';
    iframe.style.height = '100%';

    if (allow) {
      iframe.setAttribute('allow', allow);
***REMOVED***

    iframe.onload = function () {
      addClass(iframe, 'node-ready');

      if (isFunction(callback)) {
        callback();
  ***REMOVED***
***REMOVED***;

    if (appendTo) {
      appendTo.appendChild(iframe);
***REMOVED***

    return iframe;
  }
  function waitUntil(check, onComplete, delay, timeout) {
    if (check()) {
      onComplete();
      return;
***REMOVED***

    if (!delay) {
      delay = 100;
***REMOVED***

    var timeoutPointer;
    var intervalPointer = setInterval(function () {
      if (!check()) {
        return;
  ***REMOVED***

      clearInterval(intervalPointer);

      if (timeoutPointer) {
        clearTimeout(timeoutPointer);
  ***REMOVED***

      onComplete();
***REMOVED*** delay);

    if (timeout) {
      timeoutPointer = setTimeout(function () {
        clearInterval(intervalPointer);
  ***REMOVED*** timeout);
***REMOVED***
  }
  function injectAssets(url, waitFor, callback) {
    if (isNil(url)) {
      console.error('Inject assets error');
      return;
***REMOVED***

    if (isFunction(waitFor)) {
      callback = waitFor;
      waitFor = false;
***REMOVED***

    if (isString(waitFor) && waitFor in window) {
      if (isFunction(callback)) {
        callback();
  ***REMOVED***

      return;
***REMOVED***

    var found;

    if (url.indexOf('.css') !== -1) {
      found = document.querySelectorAll('link[href="' + url + '"***REMOVED***');

      if (found && found.length > 0) {
        if (isFunction(callback)) {
          callback();
    ***REMOVED***

        return;
  ***REMOVED***

      var head = document.getElementsByTagName('head')[0***REMOVED***;
      var headStyles = head.querySelectorAll('link[rel="stylesheet"***REMOVED***');
      var link = document.createElement('link');
      link.rel = 'stylesheet';
      link.type = 'text/css';
      link.href = url;
      link.media = 'all';

      if (headStyles) {
        head.insertBefore(link, headStyles[0***REMOVED***);
  ***REMOVED*** else {
        head.appendChild(link);
  ***REMOVED***

      if (isFunction(callback)) {
        callback();
  ***REMOVED***

      return;
***REMOVED***

    found = document.querySelectorAll('script[src="' + url + '"***REMOVED***');

    if (found && found.length > 0) {
      if (isFunction(callback)) {
        if (isString(waitFor)) {
          waitUntil(function () {
            return typeof window[waitFor***REMOVED*** !== 'undefined';
  ***REMOVED*** function () {
            callback();
      ***REMOVED***);
          return false;
    ***REMOVED***

        callback();
  ***REMOVED***

      return;
***REMOVED***

    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = url;

    script.onload = function () {
      if (isFunction(callback)) {
        if (isString(waitFor)) {
          waitUntil(function () {
            return typeof window[waitFor***REMOVED*** !== 'undefined';
  ***REMOVED*** function () {
            callback();
      ***REMOVED***);
          return false;
    ***REMOVED***

        callback();
  ***REMOVED***
***REMOVED***;

    document.body.appendChild(script);
    return;
  }
  function isMobile() {
    return 'navigator' in window && window.navigator.userAgent.match(/(iPad)|(iPhone)|(iPod)|(Android)|(PlayBook)|(BB10)|(BlackBerry)|(Opera Mini)|(IEMobile)|(webOS)|(MeeGo)/i);
  }
  function isTouch() {
    return isMobile() !== null || document.createTouch !== undefined || 'ontouchstart' in window || 'onmsgesturechange' in window || navigator.msMaxTouchPoints;
  }
  function isFunction(f) {
    return typeof f === 'function';
  }
  function isString(s) {
    return typeof s === 'string';
  }
  function isNode(el) {
    return !!(el && el.nodeType && el.nodeType == 1);
  }
  function isArray(ar) {
    return Array.isArray(ar);
  }
  function isArrayLike(ar) {
    return ar && ar.length && isFinite(ar.length);
  }
  function isObject(o) {
    var type = _typeof(o);

    return type === 'object' && o != null && !isFunction(o) && !isArray(o);
  }
  function isNil(o) {
    return o == null;
  }
  function has(obj, key) {
    return obj !== null && hasOwnProperty.call(obj, key);
  }
  function size(o) {
    if (isObject(o)) {
      if (o.keys) {
        return o.keys().length;
  ***REMOVED***

      var l = 0;

      for (var k in o) {
        if (has(o, k)) {
          l++;
    ***REMOVED***
  ***REMOVED***

      return l;
***REMOVED*** else {
      return o.length;
***REMOVED***
  }
  function isNumber(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
  }

  function getNextFocusElement() {
    var current = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : -1;
    var btns = document.querySelectorAll('.gbtn[data-taborder***REMOVED***:not(.disabled)');

    if (!btns.length) {
      return false;
***REMOVED***

    if (btns.length == 1) {
      return btns[0***REMOVED***;
***REMOVED***

    if (typeof current == 'string') {
      current = parseInt(current);
***REMOVED***

    var newIndex = current < 0 ? 1 : current + 1;

    if (newIndex > btns.length) {
      newIndex = '1';
***REMOVED***

    var orders = [***REMOVED***;
    each(btns, function (btn) {
      orders.push(btn.getAttribute('data-taborder'));
***REMOVED***);
    var nextOrders = orders.filter(function (el) {
      return el >= parseInt(newIndex);
***REMOVED***);
    var nextFocus = nextOrders.sort()[0***REMOVED***;
    return document.querySelector(".gbtn[data-taborder=\"".concat(nextFocus, "\"***REMOVED***"));
  }

  function keyboardNavigation(instance) {
    if (instance.events.hasOwnProperty('keyboard')) {
      return false;
***REMOVED***

    instance.events['keyboard'***REMOVED*** = addEvent('keydown', {
      onElement: window,
      withCallback: function withCallback(event, target) {
        event = event || window.event;
        var key = event.keyCode;

        if (key == 9) {
          var focusedButton = document.querySelector('.gbtn.focused');

          if (!focusedButton) {
            var activeElement = document.activeElement && document.activeElement.nodeName ? document.activeElement.nodeName.toLocaleLowerCase() : false;

            if (activeElement == 'input' || activeElement == 'textarea' || activeElement == 'button') {
              return;
        ***REMOVED***
      ***REMOVED***

          event.preventDefault();
          var btns = document.querySelectorAll('.gbtn[data-taborder***REMOVED***');

          if (!btns || btns.length <= 0) {
            return;
      ***REMOVED***

          if (!focusedButton) {
            var first = getNextFocusElement();

            if (first) {
              first.focus();
              addClass(first, 'focused');
        ***REMOVED***

            return;
      ***REMOVED***

          var currentFocusOrder = focusedButton.getAttribute('data-taborder');
          var nextFocus = getNextFocusElement(currentFocusOrder);
          removeClass(focusedButton, 'focused');

          if (nextFocus) {
            nextFocus.focus();
            addClass(nextFocus, 'focused');
      ***REMOVED***
    ***REMOVED***

        if (key == 39) {
          instance.nextSlide();
    ***REMOVED***

        if (key == 37) {
          instance.prevSlide();
    ***REMOVED***

        if (key == 27) {
          instance.close();
    ***REMOVED***
  ***REMOVED***
***REMOVED***);
  }

  function getLen(v) {
    return Math.sqrt(v.x * v.x + v.y * v.y);
  }

  function dot(v1, v2) {
    return v1.x * v2.x + v1.y * v2.y;
  }

  function getAngle(v1, v2) {
    var mr = getLen(v1) * getLen(v2);

    if (mr === 0) {
      return 0;
***REMOVED***

    var r = dot(v1, v2) / mr;

    if (r > 1) {
      r = 1;
***REMOVED***

    return Math.acos(r);
  }

  function cross(v1, v2) {
    return v1.x * v2.y - v2.x * v1.y;
  }

  function getRotateAngle(v1, v2) {
    var angle = getAngle(v1, v2);

    if (cross(v1, v2) > 0) {
      angle *= -1;
***REMOVED***

    return angle * 180 / Math.PI;
  }

  var EventsHandlerAdmin = function () {
    function EventsHandlerAdmin(el) {
      _classCallCheck(this, EventsHandlerAdmin);

      this.handlers = [***REMOVED***;
      this.el = el;
***REMOVED***

    _createClass(EventsHandlerAdmin, [{
      key: "add",
      value: function add(handler) {
        this.handlers.push(handler);
  ***REMOVED***
***REMOVED*** {
      key: "del",
      value: function del(handler) {
        if (!handler) {
          this.handlers = [***REMOVED***;
    ***REMOVED***

        for (var i = this.handlers.length; i >= 0; i--) {
          if (this.handlers[i***REMOVED*** === handler) {
            this.handlers.splice(i, 1);
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "dispatch",
      value: function dispatch() {
        for (var i = 0, len = this.handlers.length; i < len; i++) {
          var handler = this.handlers[i***REMOVED***;

          if (typeof handler === 'function') {
            handler.apply(this.el, arguments);
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED******REMOVED***);

    return EventsHandlerAdmin;
  }();

  function wrapFunc(el, handler) {
    var EventshandlerAdmin = new EventsHandlerAdmin(el);
    EventshandlerAdmin.add(handler);
    return EventshandlerAdmin;
  }

  var TouchEvents = function () {
    function TouchEvents(el, option) {
      _classCallCheck(this, TouchEvents);

      this.element = typeof el == 'string' ? document.querySelector(el) : el;
      this.start = this.start.bind(this);
      this.move = this.move.bind(this);
      this.end = this.end.bind(this);
      this.cancel = this.cancel.bind(this);
      this.element.addEventListener('touchstart', this.start, false);
      this.element.addEventListener('touchmove', this.move, false);
      this.element.addEventListener('touchend', this.end, false);
      this.element.addEventListener('touchcancel', this.cancel, false);
      this.preV = {
        x: null,
        y: null
  ***REMOVED***;
      this.pinchStartLen = null;
      this.zoom = 1;
      this.isDoubleTap = false;

      var noop = function noop() {};

      this.rotate = wrapFunc(this.element, option.rotate || noop);
      this.touchStart = wrapFunc(this.element, option.touchStart || noop);
      this.multipointStart = wrapFunc(this.element, option.multipointStart || noop);
      this.multipointEnd = wrapFunc(this.element, option.multipointEnd || noop);
      this.pinch = wrapFunc(this.element, option.pinch || noop);
      this.swipe = wrapFunc(this.element, option.swipe || noop);
      this.tap = wrapFunc(this.element, option.tap || noop);
      this.doubleTap = wrapFunc(this.element, option.doubleTap || noop);
      this.longTap = wrapFunc(this.element, option.longTap || noop);
      this.singleTap = wrapFunc(this.element, option.singleTap || noop);
      this.pressMove = wrapFunc(this.element, option.pressMove || noop);
      this.twoFingerPressMove = wrapFunc(this.element, option.twoFingerPressMove || noop);
      this.touchMove = wrapFunc(this.element, option.touchMove || noop);
      this.touchEnd = wrapFunc(this.element, option.touchEnd || noop);
      this.touchCancel = wrapFunc(this.element, option.touchCancel || noop);
      this.translateContainer = this.element;
      this._cancelAllHandler = this.cancelAll.bind(this);
      window.addEventListener('scroll', this._cancelAllHandler);
      this.delta = null;
      this.last = null;
      this.now = null;
      this.tapTimeout = null;
      this.singleTapTimeout = null;
      this.longTapTimeout = null;
      this.swipeTimeout = null;
      this.x1 = this.x2 = this.y1 = this.y2 = null;
      this.preTapPosition = {
        x: null,
        y: null
  ***REMOVED***;
***REMOVED***

    _createClass(TouchEvents, [{
      key: "start",
      value: function start(evt) {
        if (!evt.touches) {
          return;
    ***REMOVED***

        var ignoreDragFor = ['a', 'button', 'input'***REMOVED***;

        if (evt.target && evt.target.nodeName && ignoreDragFor.indexOf(evt.target.nodeName.toLowerCase()) >= 0) {
          console.log('ignore drag for this touched element', evt.target.nodeName.toLowerCase());
          return;
    ***REMOVED***

        this.now = Date.now();
        this.x1 = evt.touches[0***REMOVED***.pageX;
        this.y1 = evt.touches[0***REMOVED***.pageY;
        this.delta = this.now - (this.last || this.now);
        this.touchStart.dispatch(evt, this.element);

        if (this.preTapPosition.x !== null) {
          this.isDoubleTap = this.delta > 0 && this.delta <= 250 && Math.abs(this.preTapPosition.x - this.x1) < 30 && Math.abs(this.preTapPosition.y - this.y1) < 30;

          if (this.isDoubleTap) {
            clearTimeout(this.singleTapTimeout);
      ***REMOVED***
    ***REMOVED***

        this.preTapPosition.x = this.x1;
        this.preTapPosition.y = this.y1;
        this.last = this.now;
        var preV = this.preV,
            len = evt.touches.length;

        if (len > 1) {
          this._cancelLongTap();

          this._cancelSingleTap();

          var v = {
            x: evt.touches[1***REMOVED***.pageX - this.x1,
            y: evt.touches[1***REMOVED***.pageY - this.y1
      ***REMOVED***;
          preV.x = v.x;
          preV.y = v.y;
          this.pinchStartLen = getLen(preV);
          this.multipointStart.dispatch(evt, this.element);
    ***REMOVED***

        this._preventTap = false;
        this.longTapTimeout = setTimeout(function () {
          this.longTap.dispatch(evt, this.element);
          this._preventTap = true;
    ***REMOVED***.bind(this), 750);
  ***REMOVED***
***REMOVED*** {
      key: "move",
      value: function move(evt) {
        if (!evt.touches) {
          return;
    ***REMOVED***

        var preV = this.preV,
            len = evt.touches.length,
            currentX = evt.touches[0***REMOVED***.pageX,
            currentY = evt.touches[0***REMOVED***.pageY;
        this.isDoubleTap = false;

        if (len > 1) {
          var sCurrentX = evt.touches[1***REMOVED***.pageX,
              sCurrentY = evt.touches[1***REMOVED***.pageY;
          var v = {
            x: evt.touches[1***REMOVED***.pageX - currentX,
            y: evt.touches[1***REMOVED***.pageY - currentY
      ***REMOVED***;

          if (preV.x !== null) {
            if (this.pinchStartLen > 0) {
              evt.zoom = getLen(v) / this.pinchStartLen;
              this.pinch.dispatch(evt, this.element);
        ***REMOVED***

            evt.angle = getRotateAngle(v, preV);
            this.rotate.dispatch(evt, this.element);
      ***REMOVED***

          preV.x = v.x;
          preV.y = v.y;

          if (this.x2 !== null && this.sx2 !== null) {
            evt.deltaX = (currentX - this.x2 + sCurrentX - this.sx2) / 2;
            evt.deltaY = (currentY - this.y2 + sCurrentY - this.sy2) / 2;
      ***REMOVED*** else {
            evt.deltaX = 0;
            evt.deltaY = 0;
      ***REMOVED***

          this.twoFingerPressMove.dispatch(evt, this.element);
          this.sx2 = sCurrentX;
          this.sy2 = sCurrentY;
    ***REMOVED*** else {
          if (this.x2 !== null) {
            evt.deltaX = currentX - this.x2;
            evt.deltaY = currentY - this.y2;
            var movedX = Math.abs(this.x1 - this.x2),
                movedY = Math.abs(this.y1 - this.y2);

            if (movedX > 10 || movedY > 10) {
              this._preventTap = true;
        ***REMOVED***
      ***REMOVED*** else {
            evt.deltaX = 0;
            evt.deltaY = 0;
      ***REMOVED***

          this.pressMove.dispatch(evt, this.element);
    ***REMOVED***

        this.touchMove.dispatch(evt, this.element);

        this._cancelLongTap();

        this.x2 = currentX;
        this.y2 = currentY;

        if (len > 1) {
          evt.preventDefault();
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "end",
      value: function end(evt) {
        if (!evt.changedTouches) {
          return;
    ***REMOVED***

        this._cancelLongTap();

        var self = this;

        if (evt.touches.length < 2) {
          this.multipointEnd.dispatch(evt, this.element);
          this.sx2 = this.sy2 = null;
    ***REMOVED***

        if (this.x2 && Math.abs(this.x1 - this.x2) > 30 || this.y2 && Math.abs(this.y1 - this.y2) > 30) {
          evt.direction = this._swipeDirection(this.x1, this.x2, this.y1, this.y2);
          this.swipeTimeout = setTimeout(function () {
            self.swipe.dispatch(evt, self.element);
  ***REMOVED*** 0);
    ***REMOVED*** else {
          this.tapTimeout = setTimeout(function () {
            if (!self._preventTap) {
              self.tap.dispatch(evt, self.element);
        ***REMOVED***

            if (self.isDoubleTap) {
              self.doubleTap.dispatch(evt, self.element);
              self.isDoubleTap = false;
        ***REMOVED***
  ***REMOVED*** 0);

          if (!self.isDoubleTap) {
            self.singleTapTimeout = setTimeout(function () {
              self.singleTap.dispatch(evt, self.element);
    ***REMOVED*** 250);
      ***REMOVED***
    ***REMOVED***

        this.touchEnd.dispatch(evt, this.element);
        this.preV.x = 0;
        this.preV.y = 0;
        this.zoom = 1;
        this.pinchStartLen = null;
        this.x1 = this.x2 = this.y1 = this.y2 = null;
  ***REMOVED***
***REMOVED*** {
      key: "cancelAll",
      value: function cancelAll() {
        this._preventTap = true;
        clearTimeout(this.singleTapTimeout);
        clearTimeout(this.tapTimeout);
        clearTimeout(this.longTapTimeout);
        clearTimeout(this.swipeTimeout);
  ***REMOVED***
***REMOVED*** {
      key: "cancel",
      value: function cancel(evt) {
        this.cancelAll();
        this.touchCancel.dispatch(evt, this.element);
  ***REMOVED***
***REMOVED*** {
      key: "_cancelLongTap",
      value: function _cancelLongTap() {
        clearTimeout(this.longTapTimeout);
  ***REMOVED***
***REMOVED*** {
      key: "_cancelSingleTap",
      value: function _cancelSingleTap() {
        clearTimeout(this.singleTapTimeout);
  ***REMOVED***
***REMOVED*** {
      key: "_swipeDirection",
      value: function _swipeDirection(x1, x2, y1, y2) {
        return Math.abs(x1 - x2) >= Math.abs(y1 - y2) ? x1 - x2 > 0 ? 'Left' : 'Right' : y1 - y2 > 0 ? 'Up' : 'Down';
  ***REMOVED***
***REMOVED*** {
      key: "on",
      value: function on(evt, handler) {
        if (this[evt***REMOVED***) {
          this[evt***REMOVED***.add(handler);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "off",
      value: function off(evt, handler) {
        if (this[evt***REMOVED***) {
          this[evt***REMOVED***.del(handler);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "destroy",
      value: function destroy() {
        if (this.singleTapTimeout) {
          clearTimeout(this.singleTapTimeout);
    ***REMOVED***

        if (this.tapTimeout) {
          clearTimeout(this.tapTimeout);
    ***REMOVED***

        if (this.longTapTimeout) {
          clearTimeout(this.longTapTimeout);
    ***REMOVED***

        if (this.swipeTimeout) {
          clearTimeout(this.swipeTimeout);
    ***REMOVED***

        this.element.removeEventListener('touchstart', this.start);
        this.element.removeEventListener('touchmove', this.move);
        this.element.removeEventListener('touchend', this.end);
        this.element.removeEventListener('touchcancel', this.cancel);
        this.rotate.del();
        this.touchStart.del();
        this.multipointStart.del();
        this.multipointEnd.del();
        this.pinch.del();
        this.swipe.del();
        this.tap.del();
        this.doubleTap.del();
        this.longTap.del();
        this.singleTap.del();
        this.pressMove.del();
        this.twoFingerPressMove.del();
        this.touchMove.del();
        this.touchEnd.del();
        this.touchCancel.del();
        this.preV = this.pinchStartLen = this.zoom = this.isDoubleTap = this.delta = this.last = this.now = this.tapTimeout = this.singleTapTimeout = this.longTapTimeout = this.swipeTimeout = this.x1 = this.x2 = this.y1 = this.y2 = this.preTapPosition = this.rotate = this.touchStart = this.multipointStart = this.multipointEnd = this.pinch = this.swipe = this.tap = this.doubleTap = this.longTap = this.singleTap = this.pressMove = this.touchMove = this.touchEnd = this.touchCancel = this.twoFingerPressMove = null;
        window.removeEventListener('scroll', this._cancelAllHandler);
        return null;
  ***REMOVED***
***REMOVED******REMOVED***);

    return TouchEvents;
  }();

  function resetSlideMove(slide) {
    var transitionEnd = whichTransitionEvent();
    var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    var media = hasClass(slide, 'gslide-media') ? slide : slide.querySelector('.gslide-media');
    var container = closest(media, '.ginner-container');
    var desc = slide.querySelector('.gslide-description');

    if (windowWidth > 769) {
      media = container;
***REMOVED***

    addClass(media, 'greset');
    cssTransform(media, 'translate3d(0, 0, 0)');
    addEvent(transitionEnd, {
      onElement: media,
      once: true,
      withCallback: function withCallback(event, target) {
        removeClass(media, 'greset');
  ***REMOVED***
***REMOVED***);
    media.style.opacity = '';

    if (desc) {
      desc.style.opacity = '';
***REMOVED***
  }

  function touchNavigation(instance) {
    if (instance.events.hasOwnProperty('touch')) {
      return false;
***REMOVED***

    var winSize = windowSize();
    var winWidth = winSize.width;
    var winHeight = winSize.height;
    var process = false;
    var currentSlide = null;
    var media = null;
    var mediaImage = null;
    var doingMove = false;
    var initScale = 1;
    var maxScale = 4.5;
    var currentScale = 1;
    var doingZoom = false;
    var imageZoomed = false;
    var zoomedPosX = null;
    var zoomedPosY = null;
    var lastZoomedPosX = null;
    var lastZoomedPosY = null;
    var hDistance;
    var vDistance;
    var hDistancePercent = 0;
    var vDistancePercent = 0;
    var vSwipe = false;
    var hSwipe = false;
    var startCoords = {};
    var endCoords = {};
    var xDown = 0;
    var yDown = 0;
    var isInlined;
    var sliderWrapper = document.getElementById('glightbox-slider');
    var overlay = document.querySelector('.goverlay');
    var touchInstance = new TouchEvents(sliderWrapper, {
      touchStart: function touchStart(e) {
        process = true;

        if (hasClass(e.targetTouches[0***REMOVED***.target, 'ginner-container') || closest(e.targetTouches[0***REMOVED***.target, '.gslide-desc') || e.targetTouches[0***REMOVED***.target.nodeName.toLowerCase() == 'a') {
          process = false;
    ***REMOVED***

        if (closest(e.targetTouches[0***REMOVED***.target, '.gslide-inline') && !hasClass(e.targetTouches[0***REMOVED***.target.parentNode, 'gslide-inline')) {
          process = false;
    ***REMOVED***

        if (process) {
          endCoords = e.targetTouches[0***REMOVED***;
          startCoords.pageX = e.targetTouches[0***REMOVED***.pageX;
          startCoords.pageY = e.targetTouches[0***REMOVED***.pageY;
          xDown = e.targetTouches[0***REMOVED***.clientX;
          yDown = e.targetTouches[0***REMOVED***.clientY;
          currentSlide = instance.activeSlide;
          media = currentSlide.querySelector('.gslide-media');
          isInlined = currentSlide.querySelector('.gslide-inline');
          mediaImage = null;

          if (hasClass(media, 'gslide-image')) {
            mediaImage = media.querySelector('img');
      ***REMOVED***

          var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

          if (windowWidth > 769) {
            media = currentSlide.querySelector('.ginner-container');
      ***REMOVED***

          removeClass(overlay, 'greset');

          if (e.pageX > 20 && e.pageX < window.innerWidth - 20) {
            return;
      ***REMOVED***

          e.preventDefault();
    ***REMOVED***
  ***REMOVED***
      touchMove: function touchMove(e) {
        if (!process) {
          return;
    ***REMOVED***

        endCoords = e.targetTouches[0***REMOVED***;

        if (doingZoom || imageZoomed) {
          return;
    ***REMOVED***

        if (isInlined && isInlined.offsetHeight > winHeight) {
          var moved = startCoords.pageX - endCoords.pageX;

          if (Math.abs(moved) <= 13) {
            return false;
      ***REMOVED***
    ***REMOVED***

        doingMove = true;
        var xUp = e.targetTouches[0***REMOVED***.clientX;
        var yUp = e.targetTouches[0***REMOVED***.clientY;
        var xDiff = xDown - xUp;
        var yDiff = yDown - yUp;

        if (Math.abs(xDiff) > Math.abs(yDiff)) {
          vSwipe = false;
          hSwipe = true;
    ***REMOVED*** else {
          hSwipe = false;
          vSwipe = true;
    ***REMOVED***

        hDistance = endCoords.pageX - startCoords.pageX;
        hDistancePercent = hDistance * 100 / winWidth;
        vDistance = endCoords.pageY - startCoords.pageY;
        vDistancePercent = vDistance * 100 / winHeight;
        var opacity;

        if (vSwipe && mediaImage) {
          opacity = 1 - Math.abs(vDistance) / winHeight;
          overlay.style.opacity = opacity;

          if (instance.settings.touchFollowAxis) {
            hDistancePercent = 0;
      ***REMOVED***
    ***REMOVED***

        if (hSwipe) {
          opacity = 1 - Math.abs(hDistance) / winWidth;
          media.style.opacity = opacity;

          if (instance.settings.touchFollowAxis) {
            vDistancePercent = 0;
      ***REMOVED***
    ***REMOVED***

        if (!mediaImage) {
          return cssTransform(media, "translate3d(".concat(hDistancePercent, "%, 0, 0)"));
    ***REMOVED***

        cssTransform(media, "translate3d(".concat(hDistancePercent, "%, ").concat(vDistancePercent, "%, 0)"));
  ***REMOVED***
      touchEnd: function touchEnd() {
        if (!process) {
          return;
    ***REMOVED***

        doingMove = false;

        if (imageZoomed || doingZoom) {
          lastZoomedPosX = zoomedPosX;
          lastZoomedPosY = zoomedPosY;
          return;
    ***REMOVED***

        var v = Math.abs(parseInt(vDistancePercent));
        var h = Math.abs(parseInt(hDistancePercent));

        if (v > 29 && mediaImage) {
          instance.close();
          return;
    ***REMOVED***

        if (v < 29 && h < 25) {
          addClass(overlay, 'greset');
          overlay.style.opacity = 1;
          return resetSlideMove(media);
    ***REMOVED***
  ***REMOVED***
      multipointEnd: function multipointEnd() {
        setTimeout(function () {
          doingZoom = false;
***REMOVED*** 50);
  ***REMOVED***
      multipointStart: function multipointStart() {
        doingZoom = true;
        initScale = currentScale ? currentScale : 1;
  ***REMOVED***
      pinch: function pinch(evt) {
        if (!mediaImage || doingMove) {
          return false;
    ***REMOVED***

        doingZoom = true;
        mediaImage.scaleX = mediaImage.scaleY = initScale * evt.zoom;
        var scale = initScale * evt.zoom;
        imageZoomed = true;

        if (scale <= 1) {
          imageZoomed = false;
          scale = 1;
          lastZoomedPosY = null;
          lastZoomedPosX = null;
          zoomedPosX = null;
          zoomedPosY = null;
          mediaImage.setAttribute('style', '');
          return;
    ***REMOVED***

        if (scale > maxScale) {
          scale = maxScale;
    ***REMOVED***

        mediaImage.style.transform = "scale3d(".concat(scale, ", ").concat(scale, ", 1)");
        currentScale = scale;
  ***REMOVED***
      pressMove: function pressMove(e) {
        if (imageZoomed && !doingZoom) {
          var mhDistance = endCoords.pageX - startCoords.pageX;
          var mvDistance = endCoords.pageY - startCoords.pageY;

          if (lastZoomedPosX) {
            mhDistance = mhDistance + lastZoomedPosX;
      ***REMOVED***

          if (lastZoomedPosY) {
            mvDistance = mvDistance + lastZoomedPosY;
      ***REMOVED***

          zoomedPosX = mhDistance;
          zoomedPosY = mvDistance;
          var style = "translate3d(".concat(mhDistance, "px, ").concat(mvDistance, "px, 0)");

          if (currentScale) {
            style += " scale3d(".concat(currentScale, ", ").concat(currentScale, ", 1)");
      ***REMOVED***

          cssTransform(mediaImage, style);
    ***REMOVED***
  ***REMOVED***
      swipe: function swipe(evt) {
        if (imageZoomed) {
          return;
    ***REMOVED***

        if (doingZoom) {
          doingZoom = false;
          return;
    ***REMOVED***

        if (evt.direction == 'Left') {
          if (instance.index == instance.elements.length - 1) {
            return resetSlideMove(media);
      ***REMOVED***

          instance.nextSlide();
    ***REMOVED***

        if (evt.direction == 'Right') {
          if (instance.index == 0) {
            return resetSlideMove(media);
      ***REMOVED***

          instance.prevSlide();
    ***REMOVED***
  ***REMOVED***
***REMOVED***);
    instance.events['touch'***REMOVED*** = touchInstance;
  }

  var ZoomImages = function () {
    function ZoomImages(el, slide) {
      var _this = this;

      var onclose = arguments.length > 2 && arguments[2***REMOVED*** !== undefined ? arguments[2***REMOVED*** : null;

      _classCallCheck(this, ZoomImages);

      this.img = el;
      this.slide = slide;
      this.onclose = onclose;

      if (this.img.setZoomEvents) {
        return false;
  ***REMOVED***

      this.active = false;
      this.zoomedIn = false;
      this.dragging = false;
      this.currentX = null;
      this.currentY = null;
      this.initialX = null;
      this.initialY = null;
      this.xOffset = 0;
      this.yOffset = 0;
      this.img.addEventListener('mousedown', function (e) {
        return _this.dragStart(e);
  ***REMOVED*** false);
      this.img.addEventListener('mouseup', function (e) {
        return _this.dragEnd(e);
  ***REMOVED*** false);
      this.img.addEventListener('mousemove', function (e) {
        return _this.drag(e);
  ***REMOVED*** false);
      this.img.addEventListener('click', function (e) {
        if (_this.slide.classList.contains('dragging-nav')) {
          _this.zoomOut();

          return false;
    ***REMOVED***

        if (!_this.zoomedIn) {
          return _this.zoomIn();
    ***REMOVED***

        if (_this.zoomedIn && !_this.dragging) {
          _this.zoomOut();
    ***REMOVED***
  ***REMOVED*** false);
      this.img.setZoomEvents = true;
***REMOVED***

    _createClass(ZoomImages, [{
      key: "zoomIn",
      value: function zoomIn() {
        var winWidth = this.widowWidth();

        if (this.zoomedIn || winWidth <= 768) {
          return;
    ***REMOVED***

        var img = this.img;
        img.setAttribute('data-style', img.getAttribute('style'));
        img.style.maxWidth = img.naturalWidth + 'px';
        img.style.maxHeight = img.naturalHeight + 'px';

        if (img.naturalWidth > winWidth) {
          var centerX = winWidth / 2 - img.naturalWidth / 2;
          this.setTranslate(this.img.parentNode, centerX, 0);
    ***REMOVED***

        this.slide.classList.add('zoomed');
        this.zoomedIn = true;
  ***REMOVED***
***REMOVED*** {
      key: "zoomOut",
      value: function zoomOut() {
        this.img.parentNode.setAttribute('style', '');
        this.img.setAttribute('style', this.img.getAttribute('data-style'));
        this.slide.classList.remove('zoomed');
        this.zoomedIn = false;
        this.currentX = null;
        this.currentY = null;
        this.initialX = null;
        this.initialY = null;
        this.xOffset = 0;
        this.yOffset = 0;

        if (this.onclose && typeof this.onclose == 'function') {
          this.onclose();
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "dragStart",
      value: function dragStart(e) {
        e.preventDefault();

        if (!this.zoomedIn) {
          this.active = false;
          return;
    ***REMOVED***

        if (e.type === 'touchstart') {
          this.initialX = e.touches[0***REMOVED***.clientX - this.xOffset;
          this.initialY = e.touches[0***REMOVED***.clientY - this.yOffset;
    ***REMOVED*** else {
          this.initialX = e.clientX - this.xOffset;
          this.initialY = e.clientY - this.yOffset;
    ***REMOVED***

        if (e.target === this.img) {
          this.active = true;
          this.img.classList.add('dragging');
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "dragEnd",
      value: function dragEnd(e) {
        var _this2 = this;

        e.preventDefault();
        this.initialX = this.currentX;
        this.initialY = this.currentY;
        this.active = false;
        setTimeout(function () {
          _this2.dragging = false;
          _this2.img.isDragging = false;

          _this2.img.classList.remove('dragging');
***REMOVED*** 100);
  ***REMOVED***
***REMOVED*** {
      key: "drag",
      value: function drag(e) {
        if (this.active) {
          e.preventDefault();

          if (e.type === 'touchmove') {
            this.currentX = e.touches[0***REMOVED***.clientX - this.initialX;
            this.currentY = e.touches[0***REMOVED***.clientY - this.initialY;
      ***REMOVED*** else {
            this.currentX = e.clientX - this.initialX;
            this.currentY = e.clientY - this.initialY;
      ***REMOVED***

          this.xOffset = this.currentX;
          this.yOffset = this.currentY;
          this.img.isDragging = true;
          this.dragging = true;
          this.setTranslate(this.img, this.currentX, this.currentY);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "onMove",
      value: function onMove(e) {
        if (!this.zoomedIn) {
          return;
    ***REMOVED***

        var xOffset = e.clientX - this.img.naturalWidth / 2;
        var yOffset = e.clientY - this.img.naturalHeight / 2;
        this.setTranslate(this.img, xOffset, yOffset);
  ***REMOVED***
***REMOVED*** {
      key: "setTranslate",
      value: function setTranslate(node, xPos, yPos) {
        node.style.transform = 'translate3d(' + xPos + 'px, ' + yPos + 'px, 0)';
  ***REMOVED***
***REMOVED*** {
      key: "widowWidth",
      value: function widowWidth() {
        return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  ***REMOVED***
***REMOVED******REMOVED***);

    return ZoomImages;
  }();

  var DragSlides = function () {
    function DragSlides() {
      var _this = this;

      var config = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : {};

      _classCallCheck(this, DragSlides);

      var dragEl = config.dragEl,
          _config$toleranceX = config.toleranceX,
          toleranceX = _config$toleranceX === void 0 ? 40 : _config$toleranceX,
          _config$toleranceY = config.toleranceY,
          toleranceY = _config$toleranceY === void 0 ? 65 : _config$toleranceY,
          _config$slide = config.slide,
          slide = _config$slide === void 0 ? null : _config$slide,
          _config$instance = config.instance,
          instance = _config$instance === void 0 ? null : _config$instance;
      this.el = dragEl;
      this.active = false;
      this.dragging = false;
      this.currentX = null;
      this.currentY = null;
      this.initialX = null;
      this.initialY = null;
      this.xOffset = 0;
      this.yOffset = 0;
      this.direction = null;
      this.lastDirection = null;
      this.toleranceX = toleranceX;
      this.toleranceY = toleranceY;
      this.toleranceReached = false;
      this.dragContainer = this.el;
      this.slide = slide;
      this.instance = instance;
      this.el.addEventListener('mousedown', function (e) {
        return _this.dragStart(e);
  ***REMOVED*** false);
      this.el.addEventListener('mouseup', function (e) {
        return _this.dragEnd(e);
  ***REMOVED*** false);
      this.el.addEventListener('mousemove', function (e) {
        return _this.drag(e);
  ***REMOVED*** false);
***REMOVED***

    _createClass(DragSlides, [{
      key: "dragStart",
      value: function dragStart(e) {
        if (this.slide.classList.contains('zoomed')) {
          this.active = false;
          return;
    ***REMOVED***

        if (e.type === 'touchstart') {
          this.initialX = e.touches[0***REMOVED***.clientX - this.xOffset;
          this.initialY = e.touches[0***REMOVED***.clientY - this.yOffset;
    ***REMOVED*** else {
          this.initialX = e.clientX - this.xOffset;
          this.initialY = e.clientY - this.yOffset;
    ***REMOVED***

        var clicked = e.target.nodeName.toLowerCase();
        var exludeClicks = ['input', 'select', 'textarea', 'button', 'a'***REMOVED***;

        if (e.target.classList.contains('nodrag') || closest(e.target, '.nodrag') || exludeClicks.indexOf(clicked) !== -1) {
          this.active = false;
          return;
    ***REMOVED***

        e.preventDefault();

        if (e.target === this.el || clicked !== 'img' && closest(e.target, '.gslide-inline')) {
          this.active = true;
          this.el.classList.add('dragging');
          this.dragContainer = closest(e.target, '.ginner-container');
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "dragEnd",
      value: function dragEnd(e) {
        var _this2 = this;

        e && e.preventDefault();
        this.initialX = 0;
        this.initialY = 0;
        this.currentX = null;
        this.currentY = null;
        this.initialX = null;
        this.initialY = null;
        this.xOffset = 0;
        this.yOffset = 0;
        this.active = false;

        if (this.doSlideChange) {
          this.instance.preventOutsideClick = true;
          this.doSlideChange == 'right' && this.instance.prevSlide();
          this.doSlideChange == 'left' && this.instance.nextSlide();
    ***REMOVED***

        if (this.doSlideClose) {
          this.instance.close();
    ***REMOVED***

        if (!this.toleranceReached) {
          this.setTranslate(this.dragContainer, 0, 0, true);
    ***REMOVED***

        setTimeout(function () {
          _this2.instance.preventOutsideClick = false;
          _this2.toleranceReached = false;
          _this2.lastDirection = null;
          _this2.dragging = false;
          _this2.el.isDragging = false;

          _this2.el.classList.remove('dragging');

          _this2.slide.classList.remove('dragging-nav');

          _this2.dragContainer.style.transform = '';
          _this2.dragContainer.style.transition = '';
***REMOVED*** 100);
  ***REMOVED***
***REMOVED*** {
      key: "drag",
      value: function drag(e) {
        if (this.active) {
          e.preventDefault();
          this.slide.classList.add('dragging-nav');

          if (e.type === 'touchmove') {
            this.currentX = e.touches[0***REMOVED***.clientX - this.initialX;
            this.currentY = e.touches[0***REMOVED***.clientY - this.initialY;
      ***REMOVED*** else {
            this.currentX = e.clientX - this.initialX;
            this.currentY = e.clientY - this.initialY;
      ***REMOVED***

          this.xOffset = this.currentX;
          this.yOffset = this.currentY;
          this.el.isDragging = true;
          this.dragging = true;
          this.doSlideChange = false;
          this.doSlideClose = false;
          var currentXInt = Math.abs(this.currentX);
          var currentYInt = Math.abs(this.currentY);

          if (currentXInt > 0 && currentXInt >= Math.abs(this.currentY) && (!this.lastDirection || this.lastDirection == 'x')) {
            this.yOffset = 0;
            this.lastDirection = 'x';
            this.setTranslate(this.dragContainer, this.currentX, 0);
            var doChange = this.shouldChange();

            if (!this.instance.settings.dragAutoSnap && doChange) {
              this.doSlideChange = doChange;
        ***REMOVED***

            if (this.instance.settings.dragAutoSnap && doChange) {
              this.instance.preventOutsideClick = true;
              this.toleranceReached = true;
              this.active = false;
              this.instance.preventOutsideClick = true;
              this.dragEnd(null);
              doChange == 'right' && this.instance.prevSlide();
              doChange == 'left' && this.instance.nextSlide();
              return;
        ***REMOVED***
      ***REMOVED***

          if (this.toleranceY > 0 && currentYInt > 0 && currentYInt >= currentXInt && (!this.lastDirection || this.lastDirection == 'y')) {
            this.xOffset = 0;
            this.lastDirection = 'y';
            this.setTranslate(this.dragContainer, 0, this.currentY);
            var doClose = this.shouldClose();

            if (!this.instance.settings.dragAutoSnap && doClose) {
              this.doSlideClose = true;
        ***REMOVED***

            if (this.instance.settings.dragAutoSnap && doClose) {
              this.instance.close();
        ***REMOVED***

            return;
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "shouldChange",
      value: function shouldChange() {
        var doChange = false;
        var currentXInt = Math.abs(this.currentX);

        if (currentXInt >= this.toleranceX) {
          var dragDir = this.currentX > 0 ? 'right' : 'left';

          if (dragDir == 'left' && this.slide !== this.slide.parentNode.lastChild || dragDir == 'right' && this.slide !== this.slide.parentNode.firstChild) {
            doChange = dragDir;
      ***REMOVED***
    ***REMOVED***

        return doChange;
  ***REMOVED***
***REMOVED*** {
      key: "shouldClose",
      value: function shouldClose() {
        var doClose = false;
        var currentYInt = Math.abs(this.currentY);

        if (currentYInt >= this.toleranceY) {
          doClose = true;
    ***REMOVED***

        return doClose;
  ***REMOVED***
***REMOVED*** {
      key: "setTranslate",
      value: function setTranslate(node, xPos, yPos) {
        var animated = arguments.length > 3 && arguments[3***REMOVED*** !== undefined ? arguments[3***REMOVED*** : false;

        if (animated) {
          node.style.transition = 'all .2s ease';
    ***REMOVED*** else {
          node.style.transition = '';
    ***REMOVED***

        node.style.transform = "translate3d(".concat(xPos, "px, ").concat(yPos, "px, 0)");
  ***REMOVED***
***REMOVED******REMOVED***);

    return DragSlides;
  }();

  function slideImage(slide, data, index, callback) {
    var slideMedia = slide.querySelector('.gslide-media');
    var img = new Image();
    var titleID = 'gSlideTitle_' + index;
    var textID = 'gSlideDesc_' + index;
    img.addEventListener('load', function () {
      if (isFunction(callback)) {
        callback();
  ***REMOVED***
***REMOVED*** false);
    img.src = data.href;

    if (data.sizes != '' && data.srcset != '') {
      img.sizes = data.sizes;
      img.srcset = data.srcset;
***REMOVED***

    img.alt = '';

    if (!isNil(data.alt) && data.alt !== '') {
      img.alt = data.alt;
***REMOVED***

    if (data.title !== '') {
      img.setAttribute('aria-labelledby', titleID);
***REMOVED***

    if (data.description !== '') {
      img.setAttribute('aria-describedby', textID);
***REMOVED***

    if (data.hasOwnProperty('_hasCustomWidth') && data._hasCustomWidth) {
      img.style.width = data.width;
***REMOVED***

    if (data.hasOwnProperty('_hasCustomHeight') && data._hasCustomHeight) {
      img.style.height = data.height;
***REMOVED***

    slideMedia.insertBefore(img, slideMedia.firstChild);
    return;
  }

  function slideVideo(slide, data, index, callback) {
    var _this = this;

    var slideContainer = slide.querySelector('.ginner-container');
    var videoID = 'gvideo' + index;
    var slideMedia = slide.querySelector('.gslide-media');
    var videoPlayers = this.getAllPlayers();
    addClass(slideContainer, 'gvideo-container');
    slideMedia.insertBefore(createHTML('<div class="gvideo-wrapper"></div>'), slideMedia.firstChild);
    var videoWrapper = slide.querySelector('.gvideo-wrapper');
    injectAssets(this.settings.plyr.css, 'Plyr');
    var url = data.href;
    var protocol = location.protocol.replace(':', '');
    var videoSource = '';
    var embedID = '';
    var customPlaceholder = false;

    if (protocol == 'file') {
      protocol = 'http';
***REMOVED***

    slideMedia.style.maxWidth = data.width;
    injectAssets(this.settings.plyr.js, 'Plyr', function () {
      if (url.match(/vimeo\.com\/([0-9***REMOVED****)/)) {
        var vimeoID = /vimeo.*\/(\d+)/i.exec(url);
        videoSource = 'vimeo';
        embedID = vimeoID[1***REMOVED***;
  ***REMOVED***

      if (url.match(/(youtube\.com|youtube-nocookie\.com)\/watch\?v=([a-zA-Z0-9\-_***REMOVED***+)/) || url.match(/youtu\.be\/([a-zA-Z0-9\-_***REMOVED***+)/) || url.match(/(youtube\.com|youtube-nocookie\.com)\/embed\/([a-zA-Z0-9\-_***REMOVED***+)/)) {
        var youtubeID = getYoutubeID(url);
        videoSource = 'youtube';
        embedID = youtubeID;
  ***REMOVED***

      if (url.match(/\.(mp4|ogg|webm|mov)$/) !== null) {
        videoSource = 'local';
        var html = '<video id="' + videoID + '" ';
        html += "style=\"background:#000; max-width: ".concat(data.width, ";\" ");
        html += 'preload="metadata" ';
        html += 'x-webkit-airplay="allow" ';
        html += 'playsinline ';
        html += 'controls ';
        html += 'class="gvideo-local">';
        var format = url.toLowerCase().split('.').pop();
        var sources = {
          mp4: '',
          ogg: '',
          webm: ''
    ***REMOVED***;
        format = format == 'mov' ? 'mp4' : format;
        sources[format***REMOVED*** = url;

        for (var key in sources) {
          if (sources.hasOwnProperty(key)) {
            var videoFile = sources[key***REMOVED***;

            if (data.hasOwnProperty(key)) {
              videoFile = data[key***REMOVED***;
        ***REMOVED***

            if (videoFile !== '') {
              html += "<source src=\"".concat(videoFile, "\" type=\"video/").concat(key, "\">");
        ***REMOVED***
      ***REMOVED***
    ***REMOVED***

        html += '</video>';
        customPlaceholder = createHTML(html);
  ***REMOVED***

      var placeholder = customPlaceholder ? customPlaceholder : createHTML("<div id=\"".concat(videoID, "\" data-plyr-provider=\"").concat(videoSource, "\" data-plyr-embed-id=\"").concat(embedID, "\"></div>"));
      addClass(videoWrapper, "".concat(videoSource, "-video gvideo"));
      videoWrapper.appendChild(placeholder);
      videoWrapper.setAttribute('data-id', videoID);
      videoWrapper.setAttribute('data-index', index);
      var playerConfig = has(_this.settings.plyr, 'config') ? _this.settings.plyr.config : {};
      var player = new Plyr('#' + videoID, playerConfig);
      player.on('ready', function (event) {
        var instance = event.detail.plyr;
        videoPlayers[videoID***REMOVED*** = instance;

        if (isFunction(callback)) {
          callback();
    ***REMOVED***
  ***REMOVED***);
      waitUntil(function () {
        return slide.querySelector('iframe') && slide.querySelector('iframe').dataset.ready == 'true';
  ***REMOVED*** function () {
        _this.resize(slide);
  ***REMOVED***);
      player.on('enterfullscreen', handleMediaFullScreen);
      player.on('exitfullscreen', handleMediaFullScreen);
***REMOVED***);
  }

  function getYoutubeID(url) {
    var videoID = '';
    url = url.replace(/(>|<)/gi, '').split(/(vi\/|v=|\/v\/|youtu\.be\/|\/embed\/)/);

    if (url[2***REMOVED*** !== undefined) {
      videoID = url[2***REMOVED***.split(/[^0-9a-z_\-***REMOVED***/i);
      videoID = videoID[0***REMOVED***;
***REMOVED*** else {
      videoID = url;
***REMOVED***

    return videoID;
  }

  function handleMediaFullScreen(event) {
    var media = closest(event.target, '.gslide-media');

    if (event.type == 'enterfullscreen') {
      addClass(media, 'fullscreen');
***REMOVED***

    if (event.type == 'exitfullscreen') {
      removeClass(media, 'fullscreen');
***REMOVED***
  }

  function slideInline(slide, data, index, callback) {
    var _this = this;

    var slideMedia = slide.querySelector('.gslide-media');
    var hash = has(data, 'href') && data.href ? data.href.split('#').pop().trim() : false;
    var content = has(data, 'content') && data.content ? data.content : false;
    var innerContent;

    if (content) {
      if (isString(content)) {
        innerContent = createHTML("<div class=\"ginlined-content\">".concat(content, "</div>"));
  ***REMOVED***

      if (isNode(content)) {
        if (content.style.display == 'none') {
          content.style.display = 'block';
    ***REMOVED***

        var container = document.createElement('div');
        container.className = 'ginlined-content';
        container.appendChild(content);
        innerContent = container;
  ***REMOVED***
***REMOVED***

    if (hash) {
      var div = document.getElementById(hash);

      if (!div) {
        return false;
  ***REMOVED***

      var cloned = div.cloneNode(true);
      cloned.style.height = data.height;
      cloned.style.maxWidth = data.width;
      addClass(cloned, 'ginlined-content');
      innerContent = cloned;
***REMOVED***

    if (!innerContent) {
      console.error('Unable to append inline slide content', data);
      return false;
***REMOVED***

    slideMedia.style.height = data.height;
    slideMedia.style.width = data.width;
    slideMedia.appendChild(innerContent);
    this.events['inlineclose' + hash***REMOVED*** = addEvent('click', {
      onElement: slideMedia.querySelectorAll('.gtrigger-close'),
      withCallback: function withCallback(e) {
        e.preventDefault();

        _this.close();
  ***REMOVED***
***REMOVED***);

    if (isFunction(callback)) {
      callback();
***REMOVED***

    return;
  }

  function slideIframe(slide, data, index, callback) {
    var slideMedia = slide.querySelector('.gslide-media');
    var iframe = createIframe({
      url: data.href,
      callback: callback
***REMOVED***);
    slideMedia.parentNode.style.maxWidth = data.width;
    slideMedia.parentNode.style.height = data.height;
    slideMedia.appendChild(iframe);
    return;
  }

  var SlideConfigParser = function () {
    function SlideConfigParser() {
      var slideParamas = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : {};

      _classCallCheck(this, SlideConfigParser);

      this.defaults = {
        href: '',
        sizes: '',
        srcset: '',
        title: '',
        type: '',
        description: '',
        alt: '',
        descPosition: 'bottom',
        effect: '',
        width: '',
        height: '',
        content: false,
        zoomable: true,
        draggable: true
  ***REMOVED***;

      if (isObject(slideParamas)) {
        this.defaults = extend(this.defaults, slideParamas);
  ***REMOVED***
***REMOVED***

    _createClass(SlideConfigParser, [{
      key: "sourceType",
      value: function sourceType(url) {
        var origin = url;
        url = url.toLowerCase();

        if (url.match(/\.(jpeg|jpg|jpe|gif|png|apn|webp|avif|svg)/) !== null) {
          return 'image';
    ***REMOVED***

        if (url.match(/(youtube\.com|youtube-nocookie\.com)\/watch\?v=([a-zA-Z0-9\-_***REMOVED***+)/) || url.match(/youtu\.be\/([a-zA-Z0-9\-_***REMOVED***+)/) || url.match(/(youtube\.com|youtube-nocookie\.com)\/embed\/([a-zA-Z0-9\-_***REMOVED***+)/)) {
          return 'video';
    ***REMOVED***

        if (url.match(/vimeo\.com\/([0-9***REMOVED****)/)) {
          return 'video';
    ***REMOVED***

        if (url.match(/\.(mp4|ogg|webm|mov)/) !== null) {
          return 'video';
    ***REMOVED***

        if (url.match(/\.(mp3|wav|wma|aac|ogg)/) !== null) {
          return 'audio';
    ***REMOVED***

        if (url.indexOf('#') > -1) {
          var hash = origin.split('#').pop();

          if (hash.trim() !== '') {
            return 'inline';
      ***REMOVED***
    ***REMOVED***

        if (url.indexOf('goajax=true') > -1) {
          return 'ajax';
    ***REMOVED***

        return 'external';
  ***REMOVED***
***REMOVED*** {
      key: "parseConfig",
      value: function parseConfig(element, settings) {
        var _this = this;

        var data = extend({
          descPosition: settings.descPosition
***REMOVED*** this.defaults);

        if (isObject(element) && !isNode(element)) {
          if (!has(element, 'type')) {
            if (has(element, 'content') && element.content) {
              element.type = 'inline';
        ***REMOVED*** else if (has(element, 'href')) {
              element.type = this.sourceType(element.href);
        ***REMOVED***
      ***REMOVED***

          var objectData = extend(data, element);
          this.setSize(objectData, settings);
          return objectData;
    ***REMOVED***

        var url = '';
        var config = element.getAttribute('data-glightbox');
        var nodeType = element.nodeName.toLowerCase();

        if (nodeType === 'a') {
          url = element.href;
    ***REMOVED***

        if (nodeType === 'img') {
          url = element.src;
          data.alt = element.alt;
    ***REMOVED***

        data.href = url;
        each(data, function (val, key) {
          if (has(settings, key) && key !== 'width') {
            data[key***REMOVED*** = settings[key***REMOVED***;
      ***REMOVED***

          var nodeData = element.dataset[key***REMOVED***;

          if (!isNil(nodeData)) {
            data[key***REMOVED*** = _this.sanitizeValue(nodeData);
      ***REMOVED***
    ***REMOVED***);

        if (data.content) {
          data.type = 'inline';
    ***REMOVED***

        if (!data.type && url) {
          data.type = this.sourceType(url);
    ***REMOVED***

        if (!isNil(config)) {
          var cleanKeys = [***REMOVED***;
          each(data, function (v, k) {
            cleanKeys.push(';\\s?' + k);
      ***REMOVED***);
          cleanKeys = cleanKeys.join('\\s?:|');

          if (config.trim() !== '') {
            each(data, function (val, key) {
              var str = config;
              var match = 's?' + key + 's?:s?(.*?)(' + cleanKeys + 's?:|$)';
              var regex = new RegExp(match);
              var matches = str.match(regex);

              if (matches && matches.length && matches[1***REMOVED***) {
                var value = matches[1***REMOVED***.trim().replace(/;\s*$/, '');
                data[key***REMOVED*** = _this.sanitizeValue(value);
          ***REMOVED***
        ***REMOVED***);
      ***REMOVED***
    ***REMOVED*** else {
          if (!data.title && nodeType == 'a') {
            var title = element.title;

            if (!isNil(title) && title !== '') {
              data.title = title;
        ***REMOVED***
      ***REMOVED***

          if (!data.title && nodeType == 'img') {
            var alt = element.alt;

            if (!isNil(alt) && alt !== '') {
              data.title = alt;
        ***REMOVED***
      ***REMOVED***
    ***REMOVED***

        if (data.description && data.description.substring(0, 1) === '.') {
          var description;

          try {
            description = document.querySelector(data.description).innerHTML;
      ***REMOVED*** catch (error) {
            if (!(error instanceof DOMException)) {
              throw error;
        ***REMOVED***
      ***REMOVED***

          if (description) {
            data.description = description;
      ***REMOVED***
    ***REMOVED***

        if (!data.description) {
          var nodeDesc = element.querySelector('.glightbox-desc');

          if (nodeDesc) {
            data.description = nodeDesc.innerHTML;
      ***REMOVED***
    ***REMOVED***

        this.setSize(data, settings, element);
        this.slideConfig = data;
        return data;
  ***REMOVED***
***REMOVED*** {
      key: "setSize",
      value: function setSize(data, settings) {
        var element = arguments.length > 2 && arguments[2***REMOVED*** !== undefined ? arguments[2***REMOVED*** : null;
        var defaultWith = data.type == 'video' ? this.checkSize(settings.videosWidth) : this.checkSize(settings.width);
        var defaultHeight = this.checkSize(settings.height);
        data.width = has(data, 'width') && data.width !== '' ? this.checkSize(data.width) : defaultWith;
        data.height = has(data, 'height') && data.height !== '' ? this.checkSize(data.height) : defaultHeight;

        if (element && data.type == 'image') {
          data._hasCustomWidth = element.dataset.width ? true : false;
          data._hasCustomHeight = element.dataset.height ? true : false;
    ***REMOVED***

        return data;
  ***REMOVED***
***REMOVED*** {
      key: "checkSize",
      value: function checkSize(size) {
        return isNumber(size) ? "".concat(size, "px") : size;
  ***REMOVED***
***REMOVED*** {
      key: "sanitizeValue",
      value: function sanitizeValue(val) {
        if (val !== 'true' && val !== 'false') {
          return val;
    ***REMOVED***

        return val === 'true';
  ***REMOVED***
***REMOVED******REMOVED***);

    return SlideConfigParser;
  }();

  var Slide = function () {
    function Slide(el, instance, index) {
      _classCallCheck(this, Slide);

      this.element = el;
      this.instance = instance;
      this.index = index;
***REMOVED***

    _createClass(Slide, [{
      key: "setContent",
      value: function setContent() {
        var _this = this;

        var slide = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : null;
        var callback = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : false;

        if (hasClass(slide, 'loaded')) {
          return false;
    ***REMOVED***

        var settings = this.instance.settings;
        var slideConfig = this.slideConfig;
        var isMobileDevice = isMobile();

        if (isFunction(settings.beforeSlideLoad)) {
          settings.beforeSlideLoad({
            index: this.index,
            slide: slide,
            player: false
      ***REMOVED***);
    ***REMOVED***

        var type = slideConfig.type;
        var position = slideConfig.descPosition;
        var slideMedia = slide.querySelector('.gslide-media');
        var slideTitle = slide.querySelector('.gslide-title');
        var slideText = slide.querySelector('.gslide-desc');
        var slideDesc = slide.querySelector('.gdesc-inner');
        var finalCallback = callback;
        var titleID = 'gSlideTitle_' + this.index;
        var textID = 'gSlideDesc_' + this.index;

        if (isFunction(settings.afterSlideLoad)) {
          finalCallback = function finalCallback() {
            if (isFunction(callback)) {
              callback();
        ***REMOVED***

            settings.afterSlideLoad({
              index: _this.index,
              slide: slide,
              player: _this.instance.getSlidePlayerInstance(_this.index)
        ***REMOVED***);
      ***REMOVED***;
    ***REMOVED***

        if (slideConfig.title == '' && slideConfig.description == '') {
          if (slideDesc) {
            slideDesc.parentNode.parentNode.removeChild(slideDesc.parentNode);
      ***REMOVED***
    ***REMOVED*** else {
          if (slideTitle && slideConfig.title !== '') {
            slideTitle.id = titleID;
            slideTitle.innerHTML = slideConfig.title;
      ***REMOVED*** else {
            slideTitle.parentNode.removeChild(slideTitle);
      ***REMOVED***

          if (slideText && slideConfig.description !== '') {
            slideText.id = textID;

            if (isMobileDevice && settings.moreLength > 0) {
              slideConfig.smallDescription = this.slideShortDesc(slideConfig.description, settings.moreLength, settings.moreText);
              slideText.innerHTML = slideConfig.smallDescription;
              this.descriptionEvents(slideText, slideConfig);
        ***REMOVED*** else {
              slideText.innerHTML = slideConfig.description;
        ***REMOVED***
      ***REMOVED*** else {
            slideText.parentNode.removeChild(slideText);
      ***REMOVED***

          addClass(slideMedia.parentNode, "desc-".concat(position));
          addClass(slideDesc.parentNode, "description-".concat(position));
    ***REMOVED***

        addClass(slideMedia, "gslide-".concat(type));
        addClass(slide, 'loaded');

        if (type === 'video') {
          slideVideo.apply(this.instance, [slide, slideConfig, this.index, finalCallback***REMOVED***);
          return;
    ***REMOVED***

        if (type === 'external') {
          slideIframe.apply(this, [slide, slideConfig, this.index, finalCallback***REMOVED***);
          return;
    ***REMOVED***

        if (type === 'inline') {
          slideInline.apply(this.instance, [slide, slideConfig, this.index, finalCallback***REMOVED***);

          if (slideConfig.draggable) {
            new DragSlides({
              dragEl: slide.querySelector('.gslide-inline'),
              toleranceX: settings.dragToleranceX,
              toleranceY: settings.dragToleranceY,
              slide: slide,
              instance: this.instance
        ***REMOVED***);
      ***REMOVED***

          return;
    ***REMOVED***

        if (type === 'image') {
          slideImage(slide, slideConfig, this.index, function () {
            var img = slide.querySelector('img');

            if (slideConfig.draggable) {
              new DragSlides({
                dragEl: img,
                toleranceX: settings.dragToleranceX,
                toleranceY: settings.dragToleranceY,
                slide: slide,
                instance: _this.instance
          ***REMOVED***);
        ***REMOVED***

            if (slideConfig.zoomable && img.naturalWidth > img.offsetWidth) {
              addClass(img, 'zoomable');
              new ZoomImages(img, slide, function () {
                _this.instance.resize();
          ***REMOVED***);
        ***REMOVED***

            if (isFunction(finalCallback)) {
              finalCallback();
        ***REMOVED***
      ***REMOVED***);
          return;
    ***REMOVED***

        if (isFunction(finalCallback)) {
          finalCallback();
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "slideShortDesc",
      value: function slideShortDesc(string) {
        var n = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : 50;
        var wordBoundary = arguments.length > 2 && arguments[2***REMOVED*** !== undefined ? arguments[2***REMOVED*** : false;
        var div = document.createElement('div');
        div.innerHTML = string;
        var cleanedString = div.innerText;
        var useWordBoundary = wordBoundary;
        string = cleanedString.trim();

        if (string.length <= n) {
          return string;
    ***REMOVED***

        var subString = string.substr(0, n - 1);

        if (!useWordBoundary) {
          return subString;
    ***REMOVED***

        div = null;
        return subString + '... <a href="#" class="desc-more">' + wordBoundary + '</a>';
  ***REMOVED***
***REMOVED*** {
      key: "descriptionEvents",
      value: function descriptionEvents(desc, data) {
        var _this2 = this;

        var moreLink = desc.querySelector('.desc-more');

        if (!moreLink) {
          return false;
    ***REMOVED***

        addEvent('click', {
          onElement: moreLink,
          withCallback: function withCallback(event, target) {
            event.preventDefault();
            var body = document.body;
            var desc = closest(target, '.gslide-desc');

            if (!desc) {
              return false;
        ***REMOVED***

            desc.innerHTML = data.description;
            addClass(body, 'gdesc-open');
            var shortEvent = addEvent('click', {
              onElement: [body, closest(desc, '.gslide-description')***REMOVED***,
              withCallback: function withCallback(event, target) {
                if (event.target.nodeName.toLowerCase() !== 'a') {
                  removeClass(body, 'gdesc-open');
                  addClass(body, 'gdesc-closed');
                  desc.innerHTML = data.smallDescription;

                  _this2.descriptionEvents(desc, data);

                  setTimeout(function () {
                    removeClass(body, 'gdesc-closed');
          ***REMOVED*** 400);
                  shortEvent.destroy();
            ***REMOVED***
          ***REMOVED***
        ***REMOVED***);
      ***REMOVED***
    ***REMOVED***);
  ***REMOVED***
***REMOVED*** {
      key: "create",
      value: function create() {
        return createHTML(this.instance.settings.slideHTML);
  ***REMOVED***
***REMOVED*** {
      key: "getConfig",
      value: function getConfig() {
        if (!isNode(this.element) && !this.element.hasOwnProperty('draggable')) {
          this.element.draggable = this.instance.settings.draggable;
    ***REMOVED***

        var parser = new SlideConfigParser(this.instance.settings.slideExtraAttributes);
        this.slideConfig = parser.parseConfig(this.element, this.instance.settings);
        return this.slideConfig;
  ***REMOVED***
***REMOVED******REMOVED***);

    return Slide;
  }();

  var _version = '3.1.1';

  var isMobile$1 = isMobile();

  var isTouch$1 = isTouch();

  var html = document.getElementsByTagName('html')[0***REMOVED***;
  var defaults = {
    selector: '.glightbox',
    elements: null,
    skin: 'clean',
    theme: 'clean',
    closeButton: true,
    startAt: null,
    autoplayVideos: true,
    autofocusVideos: true,
    descPosition: 'bottom',
    width: '900px',
    height: '506px',
    videosWidth: '960px',
    beforeSlideChange: null,
    afterSlideChange: null,
    beforeSlideLoad: null,
    afterSlideLoad: null,
    slideInserted: null,
    slideRemoved: null,
    slideExtraAttributes: null,
    onOpen: null,
    onClose: null,
    loop: false,
    zoomable: true,
    draggable: true,
    dragAutoSnap: false,
    dragToleranceX: 40,
    dragToleranceY: 65,
    preload: true,
    oneSlidePerOpen: false,
    touchNavigation: true,
    touchFollowAxis: true,
    keyboardNavigation: true,
    closeOnOutsideClick: true,
    plugins: false,
    plyr: {
      css: 'https://cdn.plyr.io/3.6.8/plyr.css',
      js: 'https://cdn.plyr.io/3.6.8/plyr.js',
      config: {
        ratio: '16:9',
        fullscreen: {
          enabled: true,
          iosNative: true
***REMOVED***
        youtube: {
          noCookie: true,
          rel: 0,
          showinfo: 0,
          iv_load_policy: 3
***REMOVED***
        vimeo: {
          byline: false,
          portrait: false,
          title: false,
          transparent: false
    ***REMOVED***
  ***REMOVED***
***REMOVED***
    openEffect: 'zoom',
    closeEffect: 'zoom',
    slideEffect: 'slide',
    moreText: 'See more',
    moreLength: 60,
    cssEfects: {
      fade: {
        "in": 'fadeIn',
        out: 'fadeOut'
  ***REMOVED***
      zoom: {
        "in": 'zoomIn',
        out: 'zoomOut'
  ***REMOVED***
      slide: {
        "in": 'slideInRight',
        out: 'slideOutLeft'
  ***REMOVED***
      slideBack: {
        "in": 'slideInLeft',
        out: 'slideOutRight'
  ***REMOVED***
      none: {
        "in": 'none',
        out: 'none'
  ***REMOVED***
***REMOVED***
    svg: {
      close: '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve"><g><g><path d="M505.943,6.058c-8.077-8.077-21.172-8.077-29.249,0L6.058,476.693c-8.077,8.077-8.077,21.172,0,29.249C10.096,509.982,15.39,512,20.683,512c5.293,0,10.586-2.019,14.625-6.059L505.943,35.306C514.019,27.23,514.019,14.135,505.943,6.058z"/></g></g><g><g><path d="M505.942,476.694L35.306,6.059c-8.076-8.077-21.172-8.077-29.248,0c-8.077,8.076-8.077,21.171,0,29.248l470.636,470.636c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.587-2.019,14.624-6.057C514.018,497.866,514.018,484.771,505.942,476.694z"/></g></g></svg>',
      next: '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"> <g><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></g></svg>',
      prev: '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.175 477.175" xml:space="preserve"><g><path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/></g></svg>'
***REMOVED***
  };
  defaults.slideHTML = "<div class=\"gslide\">\n    <div class=\"gslide-inner-content\">\n        <div class=\"ginner-container\">\n            <div class=\"gslide-media\">\n            </div>\n            <div class=\"gslide-description\">\n                <div class=\"gdesc-inner\">\n                    <h4 class=\"gslide-title\"></h4>\n                    <div class=\"gslide-desc\"></div>\n                </div>\n            </div>\n        </div>\n    </div>\n</div>";
  defaults.lightboxHTML = "<div id=\"glightbox-body\" class=\"glightbox-container\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"false\">\n    <div class=\"gloader visible\"></div>\n    <div class=\"goverlay\"></div>\n    <div class=\"gcontainer\">\n    <div id=\"glightbox-slider\" class=\"gslider\"></div>\n    <button class=\"gclose gbtn\" aria-label=\"Close\" data-taborder=\"3\">{closeSVG}</button>\n    <button class=\"gprev gbtn\" aria-label=\"Previous\" data-taborder=\"2\">{prevSVG}</button>\n    <button class=\"gnext gbtn\" aria-label=\"Next\" data-taborder=\"1\">{nextSVG}</button>\n</div>\n</div>";

  var GlightboxInit = function () {
    function GlightboxInit() {
      var options = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : {};

      _classCallCheck(this, GlightboxInit);

      this.customOptions = options;
      this.settings = extend(defaults, options);
      this.effectsClasses = this.getAnimationClasses();
      this.videoPlayers = {};
      this.apiEvents = [***REMOVED***;
      this.fullElementsList = false;
***REMOVED***

    _createClass(GlightboxInit, [{
      key: "init",
      value: function init() {
        var _this = this;

        var selector = this.getSelector();

        if (selector) {
          this.baseEvents = addEvent('click', {
            onElement: selector,
            withCallback: function withCallback(e, target) {
              e.preventDefault();

              _this.open(target);
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED***

        this.elements = this.getElements();
  ***REMOVED***
***REMOVED*** {
      key: "open",
      value: function open() {
        var element = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : null;
        var startAt = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : null;

        if (this.elements.length == 0) {
          return false;
    ***REMOVED***

        this.activeSlide = null;
        this.prevActiveSlideIndex = null;
        this.prevActiveSlide = null;
        var index = isNumber(startAt) ? startAt : this.settings.startAt;

        if (isNode(element)) {
          var gallery = element.getAttribute('data-gallery');

          if (gallery) {
            this.fullElementsList = this.elements;
            this.elements = this.getGalleryElements(this.elements, gallery);
      ***REMOVED***

          if (isNil(index)) {
            index = this.getElementIndex(element);

            if (index < 0) {
              index = 0;
        ***REMOVED***
      ***REMOVED***
    ***REMOVED***

        if (!isNumber(index)) {
          index = 0;
    ***REMOVED***

        this.build();

        animateElement(this.overlay, this.settings.openEffect == 'none' ? 'none' : this.settings.cssEfects.fade["in"***REMOVED***);

        var body = document.body;
        var scrollBar = window.innerWidth - document.documentElement.clientWidth;

        if (scrollBar > 0) {
          var styleSheet = document.createElement('style');
          styleSheet.type = 'text/css';
          styleSheet.className = 'gcss-styles';
          styleSheet.innerText = ".gscrollbar-fixer {margin-right: ".concat(scrollBar, "px}");
          document.head.appendChild(styleSheet);

          addClass(body, 'gscrollbar-fixer');
    ***REMOVED***

        addClass(body, 'glightbox-open');

        addClass(html, 'glightbox-open');

        if (isMobile$1) {
          addClass(document.body, 'glightbox-mobile');

          this.settings.slideEffect = 'slide';
    ***REMOVED***

        this.showSlide(index, true);

        if (this.elements.length == 1) {
          addClass(this.prevButton, 'glightbox-button-hidden');

          addClass(this.nextButton, 'glightbox-button-hidden');
    ***REMOVED*** else {
          removeClass(this.prevButton, 'glightbox-button-hidden');

          removeClass(this.nextButton, 'glightbox-button-hidden');
    ***REMOVED***

        this.lightboxOpen = true;
        this.trigger('open');

        if (isFunction(this.settings.onOpen)) {
          this.settings.onOpen();
    ***REMOVED***

        if (isTouch$1 && this.settings.touchNavigation) {
          touchNavigation(this);
    ***REMOVED***

        if (this.settings.keyboardNavigation) {
          keyboardNavigation(this);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "openAt",
      value: function openAt() {
        var index = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : 0;
        this.open(null, index);
  ***REMOVED***
***REMOVED*** {
      key: "showSlide",
      value: function showSlide() {
        var _this2 = this;

        var index = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : 0;
        var first = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : false;

        show(this.loader);

        this.index = parseInt(index);
        var current = this.slidesContainer.querySelector('.current');

        if (current) {
          removeClass(current, 'current');
    ***REMOVED***

        this.slideAnimateOut();
        var slideNode = this.slidesContainer.querySelectorAll('.gslide')[index***REMOVED***;

        if (hasClass(slideNode, 'loaded')) {
          this.slideAnimateIn(slideNode, first);

          hide(this.loader);
    ***REMOVED*** else {
          show(this.loader);

          var slide = this.elements[index***REMOVED***;
          var slideData = {
            index: this.index,
            slide: slideNode,
            slideNode: slideNode,
            slideConfig: slide.slideConfig,
            slideIndex: this.index,
            trigger: slide.node,
            player: null
      ***REMOVED***;
          this.trigger('slide_before_load', slideData);
          slide.instance.setContent(slideNode, function () {
            hide(_this2.loader);

            _this2.resize();

            _this2.slideAnimateIn(slideNode, first);

            _this2.trigger('slide_after_load', slideData);
      ***REMOVED***);
    ***REMOVED***

        this.slideDescription = slideNode.querySelector('.gslide-description');
        this.slideDescriptionContained = this.slideDescription && hasClass(this.slideDescription.parentNode, 'gslide-media');

        if (this.settings.preload) {
          this.preloadSlide(index + 1);
          this.preloadSlide(index - 1);
    ***REMOVED***

        this.updateNavigationClasses();
        this.activeSlide = slideNode;
  ***REMOVED***
***REMOVED*** {
      key: "preloadSlide",
      value: function preloadSlide(index) {
        var _this3 = this;

        if (index < 0 || index > this.elements.length - 1) {
          return false;
    ***REMOVED***

        if (isNil(this.elements[index***REMOVED***)) {
          return false;
    ***REMOVED***

        var slideNode = this.slidesContainer.querySelectorAll('.gslide')[index***REMOVED***;

        if (hasClass(slideNode, 'loaded')) {
          return false;
    ***REMOVED***

        var slide = this.elements[index***REMOVED***;
        var type = slide.type;
        var slideData = {
          index: index,
          slide: slideNode,
          slideNode: slideNode,
          slideConfig: slide.slideConfig,
          slideIndex: index,
          trigger: slide.node,
          player: null
    ***REMOVED***;
        this.trigger('slide_before_load', slideData);

        if (type == 'video' || type == 'external') {
          setTimeout(function () {
            slide.instance.setContent(slideNode, function () {
              _this3.trigger('slide_after_load', slideData);
        ***REMOVED***);
  ***REMOVED*** 200);
    ***REMOVED*** else {
          slide.instance.setContent(slideNode, function () {
            _this3.trigger('slide_after_load', slideData);
      ***REMOVED***);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "prevSlide",
      value: function prevSlide() {
        this.goToSlide(this.index - 1);
  ***REMOVED***
***REMOVED*** {
      key: "nextSlide",
      value: function nextSlide() {
        this.goToSlide(this.index + 1);
  ***REMOVED***
***REMOVED*** {
      key: "goToSlide",
      value: function goToSlide() {
        var index = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : false;
        this.prevActiveSlide = this.activeSlide;
        this.prevActiveSlideIndex = this.index;

        if (!this.loop() && (index < 0 || index > this.elements.length - 1)) {
          return false;
    ***REMOVED***

        if (index < 0) {
          index = this.elements.length - 1;
    ***REMOVED*** else if (index >= this.elements.length) {
          index = 0;
    ***REMOVED***

        this.showSlide(index);
  ***REMOVED***
***REMOVED*** {
      key: "insertSlide",
      value: function insertSlide() {
        var config = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : {};
        var index = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : -1;

        if (index < 0) {
          index = this.elements.length;
    ***REMOVED***

        var slide = new Slide(config, this, index);
        var data = slide.getConfig();

        var slideInfo = extend({}, data);

        var newSlide = slide.create();
        var totalSlides = this.elements.length - 1;
        slideInfo.index = index;
        slideInfo.node = false;
        slideInfo.instance = slide;
        slideInfo.slideConfig = data;
        this.elements.splice(index, 0, slideInfo);
        var addedSlideNode = null;
        var addedSlidePlayer = null;

        if (this.slidesContainer) {
          if (index > totalSlides) {
            this.slidesContainer.appendChild(newSlide);
      ***REMOVED*** else {
            var existingSlide = this.slidesContainer.querySelectorAll('.gslide')[index***REMOVED***;
            this.slidesContainer.insertBefore(newSlide, existingSlide);
      ***REMOVED***

          if (this.settings.preload && this.index == 0 && index == 0 || this.index - 1 == index || this.index + 1 == index) {
            this.preloadSlide(index);
      ***REMOVED***

          if (this.index == 0 && index == 0) {
            this.index = 1;
      ***REMOVED***

          this.updateNavigationClasses();
          addedSlideNode = this.slidesContainer.querySelectorAll('.gslide')[index***REMOVED***;
          addedSlidePlayer = this.getSlidePlayerInstance(index);
          slideInfo.slideNode = addedSlideNode;
    ***REMOVED***

        this.trigger('slide_inserted', {
          index: index,
          slide: addedSlideNode,
          slideNode: addedSlideNode,
          slideConfig: data,
          slideIndex: index,
          trigger: null,
          player: addedSlidePlayer
    ***REMOVED***);

        if (isFunction(this.settings.slideInserted)) {
          this.settings.slideInserted({
            index: index,
            slide: addedSlideNode,
            player: addedSlidePlayer
      ***REMOVED***);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "removeSlide",
      value: function removeSlide() {
        var index = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : -1;

        if (index < 0 || index > this.elements.length - 1) {
          return false;
    ***REMOVED***

        var slide = this.slidesContainer && this.slidesContainer.querySelectorAll('.gslide')[index***REMOVED***;

        if (slide) {
          if (this.getActiveSlideIndex() == index) {
            if (index == this.elements.length - 1) {
              this.prevSlide();
        ***REMOVED*** else {
              this.nextSlide();
        ***REMOVED***
      ***REMOVED***

          slide.parentNode.removeChild(slide);
    ***REMOVED***

        this.elements.splice(index, 1);
        this.trigger('slide_removed', index);

        if (isFunction(this.settings.slideRemoved)) {
          this.settings.slideRemoved(index);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "slideAnimateIn",
      value: function slideAnimateIn(slide, first) {
        var _this4 = this;

        var slideMedia = slide.querySelector('.gslide-media');
        var slideDesc = slide.querySelector('.gslide-description');
        var prevData = {
          index: this.prevActiveSlideIndex,
          slide: this.prevActiveSlide,
          slideNode: this.prevActiveSlide,
          slideIndex: this.prevActiveSlide,
          slideConfig: isNil(this.prevActiveSlideIndex) ? null : this.elements[this.prevActiveSlideIndex***REMOVED***.slideConfig,
          trigger: isNil(this.prevActiveSlideIndex) ? null : this.elements[this.prevActiveSlideIndex***REMOVED***.node,
          player: this.getSlidePlayerInstance(this.prevActiveSlideIndex)
    ***REMOVED***;
        var nextData = {
          index: this.index,
          slide: this.activeSlide,
          slideNode: this.activeSlide,
          slideConfig: this.elements[this.index***REMOVED***.slideConfig,
          slideIndex: this.index,
          trigger: this.elements[this.index***REMOVED***.node,
          player: this.getSlidePlayerInstance(this.index)
    ***REMOVED***;

        if (slideMedia.offsetWidth > 0 && slideDesc) {
          hide(slideDesc);

          slideDesc.style.display = '';
    ***REMOVED***

        removeClass(slide, this.effectsClasses);

        if (first) {
          animateElement(slide, this.settings.cssEfects[this.settings.openEffect***REMOVED***["in"***REMOVED***, function () {
            if (_this4.settings.autoplayVideos) {
              _this4.slidePlayerPlay(slide);
        ***REMOVED***

            _this4.trigger('slide_changed', {
              prev: prevData,
              current: nextData
        ***REMOVED***);

            if (isFunction(_this4.settings.afterSlideChange)) {
              _this4.settings.afterSlideChange.apply(_this4, [prevData, nextData***REMOVED***);
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED*** else {
          var effectName = this.settings.slideEffect;
          var animIn = effectName !== 'none' ? this.settings.cssEfects[effectName***REMOVED***["in"***REMOVED*** : effectName;

          if (this.prevActiveSlideIndex > this.index) {
            if (this.settings.slideEffect == 'slide') {
              animIn = this.settings.cssEfects.slideBack["in"***REMOVED***;
        ***REMOVED***
      ***REMOVED***

          animateElement(slide, animIn, function () {
            if (_this4.settings.autoplayVideos) {
              _this4.slidePlayerPlay(slide);
        ***REMOVED***

            _this4.trigger('slide_changed', {
              prev: prevData,
              current: nextData
        ***REMOVED***);

            if (isFunction(_this4.settings.afterSlideChange)) {
              _this4.settings.afterSlideChange.apply(_this4, [prevData, nextData***REMOVED***);
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED***

        setTimeout(function () {
          _this4.resize(slide);
***REMOVED*** 100);

        addClass(slide, 'current');
  ***REMOVED***
***REMOVED*** {
      key: "slideAnimateOut",
      value: function slideAnimateOut() {
        if (!this.prevActiveSlide) {
          return false;
    ***REMOVED***

        var prevSlide = this.prevActiveSlide;

        removeClass(prevSlide, this.effectsClasses);

        addClass(prevSlide, 'prev');

        var animation = this.settings.slideEffect;
        var animOut = animation !== 'none' ? this.settings.cssEfects[animation***REMOVED***.out : animation;
        this.slidePlayerPause(prevSlide);
        this.trigger('slide_before_change', {
          prev: {
            index: this.prevActiveSlideIndex,
            slide: this.prevActiveSlide,
            slideNode: this.prevActiveSlide,
            slideIndex: this.prevActiveSlideIndex,
            slideConfig: isNil(this.prevActiveSlideIndex) ? null : this.elements[this.prevActiveSlideIndex***REMOVED***.slideConfig,
            trigger: isNil(this.prevActiveSlideIndex) ? null : this.elements[this.prevActiveSlideIndex***REMOVED***.node,
            player: this.getSlidePlayerInstance(this.prevActiveSlideIndex)
  ***REMOVED***
          current: {
            index: this.index,
            slide: this.activeSlide,
            slideNode: this.activeSlide,
            slideIndex: this.index,
            slideConfig: this.elements[this.index***REMOVED***.slideConfig,
            trigger: this.elements[this.index***REMOVED***.node,
            player: this.getSlidePlayerInstance(this.index)
      ***REMOVED***
    ***REMOVED***);

        if (isFunction(this.settings.beforeSlideChange)) {
          this.settings.beforeSlideChange.apply(this, [{
            index: this.prevActiveSlideIndex,
            slide: this.prevActiveSlide,
            player: this.getSlidePlayerInstance(this.prevActiveSlideIndex)
  ***REMOVED*** {
            index: this.index,
            slide: this.activeSlide,
            player: this.getSlidePlayerInstance(this.index)
      ***REMOVED******REMOVED***);
    ***REMOVED***

        if (this.prevActiveSlideIndex > this.index && this.settings.slideEffect == 'slide') {
          animOut = this.settings.cssEfects.slideBack.out;
    ***REMOVED***

        animateElement(prevSlide, animOut, function () {
          var container = prevSlide.querySelector('.ginner-container');
          var media = prevSlide.querySelector('.gslide-media');
          var desc = prevSlide.querySelector('.gslide-description');
          container.style.transform = '';
          media.style.transform = '';

          removeClass(media, 'greset');

          media.style.opacity = '';

          if (desc) {
            desc.style.opacity = '';
      ***REMOVED***

          removeClass(prevSlide, 'prev');
    ***REMOVED***);
  ***REMOVED***
***REMOVED*** {
      key: "getAllPlayers",
      value: function getAllPlayers() {
        return this.videoPlayers;
  ***REMOVED***
***REMOVED*** {
      key: "getSlidePlayerInstance",
      value: function getSlidePlayerInstance(index) {
        var id = 'gvideo' + index;
        var videoPlayers = this.getAllPlayers();

        if (has(videoPlayers, id) && videoPlayers[id***REMOVED***) {
          return videoPlayers[id***REMOVED***;
    ***REMOVED***

        return false;
  ***REMOVED***
***REMOVED*** {
      key: "stopSlideVideo",
      value: function stopSlideVideo(slide) {
        if (isNode(slide)) {
          var node = slide.querySelector('.gvideo-wrapper');

          if (node) {
            slide = node.getAttribute('data-index');
      ***REMOVED***
    ***REMOVED***

        console.log('stopSlideVideo is deprecated, use slidePlayerPause');
        var player = this.getSlidePlayerInstance(slide);

        if (player && player.playing) {
          player.pause();
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "slidePlayerPause",
      value: function slidePlayerPause(slide) {
        if (isNode(slide)) {
          var node = slide.querySelector('.gvideo-wrapper');

          if (node) {
            slide = node.getAttribute('data-index');
      ***REMOVED***
    ***REMOVED***

        var player = this.getSlidePlayerInstance(slide);

        if (player && player.playing) {
          player.pause();
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "playSlideVideo",
      value: function playSlideVideo(slide) {
        if (isNode(slide)) {
          var node = slide.querySelector('.gvideo-wrapper');

          if (node) {
            slide = node.getAttribute('data-index');
      ***REMOVED***
    ***REMOVED***

        console.log('playSlideVideo is deprecated, use slidePlayerPlay');
        var player = this.getSlidePlayerInstance(slide);

        if (player && !player.playing) {
          player.play();
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "slidePlayerPlay",
      value: function slidePlayerPlay(slide) {
        if (isNode(slide)) {
          var node = slide.querySelector('.gvideo-wrapper');

          if (node) {
            slide = node.getAttribute('data-index');
      ***REMOVED***
    ***REMOVED***

        var player = this.getSlidePlayerInstance(slide);

        if (player && !player.playing) {
          player.play();

          if (this.settings.autofocusVideos) {
            player.elements.container.focus();
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "setElements",
      value: function setElements(elements) {
        var _this5 = this;

        this.settings.elements = false;
        var newElements = [***REMOVED***;

        if (elements && elements.length) {
          each(elements, function (el, i) {
            var slide = new Slide(el, _this5, i);
            var data = slide.getConfig();

            var slideInfo = extend({}, data);

            slideInfo.slideConfig = data;
            slideInfo.instance = slide;
            slideInfo.index = i;
            newElements.push(slideInfo);
      ***REMOVED***);
    ***REMOVED***

        this.elements = newElements;

        if (this.lightboxOpen) {
          this.slidesContainer.innerHTML = '';

          if (this.elements.length) {
            each(this.elements, function () {
              var slide = createHTML(_this5.settings.slideHTML);

              _this5.slidesContainer.appendChild(slide);
        ***REMOVED***);

            this.showSlide(0, true);
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "getElementIndex",
      value: function getElementIndex(node) {
        var index = false;

        each(this.elements, function (el, i) {
          if (has(el, 'node') && el.node == node) {
            index = i;
            return true;
      ***REMOVED***
    ***REMOVED***);

        return index;
  ***REMOVED***
***REMOVED*** {
      key: "getElements",
      value: function getElements() {
        var _this6 = this;

        var list = [***REMOVED***;
        this.elements = this.elements ? this.elements : [***REMOVED***;

        if (!isNil(this.settings.elements) && isArray(this.settings.elements) && this.settings.elements.length) {
          each(this.settings.elements, function (el, i) {
            var slide = new Slide(el, _this6, i);
            var elData = slide.getConfig();

            var slideInfo = extend({}, elData);

            slideInfo.node = false;
            slideInfo.index = i;
            slideInfo.instance = slide;
            slideInfo.slideConfig = elData;
            list.push(slideInfo);
      ***REMOVED***);
    ***REMOVED***

        var nodes = false;
        var selector = this.getSelector();

        if (selector) {
          nodes = document.querySelectorAll(this.getSelector());
    ***REMOVED***

        if (!nodes) {
          return list;
    ***REMOVED***

        each(nodes, function (el, i) {
          var slide = new Slide(el, _this6, i);
          var elData = slide.getConfig();

          var slideInfo = extend({}, elData);

          slideInfo.node = el;
          slideInfo.index = i;
          slideInfo.instance = slide;
          slideInfo.slideConfig = elData;
          slideInfo.gallery = el.getAttribute('data-gallery');
          list.push(slideInfo);
    ***REMOVED***);

        return list;
  ***REMOVED***
***REMOVED*** {
      key: "getGalleryElements",
      value: function getGalleryElements(list, gallery) {
        return list.filter(function (el) {
          return el.gallery == gallery;
    ***REMOVED***);
  ***REMOVED***
***REMOVED*** {
      key: "getSelector",
      value: function getSelector() {
        if (this.settings.elements) {
          return false;
    ***REMOVED***

        if (this.settings.selector && this.settings.selector.substring(0, 5) == 'data-') {
          return "*[".concat(this.settings.selector, "***REMOVED***");
    ***REMOVED***

        return this.settings.selector;
  ***REMOVED***
***REMOVED*** {
      key: "getActiveSlide",
      value: function getActiveSlide() {
        return this.slidesContainer.querySelectorAll('.gslide')[this.index***REMOVED***;
  ***REMOVED***
***REMOVED*** {
      key: "getActiveSlideIndex",
      value: function getActiveSlideIndex() {
        return this.index;
  ***REMOVED***
***REMOVED*** {
      key: "getAnimationClasses",
      value: function getAnimationClasses() {
        var effects = [***REMOVED***;

        for (var key in this.settings.cssEfects) {
          if (this.settings.cssEfects.hasOwnProperty(key)) {
            var effect = this.settings.cssEfects[key***REMOVED***;
            effects.push("g".concat(effect["in"***REMOVED***));
            effects.push("g".concat(effect.out));
      ***REMOVED***
    ***REMOVED***

        return effects.join(' ');
  ***REMOVED***
***REMOVED*** {
      key: "build",
      value: function build() {
        var _this7 = this;

        if (this.built) {
          return false;
    ***REMOVED***

        var children = document.body.childNodes;
        var bodyChildElms = [***REMOVED***;

        each(children, function (el) {
          if (el.parentNode == document.body && el.nodeName.charAt(0) !== '#' && el.hasAttribute && !el.hasAttribute('aria-hidden')) {
            bodyChildElms.push(el);
            el.setAttribute('aria-hidden', 'true');
      ***REMOVED***
    ***REMOVED***);

        var nextSVG = has(this.settings.svg, 'next') ? this.settings.svg.next : '';
        var prevSVG = has(this.settings.svg, 'prev') ? this.settings.svg.prev : '';
        var closeSVG = has(this.settings.svg, 'close') ? this.settings.svg.close : '';
        var lightboxHTML = this.settings.lightboxHTML;
        lightboxHTML = lightboxHTML.replace(/{nextSVG}/g, nextSVG);
        lightboxHTML = lightboxHTML.replace(/{prevSVG}/g, prevSVG);
        lightboxHTML = lightboxHTML.replace(/{closeSVG}/g, closeSVG);
        lightboxHTML = createHTML(lightboxHTML);
        document.body.appendChild(lightboxHTML);
        var modal = document.getElementById('glightbox-body');
        this.modal = modal;
        var closeButton = modal.querySelector('.gclose');
        this.prevButton = modal.querySelector('.gprev');
        this.nextButton = modal.querySelector('.gnext');
        this.overlay = modal.querySelector('.goverlay');
        this.loader = modal.querySelector('.gloader');
        this.slidesContainer = document.getElementById('glightbox-slider');
        this.bodyHiddenChildElms = bodyChildElms;
        this.events = {};

        addClass(this.modal, 'glightbox-' + this.settings.skin);

        if (this.settings.closeButton && closeButton) {
          this.events['close'***REMOVED*** = addEvent('click', {
            onElement: closeButton,
            withCallback: function withCallback(e, target) {
              e.preventDefault();

              _this7.close();
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED***

        if (closeButton && !this.settings.closeButton) {
          closeButton.parentNode.removeChild(closeButton);
    ***REMOVED***

        if (this.nextButton) {
          this.events['next'***REMOVED*** = addEvent('click', {
            onElement: this.nextButton,
            withCallback: function withCallback(e, target) {
              e.preventDefault();

              _this7.nextSlide();
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED***

        if (this.prevButton) {
          this.events['prev'***REMOVED*** = addEvent('click', {
            onElement: this.prevButton,
            withCallback: function withCallback(e, target) {
              e.preventDefault();

              _this7.prevSlide();
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED***

        if (this.settings.closeOnOutsideClick) {
          this.events['outClose'***REMOVED*** = addEvent('click', {
            onElement: modal,
            withCallback: function withCallback(e, target) {
              if (!_this7.preventOutsideClick && !hasClass(document.body, 'glightbox-mobile') && !closest(e.target, '.ginner-container')) {
                if (!closest(e.target, '.gbtn') && !hasClass(e.target, 'gnext') && !hasClass(e.target, 'gprev')) {
                  _this7.close();
            ***REMOVED***
          ***REMOVED***
        ***REMOVED***
      ***REMOVED***);
    ***REMOVED***

        each(this.elements, function (slide, i) {
          _this7.slidesContainer.appendChild(slide.instance.create());

          slide.slideNode = _this7.slidesContainer.querySelectorAll('.gslide')[i***REMOVED***;
    ***REMOVED***);

        if (isTouch$1) {
          addClass(document.body, 'glightbox-touch');
    ***REMOVED***

        this.events['resize'***REMOVED*** = addEvent('resize', {
          onElement: window,
          withCallback: function withCallback() {
            _this7.resize();
      ***REMOVED***
    ***REMOVED***);
        this.built = true;
  ***REMOVED***
***REMOVED*** {
      key: "resize",
      value: function resize() {
        var slide = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : null;
        slide = !slide ? this.activeSlide : slide;

        if (!slide || hasClass(slide, 'zoomed')) {
          return;
    ***REMOVED***

        var winSize = windowSize();

        var video = slide.querySelector('.gvideo-wrapper');
        var image = slide.querySelector('.gslide-image');
        var description = this.slideDescription;
        var winWidth = winSize.width;
        var winHeight = winSize.height;

        if (winWidth <= 768) {
          addClass(document.body, 'glightbox-mobile');
    ***REMOVED*** else {
          removeClass(document.body, 'glightbox-mobile');
    ***REMOVED***

        if (!video && !image) {
          return;
    ***REMOVED***

        var descriptionResize = false;

        if (description && (hasClass(description, 'description-bottom') || hasClass(description, 'description-top')) && !hasClass(description, 'gabsolute')) {
          descriptionResize = true;
    ***REMOVED***

        if (image) {
          if (winWidth <= 768) {
            var imgNode = image.querySelector('img');
      ***REMOVED*** else if (descriptionResize) {
            var descHeight = description.offsetHeight;

            var _imgNode = image.querySelector('img');

            _imgNode.setAttribute('style', "max-height: calc(100vh - ".concat(descHeight, "px)"));

            description.setAttribute('style', "max-width: ".concat(_imgNode.offsetWidth, "px;"));
      ***REMOVED***
    ***REMOVED***

        if (video) {
          var ratio = has(this.settings.plyr.config, 'ratio') ? this.settings.plyr.config.ratio : '';

          if (!ratio) {
            var containerWidth = video.clientWidth;
            var containerHeight = video.clientHeight;
            var divisor = containerWidth / containerHeight;
            ratio = "".concat(containerWidth / divisor, ":").concat(containerHeight / divisor);
      ***REMOVED***

          var videoRatio = ratio.split(':');
          var videoWidth = this.settings.videosWidth;
          var maxWidth = this.settings.videosWidth;

          if (isNumber(videoWidth) || videoWidth.indexOf('px') !== -1) {
            maxWidth = parseInt(videoWidth);
      ***REMOVED*** else {
            if (videoWidth.indexOf('vw') !== -1) {
              maxWidth = winWidth * parseInt(videoWidth) / 100;
        ***REMOVED*** else if (videoWidth.indexOf('vh') !== -1) {
              maxWidth = winHeight * parseInt(videoWidth) / 100;
        ***REMOVED*** else if (videoWidth.indexOf('%') !== -1) {
              maxWidth = winWidth * parseInt(videoWidth) / 100;
        ***REMOVED*** else {
              maxWidth = parseInt(video.clientWidth);
        ***REMOVED***
      ***REMOVED***

          var maxHeight = maxWidth / (parseInt(videoRatio[0***REMOVED***) / parseInt(videoRatio[1***REMOVED***));
          maxHeight = Math.floor(maxHeight);

          if (descriptionResize) {
            winHeight = winHeight - description.offsetHeight;
      ***REMOVED***

          if (maxWidth > winWidth || maxHeight > winHeight || winHeight < maxHeight && winWidth > maxWidth) {
            var vwidth = video.offsetWidth;
            var vheight = video.offsetHeight;

            var _ratio = winHeight / vheight;

            var vsize = {
              width: vwidth * _ratio,
              height: vheight * _ratio
        ***REMOVED***;
            video.parentNode.setAttribute('style', "max-width: ".concat(vsize.width, "px"));

            if (descriptionResize) {
              description.setAttribute('style', "max-width: ".concat(vsize.width, "px;"));
        ***REMOVED***
      ***REMOVED*** else {
            video.parentNode.style.maxWidth = "".concat(videoWidth);

            if (descriptionResize) {
              description.setAttribute('style', "max-width: ".concat(videoWidth, ";"));
        ***REMOVED***
      ***REMOVED***
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "reload",
      value: function reload() {
        this.init();
  ***REMOVED***
***REMOVED*** {
      key: "updateNavigationClasses",
      value: function updateNavigationClasses() {
        var loop = this.loop();

        removeClass(this.nextButton, 'disabled');

        removeClass(this.prevButton, 'disabled');

        if (this.index == 0 && this.elements.length - 1 == 0) {
          addClass(this.prevButton, 'disabled');

          addClass(this.nextButton, 'disabled');
    ***REMOVED*** else if (this.index === 0 && !loop) {
          addClass(this.prevButton, 'disabled');
    ***REMOVED*** else if (this.index === this.elements.length - 1 && !loop) {
          addClass(this.nextButton, 'disabled');
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "loop",
      value: function loop() {
        var loop = has(this.settings, 'loopAtEnd') ? this.settings.loopAtEnd : null;
        loop = has(this.settings, 'loop') ? this.settings.loop : loop;
        return loop;
  ***REMOVED***
***REMOVED*** {
      key: "close",
      value: function close() {
        var _this8 = this;

        if (!this.lightboxOpen) {
          if (this.events) {
            for (var key in this.events) {
              if (this.events.hasOwnProperty(key)) {
                this.events[key***REMOVED***.destroy();
          ***REMOVED***
        ***REMOVED***

            this.events = null;
      ***REMOVED***

          return false;
    ***REMOVED***

        if (this.closing) {
          return false;
    ***REMOVED***

        this.closing = true;
        this.slidePlayerPause(this.activeSlide);

        if (this.fullElementsList) {
          this.elements = this.fullElementsList;
    ***REMOVED***

        if (this.bodyHiddenChildElms.length) {
          each(this.bodyHiddenChildElms, function (el) {
            el.removeAttribute('aria-hidden');
      ***REMOVED***);
    ***REMOVED***

        addClass(this.modal, 'glightbox-closing');

        animateElement(this.overlay, this.settings.openEffect == 'none' ? 'none' : this.settings.cssEfects.fade.out);

        animateElement(this.activeSlide, this.settings.cssEfects[this.settings.closeEffect***REMOVED***.out, function () {
          _this8.activeSlide = null;
          _this8.prevActiveSlideIndex = null;
          _this8.prevActiveSlide = null;
          _this8.built = false;

          if (_this8.events) {
            for (var _key in _this8.events) {
              if (_this8.events.hasOwnProperty(_key)) {
                _this8.events[_key***REMOVED***.destroy();
          ***REMOVED***
        ***REMOVED***

            _this8.events = null;
      ***REMOVED***

          var body = document.body;

          removeClass(html, 'glightbox-open');

          removeClass(body, 'glightbox-open touching gdesc-open glightbox-touch glightbox-mobile gscrollbar-fixer');

          _this8.modal.parentNode.removeChild(_this8.modal);

          _this8.trigger('close');

          if (isFunction(_this8.settings.onClose)) {
            _this8.settings.onClose();
      ***REMOVED***

          var styles = document.querySelector('.gcss-styles');

          if (styles) {
            styles.parentNode.removeChild(styles);
      ***REMOVED***

          _this8.lightboxOpen = false;
          _this8.closing = null;
    ***REMOVED***);
  ***REMOVED***
***REMOVED*** {
      key: "destroy",
      value: function destroy() {
        this.close();
        this.clearAllEvents();

        if (this.baseEvents) {
          this.baseEvents.destroy();
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "on",
      value: function on(evt, callback) {
        var once = arguments.length > 2 && arguments[2***REMOVED*** !== undefined ? arguments[2***REMOVED*** : false;

        if (!evt || !isFunction(callback)) {
          throw new TypeError('Event name and callback must be defined');
    ***REMOVED***

        this.apiEvents.push({
          evt: evt,
          once: once,
          callback: callback
    ***REMOVED***);
  ***REMOVED***
***REMOVED*** {
      key: "once",
      value: function once(evt, callback) {
        this.on(evt, callback, true);
  ***REMOVED***
***REMOVED*** {
      key: "trigger",
      value: function trigger(eventName) {
        var _this9 = this;

        var data = arguments.length > 1 && arguments[1***REMOVED*** !== undefined ? arguments[1***REMOVED*** : null;
        var onceTriggered = [***REMOVED***;

        each(this.apiEvents, function (event, i) {
          var evt = event.evt,
              once = event.once,
              callback = event.callback;

          if (evt == eventName) {
            callback(data);

            if (once) {
              onceTriggered.push(i);
        ***REMOVED***
      ***REMOVED***
    ***REMOVED***);

        if (onceTriggered.length) {
          each(onceTriggered, function (i) {
            return _this9.apiEvents.splice(i, 1);
      ***REMOVED***);
    ***REMOVED***
  ***REMOVED***
***REMOVED*** {
      key: "clearAllEvents",
      value: function clearAllEvents() {
        this.apiEvents.splice(0, this.apiEvents.length);
  ***REMOVED***
***REMOVED*** {
      key: "version",
      value: function version() {
        return _version;
  ***REMOVED***
***REMOVED******REMOVED***);

    return GlightboxInit;
  }();

  function glightbox () {
    var options = arguments.length > 0 && arguments[0***REMOVED*** !== undefined ? arguments[0***REMOVED*** : {};
    var instance = new GlightboxInit(options);
    instance.init();
    return instance;
  }

  return glightbox;

})));
