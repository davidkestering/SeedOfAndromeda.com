/**
 * jQuery.browser.mobile (http://detectmobilebrowser.com/)
 *
 * jQuery.browser.mobile will be true if the browser is a mobile device
 *
 **/
(function (a) {
    (jQuery.browser = jQuery.browser || {}).mobile = /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
})(navigator.userAgent || navigator.vendor || window.opera);

function clear_textbox(textbox_id, textbox_value) {
    var text = $("#" + textbox_id);
    if (text.val() == textbox_value) {
        text.val("");
    }
}

function restore_textbox(textbox_id, textbox_value) {
    var text = $("#" + textbox_id);
    if (text.val() === "") {
        text.val(textbox_value);
    }
}

function confirmAction(message) {
    var ask = confirm(message);
    if (ask == true) {
        return true;
    }
    return false;
}

//Get URL parameters
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

// User Name Shortener
$(document).ready(function () {
    if ($('#account-bar .account-name').text().length > 16) {
        var name = $('#account-bar .account-name').text()
                .substring(0, 12)
                + "...";
        $('#account-bar .account-name').text(name);
    }
});

// Close FullScreen Objects (Using Cover)
$(document).ready(function () {

    $('.close').click(function () {
        popdown();
    });
    $('.cover').click(function (e) {
        if (($(e.target).parents('.cover').length) * (-1)) {
            return;
        }
        popdown();
    });
    function popdown() {
        $('.cover').fadeOut();
    }

});

// This or similar could be used in the future to load pages on the fly
function LoadPage(pageName) {
    $.get('/' + pageName + '?notemplate=true', function (data) {
        $('#content-outer').html(data);
    });
}

//---------------------\\
// Media Slider Script \\
//---------------------\\

//Hide JavaScript warning.
$(document).ready(function () {
    $('.media-slider-js-warning').hide();
});

function MediaSlider(elements, sliderFrame, slideShowPauseDelay, slideShowDelay, animationDur) {
    var slideShowDelay = typeof slideShowDelay !== 'undefined' ? slideShowDelay : 6000;
    var slideShowPauseDelay = typeof slideShowPauseDelay !== 'undefined' ? slideShowPauseDelay : 7000;
    var animationDur = typeof animationDur !== 'undefined' ? animationDur : 500;
    var elems = elements;
    var ctrlsLocked = false;
    var slideShowPaused = false;
    var ignoreMouseOut = false;
    var index = 0;
    var automateID = new Array();
    var elem = elems[index];
    $(elem).show();
    var leftControl = sliderFrame.children(".media-slider-control-left");
    var rightControl = sliderFrame.children(".media-slider-control-right");
    
    var _this = this;
    _this.nextItem = function () {
        _this.lockCtrls();
        if (index != (elems.length - 1)) {
            var nextElem = $(elems[index + 1]);
            nextElem.prop("right", "-100%");
            $(elem).hide("slide", { direction: "left", easing: "easeInOutCirc" }, animationDur);
            nextElem.show("slide", { direction: "right", easing: "easeInOutCirc" }, animationDur, function () {
                _this.unlockCtrls();
            });
            elem = nextElem;
            index++;
        } else {
            var nextElem = $(elems[0]);
            nextElem.prop("right", "-100%");
            $(elem).hide("slide", { direction: "left", easing: "easeInOutCirc" }, animationDur);
            nextElem.show("slide", { direction: "right", easing: "easeInOutCirc" }, animationDur, function () {
                _this.unlockCtrls();
            });
            elem = nextElem;
            index = 0;
        }
    };
    _this.previousItem = function () {
        _this.lockCtrls();
        if (index != 0) {
            var nextElem = $(elems[index - 1]);
            nextElem.prop("left", "-100%");
            $(elem).hide("slide", { direction: "right", easing: "easeInOutCirc" }, animationDur);
            nextElem.show("slide", { direction: "left", easing: "easeInOutCirc" }, animationDur, function () {
                _this.unlockCtrls();
            });
            elem = nextElem;
            index--;
        } else {
            var nextElem = $(elems[(elems.length - 1)]);
            nextElem.prop("left", "-100%");
            $(elem).hide("slide", { direction: "right", easing: "easeInOutCirc" }, animationDur);
            nextElem.show("slide", { direction: "left", easing: "easeInOutCirc" }, animationDur, function () {
                _this.unlockCtrls();
            });
            elem = nextElem;
            index = (elems.length - 1);
        }
    };
    _this.setItem = function (ind) {
        _this.pauseSlideshowDelay();
        _this.lockCtrls();
        var nextElem = $(elems[ind]);
        nextElem.prop("left", "-100%");
        $(elem).hide("slide", { direction: "left", easing: "easeInOutCirc" }, animationDur);
        nextElem.show("slide", { direction: "right", easing: "easeInOutCirc" }, animationDur, function () {
            _this.unlockCtrls();
        });
        $('html, body').animate({
            scrollTop: $(".media-slider-frame").offset().top - 200
        }, 1000);
        elem = nextElem;
        index = ind;
    };
    _this.automateSlideshow = function () {
        if (slideShowPaused == false) {
            _this.nextItem();
            _this.clearTimeouts();
        }
        automateID[automateID.length] = setTimeout(function () {
            _this.automateSlideshow();
        }, slideShowDelay);
    };
    _this.playSlideshow = function () {
        if (!ignoreMouseOut && (elems.length > 1)) {
            _this.clearTimeouts();
            slideShowPaused = false;
            automateID[automateID.length] = setTimeout(function () {
                _this.automateSlideshow();
            }, slideShowDelay);
        }
    };
    _this.pauseSlideshow = function () {
        slideShowPaused = true;
    };
    _this.pauseSlideshowDelay = function () {
        slideShowPaused = true;
        ignoreMouseOut = true;
        setTimeout(function () {
            ignoreMouseOut = false;
            _this.playSlideshow();
        }, slideShowPauseDelay);
    };
    _this.lockCtrls = function () {
        ctrlsLocked = true;
    };
    _this.unlockCtrls = function () {
        ctrlsLocked = false;
    };
    _this.lockCtrlsTemp = function (duration) {
        var dur = typeof duration !== 'undefined' ? duration : animationDur;
        ctrlsLocked = true;
        setTimeout(function () {
            ctrlsLocked = false;
        }, dur);
    };
    _this.clearTimeouts = function () {
        while (automateID.length > 0) {
            clearTimeout(automateID[0]);
            automateID.splice(0, 1);
        }
    };
    _this.updateElems = function (selector) {
        elems = $(selector);

        $.each(elems, function (i, v) {
            $(v).hover(function () {
                _this.pauseSlideshow();
            }, function () {
                _this.playSlideshow();
            });
        });
    };

    if(elems.length > 1) {

        $.each(elems, function (i, v) {
            $(v).hover(function () {
                _this.pauseSlideshow();
            }, function () {
                _this.playSlideshow();
            });
        });        

        leftControl.click(function () {
            if (ctrlsLocked == false) {
                _this.pauseSlideshowDelay();
                _this.previousItem();
            }
        });

        rightControl.click(function () {
            if (ctrlsLocked == false) {
                _this.pauseSlideshowDelay();
                _this.nextItem();
            }
        });

        (function () {
            setTimeout(function () {
                _this.automateSlideshow();
            }, slideShowDelay);
        })();

    } else {
        leftControl.hide();
        rightControl.hide();
    }
}

//Fix nav controls to hover state when on mobile devices for greater visibility
$(document).ready(function () {
    if (jQuery.browser.mobile) {
        $(".media-slider-control-img").css("background", "rgba(255,255,255,0.15)");
    }
});

//---------------\\
// Pagify Script \\
//---------------\\

function Pagify(outerWrapper, innerWrapper, loader, currPage, constArgsForLoader) {
    var constArgsExist = typeof constArgsForLoader !== 'undefined' ? true : false;
    var crPg = typeof currPage !== 'undefined' ? currPage : 1;
    var url = "";
    var currPid = crPg;
    var totalPages = 0;

    function checkWrappersExist() {
        if ($(outerWrapper).length <= 0 || $(innerWrapper).length <= 0) {
            return false;
        }
        return true;
    };
    function checkLoaderExists() {
        $.get(loader)
            .done(function () {
                return true;
            }).fail(function () {
                return false;
            })
    };
    function getTotalPages() {
        return _this.getPageData({ "getTotalPages": true });
    };
    function addControls() {
        //add controls for pagify
    };
    function createUrl() {
        var l = "../" + loader;
        l += "?";
        if (constArgsExist) {
            var keys = Object.keys(constArgsForLoader);
            for (var i = 0; i < keys.length; ++i) {
                l += keys[i];
                l += "=";
                l += constArgsForLoader[keys[i]];
                l += "&";
            }
        }
        return l;
    };
    function createClickEventListeners() {
        //Create click even listeners for controls
    };
    function getAdjacentPage(isPrevious) {
        var isPrev = (typeof isPrevious !== 'undefined' && isPrevious) ? -1 : 1;
        _this.getPage(currPid + isPrev);
    };

    var _this = this;
    // Get page data as specified by args and data provided.
    // Returns:
    //     Parsed JSON response from AJAX call on success.
    //     -1 on failed AJAX call.
    _this.getPageData = function (argsForLoader, data) {
        var argsExist = typeof argsForLoader !== 'undefined' ? true : false;
        var d = typeof data !== 'undefined' ? data : "";
        var l = url;
        var r;
        if (argsExist) {
            var keys = Object.keys(argsForLoader);
            for (var i = 0; i < keys.length; ++i) {
                l += keys[i];
                l += "=";
                l += argsForLoader[keys[i]];
                l += "&";
            }
        }
        $.ajax({
            url: l,
            type: "POST",
            success: function (msg) {
                r = JSON.parse(msg);
            },
            async: false
        });
        return r;
    };
    // Gets page identified by the given page id.
    // If no page id is given, it gets the page of the current pid.
    // Returns:
    //     Parsed JSON response from AJAX call on success.
    //     -1 on failed AJAX call.
    //     -2 if pid lies outside range of pages accessible.
    _this.getPage = function (pid, argsForLoader) {
        var _pid = typeof pid !== 'undefined' ? pid : currPid;
        if (_pid <= 0 || _pid > totalPages) {
            return -2;
        }
        var argsExist = typeof argsForLoader !== 'undefined' ? true : false;
        var result = null;
        if (argsExist) {
            argsForLoader["pid"] = pid;
            console.log(argsForLoader);
            result = _this.getPageData(argsForLoader);
        } else {
            result = _this.getPageData({ "pid": _pid });
        }
        if (result == null || !result) {
            return -1;
        }
        currPid = _pid;
        return result;
    };
    _this.refreshControls = function () {
        //refresh controls for current page
    };
    
    if (!checkLoaderExists() && !checkWrappersExist()) {
        return;
    }
    url = createUrl();
    totalPages = getTotalPages();
    addControls();
    createClickEventListeners();
}