webpackJsonp([2],[
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
/* 4 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(16)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(18)
/* template */
var __vue_template__ = __webpack_require__(19)
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
Component.options.__file = "resources\\assets\\js\\components\\buttons\\ButtonApp.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-55e05e8d", Component.options)
  } else {
    hotAPI.reload("data-v-55e05e8d", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
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
/* 12 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(13)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(15)
/* template */
var __vue_template__ = __webpack_require__(20)
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
Component.options.__file = "resources\\assets\\js\\components\\modals\\Dialog.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-75c36dd7", Component.options)
  } else {
    hotAPI.reload("data-v-75c36dd7", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 13 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(14);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("ce34e722", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-75c36dd7\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dialog.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-75c36dd7\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Dialog.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 14 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.modal {\n  text-align: center;\n  padding: 0!important;\n}\n.modal:before {\n  content: '';\n  display: inline-block;\n  height: 100%;\n  vertical-align: middle;\n  margin-right: -4px;\n}\n.modal-dialog {\n  display: inline-block;\n  text-align: left;\n  vertical-align: middle;\n}\n", ""]);

// exports


/***/ }),
/* 15 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__buttons_ButtonApp_vue__ = __webpack_require__(4);
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
/* 16 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(17);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("f700c8a4", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-55e05e8d\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ButtonApp.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-55e05e8d\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ButtonApp.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 17 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\nbutton {\n    overflow: hidden;\n    outline: none;\n    /*display: block;*/\n    -webkit-user-select: none;\n       -moz-user-select: none;\n        -ms-user-select: none;\n            user-select: none;\n    position: relative;\n    overflow: hidden;\n}\n.circle {\n    /*display: block; */\n    position: absolute;\n    background: rgba(0,0,0,.075);\n    border-radius: 50%;\n    -webkit-transform: scale(0);\n            transform: scale(0);\n}\n.circle.animate {\n    -webkit-animation: effect 0.65s linear;\n            animation: effect 0.65s linear;\n}\n@-webkit-keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n@keyframes effect {\n100% {\n        opacity: 0;\n        -webkit-transform: scale(2.5);\n                transform: scale(2.5);\n}\n}\n/* end click effect */\nbutton:focus {\n    outline: none !important;\n}\n.btn-app {\n\n    border-radius: 2px;\n    border: 0;\n    -webkit-transition: .2s ease-out;\n    transition: .2s ease-out;\n    color: #fff;\n    margin-bottom: 10px;\n\n    -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);\n    -webkit-transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n    transition: all 0.3s cubic-bezier(.25,.8,.25,1);\n}\n.btn-app:hover {\n    color: #616161 !important;\n\n    -webkit-box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n    box-shadow: 0 4px 8px rgba(0,0,0,0.25), 0 5px 5px rgba(0,0,0,0.22);\n\n    -webkit-transition: color .3s ease-out;\n    transition: color .3s ease-out;\n}\n.btn-app:active, .btn-app:focus, .btn-app.active {\n    outline: 0;\n}\n\n/*draft*/\n.btn-app-draft {\n    color: #636b6f !important;\n    background: #f5f5f5 !important;\n}\n.btn-app-draft:hover, .btn-app-draft:focus {\n    color: #fff !important;\n    background: #eee !important;\n}\n.btn-app-draft.active {\n    color: #fff !important;\n    background: #eee !important;\n}\n\n/*Default*/\n.btn-app-default {\n    color: #fff !important;\n    background: #2BBBAD !important;\n}\n.btn-app-default:hover, .btn-app-default:focus {\n    background: #30cfc0 !important;\n}\n.btn-app-default.active {\n    background: #186860 !important;\n}\n\n/*Primary*/\n.btn-app-primary {\n    background: #4285F4 !important;\n}\n.btn-app-primary:hover, .btn-app-primary:focus {\n    background-color: #5a95f5 !important;\n}\n.btn-app-primary.active {\n    background-color: #0b51c5 !important;\n}\n\n/*Secondary*/\n.btn-app-secondary {\n    background-color: #aa66cc !important;\n}\n.btn-app-secondary:hover, .btn-app-secondary:focus {\n    background-color: #b579d2 !important;\n    color: #fff;\n}\n.btn-app-secondary.active {\n    background-color: #773399 !important;\n}\n.btn-app-secondary.active:hover {\n    color: #fff;\n}\n\n/*Success*/\n.btn-app-success {\n    background: #00C851;\n}\n.btn-app-success:hover, .btn-app-success:focus {\n    background-color: #00d255 !important;\n}\n.btn-app-success.active {\n    background-color: #006228 !important;\n}\n\n/*Info*/\n.btn-app-info {\n    background: #33b5e5;\n}\n.btn-app-info:hover, .btn-app-info:focus {\n    background-color: #4abde8 !important;\n}\n.btn-app-info.active {\n    background-color: #14799e !important;\n}\n\n/*Warning*/\n.btn-app-warning {\n    background: #FF8800;\n}\n.btn-app-warning:hover, .btn-app-warning:focus {\n    background-color: #ff961f !important;\n}\n.btn-app-warning.active {\n    background-color: #cc8800 !important;\n}\n\n/*Danger*/\n.btn-app-danger {\n    background: #CC0000;\n}\n.btn-app-danger:hover, .btn-app-danger:focus {\n    background-color: #db0000 !important;\n}\n.btn-app-danger.active {\n    background-color: maroon !important;\n}\n\n/*Link*/\n.btn-app-link {\n    background-color: transparent;\n    color: #000;\n}\n.btn-app-link:hover, .btn-app-link:focus {\n    background-color: transparent;\n    color: #000;\n}\n", ""]);

// exports


/***/ }),
/* 18 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        action: {
            type: [String, Object, Function],
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
        },
        noTapStop: {
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
        if (typeof this.action == 'string') {
            this.id = Date.now() + '-' + this.action;
        } else {
            this.id = Date.now() + '-' + this.action.event;
        }
    },

    methods: {
        click: function click(e) {
            if (typeof this.action == 'string') {
                EventBus.$emit(this.action);
            } else {
                EventBus.$emit(this.action.event, this.action.value);
            }

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
    },
    computed: {
        tapStop: function tapStop() {
            return this.noTapStop === undefined ? null : -1;
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 19 */
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
    attrs: { id: _vm.id, tabindex: _vm.tapStop },
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
    require("vue-hot-reload-api")      .rerender("data-v-55e05e8d", module.exports)
  }
}

/***/ }),
/* 20 */
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
              _c("span", { staticClass: "fa fa-comment-o" }),
              _vm._v(" " + _vm._s(_vm.heading) + "\n            ")
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
    require("vue-hot-reload-api")      .rerender("data-v-75c36dd7", module.exports)
  }
}

/***/ }),
/* 21 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(22)
/* template */
var __vue_template__ = __webpack_require__(23)
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
Component.options.__file = "resources\\assets\\js\\components\\navbars\\Navbar.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-6c274260", Component.options)
  } else {
    hotAPI.reload("data-v-6c274260", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 22 */
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
/* 23 */
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
    require("vue-hot-reload-api")      .rerender("data-v-6c274260", module.exports)
  }
}

/***/ }),
/* 24 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(25)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(27)
/* template */
var __vue_template__ = __webpack_require__(28)
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
Component.options.__file = "resources\\assets\\js\\components\\alerts\\AlertBox.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-02fbdae6", Component.options)
  } else {
    hotAPI.reload("data-v-02fbdae6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 25 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(26);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("0044e89b", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-02fbdae6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AlertBox.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-02fbdae6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./AlertBox.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 26 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n#alert-box {\n    width: 400px;\n    position: fixed;\n    top: 0px;\n    right: 15px;\n    z-index: 99999;\n    border: 3px double;\n    -webkit-box-shadow: 0 10px 6px -6px #777;\n               box-shadow: 0 10px 6px -6px #777;\n}\n#alert-icon {\n    float:left;\n    margin-right: .5em;\n}\n", ""]);

// exports


/***/ }),
/* 27 */
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
/* 28 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "transition",
    {
      attrs: {
        name: "custom-classes-transition",
        "enter-active-class": "animated bounceIn",
        "leave-active-class": "animated bounceOut"
      }
    },
    [
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
    ]
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-02fbdae6", module.exports)
  }
}

/***/ }),
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputCheck.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3149deec", Component.options)
  } else {
    hotAPI.reload("data-v-3149deec", Component.options)
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
Component.options.__file = "resources\\assets\\js\\components\\Panel.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-10054b1d", Component.options)
  } else {
    hotAPI.reload("data-v-10054b1d", Component.options)
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
var update = __webpack_require__(3)("63cf665c", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-10054b1d\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Panel.vue", function() {
     var newContent = require("!!../../../../node_modules/css-loader/index.js!../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-10054b1d\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./Panel.vue");
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
    require("vue-hot-reload-api")      .rerender("data-v-10054b1d", module.exports)
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
var update = __webpack_require__(3)("7e709f3f", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3149deec\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputCheck.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-3149deec\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputCheck.vue");
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
    require("vue-hot-reload-api")      .rerender("data-v-3149deec", module.exports)
  }
}

/***/ }),
/* 46 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(47)
/* template */
var __vue_template__ = __webpack_require__(48)
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputSuggestion.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-59671ff2", Component.options)
  } else {
    hotAPI.reload("data-v-59671ff2", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 47 */
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
        setterEvent: {
            type: String,
            required: false
        },
        storeData: {
            type: String,
            required: false
        },
        targetId: {
            type: String,
            required: false
        },
        mutator: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            userInput: '',
            lastData: '',
            saved: false,
            lastMutator: null
            // itemSelected: false
        };
    },
    mounted: function mounted() {
        var _this = this;

        // initial data
        if (this.value === undefined || this.value === null) {
            this.lastData = this.userInput = '';
        } else {
            this.lastData = this.userInput = this.value;
        }

        if (this.setterEvent !== undefined) {
            EventBus.$on(this.setterEvent, function (value) {
                _this.userInput = value;
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
                // this.itemSelected = true
                _this.$emit('selected', suggestion);
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
    updated: function updated() {
        if (this.mutator !== undefined && this.lastMutator != this.mutator) {
            this.userInput = this.mutator;
            this.lastMutator = this.mutator;
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

            if (this.storeData !== undefined) {
                EventBus.$emit(this.storeData, this.id, this.userInput);
            }
            setTimeout(function () {
                if (!_this2.saved) {
                    _this2.autosave();
                }
            }, 1000);
        }
    },
    computed: {
        getServiceUrl: function getServiceUrl() {
            if (this.serviceUrl === undefined) {
                return '/lists/autocomplete/' + this.field;
            }
            return '/lists/autocomplete/' + this.serviceUrl;
        },
        id: function id() {
            if (this.targetId !== undefined) {
                return this.targetId;
            }

            if (this.field !== undefined) {
                return this.field;
            }

            return Date.now() + this.serviceUrl.replace(new RegExp('/', 'g'), '');
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 48 */
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
    require("vue-hot-reload-api")      .rerender("data-v-59671ff2", module.exports)
  }
}

/***/ }),
/* 49 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(50)
/* template */
var __vue_template__ = __webpack_require__(51)
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
Component.options.__file = "resources\\assets\\js\\components\\navbars\\AuthenticatedNavbarRight.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-46425a0d", Component.options)
  } else {
    hotAPI.reload("data-v-46425a0d", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 50 */
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
/* 51 */
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
    require("vue-hot-reload-api")      .rerender("data-v-46425a0d", module.exports)
  }
}

/***/ }),
/* 52 */,
/* 53 */,
/* 54 */,
/* 55 */,
/* 56 */,
/* 57 */,
/* 58 */,
/* 59 */,
/* 60 */,
/* 61 */,
/* 62 */,
/* 63 */,
/* 64 */,
/* 65 */,
/* 66 */,
/* 67 */,
/* 68 */,
/* 69 */,
/* 70 */,
/* 71 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(72)
/* template */
var __vue_template__ = __webpack_require__(73)
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputText.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-1522171b", Component.options)
  } else {
    hotAPI.reload("data-v-1522171b", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 72 */
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
/* 73 */
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
    require("vue-hot-reload-api")      .rerender("data-v-1522171b", module.exports)
  }
}

/***/ }),
/* 74 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(75)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(77)
/* template */
var __vue_template__ = __webpack_require__(78)
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputRadio.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-d476e406", Component.options)
  } else {
    hotAPI.reload("data-v-d476e406", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 75 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(76);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("e51967fe", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d476e406\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRadio.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-d476e406\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputRadio.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 76 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\ndiv.extra {\n    font-style: italic;\n    color: #757575;\n}\n", ""]);

// exports


/***/ }),
/* 77 */
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
        storeData: {
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
                if (this.storeData !== undefined) {
                    EventBus.$emit(this.storeData, this.field, this.currentValue);
                }
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
            }

            // check if need to store
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

        // listen to event to set option value.
        if (this.setterEvent !== undefined) {
            // let eventName = this.setterEvent != '' ? this.setterEvent : 'set-' + this.field

            EventBus.$on(this.setterEvent, function (value) {
                _this.check(value);
            });
        }

        if (this.value !== undefined && this.value !== null) {

            this.currentValue = this.value;

            this.showReset = true;

            if (this.hasDefaultSlot) {
                this.showExtra = this.isTriggerExtra(this.value);
            } else {
                this.showExtra = false;
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
            // return !!this.$slots.default
            return this.$slots.default === undefined ? false : true;
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
/* 78 */
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
    require("vue-hot-reload-api")      .rerender("data-v-d476e406", module.exports)
  }
}

/***/ }),
/* 79 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(80)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(82)
/* template */
var __vue_template__ = __webpack_require__(83)
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputSelect.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-7a4f2c2c", Component.options)
  } else {
    hotAPI.reload("data-v-7a4f2c2c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 80 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(81);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("003a2e52", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7a4f2c2c\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputSelect.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-7a4f2c2c\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputSelect.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 81 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.cursor-pointer {\n    cursor:pointer;\n}\n", ""]);

// exports


/***/ }),
/* 82 */
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
        },
        storeData: {
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

                if (this.storeData !== undefined) {
                    EventBus.$emit(this.storeData, this.field, this.userInput);
                }

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
/* 83 */
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
    require("vue-hot-reload-api")      .rerender("data-v-7a4f2c2c", module.exports)
  }
}

/***/ }),
/* 84 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(85)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(87)
/* template */
var __vue_template__ = __webpack_require__(88)
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputTextarea.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-86e240b0", Component.options)
  } else {
    hotAPI.reload("data-v-86e240b0", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 85 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(86);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("e07017ac", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-86e240b0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextarea.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-86e240b0\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextarea.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 86 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.fix-margin {\n    margin-top: .3em;\n}\n.textarea-warning {\n    /*Important stuff here*/\n    -webkit-transition: flash-warning 3s ease-out;\n    transition: flash-warning 3s ease-out;\n    -webkit-animation: flash-warning 3s forwards linear normal;\n            animation: flash-warning 3s forwards linear normal;\n}\n@-webkit-keyframes flash-warning {\n0% {\n        background:#fff;\n}\n50% {\n        background:#f0ad4e;\n}\n100% {\n        background:#fff;\n}\n}\n@keyframes flash-warning {\n0% {\n        background:#fff;\n}\n50% {\n        background:#f0ad4e;\n}\n100% {\n        background:#fff;\n}\n}\n.textarea-danger {\n    /*Important stuff here*/\n    -webkit-transition: flash-danger 3s ease-out;\n    transition: flash-danger 3s ease-out;\n    -webkit-animation: flash-danger 3s forwards linear normal;\n            animation: flash-danger 3s forwards linear normal;\n}\n@-webkit-keyframes flash-danger {\n0% {\n        background:#fff;\n}\n50% {\n        background:#d9534f;\n}\n100% {\n        background:#fff;\n}\n}\n@keyframes flash-danger {\n0% {\n        background:#fff;\n}\n50% {\n        background:#d9534f;\n}\n100% {\n        background:#fff;\n}\n}\n", ""]);

// exports


/***/ }),
/* 87 */
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
            type: [String, Number],
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
                    if (_this.userInput === null || _this.userInput === '') {
                        _this.userInput = value;
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

        // seem like Vue delay update so, we delay autosize process to take effect
        setTimeout(function () {
            autosize.update($(_this.domRef));
        }, 100);

        // init label action icon tooltip if available.
        if (this.labelAction !== undefined) {
            $('a[title="' + this.labelActionTitle + '"]').tooltip();
        }
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
        },
        emitLabelActionEvent: function emitLabelActionEvent() {
            EventBus.$emit(this.labelActionEmitEventName);
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
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 88 */
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
              {
                staticClass: "control-label topped",
                attrs: { for: _vm.field }
              },
              [
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
              ]
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
            maxlength: _vm.getMaxChars,
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
    require("vue-hot-reload-api")      .rerender("data-v-86e240b0", module.exports)
  }
}

/***/ }),
/* 89 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(90)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(92)
/* template */
var __vue_template__ = __webpack_require__(93)
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputTextAddon.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-f65cebd6", Component.options)
  } else {
    hotAPI.reload("data-v-f65cebd6", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 90 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(91);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("324caaac", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f65cebd6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextAddon.vue", function() {
     var newContent = require("!!../../../../../node_modules/css-loader/index.js!../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-f65cebd6\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./InputTextAddon.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 91 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n.add-margin-bottom {\n    margin-bottom: 3px;\n}\n.invalid-input {\n    color: #fff;\n    background:#d9534f;\n}\n", ""]);

// exports


/***/ }),
/* 92 */
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
            type: [String, Number],
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
    }), _defineProperty(_props, 'storeData', {
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
            userInput: null,
            lastSave: null,
            // frontAddonHtml: '',
            // rearAddonHtml: '',
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

        // if (this.rearAddon !== undefined) {
        //     this.rearAddonHtml = this.rearAddon
        // }

        // if (this.frontAddon !== undefined) {
        //     this.frontAddonHtml = this.frontAddon
        // }

        // if (this.setterRearAddon !== undefined) {
        //     EventBus.$on(this.setterRearAddon, (html) => {
        //         this.rearAddonHtml = html
        //     })
        // }

        // if (this.setterFrontAddon !== undefined) {
        //     EventBus.$on(this.setterFrontAddon, (html) => {
        //         this.frontAddonHtml = html
        //     })   
        // }

        if (this.needSync !== undefined) {
            var url = this.needSync + '/' + this.field;
            axios.get(url).then(function (response) {
                _this.userInput = response.data;
            }).catch(function (error) {
                _this.userInput = 'error';
            });
        }

        if (this.value === undefined) {
            this.lastSave = this.userInput = null;
        } else {
            this.lastSave = this.userInput = this.value;
        }

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
            var _this2 = this;

            if (this.readonly != '' && this.userInput != this.lastSave) {
                EventBus.$emit('autosave', this.field, this.userInput);
                this.lastSave = this.userInput;

                if (this.storeData !== undefined) {
                    EventBus.$emit(this.storeData, this.field, this.userInput);
                }

                if (this.emitOnUpdateEvents !== null) {
                    this.emitOnUpdateEvents.forEach(function (event) {
                        EventBus.$emit(event, _this2.userInput);
                    });
                }
            }
        },
        isValidate: function isValidate() {
            if (this.pattern === undefined || this.userInput == null || this.userInput == '') {
                return true;
            }
            if (this.regex.test(this.userInput)) {
                $(this.inputDom).attr('data-original-title', '');
                $(this.inputDom).tooltip('hide');
                this.inputClass = 'form-control';
                return true;
            } else {
                return false;
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
                // return JSON.parse(this.emitOnUpdate)
                if (typeof this.emitOnUpdate == 'string') {
                    // return JSON.parse(this.emitOnUpdate)
                    return this.emitOnUpdate.split(",");
                }
                return this.emitOnUpdate;
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
/* 93 */
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
      _c("div", { staticClass: "input-group" }, [
        _vm.frontAddon !== undefined
          ? _c("span", {
              staticClass: "input-group-addon",
              domProps: { innerHTML: _vm._s(_vm.frontAddon) }
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
        }),
        _vm._v(" "),
        _vm.rearAddon !== undefined
          ? _c("span", {
              staticClass: "input-group-addon",
              domProps: { innerHTML: _vm._s(_vm.rearAddon) }
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
    require("vue-hot-reload-api")      .rerender("data-v-f65cebd6", module.exports)
  }
}

/***/ }),
/* 94 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(95)
/* template */
var __vue_template__ = __webpack_require__(96)
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
Component.options.__file = "resources\\assets\\js\\components\\inputs\\InputCheckGroup.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-71defac5", Component.options)
  } else {
    hotAPI.reload("data-v-71defac5", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 95 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__inputs_InputCheck_vue__ = __webpack_require__(36);
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
/* 96 */
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
            "need-sync": _vm.needSync,
            "no-save": check.noSave
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
    require("vue-hot-reload-api")      .rerender("data-v-71defac5", module.exports)
  }
}

/***/ }),
/* 97 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(98)
/* template */
var __vue_template__ = __webpack_require__(99)
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
Component.options.__file = "resources\\assets\\js\\components\\helpers\\Helper.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-291fad9c", Component.options)
  } else {
    hotAPI.reload("data-v-291fad9c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 98 */
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
        topic: {
            type: String,
            required: true
        },
        groups: {
            type: Array,
            required: true
        }
    },
    methods: {
        click: function click() {
            $('button.active[group=' + event.target.getAttribute('group') + ']').removeClass('active');
            event.target.className = "btn btn-default btn-sm active";
            EventBus.$emit('store-helper', this.topic, event.target.getAttribute('group'), event.target.innerHTML);
        }
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 99 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    _vm._l(_vm.groups, function(group, index) {
      return _c(
        "div",
        {
          key: group.name,
          staticClass: "col-xs-12",
          staticStyle: { "padding-bottom": "3px" }
        },
        [
          _c("span", { staticClass: "fa fa-ellipsis-v" }),
          _vm._v(" "),
          _c(
            "div",
            { staticClass: "btn-group", attrs: { role: "group" } },
            _vm._l(group.choices, function(choice) {
              return _c(
                "button",
                {
                  key: choice,
                  staticClass: "btn btn-default btn-sm",
                  staticStyle: { "font-weight": "bold" },
                  attrs: { type: "button", group: group.name },
                  on: { click: _vm.click }
                },
                [_vm._v(_vm._s(choice) + "\n            ")]
              )
            })
          )
        ]
      )
    })
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-291fad9c", module.exports)
  }
}

/***/ }),
/* 100 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(101)
/* template */
var __vue_template__ = __webpack_require__(102)
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
Component.options.__file = "resources\\assets\\js\\components\\modals\\Document.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-3b3d032c", Component.options)
  } else {
    hotAPI.reload("data-v-3b3d032c", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 101 */
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

/* harmony default export */ __webpack_exports__["default"] = ({
    props: {
        heading: {
            type: String,
            required: true
        }
    },
    computed: {
        dashLowerCaseHeading: function dashLowerCaseHeading() {
            return this.heading.replace(/ /g, '-').toLowerCase();
        },
        modalId: function modalId() {
            return 'modal-' + this.dashLowerCaseHeading;
        }
    },
    mounted: function mounted() {
        $('#' + this.modalId).modal('show');
    }
});
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 102 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      staticClass: "modal fade",
      attrs: { id: _vm.modalId, tabindex: "-1", role: "dialog" }
    },
    [
      _c(
        "div",
        { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
        [
          _c("div", { staticClass: "modal-content" }, [
            _c(
              "div",
              {
                staticClass: "modal-header alert alert-default",
                staticStyle: { "margin-bottom": "0px" }
              },
              [
                _vm._m(0),
                _vm._v(" "),
                _c("p", { staticClass: "modal-title" }, [
                  _c("span", {
                    staticClass: "fa fa-comment-o",
                    attrs: { "aria-hidden": "true" }
                  }),
                  _vm._v(" " + _vm._s(_vm.heading))
                ])
              ]
            ),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass: "modal-body",
                staticStyle: {
                  "max-height": "calc(100vh - 10vh)",
                  "overflow-y": "auto",
                  padding: "5px"
                }
              },
              [_vm._t("body")],
              2
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "modal-footer", staticStyle: { padding: "5px" } },
              [_vm._t("footer")],
              2
            )
          ])
        ]
      )
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
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
    )
  }
]
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-3b3d032c", module.exports)
  }
}

/***/ }),
/* 103 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(104)
/* template */
var __vue_template__ = __webpack_require__(105)
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
Component.options.__file = "resources\\assets\\js\\components\\navbars\\EditNote.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-c041a128", Component.options)
  } else {
    hotAPI.reload("data-v-c041a128", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 104 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__AuthenticatedNavbarRight_vue__ = __webpack_require__(49);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__AuthenticatedNavbarRight_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__AuthenticatedNavbarRight_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__Navbar_vue__ = __webpack_require__(21);
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
/* 105 */
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
    require("vue-hot-reload-api")      .rerender("data-v-c041a128", module.exports)
  }
}

/***/ }),
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
/* 188 */,
/* 189 */,
/* 190 */,
/* 191 */,
/* 192 */,
/* 193 */,
/* 194 */,
/* 195 */,
/* 196 */,
/* 197 */,
/* 198 */,
/* 199 */,
/* 200 */,
/* 201 */,
/* 202 */,
/* 203 */,
/* 204 */,
/* 205 */,
/* 206 */,
/* 207 */,
/* 208 */,
/* 209 */,
/* 210 */,
/* 211 */,
/* 212 */,
/* 213 */,
/* 214 */,
/* 215 */,
/* 216 */,
/* 217 */,
/* 218 */,
/* 219 */,
/* 220 */,
/* 221 */,
/* 222 */,
/* 223 */,
/* 224 */,
/* 225 */,
/* 226 */,
/* 227 */,
/* 228 */,
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
/* 248 */,
/* 249 */,
/* 250 */,
/* 251 */,
/* 252 */,
/* 253 */,
/* 254 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(255);


/***/ }),
/* 255 */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {__webpack_require__(5);

// use global event bus
window.EventBus = new Vue();

Vue.component('note', __webpack_require__(256));
Vue.component('page-navbar', __webpack_require__(103));
Vue.component('modal-dialog', __webpack_require__(12));
Vue.component('alert-box', __webpack_require__(24));
Vue.component('button-app', __webpack_require__(4));

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
            axios.post('/note/' + window.location.pathname.split("/")[2] + '/autosave', { field: field, value: value }).then(function (response) {
                console.log(response.data);
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
/* 256 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(257)
/* template */
var __vue_template__ = __webpack_require__(266)
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
Component.options.__file = "resources\\assets\\js\\components\\notes\\medicine\\forms\\Admission.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-820f0ba8", Component.options)
  } else {
    hotAPI.reload("data-v-820f0ba8", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 257 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* WEBPACK VAR INJECTION */(function($) {/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Panel_vue__ = __webpack_require__(37);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Panel_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Panel_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__inputs_InputText_vue__ = __webpack_require__(71);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__inputs_InputText_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__inputs_InputText_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__inputs_InputCheck_vue__ = __webpack_require__(36);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__inputs_InputCheck_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__inputs_InputCheck_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__inputs_InputRadio_vue__ = __webpack_require__(74);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__inputs_InputRadio_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__inputs_InputRadio_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__inputs_InputSelect_vue__ = __webpack_require__(79);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_4__inputs_InputSelect_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_4__inputs_InputSelect_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__inputs_InputTextarea_vue__ = __webpack_require__(84);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_5__inputs_InputTextarea_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_5__inputs_InputTextarea_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__inputs_InputTextAddon_vue__ = __webpack_require__(89);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_6__inputs_InputTextAddon_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_6__inputs_InputTextAddon_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__inputs_InputSuggestion_vue__ = __webpack_require__(46);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_7__inputs_InputSuggestion_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_7__inputs_InputSuggestion_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__inputs_InputCheckGroup_vue__ = __webpack_require__(94);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_8__inputs_InputCheckGroup_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_8__inputs_InputCheckGroup_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__modals_medicine_ChildPughScore_vue__ = __webpack_require__(258);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_9__modals_medicine_ChildPughScore_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_9__modals_medicine_ChildPughScore_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__helpers_medicine_GeneralSymptoms_vue__ = __webpack_require__(263);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_10__helpers_medicine_GeneralSymptoms_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_10__helpers_medicine_GeneralSymptoms_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        'input-text-addon': __WEBPACK_IMPORTED_MODULE_6__inputs_InputTextAddon_vue___default.a,
        'input-suggestion': __WEBPACK_IMPORTED_MODULE_7__inputs_InputSuggestion_vue___default.a,
        'input-check-group': __WEBPACK_IMPORTED_MODULE_8__inputs_InputCheckGroup_vue___default.a,
        'modal-child-pugh-score-detail': __WEBPACK_IMPORTED_MODULE_9__modals_medicine_ChildPughScore_vue___default.a,
        'general-symptoms-helper': __WEBPACK_IMPORTED_MODULE_10__helpers_medicine_GeneralSymptoms_vue___default.a
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
            store: {},
            showGeneralSymptomsHelper: false,
            getDataUrl: "/note-data/" + window.location.pathname.split("/")[2]
        };
    },
    created: function created() {
        this.note = JSON.parse(this.serializedNote);

        this.comorbidOptions = [{ label: "No data", value: 255 }, { label: "No", value: 0 }, { label: "Yes", value: 1 }];

        this.comorbidExtrasTriggerValue = 1;

        this.cirrhosisLabelAction = {
            emit: "toggle-modal-child-pugh-score-detail",
            icon: "question-circle",
            title: "Click to learn more about Child-Pugh's Score"
        };

        this.reviewSystemPhysicalExamOptions = [{ label: "Normal", value: 1 }, { label: "Abnormal", value: 2 }];

        this.plans = [{
            key: "leftPlan",
            plans: [{
                label: "Problem list :",
                field: 'problem_list',
                value: this.note.detail.problem_list,
                maxChars: 1000
            }, {
                label: "Discussion :",
                field: 'discussion',
                value: this.note.detail.discussion,
                maxChars: 2000
            }, {
                label: "Provisional diagnosis :",
                field: 'provisional_diagnosis',
                value: this.note.detail.provisional_diagnosis,
                maxChars: 500
            }]
        }, {
            key: "rightPlan",
            plans: [{
                label: "Plan of investigation :",
                field: 'investigation_plan',
                value: this.note.detail.investigation_plan,
                maxChars: 1000
            }, {
                label: "Plan of management :",
                field: 'management_plan',
                value: this.note.detail.management_plan,
                maxChars: 1000
            }, {
                label: "Plan of consultation :",
                field: 'consultation_plan',
                value: this.note.detail.consultation_plan,
                maxChars: 1000
            }]
        }];
    },
    mounted: function mounted() {
        var _this = this;

        EventBus.$on('comorbid-negative-all', function () {
            _this.setComorbidAll(0);
        });

        EventBus.$on('comorbid-no-data-all', function () {
            _this.setComorbidAll(255);
        });

        EventBus.$on('store-data', function (field, value) {
            _this.store[field] = value;
        });

        EventBus.$on('note-store-data', function (field, value) {
            _this.note.detail[field] = value;
        });

        EventBus.$on('reset-comorbid_DM-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
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
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_valvular_heart_disease_AS = false;
                _this.note.detail.comorbid_valvular_heart_disease_AR = false;
                _this.note.detail.comorbid_valvular_heart_disease_MS = false;
                _this.note.detail.comorbid_valvular_heart_disease_MR = false;
                _this.note.detail.comorbid_valvular_heart_disease_TR = false;
                _this.note.detail.comorbid_valvular_heart_disease_other = null;
            }
        });

        EventBus.$on('reset-comorbid_cirrhosis-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_cirrhosis_child_pugh_score = null;
                _this.note.detail.comorbid_cirrhosis_HBV = false;
                _this.note.detail.comorbid_cirrhosis_HCV = false;
                _this.note.detail.comorbid_cirrhosis_NASH = false;
                _this.note.detail.comorbid_cirrhosis_cryptogenic = false;
                _this.note.detail.comorbid_cirrhosis_other = null;
            }
        });

        EventBus.$on('click-comorbid_cirrhosis_none_cryptogenic', function (value) {
            if (value) {
                EventBus.$emit('set-cirrhosis_cryptogenic', false);
            }
        });

        EventBus.$on('click-comorbid_cirrhosis_cryptogenic', function (value) {
            if (value) {
                EventBus.$emit('set-cirrhosis_HBV', false);
                EventBus.$emit('set-cirrhosis_HCV', false);
                EventBus.$emit('set-cirrhosis_NASH', false);
            }
        });

        EventBus.$on('click-comorbid_HCV', function (value) {
            if (value && _this.note.detail.comorbid_HCV !== 1) {
                EventBus.$emit('set-comorbid_HCV', 1);
                EventBus.$emit('toggle-alert-box', 'HCV infection also checked');
            }
        });

        EventBus.$on('click-comorbid_HBV', function (value) {
            if (value && _this.note.detail.comorbid_HBV !== 1) {
                EventBus.$emit('set-comorbid_HBV', 1);
                EventBus.$emit('toggle-alert-box', 'HBV infection also checked');
            }
        });

        EventBus.$on('reset-comorbid_lukemia-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_lukemia_specific = null;
            }
        });

        EventBus.$on('reset-comorbid_ICD-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_ICD_other = null;
            }
        });

        EventBus.$on('reset-comorbid_dementia-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_dementia_vascular = false;
                _this.note.detail.comorbid_dementia_alzheimer = false;
                _this.note.detail.comorbid_dementia_other = null;
            }
        });

        EventBus.$on('reset-comorbid_stroke-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_stroke_ischemic_text = null;
                _this.note.detail.comorbid_stroke_hemorrhagic_text = null;
                _this.note.detail.comorbid_stroke_iembolic_text = null;
            }
        });

        EventBus.$on('reset-comorbid_CKD-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_CKD_stage_text = null;
            }
        });

        EventBus.$on('reset-comorbid_HIV-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_HIV_other = null;
                _this.note.detail.comorbid_HIV_TB = false;
                _this.note.detail.comorbid_HIV_PCP = false;
                _this.note.detail.comorbid_HIV_candidiasis = false;
                _this.note.detail.comorbid_HIV_CMV = false;
            }
        });

        EventBus.$on('reset-comorbid_lymphoma-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_lymphoma_specific_text = null;
            }
        });

        EventBus.$on('reset-comorbid_cancer-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_cancer_lung = false;
                _this.note.detail.comorbid_cancer_liver = false;
                _this.note.detail.comorbid_cancer_colon = false;
                _this.note.detail.comorbid_cancer_breast = false;
                _this.note.detail.comorbid_cancer_prostate = false;
                _this.note.detail.comorbid_cancer_cervix = false;
                _this.note.detail.comorbid_cancer_pancreas = false;
                _this.note.detail.comorbid_cancer_brain = false;
                _this.note.detail.comorbid_cancer_other = null;
            }
        });

        EventBus.$on('reset-comorbid_other_autoimmune_disease-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_other_autoimmune_disease_UCTD = false;
                _this.note.detail.comorbid_other_autoimmune_disease_sjrogren_syndrome = false;
                _this.note.detail.comorbid_other_autoimmune_disease_MCTD = false;
                _this.note.detail.comorbid_other_autoimmune_disease_DMPM = false;
                _this.note.detail.comorbid_other_autoimmune_disease_other = null;
            }
        });

        EventBus.$on('reset-comorbid_psychiatric_illness-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_psychiatric_illness_schizophrenia = false;
                _this.note.detail.comorbid_psychiatric_illness_major_depression = false;
                _this.note.detail.comorbid_psychiatric_illness_bipolar_disorder = false;
                _this.note.detail.comorbid_psychiatric_illness_adjustment_disorder = false;
                _this.note.detail.comorbid_psychiatric_illness_obcessive_compulsive_disorder = false;
                _this.note.detail.comorbid_psychiatric_illness_other = null;
            }
        });

        EventBus.$on('reset-comorbid_CAD-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_CAD_specific_text = null;
            }
        });

        EventBus.$on('reset-comorbid_epilepsy-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_epilepsy_specific_text = null;
            }
        });

        EventBus.$on('reset-comorbid_pacemaker_implant-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_pacemaker_implant_specific = null;
            }
        });

        EventBus.$on('reset-comorbid_chronic_arthritis-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_chronic_arthritis_CPPD = false;
                _this.note.detail.comorbid_chronic_arthritis_rheumatoid = false;
                _this.note.detail.comorbid_chronic_arthritis_OA = false;
                _this.note.detail.comorbid_chronic_arthritis_spondyloarthropathy = false;
                _this.note.detail.comorbid_chronic_arthritis_other = null;
            }
        });

        EventBus.$on('reset-comorbid_TB-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.comorbid_TB_pulmonary = false;
                _this.note.detail.comorbid_TB_other = null;
            }
        });

        EventBus.$on('reset-pregnancy-extras', function (value) {
            if (value != _this.comorbidExtrasTriggerValue) {
                _this.note.detail.gestation_weeks = null;
            }
        });

        EventBus.$on('reset-alcohol-extras', function (value) {
            if (value == 0) {
                _this.note.detail.alcohol_description = null;
            }
        });

        EventBus.$on('reset-cigarette_smoking-extras', function (value) {
            if (value == 0) {
                _this.note.detail.smoke_description = null;
            }
        });

        EventBus.$on('append-current_medications', function () {
            _this.setCurrentMedications('append');
        });

        EventBus.$on('put-current_medications', function () {
            _this.setCurrentMedications('put');
        });

        EventBus.$on('BMI-updates', function () {
            EventBus.$emit('update-BMI', _this.autoCalculateBMI);
            if (_this.autoCalculateBMI !== null) {
                EventBus.$emit('toggle-alert-box', 'BMI updated');
            }
        });

        EventBus.$on('reset-breathing-extras', function (value) {
            if (value == 1 || value == null) {
                _this.note.detail.O2_rate = null;
            }
        });

        EventBus.$on('GCS-updates', function () {
            EventBus.$emit('update-GCS', _this.autoCalculateGCS);
        });

        EventBus.$on('toggle-general-symptoms-helper', function () {
            if (_this.showGeneralSymptomsHelper) {
                $('#modal-general-symptoms-helper').modal('hide');
                setTimeout(function () {
                    _this.showGeneralSymptomsHelper = false;
                }, 1000);
            } else {
                _this.showGeneralSymptomsHelper = true;
            }
        });
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
                emitOnUpdate: 'click-comorbid_cirrhosis_none_cryptogenic,click-comorbid_HBV',
                setterEvent: "set-cirrhosis_HBV"
            }, {
                field: "comorbid_cirrhosis_HCV",
                label: "HCV",
                checked: this.note.detail.comorbid_cirrhosis_HCV,
                emitOnUpdate: 'click-comorbid_cirrhosis_none_cryptogenic,click-comorbid_HCV',
                setterEvent: "set-cirrhosis_HCV"
            }, {
                field: "comorbid_cirrhosis_NASH",
                label: "NASH",
                checked: this.note.detail.comorbid_cirrhosis_NASH,
                emitOnUpdate: 'click-comorbid_cirrhosis_none_cryptogenic',
                setterEvent: "set-cirrhosis_NASH"
            }, {
                field: "comorbid_cirrhosis_cryptogenic",
                label: "Cryptogenic",
                checked: this.note.detail.comorbid_cirrhosis_cryptogenic,
                emitOnUpdate: 'click-comorbid_cirrhosis_cryptogenic',
                setterEvent: "set-cirrhosis_cryptogenic"
            }];
        },
        dementiaSpecificChecks: function dementiaSpecificChecks() {
            return [{
                field: "comorbid_dementia_vascular",
                value: this.note.detail.comorbid_dementia_vascular,
                label: "Vascular"
            }, {
                field: "comorbid_dementia_alzheimer",
                value: this.note.detail.comorbid_dementia_alzheimer,
                label: "Alzheimer"
            }];
        },
        strokeSymptoms: function strokeSymptoms() {
            return [{
                field: 'comorbid_stroke_ischemic',
                value: this.note.detail.comorbid_stroke_ischemic_text,
                label: 'Ischemic :'
            }, {
                field: 'comorbid_stroke_hemorrhagic',
                value: this.note.detail.comorbid_stroke_hemorrhagic_text,
                label: 'Hemorrhagic :'
            }, {
                field: 'comorbid_stroke_iembolic',
                value: this.note.detail.comorbid_stroke_iembolic_text,
                label: 'Iembolic :'
            }];
        },
        HIVPreviousOpportunisticInfectionChecks: function HIVPreviousOpportunisticInfectionChecks() {
            return [{
                field: "comorbid_HIV_TB",
                checked: this.note.detail.comorbid_HIV_TB,
                label: "TB"
            }, {
                field: "comorbid_HIV_PCP",
                checked: this.note.detail.comorbid_HIV_PCP,
                label: "PCP"
            }, {
                field: "comorbid_HIV_candidiasis",
                checked: this.note.detail.comorbid_HIV_candidiasis,
                label: "Candidiasis"
            }, {
                field: "comorbid_HIV_CMV",
                checked: this.note.detail.comorbid_HIV_CMV,
                label: "CMV"
            }];
        },
        cancerOrganChecks: function cancerOrganChecks() {
            return [{
                field: "comorbid_cancer_lung",
                checked: this.note.detail.comorbid_cancer_lung,
                label: "Lung"
            }, {
                field: "comorbid_cancer_liver",
                checked: this.note.detail.comorbid_cancer_liver,
                label: "Liver"
            }, {
                field: "comorbid_cancer_colon",
                checked: this.note.detail.comorbid_cancer_colon,
                label: "Colon"
            }, {
                field: "comorbid_cancer_breast",
                checked: this.note.detail.comorbid_cancer_breast,
                label: "Breast"
            }, {
                field: "comorbid_cancer_prostate",
                checked: this.note.detail.comorbid_cancer_prostate,
                label: "Prostate"
            }, {
                field: "comorbid_cancer_cervix",
                checked: this.note.detail.comorbid_cancer_cervix,
                label: "Cervix"
            }, {
                field: "comorbid_cancer_pancreas",
                checked: this.note.detail.comorbid_cancer_pancreas,
                label: "Pancreas"
            }, {
                field: "comorbid_cancer_brain",
                checked: this.note.detail.comorbid_cancer_brain,
                label: "Brain"
            }];
        },
        otherAutoimmuneDiseaseChecks: function otherAutoimmuneDiseaseChecks() {
            return [{
                field: "comorbid_other_autoimmune_disease_UCTD",
                label: "UCTD",
                checked: this.note.detail.comorbid_other_autoimmune_disease_UCTD,
                labelDescription: "Undifferentiated connective tissue disease"
            }, {
                field: "comorbid_other_autoimmune_disease_sjrogren_syndrome",
                label: "Sjrögren syndrome",
                checked: this.note.detail.comorbid_other_autoimmune_disease_sjrogren_syndrome
            }, {
                field: "comorbid_other_autoimmune_disease_MCTD",
                label: "MCTD",
                checked: this.note.detail.comorbid_other_autoimmune_disease_MCTD,
                labelDescription: "Mixed connective tissue disease"
            }, {
                field: "comorbid_other_autoimmune_disease_DMPM",
                label: "DMPM",
                checked: this.note.detail.comorbid_other_autoimmune_disease_DMPM,
                labelDescription: "Dermatomyositis polymyositis"
            }];
        },
        psychiatricIllnessChecks: function psychiatricIllnessChecks() {
            return [{
                field: "comorbid_psychiatric_illness_schizophrenia",
                checked: this.note.detail.comorbid_psychiatric_illness_schizophrenia,
                label: "Schizophrenia"
            }, {
                field: "comorbid_psychiatric_illness_major_depression",
                checked: this.note.detail.comorbid_psychiatric_illness_major_depression,
                label: "Major depression"
            }, {
                field: "comorbid_psychiatric_illness_bipolar_disorder",
                checked: this.note.detail.comorbid_psychiatric_illness_bipolar_disorder,
                label: "Bipolar disorder"
            }, {
                field: "comorbid_psychiatric_illness_adjustment_disorder",
                checked: this.note.detail.comorbid_psychiatric_illness_adjustment_disorder,
                label: "Adjustment disorder"
            }, {
                field: "comorbid_psychiatric_illness_obcessive_compulsive_disorder",
                checked: this.note.detail.comorbid_psychiatric_illness_obcessive_compulsive_disorder,
                label: "Obcessive compulsive disorder"
            }];
        },
        chronicArthritisSpecificChecks: function chronicArthritisSpecificChecks() {
            return [{
                field: "comorbid_chronic_arthritis_CPPD",
                checked: this.note.detail.comorbid_chronic_arthritis_CPPD,
                label: "CPPD",
                labelDescription: "Calcium pryophosphate dihydrate"
            }, {
                field: "comorbid_chronic_arthritis_rheumatoid",
                checked: this.note.detail.comorbid_chronic_arthritis_rheumatoid,
                label: "Rheumatoid"
            }, {
                field: "comorbid_chronic_arthritis_OA",
                checked: this.note.detail.comorbid_chronic_arthritis_OA,
                label: "OA",
                labelDescription: "Osteoarthritis"
            }, {
                field: "comorbid_chronic_arthritis_spondyloarthropathy",
                checked: this.note.detail.comorbid_chronic_arthritis_spondyloarthropathy,
                label: "Spondyloarthropathy"
            }];
        },
        TBSpecificChecks: function TBSpecificChecks() {
            return [{
                field: "comorbid_TB_pulmonary",
                checked: this.note.detail.comorbid_TB_pulmonary,
                label: "Pulmonary"
            }];
        },
        specialRequirementChecks: function specialRequirementChecks() {
            return [{
                field: "NG_tube",
                checked: this.note.detail.NG_tube,
                label: "NG tube"
            }, {
                field: "NG_suction",
                checked: this.note.detail.NG_suction,
                label: "NG suction"
            }, {
                field: "gastrostomy_feeding",
                checked: this.note.detail.gastrostomy_feeding,
                label: "Gastrostomy feeding"
            }, {
                field: "urinary_cath_care",
                checked: this.note.detail.urinary_cath_care,
                label: "Urinary cath. care"
            }, {
                field: "tracheostomy_care",
                checked: this.note.detail.tracheostomy_care,
                label: "Tracheostomy care"
            }, {
                field: "hearing_impaiment",
                checked: this.note.detail.hearing_impaiment,
                label: "Hearing impaiment"
            }, {
                field: "isolation_room",
                checked: this.note.detail.isolation_room,
                label: "Isolation room"
            }];
        },
        estimatedHeightTemplate: function estimatedHeightTemplate() {
            var template = '<input type="checkbox" ';
            template += 'name="estimated_height" ';
            template += this.note.detail.estimated_height != 0 ? 'checked' : '';
            template += '/> <span class="estimated" data-target="estimated_height">estimated</span>';
            return template;
        },
        estimatedWeightTemplate: function estimatedWeightTemplate() {
            var template = '<input type="checkbox" ';
            template += 'name="estimated_weight" ';
            template += this.note.detail.estimated_weight != 0 ? 'checked' : '';
            template += '/> <span class="estimated" data-target="estimated_weight">estimated</span>';
            return template;
        },
        autoCalculateBMI: function autoCalculateBMI() {
            if (this.note.detail.height_cm == null || this.note.detail.weight_kg == null) {
                return null;
            }

            var BMI = (this.note.detail.weight_kg / Math.pow(this.note.detail.height_cm / 100, 2)).toFixed(2);
            return BMI == '0.00' ? null : BMI;
        },
        O2RateRearAddon: function O2RateRearAddon() {
            switch (this.note.detail.breathing) {
                case 2:
                case 3:
                    return 'L/min';
                case 4:
                    return 'FiO<sub>2</sub>';
                default:
                    return '';
            }
        },
        mentalOrientationChecks: function mentalOrientationChecks() {
            return [{
                field: "mental_orientation_to_time",
                checked: this.note.detail.mental_orientation_to_time,
                label: "to Time"
            }, {
                field: "mental_orientation_to_place",
                checked: this.note.detail.mental_orientation_to_place,
                label: "to Place"
            }, {
                field: "mental_orientation_to_person",
                checked: this.note.detail.mental_orientation_to_person,
                label: "to Person"
            }];
        },
        autoCalculateGCS: function autoCalculateGCS() {
            var E = void 0,
                V = void 0,
                M = void 0;
            if (typeof this.note.detail.GCS_E == 'number' && typeof this.note.detail.GCS_V == 'number' && typeof this.note.detail.GCS_M == 'number') {
                E = this.note.detail.GCS_E;
                V = this.note.detail.GCS_V;
                M = this.note.detail.GCS_M;
            } else {
                var value = void 0;
                value = String(this.note.detail.GCS_E);
                E = value !== null ? parseInt(value.split(' ')[0].replace('[', '').replace(']', '')) : null;
                value = String(this.note.detail.GCS_V);
                V = value !== null ? parseInt(value.split(' ')[0].replace('[', '').replace(']', '')) : null;
                value = String(this.note.detail.GCS_M);
                M = value !== null ? parseInt(value.split(' ')[0].replace('[', '').replace(']', '')) : null;
            }

            var gcsLabel = void 0;
            if ($.isNumeric(E) && $.isNumeric(V) && $.isNumeric(M)) {
                var sum = E + V + M;
                if (sum < 9) {
                    gcsLabel = 'Severe [GCS < 9]';
                    EventBus.$emit('toggle-alert-box', gcsLabel, 'danger');
                } else if (sum < 13) {
                    gcsLabel = 'Moderate [9 <= GCS < 13]';
                    EventBus.$emit('toggle-alert-box', gcsLabel, 'warning');
                } else {
                    gcsLabel = 'Minor [13 <= GCS <= 15]';
                    EventBus.$emit('toggle-alert-box', gcsLabel);
                }
            } else {
                gcsLabel = null;
            }
            return gcsLabel;
        }
    },
    methods: {
        setComorbidAll: function setComorbidAll(value) {
            EventBus.$emit('set-comorbid_DM', value);
            EventBus.$emit('set-comorbid_valvular_heart_disease', value);
            EventBus.$emit('set-comorbid_asthma', value);
            EventBus.$emit('set-comorbid_cirrhosis', value);
            EventBus.$emit('set-comorbid_HCV', value);
            EventBus.$emit('set-comorbid_lukemia', value);
            EventBus.$emit('set-comorbid_ICD', value);
            EventBus.$emit('set-comorbid_SLE', value);
            EventBus.$emit('set-comorbid_dementia', value);
            EventBus.$emit('set-comorbid_HT', value);
            EventBus.$emit('set-comorbid_stroke', value);
            EventBus.$emit('set-comorbid_CKD', value);
            EventBus.$emit('set-comorbid_coagulopathy', value);
            EventBus.$emit('set-comorbid_HIV', value);
            EventBus.$emit('set-comorbid_lymphoma', value);
            EventBus.$emit('set-comorbid_cancer', value);
            EventBus.$emit('set-comorbid_other_autoimmune_disease', value);
            EventBus.$emit('set-comorbid_psychiatric_illness', value);
            EventBus.$emit('set-comorbid_CAD', value);
            EventBus.$emit('set-comorbid_COPD', value);
            EventBus.$emit('set-comorbid_hyperlipidemia', value);
            EventBus.$emit('set-comorbid_HBV', value);
            EventBus.$emit('set-comorbid_epilepsy', value);
            EventBus.$emit('set-comorbid_pacemaker_implant', value);
            EventBus.$emit('set-comorbid_chronic_arthritis', value);
            EventBus.$emit('set-comorbid_TB', value);
        },
        setCurrentMedications: function setCurrentMedications(mode) {
            EventBus.$emit('set-current_medications', this.store.current_medications_helper, mode);
            EventBus.$emit('set-current_medications_helper', '');
            this.$refs.current_medications_helper.$el.children[0].children[0].children[1].focus();
        }
    }

    // implement input-text sync data
    // window.location.href
    // window.location.hostname
    // window.location.pathname


    // handle estimated_height and estimated_weight
});$(function () {
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
/* WEBPACK VAR INJECTION */}.call(__webpack_exports__, __webpack_require__(1)))

/***/ }),
/* 258 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
function injectStyle (ssrContext) {
  if (disposed) return
  __webpack_require__(259)
}
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(261)
/* template */
var __vue_template__ = __webpack_require__(262)
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
Component.options.__file = "resources\\assets\\js\\components\\modals\\medicine\\ChildPughScore.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-180b4973", Component.options)
  } else {
    hotAPI.reload("data-v-180b4973", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 259 */
/***/ (function(module, exports, __webpack_require__) {

// style-loader: Adds some css to the DOM by adding a <style> tag

// load the styles
var content = __webpack_require__(260);
if(typeof content === 'string') content = [[module.i, content, '']];
if(content.locals) module.exports = content.locals;
// add the styles to the DOM
var update = __webpack_require__(3)("461b5753", content, false, {});
// Hot Module Replacement
if(false) {
 // When the styles change, update the <style> tags
 if(!content.locals) {
   module.hot.accept("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-180b4973\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ChildPughScore.vue", function() {
     var newContent = require("!!../../../../../../node_modules/css-loader/index.js!../../../../../../node_modules/vue-loader/lib/style-compiler/index.js?{\"vue\":true,\"id\":\"data-v-180b4973\",\"scoped\":false,\"hasInlineConfig\":true}!../../../../../../node_modules/vue-loader/lib/selector.js?type=styles&index=0!./ChildPughScore.vue");
     if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
     update(newContent);
   });
 }
 // When the module is disposed, remove the <style> tags
 module.hot.dispose(function() { update(); });
}

/***/ }),
/* 260 */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(2)(false);
// imports


// module
exports.push([module.i, "\n#modal-body-child-pugh {\n    font-size: 12pt;\n}\n#modal-body-child-pugh td {\n    padding-left: 5px;\n}\n#modal-body-child-pugh p {\n    padding-top: 5px;\n}\n", ""]);

// exports


/***/ }),
/* 261 */
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
/* 262 */
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
      _c(
        "div",
        { staticClass: "modal-dialog modal-lg", attrs: { role: "document" } },
        [
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
        ]
      )
    ]
  )
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "modal-header alert alert-default" }, [
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
    ])
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
    require("vue-hot-reload-api")      .rerender("data-v-180b4973", module.exports)
  }
}

/***/ }),
/* 263 */
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(0)
/* script */
var __vue_script__ = __webpack_require__(264)
/* template */
var __vue_template__ = __webpack_require__(265)
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
Component.options.__file = "resources\\assets\\js\\components\\helpers\\medicine\\GeneralSymptoms.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-71327c04", Component.options)
  } else {
    hotAPI.reload("data-v-71327c04", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ }),
/* 264 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Helper_vue__ = __webpack_require__(97);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__Helper_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__Helper_vue__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__modals_Document_vue__ = __webpack_require__(100);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__modals_Document_vue___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__modals_Document_vue__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
        'helper': __WEBPACK_IMPORTED_MODULE_0__Helper_vue___default.a,
        'modal-document': __WEBPACK_IMPORTED_MODULE_1__modals_Document_vue___default.a
    },
    props: {
        setterEvent: {
            type: String,
            required: true
        },
        setLang: {
            type: String,
            required: false
        }
    },
    data: function data() {
        return {
            helper: {},
            generalSymptoms: [{ name: 'a_fever', choices: ['ไม่มีไข้', 'มีไข้'] }, { name: 'b_eating', choices: ['กินอาหารได้ตามปกติ', 'กินจุ', 'กินได้น้อย'] }, { name: 'c_bore_eating', choices: ['ไม่เบื่ออาหาร ', 'เบื่ออาหาร '] }, { name: 'd_body_weight', choices: ['ไม่มีน้ำหนักลด', 'น้ำหนักลด', 'น้ำหนักเพิ่ม'] }, { name: 'e_figure', choices: ['ปกติ', 'ผอมลง', 'อ้วนขึ้น'] }, { name: 'f_sleeping', choices: ['นอนหลับดี', 'นอนไม่หลับ'] }]
        };
    },

    computed: {
        helperText: function helperText() {
            var text = '';
            for (var key in this.helper) {
                text += this.helper[key];
                text = text.split(/(?:\r\n|\r|\n)/)[0] + (this.setLang === undefined ? ' ' : ', ');
            }
            return text;
        }
    },
    created: function created() {
        var _this = this;

        // Vue not actually destroyed component when v-if = false
        // So we need to use a unique event name for same
        // component that repeatly create/destroyed 
        this.putEvent = 'helper-put-' + Date.now();

        EventBus.$on(this.putEvent, function () {
            EventBus.$emit(_this.setterEvent, _this.helperText);
            EventBus.$emit('toggle-general-symptoms-helper'); // helper specific
        });

        EventBus.$on('store-helper', function (topic, group, value) {
            _this.helper[group] = value;
        });
    }
});

/***/ }),
/* 265 */
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "modal-document",
    {
      attrs: {
        heading: "General symptoms helper",
        "setter-event": _vm.setterEvent
      }
    },
    [
      _c(
        "div",
        { staticClass: "clearfix", attrs: { slot: "body" }, slot: "body" },
        [
          _c("helper", {
            attrs: { topic: "general_symptoms", groups: _vm.generalSymptoms }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "div",
        { attrs: { slot: "footer" }, slot: "footer" },
        [
          _c("button-app", {
            attrs: {
              action: _vm.putEvent,
              status: "info",
              label: "Put",
              size: "lg"
            }
          }),
          _vm._v(" "),
          _c("button-app", {
            attrs: {
              action: "toggle-general-symptoms-helper",
              status: "draft",
              label: "Close",
              size: "lg"
            }
          })
        ],
        1
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
    require("vue-hot-reload-api")      .rerender("data-v-71327c04", module.exports)
  }
}

/***/ }),
/* 266 */
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
      _vm.showGeneralSymptomsHelper
        ? _c("general-symptoms-helper", {
            attrs: { "setter-event": "set-general_symptoms" }
          })
        : _vm._e(),
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
                    action: "comorbid-negative-all",
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
                        "setter-event": "set-comorbid_DM",
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
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
                            '[\r\n                                {"label": "I", "value": 1},\r\n                                {"label": "II", "value": 2}\r\n                            ]',
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
                        "setter-event": "set-comorbid_valvular_heart_disease",
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
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
                      "setter-event": "set-comorbid_asthma",
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
                        "setter-event": "set-comorbid_cirrhosis",
                        value: _vm.note.detail.comorbid_cirrhosis,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_cirrhosis-extras"
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
                            '[\r\n                                {"label": "A", "value": "A"},\r\n                                {"label": "B", "value": "B"},\r\n                                {"label": "C", "value": "C"}\r\n                            ]'
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
              _c("div", [_c("hr", { staticClass: "line" })]),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c("input-radio", {
                    attrs: {
                      field: "comorbid_HCV",
                      label: "HCV :",
                      options: _vm.comorbidOptions,
                      "setter-event": "set-comorbid_HCV",
                      value: _vm.note.detail.comorbid_HCV,
                      "store-data": "note-store-data"
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
                        field: "comorbid_lukemia",
                        label: "Lukemia",
                        options: _vm.comorbidOptions,
                        "setter-event": "set-comorbid_lukemia",
                        value: _vm.note.detail.comorbid_lukemia,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_lukemia-extras"
                      }
                    },
                    [
                      _c("input-radio", {
                        attrs: {
                          field: "comorbid_lukemia_specific",
                          label: "Specify :",
                          value: _vm.note.detail.comorbid_lukemia_specific,
                          options:
                            '[\r\n                                {"label": "ALL", "value": 1},\r\n                                {"label": "AML", "value": 2},\r\n                                {"label": "CLL", "value": 3},\r\n                                {"label": "CML", "value": 4}\r\n                            ]'
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
                        field: "comorbid_ICD",
                        label: "ICD ",
                        options: _vm.comorbidOptions,
                        "setter-event": "set-comorbid_ICD",
                        value: _vm.note.detail.comorbid_ICD,
                        "label-description":
                          "Implantable Cardioverter Defibrillator",
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_ICD-extras"
                      }
                    },
                    [
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_ICD_other",
                          value: _vm.note.detail.comorbid_ICD_other,
                          size: "normal",
                          placeholder: "Specific ICD type."
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
                      field: "comorbid_SLE",
                      label: "SLE ",
                      options: _vm.comorbidOptions,
                      "setter-event": "set-comorbid_SLE",
                      value: _vm.note.detail.comorbid_SLE
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
                        field: "comorbid_dementia",
                        label: "Dementia :",
                        options: _vm.comorbidOptions,
                        "setter-event": "set-comorbid_dementia",
                        value: _vm.note.detail.comorbid_dementia,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_dementia-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: {
                          checks:
                            '[\r\n                                {"field": "comorbid_dementia_vascular", "label": "Vascular"},\r\n                                {"field": "comorbid_dementia_alzheimer", "label": "Alzheimer"}\r\n                            ]'
                        }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_dementia_other",
                          value: _vm.note.detail.comorbid_dementia_other,
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
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12 col-sm-6 col-md-4" }, [
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c("input-radio", {
                    attrs: {
                      field: "comorbid_HT",
                      value: _vm.note.detail.comorbid_HT,
                      label: "HT :",
                      "setter-event": "set-comorbid_HT",
                      options: _vm.comorbidOptions
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
                        field: "comorbid_stroke",
                        value: _vm.note.detail.comorbid_stroke,
                        label: "Stroke : ",
                        "setter-event": "set-comorbid_stroke",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_stroke-extras"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "form-inline" },
                        _vm._l(_vm.strokeSymptoms, function(symptom) {
                          return _c("input-select", {
                            key: symptom.field,
                            attrs: {
                              field: symptom.field,
                              value: symptom.value,
                              label: symptom.label,
                              size: "normal",
                              "not-allow-other": ""
                            }
                          })
                        })
                      )
                    ]
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
                        field: "comorbid_CKD",
                        value: _vm.note.detail.comorbid_CKD,
                        label: "CKD ",
                        "setter-event": "set-comorbid_CKD",
                        options: _vm.comorbidOptions,
                        "label-description": "Chronic Kidney Disease",
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_CKD-extras"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "form-inline" },
                        [
                          _c("input-select", {
                            attrs: {
                              field: "comorbid_CKD_stage",
                              value: _vm.note.detail.comorbid_CKD_stage_text,
                              label: "Stage :",
                              size: "normal",
                              "not-allow-other": ""
                            }
                          })
                        ],
                        1
                      )
                    ]
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
                      field: "comorbid_coagulopathy",
                      value: _vm.note.detail.comorbid_coagulopathy,
                      label: "Coagulopathy :",
                      "setter-event": "set-comorbid_coagulopathy",
                      options: _vm.comorbidOptions
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
                        field: "comorbid_HIV",
                        value: _vm.note.detail.comorbid_HIV,
                        label: "HIV :",
                        "setter-event": "set-comorbid_HIV",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_HIV-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: {
                          label: "Previous opportunistic infection : ",
                          checks: _vm.HIVPreviousOpportunisticInfectionChecks
                        }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_HIV_other",
                          value: _vm.note.detail.comorbid_HIV_other,
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
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "comorbid_lymphoma",
                        value: _vm.note.detail.comorbid_lymphoma,
                        label: "Lymphoma :",
                        "setter-event": "set-comorbid_lymphoma",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_lymphoma-extras"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "form-inline" },
                        [
                          _c("input-select", {
                            attrs: {
                              field: "comorbid_lymphoma_specific",
                              value:
                                _vm.note.detail.comorbid_lymphoma_specific_text,
                              label: "Specify :",
                              size: "normal"
                            }
                          })
                        ],
                        1
                      )
                    ]
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
                        field: "comorbid_cancer",
                        value: _vm.note.detail.comorbid_cancer,
                        label: "Cancer :",
                        "setter-event": "set-comorbid_cancer",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_cancer-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: { checks: _vm.cancerOrganChecks }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_cancer_other",
                          value: _vm.note.detail.comorbid_cancer_other,
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
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "comorbid_other_autoimmune_disease",
                        value:
                          _vm.note.detail.comorbid_other_autoimmune_disease,
                        label: "Other Autoimmune Disease :",
                        "setter-event": "set-comorbid_other_autoimmune_disease",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update":
                          "reset-comorbid_other_autoimmune_disease-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: { checks: _vm.otherAutoimmuneDiseaseChecks }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_other_autoimmune_disease_other",
                          value:
                            _vm.note.detail
                              .comorbid_other_autoimmune_disease_other,
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
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "comorbid_psychiatric_illness",
                        value: _vm.note.detail.comorbid_psychiatric_illness,
                        label: "Psychiatric illness :",
                        "setter-event": "set-comorbid_psychiatric_illness",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update":
                          "reset-comorbid_psychiatric_illness-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: { checks: _vm.psychiatricIllnessChecks }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_psychiatric_illness_other",
                          value:
                            _vm.note.detail.comorbid_psychiatric_illness_other,
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
            ]),
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
                        field: "comorbid_CAD",
                        value: _vm.note.detail.comorbid_CAD,
                        label: "CAD ",
                        "setter-event": "set-comorbid_CAD",
                        options: _vm.comorbidOptions,
                        "label-description": "Coronary Artery Disease",
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_CAD-extras"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "form-inline" },
                        [
                          _c("input-select", {
                            attrs: {
                              field: "comorbid_CAD_specific",
                              value: _vm.note.detail.comorbid_CAD_specific_text,
                              label: "Specify :",
                              size: "normal"
                            }
                          })
                        ],
                        1
                      )
                    ]
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
                      field: "comorbid_COPD",
                      value: _vm.note.detail.comorbid_COPD,
                      label: "COPD :",
                      "setter-event": "set-comorbid_COPD",
                      options: _vm.comorbidOptions
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
                        field: "comorbid_hyperlipidemia",
                        value: _vm.note.detail.comorbid_hyperlipidemia,
                        label: "Hyperlipidemia : ",
                        "setter-event": "set-comorbid_hyperlipidemia",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_hyperlipidemia-extras"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "form-inline" },
                        [
                          _c("input-select", {
                            attrs: {
                              field: "comorbid_hyperlipidemia_specific",
                              value:
                                _vm.note.detail
                                  .comorbid_hyperlipidemia_specific,
                              label: "Specify :",
                              size: "normal",
                              "not-allow-other": ""
                            }
                          })
                        ],
                        1
                      )
                    ]
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
                      field: "comorbid_HBV",
                      value: _vm.note.detail.comorbid_HBV,
                      label: "HBV infection :",
                      "setter-event": "set-comorbid_HBV",
                      options: _vm.comorbidOptions,
                      "store-data": "note-store-data"
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
                        field: "comorbid_epilepsy",
                        value: _vm.note.detail.comorbid_epilepsy,
                        label: "Epilepsy :",
                        "setter-event": "set-comorbid_epilepsy",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_epilepsy-extras"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "form-inline" },
                        [
                          _c("input-select", {
                            attrs: {
                              field: "comorbid_epilepsy_specific",
                              value:
                                _vm.note.detail.comorbid_epilepsy_specific_text,
                              label: "Specify :",
                              size: "normal"
                            }
                          })
                        ],
                        1
                      )
                    ]
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
                        field: "comorbid_pacemaker_implant",
                        value: _vm.note.detail.comorbid_pacemaker_implant,
                        label: "Pacemaker implant :",
                        "setter-event": "set-comorbid_pacemaker_implant",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update":
                          "reset-comorbid_pacemaker_implant-extras"
                      }
                    },
                    [
                      _c("input-radio", {
                        attrs: {
                          field: "comorbid_pacemaker_implant_specific",
                          value:
                            _vm.note.detail.comorbid_pacemaker_implant_specific,
                          label: "Specify :",
                          options:
                            '[\r\n                                {\r\n                                    "label": "DDDR", "value": 1,\r\n                                    "labelDescription": "dual-chamber, rate-modulated"\r\n                                },\r\n                                {   "label": "VI", "value": 2   }\r\n                            ]'
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
                        field: "comorbid_chronic_arthritis",
                        value: _vm.note.detail.comorbid_chronic_arthritis,
                        label: "Chronic arthritis :",
                        "setter-event": "set-comorbid_chronic_arthritis",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update":
                          "reset-comorbid_chronic_arthritis-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: { checks: _vm.chronicArthritisSpecificChecks }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_chronic_arthritis_other",
                          value:
                            _vm.note.detail.comorbid_chronic_arthritis_other,
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
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "comorbid_TB",
                        value: _vm.note.detail.comorbid_TB,
                        label: "TB :",
                        "setter-event": "set-comorbid_TB",
                        options: _vm.comorbidOptions,
                        "trigger-value": _vm.comorbidExtrasTriggerValue,
                        "emit-on-update": "reset-comorbid_TB-extras"
                      }
                    },
                    [
                      _c("input-check-group", {
                        attrs: { checks: _vm.TBSpecificChecks }
                      }),
                      _vm._v(" "),
                      _c("input-text", {
                        attrs: {
                          field: "comorbid_TB_other",
                          value: _vm.note.detail.comorbid_TB_other,
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
            ]),
            _vm._v(" "),
            _c("input-textarea", {
              attrs: {
                field: "other_comorbid",
                value: _vm.note.detail.other_comorbid,
                label: "Other comorbid :",
                grid: "12-12-12",
                "max-chars": "1000"
              }
            }),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12" }, [
              _c("hr", { staticClass: "line" })
            ]),
            _vm._v(" "),
            _c("input-textarea", {
              attrs: {
                field: "history_of_present_illness",
                value: _vm.note.detail.history_of_present_illness,
                label: "History of present illness :",
                grid: "12-12-6",
                "max-chars": "2000"
              }
            }),
            _vm._v(" "),
            _c("input-textarea", {
              attrs: {
                field: "history_of_past_illness",
                value: _vm.note.detail.history_of_past_illness,
                label: "History of past illness :",
                grid: "12-12-6",
                "max-chars": "2000"
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Personal and Social history" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _vm.note.admission.patient.gender == 0
              ? _c("div", { staticClass: "col-xs-12 col-sm-6 col-md-4" }, [
                  _c(
                    "div",
                    { staticClass: "material-box" },
                    [
                      _c(
                        "input-radio",
                        {
                          attrs: {
                            field: "pregnancy",
                            value: _vm.note.detail.pregnancy,
                            label: "Pregnant : ",
                            options:
                              '[\r\n                            {"label": "No", "value": "0"},\r\n                            {"label": "Yes", "value": "1"},\r\n                            {"label": "Uncertain", "value": "2"}\r\n                        ]',
                            "trigger-value": _vm.comorbidExtrasTriggerValue,
                            "emit-on-update": "reset-pregnancy-extras"
                          }
                        },
                        [
                          _c("input-text-addon", {
                            attrs: {
                              field: "gestation_weeks",
                              value: _vm.note.detail.gestation_weeks,
                              "front-addon": "Gestation",
                              pattern: "^([1-9]|[123]\\d|40)$",
                              "invalid-text":
                                "Data could not be saved, Accept 1 to 40 weeks only.",
                              "rear-addon": "Weeks"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c("input-text-addon", {
                        attrs: {
                          field: "LMP",
                          value: _vm.note.detail.LMP,
                          "front-addon":
                            'LMP <a role="button" data-toggle="tooltip" title="ลงข้อมูล LMP เป็นวันที่ในรูปแบบ dd/mm/yyyy หรือหากไม่ทราบให้บรรยายเช่น 10 ปีที่ผ่านมา เป็นต้น"><i class="fa fa-info-circle"></i></a>'
                        }
                      })
                    ],
                    1
                  )
                ])
              : _vm._e(),
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
                        field: "alcohol",
                        value: _vm.note.detail.alcohol,
                        label: "Alcohol : ",
                        options:
                          '[\r\n                            {"label": "No", "value": "0"},\r\n                            {"label": "Yes", "value": "1"},\r\n                            {"label": "Ex-drinker", "value": "2"}\r\n                        ]',
                        "trigger-value": "[1,2]",
                        "emit-on-update": "reset-alcohol-extras"
                      }
                    },
                    [
                      _c("input-textarea", {
                        attrs: {
                          field: "alcohol_description",
                          value: _vm.note.detail.alcohol_description,
                          placeholder: "description"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ]),
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
                        field: "cigarette_smoking",
                        value: _vm.note.detail.cigarette_smoking,
                        label: "Cigarette smoking : ",
                        options:
                          '[\r\n                            {"label": "No", "value": "0"},\r\n                            {"label": "Yes", "value": "1"},\r\n                            {"label": "Ex-smoker", "value": "2"}\r\n                        ]',
                        "trigger-value": "[1,2]",
                        "emit-on-update": "reset-cigarette_smoking-extras"
                      }
                    },
                    [
                      _c("input-textarea", {
                        attrs: {
                          field: "smoke_description",
                          value: _vm.note.detail.smoke_description,
                          placeholder: "description"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12" }, [
              _c("hr", { staticClass: "line" })
            ]),
            _vm._v(" "),
            _c("input-textarea", {
              attrs: {
                field: "personal_social_history",
                value: _vm.note.detail.personal_social_history,
                placeholder: "personal and social history description",
                grid: "12-12-12",
                "max-chars": "2000"
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Special requirement" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c(
              "div",
              { staticClass: "col-xs-12" },
              [
                _c("input-check-group", {
                  attrs: { checks: _vm.specialRequirementChecks }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c("input-textarea", {
              attrs: {
                field: "other_special_requirement",
                value: _vm.note.detail.other_special_requirement,
                placeholder: "Other requirement, type here",
                grid: "12-12-12"
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Family history" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-textarea", {
              attrs: {
                field: "family_history",
                value: _vm.note.detail.family_history,
                grid: "12-12-12",
                "max-chars": "2000"
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Current medications" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-suggestion", {
              ref: "current_medications_helper",
              attrs: {
                "target-id": "current_medications_helper",
                "store-data": "store-data",
                setterEvent: "set-current_medications_helper",
                grid: "8-8-4",
                "service-url": "autocomplete/drug",
                placeholder: "search drug using generic, trade or synonym name"
              }
            }),
            _vm._v(" "),
            _c("button-app", {
              attrs: {
                action: "append-current_medications",
                label: "Append",
                status: "draft",
                size: "sm"
              }
            }),
            _vm._v(" "),
            _c("button-app", {
              attrs: {
                action: "put-current_medications",
                label: "Put",
                status: "draft",
                size: "sm"
              }
            }),
            _vm._v(" "),
            _c("input-textarea", {
              attrs: {
                field: "current_medications",
                value: _vm.note.detail.current_medications,
                "setter-event": "set-current_medications",
                "max-chars": "1000",
                grid: "12-12-12"
              }
            })
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c(
        "panel",
        { attrs: { heading: "Allergy/Adverse event (Drug, Food, Chemical)" } },
        [
          _c(
            "div",
            { staticClass: "row" },
            [
              _c("input-textarea", {
                attrs: {
                  field: "allergy",
                  value: _vm.note.detail.allergy,
                  grid: "12-12-12"
                }
              })
            ],
            1
          )
        ]
      ),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Review of systems" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-textarea", {
              attrs: {
                field: "general_symptoms",
                value: _vm.note.detail.general_symptoms,
                label: "General symptoms :",
                grid: "12-12-12",
                "max-chars": "1000",
                "label-action":
                  '{"emit": "toggle-general-symptoms-helper", "icon": "h-square", "title": "Open helper" }',
                "setter-event": "set-general_symptoms"
              }
            }),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12" }, [
              _c("hr", { staticClass: "line" })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12 col-md-6" },
              [
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_hair_and_skin",
                        value: _vm.note.detail.review_system_hair_and_skin,
                        label: "Hair and Skin :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_hair_and_skin_description",
                    value:
                      _vm.note.detail.review_system_hair_and_skin_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_head",
                        value: _vm.note.detail.review_system_head,
                        label: "Head :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_head_description",
                    value: _vm.note.detail.review_system_head_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_eye_ENT",
                        value: _vm.note.detail.review_system_eye_ENT,
                        label: "Eye/ENT :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_eye_ENT_description",
                    value: _vm.note.detail.review_system_eye_ENT_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_breast",
                        value: _vm.note.detail.review_system_breast,
                        label: "Breast :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_breast_description",
                    value: _vm.note.detail.review_system_breast_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_CVS",
                        value: _vm.note.detail.review_system_CVS,
                        label: "CVS :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_CVS_description",
                    value: _vm.note.detail.review_system_CVS_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_RS",
                        value: _vm.note.detail.review_system_RS,
                        label: "RS :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_RS_description",
                    value: _vm.note.detail.review_system_RS_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12 col-md-6" },
              [
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_GI",
                        value: _vm.note.detail.review_system_GI,
                        label: "GI :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_GI_description",
                    value: _vm.note.detail.review_system_GI_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_GU",
                        value: _vm.note.detail.review_system_GU,
                        label: "GU :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_GU_description",
                    value: _vm.note.detail.review_system_GU_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_musculoskeletal",
                        value: _vm.note.detail.review_system_musculoskeletal,
                        label: "Musculoskeletal :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_musculoskeletal_description",
                    value:
                      _vm.note.detail.review_system_musculoskeletal_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_nervous_system",
                        value: _vm.note.detail.review_system_nervous_system,
                        label: "Nervous system :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_nervous_system_description",
                    value:
                      _vm.note.detail.review_system_nervous_system_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "review_system_psychological_symptoms",
                        value:
                          _vm.note.detail.review_system_psychological_symptoms,
                        label: "Psychological symptoms :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "review_system_psychological_symptoms_description",
                    value:
                      _vm.note.detail
                        .review_system_psychological_symptoms_description,
                    placeholder: "description",
                    "max-chars": "1000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ])
              ],
              1
            )
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Vital signs" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-text-addon", {
              attrs: {
                field: "temperature_celsius",
                value: _vm.note.detail.temperature_celsius,
                label: "Temperature :",
                pattern: "^((([234]\\d{1})?([.]?\\d?)?)|50([.]?0*)?)$",
                "invalid-text":
                  "Data could not be saved. Accept range [20, 50], Integer or 1 point decimal only",
                "rear-addon": "&deg;C",
                placeholder: "Integer or 1 point decimal only",
                grid: "12-6-3"
              }
            }),
            _vm._v(" "),
            _c("input-text-addon", {
              attrs: {
                field: "pulse_rate_per_min",
                value: _vm.note.detail.pulse_rate_per_min,
                label: "Pulse :",
                pattern: "^([23456789]\\d|[1][01]\\d|120)$",
                "invalid-text":
                  "Data could not be saved. Accept range [20, 120], Integer only",
                "rear-addon": "/min",
                placeholder: "Integer only",
                grid: "12-6-3"
              }
            }),
            _vm._v(" "),
            _c("input-text-addon", {
              attrs: {
                field: "respiratory_rate_per_min",
                value: _vm.note.detail.respiratory_rate_per_min,
                label: "Respiratory rate :",
                pattern: "^([1]\\d|[23]\\d|40)$",
                "invalid-text":
                  "Data could not be saved. Accept range [10, 40], Integer only",
                "rear-addon": "/min",
                placeholder: "Integer only",
                grid: "12-6-3"
              }
            }),
            _vm._v(" "),
            _c("input-text-addon", {
              attrs: {
                field: "BP",
                value: _vm.note.detail.BP,
                label: "Blood presure :",
                "rear-addon": "mmHg",
                placeholder: "SBP/DBP",
                pattern: "^([89]\\d|1[123]\\d|140)\\/([5678]\\d|90)$",
                "invalid-text":
                  "Data could not be saved. Accept range [80, 140]/[50, 90], in SBP/DBP format",
                grid: "12-6-3"
              }
            }),
            _vm._v(" "),
            _c("input-text-addon", {
              attrs: {
                field: "height_cm",
                value: _vm.note.detail.height_cm,
                label: "Height :",
                "front-addon": _vm.estimatedHeightTemplate,
                "rear-addon": "cm",
                "emit-on-update": "BMI-updates",
                placeholder: "Integer or 1 point decimal only",
                "store-data": "note-store-data",
                pattern:
                  "^([5-9]\\d([.]?\\d)?|[1]\\d{2}([.]?\\d)?|[2][0-7]\\d([.]?\\d)?|280([.]?0*)?)$",
                "invalid-text":
                  "Data could not be saved. Accept range [50, 280], Integer or 1 point decimal only",
                grid: "12-6-3"
              }
            }),
            _vm._v(" "),
            _c("input-text-addon", {
              attrs: {
                field: "weight_kg",
                value: _vm.note.detail.weight_kg,
                label: "Weight :",
                "front-addon": _vm.estimatedWeightTemplate,
                "rear-addon": "kg",
                "emit-on-update": "BMI-updates",
                placeholder: "Integer or 1 point decimal only",
                "store-data": "note-store-data",
                pattern:
                  "^([2-9]\\d([.]?\\d)?|[1-5]\\d{2}([.]?\\d)?|600([.]?0*)?)$",
                "invalid-text":
                  "Data could not be saved. Accept range [20, 600], Integer or 1 point decimal only",
                grid: "12-6-3"
              }
            }),
            _vm._v(" "),
            _c("input-text-addon", {
              ref: "BMI",
              attrs: {
                value: _vm.autoCalculateBMI,
                label: "BMI ",
                "label-description": "Auto calculate",
                "rear-addon": "kg/m<sup>2</sup>",
                grid: "12-6-3",
                "setter-event": "update-BMI",
                readonly: ""
              }
            }),
            _vm._v(" "),
            _c("input-text-addon", {
              attrs: {
                field: "SpO2",
                value: _vm.note.detail.SpO2,
                label: "SpO<sub>2</sub> ",
                "label-description": "as indicated",
                pattern: "^([3-9]\\d|100)$",
                "invalid-text":
                  "Data could not be saved. Accept range [30, 100], Integer only",
                "rear-addon": "%",
                grid: "12-6-3"
              }
            }),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12 col-md-6" }, [
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c(
                    "input-radio",
                    {
                      attrs: {
                        field: "breathing",
                        label: "Breathing :",
                        value: _vm.note.detail.breathing,
                        options:
                          '[\r\n                            {"label": "Room air", "value": 1},\r\n                            {"label": "O<sub>2</sub>-Canula", "value": 2},\r\n                            {"label": "O<sub>2</sub>-Mask with bag", "value": 3},\r\n                            {"label": "O<sub>2</sub>-On ventilator", "value": 4}\r\n                        ]',
                        "trigger-value": "[2,3,4]",
                        "store-data": "note-store-data",
                        "emit-on-update": "reset-breathing-extras"
                      }
                    },
                    [
                      _c(
                        "div",
                        { staticClass: "form-inline" },
                        [
                          _c("input-text-addon", {
                            attrs: {
                              field: "O2_rate",
                              value: _vm.note.detail.O2_rate,
                              "front-addon": "O<sub>2</sub> rate",
                              "rear-addon": _vm.O2RateRearAddon,
                              pattern: "^((\\d{1,2})([.]\\d)?)$",
                              "invalid-text":
                                "Data could not be saved. Accept range [0, 99.9], Integer or 1 point decimal only"
                            }
                          })
                        ],
                        1
                      )
                    ]
                  )
                ],
                1
              ),
              _vm._v(" "),
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c("input-radio", {
                    attrs: {
                      field: "mental_evaluation",
                      value: _vm.note.detail.mental_evaluation,
                      label: "Mental evaluation :",
                      options:
                        '[\r\n                            {"label": "Awake", "value": 1},\r\n                            {"label": "Drowsy", "value": 2},\r\n                            {"label": "Stuporous", "value": 3},\r\n                            {"label": "Unconscious", "value": 4}\r\n                        ]'
                    }
                  }),
                  _vm._v(" "),
                  _c("input-check-group", {
                    attrs: {
                      label: "Mental orientation :",
                      checks: _vm.mentalOrientationChecks
                    }
                  })
                ],
                1
              )
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12 col-md-6" }, [
              _c(
                "div",
                { staticClass: "material-box" },
                [
                  _c("input-radio", {
                    attrs: {
                      field: "level_of_consciousness",
                      value: _vm.note.detail.level_of_consciousness,
                      label: "Level of consciousness :",
                      options:
                        '[\r\n                            {"label": "Appropriate", "value": 1},\r\n                            {"label": "Retardation", "value": 2},\r\n                            {"label": "Depressed", "value": 3},\r\n                            {"label": "Psychotic", "value": 4}\r\n                        ]'
                    }
                  }),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "form-inline" },
                    [
                      _c("input-text", {
                        attrs: {
                          placeholder: "Glassglow coma score:Auto Calculate",
                          value: _vm.autoCalculateGCS,
                          readonly: "",
                          "setter-event": "update-GCS"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "form-inline" },
                    [
                      _c("input-select", {
                        attrs: {
                          field: "GCS_E",
                          value: _vm.note.detail.GCS_E_text,
                          size: "normal",
                          "not-allow-other": "",
                          placeholder: "select GCS - E",
                          "store-data": "note-store-data",
                          "emit-on-update": "GCS-updates"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "form-inline" },
                    [
                      _c("input-select", {
                        attrs: {
                          field: "GCS_V",
                          value: _vm.note.detail.GCS_V_text,
                          size: "normal",
                          "not-allow-other": "",
                          placeholder: "select GCS - V",
                          "store-data": "note-store-data",
                          "emit-on-update": "GCS-updates"
                        }
                      })
                    ],
                    1
                  ),
                  _vm._v(" "),
                  _c(
                    "div",
                    { staticClass: "form-inline" },
                    [
                      _c("input-select", {
                        attrs: {
                          field: "GCS_M",
                          value: _vm.note.detail.GCS_M_text,
                          size: "normal",
                          "not-allow-other": "",
                          placeholder: "select GCS - M",
                          "store-data": "note-store-data",
                          "emit-on-update": "GCS-updates"
                        }
                      })
                    ],
                    1
                  )
                ],
                1
              )
            ])
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Physical examinations" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-textarea", {
              attrs: {
                field: "general_appearance",
                value: _vm.note.detail.general_appearance,
                label: "General appearance :",
                placeholder: "Specify important findings",
                "max-chars": "2000",
                grid: "12-12-12"
              }
            }),
            _vm._v(" "),
            _c("div", { staticClass: "col-xs-12" }, [
              _c("hr", { staticClass: "line" })
            ]),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12 col-md-6" },
              [
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_skin",
                        value: _vm.note.detail.physical_exam_skin,
                        label: "Skin :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_skin_description",
                    value: _vm.note.detail.physical_exam_skin_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_head",
                        value: _vm.note.detail.physical_exam_head,
                        label: "Head :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_head_description",
                    value: _vm.note.detail.physical_exam_head_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_eye_ENT",
                        value: _vm.note.detail.physical_exam_eye_ENT,
                        label: "Eye/ENT :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_eye_ENT_description",
                    value: _vm.note.detail.physical_exam_eye_ENT_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_neck",
                        value: _vm.note.detail.physical_exam_neck,
                        label: "Neck :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_neck_description",
                    value: _vm.note.detail.physical_exam_neck_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_heart",
                        value: _vm.note.detail.physical_exam_heart,
                        label: "Heart :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_heart_description",
                    value: _vm.note.detail.physical_exam_heart_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_lung",
                        value: _vm.note.detail.physical_exam_lung,
                        label: "Lung :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_lung_description",
                    value: _vm.note.detail.physical_exam_lung_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_abdomen",
                        value: _vm.note.detail.physical_exam_abdomen,
                        label: "Abdomen :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_abdomen_description",
                    value: _vm.note.detail.physical_exam_abdomen_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ])
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12 col-md-6" },
              [
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_nervous_system",
                        value: _vm.note.detail.physical_exam_nervous_system,
                        label: "Nervous system :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_nervous_system_description",
                    value:
                      _vm.note.detail.physical_exam_nervous_system_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_extremities",
                        value: _vm.note.detail.physical_exam_extremities,
                        label: "Extremities :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_extremities_description",
                    value:
                      _vm.note.detail.physical_exam_extremities_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_lymph_nodes",
                        value: _vm.note.detail.physical_exam_lymph_nodes,
                        label: "Lymph nodes :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_lymph_nodes_description",
                    value:
                      _vm.note.detail.physical_exam_lymph_nodes_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_breasts",
                        value: _vm.note.detail.physical_exam_breasts,
                        label: "Breasts :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_breasts_description",
                    value: _vm.note.detail.physical_exam_breasts_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_genitalia",
                        value: _vm.note.detail.physical_exam_genitalia,
                        label: "Genitalia :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_genitalia_description",
                    value: _vm.note.detail.physical_exam_genitalia_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ]),
                _vm._v(" "),
                _c(
                  "div",
                  { staticClass: "col-xs-12" },
                  [
                    _c("input-radio", {
                      attrs: {
                        field: "physical_exam_rectal_examination",
                        value: _vm.note.detail.physical_exam_rectal_examination,
                        label: "Rectal examination :",
                        options: _vm.reviewSystemPhysicalExamOptions
                      }
                    })
                  ],
                  1
                ),
                _vm._v(" "),
                _c("input-textarea", {
                  attrs: {
                    field: "physical_exam_rectal_examination_description",
                    value:
                      _vm.note.detail
                        .physical_exam_rectal_examination_description,
                    placeholder: "description",
                    "max-chars": "2000",
                    grid: "12-12-12"
                  }
                }),
                _vm._v(" "),
                _c("div", { staticClass: "col-xs-12" }, [
                  _c("hr", { staticClass: "line" })
                ])
              ],
              1
            )
          ],
          1
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "Problem list, Discussion and Plan" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _vm._l(_vm.plans, function(column) {
              return _c(
                "div",
                { key: column.key, staticClass: "col-xs-12 col-md-6" },
                _vm._l(column.plans, function(plan) {
                  return _c("input-textarea", {
                    key: plan.field,
                    attrs: {
                      field: plan.field,
                      value: plan.value,
                      label: plan.label,
                      "max-chars": plan.maxChars
                    }
                  })
                })
              )
            }),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12 col-md-6" },
              [
                _c("input-select", {
                  attrs: {
                    field: "CPG_special_group",
                    value: _vm.note.detail.CPG_special_group_text,
                    label: "Special group (accoring to CPG) :",
                    "not-allow-other": ""
                  }
                })
              ],
              1
            ),
            _vm._v(" "),
            _c(
              "div",
              { staticClass: "col-xs-12 col-md-6" },
              [
                _c("input-text", {
                  attrs: {
                    field: "estimated_length_of_stay",
                    value: _vm.note.detail.estimated_length_of_stay,
                    label: "Estimated dulation of hospitalization ",
                    "label-description":
                      "enter approximate length of stay(days) or leave blank if cannot be presently determined"
                  }
                })
              ],
              1
            )
          ],
          2
        )
      ]),
      _vm._v(" "),
      _c("panel", { attrs: { heading: "MD note" } }, [
        _c(
          "div",
          { staticClass: "row" },
          [
            _c("input-textarea", {
              attrs: {
                field: "MD_note",
                value: _vm.note.detail.MD_note,
                "max-chars": "1000",
                grid: "12-12-12"
              }
            })
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
    require("vue-hot-reload-api")      .rerender("data-v-820f0ba8", module.exports)
  }
}

/***/ })
],[254]);