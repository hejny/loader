# Loader

This is simple js and css loader.

## Usage:

Thare should be provided one of these options:
?loader=async
?loader=sync
?loader=json

### In the sync and json loader should be also:
?version=[Semantic version]
?type=[js|css|*]

### In async loader should be:
?function=[loaderFunctionName]

###Async loader usage

Async loader requires jQuery to be included in window.

```javascript
window.loaderFunctionName(
    /*[Semantic version]*/'*',
    /*[js|css|*]*/'js',
    /*[callback]*/()=>{
        //now you can use loaded scripts
    }
);
```