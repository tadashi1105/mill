/* eslint strict: [2, "global"] */
// 'use strict';
// const jQuery = require('jquery');

import 'modal';
// import 'drawer';
import 'tab';

// import 'social-counter';
// import 'ajax-posts';

(function ($) {

	// $('.dropdown-toggle').dropdown();
	// $('[data-toggle="tooltip"]').tooltip();
	$('.drawer').drawer();

	$('#js-modal-search').on('shown.bs.modal', function () {
		setTimeout(function (){
			$('#js-modal-search').find('.search-field').focus();
		}, 100);
	});

	// if (typeof MillWidgetTabConfig !== 'undefined') {
	//   $('.mill_widget_tab').find('[data-toggle="tab"]').on('shown.bs.tab', (e) => {
	//
	//     console.log(e);
	//     let href = $(e.target).attr('href');
	//     $(href).ajaxPosts(
	//       {
	//         url : MillWidgetTabConfig.AJAX_URL,
	//         data : {
	//           action : MillWidgetTabConfig.ACTION,
	//           tab : MillWidgetTabConfig.TAB,
	//         }
	//       },
	//       (data, self) => {
	//         if (data) {
	//           self._element.html(data);
	//         } else if (data == 0 || data === 'fail'){
	//           self._element.text('!');
	//         } else {
	//           self._element.text('!');
	//         }
	//       }
	//     );
	//   });
	//   // $('a[href="#home"]').tab('show');
	// }

	// if (typeof MillSocialCounterConfig !== 'undefined') {
	// console.log(MillSocialCounterConfig);
	// console.log(SocialCounter);
	// MillSocialCounterConfig.PERMALINK = 'http://millkeyweb.com/wp-functions-management/';
	// MillSocialCounterConfig.RSS2_URL = 'http://millkeyweb.com/feed';
	// console.log(MillSocialCounterConfig);

	// Twitterカウントの取得
	// $('.site-js-twitter-count').socialCounter(
	//   'twitter',
	//   {
	//     data : {
	//       url : MillSocialCounterConfig.PERMALINK
	//     }
	//   },
	//   (data, self) => {
	//     data = data.count || 0;
	//     if (data > 0) {
	//       self._element.text(data);
	//     } else if (data == 0){
	//       self._element.text('ツイート');
	//     } else if (data === 'fail'){
	//       self._element.text('ツイート');
	//       self._element.html('<span class="fa fa-exclamation"></span>');
	//     }
	//   }
	// );

	// Facebookカウントの取得
	// $('.site-js-facebook-count').socialCounter(
	//   'facebook',
	//   {
	//     data : {
	//       id : MillSocialCounterConfig.PERMALINK
	//     }
	//   },
	//   (data, self) => {
	//     data = data.shares || 0;
	//     if (data > 0) {
	//       self._element.text(data);
	//     } else if (data == 0){
	//       self._element.text('シェア');
	//     } else if (data === 'fail'){
	//       self._element.text('シェア');
	//       // self._element.html('<span class="fa fa-exclamation"></span>');
	//     } else {
	//       self._element.text('シェア');
	//     }
	//   }
	// );

	// はてブカウントの取得
	// $('.site-js-hatena-count').socialCounter(
	//   'hatebu',
	//   {
	//     data : {
	//       url : MillSocialCounterConfig.PERMALINK
	//     }
	//   },
	//   (data, self) => {
	//     if (data > 0) {
	//       self._element.text(data);
	//     } else if (data == 0){
	//       self._element.text('はてブ');
	//     } else if (data === 'fail'){
	//       self._element.text('はてブ');
	//       // self._element.html('<span class="fa fa-exclamation"></span>');
	//     } else {
	//       self._element.text('はてブ');
	//     }
	//   }
	// );

	// Google＋カウントの取得
	// $('.site-js-google-plus-count').socialCounter(
	//   'google_plus',
	//   {
	//     url : MillSocialCounterConfig.AJAX_URL,
	//     data : {
	//       action : 'fetch_google_plus_count',
	//       url : MillSocialCounterConfig.PERMALINK
	//     }
	//   },
	//   (data, self) => {
	//     if (data > 0) {
	//       self._element.text(data);
	//     } else if (data == 0){
	//       self._element.text('シェア');
	//     } else if (data === 'fail'){
	//       self._element.text('シェア');
	//       // self._element.html('<span class="fa fa-exclamation"></span>');
	//     } else {
	//       self._element.text('シェア');
	//     }
	//   }
	// );

	// Pocketカウントの取得
	// $('.site-js-pocket-count').socialCounter(
	//   'pocket',
	//   {
	//     url : MillSocialCounterConfig.AJAX_URL,
	//     data : {
	//       action : 'fetch_pocket_count',
	//       url : MillSocialCounterConfig.PERMALINK
	//     }
	//   },
	//   (data, self) => {
	//     if (data > 0) {
	//       self._element.text(data);
	//     } else if (data == 0){
	//       self._element.text('あとで');
	//     } else if (data === 'fail'){
	//       self._element.text('あとで');
	//       // self._element.html('<span class="fa fa-exclamation"></span>');
	//     } else {
	//       self._element.text('あとで');
	//     }
	//   }
	// );

	// feedlyカウントの取得
	// $('.site-js-feedly-count').socialCounter(
	//   'feedly',
	//   {
	//     url : MillSocialCounterConfig.AJAX_URL,
	//     data : {
	//       action : 'fetch_feedly_count',
	//       url : MillSocialCounterConfig.RSS2_URL
	//     }
	//   },
	//   (data, self) => {
	//     if (data > 0) {
	//       self._element.text(data);
	//     } else if (data == 0){
	//       self._element.text('購読');
	//     } else if (data === 'fail'){
	//       self._element.text('購読');
	//       // self._element.html('<span class="fa fa-exclamation"></span>');
	//     } else {
	//       self._element.text('購読');
	//     }
	//   }
	// );
	// }
})(jQuery);
