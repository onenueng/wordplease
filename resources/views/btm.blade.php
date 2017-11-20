<!DOCTYPE html>
<html lang="th-TH">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script
      src="https://code.jquery.com/jquery-3.2.1.js"
      integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
      crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <style>
        
        /*
         * demo styles
         */

         body{
           -webkit-overflow-scrolling: touch;
        }

        @media screen and (max-width: 640px){
            
          .footer{
            font-size: 9px;
          }
        }

        .footer__container{
          display: flex;
          justify-content: center;
        }
           
        .melnik909{
          margin-left: 20px;
        }

        /*!
         * Material bootstrap theme  (https://codepen.io/melnik909/details/doeqzy/)
         * Copyright 2016 Stas "melnik909" Melnikov (https://stas-melnikov.ru)
         * Licensed under the MIT license 
         */

        body {
          font-family: 'Roboto', sans-serif;
          font-size: 14px;
          font-weight: 400;
        }
        label {
          font-weight: 400;
        }
        h1, h2, h3, h4, h5, h6 {
          font-family: 'Roboto', sans-serif;
          font-weight: 400;
        }
        .material-dropdown-menu {
          position: absolute;
          top: 0;
          left: 0;
          margin: 0;
          padding: 0;
          border-radius: 0;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
          min-width: 200px;
          width: 100%;
        }
        .material-dropdown-menu .material-dropdown-menu__link {
          text-decoration: none;
          font-size: 14px;
          padding: 8px 20px;
          -webkit-transition: background-color 0.8s ease-out 0s;
          transition: background-color 0.8s ease-out 0s;
        }
        .material-dropdown-menu .material-dropdown__divider {
          margin: 0;
        }
        .material-dropdown__header {
          padding: 10px;
          font-size: 14px;
          font-weight: 700;
        }
        .material-dropdown-menu__link_disabled:hover,
        .material-dropdown-menu__link_disabled:active,
        .material-dropdown-menu__link_disabled:focus {
          background: none !important;
        }
        .material-dropdown__caret {
          position: absolute;
          top: 50%;
          right: 0;
          -webkit-transform: translateZ(0px) translate(0, -50%);
          transform: translateZ(0px) translate(0, -50%);
          border-width: 4px;
        }
        .material-dropdown__btn {
          border: none;
          background: none;
          font-size: 14px;
          display: inline-block;
          width: 100%;
          text-align: left;
          padding: 3px 10px 3px 5px;
        }
        .material-btn-group .material-dropdown-menu {
          top: -1px;
          left: -1px;
        }
        .material-dropdown {
          border-bottom: 1px solid #eee;
        }
        .material-dropdown .material-dropdown__caret {
          border-top-color: #eee;
        }
        .material-dropdown-menu {
          background-color: #eee;
        }
        .material-dropdown-menu .material-dropdown__header {
          color: #000;
        }
        .material-dropdown-menu .material-dropdown__divider {
          background-color: #000;
        }
        .material-dropdown-menu .material-dropdown-menu__link {
          color: #000;
        }
        .material-dropdown-menu .material-dropdown-menu__link:hover {
          color: #000;
          background-color: #f7f7f7;
        }
        .material-dropdown-menu .material-dropdown-menu__link:active,
        .material-dropdown-menu .material-dropdown-menu__link:focus {
          color: #000;
          background-color: #c9c9c9;
        }
        .material-dropdown-menu .material-dropdown-menu__link_disabled {
          color: #000;
        }
        .material-dropdown-menu .material-dropdown-menu__link_disabled:hover,
        .material-dropdown-menu .material-dropdown-menu__link_disabled:active,
        .material-dropdown-menu .material-dropdown-menu__link_disabled:focus {
          color: #000;
        }
        .material-dropdown_primary {
          border-bottom: 1px solid #4092d9;
        }
        .material-dropdown_primary .material-dropdown__caret {
          border-top-color: #4092d9;
        }
        .material-dropdown-menu_primary {
          background-color: #4092d9;
        }
        .material-dropdown-menu_primary .material-dropdown__header {
          color: #fff;
        }
        .material-dropdown-menu_primary .material-dropdown__divider {
          background-color: #fff;
        }
        .material-dropdown-menu_primary .material-dropdown-menu__link {
          color: #fff;
        }
        .material-dropdown-menu_primary .material-dropdown-menu__link:hover {
          color: #fff;
          background-color: #64b2f5;
        }
        .material-dropdown-menu_primary .material-dropdown-menu__link:active,
        .material-dropdown-menu_primary .material-dropdown-menu__link:focus {
          color: #fff;
          background-color: #3488d1;
        }
        .material-dropdown-menu_primary .material-dropdown-menu__link_disabled {
          color: #fff;
        }
        .material-dropdown-menu_primary .material-dropdown-menu__link_disabled:hover,
        .material-dropdown-menu_primary .material-dropdown-menu__link_disabled:active,
        .material-dropdown-menu_primary .material-dropdown-menu__link_disabled:focus {
          color: #fff;
        }
        .material-dropdown_success {
          border-bottom: 1px solid #68c368;
        }
        .material-dropdown_success .material-dropdown__caret {
          border-top-color: #68c368;
        }
        .material-dropdown-menu_success {
          background-color: #68c368;
        }
        .material-dropdown-menu_success .material-dropdown__header {
          color: #fff;
        }
        .material-dropdown-menu_success .material-dropdown__divider {
          background-color: #fff;
        }
        .material-dropdown-menu_success .material-dropdown-menu__link {
          color: #fff;
        }
        .material-dropdown-menu_success .material-dropdown-menu__link:hover {
          color: #fff;
          background-color: #66d566;
        }
        .material-dropdown-menu_success .material-dropdown-menu__link:active,
        .material-dropdown-menu_success .material-dropdown-menu__link:focus {
          color: #fff;
          background-color: #22ac22;
        }
        .material-dropdown-menu_success .material-dropdown-menu__link_disabled {
          color: #fff;
        }
        .material-dropdown-menu_success .material-dropdown-menu__link_disabled:hover,
        .material-dropdown-menu_success .material-dropdown-menu__link_disabled:active,
        .material-dropdown-menu_success .material-dropdown-menu__link_disabled:focus {
          color: #fff;
        }
        .material-dropdown_info {
          border-bottom: 1px solid #8bdaf2;
        }
        .material-dropdown_info .material-dropdown__caret {
          border-top-color: #8bdaf2;
        }
        .material-dropdown-menu_info {
          background-color: #8bdaf2;
        }
        .material-dropdown-menu_info .material-dropdown__header {
          color: #fff;
        }
        .material-dropdown-menu_info .material-dropdown__divider {
          background-color: #fff;
        }
        .material-dropdown-menu_info .material-dropdown-menu__link {
          color: #fff;
        }
        .material-dropdown-menu_info .material-dropdown-menu__link:hover {
          color: #fff;
          background-color: #bbedfc;
        }
        .material-dropdown-menu_info .material-dropdown-menu__link:active,
        .material-dropdown-menu_info .material-dropdown-menu__link:focus {
          color: #fff;
          background-color: #3ab4d8;
        }
        .material-dropdown-menu_info .material-dropdown-menu__link_disabled {
          color: #fff;
        }
        .material-dropdown-menu_info .material-dropdown-menu__link_disabled:hover,
        .material-dropdown-menu_info .material-dropdown-menu__link_disabled:active,
        .material-dropdown-menu_info .material-dropdown-menu__link_disabled:focus {
          color: #fff;
        }
        .material-dropdown_warning {
          border-bottom: 1px solid #f2a12e;
        }
        .material-dropdown_warning .material-dropdown__caret {
          border-top-color: #f2a12e;
        }
        .material-dropdown-menu_warning {
          background-color: #f2a12e;
        }
        .material-dropdown-menu_warning .material-dropdown__header {
          color: #fff;
        }
        .material-dropdown-menu_warning .material-dropdown__divider {
          background-color: #fff;
        }
        .material-dropdown-menu_warning .material-dropdown-menu__link {
          color: #fff;
        }
        .material-dropdown-menu_warning .material-dropdown-menu__link:hover {
          color: #fff;
          background-color: #fab655;
        }
        .material-dropdown-menu_warning .material-dropdown-menu__link:active,
        .material-dropdown-menu_warning .material-dropdown-menu__link:focus {
          color: #fff;
          background-color: #d3953c;
        }
        .material-dropdown-menu_warning .material-dropdown-menu__link_disabled {
          color: #fff;
        }
        .material-dropdown-menu_warning .material-dropdown-menu__link_disabled:hover,
        .material-dropdown-menu_warning .material-dropdown-menu__link_disabled:active,
        .material-dropdown-menu_warning .material-dropdown-menu__link_disabled:focus {
          color: #fff;
        }
        .material-dropdown_danger {
          border-bottom: 1px solid #f3413c;
        }
        .material-dropdown_danger .material-dropdown__caret {
          border-top-color: #f3413c;
        }
        .material-dropdown-menu_danger {
          background-color: #f3413c;
        }
        .material-dropdown-menu_danger .material-dropdown__header {
          color: #fff;
        }
        .material-dropdown-menu_danger .material-dropdown__divider {
          background-color: #fff;
        }
        .material-dropdown-menu_danger .material-dropdown-menu__link {
          color: #fff;
        }
        .material-dropdown-menu_danger .material-dropdown-menu__link:hover {
          color: #fff;
          background-color: #f36c68;
        }
        .material-dropdown-menu_danger .material-dropdown-menu__link:active,
        .material-dropdown-menu_danger .material-dropdown-menu__link:focus {
          color: #fff;
          background-color: #c72a25;
        }
        .material-dropdown-menu_danger .material-dropdown-menu__link_disabled {
          color: #fff;
        }
        .material-dropdown-menu_danger .material-dropdown-menu__link_disabled:hover,
        .material-dropdown-menu_danger .material-dropdown-menu__link_disabled:active,
        .material-dropdown-menu_danger .material-dropdown-menu__link_disabled:focus {
          color: #fff;
        }
        .material-btn {
          font-size: 14px;
          padding: 5px 10px;
          cursor: pointer;
          border-radius: 2px;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
          -webkit-transition-property: box-shadow, background-color;
          transition-property: box-shadow, background-color;
          -webkit-transition-duration: 0.2s;
          transition-duration: 0.2s;
          -webkit-transition-timing-function: ease-in;
          transition-timing-function: ease-in;
          -webkit-transition-delay: 0s;
          transition-delay: 0s;
        }
        .material-btn:hover {
          box-shadow: 0 4px 7px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-btn:focus,
        .material-btn:active {
          outline: 0 !important;
          box-shadow: 0 4px 7px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-btn_lg,
        .material-btn-group_lg .material-btn {
          padding: 7px 10px;
          font-size: 16px;
        }
        .material-btn_sm,
        .material-btn-group_sm .material-btn {
          padding: 4px 10px;
          font-size: 13px;
        }
        .material-btn_xs,
        .material-btn-group_xs .material-btn {
          padding: 3px 10px;
          font-size: 12px;
        }
        .material-btn__caret {
          margin-left: 5px;
        }
        .material-btn {
          background-color: #eee;
          color: #000;
          border-color: #eee;
        }
        .material-btn:focus,
        .material-btn:active {
          background-color: #c9c9c9;
          border-color: #c9c9c9;
        }
        .material-btn_primary {
          background-color: #4092d9;
          border-color: #4092d9;
          color: #fff;
        }
        .material-btn_primary:hover {
          color: #fff;
          background-color: #64b2f5;
          border-color: #64b2f5;
        }
        .material-btn_primary:focus,
        .material-btn_primary:active {
          background-color: #3488d1;
          border-color: #3488d1;
          color: #fff;
        }
        .material-btn_success {
          background-color: #68c368;
          border-color: #68c368;
          color: #fff;
        }
        .material-btn_success:hover {
          color: #fff;
          background-color: #66d566;
          border-color: #66d566;
        }
        .material-btn_success:focus,
        .material-btn_success:active {
          background-color: #22ac22;
          border-color: #22ac22;
          color: #fff;
        }
        .material-btn_info {
          background-color: #8bdaf2;
          border-color: #8bdaf2;
          color: #fff;
        }
        .material-btn_info:hover {
          color: #fff;
          background-color: #bbedfc;
          border-color: #bbedfc;
        }
        .material-btn_info:focus,
        .material-btn_info:active {
          background-color: #3ab4d8;
          border-color: #3ab4d8;
          color: #fff;
        }
        .material-btn_warning {
          background-color: #f2a12e;
          border-color: #f2a12e;
          color: #fff;
        }
        .material-btn_warning:hover {
          color: #fff;
          background-color: #fab655;
          border-color: #fab655;
        }
        .material-btn_warning:focus,
        .material-btn_warning:active {
          background-color: #d3953c;
          border-color: #d3953c;
          color: #fff;
        }
        .material-btn_danger {
          background-color: #f3413c;
          border-color: #f3413c;
          color: #fff;
        }
        .material-btn_danger:hover {
          color: #fff;
          background-color: #f36c68;
          border-color: #f36c68;
        }
        .material-btn_danger:focus,
        .material-btn_danger:active {
          background-color: #c72a25;
          border-color: #c72a25;
          color: #fff;
        }
        .material-btn_toggle {
          height: 100%;
        }
        .materail-input-block {
          position: relative;
          overflow: hidden;
        }
        .materail-input-block:hover .materail-input-block__line {
          -webkit-transform: translateZ(0px) translate(0, 0);
          transform: translateZ(0px) translate(0, 0);
        }
        .materail-input {
          padding: 5px 10px;
          font-size: 14px;
          border: none;
          border-bottom: 2px solid #eee;
          border-radius: 0;
          box-shadow: none;
        }
        .materail-input:focus {
          outline: 0;
          box-shadow: none;
        }
        .materail-input[disabled] {
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
        }
        .materail-input[disabled] + .materail-input-block__line {
          display: none;
        }
        .materail-input-block__line {
          content: "";
          display: block;
          width: 100%;
          height: 2px;
          position: absolute;
          bottom: 0;
          left: 0;
          -webkit-transform: translateZ(0px) translate(-110%, 0);
          transform: translateZ(0px) translate(-110%, 0);
        }
        .materail-input_slide-line {
          -webkit-transform: translateZ(0px) translate(0, 0);
          transform: translateZ(0px) translate(0, 0);
        }
        .materail-input_slide-line:hover .materail-input-block__line {
          -webkit-transition: transform 0.4s cubic-bezier(0.5, -0.01, 0.59, 0.04) 0s;
          transition: transform 0.4s cubic-bezier(0.5, -0.01, 0.59, 0.04) 0s;
        }
        .material-textarea {
          min-width: 100%;
          max-width: 100%;
          min-height: 50px;
          max-height: 100px;
        }
        .materail-input-block .materail-input-block__line {
          background-color: #f7f7f7;
        }
        .materail-input {
          color: #000;
        }
        .materail-input::-webkit-input-placeholder {
          color: #c9c9c9;
        }
        .materail-input::-moz-placeholder {
          color: #c9c9c9;
        }
        .materail-input:-ms-input-placeholder {
          color: #c9c9c9;
        }
        .materail-input:focus {
          border-bottom-color: #c9c9c9;
        }
        .materail-input-block_primary .materail-input-block__line {
          background-color: #64b2f5;
        }
        .materail-input-block_primary .materail-input:focus {
          border-bottom-color: #3488d1;
        }
        .materail-input-block_success .materail-input-block__line {
          background-color: #66d566;
        }
        .materail-input-block_success .materail-input:focus {
          border-bottom-color: #22ac22;
        }
        .materail-input-block_info .materail-input-block__line {
          background-color: #bbedfc;
        }
        .materail-input-block_info .materail-input:focus {
          border-bottom-color: #3ab4d8;
        }
        .materail-input-block_warning .materail-input-block__line {
          background-color: #fab655;
        }
        .materail-input-block_warning .materail-input:focus {
          border-bottom-color: #d3953c;
        }
        .materail-input-block_danger .materail-input-block__line {
          background-color: #f36c68;
        }
        .materail-input-block_danger .materail-input:focus {
          border-bottom-color: #c72a25;
        }
        .material-radio-group {
          cursor: pointer;
        }
        .material-radiobox {
          display: none;
        }
        .material-radio-group__check-radio {
          width: 20px;
          height: 20px;
          border-radius: 50%;
          border: 2px solid;
          position: relative;
          -webkit-transition: border-color 0.2s linear 0s;
          transition: border-color 0.2s linear 0s;
        }
        .material-radio-group__check-radio:after {
          content: "";
          display: block;
          width: 10px;
          height: 10px;
          border-radius: 50%;
          position: absolute;
          left: 50%;
          top: 50%;
          -webkit-transform: translate(-50%, -50%) scale(0);
          transform: translate(-50%, -50%) scale(0);
          -webkit-transition: transform 0.2s linear 0s;
          transition: transform 0.2s linear 0s;
        }
        .material-radio-group__element {
          display: inline-block;
          vertical-align: middle;
        }
        .material-radio-group__caption {
          font-size: 14px;
          margin-left: 5px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
        }
        .material-radiobox:disabled ~ .material-radio-group__caption,
        .material-radiobox:disabled ~ .material-radio-group__check-radio {
          cursor: no-drop;
        }
        .material-radiobox:checked ~ .material-radio-group__check-radio:after {
          -webkit-transform: translate(-50%, -50%) scale(2);
          transform: translate(-50%, -50%) scale(2);
        }
        .material-radio-group .material-radio-group__check-radio {
          border-color: #eee;
        }
        .material-radio-group .material-radio-group__check-radio:after {
          background-color: #eee;
        }
        .material-radiobox:disabled ~ .material-radio-group__caption {
          color: #eee;
        }
        .material-radio-group_primary .material-radio-group__check-radio {
          border-color: #4092d9;
        }
        .material-radio-group_primary .material-radio-group__check-radio:after {
          background-color: #4092d9;
        }
        .material-radio-group_success .material-radio-group__check-radio {
          border-color: #68c368;
        }
        .material-radio-group_success .material-radio-group__check-radio:after {
          background-color: #68c368;
        }
        .material-radio-group_info .material-radio-group__check-radio {
          border-color: #8bdaf2;
        }
        .material-radio-group_info .material-radio-group__check-radio:after {
          background-color: #8bdaf2;
        }
        .material-radio-group_warning .material-radio-group__check-radio {
          border-color: #f2a12e;
        }
        .material-radio-group_warning .material-radio-group__check-radio:after {
          background-color: #f2a12e;
        }
        .material-radio-group_danger .material-radio-group__check-radio {
          border-color: #f3413c;
        }
        .material-radio-group_danger .material-radio-group__check-radio:after {
          background-color: #f3413c;
        }
        .material-checkbox-group__label {
          position: relative;
          display: block;
          cursor: pointer;
          height: 25px;
          line-height: 25px;
          padding-left: 30px;
        }
        .material-checkbox-group__label:after {
          content: "";
          display: block;
          width: 5px;
          height: 15px;
          opacity: .9;
          border-right: 2px solid #eee;
          border-top: 2px solid #eee;
          position: absolute;
          left: 5px;
          top: 15px;
          -webkit-transform: scaleX(-1) rotate(135deg);
          transform: scaleX(-1) rotate(135deg);
          -webkit-transform-origin: left top;
          transform-origin: left top;
        }
        .material-checkbox-group__label:before {
          content: "";
          display: block;
          border: 2px solid;
          width: 25px;
          height: 25px;
          position: absolute;
          left: 0;
        }
        .material-checkbox-group__label {
          font-size: 14px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
        }
        .material-checkbox:disabled ~ .material-checkbox-group__label {
          cursor: no-drop;
        }
        .material-checkbox {
          display: none;
        }
        .material-checkbox-group .material-checkbox:checked + .material-checkbox-group__label:after {
          -webkit-animation: check 0.8s;
          animation: check 0.8s;
          opacity: 1;
        }
        .material-checkbox-group .material-checkbox:checked + .material-checkbox-group__label:after {
          border-color: #000;
        }
        .material-checkbox-group .material-checkbox:checked + .material-checkbox-group__label:before {
          background-color: #eee;
        }
        .material-checkbox-group .material-checkbox-group__label:before {
          border-color: #eee;
        }
        .material-checkbox:disabled ~ .material-checkbox-group__label {
          color: #eee;
        }
        .material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group__label:after {
          border-color: #fff;
        }
        .material-checkbox-group_primary .material-checkbox:checked + .material-checkbox-group__label:before {
          background-color: #4092d9;
        }
        .material-checkbox-group_primary .material-checkbox-group__label:before {
          border-color: #4092d9;
        }
        .material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group__label:after {
          border-color: #fff;
        }
        .material-checkbox-group_success .material-checkbox:checked + .material-checkbox-group__label:before {
          background-color: #68c368;
        }
        .material-checkbox-group_success .material-checkbox-group__label:before {
          border-color: #68c368;
        }
        .material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group__label:after {
          border-color: #fff;
        }
        .material-checkbox-group_info .material-checkbox:checked + .material-checkbox-group__label:before {
          background-color: #8bdaf2;
        }
        .material-checkbox-group_info .material-checkbox-group__label:before {
          border-color: #8bdaf2;
        }
        .material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group__label:after {
          border-color: #fff;
        }
        .material-checkbox-group_warning .material-checkbox:checked + .material-checkbox-group__label:before {
          background-color: #f2a12e;
        }
        .material-checkbox-group_warning .material-checkbox-group__label:before {
          border-color: #f2a12e;
        }
        .material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group__label:after {
          border-color: #fff;
        }
        .material-checkbox-group_danger .material-checkbox:checked + .material-checkbox-group__label:before {
          background-color: #f3413c;
        }
        .material-checkbox-group_danger .material-checkbox-group__label:before {
          border-color: #f3413c;
        }
        @-webkit-keyframes check {
          0% {
            height: 0;
            width: 0;
          }
          25% {
            height: 0;
            width: 5px;
          }
          50% {
            height: 15px;
            width: 5px;
          }
        }
        @keyframes check {
          0% {
            height: 0;
            width: 0;
          }
          25% {
            height: 0;
            width: 5px;
          }
          50% {
            height: 15px;
            width: 5px;
          }
        }
        .materail-switch {
          width: 60px;
          height: 30px;
          position: relative;
        }
        .materail-switch__element {
          display: none;
        }
        .materail-switch__label {
          cursor: pointer;
          display: block;
          height: 100%;
          margin-bottom: 0;
        }
        .materail-switch__label:before,
        .materail-switch__label:after {
          display: block;
          content: "";
          position: absolute;
          top: 50%;
          left: 0;
          -webkit-transform: translateZ(0px) translate(0, -50%);
          transform: translateZ(0px) translate(0, -50%);
        }
        .materail-switch__label:before {
          width: 100%;
          height: 10px;
          border-radius: 60px;
          -webkit-transition: background-color 0.2s cubic-bezier(0.5, -0.01, 0.59, 0.04) 0.2s;
          transition: background-color 0.2s cubic-bezier(0.5, -0.01, 0.59, 0.04) 0.2s;
        }
        .materail-switch__label:after {
          height: 30px;
          width: 30px;
          border-radius: 50%;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
          -webkit-transition-property: transform, background-color;
          transition-property: transform, background-color;
          -webkit-transition-duration: 0.4s;
          transition-duration: 0.4s;
          -webkit-transition-timing-function: cubic-bezier(0.5, -0.01, 0.59, 0.04);
          transition-timing-function: cubic-bezier(0.5, -0.01, 0.59, 0.04);
          -webkit-transition-delay: 0s;
          transition-delay: 0s;
        }
        .materail-switch__element:disabled + .materail-switch__label {
          cursor: no-drop;
          opacity: 0.5;
        }
        .materail-switch__element:checked + .materail-switch__label:after {
          -webkit-transform: translateZ(0px) translate(30px, -50%);
          transform: translateZ(0px) translate(30px, -50%);
        }
        .materail-switch__element:checked + .materail-switch__label:before {
          background-color: #eee;
        }
        .materail-switch__element:checked + .materail-switch__label:after {
          background-color: #eee;
        }
        .materail-switch__label:before {
          background-color: #eee;
        }
        .materail-switch__label:after {
          background-color: #fff;
        }
        .materail-switch_primary .materail-switch__element:checked + .materail-switch__label:before {
          background-color: #4092d9;
        }
        .materail-switch_primary .materail-switch__element:checked + .materail-switch__label:after {
          background-color: #4092d9;
        }
        .materail-switch_success .materail-switch__element:checked + .materail-switch__label:before {
          background-color: #68c368;
        }
        .materail-switch_success .materail-switch__element:checked + .materail-switch__label:after {
          background-color: #68c368;
        }
        .materail-switch_info .materail-switch__element:checked + .materail-switch__label:before {
          background-color: #8bdaf2;
        }
        .materail-switch_info .materail-switch__element:checked + .materail-switch__label:after {
          background-color: #8bdaf2;
        }
        .materail-switch_warning .materail-switch__element:checked + .materail-switch__label:before {
          background-color: #f2a12e;
        }
        .materail-switch_warning .materail-switch__element:checked + .materail-switch__label:after {
          background-color: #f2a12e;
        }
        .materail-switch_danger .materail-switch__element:checked + .materail-switch__label:before {
          background-color: #f3413c;
        }
        .materail-switch_danger .materail-switch__element:checked + .materail-switch__label:after {
          background-color: #f3413c;
        }
        .material-accordion {
          width: 100%;
        }
        .material-accordion .material-accordion__panel,
        .material-accordion .material-accordion__heading {
          border: none;
          border-radius: 0;
        }
        .material-accordion .material-accordion__panel {
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-accordion .material-accordion__heading {
          padding: 0;
        }
        .material-accordion .material-accordion__title {
          font-weight: 700;
          text-decoration: none;
          cursor: default;
          display: block;
          padding: 15px 30px;
          -webkit-transition: background-color 0.5s ease-out 0s;
          transition: background-color 0.5s ease-out 0s;
        }
        .material-accordion .material-accordion__title:hover {
          text-decoration: none;
        }
        .material-accordion .material-accordion__title.collapsed {
          cursor: pointer;
        }
        .material-accordion .material-accordion__title {
          background-color: #c9c9c9;
          color: #000;
        }
        .material-accordion .material-accordion__title.collapsed:hover {
          background-color: #f7f7f7;
        }
        .material-accordion .material-accordion__title.collapsed {
          background-color: #eee;
        }
        .material-accordion_primary .material-accordion__title {
          background-color: #3488d1;
          color: #fff;
        }
        .material-accordion_primary .material-accordion__title.collapsed:hover {
          background-color: #64b2f5;
        }
        .material-accordion_primary .material-accordion__title.collapsed {
          background-color: #4092d9;
        }
        .material-accordion_success .material-accordion__title {
          background-color: #22ac22;
          color: #fff;
        }
        .material-accordion_success .material-accordion__title.collapsed:hover {
          background-color: #66d566;
        }
        .material-accordion_success .material-accordion__title.collapsed {
          background-color: #68c368;
        }
        .material-accordion_info .material-accordion__title {
          background-color: #3ab4d8;
          color: #fff;
        }
        .material-accordion_info .material-accordion__title.collapsed:hover {
          background-color: #bbedfc;
        }
        .material-accordion_info .material-accordion__title.collapsed {
          background-color: #8bdaf2;
        }
        .material-accordion_warning .material-accordion__title {
          background-color: #d3953c;
          color: #fff;
        }
        .material-accordion_warning .material-accordion__title.collapsed:hover {
          background-color: #fab655;
        }
        .material-accordion_warning .material-accordion__title.collapsed {
          background-color: #f2a12e;
        }
        .material-accordion_danger .material-accordion__title {
          background-color: #c72a25;
          color: #fff;
        }
        .material-accordion_danger .material-accordion__title.collapsed:hover {
          background-color: #f36c68;
        }
        .material-accordion_danger .material-accordion__title.collapsed {
          background-color: #f3413c;
        }
        .material-modal__header {
          padding: 20px;
        }
        .material-modal__content {
          border-radius: 4px;
          border: none;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-modal__body {
          padding: 20px;
        }
        .material-modal__footer {
          border-top: none;
          padding: 20px;
        }
        .material-modal__close {
          opacity: 1;
          font-weight: 400;
        }
        .material-modal__header {
          background-color: #eee;
        }
        .material-modal__title,
        .material-modal__close {
          color: #000;
        }
        .material-modal_primary .material-modal__header {
          background-color: #4092d9;
        }
        .material-modal_primary .material-modal__title,
        .material-modal_primary .material-modal__close {
          color: #fff;
        }
        .material-modal_success .material-modal__header {
          background-color: #68c368;
        }
        .material-modal_success .material-modal__title,
        .material-modal_success .material-modal__close {
          color: #fff;
        }
        .material-modal_info .material-modal__header {
          background-color: #8bdaf2;
        }
        .material-modal_info .material-modal__title,
        .material-modal_info .material-modal__close {
          color: #fff;
        }
        .material-modal_warning .material-modal__header {
          background-color: #f2a12e;
        }
        .material-modal_warning .material-modal__title,
        .material-modal_warning .material-modal__close {
          color: #fff;
        }
        .material-modal_danger .material-modal__header {
          background-color: #f3413c;
        }
        .material-modal_danger .material-modal__title,
        .material-modal_danger .material-modal__close {
          color: #fff;
        }
        .material-pills .material-pills__link {
          font-size: 14px;
          border-radius: 0;
          padding: 5px 15px;
          -webkit-transition-property: background-color, color;
          transition-property: background-color, color;
          -webkit-transition-duration: 0.3s;
          transition-duration: 0.3s;
          -webkit-transition-timing-function: ease-out;
          transition-timing-function: ease-out;
          -webkit-transition-delay: 0s;
          transition-delay: 0s;
        }
        .material-pills .material-pills__link_disabled {
          opacity: 0.5;
          cursor: no-drop;
        }
        .material-pills .material-pills__link_disabled:hover,
        .material-pills .material-pills__link_disabled:focus,
        .material-pills .material-pills__link_disabled:active {
          background: none;
        }
        .material-pills .material-pills__link {
          color: #eee;
        }
        .material-pills .material-pills__link:hover {
          background-color: #f7f7f7;
          color: #000;
        }
        .material-pills .active .material-pills__link,
        .material-pills .active .material-pills__link:hover,
        .material-pills .material-pills__link:focus {
          background-color: #c9c9c9 !important;
          color: #000;
        }
        .material-pills .material-pills__link_disabled:hover,
        .material-pills .material-pills__link_disabled:focus,
        .material-pills .material-pills__link_disabled:active {
          background: none;
          color: #eee;
        }
        .material-pills_primary .material-pills__link {
          color: #4092d9;
        }
        .material-pills_primary .material-pills__link:hover {
          background-color: #64b2f5;
          color: #fff;
        }
        .material-pills_primary .active .material-pills__link,
        .material-pills_primary .active .material-pills__link:hover,
        .material-pills_primary .material-pills__link:focus {
          background-color: #3488d1 !important;
          color: #fff;
        }
        .material-pills_primary .material-pills__link_disabled:hover,
        .material-pills_primary .material-pills__link_disabled:focus,
        .material-pills_primary .material-pills__link_disabled:active {
          background: none;
          color: #4092d9;
        }
        .material-pills_success .material-pills__link {
          color: #68c368;
        }
        .material-pills_success .material-pills__link:hover {
          background-color: #66d566;
          color: #fff;
        }
        .material-pills_success .active .material-pills__link,
        .material-pills_success .active .material-pills__link:hover,
        .material-pills_success .material-pills__link:focus {
          background-color: #22ac22 !important;
          color: #fff;
        }
        .material-pills_success .material-pills__link_disabled:hover,
        .material-pills_success .material-pills__link_disabled:focus,
        .material-pills_success .material-pills__link_disabled:active {
          background: none;
          color: #68c368;
        }
        .material-pills_info .material-pills__link {
          color: #8bdaf2;
        }
        .material-pills_info .material-pills__link:hover {
          background-color: #bbedfc;
          color: #fff;
        }
        .material-pills_info .active .material-pills__link,
        .material-pills_info .active .material-pills__link:hover,
        .material-pills_info .material-pills__link:focus {
          background-color: #3ab4d8 !important;
          color: #fff;
        }
        .material-pills_info .material-pills__link_disabled:hover,
        .material-pills_info .material-pills__link_disabled:focus,
        .material-pills_info .material-pills__link_disabled:active {
          background: none;
          color: #8bdaf2;
        }
        .material-pills_warning .material-pills__link {
          color: #f2a12e;
        }
        .material-pills_warning .material-pills__link:hover {
          background-color: #fab655;
          color: #fff;
        }
        .material-pills_warning .active .material-pills__link,
        .material-pills_warning .active .material-pills__link:hover,
        .material-pills_warning .material-pills__link:focus {
          background-color: #d3953c !important;
          color: #fff;
        }
        .material-pills_warning .material-pills__link_disabled:hover,
        .material-pills_warning .material-pills__link_disabled:focus,
        .material-pills_warning .material-pills__link_disabled:active {
          background: none;
          color: #f2a12e;
        }
        .material-pills_danger .material-pills__link {
          color: #f3413c;
        }
        .material-pills_danger .material-pills__link:hover {
          background-color: #f36c68;
          color: #fff;
        }
        .material-pills_danger .active .material-pills__link,
        .material-pills_danger .active .material-pills__link:hover,
        .material-pills_danger .material-pills__link:focus {
          background-color: #c72a25 !important;
          color: #fff;
        }
        .material-pills_danger .material-pills__link_disabled:hover,
        .material-pills_danger .material-pills__link_disabled:focus,
        .material-pills_danger .material-pills__link_disabled:active {
          background: none;
          color: #f3413c;
        }
        .material-tabs-group {
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-tabs li > .material-tabs__tab-link {
          text-align: center;
          padding: 15px 45px;
          border: none;
          border-radius: 0;
          cursor: pointer;
          overflow: hidden;
          font-size: 14px;
          font-weight: 700;
          -webkit-transition: background-color 0.5s ease-out 0.1s;
          transition: background-color 0.5s ease-out 0.1s;
        }
        .material-tabs li > .material-tabs__tab-link:before,
        .material-tabs li > .material-tabs__tab-link:after {
          content: "";
          display: block;
          width: 25%;
          height: 2px;
          position: absolute;
          bottom: 0;
          left: 50%;
          -webkit-transform: translateZ(0px) translate(-50%, 0);
          transform: translateZ(0px) translate(-50%, 0);
          -webkit-transition: width 0.5s ease-out 0.1s;
          transition: width 0.5s ease-out 0.1s;
        }
        .material-tabs li > .material-tabs__tab-link:hover,
        .material-tabs li > .material-tabs__tab-link:active,
        .material-tabs li > .material-tabs__tab-link:focus {
          outline: none;
        }
        .material-tabs li > .material-tabs__tab-link_disabled {
          opacity: 0.5;
          cursor: no-drop;
        }
        .material-tabs li > .material-tabs__tab-link_disabled:before,
        .material-tabs li > .material-tabs__tab-link_disabled:after,
        .material-tabs li > .material-tabs__tab-link_disabled:hover:before,
        .material-tabs li > .material-tabs__tab-link_disabled:hover:after {
          width: 25%;
        }
        .material-tabs li > .material-tabs__tab-link_disabled:hover {
          background: none !important;
        }
        .material-tabs > li.active > .material-tabs__tab-link {
          border: none;
        }
        .material-tabs > li.active > .material-tabs__tab-link:before,
        .material-tabs > li.active > .material-tabs__tab-link:after {
          width: 100%;
        }
        .material-tabs > li.active > .material-tabs__tab-link:hover,
        .material-tabs > li.active > .material-tabs__tab-link:focus {
          border: none;
        }
        .materail-tabs-content {
          padding: 15px 20px;
        }
        .material-tabs {
          background-color: #eee;
        }
        .material-tabs .material-tabs__tab-link {
          color: #000;
        }
        .material-tabs .material-tabs__tab-link:before,
        .material-tabs .material-tabs__tab-link:after {
          background-color: #fff;
        }
        .material-tabs .material-tabs__tab-link:hover {
          color: #000;
          background-color: #f7f7f7;
        }
        .material-tabs .material-tabs__tab-link:hover:before,
        .material-tabs .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs > li.active > .material-tabs__tab-link,
        .material-tabs > li.active > .material-tabs__tab-link:focus,
        .material-tabs > li.active > .material-tabs__tab-link:hover {
          background-color: #c9c9c9;
          color: #000;
        }
        .material-tabs > li.active > .material-tabs__tab-link:before,
        .material-tabs > li.active > .material-tabs__tab-link:focus:before,
        .material-tabs > li.active > .material-tabs__tab-link:hover:before,
        .material-tabs > li.active > .material-tabs__tab-link:after,
        .material-tabs > li.active > .material-tabs__tab-link:focus:after,
        .material-tabs > li.active > .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_primary {
          background-color: #4092d9;
        }
        .material-tabs_primary .material-tabs__tab-link {
          color: #fff;
        }
        .material-tabs_primary .material-tabs__tab-link:before,
        .material-tabs_primary .material-tabs__tab-link:after {
          background-color: #fff;
        }
        .material-tabs_primary .material-tabs__tab-link:hover {
          color: #fff;
          background-color: #64b2f5;
        }
        .material-tabs_primary .material-tabs__tab-link:hover:before,
        .material-tabs_primary .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_primary > li.active > .material-tabs__tab-link,
        .material-tabs_primary > li.active > .material-tabs__tab-link:focus,
        .material-tabs_primary > li.active > .material-tabs__tab-link:hover {
          background-color: #3488d1;
          color: #fff;
        }
        .material-tabs_primary > li.active > .material-tabs__tab-link:before,
        .material-tabs_primary > li.active > .material-tabs__tab-link:focus:before,
        .material-tabs_primary > li.active > .material-tabs__tab-link:hover:before,
        .material-tabs_primary > li.active > .material-tabs__tab-link:after,
        .material-tabs_primary > li.active > .material-tabs__tab-link:focus:after,
        .material-tabs_primary > li.active > .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_success {
          background-color: #68c368;
        }
        .material-tabs_success .material-tabs__tab-link {
          color: #fff;
        }
        .material-tabs_success .material-tabs__tab-link:before,
        .material-tabs_success .material-tabs__tab-link:after {
          background-color: #fff;
        }
        .material-tabs_success .material-tabs__tab-link:hover {
          color: #fff;
          background-color: #66d566;
        }
        .material-tabs_success .material-tabs__tab-link:hover:before,
        .material-tabs_success .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_success > li.active > .material-tabs__tab-link,
        .material-tabs_success > li.active > .material-tabs__tab-link:focus,
        .material-tabs_success > li.active > .material-tabs__tab-link:hover {
          background-color: #22ac22;
          color: #fff;
        }
        .material-tabs_success > li.active > .material-tabs__tab-link:before,
        .material-tabs_success > li.active > .material-tabs__tab-link:focus:before,
        .material-tabs_success > li.active > .material-tabs__tab-link:hover:before,
        .material-tabs_success > li.active > .material-tabs__tab-link:after,
        .material-tabs_success > li.active > .material-tabs__tab-link:focus:after,
        .material-tabs_success > li.active > .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_info {
          background-color: #8bdaf2;
        }
        .material-tabs_info .material-tabs__tab-link {
          color: #fff;
        }
        .material-tabs_info .material-tabs__tab-link:before,
        .material-tabs_info .material-tabs__tab-link:after {
          background-color: #fff;
        }
        .material-tabs_info .material-tabs__tab-link:hover {
          color: #fff;
          background-color: #bbedfc;
        }
        .material-tabs_info .material-tabs__tab-link:hover:before,
        .material-tabs_info .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_info > li.active > .material-tabs__tab-link,
        .material-tabs_info > li.active > .material-tabs__tab-link:focus,
        .material-tabs_info > li.active > .material-tabs__tab-link:hover {
          background-color: #3ab4d8;
          color: #fff;
        }
        .material-tabs_info > li.active > .material-tabs__tab-link:before,
        .material-tabs_info > li.active > .material-tabs__tab-link:focus:before,
        .material-tabs_info > li.active > .material-tabs__tab-link:hover:before,
        .material-tabs_info > li.active > .material-tabs__tab-link:after,
        .material-tabs_info > li.active > .material-tabs__tab-link:focus:after,
        .material-tabs_info > li.active > .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_warning {
          background-color: #f2a12e;
        }
        .material-tabs_warning .material-tabs__tab-link {
          color: #fff;
        }
        .material-tabs_warning .material-tabs__tab-link:before,
        .material-tabs_warning .material-tabs__tab-link:after {
          background-color: #fff;
        }
        .material-tabs_warning .material-tabs__tab-link:hover {
          color: #fff;
          background-color: #fab655;
        }
        .material-tabs_warning .material-tabs__tab-link:hover:before,
        .material-tabs_warning .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_warning > li.active > .material-tabs__tab-link,
        .material-tabs_warning > li.active > .material-tabs__tab-link:focus,
        .material-tabs_warning > li.active > .material-tabs__tab-link:hover {
          background-color: #d3953c;
          color: #fff;
        }
        .material-tabs_warning > li.active > .material-tabs__tab-link:before,
        .material-tabs_warning > li.active > .material-tabs__tab-link:focus:before,
        .material-tabs_warning > li.active > .material-tabs__tab-link:hover:before,
        .material-tabs_warning > li.active > .material-tabs__tab-link:after,
        .material-tabs_warning > li.active > .material-tabs__tab-link:focus:after,
        .material-tabs_warning > li.active > .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_danger {
          background-color: #f3413c;
        }
        .material-tabs_danger .material-tabs__tab-link {
          color: #fff;
        }
        .material-tabs_danger .material-tabs__tab-link:before,
        .material-tabs_danger .material-tabs__tab-link:after {
          background-color: #fff;
        }
        .material-tabs_danger .material-tabs__tab-link:hover {
          color: #fff;
          background-color: #f36c68;
        }
        .material-tabs_danger .material-tabs__tab-link:hover:before,
        .material-tabs_danger .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-tabs_danger > li.active > .material-tabs__tab-link,
        .material-tabs_danger > li.active > .material-tabs__tab-link:focus,
        .material-tabs_danger > li.active > .material-tabs__tab-link:hover {
          background-color: #c72a25;
          color: #fff;
        }
        .material-tabs_danger > li.active > .material-tabs__tab-link:before,
        .material-tabs_danger > li.active > .material-tabs__tab-link:focus:before,
        .material-tabs_danger > li.active > .material-tabs__tab-link:hover:before,
        .material-tabs_danger > li.active > .material-tabs__tab-link:after,
        .material-tabs_danger > li.active > .material-tabs__tab-link:focus:after,
        .material-tabs_danger > li.active > .material-tabs__tab-link:hover:after {
          background-color: #fff;
        }
        .material-navbar {
          border-radius: 0;
          border: none;
          width: 100%;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-navbar__nav > li > .material-navbar__link {
          -webkit-transition: background-color 0.4s ease-out 0s;
          transition: background-color 0.4s ease-out 0s;
        }
        .material-navbar {
          background-color: #eee;
        }
        .material-navbar__brand {
          color: #000;
        }
        .material-navbar__nav > li > .material-navbar__link {
          color: #000;
        }
        .material-navbar__nav > li > .material-navbar__link:hover {
          background-color: #f7f7f7;
        }
        .material-navbar__nav > li > .material-navbar__link:active {
          background-color: #c9c9c9;
        }
        .materail-navbar__icon-bar {
          background-color: #000;
        }
        .materil-navbar__collapse {
          border-top-color: #c9c9c9;
        }
        .material-navbar_primary {
          background-color: #4092d9;
        }
        .material-navbar_primary .material-navbar__brand {
          color: #fff;
        }
        .material-navbar_primary .material-navbar__nav > li > .material-navbar__link {
          color: #fff;
        }
        .material-navbar_primary .material-navbar__nav > li > .material-navbar__link:hover {
          background-color: #64b2f5;
        }
        .material-navbar_primary .material-navbar__nav > li > .material-navbar__link:active {
          background-color: #3488d1;
        }
        .material-navbar_primary .materail-navbar__icon-bar {
          background-color: #fff;
        }
        .material-navbar_primary .materil-navbar__collapse {
          border-top-color: #3488d1;
        }
        .material-navbar_success {
          background-color: #68c368;
        }
        .material-navbar_success .material-navbar__brand {
          color: #fff;
        }
        .material-navbar_success .material-navbar__nav > li > .material-navbar__link {
          color: #fff;
        }
        .material-navbar_success .material-navbar__nav > li > .material-navbar__link:hover {
          background-color: #66d566;
        }
        .material-navbar_success .material-navbar__nav > li > .material-navbar__link:active {
          background-color: #22ac22;
        }
        .material-navbar_success .materail-navbar__icon-bar {
          background-color: #fff;
        }
        .material-navbar_success .materil-navbar__collapse {
          border-top-color: #22ac22;
        }
        .material-navbar_info {
          background-color: #8bdaf2;
        }
        .material-navbar_info .material-navbar__brand {
          color: #fff;
        }
        .material-navbar_info .material-navbar__nav > li > .material-navbar__link {
          color: #fff;
        }
        .material-navbar_info .material-navbar__nav > li > .material-navbar__link:hover {
          background-color: #bbedfc;
        }
        .material-navbar_info .material-navbar__nav > li > .material-navbar__link:active {
          background-color: #3ab4d8;
        }
        .material-navbar_info .materail-navbar__icon-bar {
          background-color: #fff;
        }
        .material-navbar_info .materil-navbar__collapse {
          border-top-color: #3ab4d8;
        }
        .material-navbar_warning {
          background-color: #f2a12e;
        }
        .material-navbar_warning .material-navbar__brand {
          color: #fff;
        }
        .material-navbar_warning .material-navbar__nav > li > .material-navbar__link {
          color: #fff;
        }
        .material-navbar_warning .material-navbar__nav > li > .material-navbar__link:hover {
          background-color: #fab655;
        }
        .material-navbar_warning .material-navbar__nav > li > .material-navbar__link:active {
          background-color: #d3953c;
        }
        .material-navbar_warning .materail-navbar__icon-bar {
          background-color: #fff;
        }
        .material-navbar_warning .materil-navbar__collapse {
          border-top-color: #d3953c;
        }
        .material-navbar_danger {
          background-color: #f3413c;
        }
        .material-navbar_danger .material-navbar__brand {
          color: #fff;
        }
        .material-navbar_danger .material-navbar__nav > li > .material-navbar__link {
          color: #fff;
        }
        .material-navbar_danger .material-navbar__nav > li > .material-navbar__link:hover {
          background-color: #f36c68;
        }
        .material-navbar_danger .material-navbar__nav > li > .material-navbar__link:active {
          background-color: #c72a25;
        }
        .material-navbar_danger .materail-navbar__icon-bar {
          background-color: #fff;
        }
        .material-navbar_danger .materil-navbar__collapse {
          border-top-color: #c72a25;
        }
        .material-breadcrumb {
          border-radius: 0;
          background-color: #fff;
          font-weight: 700;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
          width: 100%;
          padding: 0;
          font-size: 0;
        }
        .material-breadcrumb > li {
          position: relative;
        }
        .material-breadcrumb > li + li:before {
          content: "";
          padding: 0;
          display: inline-block;
          width: 5px;
          height: 5px;
          border-top: 1px solid;
          border-right: 1px solid;
          position: absolute;
          top: 50%;
          left: -5px;
          -webkit-transform: rotate(45deg) translateY(-50%);
          transform: rotate(45deg) translateY(-50%);
        }
        .material-breadcrumb__item {
          padding: 12px;
        }
        .material-breadcrumb__link {
          padding: 8px;
          font-size: 15px;
          display: inline-block;
          -webkit-transition: background-color 0.5s ease-out 0s;
          transition: background-color 0.5s ease-out 0s;
        }
        .material-breadcrumb__link:hover,
        .material-breadcrumb__link:active {
          text-decoration: none;
        }
        .material-breadcrumb__active-element {
          padding: 8px;
          font-size: 15px;
        }
        .material-breadcrumb {
          background-color: #eee;
        }
        .material-breadcrumb > li + li:before {
          border-color: #000;
        }
        .material-breadcrumb .material-breadcrumb__link {
          color: #000;
        }
        .material-breadcrumb .material-breadcrumb__link:hover,
        .material-breadcrumb .material-breadcrumb__link:active {
          background-color: #c9c9c9;
        }
        .material-breadcrumb_primary {
          background-color: #4092d9;
          color: #fff;
        }
        .material-breadcrumb_primary > li + li:before {
          border-color: #fff;
        }
        .material-breadcrumb_primary .material-breadcrumb__link {
          color: #fff;
        }
        .material-breadcrumb_primary .material-breadcrumb__link:hover,
        .material-breadcrumb_primary .material-breadcrumb__link:active {
          background-color: #3488d1;
        }
        .material-breadcrumb_success {
          color: #fff;
          background-color: #68c368;
        }
        .material-breadcrumb_success > li + li:before {
          border-color: #fff;
        }
        .material-breadcrumb_success .material-breadcrumb__link {
          color: #fff;
        }
        .material-breadcrumb_success .material-breadcrumb__link:hover,
        .material-breadcrumb_success .material-breadcrumb__link:active {
          background-color: #22ac22;
        }
        .material-breadcrumb_info {
          color: #fff;
          background-color: #8bdaf2;
        }
        .material-breadcrumb_info > li + li:before {
          border-color: #fff;
        }
        .material-breadcrumb_info .material-breadcrumb__link {
          color: #fff;
        }
        .material-breadcrumb_info .material-breadcrumb__link:hover,
        .material-breadcrumb_info .material-breadcrumb__link:active {
          background-color: #3ab4d8;
        }
        .material-breadcrumb_warning {
          color: #fff;
          background-color: #f2a12e;
        }
        .material-breadcrumb_warning > li + li:before {
          border-color: #fff;
        }
        .material-breadcrumb_warning .material-breadcrumb__link {
          color: #fff;
        }
        .material-breadcrumb_warning .material-breadcrumb__link:hover,
        .material-breadcrumb_warning .material-breadcrumb__link:active {
          background-color: #d3953c;
        }
        .material-breadcrumb_danger {
          color: #fff;
          background-color: #f3413c;
        }
        .material-breadcrumb_danger > li + li:before {
          border-color: #fff;
        }
        .material-breadcrumb_danger .material-breadcrumb__link {
          color: #fff;
        }
        .material-breadcrumb_danger .material-breadcrumb__link:hover,
        .material-breadcrumb_danger .material-breadcrumb__link:active {
          background-color: #c72a25;
        }
        .material-pagination .material-pagination__link,
        .material-pagination .material-pagination__link_disabled {
          border-radius: 50%;
          margin: 0 5px;
          font-weight: 700;
          padding: 0;
          text-align: center;
          line-height: 40px;
          width: 40px;
          height: 40px;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
          -webkit-transition-property: background-color, color;
          transition-property: background-color, color;
          -webkit-transition-duration: 0.4s;
          transition-duration: 0.4s;
          -webkit-transition-timing-function: ease-out;
          transition-timing-function: ease-out;
          -webkit-transition-delay: 0s;
          transition-delay: 0s;
        }
        .material-pagination > li:first-child .material-pagination__link,
        .material-pagination > li:last-child .material-pagination__link {
          border-radius: 50%;
        }
        .material-pagination > li:first-child .material-pagination__link {
          margin-left: 0;
        }
        .material-pagination > li:last-child .material-pagination__link {
          margin-right: 0;
        }
        .material-pagination .material-pagination__link_disabled,
        .material-pagination .material-pagination__link_disabled:hover,
        .material-pagination .material-pagination__link_disabled:active,
        .material-pagination .material-pagination__link_disabled:focus {
          opacity: 0.5;
        }
        .material-pagination .material-pagination__link:hover {
          background-color: #f7f7f7;
          border-color: #f7f7f7;
          color: #000;
        }
        .material-pagination .material-pagination__link,
        .material-pagination .material-pagination__link_disabled,
        .material-pagination .material-pagination__link_disabled:hover {
          background-color: #eee;
          border-color: #eee;
          color: #000;
        }
        .material-pagination .material-pagination__link_active,
        .material-pagination .material-pagination__link_active:active,
        .material-pagination .material-pagination__link_active:focus,
        .material-pagination .material-pagination__link_active:hover,
        .material-pagination .material-pagination__link:active,
        .material-pagination .material-pagination__link:focus {
          background-color: #c9c9c9;
          border-color: #c9c9c9;
          color: #000;
        }
        .material-pagination_primary .material-pagination__link:hover {
          background-color: #fff;
          border-color: #64b2f5;
          color: #64b2f5;
        }
        .material-pagination_primary .material-pagination__link,
        .material-pagination_primary .material-pagination__link_disabled,
        .material-pagination_primary .material-pagination__link_disabled:hover {
          background-color: #4092d9;
          border-color: #4092d9;
          color: #fff;
        }
        .material-pagination_primary .material-pagination__link_active,
        .material-pagination_primary .material-pagination__link_active:active,
        .material-pagination_primary .material-pagination__link_active:focus,
        .material-pagination_primary .material-pagination__link_active:hover,
        .material-pagination_primary .material-pagination__link:active,
        .material-pagination_primary .material-pagination__link:focus {
          background-color: #fff;
          border-color: #3488d1;
          color: #3488d1;
        }
        .material-pagination_success .material-pagination__link:hover {
          background-color: #fff;
          border-color: #66d566;
          color: #66d566;
        }
        .material-pagination_success .material-pagination__link,
        .material-pagination_success .material-pagination__link_disabled,
        .material-pagination_success .material-pagination__link_disabled:hover {
          background-color: #68c368;
          border-color: #68c368;
          color: #fff;
        }
        .material-pagination_success .material-pagination__link_active,
        .material-pagination_success .material-pagination__link_active:active,
        .material-pagination_success .material-pagination__link_active:focus,
        .material-pagination_success .material-pagination__link_active:hover,
        .material-pagination_success .material-pagination__link:active,
        .material-pagination_success .material-pagination__link:focus {
          background-color: #fff;
          border-color: #22ac22;
          color: #22ac22;
        }
        .material-pagination_info .material-pagination__link:hover {
          background-color: #fff;
          border-color: #bbedfc;
          color: #bbedfc;
        }
        .material-pagination_info .material-pagination__link,
        .material-pagination_info .material-pagination__link_disabled,
        .material-pagination_info .material-pagination__link_disabled:hover {
          background-color: #8bdaf2;
          border-color: #8bdaf2;
          color: #fff;
        }
        .material-pagination_info .material-pagination__link_active,
        .material-pagination_info .material-pagination__link_active:active,
        .material-pagination_info .material-pagination__link_active:focus,
        .material-pagination_info .material-pagination__link_active:hover,
        .material-pagination_info .material-pagination__link:active,
        .material-pagination_info .material-pagination__link:focus {
          background-color: #fff;
          border-color: #3ab4d8;
          color: #3ab4d8;
        }
        .material-pagination_warning .material-pagination__link:hover {
          background-color: #fff;
          border-color: #fab655;
          color: #fab655;
        }
        .material-pagination_warning .material-pagination__link,
        .material-pagination_warning .material-pagination__link_disabled,
        .material-pagination_warning .material-pagination__link_disabled:hover {
          background-color: #f2a12e;
          border-color: #f2a12e;
          color: #fff;
        }
        .material-pagination_warning .material-pagination__link_active,
        .material-pagination_warning .material-pagination__link_active:active,
        .material-pagination_warning .material-pagination__link_active:focus,
        .material-pagination_warning .material-pagination__link_active:hover,
        .material-pagination_warning .material-pagination__link:active,
        .material-pagination_warning .material-pagination__link:focus {
          background-color: #fff;
          border-color: #d3953c;
          color: #d3953c;
        }
        .material-pagination_danger .material-pagination__link:hover {
          background-color: #fff;
          border-color: #f36c68;
          color: #f36c68;
        }
        .material-pagination_danger .material-pagination__link,
        .material-pagination_danger .material-pagination__link_disabled,
        .material-pagination_danger .material-pagination__link_disabled:hover {
          background-color: #f3413c;
          border-color: #f3413c;
          color: #fff;
        }
        .material-pagination_danger .material-pagination__link_active,
        .material-pagination_danger .material-pagination__link_active:active,
        .material-pagination_danger .material-pagination__link_active:focus,
        .material-pagination_danger .material-pagination__link_active:hover,
        .material-pagination_danger .material-pagination__link:active,
        .material-pagination_danger .material-pagination__link:focus {
          background-color: #fff;
          border-color: #c72a25;
          color: #c72a25;
        }
        .material-label {
          font-weight: 700;
          font-size: 14px;
          display: inline-block;
          border-radius: 0;
          padding: 4px 16px;
          -webkit-transition-property: box-shadow, background-color;
          transition-property: box-shadow, background-color;
          -webkit-transition-duration: 0.5s;
          transition-duration: 0.5s;
          -webkit-transition-timing-function: ease-out;
          transition-timing-function: ease-out;
          -webkit-transition-delay: 0s;
          transition-delay: 0s;
        }
        .material-label_lg {
          padding: 5px 20px;
          font-size: 16px;
        }
        .material-label_sm {
          padding: 3px 12px;
          font-size: 13px;
        }
        .material-label_xs {
          padding: 2px 8px;
          font-size: 12px;
        }
        .material-label {
          background-color: #eee;
          border: 1px solid #eee;
          color: #000;
        }
        .material-label:hover {
          background-color: #f7f7f7;
          border: 1px solid #f7f7f7;
        }
        .material-label_primary {
          background-color: #4092d9;
          border: 1px solid #4092d9;
          color: #fff;
        }
        .material-label_primary:hover {
          background-color: #64b2f5;
          border: 1px solid #64b2f5;
        }
        .material-label_success {
          background-color: #68c368;
          border: 1px solid #68c368;
          color: #fff;
        }
        .material-label_success:hover {
          background-color: #66d566;
          border: 1px solid #66d566;
        }
        .material-label_info {
          background-color: #8bdaf2;
          border: 1px solid #8bdaf2;
          color: #fff;
        }
        .material-label_info:hover {
          background-color: #bbedfc;
          border: 1px solid #bbedfc;
        }
        .material-label_warning {
          background-color: #f2a12e;
          border: 1px solid #f2a12e;
          color: #fff;
        }
        .material-label_warning:hover {
          background-color: #fab655;
          border: 1px solid #fab655;
        }
        .material-label_danger {
          background-color: #f3413c;
          border: 1px solid #f3413c;
          color: #fff;
        }
        .material-label_danger:hover {
          background-color: #f36c68;
          border: 1px solid #f36c68;
        }
        .material-badge {
          font-size: 12px;
          padding: 13px 4px;
          border-radius: 50%;
          min-width: 40px;
        }
        .material-badge_lg {
          font-size: 14px;
          padding: 15px 6px;
          min-width: 46px;
        }
        .material-badge_sm {
          font-size: 11px;
          padding: 12px 4px;
          min-width: 37px;
        }
        .material-badge_xs {
          font-size: 10px;
          padding: 11px 3px;
          min-width: 34px;
        }
        .material-badge_no-bg {
          background: none !important;
          border: none !important;
        }
        .material-badge {
          border: 1px solid #eee;
          background-color: #eee;
          color: #000;
        }
        .material-badge_primary {
          border: 1px solid #4092d9;
          background-color: #4092d9;
          color: #fff;
        }
        .material-badge_success {
          border: 1px solid #68c368;
          background-color: #68c368;
          color: #fff;
        }
        .material-badge_info {
          border: 1px solid #8bdaf2;
          background-color: #8bdaf2;
          color: #fff;
        }
        .material-badge_warning {
          border: 1px solid #f2a12e;
          background-color: #f2a12e;
          color: #fff;
        }
        .material-badge_danger {
          border: 1px solid #f3413c;
          background-color: #f3413c;
          color: #fff;
        }
        .material-alert {
          border-radius: 0;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
          font-weight: 700;
          padding: 20px;
        }
        .material-alert__close {
          opacity: 1;
          text-shadow: none;
        }
        .material-alert {
          background-color: #eee;
          color: #000;
        }
        .material-alert__close {
          color: #000;
        }
        .material-alert__close:hover {
          opacity: 1;
          color: #000;
        }
        .material-alert_primary {
          background-color: #4092d9;
          color: #fff;
        }
        .material-alert_primary .material-alert__close {
          color: #fff;
        }
        .material-alert_primary .material-alert__close:hover {
          color: #fff;
        }
        .material-alert_success {
          background-color: #68c368;
          color: #fff;
        }
        .material-alert_success .material-alert__close {
          color: #fff;
        }
        .material-alert_success .material-alert__close:hover {
          color: #fff;
        }
        .material-alert_info {
          background-color: #8bdaf2;
          color: #fff;
        }
        .material-alert_info .material-alert__close {
          color: #fff;
        }
        .material-alert_info .material-alert__close:hover {
          color: #fff;
        }
        .material-alert_warning {
          background-color: #f2a12e;
          color: #fff;
        }
        .material-alert_warning .material-alert__close {
          color: #fff;
        }
        .material-alert_warning .material-alert__close:hover {
          color: #fff;
        }
        .material-alert_danger {
          background-color: #f3413c;
          color: #fff;
        }
        .material-alert_danger .material-alert__close {
          color: #fff;
        }
        .material-alert_danger .material-alert__close:hover {
          color: #fff;
        }
        .material-progress {
          height: 5px;
          border-radius: 0;
        }
        .material-progress {
          background-color: #eee;
        }
        .material-progress__progress-bar {
          background-color: #000;
        }
        .material-progress__progress-bar_primary {
          background-color: #4092d9;
        }
        .material-progress__progress-bar_success {
          background-color: #68c368;
        }
        .material-progress__progress-bar_info {
          background-color: #8bdaf2;
        }
        .material-progress__progress-bar_warning {
          background-color: #f2a12e;
        }
        .material-progress__progress-bar_danger {
          background-color: #f3413c;
        }
        .material-media {
          border-bottom: 1px solid #eee;
          padding: 15px 0;
        }
        .material-media__object {
          width: 64px;
          height: 64px;
          border-radius: 50%;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
          margin: 0 10px;
        }
        .material-media__object_lg {
          width: 128px;
          height: 128px;
        }
        .material-media__object_sm {
          width: 32px;
          height: 32px;
        }
        .material-media__object_xs {
          width: 16px;
          height: 16px;
        }
        .material-media__column_vertical-middle {
          vertical-align: middle;
        }
        .material-list-group__item {
          border: none;
          border-bottom: 1px solid;
          border-radius: 0;
          position: relative;
          margin-bottom: 0;
          padding: 15px 40px 15px 30px;
          -webkit-transition: background-color 0.2s ease-out 0s;
          transition: background-color 0.2s ease-out 0s;
        }
        .material-list-group__item:after {
          content: "";
          display: block;
          clear: both;
        }
        .material-list-group__item:first-child {
          border-radius: 0;
        }
        .material-list-group__item_disabled {
          opacity: 0.5;
        }
        .material-list-group__badge {
          position: absolute;
          top: 50%;
          right: 0;
          -webkit-transform: translateZ(0px) translate(0, -50%);
          transform: translateZ(0px) translate(0, -50%);
        }
        .material-list-group {
          color: #000;
        }
        .material-list-group .material-list-group__item {
          background-color: #eee;
          border-color: #c9c9c9;
        }
        .material-list-group .material-list-group__item:hover {
          background-color: #f7f7f7;
        }
        .material-list-group .material-list-group__item_disabled:hover {
          background-color: #eee;
        }
        .material-list-group_primary {
          color: #fff;
        }
        .material-list-group_primary .material-list-group__item {
          background-color: #4092d9;
          border-color: #fff;
        }
        .material-list-group_primary .material-list-group__item:hover {
          background-color: #64b2f5;
        }
        .material-list-group_primary .material-list-group__item_disabled:hover {
          background-color: #4092d9;
        }
        .material-list-group_success {
          color: #fff;
        }
        .material-list-group_success .material-list-group__item {
          background-color: #68c368;
          border-color: #fff;
        }
        .material-list-group_success .material-list-group__item:hover {
          background-color: #66d566;
        }
        .material-list-group_success .material-list-group__item_disabled:hover {
          background-color: #68c368;
        }
        .material-list-group_info {
          color: #fff;
        }
        .material-list-group_info .material-list-group__item {
          background-color: #8bdaf2;
          border-color: #fff;
        }
        .material-list-group_info .material-list-group__item:hover {
          background-color: #bbedfc;
        }
        .material-list-group_info .material-list-group__item_disabled:hover {
          background-color: #8bdaf2;
        }
        .material-list-group_warning {
          color: #fff;
        }
        .material-list-group_warning .material-list-group__item {
          background-color: #f2a12e;
          border-color: #fff;
        }
        .material-list-group_warning .material-list-group__item:hover {
          background-color: #fab655;
        }
        .material-list-group_warning .material-list-group__item_disabled:hover {
          background-color: #f2a12e;
        }
        .material-list-group_danger {
          color: #fff;
        }
        .material-list-group_danger .material-list-group__item {
          background-color: #f3413c;
          border-color: #fff;
        }
        .material-list-group_danger .material-list-group__item:hover {
          background-color: #f36c68;
        }
        .material-list-group_danger .material-list-group__item_disabled:hover {
          background-color: #f3413c;
        }
        .material-panel {
          border: none;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-panel__heading {
          border-radius: 4px 4px 0 0;
          font-weight: 700;
          border: none;
          padding: 15px 22.5px;
        }
        .material-panel__body {
          background-color: #fff;
          padding: 15px 22.5px;
        }
        .material-panel__heading {
          background-color: #eee;
          color: #000;
        }
        .material-panel_primary .material-panel__heading {
          background-color: #4092d9;
          color: #fff;
        }
        .material-panel_success .material-panel__heading {
          background-color: #68c368;
          color: #fff;
        }
        .material-panel_info .material-panel__heading {
          background-color: #8bdaf2;
          color: #fff;
        }
        .material-panel_warning .material-panel__heading {
          background-color: #f2a12e;
          color: #fff;
        }
        .material-panel_danger .material-panel__heading {
          background-color: #f3413c;
          color: #fff;
        }
        .material-card {
          border-radius: 0;
          border: none;
          padding: 0;
          box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.298039);
        }
        .material-card__header {
          position: relative;
        }
        .material-card__content {
          padding: 20px 20px;
        }
        .material-card__footer {
          padding: 20px;
          border-top: 1px solid #eee;
        }
        .material-card__footer:after {
          content: "";
          display: block;
          clear: both;
        }
        .material-card__img {
          max-width: 100%;
          height: auto;
        }
        .material-card__title {
          margin: 0 0 15px;
        }
        .material-card__showmore {
          display: block;
        }
        .material-card__showmore_pos-left {
          float: left;
          margin-right: 10px;
        }
        .material-card__showmore_pos-right {
          float: right;
          margin-left: 10px;
        }

    </style>
    <title>Bootstrap Material</title>
</head>
<body>
        <header class="top-panel">
            <div class="main-container top-panel__layout">
                <h1 class="top-panel__logo">Material design for Bootstrap 3</h1>
                <nav class="top-panel__nav">
                    <a href="https://www.paypal.me/melnik909" class="top-panel__link" rel="noopener noreferrer" target="_blank"><span class="top-panel__hover-label">Donate</span></a>         
                    <a href="https://github.com/melnik909/material_bootstrap_theme" class="top-panel__link" rel="noopener noreferrer" target="_blank"><span class="top-panel__hover-label">Source code GitHub</span></a> 
                </nav>
            </div>
        </header>   
        <div class="main-container">

            <h3>Typography</h3>
            <div class="bs-example bs-example-type" data-example-id="simple-headings">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><h1>h1. Bootstrap heading</h1></td>
                            <td class="type-info">36px</td>
                        </tr>
                        <tr>
                        <td><h2>h2. Bootstrap heading</h2></td>
                            <td class="type-info">30px</td>
                        </tr>
                        <tr>
                            <td><h3>h3. Bootstrap heading</h3></td>
                            <td class="type-info">24px</td>
                        </tr>
                        <tr>
                            <td><h4>h4. Bootstrap heading</h4></td>
                            <td class="type-info">18px</td>
                        </tr>
                        <tr>
                            <td><h5>h5. Bootstrap heading</h5></td>
                            <td class="type-info">14px</td>
                        </tr>
                        <tr>
                            <td><h6>h6. Bootstrap heading</h6></td>
                            <td class="type-info">12px</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <h3>Dropdowns</h3>
            <div class="main-container__section">
                    
                <div class="dropdown material-dropdown main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu">
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                    
                <div class="dropdown material-dropdown material-dropdown_primary main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_primary">
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                    
                <div class="dropdown material-dropdown material-dropdown_success main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_success">
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_info main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_info">
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_danger main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_danger">
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>

                <div class="dropdown material-dropdown material-dropdown_warning main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_warning">
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>

            </div>
            
            <h3>Dropdowns with headers</h3>
            <div class="main-container__section">
                    
                <div class="dropdown material-dropdown main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_primary main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_primary">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_success main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_success">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_info main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_info">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_danger main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_danger">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_warning main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_warning">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>

            </div>
            
            <h3>Dropdowns with divider</h3>
            <div class="main-container__section">
                    
                <div class="dropdown material-dropdown main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link ">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_primary main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_primary">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link ">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_success main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_success">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link ">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_info main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_info">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link ">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_danger main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_danger">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link ">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_warning main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_warning">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link ">Another action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>

            </div>
            
            <h3>Dropdowns with disabled menu items</h3>
            <div class="main-container__section">
                    
                <div class="dropdown material-dropdown main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link material-dropdown-menu__link_disabled">Disabled link</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_primary main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_primary">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link material-dropdown-menu__link_disabled">Disabled link</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_success main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_success">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link material-dropdown-menu__link_disabled">Disabled link</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_info main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_info">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link material-dropdown-menu__link_disabled">Disabled link</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_warning main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">Dropdown<span class="caret material-dropdown__caret "></span></button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_warning">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link material-dropdown-menu__link_disabled">Disabled link</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>
                
                <div class="dropdown material-dropdown material-dropdown_danger main-container__column">
                    <button class="dropdown-toggle material-dropdown__btn" data-toggle="dropdown">
                        Dropdown
                        <span class="caret material-dropdown__caret "></span>
                    </button>
                    <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_danger">
                        <li class="dropdown-header material-dropdown__header">Dropdown header</li>
                        <li><a href="#0" class="material-dropdown-menu__link">Action</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link material-dropdown-menu__link_disabled">Disabled link</a></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Something else here</a></li>
                        <li class="divider material-dropdown__divider"></li>
                        <li><a href="#0" class="material-dropdown-menu__link">Separated link</a></li>
                    </ul>
                </div>

            </div>
            
            <h3>Buttons</h3>
            <div class="main-container__section">
                <button class="btn material-btn main-container__column">Button</button>
                <button class="btn material-btn material-btn_primary main-container__column">Button</button>
                <button class="btn material-btn material-btn_success main-container__column">Button</button>
                <button class="btn material-btn material-btn_info main-container__column">Button</button>
                <button class="btn material-btn material-btn_warning main-container__column">Button</button>
                <button class="btn material-btn material-btn_danger main-container__column">Button</button>
        
            </div>

            <h3>Buttons sizing</h3>
            <div class="main-container__section">
                <div class="main-container__column">
                    <button class="btn material-btn material-btn_lg">Large button</button>
                </div>
                <div class="main-container__column">
                    <button class="btn material-btn material-btn_primary">Middle button</button>
                </div>
                <div class="main-container__column">
                    <button class="btn material-btn material-btn_sm material-btn_success">Small button</button>
                </div>
                <div class="main-container__column">    
                    <button class="btn material-btn material-btn_xs material-btn_info">Extra small button</button>
                </div>
        
            </div>  

            <h3>Buttons disabled state</h3>
            <div class="main-container__section">
                <button class="btn material-btn main-container__column" disabled >button</button>
            <button class="btn material-btn material-btn_primary main-container__column" disabled >primary</button>
            <button class="btn material-btn material-btn_success main-container__column" disabled >success</button>
            <button class="btn material-btn material-btn_info main-container__column" disabled >info</button>
            <button class="btn material-btn material-btn_warning main-container__column" disabled >warning</button>
            <button class="btn material-btn material-btn_danger main-container__column" disabled >danger</button>
        
            </div>  
                
            <h3>Button groups</h3>
            <div class="main-container__section">
                <div class="btn-group main-container__column" role="group" aria-label="Basic example">
                <button type="button" class="btn material-btn">Left</button>
                <button type="button" class="btn material-btn">Middle</button>
                <button type="button" class="btn material-btn">Right</button>
            </div>
        
                <div class="btn-group main-container__column" role="group" aria-label="Basic example">
                    <button type="button" class="btn material-btn material-btn_primary">Left</button>
                    <button type="button" class="btn material-btn material-btn_primary">Middle</button>
                    <button type="button" class="btn material-btn material-btn_primary">Right</button>
                </div>
                
                <div class="btn-group main-container__column" role="group" aria-label="Basic example">
                    <button type="button" class="btn material-btn material-btn_success">Left</button>
                    <button type="button" class="btn material-btn material-btn_success">Middle</button>
                    <button type="button" class="btn material-btn material-btn_success">Right</button>
                </div>
                
                <div class="btn-group main-container__column" role="group" aria-label="Basic example">
                    <button type="button" class="btn material-btn material-btn_info">Left</button>
                    <button type="button" class="btn material-btn material-btn_info">Middle</button>
                    <button type="button" class="btn material-btn material-btn_info">Right</button>
                </div>
                
                <div class="btn-group main-container__column" role="group" aria-label="Basic example">
                    <button type="button" class="btn material-btn material-btn_warning">Left</button>
                    <button type="button" class="btn material-btn material-btn_warning">Middle</button>
                    <button type="button" class="btn material-btn material-btn_warning">Right</button>
                </div>
                
                <div class="btn-group main-container__column" role="group" aria-label="Basic example">
                    <button type="button" class="btn material-btn material-btn_danger">Left</button>
                    <button type="button" class="btn material-btn material-btn_danger">Middle</button>
                    <button type="button" class="btn material-btn material-btn_danger">Right</button>
                </div>
        
            </div>  
            
            <h3 class="page-header">Button groups sizing</h3>
            <div class="main-container__section">
                <div class="main-container__column">
                    <div class="btn-group material-btn_group material-btn-group_lg">
                        <button type="button" class="btn material-btn">Left</button>
                        <button type="button" class="btn material-btn">Middle</button>
                        <button type="button" class="btn material-btn">Right</button>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="btn-group material-btn_group">
                        <button type="button" class="btn material-btn material-btn_primary">Left</button>
                        <button type="button" class="btn material-btn material-btn_primary">Middle</button>
                        <button type="button" class="btn material-btn material-btn_primary">Right</button>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="btn-group material-btn_group material-btn-group_sm">
                        <button type="button" class="btn material-btn material-btn_warning">Left</button>
                        <button type="button" class="btn material-btn material-btn_warning">Middle</button>
                        <button type="button" class="btn material-btn material-btn_warning">Right</button>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="btn-group material-btn_group material-btn-group_xs">
                        <button type="button" class="btn material-btn material-btn_success">Left</button>
                        <button type="button" class="btn material-btn material-btn_success">Middle</button>
                        <button type="button" class="btn material-btn material-btn_success">Right</button>
                    </div>
                </div>
        
            </div>  
            
            <h3 class="page-header">Button dropdowns</h3>
            <div class="main-container__section">
                <div class="main-container__column">    
                    <div class="btn-group material-btn-group">
                        <button class="dropdown-toggle material-btn material-dropdown-btn" data-toggle="dropdown">Default<span class="caret material-btn__caret"></span></button>
                        <ul class="dropdown-menu material-dropdown-menu" role="menu">
                            <li><a href="#" class="material-dropdown-menu__link">Action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Another action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Something else here</a></li>
                            <li class="divider material-dropdown__divider"></li>
                            <li><a href="#" class="material-dropdown-menu__link">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-container__column">
                    <div class="btn-group material-btn-group">
                        <button class="dropdown-toggle material-dropdown-btn material-btn material-btn_primary" data-toggle="dropdown">Primary<span class="caret material-btn__caret"></span></button>
                        <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_primary" role="menu">
                            <li><a href="#" class="material-dropdown-menu__link">Action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Another action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Something else here</a></li>
                            <li class="divider material-dropdown__divider"></li>
                            <li><a href="#" class="material-dropdown-menu__link">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-container__column">    
                    <div class="btn-group material-btn-group">
                        <button class="dropdown-toggle material-dropdown-btn material-btn material-btn_success" data-toggle="dropdown">Success<span class="caret material-btn__caret"></span></button>
                        <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_success" role="menu">
                            <li><a href="#" class="material-dropdown-menu__link">Action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Another action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Something else here</a></li>
                            <li class="divider material-dropdown__divider"></li>
                            <li><a href="#" class="material-dropdown-menu__link">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-container__column">
                    <div class="btn-group material-btn-group">
                        <button class="dropdown-toggle material-dropdown-btn material-btn material-btn_info" data-toggle="dropdown">Info<span class="caret material-btn__caret"></span></button>
                        <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_info" role="menu">
                            <li><a href="#" class="material-dropdown-menu__link">Action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Another action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Something else here</a></li>
                            <li class="divider material-dropdown__divider"></li>
                            <li><a href="#" class="material-dropdown-menu__link">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-container__column">
                    <div class="btn-group material-btn-group">
                        <button class="dropdown-toggle material-dropdown-btn material-btn material-btn_warning" data-toggle="dropdown">Warning<span class="caret material-btn__caret"></span></button>
                        <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_warning" role="menu">
                            <li><a href="#" class="material-dropdown-menu__link">Action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Another action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Something else here</a></li>
                            <li class="divider material-dropdown__divider"></li>
                            <li><a href="#" class="material-dropdown-menu__link">Separated link</a></li>
                        </ul>
                    </div>
                </div>

                <div class="main-container__column">
                    <div class="btn-group material-btn-group">
                        <button class="dropdown-toggle material-dropdown-btn material-btn material-btn_danger" data-toggle="dropdown">Danger<span class="caret material-btn__caret"></span></button>
                        <ul class="dropdown-menu material-dropdown-menu material-dropdown-menu_danger" role="menu">
                            <li><a href="#" class="material-dropdown-menu__link">Action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Another action</a></li>
                            <li><a href="#" class="material-dropdown-menu__link">Something else here</a></li>
                            <li class="divider material-dropdown__divider"></li>
                            <li><a href="#" class="material-dropdown-menu__link">Separated link</a></li>
                        </ul>
                    </div>
                </div>

            </div>  
            
            <h3>Inputs</h3>
            <div class="main-container__section">
                <div class="main-container__column">
                    <div class="form-group materail-input-block">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_primary">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group  materail-input-block materail-input-block_success">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_info">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_danger">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_warning">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>  
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block">
                        <input class="form-control materail-input" placeholder="Your placeholder" disabled>
                        <span class="materail-input-block__line"></span>
                    </div>  
                </div>  
        
            </div>  
            
            <h3>Inputs animated state</h3>
            <div class="main-container__section">
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input_slide-line">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>  
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_primary materail-input_slide-line">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group  materail-input-block materail-input-block_success materail-input_slide-line">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_info materail-input_slide-line">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_danger materail-input_slide-line">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">        
                    <div class="form-group materail-input-block materail-input-block_warning materail-input_slide-line">
                        <input class="form-control materail-input" placeholder="Your placeholder">
                        <span class="materail-input-block__line"></span>
                    </div>  
                </div>  
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input_slide-line">
                        <input class="form-control materail-input" placeholder="Your placeholder" disabled>
                        <span class="materail-input-block__line"></span>
                    </div>  
                </div>      
                
            </div>  

            <h3>Textarea</h3>
            <div class="main-container__section">
                <div class="main-container__column">
                    <div class="form-group materail-input-block">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                    </div>
                </div>
                <div class="main-container__column">
                    <div class="form-group materail-input-block materail-input-block_primary">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_success">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_info">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_danger">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_warning">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_primary materail-input_disabled">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information" disabled ></textarea>
                    </div>
                </div>
                
            </div>  
            
            <h3>Textarea animated state</h3>
            <div class="main-container__section">
                <div class="main-container__column">
                    <div class="form-group materail-input-block materail-input_slide-line">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">
                    <div class="form-group materail-input-block materail-input-block_primary materail-input_slide-line">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_success materail-input_slide-line">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_info materail-input_slide-line">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_danger materail-input_slide-line">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_warning materail-input_slide-line">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information"></textarea>
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                <div class="main-container__column">    
                    <div class="form-group materail-input-block materail-input-block_primary materail-input_disabled">
                        <textarea class="form-control materail-input material-textarea" placeholder="Information" disabled ></textarea>
                        <span class="materail-input-block__line"></span>
                    </div>
                </div>
                
            </div>  
                
            <h3>Radiobox</h3>
            <div class="main-container__section">
                <label class="main-container__column material-radio-group" for="radio1">
                    <input type="radio" name="radiobox" id="radio1" class="material-radiobox"/>
                    <span class="material-radio-group__element material-radio-group__check-radio"></span>
                    <span class="material-radio-group__element material-radio-group__caption">Default</span>
                </label>
                <label class="main-container__column material-radio-group material-radio-group_primary" for="radio2">
                    <input type="radio" name="radiobox" id="radio2" class="material-radiobox"/>
                    <span class="material-radio-group__element material-radio-group__check-radio"></span>
                    <span class="material-radio-group__element material-radio-group__caption">Primary</span>
                </label>
                <label class="main-container__column material-radio-group material-radio-group_success" for="radio3">
                    <input type="radio" name="radiobox" id="radio3" class="material-radiobox"/>
                    <span class="material-radio-group__element material-radio-group__check-radio"></span>
                    <span class="material-radio-group__element material-radio-group__caption">Success</span>
                </label>
                <label class="main-container__column material-radio-group material-radio-group_info" for="radio4">
                    <input type="radio" name="radiobox" id="radio4" class="material-radiobox"/>
                    <span class="material-radio-group__element material-radio-group__check-radio"></span>
                    <span class="material-radio-group__element material-radio-group__caption">Info</span>
                </label>
                <label class="main-container__column material-radio-group material-radio-group_danger" for="radio5">
                    <input type="radio" name="radiobox" id="radio5" class="material-radiobox"/>
                    <span class="material-radio-group__element material-radio-group__check-radio"></span>
                    <span class="material-radio-group__element material-radio-group__caption">Danger</span>
                </label>
                <label class="main-container__column material-radio-group material-radio-group_warning" for="radio6">
                    <input type="radio" name="radiobox" id="radio6" class="material-radiobox"/>
                    <span class="material-radio-group__element material-radio-group__check-radio"></span>
                    <span class="material-radio-group__element material-radio-group__caption">Warning</span>
                </label>
                <label class="main-container__column material-radio-group" for="radio7">
                    <input type="radio" name="radiobox" id="radio7" class="material-radiobox" disabled />
                    <span class="material-radio-group__element material-radio-group__check-radio"></span>
                    <span class="material-radio-group__element material-radio-group__caption">Disabled</span>
                </label>
            
            </div>  
                
            <h3>Checkbox</h3>
            <div class="main-container__section">
                <div class="main-container__column material-checkbox-group">
                    <input type="checkbox" id="checkbox0" name="checkbox" class="material-checkbox">
                    <label class="material-checkbox-group__label" for="checkbox0">Do you like it?</label>
                </div>
                <div class="main-container__column material-checkbox-group material-checkbox-group_primary">
                    <input type="checkbox" id="checkbox1" name="checkbox" class="material-checkbox">
                    <label class="material-checkbox-group__label" for="checkbox1">Primary</label>
                </div>      
                <div class="main-container__column material-checkbox-group material-checkbox-group_success">
                    <input type="checkbox" id="checkbox2" name="checkbox" class="material-checkbox">
                    <label class="material-checkbox-group__label" for="checkbox2">Success</label>
                </div>
                <div class="main-container__column material-checkbox-group material-checkbox-group_info">
                    <input type="checkbox" id="checkbox3" name="checkbox" class="material-checkbox">
                    <label class="material-checkbox-group__label" for="checkbox3">Info</label>
                </div>
                <div class="main-container__column material-checkbox-group material-checkbox-group_warning">
                    <input type="checkbox" id="checkbox4" name="checkbox" class="material-checkbox">
                    <label class="material-checkbox-group__label" for="checkbox4">Warning</label>
                </div>
                <div class="main-container__column material-checkbox-group material-checkbox-group_danger">
                    <input type="checkbox" id="checkbox5" name="checkbox" class="material-checkbox">
                    <label class="material-checkbox-group__label" for="checkbox5">Danger</label>
                </div>
                <div class="main-container__column material-checkbox-group">
                    <input type="checkbox" id="checkbox6" name="checkbox" class="material-checkbox" disabled>
                    <label class="material-checkbox-group__label" for="checkbox6">Disabled</label>
                </div>

            </div>      

            <h3>Switch</h3>
            <div class="main-container__section">   
                <div class="main-container__column materail-switch">
                    <input class="materail-switch__element" type="checkbox" id="switch_input">
                    <label class="materail-switch__label" for="switch_input"></label>
                </div>
                <div class="main-container__column materail-switch materail-switch_primary">
                    <input class="materail-switch__element" type="checkbox" id="switch_input1">
                    <label class="materail-switch__label" for="switch_input1"></label>
                </div>
                <div class="main-container__column materail-switch materail-switch_success">
                    <input class="materail-switch__element" type="checkbox" id="switch_input2">
                    <label class="materail-switch__label" for="switch_input2"></label>
                </div>
                <div class="main-container__column materail-switch materail-switch_info">
                    <input class="materail-switch__element" type="checkbox" id="switch_input3">
                    <label class="materail-switch__label" for="switch_input3"></label>
                </div>
                <div class="main-container__column materail-switch materail-switch_danger">
                    <input class="materail-switch__element" type="checkbox" id="switch_input4">
                    <label class="materail-switch__label" for="switch_input4"></label>
                </div>
                <div class="main-container__column materail-switch materail-switch_warning">
                    <input class="materail-switch__element" type="checkbox" id="switch_input5">
                    <label class="materail-switch__label" for="switch_input5"></label>
                </div>
                <div class="main-container__column materail-switch materail-switch_warning">
                    <input class="materail-switch__element" type="checkbox" id="switch_input6" disabled>
                    <label class="materail-switch__label" for="switch_input6"></label>
                </div>      
            </div>      

                
            <h3>Accordion</h3>
            <div class="panel-group material-accordion" id="accordion">
                <div class="panel panel-default material-accordion__panel">
                    <div class="panel-heading material-accordion__heading" id="acc_headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#acc_collapseOne" class="material-accordion__title">Collapsible Group Item #1</a>
                        </h4>
                    </div>
                    <div id="acc_collapseOne" class="panel-collapse collapse in material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default material-accordion__panel">
                    <div class="panel-heading material-accordion__heading" id="acc_headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed material-accordion__title" data-toggle="collapse" data-parent="#accordion" href="#acc_collapseTwo">Collapsible Group Item #2</a>
                        </h4>
                    </div>
                    <div id="acc_collapseTwo" class="panel-collapse collapse material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-group material-accordion material-accordion_primary" id="accordion1">
                <div class="panel panel-default material-accordion__panel material-accordion__panel">
                    <div class="panel-heading material-accordion__heading" id="acc1_headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseOne" class="material-accordion__title">Collapsible Group Item #1</a>
                        </h4>
                    </div>
                    <div id="acc1_collapseOne" class="panel-collapse collapse in material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default material-accordion__panel">
                    <div class="panel-heading material-accordion__heading">
                        <h4 class="panel-title">
                            <a class="collapsed material-accordion__title" data-toggle="collapse" data-parent="#accordion1" href="#acc1_collapseTwo">Collapsible Group Item #2</a>
                        </h4>
                    </div>
                    <div id="acc1_collapseTwo" class="panel-collapse collapse material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-group material-accordion material-accordion_success" id="accordion2">
                <div class="panel panel-default material-accordion__panel material-accordion__panel">
                    <div class="panel-heading material-accordion__heading" id="acc2_headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseOne" class="material-accordion__title">Collapsible Group Item #1</a>
                        </h4>
                    </div>
                    <div id="acc2_collapseOne" class="panel-collapse collapse in material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default material-accordion__panel">
                    <div class="panel-heading material-accordion__heading">
                        <h4 class="panel-title">
                            <a class="collapsed material-accordion__title" data-toggle="collapse" data-parent="#accordion2" href="#acc2_collapseTwo">Collapsible Group Item #2</a>
                        </h4>
                    </div>
                    <div id="acc2_collapseTwo" class="panel-collapse collapse material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-group material-accordion material-accordion_info" id="accordion3">
                <div class="panel panel-default material-accordion__panel material-accordion__panel">
                    <div class="panel-heading material-accordion__heading" id="acc3_headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion3" href="#acc3_collapseOne" class="material-accordion__title">Collapsible Group Item #1</a>
                        </h4>
                    </div>
                    <div id="acc3_collapseOne" class="panel-collapse collapse in material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default material-accordion__panel">
                    <div class="panel-heading material-accordion__heading">
                        <h4 class="panel-title">
                            <a class="collapsed material-accordion__title" data-toggle="collapse" data-parent="#accordion3" href="#acc3_collapseTwo">Collapsible Group Item #2</a>
                        </h4>
                    </div>
                    <div id="acc3_collapseTwo" class="panel-collapse collapse material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-group material-accordion material-accordion_danger" id="accordion4">
                <div class="panel panel-default material-accordion__panel material-accordion__panel">
                    <div class="panel-heading material-accordion__heading" id="acc4_headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion4" href="#acc4_collapseOne" class="material-accordion__title">Collapsible Group Item #1</a>
                        </h4>
                    </div>
                    <div id="acc4_collapseOne" class="panel-collapse collapse in material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default material-accordion__panel">
                    <div class="panel-heading material-accordion__heading">
                        <h4 class="panel-title">
                            <a class="collapsed material-accordion__title" data-toggle="collapse" data-parent="#accordion4" href="#acc4_collapseTwo">Collapsible Group Item #2</a>
                        </h4>
                    </div>
                    <div id="acc4_collapseTwo" class="panel-collapse collapse material-accordion__collapse" role="tabpanel">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel-group material-accordion material-accordion_warning" id="accordion5">
                <div class="panel panel-default material-accordion__panel material-accordion__panel">
                    <div class="panel-heading material-accordion__heading" id="acc5_headingOne">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion5" href="#acc5_collapseOne" class="material-accordion__title">Collapsible Group Item #1</a>
                        </h4>
                    </div>
                    <div id="acc5_collapseOne" class="panel-collapse collapse in material-accordion__collapse">
                        <div class="panel-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default material-accordion__panel">
                    <div class="panel-heading material-accordion__heading">
                        <h4 class="panel-title">
                            <a class="collapsed material-accordion__title" data-toggle="collapse" data-parent="#accordion5" href="#acc5_collapseTwo">Collapsible Group Item #2</a>
                        </h4>
                    </div>
                    <div id="acc5_collapseTwo" class="panel-collapse collapse material-accordion__collapse">
                        <div class="panel-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
            </div>      
            
                
            <h3>Pills</h3>   
            <div class="main-container__section">
                <ul class="nav nav-pills material-pills">
                    <li class="active"><a href="#0" class="material-pills__link">Home</a></li>
                    <li><a href="#0" class="material-pills__link material-pills__link_disabled">disabled</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                </ul>
            </div>
            
            <div class="main-container__section">
                <ul class="nav nav-pills material-pills material-pills_primary">
                    <li class="active"><a href="#0" class="material-pills__link">Home</a></li>
                    <li><a href="#0" class="material-pills__link material-pills__link_disabled">disabled</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                </ul>
            </div>
                
            <div class="main-container__section">       
                <ul class="nav nav-pills material-pills material-pills_success">
                    <li class="active"><a href="#0" class="material-pills__link">Home</a></li>
                    <li><a href="#0" class="material-pills__link material-pills__link_disabled">disabled</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                </ul>
            </div>
                
            <div class="main-container__section">       
                <ul class="nav nav-pills material-pills material-pills_info">
                    <li class="active"><a href="#0" class="material-pills__link">Home</a></li>
                    <li><a href="#0" class="material-pills__link material-pills__link_disabled">disabled</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                </ul>
            </div>
                
            <div class="main-container__section">   
                <ul class="nav nav-pills material-pills material-pills_danger">
                    <li class="active"><a href="#0" class="material-pills__link">Home</a></li>
                    <li><a href="#0" class="material-pills__link material-pills__link_disabled">disabled</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                </ul>
            </div>
                
            <div class="main-container__section">   
                <ul class="nav nav-pills material-pills material-pills_warning">
                    <li class="active"><a href="#0" class="material-pills__link">Home</a></li>
                    <li><a href="#0" class="material-pills__link material-pills__link_disabled">disabled</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                    <li><a href="#0" class="material-pills__link">Messages</a></li>
                </ul>
            </div>
            
             
            <h3>Tabs</h3>               
            <div class="main-container__section">
                <div class="panel-group material-tabs-group">
                    <ul class="nav nav-tabs material-tabs">
                        <li class="active"><a href="#home" class="material-tabs__tab-link" data-toggle="tab">Home</a></li>
                        <li><a href="#profile" class="material-tabs__tab-link" data-toggle="tab">Profile</a></li>
                        <li><a href="javascript:void(0)" class="material-tabs__tab-link material-tabs__tab-link_disabled">disabled</a></li>
                    </ul>
                    <div class="tab-content materail-tabs-content">
                        <div class="tab-pane fade active in" id="home">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                        <div class="tab-pane fade" id="profile">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                    </div>
                </div>
                    
                <div class="panel-group material-tabs-group">
                    <ul class="nav nav-tabs material-tabs material-tabs_primary">
                        <li class="active"><a href="#home1" class="material-tabs__tab-link" data-toggle="tab">Home</a></li>
                        <li><a href="#profile1" class="material-tabs__tab-link" data-toggle="tab">Profile</a></li>
                        <li><a href="javascript:void(0)" class="material-tabs__tab-link material-tabs__tab-link_disabled">disabled</a></li>
                    </ul>       
                    <div class="tab-content materail-tabs-content">
                        <div class="tab-pane fade active in" id="home1">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                        <div class="tab-pane fade" id="profile1">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                    </div>
                </div>
                    
                <div class="panel-group material-tabs-group">
                    <ul class="nav nav-tabs material-tabs material-tabs_success">
                        <li class="active"><a href="#home2" class="material-tabs__tab-link" data-toggle="tab">Home</a></li>
                        <li><a href="#profile2" class="material-tabs__tab-link" data-toggle="tab">Profile</a></li>
                        <li><a href="javascript:void(0)" class="material-tabs__tab-link material-tabs__tab-link_disabled">disabled</a></li>
                    </ul>       
                    <div class="tab-content materail-tabs-content">
                        <div class="tab-pane fade active in" id="home2">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                        <div class="tab-pane fade" id="profile2">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                    </div>
                </div>      
                    
                <div class="panel-group material-tabs-group">
                    <ul class="nav nav-tabs material-tabs material-tabs_info">
                        <li class="active"><a href="#home3" class="material-tabs__tab-link" data-toggle="tab">Home</a></li>
                        <li><a href="#profile3" class="material-tabs__tab-link" data-toggle="tab">Profile</a></li>
                        <li><a href="javascript:void(0)" class="material-tabs__tab-link material-tabs__tab-link_disabled">disabled</a></li>
                    </ul>       
                    <div class="tab-content materail-tabs-content">
                        <div class="tab-pane fade active in" id="home3">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                        <div class="tab-pane fade" id="profile3">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                    </div>
                </div>      
                    
                <div class="panel-group material-tabs-group">
                    <ul class="nav nav-tabs material-tabs material-tabs_danger">
                        <li class="active"><a href="#home4" class="material-tabs__tab-link" data-toggle="tab">Home</a></li>
                        <li><a href="#profile4" class="material-tabs__tab-link" data-toggle="tab">Profile</a></li>
                        <li><a href="javascript:void(0)" class="material-tabs__tab-link material-tabs__tab-link_disabled">disabled</a></li>
                    </ul>       
                    <div class="tab-content materail-tabs-content">
                        <div class="tab-pane fade active in" id="home4">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                        <div class="tab-pane fade" id="profile4">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                    </div>
                </div>
                    
                <div class="panel-group material-tabs-group">
                    <ul class="nav nav-tabs material-tabs material-tabs_warning">
                        <li class="active"><a href="#home5" class="material-tabs__tab-link" data-toggle="tab">Home</a></li>
                        <li><a href="#profile5" class="material-tabs__tab-link" data-toggle="tab">Profile</a></li>
                        <li><a href="javascript:void(0)" class="material-tabs__tab-link material-tabs__tab-link_disabled">disabled</a></li>
                    </ul>       
                    <div class="tab-content materail-tabs-content">
                        <div class="tab-pane fade active in" id="home5">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                        <div class="tab-pane fade" id="profile5">
                            <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
                        </div>
                    </div>
                </div>
            
            </div>      
            
            <h3>Breadcrumbs</h3>
            <div class="main-container__section">
                <ol class="breadcrumb material-breadcrumb">
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Home</a></li>
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Library</a></li>
                    <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">Data</span></li>
                </ol>
                
                
                <ol class="breadcrumb material-breadcrumb material-breadcrumb_primary">
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Home</a></li>
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Library</a></li>
                    <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">Data</span></li>
                </ol>
                    

                <ol class="breadcrumb material-breadcrumb material-breadcrumb_success">
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Home</a></li>
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Library</a></li>
                    <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">Data</span></li>
                </ol>
                    

                <ol class="breadcrumb material-breadcrumb material-breadcrumb_info">
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Home</a></li>
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Library</a></li>
                    <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">Data</span></li>
                </ol>
                    

                <ol class="breadcrumb material-breadcrumb material-breadcrumb_danger">
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Home</a></li>
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Library</a></li>
                    <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">Data</span></li>
                </ol>
                

                <ol class="breadcrumb material-breadcrumb material-breadcrumb_warning">
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Home</a></li>
                    <li class="material-breadcrumb__item"><a href="#" class="material-breadcrumb__link">Library</a></li>
                    <li class="material-breadcrumb__item"><span class="material-breadcrumb__active-element">Data</span></li>
                </ol>
                    
            </div>      
            
            <h3>Pagination</h3>
            <div class="main-container__section">
                <ul class="pagination material-pagination main-container__column">
                    <li><a href="#0" class="material-pagination__link">&laquo;</a></li>
                    <li><a href="#0" class="material-pagination__link">1</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_active">2</a></li>
                    <li><a href="#0" class="material-pagination__link">3</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_disabled">4</a></li>
                    <li><a href="#0" class="material-pagination__link">5</a></li>
                    <li><a href="#0" class="material-pagination__link">&raquo;</a></li>
                </ul>
                
                
                <ul class="pagination material-pagination material-pagination_primary main-container__column">
                    <li><a href="#0" class="material-pagination__link">&laquo;</a></li>
                    <li><a href="#0" class="material-pagination__link">1</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_active">2</a></li>
                    <li><a href="#0" class="material-pagination__link">3</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_disabled">4</a></li>
                    <li><a href="#0" class="material-pagination__link">5</a></li>
                    <li><a href="#0" class="material-pagination__link">&raquo;</a>
                    </li>
                </ul>
                        
                
                <ul class="pagination material-pagination material-pagination_success main-container__column">
                    <li><a href="#0" class="material-pagination__link">&laquo;</a></li>
                    <li><a href="#0" class="material-pagination__link">1</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_active">2</a></li>
                    <li><a href="#0" class="material-pagination__link">3</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_disabled">4</a></li>
                    <li><a href="#0" class="material-pagination__link">5</a></li>
                    <li><a href="#0" class="material-pagination__link">&raquo;</a></li>
                </ul>
                    

                <ul class="pagination material-pagination material-pagination_info main-container__column">
                    <li><a href="#0" class="material-pagination__link">&laquo;</a></li>
                    <li><a href="#0" class="material-pagination__link">1</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_active">2</a></li>
                    <li><a href="#0" class="material-pagination__link">3</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_disabled">4</a></li>
                    <li><a href="#0" class="material-pagination__link">5</a></li>
                    <li><a href="#0" class="material-pagination__link">&raquo;</a>

                </ul>
                

                <ul class="pagination material-pagination material-pagination_danger main-container__column">
                    <li><a href="#0" class="material-pagination__link">&laquo;</a></li>
                    <li><a href="#0" class="material-pagination__link">1</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_active">2</a></li>
                    <li><a href="#0" class="material-pagination__link">3</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_disabled">4</a></li>
                    <li><a href="#0" class="material-pagination__link">5</a></li>
                    <li><a href="#0" class="material-pagination__link">&raquo;</a>
                </ul>
                    

                <ul class="pagination material-pagination material-pagination_warning main-container__column">
                    <li><a href="#0" class="material-pagination__link">&laquo;</a></li>
                    <li><a href="#0" class="material-pagination__link">1</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_active">2</a></li>
                    <li><a href="#0" class="material-pagination__link">3</a></li>
                    <li><a href="#0" class="material-pagination__link material-pagination__link_disabled">4</a></li>
                    <li><a href="#0" class="material-pagination__link">5</a></li>
                    <li><a href="#0" class="material-pagination__link">&raquo;</a>
                </ul>
                                    
            </div>  
            
            <h3>Labels</h3>
            <div class="main-container__section">
                <span class="label label-default material-label main-container__column">Default</span>
                <span class="label label-primary material-label material-label_primary main-container__column">Primary</span>
                <span class="label label-success material-label material-label_success main-container__column">Success</span>
                <span class="label label-info material-label material-label_info main-container__column">Info</span>
                <span class="label label-warning material-label material-label_warning main-container__column">Warning</span>
                <span class="label label-danger material-label material-label_danger main-container__column">Danger</span>
            
            </div>      

            <h3>Labels sizing</h3>
            <div class="main-container__section">
                
                <span class="label label-primary material-label material-label_primary material-label_lg main-container__column">Primary</span>
                <span class="label label-success material-label material-label_success main-container__column">Success</span>
                <span class="label label-warning material-label material-label_warning material-label_sm main-container__column">Warning</span>
                <span class="label label-danger material-label material-label_danger material-label_xs main-container__column">Danger</span>    

                            
            
            </div>  
            
            <h3>Badges</h3>
            <div class="main-container__section">
                <span class="badge material-badge main-container__column">10</span>
                <span class="badge material-badge material-badge_primary main-container__column">10</span>
                <span class="badge material-badge material-badge_success main-container__column">9</span>
                <span class="badge material-badge material-badge_info main-container__column">8</span>
                <span class="badge material-badge material-badge_danger main-container__column">7</span>
                <span class="badge material-badge material-badge_warning main-container__column">6</span>
            </div>  
            
            <h3>Badges sizing</h3>  
            <div class="main-container__section">
                <span class="badge material-badge material-badge_success material-badge_lg main-container__column">10</span>
                <span class="badge material-badge material-badge_info main-container__column">8</span>
                <span class="badge material-badge material-badge_danger material-badge_sm main-container__column">5</span>
                <span class="badge material-badge material-badge_warning material-badge_xs main-container__column">10</span>    

                <span class="badge material-badge material-badge_success material-badge_lg main-container__column">999</span>
                <span class="badge material-badge material-badge_info main-container__column">999</span>
                <span class="badge material-badge material-badge_danger material-badge_sm main-container__column">999</span>
                <span class="badge material-badge material-badge_warning material-badge_xs main-container__column">999</span>   


                <span class="badge material-badge material-badge_success material-badge_lg main-container__column">9999</span>
                <span class="badge material-badge material-badge_info main-container__column">9999</span>
                <span class="badge material-badge material-badge_danger material-badge_sm main-container__column">9999</span>
                <span class="badge material-badge material-badge_warning material-badge_xs main-container__column">9999</span>  
                    
            </div>
            
            <h3>Cards</h3>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail material-card">
                        <header class="material-card__header">
                            <img src="http://via.placeholder.com/1024x640" class="material-card__img" alt="Thumbnail label"/>
                        </header>
                        <div class="material-card__content">
                            <h3 class="material-card__title">Thumbnail label</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, nihil, ullam itaque id dignissimos fugiat ducimus. Et, alias, magni, quia deserunt amet quod tempore ab ipsam veniam aliquid ducimus sapiente.</p>
                        </div>
                        <footer class="material-card__footer">
                            <a href="#0" class="btn material-btn material-btn_primary material-btn_sm material-card__showmore material-card__showmore_pos-right">Show more</a>
                            <a href="#0" class="btn material-btn material-btn_primary material-btn_sm material-card__showmore material-card__showmore_pos-right">Action two</a>
                        </footer>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail material-card">
                        <header class="material-card__header">
                            <img src="http://via.placeholder.com/1024x640" class="material-card__img" alt="Thumbnail label"/>
                        </header>
                        <div class="material-card__content">
                            <h3 class="material-card__title">Thumbnail label</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, nihil, ullam itaque id dignissimos fugiat ducimus. Et, alias, magni, quia deserunt amet quod tempore ab ipsam veniam aliquid ducimus sapiente.</p>
                        </div>
                        <footer class="material-card__footer">
                            <a href="#0" class="btn material-btn material-btn_sm material-card__showmore material-card__showmore_pos-left">Show more</a>
                            <a href="#0" class="btn material-btn material-btn_sm material-card__showmore material-card__showmore_pos-left">Action two</a>
                        </footer>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail material-card">
                        <header class="material-card__header">
                            <img src="http://via.placeholder.com/1024x640" class="material-card__img" alt="Thumbnail label"/>
                        </header>
                        <div class="material-card__content">
                            <h3 class="material-card__title">Thumbnail label</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, nihil, ullam itaque id dignissimos fugiat ducimus. Et, alias, magni, quia deserunt amet quod tempore ab ipsam veniam aliquid ducimus sapiente.</p>
                        </div>
                        <footer class="material-card__footer">
                            <a href="#0" class="btn material-btn material-btn_success material-card__showmore material-btn_sm">Show more</a>
                        </footer>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="thumbnail material-card">
                        <header class="material-card__header">
                            <img src="http://via.placeholder.com/1024x640" class="material-card__img" alt="Thumbnail label"/>
                        </header>
                        <div class="material-card__content">
                            <h3 class="material-card__title">Thumbnail label</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, nihil, ullam itaque id dignissimos fugiat ducimus. Et, alias, magni, quia deserunt amet quod tempore ab ipsam veniam aliquid ducimus sapiente.</p>
                        </div>
                        <footer class="material-card__footer">
                            <a href="#0" class="btn material-btn material-btn_warning material-card__showmore material-btn_sm material-card__showmore_pos-right">Show more</a>
                            <a href="#0" class="btn material-btn material-btn_warning material-card__showmore material-btn_sm material-card__showmore_pos-right">Action two</a>
                        </footer>
                    </div>
                </div>
            </div>
                    
                
            <h3>Alerts</h3>
            <div class="alert material-alert material-alert_primary">Primary.</div>
            <div class="alert material-alert material-alert_success">Well done! You successfully read this important alert message.</div>
            <div class="alert material-alert material-alert_info">Heads up! This alert needs your attention, but it's not super important.</div>
            <div class="alert material-alert material-alert_warning">Warning! Better check yourself, you're not looking too good.</div>
            <div class="alert material-alert material-alert_danger">
                Oh snap! Change a few things up and try submitting again.
                <button class="close material-alert__close">&times;</button>
            </div>
                    

            <h3>Progress bars</h3>
            <div class="progress material-progress">
                <div class="progress-bar material-progress__progress-bar" style="width: 5%">
                    <span class="sr-only">10% Complete (primary)</span>
                </div>
            </div>
            
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-primary material-progress__progress-bar material-progress__progress-bar_primary" style="width: 10%">
                    <span class="sr-only">10% Complete (primary)</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-success material-progress__progress-bar material-progress__progress-bar_success" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-info material-progress__progress-bar material-progress__progress-bar_info" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-warning material-progress__progress-bar material-progress__progress-bar_warning" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-danger progress-bar-striped active material-progress__progress-bar material-progress__progress-bar_danger" style="width: 80%">
                    <span class="sr-only">80% Complete (danger)</span>
                </div>
            </div>
            
            
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-striped active material-progress__progress-bar" style="width: 5%">
                    <span class="sr-only">10% Complete (primary)</span>
                </div>
            </div>
            
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-striped active progress-bar-primary material-progress__progress-bar material-progress__progress-bar_primary" style="width: 10%">
                    <span class="sr-only">10% Complete (primary)</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-striped active progress-bar-success material-progress__progress-bar material-progress__progress-bar_success" style="width: 40%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-striped active progress-bar-info material-progress__progress-bar material-progress__progress-bar_info" style="width: 20%">
                    <span class="sr-only">20% Complete</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-striped active progress-bar-warning material-progress__progress-bar material-progress__progress-bar_warning" style="width: 60%">
                    <span class="sr-only">60% Complete (warning)</span>
                </div>
            </div>
            <div class="progress material-progress">
                <div class="progress-bar progress-bar-striped active progress-bar-danger progress-bar-striped active material-progress__progress-bar material-progress__progress-bar_danger" style="width: 80%">
                    <span class="sr-only">80% Complete (danger)</span>
                </div>
            </div>  
                        
                
            <h3>Media alignment</h3>
            <div class="media material-media">
                <div class="media-left">
                    <a href="#0"><img class="media-object material-media__object"  alt="avatar" src="http://via.placeholder.com/300x300"/></a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading material-media__title">Title media</h4>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>
            </div>

            <div class="media material-media">
                <div class="media-left material-media__column material-media__column_vertical-middle">
                    <a href="#0"><img class="media-object material-media__object material-media__object_lg"  alt="avatar" src="http://via.placeholder.com/300x300"/></a>
                </div>
                <div class="media-body material-media__column material-media__column_vertical-middle">
                    <h4 class="media-heading material-media__title">Title media</h4>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>
            </div>

            <div class="media material-media">
                <div class="media-left">
                    <a href="#0"><img class="media-object material-media__object material-media__object_sm"  alt="avatar" src="http://via.placeholder.com/300x300"/></a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading material-media__title">Title media</h4>
                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                </div>
            </div>
                    
                        
                    <h3 class="page-header">List group</h3>
                    <ul class="list-group material-list-group">
                <li class="list-group-item material-list-group__item">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_no-bg material-badge material-badge_no-bg_warning material-badge material-badge_no-bg_sm material-list-group__badge">14</span>
                </li>
                <li class="list-group-item material-list-group__item material-list-group__item_disabled">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_no-bg material-badge material-badge_no-bg_warning material-badge material-badge_no-bg_sm material-list-group__badge">5</span>
                </li>
            </ul>
                    
            <ul class="list-group material-list-group material-list-group_primary">
                <li class="list-group-item material-list-group__item">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">14</span>
                </li>
                <li class="list-group-item material-list-group__item material-list-group__item_disabled">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">5</span>
                </li>
            </ul>
                    
            <ul class="list-group material-list-group material-list-group_success">
                <li class="list-group-item material-list-group__item">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">14</span>
                </li>
                <li class="list-group-item material-list-group__item material-list-group__item_disabled">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">5</span>
                </li>
            </ul>   
                
            <ul class="list-group material-list-group material-list-group_info">
                <li class="list-group-item material-list-group__item">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">14</span>
                </li>
                <li class="list-group-item material-list-group__item material-list-group__item_disabled">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">5</span>
                </li>
            </ul>
                
            <ul class="list-group material-list-group material-list-group_danger">
                <li class="list-group-item material-list-group__item">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">14</span>
                </li>
                <li class="list-group-item material-list-group__item material-list-group__item_disabled">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">5</span>
                </li>
            </ul>

            <ul class="list-group material-list-group material-list-group_warning">
                <li class="list-group-item material-list-group__item">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">14</span>
                </li>
                <li class="list-group-item material-list-group__item material-list-group__item_disabled">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, molestias exercitationem iusto. 
                    <span class="badge material-badge material-badge_primary material-badge_no-bg material-badge material-badge_no-bg_sm material-list-group__badge">5</span>
                </li>
            </ul>
            
                
            <h3 class="page-header">Panels</h3>
            <div class="panel panel-default material-panel">
                <h5 class="panel-heading material-panel__heading">Panel heading without title</h5>
                <div class="panel-body material-panel__body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, minus, nulla exercitationem quos suscipit sunt veritatis alias laboriosam dicta dolor!</p>
                </div>
            </div>
                    
            <div class="panel panel-default material-panel material-panel_primary">
                <h5 class="panel-heading material-panel__heading">Panel heading without title</h5>
                <div class="panel-body material-panel__body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, minus, nulla exercitationem quos suscipit sunt veritatis alias laboriosam dicta dolor!</p>
                </div>  </div>
                
            <div class="panel panel-default material-panel material-panel_success">
                <h5 class="panel-heading material-panel__heading">Panel heading without title</h5>
                <div class="panel-body material-panel__body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, minus, nulla exercitationem quos suscipit sunt veritatis alias laboriosam dicta dolor!</p>
                </div>  </div>
                
            <div class="panel panel-default material-panel material-panel_warning">
                <h5 class="panel-heading material-panel__heading">Panel heading without title</h5>
                <div class="panel-body material-panel__body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, minus, nulla exercitationem quos suscipit sunt veritatis alias laboriosam dicta dolor!</p>
                </div>  </div>
                
            <div class="panel panel-default material-panel material-panel_info">
                <h5 class="panel-heading material-panel__heading">Panel heading without title</h5>
                <div class="panel-body material-panel__body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, minus, nulla exercitationem quos suscipit sunt veritatis alias laboriosam dicta dolor!</p>
                </div>  </div>
                
            <div class="panel panel-default material-panel material-panel_danger">
                <h5 class="panel-heading material-panel__heading">Panel heading without title</h5>
                <div class="panel-body material-panel__body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, minus, nulla exercitationem quos suscipit sunt veritatis alias laboriosam dicta dolor!</p>
                </div>
            </div>
            
        
            
            <h3 class="page-header">Modal</h3>
            <button class="btn material-btn" data-toggle="modal" data-target="#myModal">Launch demo modal</button>
            <button class="btn material-btn material-btn_primary" data-toggle="modal" data-target="#myModal_primary">Launch demo modal</button>
            <button class="btn material-btn material-btn_success" data-toggle="modal" data-target="#myModal_success">Launch demo modal</button>     
            <button class="btn material-btn material-btn_info" data-toggle="modal" data-target="#myModal_info">Launch demo modal</button>       
            <button class="btn material-btn material-btn_danger" data-toggle="modal" data-target="#myModal_danger">Launch demo modal</button>       
            <button class="btn material-btn material-btn_warning" data-toggle="modal" data-target="#myModal_warning">Launch demo modal</button>

            <h3 class="page-header">Navbar</h3>
            <nav class="navbar material-navbar">
                <div class="container-fluid">
                    <div class="navbar-header material-navbar__header">
                        <button class="navbar-toggle materail-navbar__toogle collapsed" data-toggle="collapse" data-target="#navbar-menu">
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                        </button>
                        <a class="navbar-brand material-navbar__brand" href="#0">Brand</a>
                    </div>
                    <div class="collapse navbar-collapse materil-navbar__collapse" id="navbar-menu">
                        <ul class="nav navbar-nav navbar-right material-navbar__nav">
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                        </ul>       
                    </div>
                </div>
            </nav>
            
            <nav class="navbar material-navbar material-navbar_primary">
                <div class="container-fluid">
                    <div class="navbar-header material-navbar__header">
                        <button class="navbar-toggle materail-navbar__toogle collapsed" data-toggle="collapse" data-target="#navbar-navbar_primary">
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                        </button>
                        <a class="navbar-brand material-navbar__brand" href="#0">Brand</a>
                    </div>
                    <div class="collapse navbar-collapse materil-navbar__collapse" id="navbar-navbar_primary">
                        <ul class="nav navbar-nav navbar-right material-navbar__nav">
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                        </ul>       
                    </div>
                </div>
            </nav>
                    
            <nav class="navbar material-navbar material-navbar_success">
                <div class="container-fluid">
                    <div class="navbar-header material-navbar__header">
                        <button class="navbar-toggle materail-navbar__toogle collapsed" data-toggle="collapse" data-target="#navbar-navbar_success">
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                        </button>
                        <a class="navbar-brand material-navbar__brand" href="#0">Brand</a>
                    </div>
                    <div class="collapse navbar-collapse materil-navbar__collapse" id="navbar-navbar_success">
                        <ul class="nav navbar-nav navbar-right material-navbar__nav">
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                        </ul>       
                    </div>
                </div>
            </nav>
                    
            <nav class="navbar material-navbar material-navbar_info">
                <div class="container-fluid">
                    <div class="navbar-header material-navbar__header">
                        <button class="navbar-toggle materail-navbar__toogle collapsed" data-toggle="collapse" data-target="#navbar-navbar_info">
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                        </button>
                        <a class="navbar-brand material-navbar__brand" href="#0">Brand</a>
                    </div>
                    <div class="collapse navbar-collapse materil-navbar__collapse" id="navbar-navbar_info">
                        <ul class="nav navbar-nav navbar-right material-navbar__nav">
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                        </ul>       
                    </div>
                </div>
            </nav>
                    
            <nav class="navbar material-navbar material-navbar_danger">
                <div class="container-fluid">
                    <div class="navbar-header material-navbar__header">
                        <button class="navbar-toggle materail-navbar__toogle collapsed" data-toggle="collapse" data-target="#navbar-navbar_danger">
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                        </button>
                        <a class="navbar-brand material-navbar__brand" href="#0">Brand</a>
                    </div>
                    <div class="collapse navbar-collapse materil-navbar__collapse" id="navbar-navbar_danger">
                        <ul class="nav navbar-nav navbar-right material-navbar__nav">
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                        </ul>       
                    </div>
                </div>
            </nav>
                    
            <nav class="navbar material-navbar material-navbar_warning">
                <div class="container-fluid">
                    <div class="navbar-header material-navbar__header">
                        <button class="navbar-toggle materail-navbar__toogle collapsed" data-toggle="collapse" data-target="#navbar-navbar_warning">
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                            <span class="icon-bar materail-navbar__icon-bar"></span>
                        </button>
                        <a class="navbar-brand material-navbar__brand" href="#0">Brand</a>
                    </div>
                    <div class="collapse navbar-collapse materil-navbar__collapse" id="navbar-navbar_warning">
                        <ul class="nav navbar-nav navbar-right material-navbar__nav">
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                            <li><a href="#0" class="material-navbar__link">Link</a></li>
                        </ul>       
                    </div>
                </div>
            </nav>
        </div>
        <div class="modal material-modal fade" id="myModal">
        <div class="modal-dialog ">
          <div class="modal-content material-modal__content">
              <div class="modal-header material-modal__header">
                  <button class="close material-modal__close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title material-modal__title">Modal title</h4>
              </div>
              <div class="modal-body material-modal__body">
                  <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, excepturi sapiente numquam
              voluptatum dicta eum ex nobis asperiores distinctio saepe.
            </p>
              </div>
              <div class="modal-footer material-modal__footer">
                  <button class="btn material-btn material-btn" data-dismiss="modal">Close</button>
                <button class="btn btn-primary material-btn material-btn_primary">Save changes</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal material-modal material-modal_primary fade" id="myModal_primary">
      <div class="modal-dialog ">
          <div class="modal-content material-modal__content">
              <div class="modal-header material-modal__header">
                  <button class="close material-modal__close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title material-modal__title">Modal title</h4>
              </div>
              <div class="modal-body material-modal__body">
                  <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, excepturi sapiente numquam
              voluptatum dicta eum ex nobis asperiores distinctio saepe.
            </p>
              </div>
              <div class="modal-footer material-modal__footer">
                  <button class="btn material-btn material-btn" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary material-btn material-btn_primary">Save changes</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal material-modal material-modal_success fade" id="myModal_success">
      <div class="modal-dialog ">
          <div class="modal-content material-modal__content">
              <div class="modal-header material-modal__header">
                  <button class="close material-modal__close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title material-modal__title">Modal title</h4>
              </div>
              <div class="modal-body material-modal__body">
                  <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, excepturi sapiente numquam
              voluptatum dicta eum ex nobis asperiores distinctio saepe.
            </p>
              </div>
              <div class="modal-footer material-modal__footer">
                  <button class="btn material-btn material-btn" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary material-btn material-btn_primary">Save changes</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal material-modal material-modal_info fade" id="myModal_info">
      <div class="modal-dialog ">
          <div class="modal-content material-modal__content">
              <div class="modal-header material-modal__header">
                  <button class="close material-modal__close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title material-modal__title">Modal title</h4>
              </div>
              <div class="modal-body material-modal__body">
                  <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, excepturi sapiente numquam
              voluptatum dicta eum ex nobis asperiores distinctio saepe.
            </p>
              </div>
              <div class="modal-footer material-modal__footer">
                  <button class="btn material-btn material-btn" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary material-btn material-btn_primary">Save changes</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal material-modal material-modal_danger fade" id="myModal_danger">
      <div class="modal-dialog ">
          <div class="modal-content material-modal__content">
              <div class="modal-header material-modal__header">
                  <button class="close material-modal__close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title material-modal__title">Modal title</h4>
              </div>
              <div class="modal-body material-modal__body">
                  <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, excepturi sapiente numquam
              voluptatum dicta eum ex nobis asperiores distinctio saepe.
            </p>
              </div>
              <div class="modal-footer material-modal__footer">
                  <button class="btn material-btn material-btn" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary material-btn material-btn_primary">Save changes</button>
              </div>
          </div>
      </div>
    </div>
    <div class="modal material-modal material-modal_warning fade" id="myModal_warning">
      <div class="modal-dialog ">
          <div class="modal-content material-modal__content">
              <div class="modal-header material-modal__header">
                  <button class="close material-modal__close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title material-modal__title">Modal title</h4>
              </div>
              <div class="modal-body material-modal__body">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur, excepturi sapiente numquam
              voluptatum dicta eum ex nobis asperiores distinctio saepe.
            </p>
              </div>
              <div class="modal-footer material-modal__footer">
                  <button class="btn material-btn material-btn" data-dismiss="modal">Close</button>
                  <button class="btn btn-primary material-btn material-btn_primary">Save changes</button>
              </div>
          </div>
      </div>
    </div>
    <footer class="footer">
        <div class="main-container footer__container">
          <div class="footer__column">
            <span>You liked?</span>
            <a href="https://www.paypal.me/melnik909" class="donateme" rel="noopener noreferrer" target="_blank">Buy me a tea?</a>
          </div>
          <a href="http://stas-melnikov.ru" class="melnik909" rel="noopener noreferrer" target="_blank">Developed by Stas Melnikov</a>
        </div>
      </footer>
  <hr>

  <div class="main-container__section">
    <label class="main-container__column material-radio-group material-radio-group_info" for="radio4111">
        <input type="radio" name="radiobox111" id="radio4111" class="material-radiobox"/>
        <span class="material-radio-group__element material-radio-group__check-radio"></span>
        <span class="material-radio-group__element material-radio-group__caption">Info</span>
    </label>
    <label class="main-container__column material-radio-group material-radio-group_info" for="radio4222">
        <input type="radio" name="radiobox111" id="radio4222" class="material-radiobox"/>
        <span class="material-radio-group__element material-radio-group__check-radio"></span>
        <span class="material-radio-group__element material-radio-group__caption">Info</span>
    </label>
  </div>

</body>
</html>
