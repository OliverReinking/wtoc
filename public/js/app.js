(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/app"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=script&lang=js&":
/*!************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/ConditionalVisible.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var in_viewport__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! in-viewport */ "./node_modules/in-viewport/in-viewport.js");
/* harmony import */ var in_viewport__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(in_viewport__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  props: ["whenHidden"],
  data: function data() {
    return {
      shouldDisplay: false
    };
  },
  mounted: function mounted() {
    var _this = this;

    window.addEventListener("scroll", function () {
      _this.shouldDisplay = !in_viewport__WEBPACK_IMPORTED_MODULE_0___default()(document.querySelector(_this.whenHidden));
    }, {
      passive: true
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/LigaLiveTicker.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/LigaLiveTicker.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
    saisonname: {
      type: String,
      "default": "unbekannt"
    },
    liganame: {
      type: String,
      "default": "unbekannt"
    },
    spieltagname: {
      type: String,
      "default": "unbekannt"
    },
    heimname: {
      type: String,
      "default": "unbekannt"
    },
    gastname: {
      type: String,
      "default": "unbekannt"
    }
  },
  data: function data() {
    return {
      meldung: null,
      fehlerkz: false,
      spielminute: 0,
      torchancen: [],
      ergebnisse: null
    };
  },
  created: function created() {
    var _this = this;

    window.Echo.channel("ligaliveticker").listen("LigaLiveTicker", function (e) {
      console.log("VUE-Komponente LigaLiveTicker -> Event LigaLiveTicker", e);
      var chance = null;
      chance = e.spielereignis;
      _this.spielminute = e.spielminute;

      if (chance !== null) {
        console.log("chance ist ungleich null: ", chance);

        _this.torchancen.unshift(chance);
      }

      _this.ergebnisse = e.spielergebnis;
    });
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/MainNavigation.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/MainNavigation.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
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
      isMenu: false
    };
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/SmoothScroll.vue?vue&type=script&lang=js&":
/*!******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/SmoothScroll.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  props: ['href'],
  methods: {
    scroll: function scroll() {
      document.querySelector(this.href).scrollIntoView({
        behavior: 'smooth'
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/plugins/modal/Modal.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
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
  props: ["name"]
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css&":
/*!*******************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css& ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, ".fade-enter-active,\r\nfade-leave-active {\n  transition: opacity 3s;\n}\n.fade-enter,\r\n.fade-leave-to {\n  opacity: 0;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "footer:empty {\n  display: none;\n}\nheader:empty {\n  display: none;\n}\n.overlay {\n  visibility: hidden;\n  position: absolute;\n  top: 0;\n  right: 0;\n  bottom: 0;\n  left: 0;\n  display: flex;\n  align-items: center;\n  justify-content: center;\n  background: rgba(255, 0, 0, 0.6);\n  transition: opacity 1s;\n  opacity: 0;\n}\n.overlay:target {\n  visibility: visible;\n  opacity: 1;\n}\n.modal {\n  position: relative;\n  width: 500px;\n  max-width: 80%;\n  background: white;\n  border-radius: 8px;\n  padding: 1.5em;\n  box-shadow: 0 5px 11px rgba(36, 37, 38, 0.08);\n}\n.modal .close {\n  position: absolute;\n  top: 15px;\n  right: 15px;\n  color: grey;\n  text-decoration: none;\n}\n.overlay .cancel {\n  position: absolute;\n  width: 100%;\n  height: 100%;\n}\r\n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css&":
/*!***********************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css& ***!
  \***********************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConditionalVisible.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css&":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css& ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./Modal.vue?vue&type=style&index=0&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=template&id=21d0c25b&":
/*!****************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/ConditionalVisible.vue?vue&type=template&id=21d0c25b& ***!
  \****************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("transition", { attrs: { name: "fade" } }, [
    _vm.shouldDisplay ? _c("div", [_vm._t("default")], 2) : _vm._e()
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/LigaLiveTicker.vue?vue&type=template&id=7efc67dc&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/LigaLiveTicker.vue?vue&type=template&id=7efc67dc& ***!
  \************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c(
      "div",
      { staticClass: "container mx-auto text-center flex flex-col my-4" },
      [
        _vm.fehlerkz
          ? _c("div", { staticClass: "bg-red-500 p-4 rounded-lg shadow-md" }, [
              _vm._v(_vm._s(_vm.meldung))
            ])
          : _vm._e(),
        _vm._v(" "),
        !_vm.fehlerkz
          ? _c(
              "div",
              { staticClass: "bg-green-500 p-4 rounded-lg shadow-md" },
              [
                _vm.spielminute > 9
                  ? _c(
                      "div",
                      { staticClass: "bg-black text-center my-2 rounded" },
                      [
                        _c(
                          "div",
                          {
                            staticClass: "bg-red-500 p-1 rounded-l",
                            style: "width:" + (_vm.spielminute * 100) / 90 + "%"
                          },
                          [
                            _c("span", { staticClass: "text-sm" }, [
                              _vm._v(_vm._s(_vm.spielminute) + " Minute")
                            ])
                          ]
                        )
                      ]
                    )
                  : _vm._e(),
                _vm._v(" "),
                _c("div", { staticClass: "flex -mx-2 mt-8" }, [
                  _c("div", {
                    staticClass:
                      "w-2/5 mx-2 bg-gray-300 p-2 rounded-lg shadow-md text-left text-sm",
                    domProps: { innerHTML: _vm._s(_vm.ergebnisse) }
                  }),
                  _vm._v(" "),
                  _c(
                    "div",
                    {
                      staticClass:
                        "w-3/5 mx-2 bg-gray-300 p-2 rounded-lg shadow-md text-left overflow-y-auto h-liveticker"
                    },
                    _vm._l(_vm.torchancen, function(torchance, index) {
                      return _c(
                        "div",
                        {
                          key: index,
                          staticClass: "text-base text-medium p-1"
                        },
                        [
                          _c("div", {
                            domProps: { innerHTML: _vm._s(torchance) }
                          })
                        ]
                      )
                    }),
                    0
                  )
                ])
              ]
            )
          : _vm._e()
      ]
    )
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/MainNavigation.vue?vue&type=template&id=7de5a208&":
/*!************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/MainNavigation.vue?vue&type=template&id=7de5a208& ***!
  \************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "w-full bg-blue-500" }, [
    _c("div", { staticClass: "container w-full mx-auto max-w-6xl" }, [
      _c("nav", { staticClass: "flex flex-col" }, [
        _c(
          "div",
          {
            staticClass: "flex-1 w-full flex flex-col md:flex-row items-center"
          },
          [
            _vm._m(0),
            _vm._v(" "),
            _c(
              "div",
              {
                staticClass:
                  "md:hidden w-full flex-1 flex flex-col py-4 px-4 items-center text-gray-300"
              },
              [
                _c(
                  "div",
                  { staticClass: "flex flex-col py-4 px-4 text-center" },
                  [
                    _c(
                      "button",
                      {
                        directives: [
                          {
                            name: "show",
                            rawName: "v-show",
                            value: !_vm.isMenu,
                            expression: "!isMenu"
                          }
                        ],
                        on: {
                          click: function($event) {
                            _vm.isMenu = !_vm.isMenu
                          }
                        }
                      },
                      [
                        _c("i", {
                          staticClass: "fa fa-bars text-2xl text-white"
                        })
                      ]
                    ),
                    _vm._v(" "),
                    _c(
                      "button",
                      {
                        directives: [
                          {
                            name: "show",
                            rawName: "v-show",
                            value: _vm.isMenu,
                            expression: "isMenu"
                          }
                        ],
                        staticClass: "md:hidden",
                        on: {
                          click: function($event) {
                            _vm.isMenu = !_vm.isMenu
                          }
                        }
                      },
                      [
                        _c("i", {
                          staticClass: "fa fa-times-circle text-2xl text-white"
                        })
                      ]
                    )
                  ]
                ),
                _vm._v(" "),
                _c(
                  "div",
                  {
                    directives: [
                      {
                        name: "show",
                        rawName: "v-show",
                        value: _vm.isMenu,
                        expression: "isMenu"
                      }
                    ],
                    staticClass: "w-full flex flex-col"
                  },
                  [
                    _vm._m(1),
                    _vm._v(" "),
                    _vm._m(2),
                    _vm._v(" "),
                    _vm._m(3),
                    _vm._v(" "),
                    _vm._m(4),
                    _vm._v(" "),
                    _vm._m(5),
                    _vm._v(" "),
                    _vm._m(6),
                    _vm._v(" "),
                    _vm._m(7),
                    _vm._v(" "),
                    _vm._m(8)
                  ]
                )
              ]
            ),
            _vm._v(" "),
            _vm._m(9)
          ]
        )
      ])
    ])
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      { staticClass: "hidden md:block py-4 px-4", attrs: { id: "WTOCLogo" } },
      [
        _c("a", { attrs: { href: "/about" } }, [
          _c("img", {
            staticClass: "h-8 w-auto",
            attrs: { src: "/images/Logo_WTOC.png", title: "WTOC" }
          })
        ])
      ]
    )
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/about" }
        },
        [_vm._v("Home")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/aktion" }
        },
        [_vm._v("Aktion")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/country" }
        },
        [_vm._v("Ligen")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/cup" }
        },
        [_vm._v("Cup")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/worldchampionship" }
        },
        [_vm._v("WM")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/news" }
        },
        [_vm._v("News")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/login" }
        },
        [_vm._v("Login")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "w-full flex-1 text-center" }, [
      _c(
        "a",
        {
          staticClass:
            "block p-1 my-1 text-xl rounded-lg hover:bg-green-400 hover:text-white",
          attrs: { href: "/signin" }
        },
        [_vm._v("Register")]
      )
    ])
  },
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c(
      "div",
      {
        staticClass:
          "hidden w-full md:flex flex-row py-4 px-4 justify-between items-center text-gray-300"
      },
      [
        _c("div", { staticClass: "flex flex-row items-center" }, [
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/about" }
              },
              [_vm._v("Home")]
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/aktion" }
              },
              [_vm._v("Aktion")]
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/country" }
              },
              [_vm._v("Ligen")]
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/cup" }
              },
              [_vm._v("Cup")]
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/worldchampionship" }
              },
              [_vm._v("WM")]
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/news" }
              },
              [_vm._v("News")]
            )
          ])
        ]),
        _vm._v(" "),
        _c("div", { staticClass: "flex flex-row" }, [
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/login" }
              },
              [_vm._v("Login")]
            )
          ]),
          _vm._v(" "),
          _c("div", { staticClass: "mr-2 text-center" }, [
            _c(
              "a",
              {
                staticClass:
                  "block my-0 py-2 px-2 text-base rounded-lg hover:bg-green-400 hover:text-white",
                attrs: { href: "/signin" }
              },
              [_vm._v("Register")]
            )
          ])
        ])
      ]
    )
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/SmoothScroll.vue?vue&type=template&id=7280df2a&":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/shared/SmoothScroll.vue?vue&type=template&id=7280df2a& ***!
  \**********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "a",
    {
      attrs: { href: _vm.href },
      on: {
        click: function($event) {
          $event.preventDefault()
          return _vm.scroll($event)
        }
      }
    },
    [_vm._t("default")],
    2
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=template&id=f0e84ca4&":
/*!***********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/plugins/modal/Modal.vue?vue&type=template&id=f0e84ca4& ***!
  \***********************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "overlay text-left", attrs: { id: _vm.name } },
    [
      _c("a", { staticClass: "cancel", attrs: { href: "#" } }),
      _vm._v(" "),
      _c(
        "div",
        { staticClass: "modal flex flex-col" },
        [
          _c(
            "header",
            { staticClass: "flex mt-2 text-2xl" },
            [_vm._t("header")],
            2
          ),
          _vm._v(" "),
          _vm._t("default"),
          _vm._v(" "),
          _c("footer", { staticClass: "flex mt-2" }, [_vm._t("footer")], 2),
          _vm._v(" "),
          _c("a", { staticClass: "close text-xl", attrs: { href: "#" } }, [
            _vm._v("×")
          ])
        ],
        2
      )
    ]
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _plugins_modal_ModalPlugin__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./plugins/modal/ModalPlugin */ "./resources/js/plugins/modal/ModalPlugin.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
/* harmony import */ var axios__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(axios__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _components_shared_LigaLiveTicker__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./components/shared/LigaLiveTicker */ "./resources/js/components/shared/LigaLiveTicker.vue");
/* harmony import */ var _components_shared_SmoothScroll__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./components/shared/SmoothScroll */ "./resources/js/components/shared/SmoothScroll.vue");
/* harmony import */ var _components_shared_MainNavigation__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./components/shared/MainNavigation */ "./resources/js/components/shared/MainNavigation.vue");
/* harmony import */ var _components_shared_ConditionalVisible__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./components/shared/ConditionalVisible */ "./resources/js/components/shared/ConditionalVisible.vue");
/* harmony import */ var laravel_echo__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! laravel-echo */ "./node_modules/laravel-echo/dist/echo.js");
 //import VueRouter from 'vue-router';
//import routes from './routes/routes';

window.Vue = vue__WEBPACK_IMPORTED_MODULE_0___default.a;

vue__WEBPACK_IMPORTED_MODULE_0___default.a.use(_plugins_modal_ModalPlugin__WEBPACK_IMPORTED_MODULE_1__["default"]);

window.axios = axios__WEBPACK_IMPORTED_MODULE_2___default.a;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; // Komponenten shared





vue__WEBPACK_IMPORTED_MODULE_0___default.a.component('ligaliveticker', _components_shared_LigaLiveTicker__WEBPACK_IMPORTED_MODULE_3__["default"]);
vue__WEBPACK_IMPORTED_MODULE_0___default.a.component('smoothscroll', _components_shared_SmoothScroll__WEBPACK_IMPORTED_MODULE_4__["default"]);
vue__WEBPACK_IMPORTED_MODULE_0___default.a.component('conditionalvisible', _components_shared_ConditionalVisible__WEBPACK_IMPORTED_MODULE_6__["default"]);
vue__WEBPACK_IMPORTED_MODULE_0___default.a.component('mainnavigation', _components_shared_MainNavigation__WEBPACK_IMPORTED_MODULE_5__["default"]); //Vue.use(VueRouter);


window.Pusher = __webpack_require__(/*! pusher-js */ "./node_modules/pusher-js/dist/web/pusher.js");
window.Echo = new laravel_echo__WEBPACK_IMPORTED_MODULE_7__["default"]({
  broadcaster: 'pusher',
  key: "myKey",
  wsHost: window.location.hostname,
  wsPort: 6001,
  disableStats: true
});
var app = new vue__WEBPACK_IMPORTED_MODULE_0___default.a({
  el: '#app' //router: new VueRouter(routes)

});

/***/ }),

/***/ "./resources/js/components/shared/ConditionalVisible.vue":
/*!***************************************************************!*\
  !*** ./resources/js/components/shared/ConditionalVisible.vue ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ConditionalVisible_vue_vue_type_template_id_21d0c25b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ConditionalVisible.vue?vue&type=template&id=21d0c25b& */ "./resources/js/components/shared/ConditionalVisible.vue?vue&type=template&id=21d0c25b&");
/* harmony import */ var _ConditionalVisible_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ConditionalVisible.vue?vue&type=script&lang=js& */ "./resources/js/components/shared/ConditionalVisible.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _ConditionalVisible_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./ConditionalVisible.vue?vue&type=style&index=0&lang=css& */ "./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _ConditionalVisible_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ConditionalVisible_vue_vue_type_template_id_21d0c25b___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ConditionalVisible_vue_vue_type_template_id_21d0c25b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/shared/ConditionalVisible.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/shared/ConditionalVisible.vue?vue&type=script&lang=js&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/shared/ConditionalVisible.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConditionalVisible.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css&":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css& ***!
  \************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConditionalVisible.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/components/shared/ConditionalVisible.vue?vue&type=template&id=21d0c25b&":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/shared/ConditionalVisible.vue?vue&type=template&id=21d0c25b& ***!
  \**********************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_template_id_21d0c25b___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./ConditionalVisible.vue?vue&type=template&id=21d0c25b& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/ConditionalVisible.vue?vue&type=template&id=21d0c25b&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_template_id_21d0c25b___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ConditionalVisible_vue_vue_type_template_id_21d0c25b___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/shared/LigaLiveTicker.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/shared/LigaLiveTicker.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LigaLiveTicker_vue_vue_type_template_id_7efc67dc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LigaLiveTicker.vue?vue&type=template&id=7efc67dc& */ "./resources/js/components/shared/LigaLiveTicker.vue?vue&type=template&id=7efc67dc&");
/* harmony import */ var _LigaLiveTicker_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./LigaLiveTicker.vue?vue&type=script&lang=js& */ "./resources/js/components/shared/LigaLiveTicker.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _LigaLiveTicker_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _LigaLiveTicker_vue_vue_type_template_id_7efc67dc___WEBPACK_IMPORTED_MODULE_0__["render"],
  _LigaLiveTicker_vue_vue_type_template_id_7efc67dc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/shared/LigaLiveTicker.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/shared/LigaLiveTicker.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/shared/LigaLiveTicker.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LigaLiveTicker_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./LigaLiveTicker.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/LigaLiveTicker.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LigaLiveTicker_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/shared/LigaLiveTicker.vue?vue&type=template&id=7efc67dc&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/shared/LigaLiveTicker.vue?vue&type=template&id=7efc67dc& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LigaLiveTicker_vue_vue_type_template_id_7efc67dc___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./LigaLiveTicker.vue?vue&type=template&id=7efc67dc& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/LigaLiveTicker.vue?vue&type=template&id=7efc67dc&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LigaLiveTicker_vue_vue_type_template_id_7efc67dc___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_LigaLiveTicker_vue_vue_type_template_id_7efc67dc___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/shared/MainNavigation.vue":
/*!***********************************************************!*\
  !*** ./resources/js/components/shared/MainNavigation.vue ***!
  \***********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _MainNavigation_vue_vue_type_template_id_7de5a208___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./MainNavigation.vue?vue&type=template&id=7de5a208& */ "./resources/js/components/shared/MainNavigation.vue?vue&type=template&id=7de5a208&");
/* harmony import */ var _MainNavigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./MainNavigation.vue?vue&type=script&lang=js& */ "./resources/js/components/shared/MainNavigation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _MainNavigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _MainNavigation_vue_vue_type_template_id_7de5a208___WEBPACK_IMPORTED_MODULE_0__["render"],
  _MainNavigation_vue_vue_type_template_id_7de5a208___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/shared/MainNavigation.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/shared/MainNavigation.vue?vue&type=script&lang=js&":
/*!************************************************************************************!*\
  !*** ./resources/js/components/shared/MainNavigation.vue?vue&type=script&lang=js& ***!
  \************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MainNavigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./MainNavigation.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/MainNavigation.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_MainNavigation_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/shared/MainNavigation.vue?vue&type=template&id=7de5a208&":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/shared/MainNavigation.vue?vue&type=template&id=7de5a208& ***!
  \******************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MainNavigation_vue_vue_type_template_id_7de5a208___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./MainNavigation.vue?vue&type=template&id=7de5a208& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/MainNavigation.vue?vue&type=template&id=7de5a208&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MainNavigation_vue_vue_type_template_id_7de5a208___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_MainNavigation_vue_vue_type_template_id_7de5a208___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/components/shared/SmoothScroll.vue":
/*!*********************************************************!*\
  !*** ./resources/js/components/shared/SmoothScroll.vue ***!
  \*********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _SmoothScroll_vue_vue_type_template_id_7280df2a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./SmoothScroll.vue?vue&type=template&id=7280df2a& */ "./resources/js/components/shared/SmoothScroll.vue?vue&type=template&id=7280df2a&");
/* harmony import */ var _SmoothScroll_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./SmoothScroll.vue?vue&type=script&lang=js& */ "./resources/js/components/shared/SmoothScroll.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _SmoothScroll_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _SmoothScroll_vue_vue_type_template_id_7280df2a___WEBPACK_IMPORTED_MODULE_0__["render"],
  _SmoothScroll_vue_vue_type_template_id_7280df2a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/shared/SmoothScroll.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/shared/SmoothScroll.vue?vue&type=script&lang=js&":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/shared/SmoothScroll.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SmoothScroll_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./SmoothScroll.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/SmoothScroll.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_SmoothScroll_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/shared/SmoothScroll.vue?vue&type=template&id=7280df2a&":
/*!****************************************************************************************!*\
  !*** ./resources/js/components/shared/SmoothScroll.vue?vue&type=template&id=7280df2a& ***!
  \****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SmoothScroll_vue_vue_type_template_id_7280df2a___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./SmoothScroll.vue?vue&type=template&id=7280df2a& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/shared/SmoothScroll.vue?vue&type=template&id=7280df2a&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SmoothScroll_vue_vue_type_template_id_7280df2a___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_SmoothScroll_vue_vue_type_template_id_7280df2a___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/plugins/modal/Modal.vue":
/*!**********************************************!*\
  !*** ./resources/js/plugins/modal/Modal.vue ***!
  \**********************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Modal_vue_vue_type_template_id_f0e84ca4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Modal.vue?vue&type=template&id=f0e84ca4& */ "./resources/js/plugins/modal/Modal.vue?vue&type=template&id=f0e84ca4&");
/* harmony import */ var _Modal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./Modal.vue?vue&type=script&lang=js& */ "./resources/js/plugins/modal/Modal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _Modal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./Modal.vue?vue&type=style&index=0&lang=css& */ "./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _Modal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _Modal_vue_vue_type_template_id_f0e84ca4___WEBPACK_IMPORTED_MODULE_0__["render"],
  _Modal_vue_vue_type_template_id_f0e84ca4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/plugins/modal/Modal.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/plugins/modal/Modal.vue?vue&type=script&lang=js&":
/*!***********************************************************************!*\
  !*** ./resources/js/plugins/modal/Modal.vue?vue&type=script&lang=js& ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./Modal.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css&":
/*!*******************************************************************************!*\
  !*** ./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css& ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./Modal.vue?vue&type=style&index=0&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=style&index=0&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(["default"].indexOf(__WEBPACK_IMPORT_KEY__) < 0) (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_style_index_0_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));


/***/ }),

/***/ "./resources/js/plugins/modal/Modal.vue?vue&type=template&id=f0e84ca4&":
/*!*****************************************************************************!*\
  !*** ./resources/js/plugins/modal/Modal.vue?vue&type=template&id=f0e84ca4& ***!
  \*****************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_template_id_f0e84ca4___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./Modal.vue?vue&type=template&id=f0e84ca4& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/plugins/modal/Modal.vue?vue&type=template&id=f0e84ca4&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_template_id_f0e84ca4___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_Modal_vue_vue_type_template_id_f0e84ca4___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/js/plugins/modal/ModalPlugin.js":
/*!***************************************************!*\
  !*** ./resources/js/plugins/modal/ModalPlugin.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _Modal_vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./Modal.vue */ "./resources/js/plugins/modal/Modal.vue");

var Plugin = {
  install: function install(Vue) {
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    Vue.component('modal', _Modal_vue__WEBPACK_IMPORTED_MODULE_0__["default"]);
    Vue.prototype.$modal = {
      show: function show(name) {
        location.hash = name;
      },
      hide: function hide(name) {
        location.hash = '#';
      }
    };
  }
};
/* harmony default export */ __webpack_exports__["default"] = (Plugin);

/***/ }),

/***/ "./resources/less/app.less":
/*!*********************************!*\
  !*** ./resources/less/app.less ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/less/app.less ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! F:\Projekte\Code\WTOC\wtoc\resources\js\app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! F:\Projekte\Code\WTOC\wtoc\resources\less\app.less */"./resources/less/app.less");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);