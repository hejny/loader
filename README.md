> :warning: This repository contains security issues - do not use it until consultation with @hejny .

# 🌐 Loader

<!--Badges-->

[![License of 🌐 Loader](https://img.shields.io/github/license/hejny/loader.svg?style=flat)](https://github.com/hejny/loader/blob/master/LICENSE)
[![NPM Version of 🌐 Loader](https://badge.fury.io/js/loader.svg)](https://www.npmjs.com/package/loader)
[![Quality of package 🌐 Loader](https://packagequality.com/shield/loader.svg)](https://packagequality.com/#?package=loader)
[![Known Vulnerabilities](https://snyk.io/test/github/hejny/loader/badge.svg)](https://snyk.io/test/github/hejny/loader)
[![Issues](https://img.shields.io/github/issues/hejny/loader.svg?style=flat)](https://github.com/hejny/loader/issues)

<!--/Badges-->

This is simple js and css loader.

## Usage:

Thare should be provided one of these options:
?loader=async
?loader=sync-redirect
?loader=json

### In the sync and json loader should be also:
?version=[Semantic version]
?type=[js|css|*]

### In async loader should be:
?function=[loaderFunctionName]

### Async loader usage

Async loader requires jQuery to be included in window.

```javascript
window.loaderFunctionName(
{
version: '*',
type: 'js'
},
()=>{
//now you can use loaded scripts
}
);
```



<!--Contributing-->

## 🖋️ Contributing

I am open to pull requests, feedback, and suggestions. Or if you like this utility, you can [☕ buy me a coffee](https://www.buymeacoffee.com/hejny) or [donate via cryptocurrencies](https://github.com/hejny/hejny/blob/main/documents/crypto.md).

<!--/Contributing-->


<!--Partners-->

## ✨ Partners


<a href="https://www.h-edu.org/">
<img src="https://www.h-edu.org/media/favicon.png" alt="H-edu logo" width="50"  />
</a>
&nbsp;&nbsp;&nbsp;
<a href="https://collboard.com/">
<img src="https://collboard.fra1.cdn.digitaloceanspaces.com/assets/18.12.1/logo-small.png" alt="Collboard logo" width="50"  />
</a>
&nbsp;&nbsp;&nbsp;
<a href="https://czech.events/">
<img src="https://czech.events/design/logos/czech.events.transparent-logo.png" alt="Czech.events logo" width="50"  />
</a>
&nbsp;&nbsp;&nbsp;
<a href="https://sigmastamp.ml/">
<img src="https://www.sigmastamp.ml/sigmastamp-logo.white.svg" alt="SigmaStamp logo" width="50"  />
</a>


[Become a partner](https://www.pavolhejny.com/contact/)

<!--/Partners-->