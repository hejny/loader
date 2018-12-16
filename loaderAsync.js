window['{FUNCTION}'] = function(options, callback) {
	
	$.getJSON("{URL}?loader=json&type="+options.type+"&version=" + options.version)
	  .done(function(response) {

		console.log("Loading version " + response.data.version);
	
		if(options.ravenUrl){
			response.data.assets.js.push('https://cdn.ravenjs.com/3.27.0/raven.min.js');
		}

		let loadedCount = 0;
		let loadedAllCallback = function() {
	
			if(options.ravenUrl){
				Raven.config(options.ravenUrl).install();
				Raven.setTagsContext({ version: response.data.version });
				Raven.context(function () {
					callback(window.BookViewerApp);
				});
			}else{
				callback(window.BookViewerApp);
			}
		}
  
		response.data.assets.js.forEach(function(url) {
		  //todo without jQuery
		  jQuery.ajax({
			url: url,
			dataType: "script",
			success: function(){
			  loadedCount++;
			  console.log('Loaded "'+url+'"');
			  if(response.data.assets.js.length===loadedCount){
				loadedAllCallback();
			  }
			},
			async: true
		  });
		});
  
		response.data.assets.css.forEach(function(url) {
		  var head = document.getElementsByTagName("head")[0];
		  var link = document.createElement("link");
		  link.rel = "stylesheet";
		  link.type = "text/css";
		  link.href = url;
		  link.media = "all";
		  head.appendChild(link);
		});
	  })
	  .fail(function() {
		throw new Error("Error while loading BookViewerApp version " + version);
	  })
	  .always(function() {
		//console.log( "complete" );
	  });
  }
  