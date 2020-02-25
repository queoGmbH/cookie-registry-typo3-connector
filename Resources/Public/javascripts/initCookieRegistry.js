(function () {
    var randomNumber = Date.now() / 1000 | 0;
    var baseUrlPath = window.location.href.replace(".html", "");
    // add page-type
    var jsonUrl = extendUrlParameters(baseUrlPath, "type", "12783490");
    // add no_cache
    jsonUrl = extendUrlParameters(jsonUrl, "no_cache", "1");
    // add random number
    jsonUrl = extendUrlParameters(jsonUrl, "version", randomNumber);

    /**
     *
     * @param sourceUrl
     * @param parameterName
     * @param parameterValue
     * @param replaceDuplicates
     * @returns {string}
     */
    function extendUrlParameters(sourceUrl, parameterName, parameterValue, replaceDuplicates)
    {
        if ((sourceUrl == null) || (sourceUrl.length == 0)) {
            sourceUrl = document.location.href;
        }

        var urlParts = sourceUrl.split("?");
        var newQueryString = "";
        if (urlParts.length > 1) {
            var parameters = urlParts[1].split("&");
            for (var i = 0; (i < parameters.length); i++) {
                var parameterParts = parameters[i].split("=");
                if (!(replaceDuplicates && parameterParts[0] == parameterName)) {
                    if (newQueryString == "") {
                        newQueryString = "?";
                    } else {
                        newQueryString += "&";
                    }
                    newQueryString += parameterParts[0] + "=" + parameterParts[1];
                }
            }
        }
        if (newQueryString == "") {
            newQueryString = "?";
        } else {
            newQueryString += "&";
        }

        newQueryString += parameterName + "=" + parameterValue;
        return urlParts[0] + newQueryString;
    }

    // init cookieSettingsManager with final json-url
    window.CookieSettingsManager = new CookieSettingsManager({server: {url: jsonUrl}});
}
)(window);