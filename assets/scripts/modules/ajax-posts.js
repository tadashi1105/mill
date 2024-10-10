const AjaxPosts = (($) => {

  const NAME                = 'ajaxPosts';
  const VERSION             = '1.0.0';
  const DATA_KEY            = 'mill.ajaxPosts';
  const EVENT_KEY           = `.${DATA_KEY}`;
  const DATA_API_KEY        = '.data-api';
  const JQUERY_NO_CONFLICT  = $.fn[NAME];


  class AjaxPosts {

    constructor(element, settings, callback) {
      this._element    = element;
      this._settings   = settings;
      this._callback   = this._defaultCallback;

      if (typeof callback === 'function') {
        this._callback = callback;
      }

      this.fetchPosts();
    }


    // getters

    static get VERSION() {
      return VERSION;
    }


    // private

    _defaultCallback(data, self) {
      if (data >= 0) {
        self._element.html(data);
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

    // fetchPosts
    fetchPosts() {
      const Default = {
        url : '',
        timeout : 10000, // 10sec
        data : {
          tab : '',
          number : 6
        }
      };

      this._ajax(this._ajaxSettings(Default));
    }


    // static

    static _jQueryInterface(settings, callback) {
      return this.each(() => {
        let $this = $(this);
        let data = $this.data(DATA_KEY);

        if (typeof settings !== 'object') {
          throw new Error(`No object "${settings}"`);
        }

        if (!data) {
          data = new AjaxPosts(this, settings, callback);
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

  $.fn[NAME]             = AjaxPosts._jQueryInterface;
  $.fn[NAME].Constructor = AjaxPosts;
  $.fn[NAME].noConflict  = () => {
    $.fn[NAME] = JQUERY_NO_CONFLICT;
    return AjaxPosts._jQueryInterface;
  };

  return AjaxPosts;

})(jQuery);

export default AjaxPosts;
