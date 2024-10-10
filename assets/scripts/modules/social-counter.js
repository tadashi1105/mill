// ソーシャルボタンカウントの非同期取得

const SocialCounter = (($) => {

  const NAME                = 'socialCounter';
  const VERSION             = '1.0.0';
  const DATA_KEY            = 'mill.socialCounter';
  const EVENT_KEY           = `.${DATA_KEY}`;
  const DATA_API_KEY        = '.data-api';
  const JQUERY_NO_CONFLICT  = $.fn[NAME];


  class SocialCounter {

    constructor(element, socialName, settings, callback) {
      this._element    = element;
      this._settings   = settings;
      this._socialName = socialName;
      this._callback   = this._defaultCallback;
      let methodName = `fetch_${this._socialName}_count`;

      if (typeof callback === 'function') {
        this._callback = callback;
      }

      if (this[methodName] === undefined) {
        throw new Error(`No method named "${methodName}"`)
      }

      this[methodName]();
    }


    // getters

    static get VERSION() {
      return VERSION;
    }


    // private

    _defaultCallback(data, self) {
      if (self._socialName === 'facebook') {
        data = data.shares || 0;
      } else if (self._socialName === 'twitter') {
        data = data.count || 0;
      }

      if (data >= 0) {
        self._element.text(data);
      } else if (data === 'fail'){
        self._element.text('!');
      }
    }

    _ajaxSettings(settings) {
      return $.extend(
        {},
        settings,
        this._settings
      );
    }

    _ajax(settings) {
      $.ajax(settings)
      .done((res) => {
        // console.log(res, this._socialName);
        this._callback(res || 0, this);
      })
      .fail(() => {
        // console.log('fail', this._socialName);
        this._callback('fail', this);
      });
    }


    // public

    // Twitterのシェア数を取得
    fetch_twitter_count() {
      const Default = {
        url : '//urls.api.twitter.com/1/urls/count.json',
        dataType : 'jsonp',
        timeout : 10000, // 10sec
        data : {
          url : location.href
        }
      };

      this._ajax(this._ajaxSettings(Default));
    }

    //Facebookのシェア数を取得
    fetch_facebook_count() {
      const Default = {
        url : 'https://graph.facebook.com/',
        dataType: 'jsonp',
        timeout : 10000, // 10sec
        data : {
          id : location.href
        }
      };

      this._ajax(this._ajaxSettings(Default));
    }

    //Google＋のシェア数を取得
    fetch_google_plus_count() {
      const Default = {
        url : '',
        dataType :'text',
        timeout : 10000, // 10sec
        data : {
          url : location.href
        }
      };

      this._ajax(this._ajaxSettings(Default));
    }

    //はてなブックマークではてブ数を取得
    fetch_hatebu_count() {
      const Default = {
        url : '//api.b.st-hatena.com/entry.count?callback=?',
        dataType : 'jsonp',
        timeout : 10000, // 10sec
        data : {
          url : location.href
        }
      };

      this._ajax(this._ajaxSettings(Default));
    }

    //ポケットのストック数を取得
    fetch_pocket_count() {
      const Default = {
        url : '',
        dataType : 'text',
        timeout : 10000, // 10sec
        data : {
          url : location.href
        }
      };

      this._ajax(this._ajaxSettings(Default));
    }

    //feedlyの購読者数を取得
    fetch_feedly_count() {
      const Default = {
        url : '',
        dataType :'text',
        timeout : 10000, // 10sec
        data : {
          url : location.protocol + '//' + location.hostname + '/' + 'feed'
        }
      };

      this._ajax(this._ajaxSettings(Default));
    }


    // static

    static _jQueryInterface(socialName, settings, callback) {
      return this.each(() => {
        let $this = $(this);
        let data = $this.data(DATA_KEY);

        if (typeof socialName !== 'string') {
          throw new Error(`No string "${socialName}"`);
        }

        if (typeof settings !== 'object') {
          throw new Error(`No object "${settings}"`);
        }

        // if (typeof callback !== 'function') {
        //   console.warn(`No callback function "${callback}"`);
        // }

        if (!data) {
          data = new SocialCounter(this, socialName, settings, callback);
          $this.data(DATA_KEY, data);
        }
      });
    }

  }


  /**
   * ------------------------------------------------------------------------
   * jQuery
   * ------------------------------------------------------------------------
   */

  $.fn[NAME]             = SocialCounter._jQueryInterface;
  $.fn[NAME].Constructor = SocialCounter;
  $.fn[NAME].noConflict  = () => {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return SocialCounter._jQueryInterface;
  };

  return SocialCounter;

})(jQuery);

export default SocialCounter;
