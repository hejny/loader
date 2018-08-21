function loadBookViewerApp(version, callback) {


//todo relative url
    var jqxhr = $.getJSON("{URL}?version=" + version, function () {
        //console.log( "success" );
    })
        .done(function (response) {

            console.log( "Loading BookViewerApp version "+response.data.version );

	    response.data.assets.js.forEach(function(url){
		     //todo without jQuery
		    jQuery.ajax({
		        url: url,
		        dataType: 'script',
		        success: function () {
		            callback(window.BookViewerApp);
		        },
		        async: true
		    });
	    });

	    response.data.assets.css.forEach(function(url){
		    var head = document.getElementsByTagName('head')[0];
		    var link = document.createElement('link');
		    link.rel = 'stylesheet';
		    link.type = 'text/css';
		    link.href = url;
		    link.media = 'all';
		    head.appendChild(link);
	    });


        })
        .fail(function () {
            throw new Error( "Error while loading BookViewerApp version "+version );
        })
        .always(function () {
            //console.log( "complete" );
        });


}
