
$(document).ready(function(){

	//alert(window.innerWidth);


	$('#firstLink-comment').click(function(event){
		event.preventDefault();
		$('#firstSquare-comment').show(1500);
	});

	$('#secondLink-comment').click(function(event){
		event.preventDefault();
		$('#secondSquare-comment').show(1500);
	});

	$('#thirdLink-comment').click(function(event){
		event.preventDefault();
		$('#thirdSquare-comment').show(1500);
	});

	$('#fourthLink-comment').click(function(event){
		event.preventDefault();
		$('#fourthSquare-comment').show(1500);
	});

});
