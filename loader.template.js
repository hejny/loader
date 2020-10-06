function loadBookViewerApp(version, callback) {
	//todo relative url
	$.getJSON("{URL}?version=" + version, function() {
	  //console.log( "success" );
	})
	  .done(function(response) {
		console.log("Loading BookViewerApp version " + response.data.version);
  
		response.data.assets.js.push('https://cdn.ravenjs.com/3.27.0/raven.min.js');
		let loadedCount = 0;
		let loadedAllCallback = function() {
  
		  Raven.config('https://5c918bfd70aa495c9a1d2af00cdef72d@sentry.io/241169').install();
		  Raven.setTagsContext({ version: response.data.version });
		  Raven.context(function () {
			callback(window.BookViewerApp);
		  });
		  
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
  