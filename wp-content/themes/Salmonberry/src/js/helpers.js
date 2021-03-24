/* eslint-disable no-spaced-func */
/* eslint-disable no-undefined */
/* eslint-disable consistent-return */
/* eslint-disable func-names */
/* eslint-disable wrap-iife */
export function sendAJAX(url, data, success) {
    let params = typeof data === 'string' ? data : Object.keys(data).map(k => {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
    }).join('&');

    // eslint-disable-next-line no-undef
    let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    xhr.open('POST', url);
    xhr.onreadystatechange = () => {
        if (xhr.readyState > 3 && xhr.status === 200) {
            success(xhr.responseText);
        }
    };
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(params);
    return xhr;
}

export function getURLParameter(param) {
    let urlString = window.location.href;
    let url = new URL(urlString);
    return url.searchParams.get(param);
}

export function getHashParams() {
    let hashParams = {};
    let e;
    let r = /([^&;=]+)=?([^&;]*)/g;
    let q = window.location.hash.substring(1);
    // eslint-disable-next-line no-cond-assign
    while ( e = r.exec(q)) {
        hashParams[e[1]] = decodeURIComponent(e[2]);
    }
    return hashParams;
}

export function isMobile() {
    return window.innerWidth < 1024;
}

export function scrollTo(element, to, duration, direction) {
    if (animating || !element || to === undefined || !duration) { // stop when already triggered or missing args
        return false;
    }
    var _requestAnimationFrame = function (win, t) { return win['webkitR' + t] || win['r' + t] || win['mozR' + t] || win['msR' + t] || function (fn) { setTimeout(fn, 60); }; } (window, 'requestAnimationFrame');
    var easeInOutCubic = function (t) { return t < 0.5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1; };
    var end = +new Date() + duration;
    var from = (element === 'window') ? window.pageXOffset : element.scrollLeft;
    let animating = true;

    if (direction === 'vertical') {
        from = (element === 'window') ? window.pageYOffset : element.scrollTop;
    }

    var step = function () {
        var current = +new Date();
        var remaining = end - current;

        if (remaining < 0) {
            animating = false;
        } else {
            var ease = easeInOutCubic(1 - remaining / duration);

            if (!direction || direction === 'horizontal') {
                (element === 'window') ? window.scrollTo(from + (ease * (to - from)), window.pageYOffset) : element.scrollLeft = from + (ease * (to - from));
            } else if (direction === 'vertical') {
                (element === 'window') ? window.scrollTo(window.pageXOffset, from + (ease * (to - from))) : element.scrollTop = from + (ease * (to - from));
            }
        }

        _requestAnimationFrame(step);
    };
    step();
}

export function isElementVisible(el) {
    var bounding = el.getBoundingClientRect();
    return (
        bounding.top <= (window.innerHeight || document.documentElement.clientHeight) - 67 &&
        bounding.bottom >= 0
    );
}
