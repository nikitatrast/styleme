!function(e){var r={};function t(n){if(r[n])return r[n].exports;var a=r[n]={i:n,l:!1,exports:{}};return e[n].call(a.exports,a,a.exports,t),a.l=!0,a.exports}t.m=e,t.c=r,t.d=function(e,r,n){t.o(e,r)||Object.defineProperty(e,r,{enumerable:!0,get:n})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,r){if(1&r&&(e=t(e)),8&r)return e;if(4&r&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(t.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&r&&"string"!=typeof e)for(var a in e)t.d(n,a,function(r){return e[r]}.bind(null,a));return n},t.n=function(e){var r=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(r,"a",r),r},t.o=function(e,r){return Object.prototype.hasOwnProperty.call(e,r)},t.p="dist/js/",t(t.s=26)}({11:function(e,r,t){"use strict";if(t.r(r),t.d(r,"showAlert",(function(){return a})),t.d(r,"dismissAlert",(function(){return i})),document.getElementById("alert")){var n=document.getElementById("alert-close-btn");n&&n.addEventListener("click",i)}function a(e,r){var t=document.getElementById("alert");t&&t.parentNode.removeChild(t);var n=document.createElement("div");n.classList.add("alert"),"error"===e?n.classList.add("alert-error"):"success"===e&&n.classList.add("alert-success"),n.id="alert";var a=document.createElement("p");a.classList.add("alert-message"),a.textContent=r;var s=document.createElement("button");s.classList.add("alert-close"),s.id="alert-close-btn";var d=document.createElement("img");d.src="/img/icons/close.svg",d.alt="close",s.appendChild(d),n.appendChild(a),n.appendChild(s),document.body.prepend(n),s.addEventListener("click",i)}function i(){document.getElementById("alert").style.display="none"}},26:function(e,r,t){t(11).showAlert;var n=document.getElementById("sign-up-btn"),a=document.getElementById("given-name"),i=document.getElementById("family-name"),s=document.getElementById("username"),d=document.getElementById("email"),o=document.getElementById("password"),u=document.getElementById("confirm-password"),l=!1,m=!1,c=!1,p=!1,g=!1,f=!1,h=!1,v=!1,L=!1,y=!1,E=document.getElementById("sign-up-given-name"),w=document.getElementById("sign-up-family-name"),b=document.getElementById("sign-up-username"),x=document.getElementById("sign-up-email"),B=document.getElementById("sign-up-password"),I=document.getElementById("sign-up-confirm-password"),q=!1;document.getElementById("sign-up-form");function V(){l&&c&&g&&h&&L&&m&&p&&f&&v&&y&&q?n.removeAttribute("disabled"):n.setAttribute("disabled",!0)}function C(e){var r=null,t=_(e.target.value,{required:!0,maxLength:128});m=t.isValid,t.isValid?"blur"!=e.type&&A("input-error-given-name",E):t.errors.required?(A("input-error-given-name",E),r=N(t.errors.required,"givenName")):t.errors.maxLength&&(A("input-error-given-name",E),r=N(t.errors.maxLength,"givenName")),null!=r&&E.appendChild(r),V()}function P(e){var r=null,t=_(e.target.value,{required:!1,maxLength:128});t.isValid,t.isValid?"blur"!=e.type&&A("input-error-family-name",w):t.errors.maxLength&&(A("input-error-family-name",w),r=N(t.errors.maxLength,"familyName")),null!=r&&w.appendChild(r),V()}function j(e){var r=null,t=_(e.target.value,{required:!0,maxLength:512});p=t.isValid,t.isValid?"blur"!=e.type&&A("input-error-username",b):t.errors.required?(A("input-error-username",b),r=N(t.errors.required,"username")):t.errors.maxLength&&(A("input-error-username",b),r=N(t.errors.maxLength,"username")),null!=r&&b.appendChild(r),V()}function k(e){var r=null,t=_(e.target.value,{required:!0,maxLength:512,email:!0});f=t.isValid,t.isValid?"blur"!=e.type&&A("input-error-email",x):t.errors.required?(A("input-error-email",x),r=N(t.errors.required,"email")):t.errors.maxLength?(A("input-error-email",x),r=N(t.errors.maxLength,"email")):t.errors.email&&(A("input-error-email",x),r=N(t.errors.email,"email")),null!=r&&x.appendChild(r),V()}function z(e){var r=null,t=_(e.target.value,{required:!0,minLength:6,maxLength:512,match:u});v=t.isValid,t.isValid?(q=!0,"blur"!==e.type&&A("input-error-password",B)):t.errors.required?document.getElementById("password-required")||(A("input-error-password",B),r=N(t.errors.required,"password","password-required")):t.errors.minLength?document.getElementById("password-minlength")||(A("input-error-password",B),r=N(t.errors.minLength,"password","password-minlength")):t.errors.maxLength?document.getElementById("password-maxlength")||(A("input-error-password",B),r=N(t.errors.maxLength,"password","password-maxlength")):t.errors.match&&(document.getElementById("password-match")||(A("input-error-password",B),r=N(t.errors.match,"password","password-match"),q=!1)),null!=r&&B.appendChild(r),V(),q&&_(u.value,{required:!0,minLength:6,maxLength:512}).isValid&&(y=!0,document.getElementById("confirm-password-match")&&A("input-error-confirm-password",I))}function O(e){var r=null,t=_(e.target.value,{required:!0,minLength:6,maxLength:512,match:o});y=t.isValid,t.isValid?(q=!0,"blur"!==e.type&&A("input-error-confirm-password",I)):t.errors.required?document.getElementById("confirm-password-required")||(A("input-error-confirm-password",I),r=N(t.errors.required,"confirmPassword","confirm-password-required")):t.errors.minLength?document.getElementById("confirm-password-minlength")||(A("input-error-confirm-password",I),r=N(t.errors.minLength,"confirmPassword","confirm-password-minlength")):t.errors.maxLength?document.getElementById("confirm-password-maxlength")||(A("input-error-confirm-password",I),r=N(t.errors.maxLength,"confirmPassword","confirm-password-maxlength")):t.errors.match&&(document.getElementById("confirm-password-match")||(q=!1,A("input-error-confirm-password",I),r=N(t.errors.match,"confirmPassword","confirm-password-match"))),null!=r&&I.appendChild(r),q&&_(o.value,{required:!0,minLength:6,maxLength:512}).isValid&&(v=!0,document.getElementById("password-match")&&A("input-error-password",B)),V()}function _(e,r){var t=r.required,n=r.minLength,a=r.maxLength,i=r.match,s=r.email,d={},o=!0;if(t&&e.trim().length<1)return o=!1,d.required="This field is required",{isValid:o,errors:d};if(n){if(e.trim().length<n)return o=!1,d.minLength="At least ".concat(n," characters are required for this field"),{isValid:o,errors:d};o=!0}if(a){if(e.length>a)return o=!1,d.maxLength="Up to ".concat(a," characters are allowed for this field"),{isValid:o,errors:d};o=!0}if(i){if(e!==i.value)return o=!1,d.match="Passwords do not match",{isValid:o,errors:d};o=!0}return s&&!/[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/.test(e)?(o=!1,d.email="Invalid email format",{isValid:o,errors:d}):{isValid:o,errors:d}}function N(e,r,t){var n=document.createElement("p");switch(n.classList.add("input-error"),r){case"givenName":n.classList.add("input-error-given-name");break;case"familyName":n.classList.add("input-error-family-name");break;case"username":n.classList.add("input-error-username");break;case"email":n.classList.add("input-error-email");break;case"password":n.classList.add("input-error-password");break;case"confirmPassword":n.classList.add("input-error-confirm-password");break;default:return}return t&&(n.id=t),n.textContent=e,n}function A(e,r){for(var t=r.getElementsByClassName(e),n=0;n<t.length;n++)r.removeChild(t[n])}document.addEventListener("DOMContentLoaded",(function(){a.addEventListener("focus",(function(){l||(l=!0)})),a.addEventListener("input",C),a.addEventListener("blur",C),i.addEventListener("input",P),i.addEventListener("blur",P),s.addEventListener("focus",(function(){c||(c=!0)})),s.addEventListener("input",j),s.addEventListener("blur",j),d.addEventListener("focus",(function(){g||(g=!0)})),d.addEventListener("input",k),d.addEventListener("blur",k),o.addEventListener("focus",(function(){h||(h=!0)})),o.addEventListener("input",z),o.addEventListener("blur",z),u.addEventListener("focus",(function(){L||(L=!0)})),u.addEventListener("input",O),u.addEventListener("blur",O),V()}))}});