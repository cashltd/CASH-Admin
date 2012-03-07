var http = require( "http" );

// Create our server to accept the node.js connection
var server = http.createServer(
	function(req, response){
    	response.writeHead(200, {'Content-Type':'text/html'});  
	}
);

// Set up the server port
server.listen(1338);



// Server has been created, create local memory space for NOW config
(function(){
	
	// This is a NOW application
	var nowjs = require("now");
	// Initialize the server and let us create everyone objects
	var everyone = nowjs.initialize(server);

	// Create a key for the user when they connect
	var primaryKey = 0;
	
	// Assign each client their ID, this is NOT synched to the client but can be used locally
	everyone.connected(
		function(){
			this.now.uuid = ++primaryKey;
			console.log("New Client with ID: " + primaryKey);
		}
	);
	
	
	// Create a function that can be called by every client
	everyone.now.markMap = function( ) { 
		// Post an alert to the console to see who's running this function
		console.log("Someone Clicked"); 
	};


})();