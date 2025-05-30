> :warning: This repository contains security issues - do not use it until consultation with @hejny .

# 🌐 Loader

<!--Badges-->
<!--⚠️WARNING: This section was generated by https://github.com/hejny/batch-project-editor/blob/main/src/workflows/800-badges/badges.ts so every manual change will be overwritten.-->


[![NPM Version of Loader](https://badge.fury.io/js/loader.svg)](https://www.npmjs.com/package/loader)
[![Quality of package Loader](https://packagequality.com/shield/loader.svg)](https://packagequality.com/#?package=loader)
[![Known Vulnerabilities](https://snyk.io/test/github/hejny/loader/badge.svg)](https://snyk.io/test/github/hejny/loader)
[![Issues](https://img.shields.io/github/issues/hejny/loader.svg?style=flat)](https://github.com/hejny/loader/issues)
<!--[![License of Loader](https://img.shields.io/github/license/hejny/loader.svg?style=flat)](https://github.com/hejny/loader/blob/main/LICENSE)-->
<!--[![Socket](https://socket.dev/api/badge/npm/package/loader)](https://socket.dev/npm/package/loader)-->

<!--/Badges-->

This is simple js and css loader.



<!--Wallpaper-->
<!--⚠️WARNING: This section was generated by https://github.com/hejny/batch-project-editor/blob/main/src//workflows/315-ai-generated-wallpaper/4-aiGeneratedWallpaperUseInReadme.ts so every manual change will be overwritten.-->
[![Wallpaper of 🌐 Loader](assets/ai/wallpaper/gallery/ba8a8600-1977-4a33-89e0-3831e8e6fa75-0_0.png)](https://www.midjourney.com/app/jobs/ba8a8600-1977-4a33-89e0-3831e8e6fa75)
<!--/Wallpaper-->

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
<!--⚠️WARNING: This section was generated by https://github.com/hejny/batch-project-editor/blob/main/src/workflows/810-contributing/contributing.ts so every manual change will be overwritten.-->

## 🖋️ Contributing

I am open to pull requests, feedback, and suggestions. Or if you like this utility, you can [☕ buy me a coffee](https://www.buymeacoffee.com/hejny) or [donate via cryptocurrencies](https://github.com/hejny/hejny/blob/main/documents/crypto.md).

You can also ⭐ star the loader package, [follow me on GitHub](https://github.com/hejny) or [various other social networks](https://www.pavolhejny.com/contact/).

<!--/Contributing-->


<!--Partners-->
<!--⚠️WARNING: This section was generated by https://github.com/hejny/batch-project-editor/blob/main/src/workflows/820-partners/partners.ts so every manual change will be overwritten.-->

## ✨ Partners


<a href="https://collboard.com/" title="Collboard"><img src="https://collboard.fra1.cdn.digitaloceanspaces.com/assets/18.12.1/logo-small.png#gh-light-mode-only" alt="Collboard" height="60"/></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://webgpt.cz/?partner=ph&utm_medium=referral&utm_source=github-readme&utm_campaign=partner-ph" title="WebGPT"><img src="https://webgpt.cz/_next/static/media/webgpt-black.8d958d25.png#gh-light-mode-only" alt="WebGPT" height="60"/></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="https://github.com/webgptorg/promptbook" title="Promptbook"><img src="https://raw.githubusercontent.com/webgptorg/promptbook/main/other/design/logo.png#gh-light-mode-only" alt="Promptbook" height="60"/></a>


[Become a partner](https://www.pavolhejny.com/contact/)

<!--/Partners-->