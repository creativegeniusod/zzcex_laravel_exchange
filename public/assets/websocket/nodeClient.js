var socket = io.connect( 'http://127.0.0.1:8080' );

$( "#messageForm" ).submit( function() {
	var nameVal = $( "#nameInput" ).val();
	var msg = $( "#messageInput" ).val();

	socket.emit( 'message', { name: nameVal, message: msg } );

	return false;
});

socket.on( 'message', function( data ) {
	var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
	var content = newMsgContent;

	$( "#messages" ).append( content );
});
