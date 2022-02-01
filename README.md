> :warning: This repository contains security issues - do not use it until consultation with @hejny .

# Loader

<!--Badges-->

 [![Package Quality](https://packagequality.com/shield/loader.svg)](https://packagequality.com/#?package=loader)
 [![License](https://img.shields.io/github/license/hejny/loader.svg?style=flat)](https://raw.githubusercontent.com/hejny/loader/master/LICENSE)
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
