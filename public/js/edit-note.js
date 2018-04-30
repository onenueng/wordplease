webpackJsonp([1],[
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

var listToStyles = __webpack_require__(11)

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

/* WEBPACK VAR INJECTION */(function(__webpack_provided_window_dot_jQuery) {window._ = __webpack_require__(29);

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
__webpack_require__(30);
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = __webpack_require__(31);

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

window.Vue = __webpack_require__(32);

__webpack_require__(6);
window.flatpickr = __webpack_require__(33); // const flatpickr = require("flatpickr");

window.autosize = __webpack_require__(34);

__webpack_require__(35); // need change to min

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
exports.push([module.i, ".flatpickr-calendar {\n  background: transparent;\n  opacity: 0;\n  display: none;\n  text-align: center;\n  visibility: hidden;\n  padding: 0;\n  -webkit-animation: none;\n          animation: none;\n  direction: ltr;\n  border: 0;\n  font-size: 14px;\n  line-height: 24px;\n  border-radius: 5px;\n  position: absolute;\n  width: 307.875px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  -ms-touch-action: manipulation;\n      touch-action: manipulation;\n  background: rgba(63,68,88,0.98);\n  -webkit-box-shadow: 1px 0 0 #3f4458, -1px 0 0 #3f4458, 0 1px 0 #3f4458, 0 -1px 0 #3f4458, 0 3px 13px rgba(0,0,0,0.08);\n          box-shadow: 1px 0 0 #3f4458, -1px 0 0 #3f4458, 0 1px 0 #3f4458, 0 -1px 0 #3f4458, 0 3px 13px rgba(0,0,0,0.08);\n}\n.flatpickr-calendar.open,\n.flatpickr-calendar.inline {\n  opacity: 1;\n  max-height: 640px;\n  visibility: visible;\n}\n.flatpickr-calendar.open {\n  display: inline-block;\n  z-index: 99999;\n}\n.flatpickr-calendar.animate.open {\n  -webkit-animation: fpFadeInDown 300ms cubic-bezier(0.23, 1, 0.32, 1);\n          animation: fpFadeInDown 300ms cubic-bezier(0.23, 1, 0.32, 1);\n}\n.flatpickr-calendar.inline {\n  display: block;\n  position: relative;\n  top: 2px;\n}\n.flatpickr-calendar.static {\n  position: absolute;\n  top: calc(100% + 2px);\n}\n.flatpickr-calendar.static.open {\n  z-index: 999;\n  display: block;\n}\n.flatpickr-calendar.multiMonth .flatpickr-days .dayContainer:nth-child(n+1) .flatpickr-day.inRange:nth-child(7n+7) {\n  -webkit-box-shadow: none !important;\n          box-shadow: none !important;\n}\n.flatpickr-calendar.multiMonth .flatpickr-days .dayContainer:nth-child(n+2) .flatpickr-day.inRange:nth-child(7n+1) {\n  -webkit-box-shadow: -2px 0 0 #e6e6e6, 5px 0 0 #e6e6e6;\n          box-shadow: -2px 0 0 #e6e6e6, 5px 0 0 #e6e6e6;\n}\n.flatpickr-calendar .hasWeeks .dayContainer,\n.flatpickr-calendar .hasTime .dayContainer {\n  border-bottom: 0;\n  border-bottom-right-radius: 0;\n  border-bottom-left-radius: 0;\n}\n.flatpickr-calendar .hasWeeks .dayContainer {\n  border-left: 0;\n}\n.flatpickr-calendar.showTimeInput.hasTime .flatpickr-time {\n  height: 40px;\n  border-top: 1px solid #3f4458;\n}\n.flatpickr-calendar.noCalendar.hasTime .flatpickr-time {\n  height: auto;\n}\n.flatpickr-calendar:before,\n.flatpickr-calendar:after {\n  position: absolute;\n  display: block;\n  pointer-events: none;\n  border: solid transparent;\n  content: '';\n  height: 0;\n  width: 0;\n  left: 22px;\n}\n.flatpickr-calendar.rightMost:before,\n.flatpickr-calendar.rightMost:after {\n  left: auto;\n  right: 22px;\n}\n.flatpickr-calendar:before {\n  border-width: 5px;\n  margin: 0 -5px;\n}\n.flatpickr-calendar:after {\n  border-width: 4px;\n  margin: 0 -4px;\n}\n.flatpickr-calendar.arrowTop:before,\n.flatpickr-calendar.arrowTop:after {\n  bottom: 100%;\n}\n.flatpickr-calendar.arrowTop:before {\n  border-bottom-color: #3f4458;\n}\n.flatpickr-calendar.arrowTop:after {\n  border-bottom-color: rgba(63,68,88,0.98);\n}\n.flatpickr-calendar.arrowBottom:before,\n.flatpickr-calendar.arrowBottom:after {\n  top: 100%;\n}\n.flatpickr-calendar.arrowBottom:before {\n  border-top-color: #3f4458;\n}\n.flatpickr-calendar.arrowBottom:after {\n  border-top-color: rgba(63,68,88,0.98);\n}\n.flatpickr-calendar:focus {\n  outline: 0;\n}\n.flatpickr-wrapper {\n  position: relative;\n  display: inline-block;\n}\n.flatpickr-months {\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n}\n.flatpickr-months .flatpickr-month {\n  background: transparent;\n  color: #fff;\n  fill: #fff;\n  height: 28px;\n  line-height: 1;\n  text-align: center;\n  position: relative;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n  overflow: hidden;\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n}\n.flatpickr-months .flatpickr-prev-month,\n.flatpickr-months .flatpickr-next-month {\n  text-decoration: none;\n  cursor: pointer;\n  position: absolute;\n  top: 0px;\n  line-height: 16px;\n  height: 28px;\n  padding: 10px;\n  z-index: 3;\n}\n.flatpickr-months .flatpickr-prev-month.disabled,\n.flatpickr-months .flatpickr-next-month.disabled {\n  display: none;\n}\n.flatpickr-months .flatpickr-prev-month i,\n.flatpickr-months .flatpickr-next-month i {\n  position: relative;\n}\n.flatpickr-months .flatpickr-prev-month.flatpickr-prev-month,\n.flatpickr-months .flatpickr-next-month.flatpickr-prev-month {\n/*\n      /*rtl:begin:ignore*/\n/*\n      */\n  left: 0;\n/*\n      /*rtl:end:ignore*/\n/*\n      */\n}\n/*\n      /*rtl:begin:ignore*/\n/*\n      /*rtl:end:ignore*/\n.flatpickr-months .flatpickr-prev-month.flatpickr-next-month,\n.flatpickr-months .flatpickr-next-month.flatpickr-next-month {\n/*\n      /*rtl:begin:ignore*/\n/*\n      */\n  right: 0;\n/*\n      /*rtl:end:ignore*/\n/*\n      */\n}\n/*\n      /*rtl:begin:ignore*/\n/*\n      /*rtl:end:ignore*/\n.flatpickr-months .flatpickr-prev-month:hover,\n.flatpickr-months .flatpickr-next-month:hover {\n  color: #eee;\n}\n.flatpickr-months .flatpickr-prev-month:hover svg,\n.flatpickr-months .flatpickr-next-month:hover svg {\n  fill: #f64747;\n}\n.flatpickr-months .flatpickr-prev-month svg,\n.flatpickr-months .flatpickr-next-month svg {\n  width: 14px;\n  height: 14px;\n}\n.flatpickr-months .flatpickr-prev-month svg path,\n.flatpickr-months .flatpickr-next-month svg path {\n  -webkit-transition: fill 0.1s;\n  transition: fill 0.1s;\n  fill: inherit;\n}\n.numInputWrapper {\n  position: relative;\n  height: auto;\n}\n.numInputWrapper input,\n.numInputWrapper span {\n  display: inline-block;\n}\n.numInputWrapper input {\n  width: 100%;\n}\n.numInputWrapper input::-ms-clear {\n  display: none;\n}\n.numInputWrapper span {\n  position: absolute;\n  right: 0;\n  width: 14px;\n  padding: 0 4px 0 2px;\n  height: 50%;\n  line-height: 50%;\n  opacity: 0;\n  cursor: pointer;\n  border: 1px solid rgba(255,255,255,0.15);\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.numInputWrapper span:hover {\n  background: rgba(192,187,167,0.1);\n}\n.numInputWrapper span:active {\n  background: rgba(192,187,167,0.2);\n}\n.numInputWrapper span:after {\n  display: block;\n  content: \"\";\n  position: absolute;\n}\n.numInputWrapper span.arrowUp {\n  top: 0;\n  border-bottom: 0;\n}\n.numInputWrapper span.arrowUp:after {\n  border-left: 4px solid transparent;\n  border-right: 4px solid transparent;\n  border-bottom: 4px solid rgba(255,255,255,0.6);\n  top: 26%;\n}\n.numInputWrapper span.arrowDown {\n  top: 50%;\n}\n.numInputWrapper span.arrowDown:after {\n  border-left: 4px solid transparent;\n  border-right: 4px solid transparent;\n  border-top: 4px solid rgba(255,255,255,0.6);\n  top: 40%;\n}\n.numInputWrapper span svg {\n  width: inherit;\n  height: auto;\n}\n.numInputWrapper span svg path {\n  fill: rgba(255,255,255,0.5);\n}\n.numInputWrapper:hover {\n  background: rgba(192,187,167,0.05);\n}\n.numInputWrapper:hover span {\n  opacity: 1;\n}\n.flatpickr-current-month {\n  font-size: 135%;\n  line-height: inherit;\n  font-weight: 300;\n  color: inherit;\n  position: absolute;\n  width: 75%;\n  left: 12.5%;\n  padding: 6.16px 0 0 0;\n  line-height: 1;\n  height: 28px;\n  display: inline-block;\n  text-align: center;\n  -webkit-transform: translate3d(0px, 0px, 0px);\n          transform: translate3d(0px, 0px, 0px);\n}\n.flatpickr-current-month span.cur-month {\n  font-family: inherit;\n  font-weight: 700;\n  color: inherit;\n  display: inline-block;\n  margin-left: 0.5ch;\n  padding: 0;\n}\n.flatpickr-current-month span.cur-month:hover {\n  background: rgba(192,187,167,0.05);\n}\n.flatpickr-current-month .numInputWrapper {\n  width: 6ch;\n  width: 7ch\\0;\n  display: inline-block;\n}\n.flatpickr-current-month .numInputWrapper span.arrowUp:after {\n  border-bottom-color: #fff;\n}\n.flatpickr-current-month .numInputWrapper span.arrowDown:after {\n  border-top-color: #fff;\n}\n.flatpickr-current-month input.cur-year {\n  background: transparent;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  color: inherit;\n  cursor: text;\n  padding: 0 0 0 0.5ch;\n  margin: 0;\n  display: inline-block;\n  font-size: inherit;\n  font-family: inherit;\n  font-weight: 300;\n  line-height: inherit;\n  height: auto;\n  border: 0;\n  border-radius: 0;\n  vertical-align: initial;\n}\n.flatpickr-current-month input.cur-year:focus {\n  outline: 0;\n}\n.flatpickr-current-month input.cur-year[disabled],\n.flatpickr-current-month input.cur-year[disabled]:hover {\n  font-size: 100%;\n  color: rgba(255,255,255,0.5);\n  background: transparent;\n  pointer-events: none;\n}\n.flatpickr-weekdays {\n  background: transparent;\n  text-align: center;\n  overflow: hidden;\n  width: 100%;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-align: center;\n  -webkit-align-items: center;\n      -ms-flex-align: center;\n          align-items: center;\n  height: 28px;\n}\n.flatpickr-weekdays .flatpickr-weekdaycontainer {\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n}\nspan.flatpickr-weekday {\n  cursor: default;\n  font-size: 90%;\n  background: transparent;\n  color: #fff;\n  line-height: 1;\n  margin: 0;\n  text-align: center;\n  display: block;\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n  font-weight: bolder;\n}\n.dayContainer,\n.flatpickr-weeks {\n  padding: 1px 0 0 0;\n}\n.flatpickr-days {\n  position: relative;\n  overflow: hidden;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-align: start;\n  -webkit-align-items: flex-start;\n      -ms-flex-align: start;\n          align-items: flex-start;\n  width: 307.875px;\n}\n.flatpickr-days:focus {\n  outline: 0;\n}\n.dayContainer {\n  padding: 0;\n  outline: 0;\n  text-align: left;\n  width: 307.875px;\n  min-width: 307.875px;\n  max-width: 307.875px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  display: inline-block;\n  display: -ms-flexbox;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: flex;\n  -webkit-flex-wrap: wrap;\n          flex-wrap: wrap;\n  -ms-flex-wrap: wrap;\n  -ms-flex-pack: justify;\n  -webkit-justify-content: space-around;\n          justify-content: space-around;\n  -webkit-transform: translate3d(0px, 0px, 0px);\n          transform: translate3d(0px, 0px, 0px);\n  opacity: 1;\n}\n.dayContainer + .dayContainer {\n  -webkit-box-shadow: -1px 0 0 #3f4458;\n          box-shadow: -1px 0 0 #3f4458;\n}\n.flatpickr-day {\n  background: none;\n  border: 1px solid transparent;\n  border-radius: 150px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  color: rgba(255,255,255,0.95);\n  cursor: pointer;\n  font-weight: 400;\n  width: 14.2857143%;\n  -webkit-flex-basis: 14.2857143%;\n      -ms-flex-preferred-size: 14.2857143%;\n          flex-basis: 14.2857143%;\n  max-width: 39px;\n  height: 39px;\n  line-height: 39px;\n  margin: 0;\n  display: inline-block;\n  position: relative;\n  -webkit-box-pack: center;\n  -webkit-justify-content: center;\n      -ms-flex-pack: center;\n          justify-content: center;\n  text-align: center;\n}\n.flatpickr-day.inRange,\n.flatpickr-day.prevMonthDay.inRange,\n.flatpickr-day.nextMonthDay.inRange,\n.flatpickr-day.today.inRange,\n.flatpickr-day.prevMonthDay.today.inRange,\n.flatpickr-day.nextMonthDay.today.inRange,\n.flatpickr-day:hover,\n.flatpickr-day.prevMonthDay:hover,\n.flatpickr-day.nextMonthDay:hover,\n.flatpickr-day:focus,\n.flatpickr-day.prevMonthDay:focus,\n.flatpickr-day.nextMonthDay:focus {\n  cursor: pointer;\n  outline: 0;\n  background: rgba(100,108,140,0.98);\n  border-color: rgba(100,108,140,0.98);\n}\n.flatpickr-day.today {\n  border-color: #eee;\n}\n.flatpickr-day.today:hover,\n.flatpickr-day.today:focus {\n  border-color: #eee;\n  background: #eee;\n  color: #3f4458;\n}\n.flatpickr-day.selected,\n.flatpickr-day.startRange,\n.flatpickr-day.endRange,\n.flatpickr-day.selected.inRange,\n.flatpickr-day.startRange.inRange,\n.flatpickr-day.endRange.inRange,\n.flatpickr-day.selected:focus,\n.flatpickr-day.startRange:focus,\n.flatpickr-day.endRange:focus,\n.flatpickr-day.selected:hover,\n.flatpickr-day.startRange:hover,\n.flatpickr-day.endRange:hover,\n.flatpickr-day.selected.prevMonthDay,\n.flatpickr-day.startRange.prevMonthDay,\n.flatpickr-day.endRange.prevMonthDay,\n.flatpickr-day.selected.nextMonthDay,\n.flatpickr-day.startRange.nextMonthDay,\n.flatpickr-day.endRange.nextMonthDay {\n  background: #80cbc4;\n  -webkit-box-shadow: none;\n          box-shadow: none;\n  color: #fff;\n  border-color: #80cbc4;\n}\n.flatpickr-day.selected.startRange,\n.flatpickr-day.startRange.startRange,\n.flatpickr-day.endRange.startRange {\n  border-radius: 50px 0 0 50px;\n}\n.flatpickr-day.selected.endRange,\n.flatpickr-day.startRange.endRange,\n.flatpickr-day.endRange.endRange {\n  border-radius: 0 50px 50px 0;\n}\n.flatpickr-day.selected.startRange + .endRange,\n.flatpickr-day.startRange.startRange + .endRange,\n.flatpickr-day.endRange.startRange + .endRange {\n  -webkit-box-shadow: -10px 0 0 #80cbc4;\n          box-shadow: -10px 0 0 #80cbc4;\n}\n.flatpickr-day.selected.startRange.endRange,\n.flatpickr-day.startRange.startRange.endRange,\n.flatpickr-day.endRange.startRange.endRange {\n  border-radius: 50px;\n}\n.flatpickr-day.inRange {\n  border-radius: 0;\n  -webkit-box-shadow: -5px 0 0 rgba(100,108,140,0.98), 5px 0 0 rgba(100,108,140,0.98);\n          box-shadow: -5px 0 0 rgba(100,108,140,0.98), 5px 0 0 rgba(100,108,140,0.98);\n}\n.flatpickr-day.disabled,\n.flatpickr-day.disabled:hover,\n.flatpickr-day.prevMonthDay,\n.flatpickr-day.nextMonthDay,\n.flatpickr-day.notAllowed,\n.flatpickr-day.notAllowed.prevMonthDay,\n.flatpickr-day.notAllowed.nextMonthDay {\n  color: rgba(255,255,255,0.3);\n  background: transparent;\n  border-color: transparent;\n  cursor: default;\n}\n.flatpickr-day.disabled,\n.flatpickr-day.disabled:hover {\n  cursor: not-allowed;\n  color: rgba(255,255,255,0.1);\n}\n.flatpickr-day.week.selected {\n  border-radius: 0;\n  -webkit-box-shadow: -5px 0 0 #80cbc4, 5px 0 0 #80cbc4;\n          box-shadow: -5px 0 0 #80cbc4, 5px 0 0 #80cbc4;\n}\n.flatpickr-day.hidden {\n  visibility: hidden;\n}\n.rangeMode .flatpickr-day {\n  margin-top: 1px;\n}\n.flatpickr-weekwrapper {\n  display: inline-block;\n  float: left;\n}\n.flatpickr-weekwrapper .flatpickr-weeks {\n  padding: 0 12px;\n  -webkit-box-shadow: 1px 0 0 #3f4458;\n          box-shadow: 1px 0 0 #3f4458;\n}\n.flatpickr-weekwrapper .flatpickr-weekday {\n  float: none;\n  width: 100%;\n  line-height: 28px;\n}\n.flatpickr-weekwrapper span.flatpickr-day,\n.flatpickr-weekwrapper span.flatpickr-day:hover {\n  display: block;\n  width: 100%;\n  max-width: none;\n  color: rgba(255,255,255,0.3);\n  background: transparent;\n  cursor: default;\n  border: none;\n}\n.flatpickr-innerContainer {\n  display: block;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  overflow: hidden;\n}\n.flatpickr-rContainer {\n  display: inline-block;\n  padding: 0;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.flatpickr-time {\n  text-align: center;\n  outline: 0;\n  display: block;\n  height: 0;\n  line-height: 40px;\n  max-height: 40px;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n  overflow: hidden;\n  display: -webkit-box;\n  display: -webkit-flex;\n  display: -ms-flexbox;\n  display: flex;\n}\n.flatpickr-time:after {\n  content: \"\";\n  display: table;\n  clear: both;\n}\n.flatpickr-time .numInputWrapper {\n  -webkit-box-flex: 1;\n  -webkit-flex: 1;\n      -ms-flex: 1;\n          flex: 1;\n  width: 40%;\n  height: 40px;\n  float: left;\n}\n.flatpickr-time .numInputWrapper span.arrowUp:after {\n  border-bottom-color: rgba(255,255,255,0.95);\n}\n.flatpickr-time .numInputWrapper span.arrowDown:after {\n  border-top-color: rgba(255,255,255,0.95);\n}\n.flatpickr-time.hasSeconds .numInputWrapper {\n  width: 26%;\n}\n.flatpickr-time.time24hr .numInputWrapper {\n  width: 49%;\n}\n.flatpickr-time input {\n  background: transparent;\n  -webkit-box-shadow: none;\n          box-shadow: none;\n  border: 0;\n  border-radius: 0;\n  text-align: center;\n  margin: 0;\n  padding: 0;\n  height: inherit;\n  line-height: inherit;\n  cursor: pointer;\n  color: rgba(255,255,255,0.95);\n  font-size: 14px;\n  position: relative;\n  -webkit-box-sizing: border-box;\n          box-sizing: border-box;\n}\n.flatpickr-time input.flatpickr-hour {\n  font-weight: bold;\n}\n.flatpickr-time input.flatpickr-minute,\n.flatpickr-time input.flatpickr-second {\n  font-weight: 400;\n}\n.flatpickr-time input:focus {\n  outline: 0;\n  border: 0;\n}\n.flatpickr-time .flatpickr-time-separator,\n.flatpickr-time .flatpickr-am-pm {\n  height: inherit;\n  display: inline-block;\n  float: left;\n  line-height: inherit;\n  color: rgba(255,255,255,0.95);\n  font-weight: bold;\n  width: 2%;\n  -webkit-user-select: none;\n     -moz-user-select: none;\n      -ms-user-select: none;\n          user-select: none;\n  -webkit-align-self: center;\n      -ms-flex-item-align: center;\n          align-self: center;\n}\n.flatpickr-time .flatpickr-am-pm {\n  outline: 0;\n  width: 18%;\n  cursor: pointer;\n  text-align: center;\n  font-weight: 400;\n}\n.flatpickr-time .flatpickr-am-pm:hover,\n.flatpickr-time .flatpickr-am-pm:focus {\n  background: rgba(109,118,151,0.98);\n}\n.flatpickr-input[readonly] {\n  cursor: pointer;\n}\n@-webkit-keyframes fpFadeInDown {\n  from {\n    opacity: 0;\n    -webkit-transform: translate3d(0, -20px, 0);\n            transform: translate3d(0, -20px, 0);\n  }\n  to {\n    opacity: 1;\n    -webkit-transform: translate3d(0, 0, 0);\n            transform: translate3d(0, 0, 0);\n  }\n}\n@keyframes fpFadeInDown {\n  from {\n    opacity: 0;\n    -webkit-transform: translate3d(0, -20px, 0);\n            transform: translate3d(0, -20px, 0);\n  }\n  to {\n    opacity: 1;\n    -webkit-transform: translate3d(0, 0, 0);\n            transform: translate3d(0, 0, 0);\n  }\n}\n", ""]);

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
/* 10 */,
/* 11 */
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
/* 12 */,
/* 13 */,
/* 14 */,
/* 15 */,
/* 16 */,
/* 17 */,
/* 18 */,
/* 19 */,
/* 20 */,
/* 21 */,
/* 22 */,
/* 23 */,
/* 24 */,
/* 25 */,
/* 26 */,
/* 27 */,
/* 28 */,
/* 29 */,
/* 30 */,
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
  __webpack_require__(42)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(44)
/* template */
var __vue_template__ = __webpack_require__(45)
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
/* 37 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(38)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(40)
/* template */
var __vue_template__ = __webpack_require__(41)
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
/* 38 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(39);
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
/* 39 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.material-panel {\n    border: none;\n    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n            box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    -webkit-transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n    transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n}\n.material-panel:hover {\n    -webkit-box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 3px 6px rgba(0,0,0,0.22);\n            box-shadow: 0 3px 9px rgba(0,0,0,0.25), 0 3px 6px rgba(0,0,0,0.22);\n}\n.material-panel-heading {\n    border-radius: 4px 4px 0 0;\n    font-weight: 700;\n    border: none;\n    padding: 5px 22.5px;\n}\n.material-panel-body {\n    background-color: #fff;\n    padding: 10px 22.5px;\n}\n.material-panel-heading {\n    /*background-color: #eee;*/\n    /*color: #000;*/\n}\n", ""]);

// exports


/***/ }),
/* 40 */
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
/* 41 */
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
/* 42 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(43);
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
/* 43 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\nlabel.material-checkbox-group-label {\n    font-weight: normal !important;\n}\n.clear-padding {\n    padding-left: 0px!important;\n    margin-right: 5px!important;\n}\nlabel.underline-animate:hover {\n    font-style: italic;\n}\n.underline-animate:after {\n    content: '';\n    position: absolute;\n    bottom: 0;\n    left: 0;\n    width: 0%;\n    border-bottom: 3px solid #636b6f;\n    -webkit-transition: 0.4s;\n    transition: 0.4s;\n}\n.underline-animate:hover:after {\n    width: 100%;\n}\n.material-checkbox-group-label {\n    position: relative;\n    display: block;\n    cursor: pointer;\n    height: 15px;\n    line-height: 15px;\n    /*padding-left: 25px;*/\n    padding-left: 20px; /* between control and label */\n}\n.material-checkbox-group-label:after { /*check marker*/\n    content: \"\";\n    display: block;\n    /*width: 4px;*/\n    width: 3px;\n    /*height: 12px;*/\n    height: 9px;\n    opacity: .9;\n    border-right: 2px solid #eee;\n    border-top: 2px solid #eee;\n    position: absolute;\n    /*left: 4px;*/\n    left: 3px;\n    /*top: 12px;*/\n    top: 9px;\n    -webkit-transform: scaleX(-1) rotate(135deg);\n    transform: scaleX(-1) rotate(135deg);\n    -webkit-transform-origin: left top;\n    transform-origin: left top;\n}\n.material-checkbox-group-label:before {\n    content: \"\";\n    display: block;\n    border: 2px solid;\n    /*width: 20px;*/\n    width: 15px;\n    /*height: 20px;*/\n    height: 15px;\n    position: absolute;\n    left: 0;\n}\n.material-checkbox-group-label {\n    /*font-size: 14px;*/\n    -webkit-user-select: none;\n    -moz-user-select: none;\n    -ms-user-select: none;\n}\n.material-checkbox:disabled ~ .material-checkbox-group-label {\n    cursor: no-drop;\n}\n.material-checkbox {\n    display: none;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {\n    -webkit-animation: check 0.8s;\n    animation: check 0.8s;\n    opacity: 1;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #636b6f;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #eee;\n}\n.material-checkbox-group .material-checkbox-group-label:before {\n    border-color: #636b6f;\n}\n.material-checkbox:disabled ~ .material-checkbox-group-label {\n    color: #eee;\n}\n.material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #4092d9;\n}\n.material-checkbox-group_primary .material-checkbox-group-label:before {\n    border-color: #4092d9;\n}\n.material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #68c368;\n}\n.material-checkbox-group_success .material-checkbox-group-label:before {\n    border-color: #68c368;\n}\n.material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #8bdaf2;\n}\n.material-checkbox-group_info .material-checkbox-group-label:before {\n    border-color: #8bdaf2;\n}\n.material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #f2a12e;\n}\n.material-checkbox-group_warning .material-checkbox-group-label:before {\n    border-color: #f2a12e;\n}\n.material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #f3413c;\n}\n.material-checkbox-group_danger .material-checkbox-group-label:before {\n    border-color: #f3413c;\n}\n@-webkit-keyframes check {\n0% {\n        height: 0;\n        width: 0;\n}\n25% {\n        height: 0;\n        /*width: 4px;*/\n        width: 3px;\n}\n50% {\n        /*height: 12px;*/\n        height: 9px;\n        /*width: 4px;*/\n        width: 3px;\n}\n}\n@keyframes check {\n0% {\n        height: 0;\n        width: 0;\n}\n25% {\n        height: 0;\n        /*width: 4px;*/\n        width: 3px;\n}\n50% {\n        /*height: 12px;*/\n        height: 9px;\n        /*width: 4px;*/\n        width: 3px;\n}\n}\n", ""]);

// exports


/***/ }),
/* 44 */
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
            type: [String, Array],
            required: false
        },
        // event emit when checked/unchecked.
        setterEvent: {
            type: String,
            required: false
        },
        noSave: {
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

            this.checkValue = !this.checkValue;

            this.autosave();

            if (this.emitOnUpdate !== undefined) {
                this.emitEvents.forEach(function (event) {
                    EventBus.$emit(event, _this2.checkValue);
                });
            }
        },
        autosave: function autosave() {
            if (this.field !== undefined && this.noSave === undefined) {
                EventBus.$emit('autosave', this.field, this.checkValue);
            }
        }
    },
    computed: {
        emitEvents: function emitEvents() {
            if (typeof this.emitOnUpdate == 'string') {
                return this.emitOnUpdate.split(",");
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
/* 45 */
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
/* 46 */,
/* 47 */,
/* 48 */,
/* 49 */,
/* 50 */,
/* 51 */,
/* 52 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(53)
/* template */
var __vue_template__ = __webpack_require__(54)
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
Component.options.__file = "resources/assets/js/components/InputText.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-2bcdf870", Component.options)
  } else {
    hotAPI.reload("data-v-2bcdf870", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 53 */
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
            inputClass: 'form-control'
        };
    },
    mounted: function mounted() {
        var _this = this;

        // init label tooltip if available.
        if (this.labelDescription !== undefined) {
            $('a[title="' + this.labelDescription + '"]').tooltip();
        }

        if (this.needSync !== undefined) {
            console.log(this.field + ' need sync');
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
/* 54 */
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
            { staticClass: "control-label", attrs: { for: _vm.field } },
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
    require("vue-hot-reload-api")      .rerender("data-v-2bcdf870", module.exports)
  }
}

/***/ }),
/* 55 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(56)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(58)
/* template */
var __vue_template__ = __webpack_require__(61)
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
Component.options.__file = "resources/assets/js/components/inputs/InputRows.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-185c3f94", Component.options)
  } else {
    hotAPI.reload("data-v-185c3f94", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 56 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(57);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("7d4122fa", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-185c3f94\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRows.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-185c3f94\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRows.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 57 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.drag-icon {\n    cursor: move;\n    cursor: -webkit-grabbing;\n}\n.overFlow {\n    background:#d9534f;\n}\n.duplicate {\n    background:#f0ad4e;\n}\n", ""]);

// exports


/***/ }),
/* 58 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuedraggable__ = __webpack_require__(59);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_vuedraggable___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_vuedraggable__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        draggable: __WEBPACK_IMPORTED_MODULE_0_vuedraggable___default.a
    },
    props: {
        field: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: false
        },
        groupName: {
            type: String,
            required: false,
            default: this.field
        },
        groupAllowDuplicate: {
            type: Boolean,
            required: false,
            default: false
        },
        rowLimit: {
            type: Number,
            required: false,
            default: 1
        },
        items: {
            type: Array,
            required: false,
            default: function _default() {
                return [{ value: null, duplicate: false }];
            }
        }
    },
    data: function data() {
        return {
            currentRow: 0,
            list: this.items.length == 0 ? [{ value: null, duplicate: false }] : this.initList(),
            draggableOptions: {
                handle: '.drag-icon',
                group: this.groupName
            },
            groupCheckDuplicateValue: null,
            lastSaveList: [],
            updatedFiredFromDeleted: false
        };
    },

    computed: {
        hasSiblings: function hasSiblings() {
            return !this.groupAllowDuplicate && this.groupName != this.field;
        },
        isThereDuplicate: function isThereDuplicate() {
            var duplicated = false;
            this.list.forEach(function (item) {
                duplicated = duplicated && item.duplicate;
            });
            return duplicated;
        }
    },
    mounted: function mounted() {
        var _this = this;

        this.onKeyPressed = _.debounce(function () {
            _this.autosave();
        }, 5000);

        EventBus.$on('add-' + this.field, function () {
            _this.onEnterKeyPressed();
        });

        EventBus.$on('delete-' + this.field, function (index) {
            _this.updatedFiredFromDeleted = true;
            _this.list.splice(index, 1);
            _this.autosave();
        });

        this.list.forEach(function (item) {
            _this.lastSaveList.push({ value: item.value, duplicate: item.duplicate });
        });

        if (this.hasSiblings) {
            EventBus.$on(this.groupName + '-check-duplicate', function (field, value) {
                var isDelete = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : false;

                if (_this.field != field) {
                    _this.groupCheckDuplicateValue = value;
                    _this.list.forEach(function (item) {
                        item.duplicate = item.value == value;
                        if (item.duplicate) {
                            _this.onKeyPressed();
                        }
                    });
                    // if ( !isDelete ) {
                    //     this.groupCheckDuplicateValue = value
                    //     this.list.forEach((item, index) => {
                    //         item.duplicate = (item.value == value)
                    //         if ( item.duplicate ) {
                    //             this.onKeyPressed()
                    //         }
                    //     })
                    // } else {
                    //     if ( this.groupCheckDuplicateValue == value ) {
                    //         this.groupCheckDuplicateValue = null
                    //         value = null
                    //     }
                    //     this.list.forEach((item) => {
                    //         item.duplicate = (item.value == value)
                    //         if ( item.duplicate ) {
                    //             this.onKeyPressed()
                    //         }
                    //     })
                    // }
                }
            });
        }
    },
    updated: function updated() {
        var _this2 = this;

        if (!this.updatedFiredFromDeleted) {
            this.list.forEach(function (item, index) {
                if (item.value != null && item.value != '') {
                    item.duplicate = _this2.isDuplicate(index, item.value) || item.value == _this2.groupCheckDuplicateValue;
                }
                autosize(document.getElementById(_this2.field + '-' + (index + 1)));
                autosize.update(document.getElementById(_this2.field + '-' + (index + 1)));
            });

            var value = this.list[this.currentRow].value;
            if (this.hasSiblings && value != '' && value != null) {
                EventBus.$emit(this.groupName + '-check-duplicate', this.field, value);
            }
        } else {
            this.updatedFiredFromDeleted = false;
        }

        // console.log(this.field + ' => ' + this.groupCheckDuplicateValue)
    },

    methods: {
        initList: function initList() {
            var newList = [];
            this.items.forEach(function (item) {
                newList.push({ value: item.value, duplicate: false });
            });
            return newList;
        },
        isDuplicate: function isDuplicate(index, value) {
            var rowCount = this.list.length;
            for (var i = 0; i < rowCount; i++) {
                if (i != index && this.list[i].value == value) {
                    return true;
                }
            }
            return false;
        },
        onEnterKeyPressed: function onEnterKeyPressed() {
            var _this3 = this;

            if (this.list.length < this.rowLimit) {
                this.list.push({ value: null, duplicate: false });
                setTimeout(function () {
                    document.getElementById(_this3.field + '-' + _this3.list.length).focus();
                }, 100);
            }
        },
        onDownKeyPressed: function onDownKeyPressed() {
            if (this.currentRow + 1 < this.list.length) {
                document.getElementById(this.field + '-' + (this.currentRow + 2)).focus();
            }
        },
        onUpKeyPressed: function onUpKeyPressed() {
            if (this.currentRow != 0) {
                document.getElementById(this.field + '-' + this.currentRow).focus();
            }
        },
        onKeyPressed: function onKeyPressed() {
            // defined on mounted
        },
        autosave: function autosave() {
            var newList = void 0;
            if (this.list.length > this.rowLimit) {
                newList = this.list.slice(0, this.rowLimit);
            } else {
                newList = this.list.slice();
            }

            var listCount = newList.length;
            for (var index = 0; index < listCount; index++) {
                if (newList[index] !== undefined && newList[index].duplicate) {
                    newList.splice(index, 1);
                }
            }

            EventBus.$emit('autosave', this.field, newList);
            // if ( this.dirtyList(newList) ) {
            //     EventBus.$emit('autosave', this.field, newList)
            //     this.lastSaveList = []
            //     newList.forEach((item) => {
            //         this.lastSaveList.push({ value: item.value, duplicate: false })
            //     })
            // }
        },
        dirtyList: function dirtyList(list) {
            if (this.lastSaveList.length != list.length) {
                return true;
            }

            var lastSaveListCount = this.lastSaveList.length;
            for (var index = 0; index < lastSaveListCount; index++) {
                if (list[index].value != this.lastSaveList[index].value) {
                    return true;
                }
            }
            return false;
        }
    }
});

/***/ }),
/* 59 */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

function _toConsumableArray(arr) { if (Array.isArray(arr)) { for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) { arr2[i] = arr[i]; } return arr2; } else { return Array.from(arr); } }

(function () {
  "use strict";

  if (!Array.from) {
    Array.from = function (object) {
      return [].slice.call(object);
    };
  }

  function buildAttribute(object, propName, value) {
    if (value == undefined) {
      return object;
    }
    object = object == null ? {} : object;
    object[propName] = value;
    return object;
  }

  function buildDraggable(Sortable) {
    function removeNode(node) {
      node.parentElement.removeChild(node);
    }

    function insertNodeAt(fatherNode, node, position) {
      var refNode = position === 0 ? fatherNode.children[0] : fatherNode.children[position - 1].nextSibling;
      fatherNode.insertBefore(node, refNode);
    }

    function computeVmIndex(vnodes, element) {
      return vnodes.map(function (elt) {
        return elt.elm;
      }).indexOf(element);
    }

    function _computeIndexes(slots, children, isTransition) {
      if (!slots) {
        return [];
      }

      var elmFromNodes = slots.map(function (elt) {
        return elt.elm;
      });
      var rawIndexes = [].concat(_toConsumableArray(children)).map(function (elt) {
        return elmFromNodes.indexOf(elt);
      });
      return isTransition ? rawIndexes.filter(function (ind) {
        return ind !== -1;
      }) : rawIndexes;
    }

    function emit(evtName, evtData) {
      var _this = this;

      this.$nextTick(function () {
        return _this.$emit(evtName.toLowerCase(), evtData);
      });
    }

    function delegateAndEmit(evtName) {
      var _this2 = this;

      return function (evtData) {
        if (_this2.realList !== null) {
          _this2['onDrag' + evtName](evtData);
        }
        emit.call(_this2, evtName, evtData);
      };
    }

    var eventsListened = ['Start', 'Add', 'Remove', 'Update', 'End'];
    var eventsToEmit = ['Choose', 'Sort', 'Filter', 'Clone'];
    var readonlyProperties = ['Move'].concat(eventsListened, eventsToEmit).map(function (evt) {
      return 'on' + evt;
    });
    var draggingElement = null;

    var props = {
      options: Object,
      list: {
        type: Array,
        required: false,
        default: null
      },
      value: {
        type: Array,
        required: false,
        default: null
      },
      noTransitionOnDrag: {
        type: Boolean,
        default: false
      },
      clone: {
        type: Function,
        default: function _default(original) {
          return original;
        }
      },
      element: {
        type: String,
        default: 'div'
      },
      move: {
        type: Function,
        default: null
      },
      componentData: {
        type: Object,
        required: false,
        default: null
      }
    };

    var draggableComponent = {
      name: 'draggable',

      props: props,

      data: function data() {
        return {
          transitionMode: false,
          noneFunctionalComponentMode: false,
          init: false
        };
      },
      render: function render(h) {
        var slots = this.$slots.default;
        if (slots && slots.length === 1) {
          var child = slots[0];
          if (child.componentOptions && child.componentOptions.tag === "transition-group") {
            this.transitionMode = true;
          }
        }
        var children = slots;
        var footer = this.$slots.footer;

        if (footer) {
          children = slots ? [].concat(_toConsumableArray(slots), _toConsumableArray(footer)) : [].concat(_toConsumableArray(footer));
        }
        var attributes = null;
        var update = function update(name, value) {
          attributes = buildAttribute(attributes, name, value);
        };
        update('attrs', this.$attrs);
        if (this.componentData) {
          var _componentData = this.componentData,
              on = _componentData.on,
              _props = _componentData.props;

          update('on', on);
          update('props', _props);
        }
        return h(this.element, attributes, children);
      },
      mounted: function mounted() {
        var _this3 = this;

        this.noneFunctionalComponentMode = this.element.toLowerCase() !== this.$el.nodeName.toLowerCase();
        if (this.noneFunctionalComponentMode && this.transitionMode) {
          throw new Error('Transition-group inside component is not supported. Please alter element value or remove transition-group. Current element value: ' + this.element);
        }
        var optionsAdded = {};
        eventsListened.forEach(function (elt) {
          optionsAdded['on' + elt] = delegateAndEmit.call(_this3, elt);
        });

        eventsToEmit.forEach(function (elt) {
          optionsAdded['on' + elt] = emit.bind(_this3, elt);
        });

        var options = _extends({}, this.options, optionsAdded, { onMove: function onMove(evt, originalEvent) {
            return _this3.onDragMove(evt, originalEvent);
          } });
        !('draggable' in options) && (options.draggable = '>*');
        this._sortable = new Sortable(this.rootContainer, options);
        this.computeIndexes();
      },
      beforeDestroy: function beforeDestroy() {
        this._sortable.destroy();
      },


      computed: {
        rootContainer: function rootContainer() {
          return this.transitionMode ? this.$el.children[0] : this.$el;
        },
        isCloning: function isCloning() {
          return !!this.options && !!this.options.group && this.options.group.pull === 'clone';
        },
        realList: function realList() {
          return !!this.list ? this.list : this.value;
        }
      },

      watch: {
        options: {
          handler: function handler(newOptionValue) {
            for (var property in newOptionValue) {
              if (readonlyProperties.indexOf(property) == -1) {
                this._sortable.option(property, newOptionValue[property]);
              }
            }
          },

          deep: true
        },

        realList: function realList() {
          this.computeIndexes();
        }
      },

      methods: {
        getChildrenNodes: function getChildrenNodes() {
          if (!this.init) {
            this.noneFunctionalComponentMode = this.noneFunctionalComponentMode && this.$children.length == 1;
            this.init = true;
          }

          if (this.noneFunctionalComponentMode) {
            return this.$children[0].$slots.default;
          }
          var rawNodes = this.$slots.default;
          return this.transitionMode ? rawNodes[0].child.$slots.default : rawNodes;
        },
        computeIndexes: function computeIndexes() {
          var _this4 = this;

          this.$nextTick(function () {
            _this4.visibleIndexes = _computeIndexes(_this4.getChildrenNodes(), _this4.rootContainer.children, _this4.transitionMode);
          });
        },
        getUnderlyingVm: function getUnderlyingVm(htmlElt) {
          var index = computeVmIndex(this.getChildrenNodes() || [], htmlElt);
          if (index === -1) {
            //Edge case during move callback: related element might be
            //an element different from collection
            return null;
          }
          var element = this.realList[index];
          return { index: index, element: element };
        },
        getUnderlyingPotencialDraggableComponent: function getUnderlyingPotencialDraggableComponent(_ref) {
          var __vue__ = _ref.__vue__;

          if (!__vue__ || !__vue__.$options || __vue__.$options._componentTag !== "transition-group") {
            return __vue__;
          }
          return __vue__.$parent;
        },
        emitChanges: function emitChanges(evt) {
          var _this5 = this;

          this.$nextTick(function () {
            _this5.$emit('change', evt);
          });
        },
        alterList: function alterList(onList) {
          if (!!this.list) {
            onList(this.list);
          } else {
            var newList = [].concat(_toConsumableArray(this.value));
            onList(newList);
            this.$emit('input', newList);
          }
        },
        spliceList: function spliceList() {
          var _arguments = arguments;

          var spliceList = function spliceList(list) {
            return list.splice.apply(list, _arguments);
          };
          this.alterList(spliceList);
        },
        updatePosition: function updatePosition(oldIndex, newIndex) {
          var updatePosition = function updatePosition(list) {
            return list.splice(newIndex, 0, list.splice(oldIndex, 1)[0]);
          };
          this.alterList(updatePosition);
        },
        getRelatedContextFromMoveEvent: function getRelatedContextFromMoveEvent(_ref2) {
          var to = _ref2.to,
              related = _ref2.related;

          var component = this.getUnderlyingPotencialDraggableComponent(to);
          if (!component) {
            return { component: component };
          }
          var list = component.realList;
          var context = { list: list, component: component };
          if (to !== related && list && component.getUnderlyingVm) {
            var destination = component.getUnderlyingVm(related);
            if (destination) {
              return _extends(destination, context);
            }
          }

          return context;
        },
        getVmIndex: function getVmIndex(domIndex) {
          var indexes = this.visibleIndexes;
          var numberIndexes = indexes.length;
          return domIndex > numberIndexes - 1 ? numberIndexes : indexes[domIndex];
        },
        getComponent: function getComponent() {
          return this.$slots.default[0].componentInstance;
        },
        resetTransitionData: function resetTransitionData(index) {
          if (!this.noTransitionOnDrag || !this.transitionMode) {
            return;
          }
          var nodes = this.getChildrenNodes();
          nodes[index].data = null;
          var transitionContainer = this.getComponent();
          transitionContainer.children = [];
          transitionContainer.kept = undefined;
        },
        onDragStart: function onDragStart(evt) {
          this.context = this.getUnderlyingVm(evt.item);
          evt.item._underlying_vm_ = this.clone(this.context.element);
          draggingElement = evt.item;
        },
        onDragAdd: function onDragAdd(evt) {
          var element = evt.item._underlying_vm_;
          if (element === undefined) {
            return;
          }
          removeNode(evt.item);
          var newIndex = this.getVmIndex(evt.newIndex);
          this.spliceList(newIndex, 0, element);
          this.computeIndexes();
          var added = { element: element, newIndex: newIndex };
          this.emitChanges({ added: added });
        },
        onDragRemove: function onDragRemove(evt) {
          insertNodeAt(this.rootContainer, evt.item, evt.oldIndex);
          if (this.isCloning) {
            removeNode(evt.clone);
            return;
          }
          var oldIndex = this.context.index;
          this.spliceList(oldIndex, 1);
          var removed = { element: this.context.element, oldIndex: oldIndex };
          this.resetTransitionData(oldIndex);
          this.emitChanges({ removed: removed });
        },
        onDragUpdate: function onDragUpdate(evt) {
          removeNode(evt.item);
          insertNodeAt(evt.from, evt.item, evt.oldIndex);
          var oldIndex = this.context.index;
          var newIndex = this.getVmIndex(evt.newIndex);
          this.updatePosition(oldIndex, newIndex);
          var moved = { element: this.context.element, oldIndex: oldIndex, newIndex: newIndex };
          this.emitChanges({ moved: moved });
        },
        computeFutureIndex: function computeFutureIndex(relatedContext, evt) {
          if (!relatedContext.element) {
            return 0;
          }
          var domChildren = [].concat(_toConsumableArray(evt.to.children)).filter(function (el) {
            return el.style['display'] !== 'none';
          });
          var currentDOMIndex = domChildren.indexOf(evt.related);
          var currentIndex = relatedContext.component.getVmIndex(currentDOMIndex);
          var draggedInList = domChildren.indexOf(draggingElement) != -1;
          return draggedInList || !evt.willInsertAfter ? currentIndex : currentIndex + 1;
        },
        onDragMove: function onDragMove(evt, originalEvent) {
          var onMove = this.move;
          if (!onMove || !this.realList) {
            return true;
          }

          var relatedContext = this.getRelatedContextFromMoveEvent(evt);
          var draggedContext = this.context;
          var futureIndex = this.computeFutureIndex(relatedContext, evt);
          _extends(draggedContext, { futureIndex: futureIndex });
          _extends(evt, { relatedContext: relatedContext, draggedContext: draggedContext });
          return onMove(evt, originalEvent);
        },
        onDragEnd: function onDragEnd(evt) {
          this.computeIndexes();
          draggingElement = null;
        }
      }
    };
    return draggableComponent;
  }

  if (true) {
    var Sortable = __webpack_require__(60);
    module.exports = buildDraggable(Sortable);
  } else if (typeof define == "function" && define.amd) {
    define(['sortablejs'], function (Sortable) {
      return buildDraggable(Sortable);
    });
  } else if (window && window.Vue && window.Sortable) {
    var draggable = buildDraggable(window.Sortable);
    Vue.component('draggable', draggable);
  }
})();

/***/ }),
/* 60 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function(__webpack_provided_window_dot_jQuery) {var __WEBPACK_AMD_DEFINE_FACTORY__, __WEBPACK_AMD_DEFINE_RESULT__;/**!
 * Sortable
 * @author	RubaXa   <trash@rubaxa.org>
 * @license MIT
 */

(function sortableModule(factory) {
	"use strict";

	if (true) {
		!(__WEBPACK_AMD_DEFINE_FACTORY__ = (factory),
				__WEBPACK_AMD_DEFINE_RESULT__ = (typeof __WEBPACK_AMD_DEFINE_FACTORY__ === 'function' ?
				(__WEBPACK_AMD_DEFINE_FACTORY__.call(exports, __webpack_require__, exports, module)) :
				__WEBPACK_AMD_DEFINE_FACTORY__),
				__WEBPACK_AMD_DEFINE_RESULT__ !== undefined && (module.exports = __WEBPACK_AMD_DEFINE_RESULT__));
	}
	else if (typeof module != "undefined" && typeof module.exports != "undefined") {
		module.exports = factory();
	}
	else {
		/* jshint sub:true */
		window["Sortable"] = factory();
	}
})(function sortableFactory() {
	"use strict";

	if (typeof window === "undefined" || !window.document) {
		return function sortableError() {
			throw new Error("Sortable.js requires a window with a document");
		};
	}

	var dragEl,
		parentEl,
		ghostEl,
		cloneEl,
		rootEl,
		nextEl,
		lastDownEl,

		scrollEl,
		scrollParentEl,
		scrollCustomFn,

		lastEl,
		lastCSS,
		lastParentCSS,

		oldIndex,
		newIndex,

		activeGroup,
		putSortable,

		autoScroll = {},

		tapEvt,
		touchEvt,

		moved,

		/** @const */
		R_SPACE = /\s+/g,
		R_FLOAT = /left|right|inline/,

		expando = 'Sortable' + (new Date).getTime(),

		win = window,
		document = win.document,
		parseInt = win.parseInt,
		setTimeout = win.setTimeout,

		$ = __webpack_provided_window_dot_jQuery || win.Zepto,
		Polymer = win.Polymer,

		captureMode = false,
		passiveMode = false,

		supportDraggable = ('draggable' in document.createElement('div')),
		supportCssPointerEvents = (function (el) {
			// false when IE11
			if (!!navigator.userAgent.match(/(?:Trident.*rv[ :]?11\.|msie)/i)) {
				return false;
			}
			el = document.createElement('x');
			el.style.cssText = 'pointer-events:auto';
			return el.style.pointerEvents === 'auto';
		})(),

		_silent = false,

		abs = Math.abs,
		min = Math.min,

		savedInputChecked = [],
		touchDragOverListeners = [],

		_autoScroll = _throttle(function (/**Event*/evt, /**Object*/options, /**HTMLElement*/rootEl) {
			// Bug: https://bugzilla.mozilla.org/show_bug.cgi?id=505521
			if (rootEl && options.scroll) {
				var _this = rootEl[expando],
					el,
					rect,
					sens = options.scrollSensitivity,
					speed = options.scrollSpeed,

					x = evt.clientX,
					y = evt.clientY,

					winWidth = window.innerWidth,
					winHeight = window.innerHeight,

					vx,
					vy,

					scrollOffsetX,
					scrollOffsetY
				;

				// Delect scrollEl
				if (scrollParentEl !== rootEl) {
					scrollEl = options.scroll;
					scrollParentEl = rootEl;
					scrollCustomFn = options.scrollFn;

					if (scrollEl === true) {
						scrollEl = rootEl;

						do {
							if ((scrollEl.offsetWidth < scrollEl.scrollWidth) ||
								(scrollEl.offsetHeight < scrollEl.scrollHeight)
							) {
								break;
							}
							/* jshint boss:true */
						} while (scrollEl = scrollEl.parentNode);
					}
				}

				if (scrollEl) {
					el = scrollEl;
					rect = scrollEl.getBoundingClientRect();
					vx = (abs(rect.right - x) <= sens) - (abs(rect.left - x) <= sens);
					vy = (abs(rect.bottom - y) <= sens) - (abs(rect.top - y) <= sens);
				}


				if (!(vx || vy)) {
					vx = (winWidth - x <= sens) - (x <= sens);
					vy = (winHeight - y <= sens) - (y <= sens);

					/* jshint expr:true */
					(vx || vy) && (el = win);
				}


				if (autoScroll.vx !== vx || autoScroll.vy !== vy || autoScroll.el !== el) {
					autoScroll.el = el;
					autoScroll.vx = vx;
					autoScroll.vy = vy;

					clearInterval(autoScroll.pid);

					if (el) {
						autoScroll.pid = setInterval(function () {
							scrollOffsetY = vy ? vy * speed : 0;
							scrollOffsetX = vx ? vx * speed : 0;

							if ('function' === typeof(scrollCustomFn)) {
								return scrollCustomFn.call(_this, scrollOffsetX, scrollOffsetY, evt);
							}

							if (el === win) {
								win.scrollTo(win.pageXOffset + scrollOffsetX, win.pageYOffset + scrollOffsetY);
							} else {
								el.scrollTop += scrollOffsetY;
								el.scrollLeft += scrollOffsetX;
							}
						}, 24);
					}
				}
			}
		}, 30),

		_prepareGroup = function (options) {
			function toFn(value, pull) {
				if (value === void 0 || value === true) {
					value = group.name;
				}

				if (typeof value === 'function') {
					return value;
				} else {
					return function (to, from) {
						var fromGroup = from.options.group.name;

						return pull
							? value
							: value && (value.join
								? value.indexOf(fromGroup) > -1
								: (fromGroup == value)
							);
					};
				}
			}

			var group = {};
			var originalGroup = options.group;

			if (!originalGroup || typeof originalGroup != 'object') {
				originalGroup = {name: originalGroup};
			}

			group.name = originalGroup.name;
			group.checkPull = toFn(originalGroup.pull, true);
			group.checkPut = toFn(originalGroup.put);
			group.revertClone = originalGroup.revertClone;

			options.group = group;
		}
	;

	// Detect support a passive mode
	try {
		window.addEventListener('test', null, Object.defineProperty({}, 'passive', {
			get: function () {
				// `false`, because everything starts to work incorrectly and instead of d'n'd,
				// begins the page has scrolled.
				passiveMode = false;
				captureMode = {
					capture: false,
					passive: passiveMode
				};
			}
		}));
	} catch (err) {}

	/**
	 * @class  Sortable
	 * @param  {HTMLElement}  el
	 * @param  {Object}       [options]
	 */
	function Sortable(el, options) {
		if (!(el && el.nodeType && el.nodeType === 1)) {
			throw 'Sortable: `el` must be HTMLElement, and not ' + {}.toString.call(el);
		}

		this.el = el; // root element
		this.options = options = _extend({}, options);


		// Export instance
		el[expando] = this;

		// Default options
		var defaults = {
			group: Math.random(),
			sort: true,
			disabled: false,
			store: null,
			handle: null,
			scroll: true,
			scrollSensitivity: 30,
			scrollSpeed: 10,
			draggable: /[uo]l/i.test(el.nodeName) ? 'li' : '>*',
			ghostClass: 'sortable-ghost',
			chosenClass: 'sortable-chosen',
			dragClass: 'sortable-drag',
			ignore: 'a, img',
			filter: null,
			preventOnFilter: true,
			animation: 0,
			setData: function (dataTransfer, dragEl) {
				dataTransfer.setData('Text', dragEl.textContent);
			},
			dropBubble: false,
			dragoverBubble: false,
			dataIdAttr: 'data-id',
			delay: 0,
			forceFallback: false,
			fallbackClass: 'sortable-fallback',
			fallbackOnBody: false,
			fallbackTolerance: 0,
			fallbackOffset: {x: 0, y: 0},
			supportPointer: Sortable.supportPointer !== false
		};


		// Set default options
		for (var name in defaults) {
			!(name in options) && (options[name] = defaults[name]);
		}

		_prepareGroup(options);

		// Bind all private methods
		for (var fn in this) {
			if (fn.charAt(0) === '_' && typeof this[fn] === 'function') {
				this[fn] = this[fn].bind(this);
			}
		}

		// Setup drag mode
		this.nativeDraggable = options.forceFallback ? false : supportDraggable;

		// Bind events
		_on(el, 'mousedown', this._onTapStart);
		_on(el, 'touchstart', this._onTapStart);
		options.supportPointer && _on(el, 'pointerdown', this._onTapStart);

		if (this.nativeDraggable) {
			_on(el, 'dragover', this);
			_on(el, 'dragenter', this);
		}

		touchDragOverListeners.push(this._onDragOver);

		// Restore sorting
		options.store && this.sort(options.store.get(this));
	}


	Sortable.prototype = /** @lends Sortable.prototype */ {
		constructor: Sortable,

		_onTapStart: function (/** Event|TouchEvent */evt) {
			var _this = this,
				el = this.el,
				options = this.options,
				preventOnFilter = options.preventOnFilter,
				type = evt.type,
				touch = evt.touches && evt.touches[0],
				target = (touch || evt).target,
				originalTarget = evt.target.shadowRoot && (evt.path && evt.path[0]) || target,
				filter = options.filter,
				startIndex;

			_saveInputCheckedState(el);


			// Don't trigger start event when an element is been dragged, otherwise the evt.oldindex always wrong when set option.group.
			if (dragEl) {
				return;
			}

			if (/mousedown|pointerdown/.test(type) && evt.button !== 0 || options.disabled) {
				return; // only left button or enabled
			}

			// cancel dnd if original target is content editable
			if (originalTarget.isContentEditable) {
				return;
			}

			target = _closest(target, options.draggable, el);

			if (!target) {
				return;
			}

			if (lastDownEl === target) {
				// Ignoring duplicate `down`
				return;
			}

			// Get the index of the dragged element within its parent
			startIndex = _index(target, options.draggable);

			// Check filter
			if (typeof filter === 'function') {
				if (filter.call(this, evt, target, this)) {
					_dispatchEvent(_this, originalTarget, 'filter', target, el, el, startIndex);
					preventOnFilter && evt.preventDefault();
					return; // cancel dnd
				}
			}
			else if (filter) {
				filter = filter.split(',').some(function (criteria) {
					criteria = _closest(originalTarget, criteria.trim(), el);

					if (criteria) {
						_dispatchEvent(_this, criteria, 'filter', target, el, el, startIndex);
						return true;
					}
				});

				if (filter) {
					preventOnFilter && evt.preventDefault();
					return; // cancel dnd
				}
			}

			if (options.handle && !_closest(originalTarget, options.handle, el)) {
				return;
			}

			// Prepare `dragstart`
			this._prepareDragStart(evt, touch, target, startIndex);
		},

		_prepareDragStart: function (/** Event */evt, /** Touch */touch, /** HTMLElement */target, /** Number */startIndex) {
			var _this = this,
				el = _this.el,
				options = _this.options,
				ownerDocument = el.ownerDocument,
				dragStartFn;

			if (target && !dragEl && (target.parentNode === el)) {
				tapEvt = evt;

				rootEl = el;
				dragEl = target;
				parentEl = dragEl.parentNode;
				nextEl = dragEl.nextSibling;
				lastDownEl = target;
				activeGroup = options.group;
				oldIndex = startIndex;

				this._lastX = (touch || evt).clientX;
				this._lastY = (touch || evt).clientY;

				dragEl.style['will-change'] = 'all';

				dragStartFn = function () {
					// Delayed drag has been triggered
					// we can re-enable the events: touchmove/mousemove
					_this._disableDelayedDrag();

					// Make the element draggable
					dragEl.draggable = _this.nativeDraggable;

					// Chosen item
					_toggleClass(dragEl, options.chosenClass, true);

					// Bind the events: dragstart/dragend
					_this._triggerDragStart(evt, touch);

					// Drag start event
					_dispatchEvent(_this, rootEl, 'choose', dragEl, rootEl, rootEl, oldIndex);
				};

				// Disable "draggable"
				options.ignore.split(',').forEach(function (criteria) {
					_find(dragEl, criteria.trim(), _disableDraggable);
				});

				_on(ownerDocument, 'mouseup', _this._onDrop);
				_on(ownerDocument, 'touchend', _this._onDrop);
				_on(ownerDocument, 'touchcancel', _this._onDrop);
				_on(ownerDocument, 'selectstart', _this);
				options.supportPointer && _on(ownerDocument, 'pointercancel', _this._onDrop);

				if (options.delay) {
					// If the user moves the pointer or let go the click or touch
					// before the delay has been reached:
					// disable the delayed drag
					_on(ownerDocument, 'mouseup', _this._disableDelayedDrag);
					_on(ownerDocument, 'touchend', _this._disableDelayedDrag);
					_on(ownerDocument, 'touchcancel', _this._disableDelayedDrag);
					_on(ownerDocument, 'mousemove', _this._disableDelayedDrag);
					_on(ownerDocument, 'touchmove', _this._disableDelayedDrag);
					options.supportPointer && _on(ownerDocument, 'pointermove', _this._disableDelayedDrag);

					_this._dragStartTimer = setTimeout(dragStartFn, options.delay);
				} else {
					dragStartFn();
				}


			}
		},

		_disableDelayedDrag: function () {
			var ownerDocument = this.el.ownerDocument;

			clearTimeout(this._dragStartTimer);
			_off(ownerDocument, 'mouseup', this._disableDelayedDrag);
			_off(ownerDocument, 'touchend', this._disableDelayedDrag);
			_off(ownerDocument, 'touchcancel', this._disableDelayedDrag);
			_off(ownerDocument, 'mousemove', this._disableDelayedDrag);
			_off(ownerDocument, 'touchmove', this._disableDelayedDrag);
			_off(ownerDocument, 'pointermove', this._disableDelayedDrag);
		},

		_triggerDragStart: function (/** Event */evt, /** Touch */touch) {
			touch = touch || (evt.pointerType == 'touch' ? evt : null);

			if (touch) {
				// Touch device support
				tapEvt = {
					target: dragEl,
					clientX: touch.clientX,
					clientY: touch.clientY
				};

				this._onDragStart(tapEvt, 'touch');
			}
			else if (!this.nativeDraggable) {
				this._onDragStart(tapEvt, true);
			}
			else {
				_on(dragEl, 'dragend', this);
				_on(rootEl, 'dragstart', this._onDragStart);
			}

			try {
				if (document.selection) {
					// Timeout neccessary for IE9
					_nextTick(function () {
						document.selection.empty();
					});
				} else {
					window.getSelection().removeAllRanges();
				}
			} catch (err) {
			}
		},

		_dragStarted: function () {
			if (rootEl && dragEl) {
				var options = this.options;

				// Apply effect
				_toggleClass(dragEl, options.ghostClass, true);
				_toggleClass(dragEl, options.dragClass, false);

				Sortable.active = this;

				// Drag start event
				_dispatchEvent(this, rootEl, 'start', dragEl, rootEl, rootEl, oldIndex);
			} else {
				this._nulling();
			}
		},

		_emulateDragOver: function () {
			if (touchEvt) {
				if (this._lastX === touchEvt.clientX && this._lastY === touchEvt.clientY) {
					return;
				}

				this._lastX = touchEvt.clientX;
				this._lastY = touchEvt.clientY;

				if (!supportCssPointerEvents) {
					_css(ghostEl, 'display', 'none');
				}

				var target = document.elementFromPoint(touchEvt.clientX, touchEvt.clientY);
				var parent = target;
				var i = touchDragOverListeners.length;

				if (target && target.shadowRoot) {
					target = target.shadowRoot.elementFromPoint(touchEvt.clientX, touchEvt.clientY);
					parent = target;
				}

				if (parent) {
					do {
						if (parent[expando]) {
							while (i--) {
								touchDragOverListeners[i]({
									clientX: touchEvt.clientX,
									clientY: touchEvt.clientY,
									target: target,
									rootEl: parent
								});
							}

							break;
						}

						target = parent; // store last element
					}
					/* jshint boss:true */
					while (parent = parent.parentNode);
				}

				if (!supportCssPointerEvents) {
					_css(ghostEl, 'display', '');
				}
			}
		},


		_onTouchMove: function (/**TouchEvent*/evt) {
			if (tapEvt) {
				var	options = this.options,
					fallbackTolerance = options.fallbackTolerance,
					fallbackOffset = options.fallbackOffset,
					touch = evt.touches ? evt.touches[0] : evt,
					dx = (touch.clientX - tapEvt.clientX) + fallbackOffset.x,
					dy = (touch.clientY - tapEvt.clientY) + fallbackOffset.y,
					translate3d = evt.touches ? 'translate3d(' + dx + 'px,' + dy + 'px,0)' : 'translate(' + dx + 'px,' + dy + 'px)';

				// only set the status to dragging, when we are actually dragging
				if (!Sortable.active) {
					if (fallbackTolerance &&
						min(abs(touch.clientX - this._lastX), abs(touch.clientY - this._lastY)) < fallbackTolerance
					) {
						return;
					}

					this._dragStarted();
				}

				// as well as creating the ghost element on the document body
				this._appendGhost();

				moved = true;
				touchEvt = touch;

				_css(ghostEl, 'webkitTransform', translate3d);
				_css(ghostEl, 'mozTransform', translate3d);
				_css(ghostEl, 'msTransform', translate3d);
				_css(ghostEl, 'transform', translate3d);

				evt.preventDefault();
			}
		},

		_appendGhost: function () {
			if (!ghostEl) {
				var rect = dragEl.getBoundingClientRect(),
					css = _css(dragEl),
					options = this.options,
					ghostRect;

				ghostEl = dragEl.cloneNode(true);

				_toggleClass(ghostEl, options.ghostClass, false);
				_toggleClass(ghostEl, options.fallbackClass, true);
				_toggleClass(ghostEl, options.dragClass, true);

				_css(ghostEl, 'top', rect.top - parseInt(css.marginTop, 10));
				_css(ghostEl, 'left', rect.left - parseInt(css.marginLeft, 10));
				_css(ghostEl, 'width', rect.width);
				_css(ghostEl, 'height', rect.height);
				_css(ghostEl, 'opacity', '0.8');
				_css(ghostEl, 'position', 'fixed');
				_css(ghostEl, 'zIndex', '100000');
				_css(ghostEl, 'pointerEvents', 'none');

				options.fallbackOnBody && document.body.appendChild(ghostEl) || rootEl.appendChild(ghostEl);

				// Fixing dimensions.
				ghostRect = ghostEl.getBoundingClientRect();
				_css(ghostEl, 'width', rect.width * 2 - ghostRect.width);
				_css(ghostEl, 'height', rect.height * 2 - ghostRect.height);
			}
		},

		_onDragStart: function (/**Event*/evt, /**boolean*/useFallback) {
			var _this = this;
			var dataTransfer = evt.dataTransfer;
			var options = _this.options;

			_this._offUpEvents();

			if (activeGroup.checkPull(_this, _this, dragEl, evt)) {
				cloneEl = _clone(dragEl);

				cloneEl.draggable = false;
				cloneEl.style['will-change'] = '';

				_css(cloneEl, 'display', 'none');
				_toggleClass(cloneEl, _this.options.chosenClass, false);

				// #1143: IFrame support workaround
				_this._cloneId = _nextTick(function () {
					rootEl.insertBefore(cloneEl, dragEl);
					_dispatchEvent(_this, rootEl, 'clone', dragEl);
				});
			}

			_toggleClass(dragEl, options.dragClass, true);

			if (useFallback) {
				if (useFallback === 'touch') {
					// Bind touch events
					_on(document, 'touchmove', _this._onTouchMove);
					_on(document, 'touchend', _this._onDrop);
					_on(document, 'touchcancel', _this._onDrop);

					if (options.supportPointer) {
						_on(document, 'pointermove', _this._onTouchMove);
						_on(document, 'pointerup', _this._onDrop);
					}
				} else {
					// Old brwoser
					_on(document, 'mousemove', _this._onTouchMove);
					_on(document, 'mouseup', _this._onDrop);
				}

				_this._loopId = setInterval(_this._emulateDragOver, 50);
			}
			else {
				if (dataTransfer) {
					dataTransfer.effectAllowed = 'move';
					options.setData && options.setData.call(_this, dataTransfer, dragEl);
				}

				_on(document, 'drop', _this);

				// #1143: Бывает элемент с IFrame внутри блокирует `drop`,
				// поэтому если вызвался `mouseover`, значит надо отменять весь d'n'd.
				// Breaking Chrome 62+
				// _on(document, 'mouseover', _this);

				_this._dragStartId = _nextTick(_this._dragStarted);
			}
		},

		_onDragOver: function (/**Event*/evt) {
			var el = this.el,
				target,
				dragRect,
				targetRect,
				revert,
				options = this.options,
				group = options.group,
				activeSortable = Sortable.active,
				isOwner = (activeGroup === group),
				isMovingBetweenSortable = false,
				canSort = options.sort;

			if (evt.preventDefault !== void 0) {
				evt.preventDefault();
				!options.dragoverBubble && evt.stopPropagation();
			}

			if (dragEl.animated) {
				return;
			}

			moved = true;

			if (activeSortable && !options.disabled &&
				(isOwner
					? canSort || (revert = !rootEl.contains(dragEl)) // Reverting item into the original list
					: (
						putSortable === this ||
						(
							(activeSortable.lastPullMode = activeGroup.checkPull(this, activeSortable, dragEl, evt)) &&
							group.checkPut(this, activeSortable, dragEl, evt)
						)
					)
				) &&
				(evt.rootEl === void 0 || evt.rootEl === this.el) // touch fallback
			) {
				// Smart auto-scrolling
				_autoScroll(evt, options, this.el);

				if (_silent) {
					return;
				}

				target = _closest(evt.target, options.draggable, el);
				dragRect = dragEl.getBoundingClientRect();

				if (putSortable !== this) {
					putSortable = this;
					isMovingBetweenSortable = true;
				}

				if (revert) {
					_cloneHide(activeSortable, true);
					parentEl = rootEl; // actualization

					if (cloneEl || nextEl) {
						rootEl.insertBefore(dragEl, cloneEl || nextEl);
					}
					else if (!canSort) {
						rootEl.appendChild(dragEl);
					}

					return;
				}


				if ((el.children.length === 0) || (el.children[0] === ghostEl) ||
					(el === evt.target) && (_ghostIsLast(el, evt))
				) {
					//assign target only if condition is true
					if (el.children.length !== 0 && el.children[0] !== ghostEl && el === evt.target) {
						target = el.lastElementChild;
					}

					if (target) {
						if (target.animated) {
							return;
						}

						targetRect = target.getBoundingClientRect();
					}

					_cloneHide(activeSortable, isOwner);

					if (_onMove(rootEl, el, dragEl, dragRect, target, targetRect, evt) !== false) {
						if (!dragEl.contains(el)) {
							el.appendChild(dragEl);
							parentEl = el; // actualization
						}

						this._animate(dragRect, dragEl);
						target && this._animate(targetRect, target);
					}
				}
				else if (target && !target.animated && target !== dragEl && (target.parentNode[expando] !== void 0)) {
					if (lastEl !== target) {
						lastEl = target;
						lastCSS = _css(target);
						lastParentCSS = _css(target.parentNode);
					}

					targetRect = target.getBoundingClientRect();

					var width = targetRect.right - targetRect.left,
						height = targetRect.bottom - targetRect.top,
						floating = R_FLOAT.test(lastCSS.cssFloat + lastCSS.display)
							|| (lastParentCSS.display == 'flex' && lastParentCSS['flex-direction'].indexOf('row') === 0),
						isWide = (target.offsetWidth > dragEl.offsetWidth),
						isLong = (target.offsetHeight > dragEl.offsetHeight),
						halfway = (floating ? (evt.clientX - targetRect.left) / width : (evt.clientY - targetRect.top) / height) > 0.5,
						nextSibling = target.nextElementSibling,
						after = false
					;

					if (floating) {
						var elTop = dragEl.offsetTop,
							tgTop = target.offsetTop;

						if (elTop === tgTop) {
							after = (target.previousElementSibling === dragEl) && !isWide || halfway && isWide;
						}
						else if (target.previousElementSibling === dragEl || dragEl.previousElementSibling === target) {
							after = (evt.clientY - targetRect.top) / height > 0.5;
						} else {
							after = tgTop > elTop;
						}
						} else if (!isMovingBetweenSortable) {
						after = (nextSibling !== dragEl) && !isLong || halfway && isLong;
					}

					var moveVector = _onMove(rootEl, el, dragEl, dragRect, target, targetRect, evt, after);

					if (moveVector !== false) {
						if (moveVector === 1 || moveVector === -1) {
							after = (moveVector === 1);
						}

						_silent = true;
						setTimeout(_unsilent, 30);

						_cloneHide(activeSortable, isOwner);

						if (!dragEl.contains(el)) {
							if (after && !nextSibling) {
								el.appendChild(dragEl);
							} else {
								target.parentNode.insertBefore(dragEl, after ? nextSibling : target);
							}
						}

						parentEl = dragEl.parentNode; // actualization

						this._animate(dragRect, dragEl);
						this._animate(targetRect, target);
					}
				}
			}
		},

		_animate: function (prevRect, target) {
			var ms = this.options.animation;

			if (ms) {
				var currentRect = target.getBoundingClientRect();

				if (prevRect.nodeType === 1) {
					prevRect = prevRect.getBoundingClientRect();
				}

				_css(target, 'transition', 'none');
				_css(target, 'transform', 'translate3d('
					+ (prevRect.left - currentRect.left) + 'px,'
					+ (prevRect.top - currentRect.top) + 'px,0)'
				);

				target.offsetWidth; // repaint

				_css(target, 'transition', 'all ' + ms + 'ms');
				_css(target, 'transform', 'translate3d(0,0,0)');

				clearTimeout(target.animated);
				target.animated = setTimeout(function () {
					_css(target, 'transition', '');
					_css(target, 'transform', '');
					target.animated = false;
				}, ms);
			}
		},

		_offUpEvents: function () {
			var ownerDocument = this.el.ownerDocument;

			_off(document, 'touchmove', this._onTouchMove);
			_off(document, 'pointermove', this._onTouchMove);
			_off(ownerDocument, 'mouseup', this._onDrop);
			_off(ownerDocument, 'touchend', this._onDrop);
			_off(ownerDocument, 'pointerup', this._onDrop);
			_off(ownerDocument, 'touchcancel', this._onDrop);
			_off(ownerDocument, 'pointercancel', this._onDrop);
			_off(ownerDocument, 'selectstart', this);
		},

		_onDrop: function (/**Event*/evt) {
			var el = this.el,
				options = this.options;

			clearInterval(this._loopId);
			clearInterval(autoScroll.pid);
			clearTimeout(this._dragStartTimer);

			_cancelNextTick(this._cloneId);
			_cancelNextTick(this._dragStartId);

			// Unbind events
			_off(document, 'mouseover', this);
			_off(document, 'mousemove', this._onTouchMove);

			if (this.nativeDraggable) {
				_off(document, 'drop', this);
				_off(el, 'dragstart', this._onDragStart);
			}

			this._offUpEvents();

			if (evt) {
				if (moved) {
					evt.preventDefault();
					!options.dropBubble && evt.stopPropagation();
				}

				ghostEl && ghostEl.parentNode && ghostEl.parentNode.removeChild(ghostEl);

				if (rootEl === parentEl || Sortable.active.lastPullMode !== 'clone') {
					// Remove clone
					cloneEl && cloneEl.parentNode && cloneEl.parentNode.removeChild(cloneEl);
				}

				if (dragEl) {
					if (this.nativeDraggable) {
						_off(dragEl, 'dragend', this);
					}

					_disableDraggable(dragEl);
					dragEl.style['will-change'] = '';

					// Remove class's
					_toggleClass(dragEl, this.options.ghostClass, false);
					_toggleClass(dragEl, this.options.chosenClass, false);

					// Drag stop event
					_dispatchEvent(this, rootEl, 'unchoose', dragEl, parentEl, rootEl, oldIndex);

					if (rootEl !== parentEl) {
						newIndex = _index(dragEl, options.draggable);

						if (newIndex >= 0) {
							// Add event
							_dispatchEvent(null, parentEl, 'add', dragEl, parentEl, rootEl, oldIndex, newIndex);

							// Remove event
							_dispatchEvent(this, rootEl, 'remove', dragEl, parentEl, rootEl, oldIndex, newIndex);

							// drag from one list and drop into another
							_dispatchEvent(null, parentEl, 'sort', dragEl, parentEl, rootEl, oldIndex, newIndex);
							_dispatchEvent(this, rootEl, 'sort', dragEl, parentEl, rootEl, oldIndex, newIndex);
						}
					}
					else {
						if (dragEl.nextSibling !== nextEl) {
							// Get the index of the dragged element within its parent
							newIndex = _index(dragEl, options.draggable);

							if (newIndex >= 0) {
								// drag & drop within the same list
								_dispatchEvent(this, rootEl, 'update', dragEl, parentEl, rootEl, oldIndex, newIndex);
								_dispatchEvent(this, rootEl, 'sort', dragEl, parentEl, rootEl, oldIndex, newIndex);
							}
						}
					}

					if (Sortable.active) {
						/* jshint eqnull:true */
						if (newIndex == null || newIndex === -1) {
							newIndex = oldIndex;
						}

						_dispatchEvent(this, rootEl, 'end', dragEl, parentEl, rootEl, oldIndex, newIndex);

						// Save sorting
						this.save();
					}
				}

			}

			this._nulling();
		},

		_nulling: function() {
			rootEl =
			dragEl =
			parentEl =
			ghostEl =
			nextEl =
			cloneEl =
			lastDownEl =

			scrollEl =
			scrollParentEl =

			tapEvt =
			touchEvt =

			moved =
			newIndex =

			lastEl =
			lastCSS =

			putSortable =
			activeGroup =
			Sortable.active = null;

			savedInputChecked.forEach(function (el) {
				el.checked = true;
			});
			savedInputChecked.length = 0;
		},

		handleEvent: function (/**Event*/evt) {
			switch (evt.type) {
				case 'drop':
				case 'dragend':
					this._onDrop(evt);
					break;

				case 'dragover':
				case 'dragenter':
					if (dragEl) {
						this._onDragOver(evt);
						_globalDragOver(evt);
					}
					break;

				case 'mouseover':
					this._onDrop(evt);
					break;

				case 'selectstart':
					evt.preventDefault();
					break;
			}
		},


		/**
		 * Serializes the item into an array of string.
		 * @returns {String[]}
		 */
		toArray: function () {
			var order = [],
				el,
				children = this.el.children,
				i = 0,
				n = children.length,
				options = this.options;

			for (; i < n; i++) {
				el = children[i];
				if (_closest(el, options.draggable, this.el)) {
					order.push(el.getAttribute(options.dataIdAttr) || _generateId(el));
				}
			}

			return order;
		},


		/**
		 * Sorts the elements according to the array.
		 * @param  {String[]}  order  order of the items
		 */
		sort: function (order) {
			var items = {}, rootEl = this.el;

			this.toArray().forEach(function (id, i) {
				var el = rootEl.children[i];

				if (_closest(el, this.options.draggable, rootEl)) {
					items[id] = el;
				}
			}, this);

			order.forEach(function (id) {
				if (items[id]) {
					rootEl.removeChild(items[id]);
					rootEl.appendChild(items[id]);
				}
			});
		},


		/**
		 * Save the current sorting
		 */
		save: function () {
			var store = this.options.store;
			store && store.set(this);
		},


		/**
		 * For each element in the set, get the first element that matches the selector by testing the element itself and traversing up through its ancestors in the DOM tree.
		 * @param   {HTMLElement}  el
		 * @param   {String}       [selector]  default: `options.draggable`
		 * @returns {HTMLElement|null}
		 */
		closest: function (el, selector) {
			return _closest(el, selector || this.options.draggable, this.el);
		},


		/**
		 * Set/get option
		 * @param   {string} name
		 * @param   {*}      [value]
		 * @returns {*}
		 */
		option: function (name, value) {
			var options = this.options;

			if (value === void 0) {
				return options[name];
			} else {
				options[name] = value;

				if (name === 'group') {
					_prepareGroup(options);
				}
			}
		},


		/**
		 * Destroy
		 */
		destroy: function () {
			var el = this.el;

			el[expando] = null;

			_off(el, 'mousedown', this._onTapStart);
			_off(el, 'touchstart', this._onTapStart);
			_off(el, 'pointerdown', this._onTapStart);

			if (this.nativeDraggable) {
				_off(el, 'dragover', this);
				_off(el, 'dragenter', this);
			}

			// Remove draggable attributes
			Array.prototype.forEach.call(el.querySelectorAll('[draggable]'), function (el) {
				el.removeAttribute('draggable');
			});

			touchDragOverListeners.splice(touchDragOverListeners.indexOf(this._onDragOver), 1);

			this._onDrop();

			this.el = el = null;
		}
	};


	function _cloneHide(sortable, state) {
		if (sortable.lastPullMode !== 'clone') {
			state = true;
		}

		if (cloneEl && (cloneEl.state !== state)) {
			_css(cloneEl, 'display', state ? 'none' : '');

			if (!state) {
				if (cloneEl.state) {
					if (sortable.options.group.revertClone) {
						rootEl.insertBefore(cloneEl, nextEl);
						sortable._animate(dragEl, cloneEl);
					} else {
						rootEl.insertBefore(cloneEl, dragEl);
					}
				}
			}

			cloneEl.state = state;
		}
	}


	function _closest(/**HTMLElement*/el, /**String*/selector, /**HTMLElement*/ctx) {
		if (el) {
			ctx = ctx || document;

			do {
				if ((selector === '>*' && el.parentNode === ctx) || _matches(el, selector)) {
					return el;
				}
				/* jshint boss:true */
			} while (el = _getParentOrHost(el));
		}

		return null;
	}


	function _getParentOrHost(el) {
		var parent = el.host;

		return (parent && parent.nodeType) ? parent : el.parentNode;
	}


	function _globalDragOver(/**Event*/evt) {
		if (evt.dataTransfer) {
			evt.dataTransfer.dropEffect = 'move';
		}
		evt.preventDefault();
	}


	function _on(el, event, fn) {
		el.addEventListener(event, fn, captureMode);
	}


	function _off(el, event, fn) {
		el.removeEventListener(event, fn, captureMode);
	}


	function _toggleClass(el, name, state) {
		if (el) {
			if (el.classList) {
				el.classList[state ? 'add' : 'remove'](name);
			}
			else {
				var className = (' ' + el.className + ' ').replace(R_SPACE, ' ').replace(' ' + name + ' ', ' ');
				el.className = (className + (state ? ' ' + name : '')).replace(R_SPACE, ' ');
			}
		}
	}


	function _css(el, prop, val) {
		var style = el && el.style;

		if (style) {
			if (val === void 0) {
				if (document.defaultView && document.defaultView.getComputedStyle) {
					val = document.defaultView.getComputedStyle(el, '');
				}
				else if (el.currentStyle) {
					val = el.currentStyle;
				}

				return prop === void 0 ? val : val[prop];
			}
			else {
				if (!(prop in style)) {
					prop = '-webkit-' + prop;
				}

				style[prop] = val + (typeof val === 'string' ? '' : 'px');
			}
		}
	}


	function _find(ctx, tagName, iterator) {
		if (ctx) {
			var list = ctx.getElementsByTagName(tagName), i = 0, n = list.length;

			if (iterator) {
				for (; i < n; i++) {
					iterator(list[i], i);
				}
			}

			return list;
		}

		return [];
	}



	function _dispatchEvent(sortable, rootEl, name, targetEl, toEl, fromEl, startIndex, newIndex) {
		sortable = (sortable || rootEl[expando]);

		var evt = document.createEvent('Event'),
			options = sortable.options,
			onName = 'on' + name.charAt(0).toUpperCase() + name.substr(1);

		evt.initEvent(name, true, true);

		evt.to = toEl || rootEl;
		evt.from = fromEl || rootEl;
		evt.item = targetEl || rootEl;
		evt.clone = cloneEl;

		evt.oldIndex = startIndex;
		evt.newIndex = newIndex;

		rootEl.dispatchEvent(evt);

		if (options[onName]) {
			options[onName].call(sortable, evt);
		}
	}


	function _onMove(fromEl, toEl, dragEl, dragRect, targetEl, targetRect, originalEvt, willInsertAfter) {
		var evt,
			sortable = fromEl[expando],
			onMoveFn = sortable.options.onMove,
			retVal;

		evt = document.createEvent('Event');
		evt.initEvent('move', true, true);

		evt.to = toEl;
		evt.from = fromEl;
		evt.dragged = dragEl;
		evt.draggedRect = dragRect;
		evt.related = targetEl || toEl;
		evt.relatedRect = targetRect || toEl.getBoundingClientRect();
		evt.willInsertAfter = willInsertAfter;

		fromEl.dispatchEvent(evt);

		if (onMoveFn) {
			retVal = onMoveFn.call(sortable, evt, originalEvt);
		}

		return retVal;
	}


	function _disableDraggable(el) {
		el.draggable = false;
	}


	function _unsilent() {
		_silent = false;
	}


	/** @returns {HTMLElement|false} */
	function _ghostIsLast(el, evt) {
		var lastEl = el.lastElementChild,
			rect = lastEl.getBoundingClientRect();

		// 5 — min delta
		// abs — нельзя добавлять, а то глюки при наведении сверху
		return (evt.clientY - (rect.top + rect.height) > 5) ||
			(evt.clientX - (rect.left + rect.width) > 5);
	}


	/**
	 * Generate id
	 * @param   {HTMLElement} el
	 * @returns {String}
	 * @private
	 */
	function _generateId(el) {
		var str = el.tagName + el.className + el.src + el.href + el.textContent,
			i = str.length,
			sum = 0;

		while (i--) {
			sum += str.charCodeAt(i);
		}

		return sum.toString(36);
	}

	/**
	 * Returns the index of an element within its parent for a selected set of
	 * elements
	 * @param  {HTMLElement} el
	 * @param  {selector} selector
	 * @return {number}
	 */
	function _index(el, selector) {
		var index = 0;

		if (!el || !el.parentNode) {
			return -1;
		}

		while (el && (el = el.previousElementSibling)) {
			if ((el.nodeName.toUpperCase() !== 'TEMPLATE') && (selector === '>*' || _matches(el, selector))) {
				index++;
			}
		}

		return index;
	}

	function _matches(/**HTMLElement*/el, /**String*/selector) {
		if (el) {
			selector = selector.split('.');

			var tag = selector.shift().toUpperCase(),
				re = new RegExp('\\s(' + selector.join('|') + ')(?=\\s)', 'g');

			return (
				(tag === '' || el.nodeName.toUpperCase() == tag) &&
				(!selector.length || ((' ' + el.className + ' ').match(re) || []).length == selector.length)
			);
		}

		return false;
	}

	function _throttle(callback, ms) {
		var args, _this;

		return function () {
			if (args === void 0) {
				args = arguments;
				_this = this;

				setTimeout(function () {
					if (args.length === 1) {
						callback.call(_this, args[0]);
					} else {
						callback.apply(_this, args);
					}

					args = void 0;
				}, ms);
			}
		};
	}

	function _extend(dst, src) {
		if (dst && src) {
			for (var key in src) {
				if (src.hasOwnProperty(key)) {
					dst[key] = src[key];
				}
			}
		}

		return dst;
	}

	function _clone(el) {
		if (Polymer && Polymer.dom) {
			return Polymer.dom(el).cloneNode(true);
		}
		else if ($) {
			return $(el).clone(true)[0];
		}
		else {
			return el.cloneNode(true);
		}
	}

	function _saveInputCheckedState(root) {
		var inputs = root.getElementsByTagName('input');
		var idx = inputs.length;

		while (idx--) {
			var el = inputs[idx];
			el.checked && savedInputChecked.push(el);
		}
	}

	function _nextTick(fn) {
		return setTimeout(fn, 0);
	}

	function _cancelNextTick(id) {
		return clearTimeout(id);
	}

	// Fixed #973:
	_on(document, 'touchmove', function (evt) {
		if (Sortable.active) {
			evt.preventDefault();
		}
	});

	// Export utils
	Sortable.utils = {
		on: _on,
		off: _off,
		css: _css,
		find: _find,
		is: function (el, selector) {
			return !!_closest(el, selector, el);
		},
		extend: _extend,
		throttle: _throttle,
		closest: _closest,
		toggleClass: _toggleClass,
		clone: _clone,
		index: _index,
		nextTick: _nextTick,
		cancelNextTick: _cancelNextTick
	};


	/**
	 * Create sortable instance
	 * @param {HTMLElement}  el
	 * @param {Object}      [options]
	 */
	Sortable.create = function (el, options) {
		return new Sortable(el, options);
	};


	// Export
	Sortable.version = '1.7.0';
	return Sortable;
});

/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(1)))

/***/ }),
/* 61 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _vm.label !== undefined
        ? _c("div", { staticClass: "col-xs-12" }, [
            _c(
              "label",
              {
                class:
                  "label-control topped " +
                  (_vm.list.length > _vm.rowLimit
                    ? "animated pulse infinite"
                    : "")
              },
              [
                _vm._v(_vm._s(_vm.label) + "\n            "),
                _vm.list.length == _vm.rowLimit
                  ? _c("span", { staticClass: "text-danger" }, [
                      _vm._v("Row Limit Exceeded")
                    ])
                  : _vm._e(),
                _vm._v(" "),
                _vm.list.length > _vm.rowLimit
                  ? _c("span", { staticClass: "text-danger" }, [
                      _vm._v(
                        "Please manage rows or lose those exceeded the limit"
                      )
                    ])
                  : _vm._e()
              ]
            )
          ])
        : _vm._e(),
      _vm._v(" "),
      _c(
        "draggable",
        {
          attrs: { list: _vm.list, options: _vm.draggableOptions },
          on: { sort: _vm.autosave }
        },
        _vm._l(_vm.list, function(item, index) {
          return _c(
            "div",
            { key: _vm.field + "-item-" + index, staticClass: "form-group-sm" },
            [
              _c(
                "div",
                {
                  staticClass: "col-xs-12 col-sm-8 col-md-10",
                  staticStyle: { "padding-right": "2px" }
                },
                [
                  _c("textarea", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: item.value,
                        expression: "item.value"
                      }
                    ],
                    class:
                      "form-control" +
                      (index + 1 <= _vm.rowLimit ? "" : " overFlow") +
                      (item.duplicate ? " duplicate" : ""),
                    attrs: { id: _vm.field + "-" + (index + 1), rows: "1" },
                    domProps: { value: item.value },
                    on: {
                      blur: _vm.autosave,
                      keydown: [
                        function($event) {
                          if (
                            !("button" in $event) &&
                            _vm._k(
                              $event.keyCode,
                              "enter",
                              13,
                              $event.key,
                              "Enter"
                            )
                          ) {
                            return null
                          }
                          $event.preventDefault()
                          return _vm.onEnterKeyPressed($event)
                        },
                        function($event) {
                          if (
                            !("button" in $event) &&
                            _vm._k($event.keyCode, "down", 40, $event.key, [
                              "Down",
                              "ArrowDown"
                            ])
                          ) {
                            return null
                          }
                          $event.preventDefault()
                          return _vm.onDownKeyPressed($event)
                        },
                        function($event) {
                          if (
                            !("button" in $event) &&
                            _vm._k($event.keyCode, "up", 38, $event.key, [
                              "Up",
                              "ArrowUp"
                            ])
                          ) {
                            return null
                          }
                          $event.preventDefault()
                          return _vm.onUpKeyPressed($event)
                        }
                      ],
                      focus: function($event) {
                        _vm.currentRow = index
                      },
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(item, "value", $event.target.value)
                      }
                    }
                  })
                ]
              ),
              _vm._v(" "),
              _vm.rowLimit > 1 || _vm.list.length > 1
                ? _c(
                    "div",
                    {
                      staticClass: "col-xs-12 col-sm-4 col-md-2",
                      staticStyle: {
                        "padding-top": "4px",
                        background: "#ffffd3!important"
                      }
                    },
                    [
                      _vm.list.length > 1
                        ? _c("span", { staticClass: "badge drag-icon" }, [
                            _c("span", [_vm._v(_vm._s(index + 1))])
                          ])
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.list.length < _vm.rowLimit
                        ? _c("button-app", {
                            attrs: {
                              action: "add-" + _vm.field,
                              status: "info",
                              label: "<span class='fa fa-plus'></span>",
                              size: "xs",
                              "no-tap-stop": ""
                            }
                          })
                        : _vm._e(),
                      _vm._v(" "),
                      _vm.list.length > 1
                        ? _c("button-app", {
                            attrs: {
                              action: {
                                event: "delete-" + _vm.field,
                                value: index
                              },
                              status: "danger",
                              label: "<span class='fa fa-trash-o'></span>",
                              size: "xs",
                              "no-tap-stop": ""
                            }
                          })
                        : _vm._e()
                    ],
                    1
                  )
                : _vm._e()
            ]
          )
        })
      )
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
    require("vue-hot-reload-api")      .rerender("data-v-185c3f94", module.exports)
  }
}

/***/ }),
/* 62 */,
/* 63 */,
/* 64 */,
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
/* 140 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(141);


/***/ }),
/* 141 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {__webpack_require__(5);

// in case of need to use global event bus
window.EventBus = new Vue();

Vue.component('alert-box', __webpack_require__(142));
Vue.component('button-app', __webpack_require__(147));
Vue.component('modal-dialog', __webpack_require__(152));
Vue.component('navbar', __webpack_require__(157));
Vue.component('appbar-right', __webpack_require__(160));
Vue.component('panel', __webpack_require__(37));
Vue.component('input-text', __webpack_require__(52));
Vue.component('input-suggestion', __webpack_require__(163));
Vue.component('input-select', __webpack_require__(166));
Vue.component('input-textarea', __webpack_require__(171));
Vue.component('input-radio', __webpack_require__(176));
Vue.component('input-check', __webpack_require__(181));
Vue.component('input-check-group', __webpack_require__(186));
Vue.component('input-text-addon', __webpack_require__(189));
Vue.component('loggable', __webpack_require__(194));
Vue.component('non-operation-list', __webpack_require__(197));
Vue.component('investigation-list', __webpack_require__(200));
Vue.component('input-rows', __webpack_require__(55));
Vue.component('modal-document', __webpack_require__(203));

window.app = new Vue({
    el: '#app',
    data: {
        showAlertbox: false,
        alertboxMessage: "Hello World",
        alertStatus: "warning",
        alertDuration: 5000,
        autosaving: false,

        dialogHeading: 'Wordplease Say',
        dialogMessage: 'Hello world!!',
        dialogButtonLabel: 'OK',

        lastActiveSessionCheck: 0,

        /**
         * Note specific data.
         */
        height: null,
        weight: null,
        GCS_E: null,
        GCS_V: null,
        GCS_M: null
    },
    mounted: function mounted() {
        var _this = this;

        /**
         * Note specific events.
         */
        EventBus.$on('show-child-pugh-score', function () {
            $('#modal-child-pugh-score').modal('show');
        });

        EventBus.$on('comorbid-no-data-all', function () {
            $("input[type=radio][name^=comorbid_]").each(function (index, el) {
                EventBus.$emit(el.name, 255);
            });
        });

        EventBus.$on('comorbid-no-at-all', function () {
            $("input[type=radio][name^=comorbid_]").each(function (index, el) {
                EventBus.$emit(el.name, 0);
            });
        });

        EventBus.$on('append-current-medications', function () {
            EventBus.$emit('set-current-medications', $('#current_medications_helper').val(), 'append');
            $('#current_medications_helper').val('');
            $('#current_medications_helper').focus();
        });

        EventBus.$on('put-current-medications', function () {
            EventBus.$emit('set-current-medications', $('#current_medications_helper').val(), 'put');
            $('#current_medications_helper').val('');
            $('#current_medications_helper').focus();
        });

        EventBus.$on('BMI-updates-height', function (value) {
            _this.height = value;
            _this.calculateBMI();
        });

        EventBus.$on('BMI-updates-weight', function (value) {
            _this.weight = value;
            _this.calculateBMI();
        });

        EventBus.$on('breathing-updates', function (value) {
            if (value == 2 || value == 3) {
                EventBus.$emit('set-o2-rate-rear-addon', 'L/min');
            } else if (value == 4) {
                EventBus.$emit('set-o2-rate-rear-addon', 'FiO<sub>2</sub>');
            }
        });

        EventBus.$on('GCS-updates-E', function (value) {
            _this.calculateGCS(value, 'E');
        });

        EventBus.$on('GCS-updates-V', function (value) {
            _this.calculateGCS(value, 'V');
        });

        EventBus.$on('GCS-updates-M', function (value) {
            _this.calculateGCS(value, 'M');
        });

        /**
         * Common events.
         */

        EventBus.$on('show-alert', function (message, status) {
            var duration = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 5000;

            if (!_this.showAlertbox) {
                _this.alertboxMessage = message;
                _this.alertStatus = status;
                _this.alertDuration = duration;
                _this.showAlertbox = true;
            }
        });

        EventBus.$on('close-alert', function () {
            _this.showAlertbox = false;
        });

        EventBus.$on('error-419', function () {
            _this.dialogHeading = 'Attention please !!';
            _this.dialogMessage = 'Your are now logged off, Please reload this page or loss your data.';
            _this.dialogButtonLabel = 'Got it';
            $('#modal-dialog').modal('show');
        });

        EventBus.$on('autosave', function (field, value, ref) {
            _this.autosaving = true;
            axios.post('/autosave', JSON.parse('{"' + field + '": ' + JSON.stringify(value) + '}')).then(function (response) {
                console.log(response.data);
                // remove timeout later
                setTimeout(function () {
                    _this.autosaving = false;
                }, 1000);
            }).catch(function (error) {
                _this.autosaving = false;
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);
                    console.log(error.response.headers);
                    if (error.response.status == 419) {
                        EventBus.$emit('error-419');
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

        this.lastActiveSessionCheck = Date.now();
        $(window).on("focus", function (e) {
            var timeDiff = Date.now() - _this.lastActiveSessionCheck;
            if (timeDiff > 1000 * 60 * 60) {
                axios.get('/is-session-active').then(function (response) {
                    if (response.data.active) {
                        _this.lastActiveSessionCheck = Date.now();
                    } else {
                        EventBus.$emit('error-419');
                    }
                });
            }
        });
    },

    methods: {
        /**
         * Note specific methods.
         */
        calculateBMI: function calculateBMI() {
            var BMI = void 0;
            if ($.isNumeric(this.height) && $.isNumeric(this.weight)) {
                BMI = (this.weight / (this.height / 100 * (this.height / 100))).toPrecision(4);
            } else {
                BMI = '';
            }
            EventBus.$emit('BMI-updates', BMI);
        },
        calculateGCS: function calculateGCS(value, factor) {
            var score = value === null ? null : parseInt(value.split(' ')[0].replace('[', '').replace(']', ''));
            if (factor == 'E') {
                this.GCS_E = score;
            } else if (factor == 'V') {
                this.GCS_V = score;
            } else {
                this.GCS_M = score;
            }

            if ($.isNumeric(this.GCS_E) && $.isNumeric(this.GCS_V) && $.isNumeric(this.GCS_M)) {
                var sum = this.GCS_E + this.GCS_V + this.GCS_M;
                var gcs = void 0,
                    gcsLabel = void 0;
                if (sum < 9) {
                    gcs = 3;
                    gcsLabel = 'Severe [GCS < 9]';
                } else if (sum < 13) {
                    gcs = 2;
                    gcsLabel = 'Moderate [9 <= GCS < 13]';
                } else {
                    gcs = 1;
                    gcsLabel = 'Minor [13 <= GCS <= 15]';
                }

                EventBus.$emit('GCS-updated', gcsLabel);
            } else {
                EventBus.$emit('GCS-updated', null);
            }
        }
    }
});

/**
 * Note specific scripts.
 */
// seem like jQuery not support ES6 syntax so, code jQuery in ES5
$(function () {
    $('span.estimated').click(function () {
        $('input[name=' + $(this).attr('data-target') + ']').click();
    });

    $('span.estimated').mouseover(function () {
        $(this).css({ 'cursor': 'pointer', 'font-style': 'italic' });
    });

    $('span.estimated').mouseout(function () {
        $(this).css({ 'cursor': '', 'font-style': '' });
    });

    $('input[name^=estimated_]').click(function () {
        EventBus.$emit('autosave', $(this).attr('name'), $(this).prop('checked'));
    });
});
/* WEBPACK VAR INJECTION */}.call(exports, __webpack_require__(1)))

/***/ }),
/* 142 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(143)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(145)
/* template */
var __vue_template__ = __webpack_require__(146)
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
Component.options.__file = "resources/assets/js/components/Alertbox.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-221a90a6", Component.options)
  } else {
    hotAPI.reload("data-v-221a90a6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 143 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(144);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("588ce2c7", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-221a90a6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Alertbox.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-221a90a6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Alertbox.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 144 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n#alert-box {\n    font-size: 1em;\n    width: 400px;\n    position: fixed;\n    top: 105px;\n    right: 15px;\n    z-index:10;\n}\n#alert-icon {\n    font-size:2em;\n    float:left;\n    margin-right: .5em;\n}\n", ""]);

// exports


/***/ }),
/* 145 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['message', 'status', 'duration'],
    data: function data() {
        return {
            class: "alert alert-dismissible fade in alert-" + this.status,
            icon: ''
        };
    },
    mounted: function mounted() {
        this.timer = setTimeout(function () {
            EventBus.$emit('close-alert');
        }, this.duration);
        this.setIcon();
    },

    methods: {
        noShow: function noShow() {
            clearTimeout(this.timer);
            EventBus.$emit('close-alert');
        },
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
    }
});

/***/ }),
/* 146 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("transition", { attrs: { name: "slide-fade" } }, [
    _c(
      "div",
      { class: this.class, attrs: { role: "alert", id: "alert-box" } },
      [
        _c(
          "button",
          {
            staticClass: "close",
            attrs: { type: "button", "aria-label": "Close" },
            on: {
              click: function($event) {
                _vm.noShow()
              }
            }
          },
          [
            _c("span", { attrs: { "aria-hidden": "true" } }, [
              _c("span", { staticClass: "fa fa-times-circle" })
            ])
          ]
        ),
        _vm._v(" "),
        _c("span", { class: this.setIcon(), attrs: { id: "alert-icon" } }),
        _vm._v(" "),
        _c("p", { domProps: { innerHTML: _vm._s(_vm.message) } })
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-221a90a6", module.exports)
  }
}

/***/ }),
/* 147 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(148)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(150)
/* template */
var __vue_template__ = __webpack_require__(151)
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
/* 148 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(149);
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
/* 149 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\nbutton {\n    overflow: hidden;\n    outline: none;\n    /*display: block;*/\n    -webkit-user-select: none;\n       -moz-user-select: none;\n        -ms-user-select: none;\n            user-select: none;\n    position: relative;\n    overflow: hidden;\n}\n.circle {\n    /*display: block; */\n    position: absolute;\n    background: rgba(0,0,0,.075);\n    border-radius: 50%;\n    -webkit-transform: scale(0);\n            transform: scale(0);\n}\n.circle.animate {\n    -webkit-animation: effect 0.65s linear;\n            animation: effect 0.65s linear;\n}\n@-webkit-keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n@keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n/* end click effect */\nbutton:focus {\n    outline: none !important;\n}\n.btn-app {\n\n    border-radius: 2px;\n    border: 0;\n    -webkit-transition: .2s ease-out;\n    transition: .2s ease-out;\n    color: #fff;\n    margin-bottom: 10px;\n\n    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    -webkit-transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n    transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n}\n.btn-app:hover {\n    color: #616161 !important;\n\n    -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n    box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n\n    -webkit-transition: color .3s ease-out;\n    transition: color .3s ease-out;\n}\n.btn-app:active, .btn-app:focus, .btn-app.active {\n    outline: 0;\n}\n\n/*draft*/\n.btn-app-draft {\n    color: #636b6f !important;\n    background: #f5f5f5 !important;\n}\n.btn-app-draft:hover, .btn-app-draft:focus {\n    color: #fff !important;\n    background: #eee !important;\n}\n.btn-app-draft.active {\n    color: #fff !important;\n    background: #eee !important;\n}\n\n/*Default*/\n.btn-app-default {\n    color: #fff !important;\n    background: #2BBBAD !important;\n}\n.btn-app-default:hover, .btn-app-default:focus {\n    background: #30cfc0 !important;\n}\n.btn-app-default.active {\n    background: #186860 !important;\n}\n\n/*Primary*/\n.btn-app-primary {\n    background: #4285F4 !important;\n}\n.btn-app-primary:hover, .btn-app-primary:focus {\n    background-color: #5a95f5 !important;\n}\n.btn-app-primary.active {\n    background-color: #0b51c5 !important;\n}\n\n/*Secondary*/\n.btn-app-secondary {\n    background-color: #aa66cc !important;\n}\n.btn-app-secondary:hover, .btn-app-secondary:focus {\n    background-color: #b579d2 !important;\n    color: #fff;\n}\n.btn-app-secondary.active {\n    background-color: #773399 !important;\n}\n.btn-app-secondary.active:hover {\n    color: #fff;\n}\n\n/*Success*/\n.btn-app-success {\n    background: #00C851;\n}\n.btn-app-success:hover, .btn-app-success:focus {\n    background-color: #00d255 !important;\n}\n.btn-app-success.active {\n    background-color: #006228 !important;\n}\n\n/*Info*/\n.btn-app-info {\n    background: #33b5e5;\n}\n.btn-app-info:hover, .btn-app-info:focus {\n    background-color: #4abde8 !important;\n}\n.btn-app-info.active {\n    background-color: #14799e !important;\n}\n\n/*Warning*/\n.btn-app-warning {\n    background: #FF8800;\n}\n.btn-app-warning:hover, .btn-app-warning:focus {\n    background-color: #ff961f !important;\n}\n.btn-app-warning.active {\n    background-color: #cc8800 !important;\n}\n\n/*Danger*/\n.btn-app-danger {\n    background: #CC0000;\n}\n.btn-app-danger:hover, .btn-app-danger:focus {\n    background-color: #db0000 !important;\n}\n.btn-app-danger.active {\n    background-color: maroon !important;\n}\n\n/*Link*/\n.btn-app-link {\n    background-color: transparent;\n    color: #000;\n}\n.btn-app-link:hover, .btn-app-link:focus {\n    background-color: transparent;\n    color: #000;\n}\n", ""]);

// exports


/***/ }),
/* 150 */
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
/* 151 */
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
/* 152 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(153)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(155)
/* template */
var __vue_template__ = __webpack_require__(156)
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
Component.options.__file = "resources/assets/js/components/ModalDialog.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6f50a124", Component.options)
  } else {
    hotAPI.reload("data-v-6f50a124", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 153 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(154);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("45fb0318", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f50a124\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModalDialog.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-6f50a124\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModalDialog.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 154 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.modal {\n  text-align: center;\n  padding: 0!important;\n}\n.modal:before {\n  content: '';\n  display: inline-block;\n  height: 100%;\n  vertical-align: middle;\n  margin-right: -4px;\n}\n.modal-dialog {\n  display: inline-block;\n  text-align: left;\n  vertical-align: middle;\n}\n", ""]);

// exports


/***/ }),
/* 155 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['heading', 'message', 'buttonLabel']
});

/***/ }),
/* 156 */
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
            _c("div", { staticClass: "modal-footer" }, [
              _c(
                "button",
                {
                  staticClass: "btn btn-default",
                  attrs: { "data-dismiss": "modal" }
                },
                [_vm._v(_vm._s(_vm.buttonLabel))]
              )
            ])
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
    require("vue-hot-reload-api")      .rerender("data-v-6f50a124", module.exports)
  }
}

/***/ }),
/* 157 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(158)
/* template */
var __vue_template__ = __webpack_require__(159)
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
Component.options.__file = "resources/assets/js/components/EditNoteNavbar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7fe5ff7a", Component.options)
  } else {
    hotAPI.reload("data-v-7fe5ff7a", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 158 */
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
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['noteName', 'patientData', 'username', 'showSaving'],
    data: function data() {
        return {
            actions: [{ link: '/apple', label: '<i class="fa fa-save"></i> & Stay' }, { link: '/oppo', label: '<i class="fa fa-save"></i> & New note' }, { link: '/samsung', label: '<i class="fa fa-save"></i> & logout' }]
        };
    }
});

/***/ }),
/* 159 */
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
        _c("a", { staticClass: "navbar-brand", attrs: { href: "/notes" } }, [
          _vm._v(_vm._s(_vm.noteName))
        ]),
        _vm._v(" "),
        _c(
          "a",
          {
            staticClass: "navbar-brand active",
            domProps: { innerHTML: _vm._s(_vm.patientData) }
          },
          [_c("span", { staticClass: "sr-only" }, [_vm._v("(current)")])]
        )
      ]),
      _vm._v(" "),
      _c(
        "div",
        {
          staticClass: "collapse navbar-collapse",
          attrs: { id: "navbar-function-list" }
        },
        [
          _c("ul", { staticClass: "nav navbar-nav" }, [
            _vm._m(1),
            _vm._v(" "),
            _c(
              "li",
              {
                directives: [
                  {
                    name: "show",
                    rawName: "v-show",
                    value: _vm.showSaving,
                    expression: "showSaving"
                  }
                ]
              },
              [_vm._m(2)]
            )
          ]),
          _vm._v(" "),
          _c(
            "appbar-right",
            { attrs: { username: _vm.username } },
            _vm._l(_vm.actions, function(action) {
              return _c("li", [
                _c("a", {
                  attrs: { href: action.link },
                  domProps: { innerHTML: _vm._s(action.label) }
                })
              ])
            })
          )
        ],
        1
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
          "data-target": "#navbar-function-list",
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
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", [
      _c("a", { attrs: { href: "" } }, [
        _c("i", { staticClass: "fa fa-globe" }),
        _vm._v(" Publish")
      ])
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("a", [
      _vm._v(" saving "),
      _c("i", { staticClass: "fa fa-circle-o-notch fa-spin fa-fw" })
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-7fe5ff7a", module.exports)
  }
}

/***/ }),
/* 160 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(161)
/* template */
var __vue_template__ = __webpack_require__(162)
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
Component.options.__file = "resources/assets/js/components/AppbarRight.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-024aa183", Component.options)
  } else {
    hotAPI.reload("data-v-024aa183", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 161 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: ['username'],
    data: function data() {
        return {
            actions: []
        };
    },
    mounted: function mounted() {
        var _this = this;

        axios.get('/get-actions').then(function (response) {
            _this.actions = response.data;
        }).catch(function (error) {
            console.log(error);
        });
    }
});

/***/ }),
/* 162 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "ul",
    { staticClass: "nav navbar-nav navbar-right" },
    [
      _vm._t("default"),
      _vm._v(" "),
      _c("li", { staticClass: "active" }, [
        _c("a", { attrs: { role: "button" } }, [_vm._v(_vm._s(_vm.username))])
      ]),
      _vm._v(" "),
      _vm._m(0)
    ],
    2
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("li", { staticClass: "hvr-bounce-to-top" }, [
      _c("a", { attrs: { href: "/logout" } }, [
        _c("span", { staticClass: "fa fa-sign-out" })
      ])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-024aa183", module.exports)
  }
}

/***/ }),
/* 163 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(164)
/* template */
var __vue_template__ = __webpack_require__(165)
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
Component.options.__file = "resources/assets/js/components/InputSuggestion.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6e57ed87", Component.options)
  } else {
    hotAPI.reload("data-v-6e57ed87", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 164 */
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
            lastData: ''
        };
    },
    mounted: function mounted() {
        var _this = this;

        // initial data
        if (this.value === undefined) this.lastData = this.userInput = '';else this.lastData = this.userInput = this.value;

        // listen to event to trigger event
        // if (this.interfaceEvent !== undefined) {
        //     EventBus.$on(this.interfaceEvent, () => {
        //         this.emitUpdate()
        //     })
        // }

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
            }
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
/* 165 */
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
            { staticClass: "control-label", attrs: { for: _vm.id } },
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
            blur: function($event) {
              _vm.autosave()
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
    require("vue-hot-reload-api")      .rerender("data-v-6e57ed87", module.exports)
  }
}

/***/ }),
/* 166 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(167)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(169)
/* template */
var __vue_template__ = __webpack_require__(170)
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
Component.options.__file = "resources/assets/js/components/InputSelect.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-43dd6c02", Component.options)
  } else {
    hotAPI.reload("data-v-43dd6c02", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 167 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(168);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("154032c5", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-43dd6c02\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputSelect.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-43dd6c02\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputSelect.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 168 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.cursor-pointer {\n    cursor:pointer;\n}\n", ""]);

// exports


/***/ }),
/* 169 */
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
            type: String,
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
            console.log(this.field + ' need sync');
        }

        if (this.value === undefined) this.lastData = this.userInput = null;else this.lastData = this.userInput = this.value;

        this.showReset = this.value !== undefined;

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
/* 170 */
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
            { staticClass: "control-label", attrs: { for: _vm.field } },
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
    require("vue-hot-reload-api")      .rerender("data-v-43dd6c02", module.exports)
  }
}

/***/ }),
/* 171 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(172)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(174)
/* template */
var __vue_template__ = __webpack_require__(175)
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
Component.options.__file = "resources/assets/js/components/InputTextarea.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-25dfe306", Component.options)
  } else {
    hotAPI.reload("data-v-25dfe306", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 172 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(173);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("4d5f3e50", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-25dfe306\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextarea.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-25dfe306\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextarea.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 173 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.fix-margin {\n    margin-top: .3em;\n}\n.textarea-warning {\n    /*Important stuff here*/\n    -webkit-transition: flash-warning 3s ease-out;\n    transition: flash-warning 3s ease-out;\n    -webkit-animation: flash-warning 3s forwards linear normal;\n            animation: flash-warning 3s forwards linear normal;\n}\n@-webkit-keyframes flash-warning {\n0% {\n        background:#fff;\n}\n50% {\n        background:#f0ad4e;\n}\n100% {\n        background:#fff;\n}\n}\n@keyframes flash-warning {\n0% {\n        background:#fff;\n}\n50% {\n        background:#f0ad4e;\n}\n100% {\n        background:#fff;\n}\n}\n.textarea-danger {\n    /*Important stuff here*/\n    -webkit-transition: flash-danger 3s ease-out;\n    transition: flash-danger 3s ease-out;\n    -webkit-animation: flash-danger 3s forwards linear normal;\n            animation: flash-danger 3s forwards linear normal;\n}\n@-webkit-keyframes flash-danger {\n0% {\n        background:#fff;\n}\n50% {\n        background:#d9534f;\n}\n100% {\n        background:#fff;\n}\n}\n@keyframes flash-danger {\n0% {\n        background:#fff;\n}\n50% {\n        background:#d9534f;\n}\n100% {\n        background:#fff;\n}\n}\n", ""]);

// exports


/***/ }),
/* 174 */
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
            if (this.userInput.length == this.getMaxChars) {
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
/* 175 */
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
    require("vue-hot-reload-api")      .rerender("data-v-25dfe306", module.exports)
  }
}

/***/ }),
/* 176 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(177)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(179)
/* template */
var __vue_template__ = __webpack_require__(180)
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
Component.options.__file = "resources/assets/js/components/InputRadio.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-5494d748", Component.options)
  } else {
    hotAPI.reload("data-v-5494d748", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 177 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(178);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("e9aaa400", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5494d748\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRadio.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-5494d748\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRadio.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 178 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\ndiv.extra {\n    font-style: italic;\n    color: #757575;\n}\n", ""]);

// exports


/***/ }),
/* 179 */
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
            type: String,
            required: false
        },
        // tooltip for label.
        labelDescription: {
            type: String,
            required: false
        },
        // string in form of json {"emit": "", "icon": "", "title": "" }.
        labelAction: {
            type: String,
            required: false
        },
        // string in form fo array of json [{"label": "","value": ""},{...}].
        options: {
            type: String,
            required: true
        },
        // value to trigger extra content.
        triggerValue: {
            type: String,
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
            if (this.field !== undefined) EventBus.$emit('autosave', this.field, this.currentValue);
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

                if (this.emitOnUpdate !== undefined) {
                    EventBus.$emit(this.emitOnUpdate, this.currentValue);
                }
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
        JSON.parse(this.options).forEach(function (option) {
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
                EventBus.$emit('show-alert', _this.label.replace(' :', '') + ' also checked', 'success');
            });
        }

        if (this.value !== undefined) {

            this.currentValue = this.value;

            this.showReset = true;

            if (this.value == this.triggerValue) {
                this.showExtra = true;
            }
        }

        if (this.needSync !== undefined) {
            console.log(this.field + ' need sync');
        }
    },

    computed: {
        // check if has content in default slot.
        hasDefaultSlot: function hasDefaultSlot() {
            return !!this.$slots.default;
        },

        // extract label action emit event name.
        labelActionEmitEventName: function labelActionEmitEventName() {
            if (this.labelAction !== undefined) {
                return JSON.parse(this.labelAction).emit;
            }
            return '';
        },

        // extract label action icon.
        labelActionIcon: function labelActionIcon() {
            if (this.labelAction !== undefined) {
                return 'fa fa-' + JSON.parse(this.labelAction).icon;
            }
            return '';
        },

        // extract label action icon title.
        labelActionTitle: function labelActionTitle() {
            if (this.labelAction !== undefined) {
                return JSON.parse(this.labelAction).title;
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
/* 180 */
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
          _vm._l(JSON.parse(_vm.options), function(option) {
            return _c("label", { staticClass: "radio-inline" }, [
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
            ])
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
    require("vue-hot-reload-api")      .rerender("data-v-5494d748", module.exports)
  }
}

/***/ }),
/* 181 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(182)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(184)
/* template */
var __vue_template__ = __webpack_require__(185)
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
Component.options.__file = "resources/assets/js/components/InputCheck.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-b3a94c56", Component.options)
  } else {
    hotAPI.reload("data-v-b3a94c56", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 182 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(183);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("2fb67662", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b3a94c56\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputCheck.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-b3a94c56\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputCheck.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 183 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\nlabel.material-checkbox-group-label {\n    font-weight: normal !important;\n}\n.clear-padding {\n    padding-left: 0px!important;\n    margin-right: 5px!important;\n}\nlabel.underline-animate:hover {\n    font-style: italic;\n}\n.underline-animate:after {\n    content: '';\n    position: absolute;\n    bottom: 0;\n    left: 0;\n    width: 0%;\n    border-bottom: 3px solid #636b6f;\n    -webkit-transition: 0.4s;\n    transition: 0.4s;\n}\n.underline-animate:hover:after {\n    width: 100%;\n}\n.material-checkbox-group-label {\n    position: relative;\n    display: block;\n    cursor: pointer;\n    height: 15px;\n    line-height: 15px;\n    /*padding-left: 25px;*/\n    padding-left: 20px; /* between control and label */\n}\n.material-checkbox-group-label:after { /*check marker*/\n    content: \"\";\n    display: block;\n    /*width: 4px;*/\n    width: 3px;\n    /*height: 12px;*/\n    height: 9px;\n    opacity: .9;\n    border-right: 2px solid #eee;\n    border-top: 2px solid #eee;\n    position: absolute;\n    /*left: 4px;*/\n    left: 3px;\n    /*top: 12px;*/\n    top: 9px;\n    -webkit-transform: scaleX(-1) rotate(135deg);\n    transform: scaleX(-1) rotate(135deg);\n    -webkit-transform-origin: left top;\n    transform-origin: left top;\n}\n.material-checkbox-group-label:before {\n    content: \"\";\n    display: block;\n    border: 2px solid;\n    /*width: 20px;*/\n    width: 15px;\n    /*height: 20px;*/\n    height: 15px;\n    position: absolute;\n    left: 0;\n}\n.material-checkbox-group-label {\n    /*font-size: 14px;*/\n    -webkit-user-select: none;\n    -moz-user-select: none;\n    -ms-user-select: none;\n}\n.material-checkbox:disabled ~ .material-checkbox-group-label {\n    cursor: no-drop;\n}\n.material-checkbox {\n    display: none;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {\n    -webkit-animation: check 0.8s;\n    animation: check 0.8s;\n    opacity: 1;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #636b6f;\n}\n.material-checkbox-group .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #eee;\n}\n.material-checkbox-group .material-checkbox-group-label:before {\n    border-color: #636b6f;\n}\n.material-checkbox:disabled ~ .material-checkbox-group-label {\n    color: #eee;\n}\n.material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #4092d9;\n}\n.material-checkbox-group_primary .material-checkbox-group-label:before {\n    border-color: #4092d9;\n}\n.material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #68c368;\n}\n.material-checkbox-group_success .material-checkbox-group-label:before {\n    border-color: #68c368;\n}\n.material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #8bdaf2;\n}\n.material-checkbox-group_info .material-checkbox-group-label:before {\n    border-color: #8bdaf2;\n}\n.material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #f2a12e;\n}\n.material-checkbox-group_warning .material-checkbox-group-label:before {\n    border-color: #f2a12e;\n}\n.material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:after {\n    border-color: #fff;\n}\n.material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group-label:before {\n    background-color: #f3413c;\n}\n.material-checkbox-group_danger .material-checkbox-group-label:before {\n    border-color: #f3413c;\n}\n@-webkit-keyframes check {\n0% {\n        height: 0;\n        width: 0;\n}\n25% {\n        height: 0;\n        /*width: 4px;*/\n        width: 3px;\n}\n50% {\n        /*height: 12px;*/\n        height: 9px;\n        /*width: 4px;*/\n        width: 3px;\n}\n}\n@keyframes check {\n0% {\n        height: 0;\n        width: 0;\n}\n25% {\n        height: 0;\n        /*width: 4px;*/\n        width: 3px;\n}\n50% {\n        /*height: 12px;*/\n        height: 9px;\n        /*width: 4px;*/\n        width: 3px;\n}\n}\n", ""]);

// exports


/***/ }),
/* 184 */
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
            type: String,
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
            // this element checked state ['checked' or ''].
            thisChecked: ''
        };
    },
    mounted: function mounted() {
        var _this = this;

        // render checked state or not.
        this.thisChecked = this.checked === undefined ? '' : this.checked;

        // init BT tooltip if labelDescription available.
        if (this.labelDescription !== undefined) {
            $('a[title="' + this.labelDescription + '"]').tooltip();
        }

        if (this.setterEvent !== undefined) {
            EventBus.$on(this.setterEvent, function (value) {
                if (value != _this.thisChecked) {
                    _this.thisChecked = value;
                    _this.autosave();
                }
            });
        }

        if (this.needSync !== undefined) {
            console.log(this.field + ' need sync');
        }
    },

    methods: {
        // handle check event.
        check: function check() {
            var _this2 = this;

            this.thisChecked = this.thisChecked == '' ? 'checked' : '';

            this.autosave();

            if (this.emitOnUpdate !== undefined) {
                this.emitEvents.forEach(function (event) {
                    // [name][mode 1:checked 2:unchecked][value]
                    if (event[1] == _this2.thisChecked) {
                        EventBus.$emit(event[0], event[2]);
                    }
                });
            }
        },
        autosave: function autosave() {
            if (this.field !== undefined) EventBus.$emit('autosave', this.field, this.thisChecked.length > 0);
        }
    },
    computed: {
        emitEvents: function emitEvents() {
            if (typeof this.emitOnUpdate == 'String') {
                return JSON.parse(this.emitOnUpdate);
            }
            return this.emitOnUpdate;
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 185 */
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
          domProps: { checked: _vm.thisChecked },
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
            _vm._v(
              "\n               " + _vm._s(_vm.label) + "\n               "
            ),
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
    require("vue-hot-reload-api")      .rerender("data-v-b3a94c56", module.exports)
  }
}

/***/ }),
/* 186 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(187)
/* template */
var __vue_template__ = __webpack_require__(188)
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
Component.options.__file = "resources/assets/js/components/InputCheckGroup.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f2606f4c", Component.options)
  } else {
    hotAPI.reload("data-v-f2606f4c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 187 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
    // props: ['label','checks', 'needSync']
    props: {
        label: {
            type: String,
            required: false
        },
        // JSON input-check excluded needSync
        checks: {
            type: String,
            required: true
        },
        // need to sync value with database on render or not ['needSync' or undefined].
        needSync: {
            type: String,
            required: false
        }
    }
});

/***/ }),
/* 188 */
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
      _vm._l(JSON.parse(_vm.checks), function(check) {
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
    require("vue-hot-reload-api")      .rerender("data-v-f2606f4c", module.exports)
  }
}

/***/ }),
/* 189 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(190)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(192)
/* template */
var __vue_template__ = __webpack_require__(193)
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
Component.options.__file = "resources/assets/js/components/InputTextAddon.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-647635e0", Component.options)
  } else {
    hotAPI.reload("data-v-647635e0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 190 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(191);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("54d761c9", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647635e0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextAddon.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-647635e0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextAddon.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 191 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.add-margin-bottom {\n    margin-bottom: 3px;\n}\n.invalid-input {\n    color: #fff;\n    background:#d9534f;\n}\n", ""]);

// exports


/***/ }),
/* 192 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {var _props;

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    props: (_props = {
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
        }
    }, _defineProperty(_props, 'placeholder', {
        type: String,
        required: false
    }), _defineProperty(_props, 'frontAddon', {
        type: String,
        required: false
    }), _defineProperty(_props, 'rearAddon', {
        type: String,
        required: false
    }), _defineProperty(_props, 'emitOnUpdate', {

        required: false
    }), _defineProperty(_props, 'setterEvent', {
        type: String,
        required: false
    }), _defineProperty(_props, 'setterFrontAddon', {
        type: String,
        required: false
    }), _defineProperty(_props, 'setterRearAddon', {
        type: String,
        required: false
    }), _defineProperty(_props, 'pattern', {
        type: String,
        required: false
    }), _defineProperty(_props, 'invalidText', {
        type: String,
        required: false
    }), _props),
    data: function data() {
        return {
            userInput: '',
            lastSave: '',
            frontAddonHtml: '',
            rearAddonHtml: '',
            inputClass: 'form-control'
        };
    },
    mounted: function mounted() {
        var _this = this;

        // init label tooltip if available.
        if (this.labelDescription !== undefined) {
            $('a[title="' + this.labelDescription + '"]').tooltip();
        }

        if (this.setterEvent !== undefined) {
            EventBus.$on(this.setterEvent, function (value) {
                if (value != _this.userInput) {
                    _this.userInput = value;
                    _this.autosave();
                }
            });
        }

        if (this.rearAddon !== undefined) {
            this.rearAddonHtml = this.rearAddon;
        }

        if (this.frontAddon !== undefined) {
            this.frontAddonHtml = this.frontAddon;
        }

        if (this.setterRearAddon !== undefined) {
            EventBus.$on(this.setterRearAddon, function (html) {
                _this.rearAddonHtml = html;
            });
        }

        if (this.setterFrontAddon !== undefined) {
            EventBus.$on(this.setterFrontAddon, function (html) {
                _this.frontAddonHtml = html;
            });
        }

        if (this.needSync !== undefined) {
            console.log(this.field + ' need sync');
        }

        if (this.value === undefined) this.lastSave = this.userInput = '';else this.lastSave = this.userInput = this.value;

        if (this.frontAddon !== undefined && this.frontAddon.search('data-toggle="tooltip"') >= 0) {
            setTimeout(function () {
                $('span.input-group-addon a[data-toggle=tooltip]').tooltip();
            }, 100);
        } else {
            if (this.rearAddon !== undefined && this.rearAddon.search('data-toggle="tooltip"') >= 0) {
                setTimeout(function () {
                    $('span.input-group-addon a[data-toggle=tooltip]').tooltip();
                }, 100);
            }
        }

        if (this.pattern !== undefined) {
            $(this.inputDom).tooltip({
                placement: "bottom",
                trigger: "hover",
                delay: { "show": 100, "hide": 500 }
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
        oninput: function oninput() {
            var _this2 = this;

            if (this.emitOnUpdateEvents !== null) {
                this.emitOnUpdateEvents.forEach(function (event) {
                    EventBus.$emit(event, _this2.userInput);
                });
            }
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
                return 'form-group add-margin-bottom';
            }
            return 'form-group-sm add-margin-bottom';
        },
        componentGrid: function componentGrid() {
            if (this.grid === undefined) {
                return '';
            }
            var grid = this.grid.split('-');
            return 'col-xs-' + grid[0] + ' col-sm-' + grid[1] + ' col-md-' + grid[2];
        },
        emitOnUpdateEvents: function emitOnUpdateEvents() {
            if (this.emitOnUpdate !== undefined) {
                return JSON.parse(this.emitOnUpdate);
            }
            return null;
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
/* 193 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { class: _vm.componentGrid }, [
    _c("div", { class: _vm.componentSize }, [
      _vm.hasLabel
        ? _c(
            "label",
            { staticClass: "control-label", attrs: { for: _vm.field } },
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
      _c("div", { staticClass: "input-group" }, [
        _vm.frontAddon !== undefined
          ? _c("span", {
              staticClass: "input-group-addon",
              domProps: { innerHTML: _vm._s(_vm.frontAddonHtml) }
            })
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
          attrs: {
            type: "text",
            readonly: _vm.readonly,
            placeholder: _vm.placeholder,
            name: _vm.field,
            id: _vm.field
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
              _vm.onblur()
            }
          }
        }),
        _vm._v(" "),
        _vm.rearAddon !== undefined
          ? _c("span", {
              staticClass: "input-group-addon",
              domProps: { innerHTML: _vm._s(_vm.rearAddonHtml) }
            })
          : _vm._e()
      ])
    ])
  ])
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-647635e0", module.exports)
  }
}

/***/ }),
/* 194 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(195)
/* template */
var __vue_template__ = __webpack_require__(196)
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
Component.options.__file = "resources/assets/js/components/inputs/InputLoggable.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-24ee93b8", Component.options)
  } else {
    hotAPI.reload("data-v-24ee93b8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 195 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        field: {
            type: String,
            required: true
        },
        label: {
            type: String,
            required: true
        },
        value: {
            type: String,
            required: true
        }
    },
    data: function data() {
        return {
            quote: null,
            tmpQuote: null,
            currentChange: 0,
            dragging: false,
            changes: [{ old: null, new: null }]
        };
    },

    methods: {
        onselect: function onselect() {
            if (this.dragging) {
                var item = {
                    old: window.getSelection().toString(),
                    new: this.changes[this.currentChange].new
                };
                this.changes.splice(this.currentChange, 1, item);
                autosize($('textarea'));
            }
        },
        mouseup: function mouseup() {
            this.dragging = false;
            this.updateQuote();
        },
        updateQuote: function updateQuote() {
            var newQuote = this.tmpQuote;
            this.changes.forEach(function (item, index) {
                newQuote = newQuote.replace(item.old, '<del>' + item.old + '</del>');
            });
            this.quote = newQuote;
        }
    },
    mounted: function mounted() {
        var _this = this;

        this.quote = this.value;
        this.tmpQuote = this.quote;

        EventBus.$on('delete-' + this.field + '-change', function (index) {
            if (_this.changes.length == 1) {
                _this.changes.pop();
                _this.changes.push({ old: null, new: null });
            } else {
                _this.changes.splice(index, 1);
            }
            _this.updateQuote();
            _this.currentChange = 0;
        });

        EventBus.$on('new-' + this.field + '-change', function () {
            _this.changes.push({ old: null, new: null });
            _this.currentChange = _this.changes.length - 1;
        });

        EventBus.$on('set-' + this.field + '-change', function (text) {
            if (_this.changes[_this.currentChange].new == null || _this.changes[_this.currentChange].new == '') {
                _this.changes[_this.currentChange].new = text;
            } else {
                _this.changes[_this.currentChange].new += '\n' + text;
            }
        });

        autosize($('textarea'));
    },
    updated: function updated() {
        autosize.update($('textarea'));
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 196 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "material-box" },
    [
      _vm._m(0),
      _vm._v(" "),
      _c("blockquote", {
        domProps: { innerHTML: _vm._s(_vm.quote) },
        on: {
          mousemove: _vm.onselect,
          mousedown: function($event) {
            _vm.dragging = true
          },
          mouseup: _vm.mouseup
        }
      }),
      _vm._v(" "),
      _c(
        "transition-group",
        { attrs: { name: "slide-fade", tag: "div" } },
        _vm._l(_vm.changes, function(change, index) {
          return _c("div", { key: index, staticClass: "row" }, [
            _c("div", { staticClass: "col-xs-12" }, [
              _c("div", { staticClass: "form-group-sm" }, [
                _c("textarea", {
                  directives: [
                    {
                      name: "model",
                      rawName: "v-model",
                      value: change.old,
                      expression: "change.old"
                    }
                  ],
                  staticClass: "form-control",
                  attrs: { readonly: "", rows: "1" },
                  domProps: { value: change.old },
                  on: {
                    input: function($event) {
                      if ($event.target.composing) {
                        return
                      }
                      _vm.$set(change, "old", $event.target.value)
                    }
                  }
                })
              ])
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12" }, [
              _c("hr", { staticClass: "line" })
            ]),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "col-xs-10",
                staticStyle: { "padding-right": "5px" }
              },
              [
                _c("div", { staticClass: "form-group-sm" }, [
                  _c("textarea", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: change.new,
                        expression: "change.new"
                      }
                    ],
                    staticClass: "form-control",
                    attrs: { rows: "1" },
                    domProps: { value: change.new },
                    on: {
                      click: function($event) {
                        _vm.currentChange = index
                      },
                      input: function($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.$set(change, "new", $event.target.value)
                      }
                    }
                  })
                ])
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-2", staticStyle: { padding: "5px" } },
              [
                _c("button-app", {
                  attrs: {
                    action: {
                      event: "delete-" + _vm.field + "-change",
                      value: index
                    },
                    status: "danger",
                    label: "<span class='fa fa-trash-o'></span>",
                    size: "sm"
                  }
                }),
                _vm._v(" "),
                index == _vm.currentChange
                  ? _c("button-app", {
                      attrs: {
                        action: "",
                        status: "info",
                        label: "<span class='fa fa-cog fa-spin fa-fw'></span>",
                        size: "sm"
                      }
                    })
                  : _vm._e()
              ],
              1
            )
          ])
        })
      ),
      _vm._v(" "),
      _c("button-app", {
        attrs: {
          action: "new-" + _vm.field + "-change",
          status: "primary",
          label:
            "<span class='fa fa-pencil-square-o'></span><span class='fa fa-plus-circle'></span>",
          size: "lg"
        }
      })
    ],
    1
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("label", [_c("i", [_vm._v("Quote :")])])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-24ee93b8", module.exports)
  }
}

/***/ }),
/* 197 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(198)
/* template */
var __vue_template__ = __webpack_require__(199)
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
Component.options.__file = "resources/assets/js/components/helpers/medicine/NonOperationList.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-4901a49c", Component.options)
  } else {
    hotAPI.reload("data-v-4901a49c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 198 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__inputs_InputCheck_vue__ = __webpack_require__(36);
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
    data: function data() {
        return {
            checks: [{ label: 'Anti-coagulation', field: 'non_operation_list-Anti-coagulation' }, { label: 'bronchoscope', field: 'non_operation_list-bronchoscope' }, { label: 'CAPD', field: 'non_operation_list-CAPD' }, { label: 'CBI', field: 'non_operation_list-CBI' }, { label: 'change tracheotomy', field: 'non_operation_list-change tracheotomy' }, { label: 'Cpap/Bipap', field: 'non_operation_list-Cpap/Bipap' }, { label: 'CPR', field: 'non_operation_list-CPR' }, { label: 'cryopre/factor VIII', field: 'non_operation_list-cryopre/factor VIII' }, { label: 'Debridement', field: 'non_operation_list-Debridement' }, { label: 'Dressing', field: 'non_operation_list-Dressing' }, { label: 'EGD c biop', field: 'non_operation_list-EGD c biop' }, { label: 'ERCP c stent c dilat', field: 'non_operation_list-ERCP c stent c dilat' }, { label: 'EET on venti>96', field: 'non_operation_list-EET_on_venti>96' }, { label: 'EET on venti<96', field: 'non_operation_list-EET_on_venti<96' }, { label: 'Extract tooth', field: 'non_operation_list-Extract_tooth' }, { label: 'Feeding', field: 'non_operation_list-Feeding' }, { label: 'FFP', field: 'non_operation_list-FFP' }, { label: 'Filling tooth', field: 'non_operation_list-Filling tooth' }, { label: "Foley'cath", field: "non_operation_list-Foley'cath" }, { label: 'Harvest stem cell', field: 'non_operation_list-Harvest stem cell' }, { label: 'HD', field: 'non_operation_list-HD' }, { label: 'holter monitor', field: 'non_operation_list-holter monitor' }, { label: 'Hypothermia', field: 'non_operation_list-Hypothermia' }, { label: 'ICD', field: 'non_operation_list-ICD' }, { label: 'IT Chemo', field: 'non_operation_list-IT Chemo' }, { label: 'IV chemo', field: 'non_operation_list-IV chemo' }, { label: 'IVIG', field: 'non_operation_list-IVIG' }, { label: 'monitor EKG', field: 'non_operation_list-monitor EKG' }, { label: 'NB', field: 'non_operation_list-NB' }, { label: 'NG-lavage', field: 'non_operation_list-NG-lavage' }, { label: 'Off tube', field: 'non_operation_list-Off tube' }, { label: 'percardiocentesis', field: 'non_operation_list-percardiocentesis' }, { label: 'Perm cath/DLC/CLC', field: 'non_operation_list-Perm cath/DLC/CLC' }, { label: 'PFT', field: 'non_operation_list-PFT' }, { label: 'platelets', field: 'non_operation_list-platelets' }, { label: 'platelets pheresis', field: 'non_operation_list-platelets pheresis' }, { label: 'pleurodesis+chemo', field: 'non_operation_list-pleurodesis+chemo' }, { label: 'pleurodesis+talc', field: 'non_operation_list-pleurodesis+talc' }, { label: 'pleurodesis+tetra', field: 'non_operation_list-pleurodesis+tetra' }, { label: 'PRC', field: 'non_operation_list-PRC' }, { label: 'rehabi', field: 'non_operation_list-rehabi' }, { label: 'Rituximab', field: 'non_operation_list-Rituximab' }, { label: 'RT', field: 'non_operation_list-RT' }, { label: 'rtPA', field: 'non_operation_list-rtPA' }, { label: 'Scan', field: 'non_operation_list-Scan' }, { label: 'Suture', field: 'non_operation_list-Suture' }, { label: 'Swan-Ganz', field: 'non_operation_list-Swan-Ganz' }, { label: 'Tap jiont', field: 'non_operation_list-Tap jiont' }, { label: 'TPE', field: 'non_operation_list-TPE' }, { label: 'TPN', field: 'non_operation_list-TPN' }, { label: 'tracheotomy', field: 'non_operation_list-tracheotomy' }, { label: 'U/S doppler', field: 'non_operation_list-U/S doppler' }]
        };
    },
    mounted: function mounted() {
        EventBus.$on('append-non-operation-helper', function () {
            var appendText = '';
            $('[id^=non_operation_list]').each(function (index, item) {
                if ($(item).prop('checked')) {
                    appendText += $(item).prop('id').replace('non_operation_list-', '') + '\n';
                }
            });
            EventBus.$emit('set-non_operation-change', appendText);
            console.log(appendText);
        });
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 199 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "material-box" }, [
    _c(
      "div",
      { staticClass: "row" },
      [
        _vm._m(0),
        _vm._v(" "),
        _vm._l(_vm.checks, function(check) {
          return _c(
            "div",
            { key: check.field, staticClass: "col-xs-6 col-sm-4 col-md-3" },
            [
              _c(
                "div",
                { staticClass: "form-group-sm" },
                [
                  _c("input-check", {
                    attrs: {
                      label: check.label,
                      field: check.field,
                      "no-save": ""
                    }
                  })
                ],
                1
              )
            ]
          )
        }),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-xs-12" },
          [
            _c("button-app", {
              attrs: {
                action: "append-non-operation-helper",
                status: "info",
                label: "Append",
                size: "lg"
              }
            })
          ],
          1
        )
      ],
      2
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-xs-12" }, [
      _c("label", [_c("i", [_vm._v("Non-operation helper :")])])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-4901a49c", module.exports)
  }
}

/***/ }),
/* 200 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(201)
/* template */
var __vue_template__ = __webpack_require__(202)
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
Component.options.__file = "resources/assets/js/components/helpers/medicine/InvestigationList.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-43e779ac", Component.options)
  } else {
    hotAPI.reload("data-v-43e779ac", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 201 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__inputs_InputCheck_vue__ = __webpack_require__(36);
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
    data: function data() {
        return {
            checks: [{ label: 'A-line', field: 'non_operation_list-A-line' }, { label: 'ABG', field: 'non_operation_list-ABG' }, { label: 'Biopsy', field: 'non_operation_list-Biopsy' }, { label: 'CT', field: 'non_operation_list-CT' }, { label: 'CVP', field: 'non_operation_list-CVP' }, { label: 'EEG', field: 'non_operation_list-EEG' }, { label: 'LP', field: 'non_operation_list-LP' }, { label: 'MRI', field: 'non_operation_list-MRI' }, { label: 'NG - Tube', field: 'non_operation_list-NG - Tube' }, { label: 'NP wash', field: 'non_operation_list-NP wash' }, { label: 'OCT', field: 'non_operation_list-OCT' }, { label: 'port A', field: 'non_operation_list-port A' }, { label: 'PR', field: 'non_operation_list-PR' }, { label: 'tap Abd', field: 'non_operation_list-tap Abd' }, { label: 'tap lung', field: 'non_operation_list-tap lung' }, { label: 'TCCD', field: 'non_operation_list-TCCD' }, { label: 'U/S', field: 'non_operation_list-U/S' }]
        };
    },
    mounted: function mounted() {
        EventBus.$on('append-investigation-helper', function () {
            var appendText = '';
            $('[id^=non_operation_list]').each(function (index, item) {
                if ($(item).prop('checked')) {
                    appendText += $(item).prop('id').replace('non_operation_list-', '') + '\n';
                }
            });
            EventBus.$emit('set-investigation-change', appendText);
            console.log(appendText);
        });
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 202 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "material-box" }, [
    _c(
      "div",
      { staticClass: "row" },
      [
        _vm._m(0),
        _vm._v(" "),
        _vm._l(_vm.checks, function(check) {
          return _c(
            "div",
            { key: check.field, staticClass: "col-xs-6 col-sm-4 col-md-3" },
            [
              _c(
                "div",
                { staticClass: "form-group-sm" },
                [
                  _c("input-check", {
                    attrs: {
                      label: check.label,
                      field: check.field,
                      "no-save": ""
                    }
                  })
                ],
                1
              )
            ]
          )
        }),
        _vm._v(" "),
        _c(
          "div",
          { staticClass: "col-xs-12" },
          [
            _c("button-app", {
              attrs: {
                action: "append-investigation-helper",
                status: "info",
                label: "Append",
                size: "lg"
              }
            })
          ],
          1
        )
      ],
      2
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "col-xs-12" }, [
      _c("label", [_c("i", [_vm._v("Investigation helper :")])])
    ])
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-43e779ac", module.exports)
  }
}

/***/ }),
/* 203 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(204)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = null
/* template */
var __vue_template__ = __webpack_require__(206)
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
Component.options.__file = "resources/assets/js/components/ModalDocument.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3e28937e", Component.options)
  } else {
    hotAPI.reload("data-v-3e28937e", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 204 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(205);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("0d556b57", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3e28937e\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModalDocument.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3e28937e\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ModalDocument.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 205 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n#modal-body-child-pugh {\n    font-size: 12pt;\n}\n#modal-body-child-pugh td {\n    padding-left: 5px;\n}\n#modal-body-child-pugh p {\n    padding-top: 5px;\n}\n", ""]);

// exports


/***/ }),
/* 206 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
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
        _c(
          "div",
          { staticClass: "modal-dialog", attrs: { role: "document" } },
          [
            _c("div", { staticClass: "modal-content" }, [
              _c(
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
                    [
                      _c("span", { attrs: { "aria-hidden": "true" } }, [
                        _vm._v("×")
                      ])
                    ]
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
              ),
              _vm._v(" "),
              _c(
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
                      _c(
                        "tr",
                        { staticStyle: { "background-color": "#aad" } },
                        [
                          _c(
                            "th",
                            {
                              staticClass: "text-center",
                              staticStyle: { width: "20%" }
                            },
                            [_vm._v("Measure")]
                          ),
                          _vm._v(" "),
                          _c(
                            "th",
                            {
                              staticClass: "text-center",
                              staticStyle: { width: "10%" }
                            },
                            [_vm._v("1 point")]
                          ),
                          _vm._v(" "),
                          _c(
                            "th",
                            {
                              staticClass: "text-center",
                              staticStyle: { width: "35%" }
                            },
                            [_vm._v("2 points")]
                          ),
                          _vm._v(" "),
                          _c(
                            "th",
                            {
                              staticClass: "text-center",
                              staticStyle: { width: "35%" }
                            },
                            [_vm._v("3 points")]
                          )
                        ]
                      ),
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
                        _c("td", [
                          _vm._v("Grade I-II (or suppressed with medication)")
                        ]),
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
                    _c(
                      "a",
                      { attrs: { title: "Primary sclerosing cholangitis" } },
                      [_vm._v("primary sclerosing cholangitis")]
                    ),
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
              ),
              _vm._v(" "),
              _c("div", { staticClass: "modal-footer" }, [
                _c(
                  "a",
                  {
                    staticClass: "btn btn-default",
                    attrs: { id: "modal-sms-box-btn", "data-dismiss": "modal" }
                  },
                  [_vm._v("OK")]
                )
              ])
            ])
          ]
        )
      ]
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3e28937e", module.exports)
  }
}

/***/ })
],[140]);