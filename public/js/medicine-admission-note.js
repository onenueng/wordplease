webpackJsonp([0],[
/* 0 */
/***/ (function(module, exports) {

/* globals __VUE_SSR_CONTEXT__ */

// IMPORTANT: Do NOT use ES2015 features in this file.
// This module is a runtime utility for cleaner component module output and will
// be included in the final webpack user bundle.

module.exports = function normalizeComponent (
  rawScriptExports,
  compiledTemplate,
  functionalTemplate,
  injectStyles,
  scopeId,
  moduleIdentifier /* server only */
) {
  var esModule
  var scriptExports = rawScriptExports = rawScriptExports || {}

  // ES6 modules interop
  var type = typeof rawScriptExports.default
  if (type === 'object' || type === 'function') {
    esModule = rawScriptExports
    scriptExports = rawScriptExports.default
  }

  // Vue.extend constructor export interop
  var options = typeof scriptExports === 'function'
    ? scriptExports.options
    : scriptExports

  // render functions
  if (compiledTemplate) {
    options.render = compiledTemplate.render
    options.staticRenderFns = compiledTemplate.staticRenderFns
    options._compiled = true
  }

  // functional template
  if (functionalTemplate) {
    options.functional = true
  }

  // scopedId
  if (scopeId) {
    options._scopeId = scopeId
  }

  var hook
  if (moduleIdentifier) { // server build
    hook = function (context) {
      // 2.3 injection
      context =
        context || // cached call
        (this.$vnode && this.$vnode.ssrContext) || // stateful
        (this.parent && this.parent.$vnode && this.parent.$vnode.ssrContext) // functional
      // 2.2 with runInNewContext: true
      if (!context && typeof __VUE_SSR_CONTEXT__ !== 'undefined') {
        context = __VUE_SSR_CONTEXT__
      }
      // inject component styles
      if (injectStyles) {
        injectStyles.call(this, context)
      }
      // register component module identifier for async chunk inferrence
      if (context && context._registeredComponents) {
        context._registeredComponents.add(moduleIdentifier)
      }
    }
    // used by ssr in case component is cached and beforeCreate
    // never gets called
    options._ssrRegister = hook
  } else if (injectStyles) {
    hook = injectStyles
  }

  if (hook) {
    var functional = options.functional
    var existing = functional
      ? options.render
      : options.beforeCreate

    if (!functional) {
      // inject component registration as beforeCreate hook
      options.beforeCreate = existing
        ? [].concat(existing, hook)
        : [hook]
    } else {
      // for template-only hot-reload because in that case the render fn doesn't
      // go through the normalizer
      options._injectStyles = hook
      // register for functioal component in vue file
      options.render = function renderWithStyleInjection (h, context) {
        hook.call(context)
        return existing(h, context)
      }
    }
  }

  return {
    esModule: esModule,
    exports: scriptExports,
    options: options
  }
}


/***/ }),
/* 1 */,
/* 2 */
/***/ (function(module, exports) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/
// css base code, injected by the css-loader
module.exports = function(useSourceMap) {
	var list = [];

	// return the list of modules as css string
	list.toString = function toString() {
		return this.map(function (item) {
			var content = cssWithMappingToString(item, useSourceMap);
			if(item[2]) {
				return "@media " + item[2] + "{" + content + "}";
			} else {
				return content;
			}
		}).join("");
	};

	// import a list of modules into the list
	list.i = function(modules, mediaQuery) {
		if(typeof modules === "string")
			modules = [[null, modules, ""]];
		var alreadyImportedModules = {};
		for(var i = 0; i < this.length; i++) {
			var id = this[i][0];
			if(typeof id === "number")
				alreadyImportedModules[id] = true;
		}
		for(i = 0; i < modules.length; i++) {
			var item = modules[i];
			// skip already imported module
			// this implementation is not 100% perfect for weird media query combinations
			//  when a module is imported multiple times with different media queries.
			//  I hope this will never occur (Hey this way we have smaller bundles)
			if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
				if(mediaQuery && !item[2]) {
					item[2] = mediaQuery;
				} else if(mediaQuery) {
					item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
				}
				list.push(item);
			}
		}
	};
	return list;
};

function cssWithMappingToString(item, useSourceMap) {
	var content = item[1] || '';
	var cssMapping = item[3];
	if (!cssMapping) {
		return content;
	}

	if (useSourceMap && typeof btoa === 'function') {
		var sourceMapping = toComment(cssMapping);
		var sourceURLs = cssMapping.sources.map(function (source) {
			return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */'
		});

		return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	}

	return [content].join('\n');
}

// Adapted from convert-source-map (MIT)
function toComment(sourceMap) {
	// eslint-disable-next-line no-undef
	var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;

	return '/*# ' + data + ' */';
}


/***/ }),
/* 3 */
/***/ (function(module, exports, __webpack_require__) {

/*
  MIT License http://www.opensource.org/licenses/mit-license.php
  Author Tobias Koppers @sokra
  Modified by Evan You @yyx990803
*/

var hasDocument = typeof document !== 'undefined'

if (typeof DEBUG !== 'undefined' && DEBUG) {
  if (!hasDocument) {
    throw new Error(
    'vue-style-loader cannot be used in a non-browser environment. ' +
    "Use { target: 'node' } in your Webpack config to indicate a server-rendering environment."
  ) }
}

var listToStyles = __webpack_require__(10)

/*
type StyleObject = {
  id: number;
  parts: Array<StyleObjectPart>
}

type StyleObjectPart = {
  css: string;
  media: string;
  sourceMap: ?string
}
*/

var stylesInDom = {/*
  [id: number]: {
    id: number,
    refs: number,
    parts: Array<(obj?: StyleObjectPart) => void>
  }
*/}

var head = hasDocument && (document.head || document.getElementsByTagName('head')[0])
var singletonElement = null
var singletonCounter = 0
var isProduction = false
var noop = function () {}
var options = null
var ssrIdKey = 'data-vue-ssr-id'

// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
// tags it will allow on a page
var isOldIE = typeof navigator !== 'undefined' && /msie [6-9]\b/.test(navigator.userAgent.toLowerCase())

module.exports = function (parentId, list, _isProduction, _options) {
  isProduction = _isProduction

  options = _options || {}

  var styles = listToStyles(parentId, list)
  addStylesToDom(styles)

  return function update (newList) {
    var mayRemove = []
    for (var i = 0; i < styles.length; i++) {
      var item = styles[i]
      var domStyle = stylesInDom[item.id]
      domStyle.refs--
      mayRemove.push(domStyle)
    }
    if (newList) {
      styles = listToStyles(parentId, newList)
      addStylesToDom(styles)
    } else {
      styles = []
    }
    for (var i = 0; i < mayRemove.length; i++) {
      var domStyle = mayRemove[i]
      if (domStyle.refs === 0) {
        for (var j = 0; j < domStyle.parts.length; j++) {
          domStyle.parts[j]()
        }
        delete stylesInDom[domStyle.id]
      }
    }
  }
}

function addStylesToDom (styles /* Array<StyleObject> */) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i]
    var domStyle = stylesInDom[item.id]
    if (domStyle) {
      domStyle.refs++
      for (var j = 0; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j])
      }
      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j]))
      }
      if (domStyle.parts.length > item.parts.length) {
        domStyle.parts.length = item.parts.length
      }
    } else {
      var parts = []
      for (var j = 0; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j]))
      }
      stylesInDom[item.id] = { id: item.id, refs: 1, parts: parts }
    }
  }
}

function createStyleElement () {
  var styleElement = document.createElement('style')
  styleElement.type = 'text/css'
  head.appendChild(styleElement)
  return styleElement
}

function addStyle (obj /* StyleObjectPart */) {
  var update, remove
  var styleElement = document.querySelector('style[' + ssrIdKey + '~="' + obj.id + '"]')

  if (styleElement) {
    if (isProduction) {
      // has SSR styles and in production mode.
      // simply do nothing.
      return noop
    } else {
      // has SSR styles but in dev mode.
      // for some reason Chrome can't handle source map in server-rendered
      // style tags - source maps in <style> only works if the style tag is
      // created and inserted dynamically. So we remove the server rendered
      // styles and inject new ones.
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  if (isOldIE) {
    // use singleton mode for IE9.
    var styleIndex = singletonCounter++
    styleElement = singletonElement || (singletonElement = createStyleElement())
    update = applyToSingletonTag.bind(null, styleElement, styleIndex, false)
    remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true)
  } else {
    // use multi-style-tag mode in all other cases
    styleElement = createStyleElement()
    update = applyToTag.bind(null, styleElement)
    remove = function () {
      styleElement.parentNode.removeChild(styleElement)
    }
  }

  update(obj)

  return function updateStyle (newObj /* StyleObjectPart */) {
    if (newObj) {
      if (newObj.css === obj.css &&
          newObj.media === obj.media &&
          newObj.sourceMap === obj.sourceMap) {
        return
      }
      update(obj = newObj)
    } else {
      remove()
    }
  }
}

var replaceText = (function () {
  var textStore = []

  return function (index, replacement) {
    textStore[index] = replacement
    return textStore.filter(Boolean).join('\n')
  }
})()

function applyToSingletonTag (styleElement, index, remove, obj) {
  var css = remove ? '' : obj.css

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = replaceText(index, css)
  } else {
    var cssNode = document.createTextNode(css)
    var childNodes = styleElement.childNodes
    if (childNodes[index]) styleElement.removeChild(childNodes[index])
    if (childNodes.length) {
      styleElement.insertBefore(cssNode, childNodes[index])
    } else {
      styleElement.appendChild(cssNode)
    }
  }
}

function applyToTag (styleElement, obj) {
  var css = obj.css
  var media = obj.media
  var sourceMap = obj.sourceMap

  if (media) {
    styleElement.setAttribute('media', media)
  }
  if (options.ssrId) {
    styleElement.setAttribute(ssrIdKey, obj.id)
  }

  if (sourceMap) {
    // https://developer.chrome.com/devtools/docs/javascript-debugging
    // this makes source maps inside style tags work properly in Chrome
    css += '\n/*# sourceURL=' + sourceMap.sources[0] + ' */'
    // http://stackoverflow.com/a/26603875
    css += '\n/*# sourceMappingURL=data:application/json;base64,' + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + ' */'
  }

  if (styleElement.styleSheet) {
    styleElement.styleSheet.cssText = css
  } else {
    while (styleElement.firstChild) {
      styleElement.removeChild(styleElement.firstChild)
    }
    styleElement.appendChild(document.createTextNode(css))
  }
}


/***/ }),
/* 4 */,
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(__webpack_provided_window_dot_jQuery) {window._ = __webpack_require__(16);

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

// try {
//     window.$ = window.jQuery = require('jquery');

//     require('bootstrap-sass');
// } catch (e) {}
window.$ = __webpack_provided_window_dot_jQuery = __webpack_require__(1);
__webpack_require__(17);
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(18);

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Vue = __webpack_require__(19);

__webpack_require__(6);
window.flatpickr = __webpack_require__(20); // const flatpickr = require("flatpickr");

window.autosize = __webpack_require__(21);

__webpack_require__(22); // need change to min

window.SESSION_LIFETIME = 1000 * 60 * 60; // an hour
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(1)))

/***/ }),
/* 6 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(7);
if(typeof content === 'string') content = [[module.i, content, '']];
// Prepare cssTransformation
var transform;

var options = {}
options.transform = transform
// add the styles to the DOM
var update = __webpack_require__(8)(content, options);
if(content.locals) module.exports = content.locals;
// Hot Module Replacement
if(false) {
	// When the styles change, update the <style> tags
	if(!content.locals) {
		module.hot.accept("!!../../../css-loader/index.js!./dark.css", function() {
			var newContent = require("!!../../../css-loader/index.js!./dark.css");
			if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
			update(newContent);
		});
	}
	// When the module is disposed, remove the <style> tags
	module.hot.dispose(function() { update(); });
}

/***/ }),
/* 7 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, ".flatpickr-calendar {\n  background: transparent;\n  opacity: 0;\n  display: none;\n  text-align: center;\n  visibility: hidden;\n  padding: 0;\n  -webkit-animation: none;\n          animation: none;\n  direction: ltr;\n  border: 0;\n  font-size: 14px;\n  line-height: 24px;\n  border-radius: 5px;\n  position: absolute;\n  width: 307.875px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  -ms-touch-action: manipulation;\n      touch-action: manipulation;\n  background: rgba(63,68,88,0.98);\n  -webkit-box-shadow: 1px 0 0 #3f4458, -1px 0 0 #3f4458, 0 1px 0 #3f4458, 0 -1px 0 #3f4458, 0 3px 13px rgba(0,0,0,0.08);\n          box-shadow: 1px 0 0 #3f4458, -1px 0 0 #3f4458, 0 1px 0 #3f4458, 0 -1px 0 #3f4458, 0 3px 13px rgba(0,0,0,0.08);\n}\n.flatpickr-calendar.open,\n.flatpickr-calendar.inline {\n  opacity: 1;\n  max-height: 640px;\n  visibility: visible;\n}\n.flatpickr-calendar.open {\n  display: inline-block;\n  z-index: 99999;\n}\n.flatpickr-calendar.animate.open {\n  -webkit-animation: fpFadeInDown 300ms cubic-bezier(0.23, 1, 0.32, 1);\n          animation: fpFadeInDown 300ms cubic-bezier(0.23, 1, 0.32, 1);\n}\n.flatpickr-calendar.inline {\n  display: block;\n  position: relative;\n  top: 2px;\n}\n.flatpickr-calendar.static {\n  position: absolute;\n  top: calc(100% + 2px);\n}\n.flatpickr-calendar.static.open {\n  z-index: 999;\n  display: block;\n}\n.flatpickr-calendar.multiMonth .prevMonthDay,\n.flatpickr-calendar.multiMonth .nextMonthDay {\n  visibility: hidden;\n}\n.flatpickr-calendar.multiMonth .flatpickr-days .dayContainer:nth-child(n+1) .flatpickr-day.inRange:nth-child(7n+7) {\n  -webkit-box-shadow: none !important;\n          box-shadow: none !important;\n}\n.flatpickr-calendar.multiMonth .flatpickr-days .dayContainer:nth-child(n+2) .flatpickr-day.inRange:nth-child(7n+1) {\n  -webkit-box-shadow: -2px 0 0 #e6e6e6, 5px 0 0 #e6e6e6;\n          box-shadow: -2px 0 0 #e6e6e6, 5px 0 0 #e6e6e6;\n}\n.flatpickr-calendar.hasWeeks {\n  width: auto;\n}\n.flatpickr-calendar .hasWeeks .dayContainer,\n.flatpickr-calendar .hasTime .dayContainer {\n  border-bottom: 0;\n  border-bottom-right-radius: 0;\n  border-bottom-left-radius: 0;\n}\n.flatpickr-calendar .hasWeeks .dayContainer {\n  border-left: 0;\n}\n.flatpickr-calendar.showTimeInput.hasTime .flatpickr-time {\n  height: 40px;\n  border-top: 1px solid #3f4458;\n}\n.flatpickr-calendar.noCalendar.hasTime .flatpickr-time {\n  height: auto;\n}\n.flatpickr-calendar:before,\n.flatpickr-calendar:after {\n  position: absolute;\n  display: block;\n  pointer-events: none;\n  border: solid transparent;\n  content: '';\n  height: 0;\n  width: 0;\n  left: 22px;\n}\n.flatpickr-calendar.rightMost:before,\n.flatpickr-calendar.rightMost:after {\n  left: auto;\n  right: 22px;\n}\n.flatpickr-calendar:before {\n  border-width: 5px;\n  margin: 0 -5px;\n}\n.flatpickr-calendar:after {\n  border-width: 4px;\n  margin: 0 -4px;\n}\n.flatpickr-calendar.arrowTop:before,\n.flatpickr-calendar.arrowTop:after {\n  bottom: 100%;\n}\n.flatpickr-calendar.arrowTop:before {\n  border-bottom-color: #3f4458;\n}\n.flatpickr-calendar.arrowTop:after {\n  border-bottom-color: rgba(63,68,88,0.98);\n}\n.flatpickr-calendar.arrowBottom:before,\n.flatpickr-calendar.arrowBottom:after {\n  top: 100%;\n}\n.flatpickr-calendar.arrowBottom:before {\n  border-top-color: #3f4458;\n}\n.flatpickr-calendar.arrowBottom:after {\n  border-top-color: rgba(63,68,88,0.98);\n}\n.flatpickr-calendar:focus {\n  outline: 0;\n}\n.flatpickr-wrapper {\n  position: relative;\n  display: inline-block;\n}\n.flatpickr-months {\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n}\n.flatpickr-months .flatpickr-month {\n  background: transparent;\n  color: #fff;\n  fill: #fff;\n  height: 28px;\n  line-height: 1;\n  text-align: center;\n  position: relative;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n  overflow: hidden;\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n}\n.flatpickr-months .flatpickr-prev-month,\n.flatpickr-months .flatpickr-next-month {\n  text-decoration: none;\n  cursor: pointer;\n  position: absolute;\n  top: 0px;\n  line-height: 16px;\n  height: 28px;\n  padding: 10px;\n  z-index: 3;\n}\n.flatpickr-months .flatpickr-prev-month.disabled,\n.flatpickr-months .flatpickr-next-month.disabled {\n  display: none;\n}\n.flatpickr-months .flatpickr-prev-month i,\n.flatpickr-months .flatpickr-next-month i {\n  position: relative;\n}\n.flatpickr-months .flatpickr-prev-month.flatpickr-prev-month,\n.flatpickr-months .flatpickr-next-month.flatpickr-prev-month {\n/*\n      /*rtl:begin:ignore*/\n/*\n      */\n  left: 0;\n/*\n      /*rtl:end:ignore*/\n/*\n      */\n}\n/*\n      /*rtl:begin:ignore*/\n/*\n      /*rtl:end:ignore*/\n.flatpickr-months .flatpickr-prev-month.flatpickr-next-month,\n.flatpickr-months .flatpickr-next-month.flatpickr-next-month {\n/*\n      /*rtl:begin:ignore*/\n/*\n      */\n  right: 0;\n/*\n      /*rtl:end:ignore*/\n/*\n      */\n}\n/*\n      /*rtl:begin:ignore*/\n/*\n      /*rtl:end:ignore*/\n.flatpickr-months .flatpickr-prev-month:hover,\n.flatpickr-months .flatpickr-next-month:hover {\n  color: #eee;\n}\n.flatpickr-months .flatpickr-prev-month:hover svg,\n.flatpickr-months .flatpickr-next-month:hover svg {\n  fill: #f64747;\n}\n.flatpickr-months .flatpickr-prev-month svg,\n.flatpickr-months .flatpickr-next-month svg {\n  width: 14px;\n  height: 14px;\n}\n.flatpickr-months .flatpickr-prev-month svg path,\n.flatpickr-months .flatpickr-next-month svg path {\n  -webkit-transition: fill 0.1s;\n  transition: fill 0.1s;\n  fill: inherit;\n}\n.numInputWrapper {\n  position: relative;\n  height: auto;\n}\n.numInputWrapper input,\n.numInputWrapper span {\n  display: inline-block;\n}\n.numInputWrapper input {\n  width: 100%;\n}\n.numInputWrapper input::-ms-clear {\n  display: none;\n}\n.numInputWrapper span {\n  position: absolute;\n  right: 0;\n  width: 14px;\n  padding: 0 4px 0 2px;\n  height: 50%;\n  line-height: 50%;\n  opacity: 0;\n  cursor: pointer;\n  border: 1px solid rgba(255,255,255,0.15);\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.numInputWrapper span:hover {\n  background: rgba(192,187,167,0.1);\n}\n.numInputWrapper span:active {\n  background: rgba(192,187,167,0.2);\n}\n.numInputWrapper span:after {\n  display: block;\n  content: \"\";\n  position: absolute;\n}\n.numInputWrapper span.arrowUp {\n  top: 0;\n  border-bottom: 0;\n}\n.numInputWrapper span.arrowUp:after {\n  border-left: 4px solid transparent;\n  border-right: 4px solid transparent;\n  border-bottom: 4px solid rgba(255,255,255,0.6);\n  top: 26%;\n}\n.numInputWrapper span.arrowDown {\n  top: 50%;\n}\n.numInputWrapper span.arrowDown:after {\n  border-left: 4px solid transparent;\n  border-right: 4px solid transparent;\n  border-top: 4px solid rgba(255,255,255,0.6);\n  top: 40%;\n}\n.numInputWrapper span svg {\n  width: inherit;\n  height: auto;\n}\n.numInputWrapper span svg path {\n  fill: rgba(255,255,255,0.5);\n}\n.numInputWrapper:hover {\n  background: rgba(192,187,167,0.05);\n}\n.numInputWrapper:hover span {\n  opacity: 1;\n}\n.flatpickr-current-month {\n  font-size: 135%;\n  line-height: inherit;\n  font-weight: 300;\n  color: inherit;\n  position: absolute;\n  width: 75%;\n  left: 12.5%;\n  padding: 6.16px 0 0 0;\n  line-height: 1;\n  height: 28px;\n  display: inline-block;\n  text-align: center;\n  -webkit-transform: translate3d(0px, 0px, 0px);\n          transform: translate3d(0px, 0px, 0px);\n}\n.flatpickr-current-month span.cur-month {\n  font-family: inherit;\n  font-weight: 700;\n  color: inherit;\n  display: inline-block;\n  margin-left: 0.5ch;\n  padding: 0;\n}\n.flatpickr-current-month span.cur-month:hover {\n  background: rgba(192,187,167,0.05);\n}\n.flatpickr-current-month .numInputWrapper {\n  width: 6ch;\n  width: 7ch\\0;\n  display: inline-block;\n}\n.flatpickr-current-month .numInputWrapper span.arrowUp:after {\n  border-bottom-color: #fff;\n}\n.flatpickr-current-month .numInputWrapper span.arrowDown:after {\n  border-top-color: #fff;\n}\n.flatpickr-current-month input.cur-year {\n  background: transparent;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  color: inherit;\n  cursor: text;\n  padding: 0 0 0 0.5ch;\n  margin: 0;\n  display: inline-block;\n  font-size: inherit;\n  font-family: inherit;\n  font-weight: 300;\n  line-height: inherit;\n  height: auto;\n  border: 0;\n  border-radius: 0;\n  vertical-align: initial;\n}\n.flatpickr-current-month input.cur-year:focus {\n  outline: 0;\n}\n.flatpickr-current-month input.cur-year[disabled],\n.flatpickr-current-month input.cur-year[disabled]:hover {\n  font-size: 100%;\n  color: rgba(255,255,255,0.5);\n  background: transparent;\n  pointer-events: none;\n}\n.flatpickr-weekdays {\n  background: transparent;\n  text-align: center;\n  overflow: hidden;\n  width: 100%;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-align: center;\n  -webkit-align-items: center;\n      -ms-flex-align: center;\n          align-items: center;\n  height: 28px;\n}\n.flatpickr-weekdays .flatpickr-weekdaycontainer {\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n}\nspan.flatpickr-weekday {\n  cursor: default;\n  font-size: 90%;\n  background: transparent;\n  color: #fff;\n  line-height: 1;\n  margin: 0;\n  text-align: center;\n  display: block;\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n  font-weight: bolder;\n}\n.dayContainer,\n.flatpickr-weeks {\n  padding: 1px 0 0 0;\n}\n.flatpickr-days {\n  position: relative;\n  overflow: hidden;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-align: start;\n  -webkit-align-items: flex-start;\n      -ms-flex-align: start;\n          align-items: flex-start;\n  width: 307.875px;\n}\n.flatpickr-days:focus {\n  outline: 0;\n}\n.dayContainer {\n  padding: 0;\n  outline: 0;\n  text-align: left;\n  width: 307.875px;\n  min-width: 307.875px;\n  max-width: 307.875px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  display: inline-block;\n  display: -ms-flexbox;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: flex;\n  -webkit-flex-wrap: wrap;\n          flex-wrap: wrap;\n  -ms-flex-wrap: wrap;\n  -ms-flex-pack: justify;\n  -webkit-justify-content: space-around;\n          justify-content: space-around;\n  -webkit-transform: translate3d(0px, 0px, 0px);\n          transform: translate3d(0px, 0px, 0px);\n  opacity: 1;\n}\n.dayContainer + .dayContainer {\n  -webkit-box-shadow: -1px 0 0 #3f4458;\n          box-shadow: -1px 0 0 #3f4458;\n}\n.flatpickr-day {\n  background: none;\n  border: 1px solid transparent;\n  border-radius: 150px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  color: rgba(255,255,255,0.95);\n  cursor: pointer;\n  font-weight: 400;\n  width: 14.2857143%;\n  -webkit-flex-basis: 14.2857143%;\n      -ms-flex-preferred-size: 14.2857143%;\n          flex-basis: 14.2857143%;\n  max-width: 39px;\n  height: 39px;\n  line-height: 39px;\n  margin: 0;\n  display: inline-block;\n  position: relative;\n  -webkit-box-pack: center;\n  -webkit-justify-content: center;\n      -ms-flex-pack: center;\n          justify-content: center;\n  text-align: center;\n}\n.flatpickr-day.inRange,\n.flatpickr-day.prevMonthDay.inRange,\n.flatpickr-day.nextMonthDay.inRange,\n.flatpickr-day.today.inRange,\n.flatpickr-day.prevMonthDay.today.inRange,\n.flatpickr-day.nextMonthDay.today.inRange,\n.flatpickr-day:hover,\n.flatpickr-day.prevMonthDay:hover,\n.flatpickr-day.nextMonthDay:hover,\n.flatpickr-day:focus,\n.flatpickr-day.prevMonthDay:focus,\n.flatpickr-day.nextMonthDay:focus {\n  cursor: pointer;\n  outline: 0;\n  background: rgba(100,108,140,0.98);\n  border-color: rgba(100,108,140,0.98);\n}\n.flatpickr-day.today {\n  border-color: #eee;\n}\n.flatpickr-day.today:hover,\n.flatpickr-day.today:focus {\n  border-color: #eee;\n  background: #eee;\n  color: #3f4458;\n}\n.flatpickr-day.selected,\n.flatpickr-day.startRange,\n.flatpickr-day.endRange,\n.flatpickr-day.selected.inRange,\n.flatpickr-day.startRange.inRange,\n.flatpickr-day.endRange.inRange,\n.flatpickr-day.selected:focus,\n.flatpickr-day.startRange:focus,\n.flatpickr-day.endRange:focus,\n.flatpickr-day.selected:hover,\n.flatpickr-day.startRange:hover,\n.flatpickr-day.endRange:hover,\n.flatpickr-day.selected.prevMonthDay,\n.flatpickr-day.startRange.prevMonthDay,\n.flatpickr-day.endRange.prevMonthDay,\n.flatpickr-day.selected.nextMonthDay,\n.flatpickr-day.startRange.nextMonthDay,\n.flatpickr-day.endRange.nextMonthDay {\n  background: #80cbc4;\n  -webkit-box-shadow: none;\n          box-shadow: none;\n  color: #fff;\n  border-color: #80cbc4;\n}\n.flatpickr-day.selected.startRange,\n.flatpickr-day.startRange.startRange,\n.flatpickr-day.endRange.startRange {\n  border-radius: 50px 0 0 50px;\n}\n.flatpickr-day.selected.endRange,\n.flatpickr-day.startRange.endRange,\n.flatpickr-day.endRange.endRange {\n  border-radius: 0 50px 50px 0;\n}\n.flatpickr-day.selected.startRange + .endRange,\n.flatpickr-day.startRange.startRange + .endRange,\n.flatpickr-day.endRange.startRange + .endRange {\n  -webkit-box-shadow: -10px 0 0 #80cbc4;\n          box-shadow: -10px 0 0 #80cbc4;\n}\n.flatpickr-day.selected.startRange.endRange,\n.flatpickr-day.startRange.startRange.endRange,\n.flatpickr-day.endRange.startRange.endRange {\n  border-radius: 50px;\n}\n.flatpickr-day.inRange {\n  border-radius: 0;\n  -webkit-box-shadow: -5px 0 0 rgba(100,108,140,0.98), 5px 0 0 rgba(100,108,140,0.98);\n          box-shadow: -5px 0 0 rgba(100,108,140,0.98), 5px 0 0 rgba(100,108,140,0.98);\n}\n.flatpickr-day.disabled,\n.flatpickr-day.disabled:hover,\n.flatpickr-day.prevMonthDay,\n.flatpickr-day.nextMonthDay,\n.flatpickr-day.notAllowed,\n.flatpickr-day.notAllowed.prevMonthDay,\n.flatpickr-day.notAllowed.nextMonthDay {\n  color: rgba(255,255,255,0.3);\n  background: transparent;\n  border-color: transparent;\n  cursor: default;\n}\n.flatpickr-day.disabled,\n.flatpickr-day.disabled:hover {\n  cursor: not-allowed;\n  color: rgba(255,255,255,0.1);\n}\n.flatpickr-day.week.selected {\n  border-radius: 0;\n  -webkit-box-shadow: -5px 0 0 #80cbc4, 5px 0 0 #80cbc4;\n          box-shadow: -5px 0 0 #80cbc4, 5px 0 0 #80cbc4;\n}\n.rangeMode .flatpickr-day {\n  margin-top: 1px;\n}\n.flatpickr-weekwrapper {\n  display: inline-block;\n  float: left;\n}\n.flatpickr-weekwrapper .flatpickr-weeks {\n  padding: 0 12px;\n  -webkit-box-shadow: 1px 0 0 #3f4458;\n          box-shadow: 1px 0 0 #3f4458;\n}\n.flatpickr-weekwrapper .flatpickr-weekday {\n  float: none;\n  width: 100%;\n  line-height: 28px;\n}\n.flatpickr-weekwrapper span.flatpickr-day,\n.flatpickr-weekwrapper span.flatpickr-day:hover {\n  display: block;\n  width: 100%;\n  max-width: none;\n  color: rgba(255,255,255,0.3);\n  background: transparent;\n  cursor: default;\n  border: none;\n}\n.flatpickr-innerContainer {\n  display: block;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  overflow: hidden;\n}\n.flatpickr-rContainer {\n  display: inline-block;\n  padding: 0;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.flatpickr-time {\n  text-align: center;\n  outline: 0;\n  display: block;\n  height: 0;\n  line-height: 40px;\n  max-height: 40px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  overflow: hidden;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n}\n.flatpickr-time:after {\n  content: \"\";\n  display: table;\n  clear: both;\n}\n.flatpickr-time .numInputWrapper {\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n  width: 40%;\n  height: 40px;\n  float: left;\n}\n.flatpickr-time .numInputWrapper span.arrowUp:after {\n  border-bottom-color: rgba(255,255,255,0.95);\n}\n.flatpickr-time .numInputWrapper span.arrowDown:after {\n  border-top-color: rgba(255,255,255,0.95);\n}\n.flatpickr-time.hasSeconds .numInputWrapper {\n  width: 26%;\n}\n.flatpickr-time.time24hr .numInputWrapper {\n  width: 49%;\n}\n.flatpickr-time input {\n  background: transparent;\n  -webkit-box-shadow: none;\n          box-shadow: none;\n  border: 0;\n  border-radius: 0;\n  text-align: center;\n  margin: 0;\n  padding: 0;\n  height: inherit;\n  line-height: inherit;\n  cursor: pointer;\n  color: rgba(255,255,255,0.95);\n  font-size: 14px;\n  position: relative;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.flatpickr-time input.flatpickr-hour {\n  font-weight: bold;\n}\n.flatpickr-time input.flatpickr-minute,\n.flatpickr-time input.flatpickr-second {\n  font-weight: 400;\n}\n.flatpickr-time input:focus {\n  outline: 0;\n  border: 0;\n}\n.flatpickr-time .flatpickr-time-separator,\n.flatpickr-time .flatpickr-am-pm {\n  height: inherit;\n  display: inline-block;\n  float: left;\n  line-height: inherit;\n  color: rgba(255,255,255,0.95);\n  font-weight: bold;\n  width: 2%;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n  -webkit-align-self: center;\n      -ms-flex-item-align: center;\n          align-self: center;\n}\n.flatpickr-time .flatpickr-am-pm {\n  outline: 0;\n  width: 18%;\n  cursor: pointer;\n  text-align: center;\n  font-weight: 400;\n}\n.flatpickr-time .flatpickr-am-pm:hover,\n.flatpickr-time .flatpickr-am-pm:focus {\n  background: rgba(109,118,151,0.98);\n}\n.flatpickr-input[readonly] {\n  cursor: pointer;\n}\n@-webkit-keyframes fpFadeInDown {\n  from {\n    opacity: 0;\n    -webkit-transform: translate3d(0, -20px, 0);\n            transform: translate3d(0, -20px, 0);\n  }\n  to {\n    opacity: 1;\n    -webkit-transform: translate3d(0, 0, 0);\n            transform: translate3d(0, 0, 0);\n  }\n}\n@keyframes fpFadeInDown {\n  from {\n    opacity: 0;\n    -webkit-transform: translate3d(0, -20px, 0);\n            transform: translate3d(0, -20px, 0);\n  }\n  to {\n    opacity: 1;\n    -webkit-transform: translate3d(0, 0, 0);\n            transform: translate3d(0, 0, 0);\n  }\n}\n", ""]);

// exports


/***/ }),
/* 8 */
/***/ (function(module, exports, __webpack_require__) {

/*
	MIT License http://www.opensource.org/licenses/mit-license.php
	Author Tobias Koppers @sokra
*/

var stylesInDom = {};

var	memoize = function (fn) {
	var memo;

	return function () {
		if (typeof memo === "undefined") memo = fn.apply(this, arguments);
		return memo;
	};
};

var isOldIE = memoize(function () {
	// Test for IE <= 9 as proposed by Browserhacks
	// @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
	// Tests for existence of standard globals is to allow style-loader
	// to operate correctly into non-standard environments
	// @see https://github.com/webpack-contrib/style-loader/issues/177
	return window && document && document.all && !window.atob;
});

var getElement = (function (fn) {
	var memo = {};

	return function(selector) {
		if (typeof memo[selector] === "undefined") {
			memo[selector] = fn.call(this, selector);
		}

		return memo[selector]
	};
})(function (target) {
	return document.querySelector(target)
});

var singleton = null;
var	singletonCounter = 0;
var	stylesInsertedAtTop = [];

var	fixUrls = __webpack_require__(9);

module.exports = function(list, options) {
	if (typeof DEBUG !== "undefined" && DEBUG) {
		if (typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
	}

	options = options || {};

	options.attrs = typeof options.attrs === "object" ? options.attrs : {};

	// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
	// tags it will allow on a page
	if (!options.singleton) options.singleton = isOldIE();

	// By default, add <style> tags to the <head> element
	if (!options.insertInto) options.insertInto = "head";

	// By default, add <style> tags to the bottom of the target
	if (!options.insertAt) options.insertAt = "bottom";

	var styles = listToStyles(list, options);

	addStylesToDom(styles, options);

	return function update (newList) {
		var mayRemove = [];

		for (var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];

			domStyle.refs--;
			mayRemove.push(domStyle);
		}

		if(newList) {
			var newStyles = listToStyles(newList, options);
			addStylesToDom(newStyles, options);
		}

		for (var i = 0; i < mayRemove.length; i++) {
			var domStyle = mayRemove[i];

			if(domStyle.refs === 0) {
				for (var j = 0; j < domStyle.parts.length; j++) domStyle.parts[j]();

				delete stylesInDom[domStyle.id];
			}
		}
	};
};

function addStylesToDom (styles, options) {
	for (var i = 0; i < styles.length; i++) {
		var item = styles[i];
		var domStyle = stylesInDom[item.id];

		if(domStyle) {
			domStyle.refs++;

			for(var j = 0; j < domStyle.parts.length; j++) {
				domStyle.parts[j](item.parts[j]);
			}

			for(; j < item.parts.length; j++) {
				domStyle.parts.push(addStyle(item.parts[j], options));
			}
		} else {
			var parts = [];

			for(var j = 0; j < item.parts.length; j++) {
				parts.push(addStyle(item.parts[j], options));
			}

			stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
		}
	}
}

function listToStyles (list, options) {
	var styles = [];
	var newStyles = {};

	for (var i = 0; i < list.length; i++) {
		var item = list[i];
		var id = options.base ? item[0] + options.base : item[0];
		var css = item[1];
		var media = item[2];
		var sourceMap = item[3];
		var part = {css: css, media: media, sourceMap: sourceMap};

		if(!newStyles[id]) styles.push(newStyles[id] = {id: id, parts: [part]});
		else newStyles[id].parts.push(part);
	}

	return styles;
}

function insertStyleElement (options, style) {
	var target = getElement(options.insertInto)

	if (!target) {
		throw new Error("Couldn't find a style target. This probably means that the value for the 'insertInto' parameter is invalid.");
	}

	var lastStyleElementInsertedAtTop = stylesInsertedAtTop[stylesInsertedAtTop.length - 1];

	if (options.insertAt === "top") {
		if (!lastStyleElementInsertedAtTop) {
			target.insertBefore(style, target.firstChild);
		} else if (lastStyleElementInsertedAtTop.nextSibling) {
			target.insertBefore(style, lastStyleElementInsertedAtTop.nextSibling);
		} else {
			target.appendChild(style);
		}
		stylesInsertedAtTop.push(style);
	} else if (options.insertAt === "bottom") {
		target.appendChild(style);
	} else {
		throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
	}
}

function removeStyleElement (style) {
	if (style.parentNode === null) return false;
	style.parentNode.removeChild(style);

	var idx = stylesInsertedAtTop.indexOf(style);
	if(idx >= 0) {
		stylesInsertedAtTop.splice(idx, 1);
	}
}

function createStyleElement (options) {
	var style = document.createElement("style");

	options.attrs.type = "text/css";

	addAttrs(style, options.attrs);
	insertStyleElement(options, style);

	return style;
}

function createLinkElement (options) {
	var link = document.createElement("link");

	options.attrs.type = "text/css";
	options.attrs.rel = "stylesheet";

	addAttrs(link, options.attrs);
	insertStyleElement(options, link);

	return link;
}

function addAttrs (el, attrs) {
	Object.keys(attrs).forEach(function (key) {
		el.setAttribute(key, attrs[key]);
	});
}

function addStyle (obj, options) {
	var style, update, remove, result;

	// If a transform function was defined, run it on the css
	if (options.transform && obj.css) {
	    result = options.transform(obj.css);

	    if (result) {
	    	// If transform returns a value, use that instead of the original css.
	    	// This allows running runtime transformations on the css.
	    	obj.css = result;
	    } else {
	    	// If the transform function returns a falsy value, don't add this css.
	    	// This allows conditional loading of css
	    	return function() {
	    		// noop
	    	};
	    }
	}

	if (options.singleton) {
		var styleIndex = singletonCounter++;

		style = singleton || (singleton = createStyleElement(options));

		update = applyToSingletonTag.bind(null, style, styleIndex, false);
		remove = applyToSingletonTag.bind(null, style, styleIndex, true);

	} else if (
		obj.sourceMap &&
		typeof URL === "function" &&
		typeof URL.createObjectURL === "function" &&
		typeof URL.revokeObjectURL === "function" &&
		typeof Blob === "function" &&
		typeof btoa === "function"
	) {
		style = createLinkElement(options);
		update = updateLink.bind(null, style, options);
		remove = function () {
			removeStyleElement(style);

			if(style.href) URL.revokeObjectURL(style.href);
		};
	} else {
		style = createStyleElement(options);
		update = applyToTag.bind(null, style);
		remove = function () {
			removeStyleElement(style);
		};
	}

	update(obj);

	return function updateStyle (newObj) {
		if (newObj) {
			if (
				newObj.css === obj.css &&
				newObj.media === obj.media &&
				newObj.sourceMap === obj.sourceMap
			) {
				return;
			}

			update(obj = newObj);
		} else {
			remove();
		}
	};
}

var replaceText = (function () {
	var textStore = [];

	return function (index, replacement) {
		textStore[index] = replacement;

		return textStore.filter(Boolean).join('\n');
	};
})();

function applyToSingletonTag (style, index, remove, obj) {
	var css = remove ? "" : obj.css;

	if (style.styleSheet) {
		style.styleSheet.cssText = replaceText(index, css);
	} else {
		var cssNode = document.createTextNode(css);
		var childNodes = style.childNodes;

		if (childNodes[index]) style.removeChild(childNodes[index]);

		if (childNodes.length) {
			style.insertBefore(cssNode, childNodes[index]);
		} else {
			style.appendChild(cssNode);
		}
	}
}

function applyToTag (style, obj) {
	var css = obj.css;
	var media = obj.media;

	if(media) {
		style.setAttribute("media", media)
	}

	if(style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		while(style.firstChild) {
			style.removeChild(style.firstChild);
		}

		style.appendChild(document.createTextNode(css));
	}
}

function updateLink (link, options, obj) {
	var css = obj.css;
	var sourceMap = obj.sourceMap;

	/*
		If convertToAbsoluteUrls isn't defined, but sourcemaps are enabled
		and there is no publicPath defined then lets turn convertToAbsoluteUrls
		on by default.  Otherwise default to the convertToAbsoluteUrls option
		directly
	*/
	var autoFixUrls = options.convertToAbsoluteUrls === undefined && sourceMap;

	if (options.convertToAbsoluteUrls || autoFixUrls) {
		css = fixUrls(css);
	}

	if (sourceMap) {
		// http://stackoverflow.com/a/26603875
		css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
	}

	var blob = new Blob([css], { type: "text/css" });

	var oldSrc = link.href;

	link.href = URL.createObjectURL(blob);

	if(oldSrc) URL.revokeObjectURL(oldSrc);
}


/***/ }),
/* 9 */
/***/ (function(module, exports) {


/**
 * When source maps are enabled, `style-loader` uses a link element with a data-uri to
 * embed the css on the page. This breaks all relative urls because now they are relative to a
 * bundle instead of the current page.
 *
 * One solution is to only use full urls, but that may be impossible.
 *
 * Instead, this function "fixes" the relative urls to be absolute according to the current page location.
 *
 * A rudimentary test suite is located at `test/fixUrls.js` and can be run via the `npm test` command.
 *
 */

module.exports = function (css) {
  // get current location
  var location = typeof window !== "undefined" && window.location;

  if (!location) {
    throw new Error("fixUrls requires window.location");
  }

	// blank or null?
	if (!css || typeof css !== "string") {
	  return css;
  }

  var baseUrl = location.protocol + "//" + location.host;
  var currentDir = baseUrl + location.pathname.replace(/\/[^\/]*$/, "/");

	// convert each url(...)
	/*
	This regular expression is just a way to recursively match brackets within
	a string.

	 /url\s*\(  = Match on the word "url" with any whitespace after it and then a parens
	   (  = Start a capturing group
	     (?:  = Start a non-capturing group
	         [^)(]  = Match anything that isn't a parentheses
	         |  = OR
	         \(  = Match a start parentheses
	             (?:  = Start another non-capturing groups
	                 [^)(]+  = Match anything that isn't a parentheses
	                 |  = OR
	                 \(  = Match a start parentheses
	                     [^)(]*  = Match anything that isn't a parentheses
	                 \)  = Match a end parentheses
	             )  = End Group
              *\) = Match anything and then a close parens
          )  = Close non-capturing group
          *  = Match anything
       )  = Close capturing group
	 \)  = Match a close parens

	 /gi  = Get all matches, not the first.  Be case insensitive.
	 */
	var fixedCss = css.replace(/url\s*\(((?:[^)(]|\((?:[^)(]+|\([^)(]*\))*\))*)\)/gi, function(fullMatch, origUrl) {
		// strip quotes (if they exist)
		var unquotedOrigUrl = origUrl
			.trim()
			.replace(/^"(.*)"$/, function(o, $1){ return $1; })
			.replace(/^'(.*)'$/, function(o, $1){ return $1; });

		// already a full url? no change
		if (/^(#|data:|http:\/\/|https:\/\/|file:\/\/\/)/i.test(unquotedOrigUrl)) {
		  return fullMatch;
		}

		// convert the url to a full url
		var newUrl;

		if (unquotedOrigUrl.indexOf("//") === 0) {
		  	//TODO: should we add protocol?
			newUrl = unquotedOrigUrl;
		} else if (unquotedOrigUrl.indexOf("/") === 0) {
			// path should be relative to the base url
			newUrl = baseUrl + unquotedOrigUrl; // already starts with '/'
		} else {
			// path should be relative to current directory
			newUrl = currentDir + unquotedOrigUrl.replace(/^\.\//, ""); // Strip leading './'
		}

		// send back the fixed url(...)
		return "url(" + JSON.stringify(newUrl) + ")";
	});

	// send back the fixed css
	return fixedCss;
};


/***/ }),
/* 10 */
/***/ (function(module, exports) {

/**
 * Translates the list format produced by css-loader into something
 * easier to manipulate.
 */
module.exports = function listToStyles (parentId, list) {
  var styles = []
  var newStyles = {}
  for (var i = 0; i < list.length; i++) {
    var item = list[i]
    var id = item[0]
    var css = item[1]
    var media = item[2]
    var sourceMap = item[3]
    var part = {
      id: parentId + ':' + i,
      css: css,
      media: media,
      sourceMap: sourceMap
    }
    if (!newStyles[id]) {
      styles.push(newStyles[id] = { id: id, parts: [part] })
    } else {
      newStyles[id].parts.push(part)
    }
  }
  return styles
}


/***/ }),
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(12)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(14)
/* template */
var __vue_template__ = __webpack_require__(15)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/ButtonApp.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-64a695e8", Component.options)
  } else {
    hotAPI.reload("data-v-64a695e8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(13);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("54e54cb9", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-64a695e8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ButtonApp.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-64a695e8\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ButtonApp.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\nbutton {\n    overflow: hidden;\n    outline: none;\n    /*display: block;*/\n    -webkit-user-select: none;\n       -moz-user-select: none;\n        -ms-user-select: none;\n            user-select: none;\n    position: relative;\n    overflow: hidden;\n}\n.circle {\n    /*display: block; */\n    position: absolute;\n    background: rgba(0,0,0,.075);\n    border-radius: 50%;\n    -webkit-transform: scale(0);\n            transform: scale(0);\n}\n.circle.animate {\n    -webkit-animation: effect 0.65s linear;\n            animation: effect 0.65s linear;\n}\n@-webkit-keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n@keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n/* end click effect */\nbutton:focus {\n    outline: none !important;\n}\n.btn-app {\n\n    border-radius: 2px;\n    border: 0;\n    -webkit-transition: .2s ease-out;\n    transition: .2s ease-out;\n    color: #fff;\n    margin-bottom: 10px;\n\n    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    -webkit-transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n    transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n}\n.btn-app:hover {\n    color: #616161 !important;\n\n    -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n    box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n\n    -webkit-transition: color .3s ease-out;\n    transition: color .3s ease-out;\n}\n.btn-app:active, .btn-app:focus, .btn-app.active {\n    outline: 0;\n}\n\n/*draft*/\n.btn-app-draft {\n    color: #636b6f !important;\n    background: #f5f5f5 !important;\n}\n.btn-app-draft:hover, .btn-app-draft:focus {\n    color: #fff !important;\n    background: #eee !important;\n}\n.btn-app-draft.active {\n    color: #fff !important;\n    background: #eee !important;\n}\n\n/*Default*/\n.btn-app-default {\n    color: #fff !important;\n    background: #2BBBAD !important;\n}\n.btn-app-default:hover, .btn-app-default:focus {\n    background: #30cfc0 !important;\n}\n.btn-app-default.active {\n    background: #186860 !important;\n}\n\n/*Primary*/\n.btn-app-primary {\n    background: #4285F4 !important;\n}\n.btn-app-primary:hover, .btn-app-primary:focus {\n    background-color: #5a95f5 !important;\n}\n.btn-app-primary.active {\n    background-color: #0b51c5 !important;\n}\n\n/*Secondary*/\n.btn-app-secondary {\n    background-color: #aa66cc !important;\n}\n.btn-app-secondary:hover, .btn-app-secondary:focus {\n    background-color: #b579d2 !important;\n    color: #fff;\n}\n.btn-app-secondary.active {\n    background-color: #773399 !important;\n}\n.btn-app-secondary.active:hover {\n    color: #fff;\n}\n\n/*Success*/\n.btn-app-success {\n    background: #00C851;\n}\n.btn-app-success:hover, .btn-app-success:focus {\n    background-color: #00d255 !important;\n}\n.btn-app-success.active {\n    background-color: #006228 !important;\n}\n\n/*Info*/\n.btn-app-info {\n    background: #33b5e5;\n}\n.btn-app-info:hover, .btn-app-info:focus {\n    background-color: #4abde8 !important;\n}\n.btn-app-info.active {\n    background-color: #14799e !important;\n}\n\n/*Warning*/\n.btn-app-warning {\n    background: #FF8800;\n}\n.btn-app-warning:hover, .btn-app-warning:focus {\n    background-color: #ff961f !important;\n}\n.btn-app-warning.active {\n    background-color: #cc8800 !important;\n}\n\n/*Danger*/\n.btn-app-danger {\n    background: #CC0000;\n}\n.btn-app-danger:hover, .btn-app-danger:focus {\n    background-color: #db0000 !important;\n}\n.btn-app-danger.active {\n    background-color: maroon !important;\n}\n\n/*Link*/\n.btn-app-link {\n    background-color: transparent;\n    color: #000;\n}\n.btn-app-link:hover, .btn-app-link:focus {\n    background-color: transparent;\n    color: #000;\n}\n", ""]);

// exports


/***/ }),
/* 14 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        action: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        status: {
            type: String,
            required: true
        },
        size: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            style: "btn-app btn-app-",
            id: ''
        };
    },
    mounted: function mounted() {
        this.id = Date.now() + '-' + this.action;
    },

    methods: {
        click: function click(e) {
            EventBus.$emit(this.action);

            var element, circle, d, x, y;

            element = $('#' + this.id);

            if (element.find(".circle").length == 0) element.prepend("<span class='circle'></span>");

            circle = element.find(".circle");
            circle.removeClass("animate");

            if (!circle.height() && !circle.width()) {
                d = Math.max(element.outerWidth(), element.outerHeight());
                circle.css({ height: d, width: d });
            }

            x = e.pageX - element.offset().left - circle.width() / 2;
            y = e.pageY - element.offset().top - circle.height() / 2;

            circle.css({ top: y + 'px', left: x + 'px' }).addClass("animate");
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 15 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("button", {
    class:
      _vm.style +
      _vm.status +
      (_vm.size == undefined ? "" : " btn-" + _vm.size),
    attrs: { id: _vm.id },
    domProps: { innerHTML: _vm._s(_vm.label) },
    on: { click: _vm.click }
  })
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-64a695e8", module.exports)
  }
}

/***/ }),
/* 16 */,
/* 17 */,
/* 18 */,
/* 19 */,
/* 20 */,
/* 21 */,
/* 22 */,
/* 23 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(24)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(26)
/* template */
var __vue_template__ = __webpack_require__(27)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/modals/Dialog.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3339672a", Component.options)
  } else {
    hotAPI.reload("data-v-3339672a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(25);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("05e8ea6e", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3339672a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dialog.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3339672a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dialog.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.modal {\n  text-align: center;\n  padding: 0!important;\n}\n.modal:before {\n  content: '';\n  display: inline-block;\n  height: 100%;\n  vertical-align: middle;\n  margin-right: -4px;\n}\n.modal-dialog {\n  display: inline-block;\n  text-align: left;\n  vertical-align: middle;\n}\n", ""]);

// exports


/***/ }),
/* 26 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__buttons_ButtonApp_vue__ = __webpack_require__(248);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__buttons_ButtonApp_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__buttons_ButtonApp_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//



/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        'button-app': __WEBPACK_IMPORTED_MODULE_0__buttons_ButtonApp_vue___default.a
    },
    data: function data() {
        return {
            heading: '',
            message: '',
            buttonLabel: ''
        };
    },
    mounted: function mounted() {
        var _this = this;

        EventBus.$on('toggle-modal-dialog', function (message) {
            var heading = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'Wordplease says';
            var buttonLabel = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'OK';
            var toggle = arguments.length > 3 && arguments[3] !== undefined ? arguments[3] : 'toggle';

            if (message === undefined) {
                $('#modal-dialog').modal('hide');
            } else {
                _this.message = message;
                _this.heading = heading;
                _this.buttonLabel = buttonLabel;
                _this.toggle = toggle;
                $('#modal-dialog').modal(toggle);
            }
        });

        EventBus.$on('show-common-dialog', function () {
            var code = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

            switch (code) {
                case 'error-419':
                    _this.message = 'Your are now logged off, Please reload this page or loss your data.';
                    _this.heading = 'Attention please !!';
                    _this.buttonLabel = 'Got it';
                    $('#modal-dialog').modal('show');
                    break;
                case 'error-500':
                    _this.message = 'Server error, Please try again later or get the Helpdesk.';
                    _this.heading = 'Attention please !!';
                    _this.buttonLabel = 'Got it';
                    $('#modal-dialog').modal('show');
                    break;
                    defualt: _this.message = '01110111 01101111 01110010 01100100 01110000 01101100 01100101 01100001 01110011 01100101';
                    _this.heading = 'Attention please !!';
                    _this.buttonLabel = 'Got it';
                    $('#modal-dialog').modal('show');
                    break;
            }
        });
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 27 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "modal fade",
      attrs: {
        tabindex: "-1",
        role: "dialog",
        id: "modal-dialog",
        "data-backdrop": "static",
        "data-keyboard": "false"
      }
    },
    [
      _c(
        "div",
        { staticClass: "modal-dialog modal-sm", attrs: { role: "document" } },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c("div", { staticClass: "modal-header" }, [
              _vm._v(
                "\n                " + _vm._s(_vm.heading) + "\n            "
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "modal-body" }, [
              _vm._v(
                "\n                " + _vm._s(_vm.message) + "\n            "
              )
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "modal-footer" },
              [
                _c("button-app", {
                  attrs: {
                    size: "lg",
                    label: _vm.buttonLabel,
                    action: "toggle-modal-dialog",
                    status: "draft"
                  }
                })
              ],
              1
            )
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3339672a", module.exports)
  }
}

/***/ }),
/* 28 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(29)
/* template */
var __vue_template__ = __webpack_require__(30)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/navbars/Navbar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-e911cd9a", Component.options)
  } else {
    hotAPI.reload("data-v-e911cd9a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 29 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        link: {
            type: String,
            required: true
        },
        brand: {
            type: String,
            required: true
        },
        title: {
            type: String,
            required: true
        }
    }
});

/***/ }),
/* 30 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("nav", { staticClass: "navbar navbar-default navbar-fixed-top" }, [
    _c("div", { staticClass: "container-fluid" }, [
      _c("div", { staticClass: "navbar-header" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("a", { staticClass: "navbar-brand", attrs: { href: _vm.link } }, [
          _vm._v(_vm._s(_vm.brand))
        ]),
        _vm._v(" "),
        _c("a", {
          staticClass: "navbar-brand active",
          domProps: { innerHTML: _vm._s(_vm.title) }
        })
      ]),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "collapse navbar-collapse",
          attrs: { id: "app-navbar" }
        },
        [_vm._t("navbar-left"), _vm._v(" "), _vm._t("navbar-right")],
        2
      )
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "button",
      {
        staticClass: "navbar-toggle collapsed",
        attrs: {
          type: "button",
          "data-toggle": "collapse",
          "data-target": "#app-navbar",
          "aria-expanded": "false"
        }
      },
      [
        _c("span", { staticClass: "sr-only" }, [_vm._v("Toggle navigation")]),
        _vm._v(" "),
        _c("span", { staticClass: "icon-bar" }),
        _vm._v(" "),
        _c("span", { staticClass: "icon-bar" }),
        _vm._v(" "),
        _c("span", { staticClass: "icon-bar" })
      ]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-e911cd9a", module.exports)
  }
}

/***/ }),
/* 31 */,
/* 32 */,
/* 33 */,
/* 34 */,
/* 35 */,
/* 36 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(37)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(39)
/* template */
var __vue_template__ = __webpack_require__(40)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/Panel.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-21f01f46", Component.options)
  } else {
    hotAPI.reload("data-v-21f01f46", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 37 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(38);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("6815ca12", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21f01f46\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Panel.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21f01f46\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Panel.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.material-panel {\n    border: none;\n    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    -webkit-transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n    transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n}\n.material-panel:hover {\n    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 3px 6px rgba(0,0,0,0.22);\n            box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 3px 6px rgba(0,0,0,0.22);\n}\n.material-panel-heading {\n    border-radius: 4px 4px 0 0;\n    font-weight: 700;\n    border: none;\n    padding: 5px 22.5px;\n}\n.material-panel-body {\n    background-color: #fff;\n    padding: 10px 22.5px;\n}\n.material-panel-heading {\n    /*background-color: #eee;*/\n    /*color: #000;*/\n}\n", ""]);

// exports


/***/ }),
/* 39 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['heading']
});

/***/ }),
/* 40 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "panel panel-default material-panel" }, [
    _c("div", { staticClass: "panel-heading material-panel-heading" }, [
      _c("strong", [_vm._v(_vm._s(_vm.heading))])
    ]),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "panel-body material-panel-body" },
      [_vm._t("default")],
      2
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-21f01f46", module.exports)
  }
}

/***/ }),
/* 41 */,
/* 42 */,
/* 43 */,
/* 44 */,
/* 45 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(46)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(48)
/* template */
var __vue_template__ = __webpack_require__(49)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/alerts/AlertBox.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-365f0320", Component.options)
  } else {
    hotAPI.reload("data-v-365f0320", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 46 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(47);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("48dded52", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-365f0320\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AlertBox.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-365f0320\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AlertBox.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 47 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n#alert-box {\n    font-size: 1em;\n    width: 400px;\n    position: fixed;\n    top: 105px;\n    right: 15px;\n    z-index:10;\n}\n#alert-icon {\n    font-size:2em;\n    float:left;\n    margin-right: .5em;\n}\n", ""]);

// exports


/***/ }),
/* 48 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            icon: '',
            show: false,
            status: '',
            message: '',
            duration: 5000
        };
    },
    mounted: function mounted() {
        var _this = this;

        EventBus.$on('toggle-alert-box', function () {
            var message = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';
            var status = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'info';
            var duration = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 5000;

            _this.setIcon();
            _this.show = true;
            _this.status = status;
            _this.message = message;
            _this.duration = duration;
            setTimeout(function () {
                _this.show = false;
            }, _this.duration);
        });
    },

    methods: {
        setIcon: function setIcon() {
            switch (this.status) {
                case 'warning':
                    return 'fa fa-exclamation-circle';
                case 'danger':
                    return 'fa fa-warning';
                default:
                    return 'fa fa-info-circle';
            }
        }
    },
    computed: {
        boxClass: function boxClass() {
            return "alert alert-dismissible fade in alert-" + this.status;
        }
    }
});

/***/ }),
/* 49 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("transition", { attrs: { name: "slide-fade" } }, [
    _vm.show
      ? _c(
          "div",
          { class: _vm.boxClass, attrs: { role: "alert", id: "alert-box" } },
          [
            _c(
              "button",
              {
                staticClass: "close",
                attrs: { type: "button" },
                on: {
                  click: function($event) {
                    _vm.show = false
                  }
                }
              },
              [_c("span", { staticClass: "fa fa-times-circle" })]
            ),
            _vm._v(" "),
            _c("span", { class: _vm.setIcon, attrs: { id: "alert-icon" } }),
            _vm._v(" "),
            _c("p", {
              staticClass: "bigger-font-25",
              domProps: { innerHTML: _vm._s(_vm.message) }
            })
          ]
        )
      : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-365f0320", module.exports)
  }
}

/***/ }),
/* 50 */,
/* 51 */,
/* 52 */,
/* 53 */,
/* 54 */,
/* 55 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(56)
/* template */
var __vue_template__ = __webpack_require__(57)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/navbars/AuthenticatedNavbarRight.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7e117bc0", Component.options)
  } else {
    hotAPI.reload("data-v-7e117bc0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 56 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        username: {
            type: String,
            required: true
        }
    },
    mounted: function mounted() {
        $('.meta-tooltip').tooltip({
            container: "body",
            placement: "bottom",
            trigger: "hover"
        });
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 57 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("ul", { staticClass: "nav navbar-nav navbar-right" }, [
    _c(
      "li",
      {
        staticClass: "active meta-tooltip",
        attrs: { title: "profile", "data-toggle": "tooltip" }
      },
      [_c("a", { attrs: { href: "/profile" } }, [_vm._v(_vm._s(_vm.username))])]
    ),
    _vm._v(" "),
    _vm._m(0)
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "li",
      {
        staticClass: "meta-tooltip",
        attrs: { title: "logout", "data-toggle": "tooltip" }
      },
      [
        _c("a", { attrs: { href: "/logout" } }, [
          _c("span", { staticClass: "fa fa-sign-out" })
        ])
      ]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7e117bc0", module.exports)
  }
}

/***/ }),
/* 58 */,
/* 59 */,
/* 60 */,
/* 61 */,
/* 62 */,
/* 63 */,
/* 64 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(195)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(197)
/* template */
var __vue_template__ = __webpack_require__(198)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/inputs/InputCheck.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c883af46", Component.options)
  } else {
    hotAPI.reload("data-v-c883af46", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 65 */,
/* 66 */,
/* 67 */,
/* 68 */,
/* 69 */,
/* 70 */,
/* 71 */,
/* 72 */,
/* 73 */,
/* 74 */,
/* 75 */,
/* 76 */,
/* 77 */,
/* 78 */,
/* 79 */,
/* 80 */,
/* 81 */,
/* 82 */,
/* 83 */,
/* 84 */,
/* 85 */,
/* 86 */,
/* 87 */,
/* 88 */,
/* 89 */,
/* 90 */,
/* 91 */,
/* 92 */,
/* 93 */,
/* 94 */,
/* 95 */,
/* 96 */,
/* 97 */,
/* 98 */,
/* 99 */,
/* 100 */,
/* 101 */,
/* 102 */,
/* 103 */,
/* 104 */,
/* 105 */,
/* 106 */,
/* 107 */,
/* 108 */,
/* 109 */,
/* 110 */,
/* 111 */,
/* 112 */,
/* 113 */,
/* 114 */,
/* 115 */,
/* 116 */,
/* 117 */,
/* 118 */,
/* 119 */,
/* 120 */,
/* 121 */,
/* 122 */,
/* 123 */,
/* 124 */,
/* 125 */,
/* 126 */,
/* 127 */,
/* 128 */,
/* 129 */,
/* 130 */,
/* 131 */,
/* 132 */,
/* 133 */,
/* 134 */,
/* 135 */,
/* 136 */,
/* 137 */,
/* 138 */,
/* 139 */,
/* 140 */,
/* 141 */,
/* 142 */,
/* 143 */,
/* 144 */,
/* 145 */,
/* 146 */,
/* 147 */,
/* 148 */,
/* 149 */,
/* 150 */,
/* 151 */,
/* 152 */,
/* 153 */,
/* 154 */,
/* 155 */,
/* 156 */,
/* 157 */,
/* 158 */,
/* 159 */,
/* 160 */,
/* 161 */,
/* 162 */,
/* 163 */,
/* 164 */,
/* 165 */,
/* 166 */,
/* 167 */,
/* 168 */,
/* 169 */,
/* 170 */,
/* 171 */,
/* 172 */,
/* 173 */,
/* 174 */,
/* 175 */,
/* 176 */,
/* 177 */,
/* 178 */,
/* 179 */,
/* 180 */,
/* 181 */,
/* 182 */,
/* 183 */,
/* 184 */,
/* 185 */,
/* 186 */,
/* 187 */,
/* 188 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(189);


/***/ }),
/* 189 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {__webpack_require__(5);

// use global event bus
window.EventBus = new Vue();

Vue.component('note', __webpack_require__(190));
Vue.component('page-navbar', __webpack_require__(226));
Vue.component('modal-dialog', __webpack_require__(23));
Vue.component('alert-box', __webpack_require__(45));
Vue.component('button-app', __webpack_require__(11));

window.app = new Vue({
    el: '#app',
    data: {
        autosaveIcon: 'hide',

        lastActiveSessionCheck: 0
    },
    created: function created() {
        var _this = this;

        /* *** Handle session timeout *** */
        this.lastActiveSessionCheck = Date.now();
        $(window).on("focus", function (e) {
            var timeDiff = Date.now() - _this.lastActiveSessionCheck;
            if (timeDiff > window.SESSION_LIFETIME) {
                axios.get('/is-session-active').then(function (response) {
                    if (!response.data.active) {
                        EventBus.$emit('show-common-dialog', 'error-419');
                    }
                });
            }
        });

        /* *** *** */
        EventBus.$on('autosave', function (field, value) {
            _this.autosaveIcon = 'show';
            // axios.post('/note/autosave', { field: field, value: value })
            axios.post('/note/' + window.location.pathname.split("/")[2] + '/autosave', { field: field, value: value }).then(function (response) {
                console.log(response.data);

                // remove timeout later
                // setTimeout(() => { this.autosaveIcon = 'hide' }, 1000)
                _this.autosaveIcon = 'hide';
            }).catch(function (error) {
                _this.autosaveIcon = 'hide';
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    // console.log(error.response.data)
                    // console.log(error.response.status)
                    // console.log(error.response.headers)
                    if (error.response.status == 419) {
                        EventBus.$emit('show-common-dialog', 'error-419');
                    } else if (error.response.status == 500) {
                        EventBus.$emit('show-common-dialog', 'error-500');
                    }
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
                console.log(error.config);
            });
        });

        $('#page-loader').remove();
    }
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(1)))

/***/ }),
/* 190 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(191)
/* template */
var __vue_template__ = __webpack_require__(225)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/notes/medicine/forms/Admission.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-40a3f299", Component.options)
  } else {
    hotAPI.reload("data-v-40a3f299", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 191 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Panel_vue__ = __webpack_require__(36);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Panel_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Panel_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__inputs_InputText_vue__ = __webpack_require__(192);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__inputs_InputText_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__inputs_InputText_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__inputs_InputCheck_vue__ = __webpack_require__(64);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__inputs_InputCheck_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__inputs_InputCheck_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__inputs_InputRadio_vue__ = __webpack_require__(199);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__inputs_InputRadio_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__inputs_InputRadio_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__inputs_InputSelect_vue__ = __webpack_require__(204);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__inputs_InputSelect_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__inputs_InputSelect_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__inputs_InputTextarea_vue__ = __webpack_require__(209);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__inputs_InputTextarea_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__inputs_InputTextarea_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__inputs_InputSuggestion_vue__ = __webpack_require__(214);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__inputs_InputSuggestion_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6__inputs_InputSuggestion_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__inputs_InputCheckGroup_vue__ = __webpack_require__(217);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__inputs_InputCheckGroup_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_7__inputs_InputCheckGroup_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__modals_Medicine_ChildPughScore_vue__ = __webpack_require__(220);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__modals_Medicine_ChildPughScore_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_8__modals_Medicine_ChildPughScore_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//











/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        'panel': __WEBPACK_IMPORTED_MODULE_0__Panel_vue___default.a,
        'input-text': __WEBPACK_IMPORTED_MODULE_1__inputs_InputText_vue___default.a,
        'input-check': __WEBPACK_IMPORTED_MODULE_2__inputs_InputCheck_vue___default.a,
        'input-radio': __WEBPACK_IMPORTED_MODULE_3__inputs_InputRadio_vue___default.a,
        'input-select': __WEBPACK_IMPORTED_MODULE_4__inputs_InputSelect_vue___default.a,
        'input-textarea': __WEBPACK_IMPORTED_MODULE_5__inputs_InputTextarea_vue___default.a,
        'input-suggestion': __WEBPACK_IMPORTED_MODULE_6__inputs_InputSuggestion_vue___default.a,
        'input-check-group': __WEBPACK_IMPORTED_MODULE_7__inputs_InputCheckGroup_vue___default.a,
        'modal-child-pugh-score-detail': __WEBPACK_IMPORTED_MODULE_8__modals_Medicine_ChildPughScore_vue___default.a
    },
    props: {
        serializedNote: {
            type: String,
            required: true
        }
    },
    data: function data() {
        return {
            note: {},

            getDataUrl: "/note-data/" + window.location.pathname.split("/")[2]
        };
    },
    created: function created() {
        var _this = this;

        this.note = JSON.parse(this.serializedNote);

        this.comorbidOptions = [{ label: "No data", value: 255 }, { label: "No", value: 0 }, { label: "Yes", value: 1 }];

        this.inputRadioExtrasTriggerValue = 1;

        EventBus.$on('reset-comorbid_DM-extras', function (value) {
            if (value != _this.inputRadioExtrasTriggerValue) {
                _this.note.detail.comorbid_DM_type = null;
                _this.note.detail.comorbid_DM_DR = false;
                _this.note.detail.comorbid_DM_nephropathy = false;
                _this.note.detail.comorbid_DM_neuropathy = false;
                _this.note.detail.comorbid_DM_diet = false;
                _this.note.detail.comorbid_DM_oral_meds = false;
                _this.note.detail.comorbid_DM_insulin = false;
            }
        });

        EventBus.$on('reset-comorbid_valvular_heart_disease-extras', function (value) {
            if (value != _this.inputRadioExtrasTriggerValue) {
                _this.note.detail.comorbid_valvular_heart_disease_AS = false;
                _this.note.detail.comorbid_valvular_heart_disease_AR = false;
                _this.note.detail.comorbid_valvular_heart_disease_MS = false;
                _this.note.detail.comorbid_valvular_heart_disease_MR = false;
                _this.note.detail.comorbid_valvular_heart_disease_TR = false;
                _this.note.detail.comorbid_valvular_heart_disease_other = null;
            }
        });

        this.cirrhosisLabelAction = {
            emit: "toggle-modal-child-pugh-score-detail",
            icon: "question-circle",
            title: "Click to learn more about Child-Pugh's Score"
        };
    },

    computed: {
        DMComplicationChecks: function DMComplicationChecks() {
            return [{
                field: "comorbid_DM_DR", label: "DR",
                checked: this.note.detail.comorbid_DM_DR
            }, {
                field: "comorbid_DM_nephropathy",
                label: "Nephropathy",
                checked: this.note.detail.comorbid_DM_nephropathy
            }, {
                field: "comorbid_DM_neuropathy",
                label: "Neuropathy",
                checked: this.note.detail.comorbid_DM_neuropathy
            }];
        },
        DMTreatmentChecks: function DMTreatmentChecks() {
            return [{
                field: "comorbid_DM_diet",
                label: "Diet",
                checked: this.note.detail.comorbid_DM_diet
            }, {
                field: "comorbid_DM_oral_meds",
                label: "Oral Meds",
                checked: this.note.detail.comorbid_DM_oral_meds
            }, {
                field: "comorbid_DM_insulin",
                label: "Insulin",
                checked: this.note.detail.comorbid_DM_insulin
            }];
        },
        valvularHeartDiseaseChecks: function valvularHeartDiseaseChecks() {
            return [{
                field: "comorbid_valvular_heart_disease_AS",
                label: "AS",
                checked: this.note.detail.comorbid_valvular_heart_disease_AS
            }, {
                field: "comorbid_valvular_heart_disease_AR",
                label: "AR",
                checked: this.note.detail.comorbid_valvular_heart_disease_AR
            }, {
                field: "comorbid_valvular_heart_disease_MS",
                label: "MS",
                checked: this.note.detail.comorbid_valvular_heart_disease_MS
            }, {
                field: "comorbid_valvular_heart_disease_MR",
                label: "MR",
                checked: this.note.detail.comorbid_valvular_heart_disease_MR
            }, {
                field: "comorbid_valvular_heart_disease_TR",
                label: "TR",
                checked: this.note.detail.comorbid_valvular_heart_disease_TR
            }];
        },
        cirrhosisSpecificChecks: function cirrhosisSpecificChecks() {
            return [{
                field: "comorbid_cirrhosis_HBV",
                label: "HBV",
                checked: this.note.detail.comorbid_cirrhosis_HBV,
                emitOnUpdate: [["HBV-checked", "checked", 1], ["cirrhosis-cryptogenic-unchecked", "checked", ""]],
                setterEvent: "cirrhosis-specify-unchecked"
            }, {
                field: "comorbid_cirrhosis_HCV",
                label: "HCV",
                checked: this.note.detail.comorbid_cirrhosis_HCV,
                emitOnUpdate: [["HCV-checked", "checked", 1], ["cirrhosis-cryptogenic-unchecked", "checked", ""]],
                setterEvent: "cirrhosis-specify-unchecked"
            }, {
                field: "comorbid_cirrhosis_NASH",
                label: "NASH",
                checked: this.note.detail.comorbid_cirrhosis_NASH,
                emitOnUpdate: [["cirrhosis-cryptogenic-unchecked", "checked", ""]],
                setterEvent: "cirrhosis-specify-unchecked"
            }, {
                field: "comorbid_cirrhosis_cryptogenic",
                label: "Cryptogenic",
                checked: this.note.detail.comorbid_cirrhosis_cryptogenic,
                emitOnUpdate: [["cirrhosis-specify-unchecked", "checked", ""]],
                setterEvent: "cirrhosis-cryptogenic-unchecked"
            }];
        }
    }

    // implement input-text sync data
    // window.location.href
    // window.location.hostname
    // window.location.pathname
});

/***/ }),
/* 192 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(193)
/* template */
var __vue_template__ = __webpack_require__(194)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/inputs/InputText.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4e398e30", Component.options)
  } else {
    hotAPI.reload("data-v-4e398e30", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 193 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        // field name on database.
        field: {
            type: String,
            required: false
        },
        // input type default is text
        format: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: false
        },
        labelDescription: {
            type: String,
            required: false
        },
        // define Bootstrap grid class in mobile-tablet-desktop order
        grid: {
            type: String,
            required: false
        },
        // initial value.
        value: {
            type: String,
            required: false
        },
        // allow user type-in or not, Just mention this option.
        readonly: {
            type: String,
            required: false
        },
        // define Bootstrap form-group has-feedback which size of form-group should use.
        size: {
            type: String,
            required: false
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        },
        placeholder: {
            type: String,
            required: false
        },
        setterEvent: {
            type: String,
            required: false
        },
        pattern: {
            type: String,
            required: false
        },
        invalidText: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            userInput: '',
            lastSave: '',
            type: 'text',
            inputClass: 'form-control'
        };
    },
    mounted: function mounted() {
        var _this = this;

        // init label tooltip if available.
        if (this.labelDescription !== undefined) {
            $('a[title="' + this.labelDescription + '"]').tooltip();
        }

        if (this.format !== undefined) {
            this.type = this.format;
        }

        if (this.needSync !== undefined) {
            // let url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field
            var url = this.needSync + '/' + this.field;
            axios.get(url).then(function (response) {
                _this.userInput = response.data;
            }).catch(function (error) {
                _this.userInput = 'error';
            });
        }

        if (this.value === undefined) this.lastSave = this.userInput = '';else this.lastSave = this.userInput = this.value;

        if (this.setterEvent !== undefined) {
            EventBus.$on(this.setterEvent, function (value) {
                _this.userInput = value;
                _this.autosave();
            });
        }
    },

    methods: {
        autosave: function autosave() {
            if (this.readonly != '' && this.userInput != this.lastSave) {
                EventBus.$emit('autosave', this.field, this.userInput);
                this.lastSave = this.userInput;
            }
        },
        isValidate: function isValidate() {
            if (this.pattern !== null) {
                if (this.userInput.match(this.regex) !== null) {
                    $(this.inputDom).attr('data-original-title', '');
                    $(this.inputDom).tooltip('hide');
                    this.inputClass = 'form-control';
                    return true;
                } else {
                    return false;
                }
            }
            return true;
        },
        onblur: function onblur() {
            if (this.isValidate()) {
                this.autosave();
            } else {
                $(this.inputDom).attr('data-original-title', this.invalidTextComputed);
                $(this.inputDom).tooltip('show');
                this.inputClass = 'form-control invalid-input';
            }
        }
    },
    computed: {
        hasLabel: function hasLabel() {
            return !(this.label === undefined);
        },
        componentSize: function componentSize() {
            if (this.size == 'normal') {
                return 'form-group';
            }
            return 'form-group-sm';
        },
        componentGrid: function componentGrid() {
            if (this.grid === undefined) {
                return '';
            }
            var grid = this.grid.split('-');
            return 'col-xs-' + grid[0] + ' col-sm-' + grid[1] + ' col-md-' + grid[2];
        },
        isMaxWidth: function isMaxWidth() {
            if (this.label === undefined) {
                return "width: 100%;";
            }
            return "";
        },
        regex: function regex() {
            if (this.pattern !== null) {
                return new RegExp(this.pattern);
            }
            return null;
        },
        inputDom: function inputDom() {
            return this.field !== undefined ? '#' + this.field : '';
        },
        invalidTextComputed: function invalidTextComputed() {
            var defaultText = 'Invalid format. Data cannot be saved.';
            return this.invalidText === undefined ? defaultText : this.invalidText;
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 194 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { class: _vm.componentGrid }, [
    _c("div", { class: _vm.componentSize, style: _vm.isMaxWidth }, [
      _vm.hasLabel
        ? _c(
            "label",
            { staticClass: "control-label topped", attrs: { for: _vm.field } },
            [
              _c("span", { domProps: { innerHTML: _vm._s(_vm.label) } }),
              _vm._v(" "),
              _vm.labelDescription !== undefined
                ? _c(
                    "a",
                    {
                      attrs: {
                        role: "button",
                        "data-toggle": "tooltip",
                        title: _vm.labelDescription
                      }
                    },
                    [_c("i", { staticClass: "fa fa-info-circle" })]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.labelDescription !== undefined
                ? _c("span", [_vm._v(":")])
                : _vm._e()
            ]
          )
        : _vm._e(),
      _vm._v(" "),
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.userInput,
            expression: "userInput"
          }
        ],
        class: _vm.inputClass,
        style: _vm.isMaxWidth,
        attrs: {
          type: "text",
          readonly: _vm.readonly,
          name: _vm.field,
          id: _vm.field,
          placeholder: _vm.placeholder
        },
        domProps: { value: _vm.userInput },
        on: {
          blur: function($event) {
            _vm.onblur()
          },
          input: function($event) {
            if ($event.target.composing) {
              return
            }
            _vm.userInput = $event.target.value
          }
        }
      })
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4e398e30", module.exports)
  }
}

/***/ }),
/* 195 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(196);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("820ab372", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c883af46\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputCheck.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-c883af46\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputCheck.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 196 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\nlabel.material-checkbox-group-label {\n    font-weight: normal !important;\n}\n.clear-padding {\n    padding-left: 0px!important;\n    margin-right: 5px!important;\n}\nlabel.underline-animate:hover {\n    font-style: italic;\n}\n.underline-animate:after {\n    content: '';\n    position: absolute;\n    bottom: 0;\n    left: 0;\n    width: 0%;\n    border-bottom: 3px solid #636b6f;\n    -webkit-transition: 0.4s;\n    transition: 0.4s;\n}\n.underline-animate:hover:after {\n    width: 100%;\n}\n.material-checkbox-group-label {\n    position: relative;\n    display: block;\n    cursor: pointer;\n    height: 15px;\n    line-height: 15px;\n    /*padding-left: 25px;*/\n    padding-left: 20px; /* between control and label */\n}\n.material-checkbox-group-label:after { /*check marker*/\n    content: \"\";\n    display: block;\n    /*width: 4px;*/\n    width: 3px;\n    /*height: 12px;*/\n    height: 9px;\n    opacity: .9;\n    border-right: 2px solid #eee;\n    border-top: 2px solid #eee;\n    position: absolute;\n    /*left: 4px;*/\n    left: 3px;\n    /*top: 12px;*/\n    top: 9px;\n    -webkit-transform: scaleX(-1) rotate(135deg);\n    transform: scaleX(-1) rotate(135deg);\n    -webkit-transform-origin: left top;\n    transform-origin: left top;\n}\n.material-checkbox-group-label:before {\n    content: \"\";\n    display: block;\n    border: 2px solid;\n    /*width: 20px;*/\n    width: 15px;\n    /*height: 20px;*/\n    height: 15px;\n    position: absolute;\n    left: 0;\n}\n.material-checkbox-group-label {\n    /*font-size: 14px;*/\n    -webkit-user-select: none;\n    -moz-user-select: none;\n    -ms-user-select: none;\n}\n.material-checkbox:disabled ~ .material-checkbox-group-label {\n    cursor: no-drop;\n}\n.material-checkbox {\n    display: none;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {\n    -webkit-animation: check 0.8s;\n    animation: check 0.8s;\n    opacity: 1;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #636b6f;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #eee;\n}\n.material-checkbox-group .material-checkbox-group-label:before {\n    border-color: #636b6f;\n}\n.material-checkbox:disabled ~ .material-checkbox-group-label {\n    color: #eee;\n}\n.material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #4092d9;\n}\n.material-checkbox-group_primary .material-checkbox-group-label:before {\n    border-color: #4092d9;\n}\n.material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #68c368;\n}\n.material-checkbox-group_success .material-checkbox-group-label:before {\n    border-color: #68c368;\n}\n.material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #8bdaf2;\n}\n.material-checkbox-group_info .material-checkbox-group-label:before {\n    border-color: #8bdaf2;\n}\n.material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #f2a12e;\n}\n.material-checkbox-group_warning .material-checkbox-group-label:before {\n    border-color: #f2a12e;\n}\n.material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #f3413c;\n}\n.material-checkbox-group_danger .material-checkbox-group-label:before {\n    border-color: #f3413c;\n}\n@-webkit-keyframes check {\n0% {\n        height: 0;\n        width: 0;\n}\n25% {\n        height: 0;\n        /*width: 4px;*/\n        width: 3px;\n}\n50% {\n        /*height: 12px;*/\n        height: 9px;\n        /*width: 4px;*/\n        width: 3px;\n}\n}\n@keyframes check {\n0% {\n        height: 0;\n        width: 0;\n}\n25% {\n        height: 0;\n        /*width: 4px;*/\n        width: 3px;\n}\n50% {\n        /*height: 12px;*/\n        height: 9px;\n        /*width: 4px;*/\n        width: 3px;\n}\n}\n", ""]);

// exports


/***/ }),
/* 197 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        // field name on database.
        field: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: true
        },
        // tooltip for label.
        labelDescription: {
            type: String,
            required: false
        },
        // checked state ['checked' or undefined].
        checked: {
            type: [String, Number, Boolean],
            required: false
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        },
        // event emit when checked/unchecked.
        emitOnUpdate: {

            required: false
        },
        // event emit when checked/unchecked.
        setterEvent: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            checkValue: false
        };
    },
    mounted: function mounted() {
        var _this = this;

        // render checked state or not.
        this.checkValue = this.checked !== undefined && this.checked != 0;

        // init BT tooltip if labelDescription available.
        if (this.labelDescription !== undefined) {
            $('a[title="' + this.labelDescription + '"]').tooltip();
        }

        if (this.setterEvent !== undefined) {
            EventBus.$on(this.setterEvent, function (value) {
                if (value !== _this.checkValue) {
                    _this.checkValue = value;
                    _this.autosave();
                }
            });
        }

        if (this.needSync !== undefined) {
            var url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field;
            axios.get(url).then(function (response) {
                // this.thisChecked = response.data ? 'checked' : ''
                _this.checkValue = response.data == 1;
            }).catch(function (error) {
                console.log(error);
            });
        }
    },

    methods: {
        // handle check event.
        check: function check() {
            var _this2 = this;

            // this.thisChecked = (this.thisChecked == '') ? 'checked' : ''
            this.checkValue = !this.checkValue;

            this.autosave();

            if (this.emitOnUpdate !== undefined) {
                this.emitEvents.forEach(function (event) {
                    // [name][mode 1:checked 2:unchecked][value]
                    // if (event[1] == this.thisChecked) {
                    //     EventBus.$emit(event[0], event[2])
                    // }
                    if (event[1] == _this2.isChecked) {
                        EventBus.$emit(event[0], event[2]);
                    }
                });
            }
        },
        autosave: function autosave() {
            if (this.field !== undefined) {
                EventBus.$emit('autosave', this.field, this.checkValue);
            }
        }
    },
    computed: {
        emitEvents: function emitEvents() {
            if (typeof this.emitOnUpdate == 'String') {
                return JSON.parse(this.emitOnUpdate);
            }
            return this.emitOnUpdate;
        },
        isChecked: function isChecked() {
            return this.checkValue ? 'checked' : '';
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 198 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "label",
    { staticClass: "checkbox-inline underline-animate clear-padding" },
    [
      _c("div", { staticClass: "material-checkbox-group" }, [
        _c("input", {
          staticClass: "material-checkbox",
          attrs: { type: "checkbox", id: _vm.field, name: _vm.field },
          domProps: { checked: _vm.isChecked },
          on: {
            click: function($event) {
              _vm.check()
            }
          }
        }),
        _vm._v(" "),
        _c(
          "label",
          {
            staticClass: "material-checkbox-group-label",
            attrs: { for: _vm.field }
          },
          [
            _vm._v("\n            " + _vm._s(_vm.label) + "\n            "),
            _vm.labelDescription !== undefined
              ? _c(
                  "a",
                  {
                    attrs: {
                      role: "button",
                      "data-toggle": "tooltip",
                      title: _vm.labelDescription
                    }
                  },
                  [_c("i", { staticClass: "fa fa-info-circle" })]
                )
              : _vm._e()
          ]
        )
      ])
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-c883af46", module.exports)
  }
}

/***/ }),
/* 199 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(200)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(202)
/* template */
var __vue_template__ = __webpack_require__(203)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/inputs/InputRadio.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4a27a5d0", Component.options)
  } else {
    hotAPI.reload("data-v-4a27a5d0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 200 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(201);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("1ec8ed82", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4a27a5d0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRadio.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-4a27a5d0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRadio.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 201 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\ndiv.extra {\n    font-style: italic;\n    color: #757575;\n}\n", ""]);

// exports


/***/ }),
/* 202 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {var _typeof = typeof Symbol === "function" && typeof Symbol.iterator === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; };

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        // field name on database.
        field: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: true
        },
        value: {
            type: [String, Number],
            required: false
        },
        // tooltip for label.
        labelDescription: {
            type: String,
            required: false
        },
        // string in form of json {"emit": "", "icon": "", "title": "" }.
        labelAction: {
            type: [String, Object],
            required: false
        },
        // string in form fo array of json [{"label": "","value": ""},{...}].
        options: {
            type: [String, Array],
            required: true
        },
        // value to trigger extra content.
        triggerValue: {
            type: [String, Number],
            required: false
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        },
        // listen to this event name to set this component value.
        setterEvent: {
            type: String,
            required: false
        },
        emitOnUpdate: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            showReset: false,
            currentValue: null,
            showExtra: false
        };
    },

    methods: {
        autosave: function autosave() {
            if (this.field !== undefined) {
                EventBus.$emit('autosave', this.field, this.currentValue);
            }

            if (this.emitOnUpdate !== undefined) {
                EventBus.$emit(this.emitOnUpdate, this.currentValue);
            }
        },
        check: function check(value) {
            // check if has extra contents.
            if (this.hasDefaultSlot) {
                if (this.isTriggerExtra(value)) {
                    if (!this.showExtra) {
                        this.showExtra = true;
                    }
                } else {
                    if (this.showExtra) {
                        this.showExtra = false;
                    }
                }
            }

            // show reset icon.
            if (!this.showReset) {
                this.showReset = true;
            }

            // check if value change.
            if (this.currentValue != value) {
                this.currentValue = value;
                this.autosave();

                // if ( this.emitOnUpdate !== undefined ) {
                //     EventBus.$emit(this.emitOnUpdate, this.currentValue)
                // }
            }
        },

        // reset to unchecked all options.
        reset: function reset() {
            this.showReset = false;
            this.currentValue = null;
            if (this.hasDefaultSlot) {
                this.showExtra = false;
            }
            this.autosave();
        },

        // return checked value is trigger value or not.
        isTriggerExtra: function isTriggerExtra(value) {
            if (_typeof(this.triggerValues) == 'object') {
                var show = false;
                this.triggerValues.forEach(function (eachValue) {
                    if (eachValue == value) {
                        show = true;
                    }
                });
                return show;
            }
            return value == this.triggerValues;
        },

        // emit event on label action.
        emitLabelActionEvent: function emitLabelActionEvent() {
            EventBus.$emit(this.labelActionEmitEventName);
        }
    },
    mounted: function mounted() {
        var _this = this;

        // init label tooltip if available.
        if (this.labelDescription !== undefined) {
            $('a[title="' + this.labelDescription + '"]').tooltip();
        }

        // init label action icon tooltip if available.
        if (this.labelAction !== undefined) {
            $('a[title="' + this.labelActionTitle + '"]').tooltip();
        }

        // init each option label tooltip if available.
        this.optionsObjects.forEach(function (option) {
            if (option.labelDescription !== undefined) {
                $('a[title="' + option.labelDescription + '"]').tooltip();
            }
        });

        if (this.field !== undefined) {
            EventBus.$on(this.field, function (value) {
                _this.check(value);
            });
        }

        // listen to event to set option value.
        if (this.setterEvent !== undefined) {
            EventBus.$on(this.setterEvent, function (value) {
                _this.check(value);
                // EventBus.$emit('show-alert', this.label.replace(' :', '') + ' also checked', 'success')
            });
        }

        if (this.value !== undefined && this.value !== null) {

            this.currentValue = this.value;

            this.showReset = true;

            if (this.value == this.triggerValue) {
                this.showExtra = true;
            }
        }

        if (this.needSync !== undefined) {
            var url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field;
            axios.get(url).then(function (response) {
                check(response.data);
            }).catch(function (error) {
                console.log(error);
            });
        }
    },

    computed: {
        optionsObjects: function optionsObjects() {
            if (typeof this.options == 'string') {
                return JSON.parse(this.options);
            }
            return this.options;
        },


        // check if has content in default slot.
        hasDefaultSlot: function hasDefaultSlot() {
            return !!this.$slots.default;
        },

        // extract label action emit event name.
        labelActionEmitEventName: function labelActionEmitEventName() {
            if (this.labelAction !== undefined) {
                return typeof this.labelAction == 'string' ? JSON.parse(this.labelAction).emit : this.labelAction.emit;
            }
            return '';
        },

        // extract label action icon.
        labelActionIcon: function labelActionIcon() {
            if (this.labelAction !== undefined) {
                return 'fa fa-' + (typeof this.labelAction == 'string' ? JSON.parse(this.labelAction).icon : this.labelAction.icon);
            }
            return '';
        },

        // extract label action icon title.
        labelActionTitle: function labelActionTitle() {
            if (this.labelAction !== undefined) {
                return typeof this.labelAction == 'string' ? JSON.parse(this.labelAction).title : this.labelAction.title;
            }
            return '';
        },
        triggerValues: function triggerValues() {
            if (this.triggerValue !== undefined) {
                return JSON.parse(this.triggerValue);
            }
            return null;
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 203 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "div",
        { staticClass: "form-group-sm" },
        [
          _c("label", { staticClass: "control-label" }, [
            _c("span", { domProps: { innerHTML: _vm._s(_vm.label) } }),
            _vm._v(" "),
            _vm.labelAction !== undefined
              ? _c(
                  "a",
                  {
                    attrs: {
                      role: "button",
                      "data-toggle": "tooltip",
                      title: _vm.labelActionTitle
                    },
                    on: {
                      click: function($event) {
                        _vm.emitLabelActionEvent()
                      }
                    }
                  },
                  [_c("i", { class: _vm.labelActionIcon })]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.labelDescription !== undefined
              ? _c(
                  "a",
                  {
                    attrs: {
                      role: "button",
                      "data-toggle": "tooltip",
                      title: _vm.labelDescription
                    }
                  },
                  [_c("i", { staticClass: "fa fa-info-circle" })]
                )
              : _vm._e(),
            _vm._v(" "),
            _vm.labelDescription !== undefined
              ? _c("span", [_vm._v(":")])
              : _vm._e()
          ]),
          _vm._v(" "),
          _c("transition", { attrs: { name: "slide-fade" } }, [
            _c(
              "a",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: _vm.showReset,
                    expression: "showReset"
                  }
                ],
                attrs: { role: "button" },
                on: {
                  click: function($event) {
                    _vm.reset()
                  }
                }
              },
              [_c("i", { staticClass: "fa fa-remove" })]
            )
          ]),
          _vm._v(" "),
          _vm._l(_vm.optionsObjects, function(option) {
            return _c(
              "label",
              { key: option.label, staticClass: "radio-inline" },
              [
                _c("input", {
                  attrs: { type: "radio", name: _vm.field },
                  domProps: {
                    value: option.value,
                    checked: option.value == _vm.currentValue
                  },
                  on: {
                    click: function($event) {
                      _vm.check(option.value)
                    }
                  }
                }),
                _vm._v(" "),
                _c("span", { domProps: { innerHTML: _vm._s(option.label) } }),
                _vm._v(" "),
                option.labelDescription !== undefined
                  ? _c(
                      "a",
                      {
                        attrs: {
                          role: "button",
                          "data-toggle": "tooltip",
                          title: option.labelDescription
                        }
                      },
                      [_c("i", { staticClass: "fa fa-info-circle" })]
                    )
                  : _vm._e()
              ]
            )
          })
        ],
        2
      ),
      _vm._v(" "),
      _c("transition", { attrs: { name: "slide-fade" } }, [
        _vm.showExtra
          ? _c(
              "div",
              { staticClass: "form-group-sm extra" },
              [_vm._t("default")],
              2
            )
          : _vm._e()
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4a27a5d0", module.exports)
  }
}

/***/ }),
/* 204 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(205)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(207)
/* template */
var __vue_template__ = __webpack_require__(208)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/inputs/InputSelect.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-ca4f6712", Component.options)
  } else {
    hotAPI.reload("data-v-ca4f6712", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 205 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(206);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("4cc8e798", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-ca4f6712\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputSelect.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-ca4f6712\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputSelect.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 206 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.cursor-pointer {\n    cursor:pointer;\n}\n", ""]);

// exports


/***/ }),
/* 207 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        // field name on database.
        field: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: false
        },
        labelDescription: {
            type: String,
            required: false
        },
        // define Bootstrap grid class in mobile-tablet-desktop order
        grid: {
            type: String,
            required: false
        },
        // endpoint to get options.
        serviceUrl: {
            type: String,
            required: false
        },
        // initial value.
        value: {
            type: [String, Number],
            required: false
        },
        // allow user type-in or not, Just mention this option.
        notAllowOther: {
            type: String,
            required: false
        },
        // define Bootstrap form-group has-feedback which size of form-group should use.
        size: {
            type: String,
            required: false
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        },
        placeholder: {
            type: String,
            required: false
        },
        emitOnUpdate: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            userInput: '',
            domRef: 'input[name=' + this.field + ']',
            showReset: false,
            lastData: ''
        };
    },
    mounted: function mounted() {
        var _this = this;

        // init label tooltip if available.
        if (this.labelDescription !== undefined) {
            $('a[title="' + this.labelDescription + '"]').tooltip();
        }

        if (this.needSync !== undefined) {
            // let url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field
            var url = this.needSync + '/' + this.field;
            axios.get(url).then(function (response) {
                _this.userInput = response.data;
            }).catch(function (error) {
                _this.userInput = 'error';
            });
        }

        if (this.value === undefined || this.value === null) {
            this.lastData = this.userInput = null;
            this.showReset = false;
        } else {
            this.lastData = this.userInput = this.value;
            this.showReset = true;
        }

        // init autocomplete.
        $(this.domRef).autocomplete({
            // width: this.maxWid,
            serviceUrl: this.getServiceUrl,
            onSelect: function onSelect(suggestion) {
                _this.showReset = true;
                _this.data = suggestion.data;
                _this.userInput = suggestion.value;
                _this.autosave();
            },
            minChars: 0, // render options on focus
            maxHeight: 240
        });
    },

    methods: {
        reset: function reset() {
            this.showReset = false;
            this.userInput = '';
            this.autosave();
        },
        autosave: function autosave() {
            if (this.field !== undefined && this.userInput != this.lastData) {
                EventBus.$emit('autosave', this.field, this.userInput);
                this.lastData = this.userInput;

                if (this.emitOnUpdate !== undefined) {
                    EventBus.$emit(this.emitOnUpdate, this.userInput);
                }
            }
        }
    },
    computed: {
        getServiceUrl: function getServiceUrl() {
            if (this.serviceUrl === undefined) {
                return '/lists/select/' + this.field;
            }

            return '/lists/' + this.serviceUrl;
        },
        componentGrid: function componentGrid() {
            if (this.grid === undefined) {
                return '';
            }
            // let grid = this.grid.split('-').map((x) => 12/x)
            var grid = this.grid.split('-');
            return 'col-xs-' + grid[0] + ' col-sm-' + grid[1] + ' col-md-' + grid[2];
        },
        componentSize: function componentSize() {
            if (this.size == 'normal') {
                return 'form-group has-feedback';
            }
            return 'form-group-sm has-feedback';
        },
        isAllowOther: function isAllowOther() {
            return this.notAllowOther === undefined ? 'return true;' : 'return false;';
        },
        isMaxWidthDiv: function isMaxWidthDiv() {
            if (this.label === undefined) {
                return "width: 95%;";
            }
            return "";
        },
        isMaxWidthInput: function isMaxWidthInput() {
            if (this.label === undefined) {
                return "width: 100%;";
            }
            return "";
        },
        isMaxWidthReset: function isMaxWidthReset() {
            if (this.label === undefined) {
                return "width: 5%;";
            }
            return "";
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 208 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { class: _vm.componentGrid }, [
    _vm.label === undefined
      ? _c(
          "a",
          {
            directives: [
              {
                name: "show",
                rawName: "v-show",
                value: _vm.showReset,
                expression: "showReset"
              }
            ],
            style: _vm.isMaxWidthReset,
            attrs: { role: "button" },
            on: {
              click: function($event) {
                _vm.reset()
              }
            }
          },
          [_c("i", { staticClass: "fa fa-remove" })]
        )
      : _vm._e(),
    _vm._v(" "),
    _c("div", { class: _vm.componentSize, style: _vm.isMaxWidthDiv }, [
      _vm.label !== undefined
        ? _c(
            "label",
            { staticClass: "control-label topped", attrs: { for: _vm.field } },
            [
              _c("span", { domProps: { innerHTML: _vm._s(_vm.label) } }),
              _vm._v(" "),
              _vm.labelDescription !== undefined
                ? _c(
                    "a",
                    {
                      attrs: {
                        role: "button",
                        "data-toggle": "tooltip",
                        title: _vm.labelDescription
                      }
                    },
                    [_c("i", { staticClass: "fa fa-info-circle" })]
                  )
                : _vm._e(),
              _vm._v(" "),
              _vm.labelDescription !== undefined
                ? _c("span", [_vm._v(":")])
                : _vm._e(),
              _vm._v(" "),
              _c(
                "a",
                {
                  directives: [
                    {
                      name: "show",
                      rawName: "v-show",
                      value: _vm.showReset,
                      expression: "showReset"
                    }
                  ],
                  attrs: { role: "button" },
                  on: {
                    click: function($event) {
                      _vm.reset()
                    }
                  }
                },
                [_c("i", { staticClass: "fa fa-remove" })]
              )
            ]
          )
        : _vm._e(),
      _vm._v(" "),
      _c("input", {
        directives: [
          {
            name: "model",
            rawName: "v-model",
            value: _vm.userInput,
            expression: "userInput"
          }
        ],
        staticClass: "form-control cursor-pointer",
        style: _vm.isMaxWidthInput,
        attrs: {
          type: "text",
          name: _vm.field,
          id: _vm.field,
          onkeypress: _vm.isAllowOther,
          placeholder: _vm.placeholder
        },
        domProps: { value: _vm.userInput },
        on: {
          blur: function($event) {
            _vm.autosave()
          },
          input: [
            function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.userInput = $event.target.value
            },
            function($event) {
              _vm.showReset = _vm.userInput != ""
            }
          ]
        }
      }),
      _vm._v(" "),
      _c("span", { staticClass: "fa fa-chevron-down form-control-feedback" })
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-ca4f6712", module.exports)
  }
}

/***/ }),
/* 209 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(210)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(212)
/* template */
var __vue_template__ = __webpack_require__(213)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/inputs/InputTextarea.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-d7bf5a16", Component.options)
  } else {
    hotAPI.reload("data-v-d7bf5a16", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 210 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(211);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("33d84e2c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d7bf5a16\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextarea.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d7bf5a16\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextarea.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 211 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.fix-margin {\n    margin-top: .3em;\n}\n.textarea-warning {\n    /*Important stuff here*/\n    -webkit-transition: flash-warning 3s ease-out;\n    transition: flash-warning 3s ease-out;\n    -webkit-animation: flash-warning 3s forwards linear normal;\n            animation: flash-warning 3s forwards linear normal;\n}\n@-webkit-keyframes flash-warning {\n0% {\n        background:#fff;\n}\n50% {\n        background:#f0ad4e;\n}\n100% {\n        background:#fff;\n}\n}\n@keyframes flash-warning {\n0% {\n        background:#fff;\n}\n50% {\n        background:#f0ad4e;\n}\n100% {\n        background:#fff;\n}\n}\n.textarea-danger {\n    /*Important stuff here*/\n    -webkit-transition: flash-danger 3s ease-out;\n    transition: flash-danger 3s ease-out;\n    -webkit-animation: flash-danger 3s forwards linear normal;\n            animation: flash-danger 3s forwards linear normal;\n}\n@-webkit-keyframes flash-danger {\n0% {\n        background:#fff;\n}\n50% {\n        background:#d9534f;\n}\n100% {\n        background:#fff;\n}\n}\n@keyframes flash-danger {\n0% {\n        background:#fff;\n}\n50% {\n        background:#d9534f;\n}\n100% {\n        background:#fff;\n}\n}\n", ""]);

// exports


/***/ }),
/* 212 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        // field name on database.
        field: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: false
        },
        // define Bootstrap grid class in mobile-tablet-desktop order
        grid: {
            type: String,
            required: false
        },
        // initial value.
        value: {
            type: String,
            required: false
        },
        // allow user type-in or not, Just mention this option.
        readonly: {
            type: String,
            required: false
        },
        placeholder: {
            type: String,
            required: false
        },
        maxChars: {
            type: String,
            required: false
        },
        setterEvent: {
            type: String,
            required: false
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            userInput: '',
            domRef: 'textarea[name=' + this.field + ']',
            dirty: false,
            controlClass: 'form-control',
            helperClass: 'text-muted',
            showCharsRemaining: false,
            charsRemaining: 0
        };
    },
    mounted: function mounted() {
        var _this = this;

        if (this.value === undefined) this.userInput = '';else this.userInput = this.value;

        if (this.setterEvent !== undefined) {
            EventBus.$on(this.setterEvent, function (value) {
                var mode = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'put';

                if (mode == 'put') {
                    _this.userInput = value;
                } else {
                    if (_this.userInput == '') {
                        _this.userInput += value;
                    } else {
                        _this.userInput += '\n' + value;
                    }
                }
                _this.dirty = true;
                _this.autosave();
            });
        }

        if (this.needSync !== undefined) {
            var url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field;
            axios.get(url).then(function (response) {
                _this.userInput = response.data;
            }).catch(function (error) {
                _this.userInput = 'error';
            });
        }

        autosize($(this.domRef));
        this.onkeypress = _.debounce(function () {
            var countChars = _this.userInput.length;
            if (countChars > .5 * _this.getMaxChars) {
                _this.charsRemaining = _this.getMaxChars - _this.userInput.length;
                _this.showCharsRemaining = true;
                if (countChars > .75 * _this.getMaxChars) {
                    _this.toggleStatus('danger');
                } else {
                    _this.toggleStatus('warning');
                }
            } else {
                _this.toggleStatus('');
            }
        }, 300);
        this.onkeypressSave = _.debounce(function () {
            _this.autosave();
        }, 5000);
    },

    methods: {
        getGrid: function getGrid() {
            var divClass = '';
            if (this.grid == undefined) {
                divClass = '';
            } else {
                // let grid = this.grid.split('-').map((x) => 12/x)
                var grid = this.grid.split('-');
                divClass = 'col-xs-' + grid[0] + ' col-sm-' + grid[1] + ' col-md-' + grid[2];
            }

            if (this.label === undefined) {
                divClass += ' fix-margin';
            }
            return divClass;
        },
        autosave: function autosave() {
            var _this2 = this;

            if (this.readonly != '' && this.dirty) {
                EventBus.$emit('autosave', this.field, this.userInput);
                this.dirty = false;
                this.showCharsRemaining = false;
                this.toggleStatus('');
            }

            if (this.showCharsRemaining) {
                this.showCharsRemaining = false;
            }

            // seem like Vue delay update so, we delay autosize process to take effect
            setTimeout(function () {
                autosize.update($(_this2.domRef));
            }, 100);
        },
        oninput: function oninput() {

            if (!this.dirty && this.userInput.length < this.getMaxChars) {
                this.dirty = true;
            }

            if (this.showCharsRemaining) {
                this.charsRemaining = this.getMaxChars - this.userInput.length;
            }

            this.onkeypress();
            this.onkeypressSave();
        },
        onkeypress: function onkeypress() {
            // define on mounted
        },
        onkeypressSave: function onkeypressSave() {
            // define on mounted
        },
        toggleStatus: function toggleStatus(status) {
            var baseClass = '';
            var subClass = '';
            var show = false;
            switch (status) {
                case 'warning':
                    baseClass = 'form-control textarea-warning';
                    subClass = 'text-warning';
                    show = true;
                    break;
                case 'danger':
                    baseClass = 'form-control textarea-danger';
                    subClass = 'text-danger';
                    show = true;
                    break;
                default:
                    baseClass = 'form-control';
                    subClass = 'text-muted';
            }
            if (this.controlClass != baseClass) {
                this.controlClass = baseClass;
                this.helperClass = subClass;
                this.showCharsRemaining = show;
            }
        },
        onfocus: function onfocus() {
            if (this.userInput !== null && this.userInput.length == this.getMaxChars) {
                this.toggleStatus('danger');
            }
        }
    },
    computed: {
        getMaxChars: function getMaxChars() {
            return this.maxChars === undefined ? 255 : this.maxChars;
        },
        placeholderNew: function placeholderNew() {
            var placeholder = '';
            if (this.placeholder !== undefined) {
                placeholder += this.placeholder;
                if (this.getMaxChars !== undefined) {
                    return placeholder += ' - ' + this.getMaxChars + ' chars max';
                } else {
                    return placeholder;
                }
            }

            if (this.getMaxChars !== undefined) {
                return this.getMaxChars + ' chars max';
            }
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 213 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { class: _vm.getGrid() }, [
    _c(
      "div",
      { staticClass: "form-group-sm" },
      [
        _vm.label != undefined
          ? _c(
              "label",
              { staticClass: "control-label", attrs: { for: _vm.field } },
              [_vm._v("\n                " + _vm._s(_vm.label) + "\n        ")]
            )
          : _vm._e(),
        _vm._v(" "),
        _c("textarea", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.userInput,
              expression: "userInput"
            }
          ],
          class: _vm.controlClass,
          attrs: {
            readonly: _vm.readonly,
            name: _vm.field,
            id: _vm.field,
            maxlength: _vm.maxChars,
            placeholder: _vm.placeholderNew,
            rows: "1"
          },
          domProps: { value: _vm.userInput },
          on: {
            input: [
              function($event) {
                if ($event.target.composing) {
                  return
                }
                _vm.userInput = $event.target.value
              },
              function($event) {
                _vm.oninput()
              }
            ],
            blur: function($event) {
              _vm.autosave()
            },
            focus: function($event) {
              _vm.onfocus()
            }
          }
        }),
        _vm._v(" "),
        _c("transition", { attrs: { name: "slide-fade" } }, [
          _vm.showCharsRemaining
            ? _c("p", { class: _vm.helperClass }, [
                _c("strong", [
                  _vm._v(_vm._s(_vm.charsRemaining) + " chars remain.")
                ])
              ])
            : _vm._e()
        ])
      ],
      1
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-d7bf5a16", module.exports)
  }
}

/***/ }),
/* 214 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(215)
/* template */
var __vue_template__ = __webpack_require__(216)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/inputs/InputSuggestion.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-db2e1802", Component.options)
  } else {
    hotAPI.reload("data-v-db2e1802", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 215 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        // field name on database.
        field: {
            type: String,
            required: false
        },
        label: {
            type: String,
            required: false
        },
        placeholder: {
            type: String,
            required: false
        },
        // define Bootstrap grid class in mobile-tablet-desktop order
        grid: {
            type: String,
            required: false
        },
        // initial value.
        value: {
            type: String,
            required: false
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        },
        // endpoint to get options.
        serviceUrl: {
            type: String,
            required: false
        },
        // min chars to trigger suggestions.
        minChars: {
            type: String,
            required: false
        },
        targetId: {
            type: String,
            required: false
        }

    },
    data: function data() {
        return {
            userInput: '',
            lastData: '',
            saved: false
        };
    },
    mounted: function mounted() {
        var _this = this;

        // initial data
        if (this.value === undefined || this.value === null) this.lastData = this.userInput = '';else this.lastData = this.userInput = this.value;

        // listen to event to trigger event
        if (this.interfaceEvent !== undefined) {
            EventBus.$on(this.interfaceEvent, function () {
                _this.emitUpdate();
            });
        }

        // initial autocomplete instance
        $('#' + this.id).autocomplete({
            // setup sservice endpoint
            serviceUrl: this.getServiceUrl,
            // format suggestions
            beforeRender: function beforeRender(container, suggestions) {
                for (var i = 0; i < container.children().length; i++) {
                    var strHTML = container.children().eq(i).html();
                    // custom format if there is not aleardy formatted
                    if (strHTML.search('<strong>') < 0 && strHTML.search(_this.userInput[0]) >= 0) {
                        var strHTMLNew = '';
                        var lastPos = 0; // last sub string position
                        for (var j = 0; j < _this.userInput.length; j++) {
                            for (var k = lastPos; k < strHTML.length; k++) {
                                // apply strong element to highlight matched character
                                if (strHTML[k] == _this.userInput[j]) {
                                    strHTMLNew += '<strong>' + _this.userInput[j] + '</strong>';
                                    lastPos = k + 1;
                                    break;
                                } else {
                                    strHTMLNew += strHTML[k];
                                }
                            }
                        }
                        // concat remain string
                        for (var _k = lastPos; _k < strHTML.length; _k++) {
                            strHTMLNew += strHTML[_k];
                        }
                        container.children().eq(i).html(strHTMLNew);
                    }
                }
            },
            onSelect: function onSelect(suggestion) {
                _this.userInput = suggestion.value;
                _this.autosave();
            },
            minChars: this.minChars == undefined ? 3 : Number(this.minChars),
            maxHeight: 240
        });

        if (this.needSync !== undefined) {
            // let url = '/note-data/' + window.location.pathname.split("/")[2] + '/' + this.field
            var url = this.needSync + '/' + this.field;
            axios.get(url).then(function (response) {
                _this.userInput = response.data;
            }).catch(function (error) {
                _this.userInput = 'error';
            });
        }
    },

    methods: {
        getGrid: function getGrid() {
            if (this.grid == undefined) {
                return 'col-xs-12';
            }
            var grid = this.grid.split('-');
            return 'col-xs-' + grid[0] + ' col-sm-' + grid[1] + ' col-md-' + grid[2];
        },
        autosave: function autosave() {
            if (this.field !== undefined && this.userInput != this.lastData) {
                EventBus.$emit('autosave', this.field, this.userInput);
                this.lastData = this.userInput;
                this.saved = true;
            }
        },
        tryAutosave: function tryAutosave() {
            var _this2 = this;

            setTimeout(function () {
                if (!_this2.saved) {
                    _this2.autosave();
                }
            }, 1000);
        }
    },
    computed: {
        getServiceUrl: function getServiceUrl() {
            if (this.serviceUrl == undefined) {
                return '/lists/autocomplete/' + this.field;
            }
            return '/lists/' + this.serviceUrl;
        },
        id: function id() {
            if (this.targetId !== undefined) return this.targetId;

            if (this.field !== undefined) return this.field;

            return Date.now() + this.serviceUrl.replace(new RegExp('/', 'g'), '');
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 216 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { class: _vm.getGrid() }, [
    _c("div", { staticClass: "form-group-sm" }, [
      _vm.label !== undefined
        ? _c(
            "label",
            { staticClass: "control-label topped", attrs: { for: _vm.id } },
            [_vm._v("\n            " + _vm._s(_vm.label) + "\n        ")]
          )
        : _vm._e(),
      _vm._v(" "),
      _c("div", { staticClass: "input-group" }, [
        _vm._m(0),
        _vm._v(" "),
        _c("input", {
          directives: [
            {
              name: "model",
              rawName: "v-model",
              value: _vm.userInput,
              expression: "userInput"
            }
          ],
          staticClass: "form-control",
          attrs: {
            type: "text",
            name: _vm.field,
            id: _vm.id,
            placeholder: _vm.placeholder
          },
          domProps: { value: _vm.userInput },
          on: {
            focus: function($event) {
              _vm.saved = false
            },
            blur: function($event) {
              _vm.tryAutosave()
            },
            input: function($event) {
              if ($event.target.composing) {
                return
              }
              _vm.userInput = $event.target.value
            }
          }
        })
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("span", { staticClass: "input-group-addon" }, [
      _c("i", { staticClass: "fa fa-lightbulb-o" })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-db2e1802", module.exports)
  }
}

/***/ }),
/* 217 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(218)
/* template */
var __vue_template__ = __webpack_require__(219)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/inputs/InputCheckGroup.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-aa3e625c", Component.options)
  } else {
    hotAPI.reload("data-v-aa3e625c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 218 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__inputs_InputCheck_vue__ = __webpack_require__(64);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__inputs_InputCheck_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__inputs_InputCheck_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//


/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        'input-check': __WEBPACK_IMPORTED_MODULE_0__inputs_InputCheck_vue___default.a
    },
    props: {
        label: {
            type: String,
            required: false
        },
        // JSON input-check excluded needSync
        checks: {
            type: [String, Array],
            required: true
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        }
    },
    created: function created() {
        this.checkObjects = typeof this.checks == 'string' ? JSON.parse(this.checks) : this.checks;
    }
});

/***/ }),
/* 219 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "form-group-sm" },
    [
      _c("label", { staticClass: "control-label" }, [
        _vm._v(_vm._s(_vm.label))
      ]),
      _vm._v(" "),
      _vm._l(_vm.checkObjects, function(check) {
        return _c("input-check", {
          key: check.field,
          attrs: {
            field: check.field,
            label: check.label,
            "label-description": check.labelDescription,
            checked: check.checked,
            "emit-on-update": check.emitOnUpdate,
            "setter-event": check.setterEvent,
            "need-sync": _vm.needSync
          }
        })
      })
    ],
    2
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-aa3e625c", module.exports)
  }
}

/***/ }),
/* 220 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(221)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(223)
/* template */
var __vue_template__ = __webpack_require__(224)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/modals/Medicine/ChildPughScore.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-bb450d1a", Component.options)
  } else {
    hotAPI.reload("data-v-bb450d1a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 221 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(222);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("389306be", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bb450d1a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ChildPughScore.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-bb450d1a\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ChildPughScore.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 222 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n#modal-body-child-pugh {\n    font-size: 12pt;\n}\n#modal-body-child-pugh td {\n    padding-left: 5px;\n}\n#modal-body-child-pugh p {\n    padding-top: 5px;\n}\n", ""]);

// exports


/***/ }),
/* 223 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    created: function created() {
        EventBus.$on('toggle-modal-child-pugh-score-detail', function (toggle) {
            $('#modal-child-pugh-score').modal(toggle === undefined ? 'toggle' : toggle);
        });
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 224 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "modal fade",
      attrs: { id: "modal-child-pugh-score", tabindex: "-1", role: "dialog" }
    },
    [
      _c("div", { staticClass: "modal-dialog", attrs: { role: "document" } }, [
        _c("div", { staticClass: "modal-content" }, [
          _vm._m(0),
          _vm._v(" "),
          _vm._m(1),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "modal-footer" },
            [
              _c("button-app", {
                attrs: {
                  action: "toggle-modal-child-pugh-score-detail",
                  status: "draft",
                  label: "OK",
                  size: "sm"
                }
              })
            ],
            1
          )
        ])
      ])
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "modal-header alert alert-default",
        attrs: { id: "modal-sms-box-header" }
      },
      [
        _c(
          "button",
          {
            staticClass: "close",
            attrs: {
              type: "button",
              "data-dismiss": "modal",
              "aria-label": "Close"
            }
          },
          [_c("span", { attrs: { "aria-hidden": "true" } }, [_vm._v("×")])]
        ),
        _vm._v(" "),
        _c("p", { staticClass: "modal-title" }, [
          _c("span", {
            staticClass: "fa fa-comment-o",
            attrs: { "aria-hidden": "true" }
          }),
          _vm._v(" Child-Pugh's Score")
        ])
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass: "modal-body",
        staticStyle: {
          "max-height": "calc(100vh - 30vh)",
          "overflow-y": "auto"
        },
        attrs: { id: "modal-body-child-pugh" }
      },
      [
        _c("p", [
          _vm._v(
            "The score employs five clinical measures of liver disease. Each measure is scored 1-3, with 3 indicating most severe derangement."
          )
        ]),
        _vm._v(" "),
        _c(
          "table",
          {
            staticStyle: { "border-collapse": "collapse" },
            attrs: { cellpadding: "3", cellspacing: "0", border: "1" }
          },
          [
            _c("tr", { staticStyle: { "background-color": "#aad" } }, [
              _c(
                "th",
                { staticClass: "text-center", staticStyle: { width: "20%" } },
                [_vm._v("Measure")]
              ),
              _vm._v(" "),
              _c(
                "th",
                { staticClass: "text-center", staticStyle: { width: "10%" } },
                [_vm._v("1 point")]
              ),
              _vm._v(" "),
              _c(
                "th",
                { staticClass: "text-center", staticStyle: { width: "35%" } },
                [_vm._v("2 points")]
              ),
              _vm._v(" "),
              _c(
                "th",
                { staticClass: "text-center", staticStyle: { width: "35%" } },
                [_vm._v("3 points")]
              )
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("Total bilirubin (mg/dl)")]),
              _vm._v(" "),
              _c("td", [_vm._v("<2")]),
              _vm._v(" "),
              _c("td", [_vm._v("2-3")]),
              _vm._v(" "),
              _c("td", [_vm._v(">3")])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("Serum albumin (g/dl)")]),
              _vm._v(" "),
              _c("td", [_vm._v(">3.5")]),
              _vm._v(" "),
              _c("td", [_vm._v("2.8-3.5")]),
              _vm._v(" "),
              _c("td", [_vm._v("<2.8")])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("Prothrombin time (secs)")]),
              _vm._v(" "),
              _c("td", [_vm._v("<4.0")]),
              _vm._v(" "),
              _c("td", [_vm._v("4.0-6.0")]),
              _vm._v(" "),
              _c("td", [_vm._v("> 6.0")])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("Ascites")]),
              _vm._v(" "),
              _c("td", [_vm._v("None")]),
              _vm._v(" "),
              _c("td", [_vm._v("Mild")]),
              _vm._v(" "),
              _c("td", [_vm._v("Moderate to Severe")])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("Hepatic encephalopathy")]),
              _vm._v(" "),
              _c("td", [_vm._v("None")]),
              _vm._v(" "),
              _c("td", [_vm._v("Grade I-II (or suppressed with medication)")]),
              _vm._v(" "),
              _c("td", [_vm._v("Grade III-IV (or refractory)")])
            ])
          ]
        ),
        _vm._v(" "),
        _c("p", [
          _vm._v(
            "Different textbooks and publications use different measures. Some older reference works substitute PT prolongation for INR."
          )
        ]),
        _vm._v(" "),
        _c("p", [
          _vm._v("In "),
          _c("a", { attrs: { title: "Primary sclerosing cholangitis" } }, [
            _vm._v("primary sclerosing cholangitis")
          ]),
          _vm._v(" (PSC) and "),
          _c("a", { attrs: { title: "Primary biliary cirrhosis" } }, [
            _vm._v("primary biliary cirrhosis")
          ]),
          _vm._v(
            " (PBC), the bilirubin references are changed to reflect the fact that these diseases feature high conjugated bilirubin levels. The upper limit for 1 point is 4 mg/dl and the upper limit for 2 points is 10 mg/dl."
          )
        ]),
        _vm._v(" "),
        _c(
          "table",
          {
            staticStyle: { "border-collapse": "collapse" },
            attrs: { cellpadding: "3", cellspacing: "0", border: "1" }
          },
          [
            _c("tr", [
              _c("td", { attrs: { bgcolor: "#AAAADD" } }, [
                _c("b", [_vm._v("Points")])
              ]),
              _vm._v(" "),
              _c("td", { attrs: { bgcolor: "#AAAADD" } }, [
                _c("b", [_vm._v("Class")])
              ]),
              _vm._v(" "),
              _c("td", { attrs: { bgcolor: "#AAAADD" } }, [
                _c("b", [_vm._v("One year survival")])
              ]),
              _vm._v(" "),
              _c("td", { attrs: { bgcolor: "#AAAADD" } }, [
                _c("b", [_vm._v("Two year survival")])
              ])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("5-6")]),
              _vm._v(" "),
              _c("td", [_vm._v("A")]),
              _vm._v(" "),
              _c("td", [_vm._v("100%")]),
              _vm._v(" "),
              _c("td", [_vm._v("85%")])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("7-9")]),
              _vm._v(" "),
              _c("td", [_vm._v("B")]),
              _vm._v(" "),
              _c("td", [_vm._v("81%")]),
              _vm._v(" "),
              _c("td", [_vm._v("57%")])
            ]),
            _vm._v(" "),
            _c("tr", [
              _c("td", [_vm._v("10-15")]),
              _vm._v(" "),
              _c("td", [_vm._v("C")]),
              _vm._v(" "),
              _c("td", [_vm._v("45%")]),
              _vm._v(" "),
              _c("td", [_vm._v("35%")])
            ])
          ]
        ),
        _vm._v(" "),
        _c("p", [
          _vm._v(
            "Chronic liver disease is classified into Child-Pugh class A to C, employing the added score from above."
          )
        ])
      ]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-bb450d1a", module.exports)
  }
}

/***/ }),
/* 225 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "container-fluid" },
    [
      _c("modal-child-pugh-score-detail"),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Admission data" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-text", {
              attrs: {
                label: "Admit :",
                field: "datetime_admit",
                grid: "12-6-3",
                value: _vm.note.admission.datetime_admit_formated,
                readonly: ""
              }
            }),
            _vm._v(" "),
            _c("input-text", {
              attrs: {
                label: "Discharge :",
                field: "datetime_discharge",
                grid: "12-6-3",
                value: _vm.note.admission.datetime_discharge_formated,
                readonly: ""
              }
            }),
            _vm._v(" "),
            _c("input-text", {
              attrs: {
                label: "Length of stay :",
                field: "lenght_of_stay",
                grid: "12-6-3",
                value: _vm.note.admission.lenght_of_stay,
                readonly: ""
              }
            }),
            _vm._v(" "),
            _c("input-suggestion", {
              attrs: {
                field: "ward",
                label: "Ward :",
                grid: "12-6-3",
                "min-chars": "2",
                value: _vm.note.ward_name
              }
            }),
            _vm._v(" "),
            _c("input-suggestion", {
              attrs: {
                field: "attending",
                label: "Attending :",
                grid: "12-6-3",
                "min-chars": "3",
                value: _vm.note.attending_name
              }
            }),
            _vm._v(" "),
            _c("input-suggestion", {
              attrs: {
                field: "division",
                label: "Specialty :",
                grid: "12-6-3",
                "min-chars": "3",
                value: _vm.note.division_name
              }
            }),
            _vm._v(" "),
            _c("input-select", {
              attrs: {
                field: "admit_reason",
                label: "Reason to admit :",
                placeholder: "if other choice, type here",
                grid: "12-6-3",
                value: _vm.note.detail.admit_reason_text
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "History" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-textarea", {
              attrs: {
                field: "chief_complaint",
                label: "Chief complaint :",
                grid: "12-12-12",
                "max-chars": "50",
                value: _vm.note.detail.chief_complaint
              }
            }),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12" }, [
              _c("hr", { staticClass: "line" })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12 form-inline" },
              [
                _c("button-app", {
                  attrs: {
                    action: "comorbid-no-data-all",
                    status: "draft",
                    label: "No Data",
                    size: "sm"
                  }
                }),
                _vm._v(" "),
                _c("button-app", {
                  attrs: {
                    action: "comorbid-no-at-all",
                    status: "draft",
                    label: "No comorbids",
                    size: "sm"
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12 col-sm-6 col-md-4" }, [
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "comorbid_DM",
                        label: "DM :",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.inputRadioExtrasTriggerValue,
                        value: _vm.note.detail.comorbid_DM,
                        "emit-on-update": "reset-comorbid_DM-extras"
                      }
                    },
                    [
                      _c("input-radio", {
                        attrs: {
                          field: "comorbid_DM_type",
                          label: "Type : ",
                          options:
                            '[\n                                {"label": "I", "value": 1},\n                                {"label": "II", "value": 2}\n                            ]',
                          value: _vm.note.detail.comorbid_DM_type
                        }
                      }),
                      _vm._v(" "),
                      _c("input-check-group", {
                        attrs: {
                          label: "Complication : ",
                          checks: _vm.DMComplicationChecks
                        }
                      }),
                      _vm._v(" "),
                      _c("input-check-group", {
                        attrs: {
                          label: "Treatment : ",
                          checks: _vm.DMTreatmentChecks
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c("div", [_c("hr", { staticClass: "line" })]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "comorbid_valvular_heart_disease",
                        label: "Valvular heart disease :",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.inputRadioExtrasTriggerValue,
                        value: _vm.note.detail.comorbid_valvular_heart_disease,
                        "emit-on-update":
                          "reset-comorbid_valvular_heart_disease-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: {
                          label: "Specify : ",
                          checks: _vm.valvularHeartDiseaseChecks
                        }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_valvular_heart_disease_other",
                          value:
                            _vm.note.detail
                              .comorbid_valvular_heart_disease_other,
                          size: "normal",
                          placeholder: "Other specific, type here."
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c("div", [_c("hr", { staticClass: "line" })]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c("input-radio", {
                    attrs: {
                      field: "comorbid_asthma",
                      label: "Asthma :",
                      options: _vm.comorbidOptions,
                      value: _vm.note.detail.comorbid_asthma
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("div", [_c("hr", { staticClass: "line" })]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "comorbid_cirrhosis",
                        label: "Cirrhosis :",
                        options: _vm.comorbidOptions,
                        value: _vm.note.detail.comorbid_asthma,
                        "trigger-value": _vm.inputRadioExtrasTriggerValue
                      }
                    },
                    [
                      _c("input-radio", {
                        attrs: {
                          field: "comorbid_cirrhosis_child_pugh_score",
                          value:
                            _vm.note.detail.comorbid_cirrhosis_child_pugh_score,
                          label: "Child-Pugh's Score :",
                          "label-action": _vm.cirrhosisLabelAction,
                          options:
                            '[\n                                {"label": "A", "value": "A"},\n                                {"label": "B", "value": "B"},\n                                {"label": "C", "value": "C"}\n                            ]'
                        }
                      }),
                      _vm._v(" "),
                      _c("input-check-group", {
                        attrs: {
                          label: "Specify : ",
                          checks: _vm.cirrhosisSpecificChecks
                        }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_cirrhosis_other",
                          value: _vm.note.detail.comorbid_cirrhosis_other,
                          size: "normal",
                          placeholder: "Other specific, type here."
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c("div", [_c("hr", { staticClass: "line" })])
            ])
          ],
          1
        )
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-40a3f299", module.exports)
  }
}

/***/ }),
/* 226 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(227)
/* template */
var __vue_template__ = __webpack_require__(228)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/navbars/EditNote.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2a949d7f", Component.options)
  } else {
    hotAPI.reload("data-v-2a949d7f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 227 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__AuthenticatedNavbarRight_vue__ = __webpack_require__(55);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__AuthenticatedNavbarRight_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__AuthenticatedNavbarRight_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Navbar_vue__ = __webpack_require__(28);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Navbar_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__Navbar_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//




/* harmony default export */ __webpack_exports__["default"] = ({
    components: {
        'navbar-right': __WEBPACK_IMPORTED_MODULE_0__AuthenticatedNavbarRight_vue___default.a,
        'navbar': __WEBPACK_IMPORTED_MODULE_1__Navbar_vue___default.a
    },
    props: {
        link: {
            type: String,
            reqiured: true
        },
        brand: {
            type: String,
            reqiured: true
        },
        title: {
            type: String,
            reqiured: true
        },
        username: {
            type: String,
            reqiured: true
        },
        autosaveIcon: {
            type: String,
            reqiured: true
        }
    }
});

/***/ }),
/* 228 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "navbar",
    { attrs: { link: _vm.link, brand: _vm.brand, title: _vm.title } },
    [
      _c(
        "ul",
        {
          staticClass: "nav navbar-nav",
          attrs: { slot: "navbar-left" },
          slot: "navbar-left"
        },
        [
          _c("li", [
            _c("a", { attrs: { href: "" } }, [
              _c("i", { staticClass: "fa fa-globe" }),
              _vm._v(" Publish")
            ])
          ]),
          _vm._v(" "),
          _c(
            "li",
            {
              directives: [
                {
                  name: "show",
                  rawName: "v-show",
                  value: _vm.autosaveIcon == "show",
                  expression: "autosaveIcon == 'show'"
                }
              ]
            },
            [
              _c("a", [
                _vm._v(" saving "),
                _c("i", { staticClass: "fa fa-circle-o-notch fa-spin fa-fw" })
              ])
            ]
          )
        ]
      ),
      _vm._v(" "),
      _c("navbar-right", {
        attrs: { slot: "navbar-right", username: _vm.username },
        slot: "navbar-right"
      })
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-2a949d7f", module.exports)
  }
}

/***/ }),
/* 229 */,
/* 230 */,
/* 231 */,
/* 232 */,
/* 233 */,
/* 234 */,
/* 235 */,
/* 236 */,
/* 237 */,
/* 238 */,
/* 239 */,
/* 240 */,
/* 241 */,
/* 242 */,
/* 243 */,
/* 244 */,
/* 245 */,
/* 246 */,
/* 247 */,
/* 248 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(249)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(251)
/* template */
var __vue_template__ = __webpack_require__(252)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = injectStyle
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/assets/js/components/buttons/ButtonApp.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-21d8b2da", Component.options)
  } else {
    hotAPI.reload("data-v-21d8b2da", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 249 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(250);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("4457e3bc", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21d8b2da\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ButtonApp.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-21d8b2da\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ButtonApp.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 250 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\nbutton {\n    overflow: hidden;\n    outline: none;\n    /*display: block;*/\n    -webkit-user-select: none;\n       -moz-user-select: none;\n        -ms-user-select: none;\n            user-select: none;\n    position: relative;\n    overflow: hidden;\n}\n.circle {\n    /*display: block; */\n    position: absolute;\n    background: rgba(0,0,0,.075);\n    border-radius: 50%;\n    -webkit-transform: scale(0);\n            transform: scale(0);\n}\n.circle.animate {\n    -webkit-animation: effect 0.65s linear;\n            animation: effect 0.65s linear;\n}\n@-webkit-keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n@keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n/* end click effect */\nbutton:focus {\n    outline: none !important;\n}\n.btn-app {\n\n    border-radius: 2px;\n    border: 0;\n    -webkit-transition: .2s ease-out;\n    transition: .2s ease-out;\n    color: #fff;\n    margin-bottom: 10px;\n\n    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    -webkit-transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n    transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n}\n.btn-app:hover {\n    color: #616161 !important;\n\n    -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n    box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n\n    -webkit-transition: color .3s ease-out;\n    transition: color .3s ease-out;\n}\n.btn-app:active, .btn-app:focus, .btn-app.active {\n    outline: 0;\n}\n\n/*draft*/\n.btn-app-draft {\n    color: #636b6f !important;\n    background: #f5f5f5 !important;\n}\n.btn-app-draft:hover, .btn-app-draft:focus {\n    color: #fff !important;\n    background: #eee !important;\n}\n.btn-app-draft.active {\n    color: #fff !important;\n    background: #eee !important;\n}\n\n/*Default*/\n.btn-app-default {\n    color: #fff !important;\n    background: #2BBBAD !important;\n}\n.btn-app-default:hover, .btn-app-default:focus {\n    background: #30cfc0 !important;\n}\n.btn-app-default.active {\n    background: #186860 !important;\n}\n\n/*Primary*/\n.btn-app-primary {\n    background: #4285F4 !important;\n}\n.btn-app-primary:hover, .btn-app-primary:focus {\n    background-color: #5a95f5 !important;\n}\n.btn-app-primary.active {\n    background-color: #0b51c5 !important;\n}\n\n/*Secondary*/\n.btn-app-secondary {\n    background-color: #aa66cc !important;\n}\n.btn-app-secondary:hover, .btn-app-secondary:focus {\n    background-color: #b579d2 !important;\n    color: #fff;\n}\n.btn-app-secondary.active {\n    background-color: #773399 !important;\n}\n.btn-app-secondary.active:hover {\n    color: #fff;\n}\n\n/*Success*/\n.btn-app-success {\n    background: #00C851;\n}\n.btn-app-success:hover, .btn-app-success:focus {\n    background-color: #00d255 !important;\n}\n.btn-app-success.active {\n    background-color: #006228 !important;\n}\n\n/*Info*/\n.btn-app-info {\n    background: #33b5e5;\n}\n.btn-app-info:hover, .btn-app-info:focus {\n    background-color: #4abde8 !important;\n}\n.btn-app-info.active {\n    background-color: #14799e !important;\n}\n\n/*Warning*/\n.btn-app-warning {\n    background: #FF8800;\n}\n.btn-app-warning:hover, .btn-app-warning:focus {\n    background-color: #ff961f !important;\n}\n.btn-app-warning.active {\n    background-color: #cc8800 !important;\n}\n\n/*Danger*/\n.btn-app-danger {\n    background: #CC0000;\n}\n.btn-app-danger:hover, .btn-app-danger:focus {\n    background-color: #db0000 !important;\n}\n.btn-app-danger.active {\n    background-color: maroon !important;\n}\n\n/*Link*/\n.btn-app-link {\n    background-color: transparent;\n    color: #000;\n}\n.btn-app-link:hover, .btn-app-link:focus {\n    background-color: transparent;\n    color: #000;\n}\n", ""]);

// exports


/***/ }),
/* 251 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        action: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        status: {
            type: String,
            required: true
        },
        size: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            style: "btn-app btn-app-",
            id: ''
        };
    },
    mounted: function mounted() {
        this.id = Date.now() + '-' + this.action;
    },

    methods: {
        click: function click(e) {
            EventBus.$emit(this.action);

            var element, circle, d, x, y;

            element = $('#' + this.id);

            if (element.find(".circle").length == 0) element.prepend("<span class='circle'></span>");

            circle = element.find(".circle");
            circle.removeClass("animate");

            if (!circle.height() && !circle.width()) {
                d = Math.max(element.outerWidth(), element.outerHeight());
                circle.css({ height: d, width: d });
            }

            x = e.pageX - element.offset().left - circle.width() / 2;
            y = e.pageY - element.offset().top - circle.height() / 2;

            circle.css({ top: y + 'px', left: x + 'px' }).addClass("animate");
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 252 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("button", {
    class:
      _vm.style +
      _vm.status +
      (_vm.size == undefined ? "" : " btn-" + _vm.size),
    attrs: { id: _vm.id },
    domProps: { innerHTML: _vm._s(_vm.label) },
    on: { click: _vm.click }
  })
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-21d8b2da", module.exports)
  }
}

/***/ })
],[188]);