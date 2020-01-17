let userLang = navigator.language || navigator.userLanguage;
let randomNumber = Date.now() / 1000 | 0;

csm = new window.CookieSettingsManager({server: {url: "/?type=12783490&no_cache=1&languageKey=" + userLang + "&version=" + randomNumber}});