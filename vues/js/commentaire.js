$(document).ready(function(){

		$('div.rate').raty({ 
				path: imgRaty,
				scoreName: 'rate' ,
				cancel      : true,
	  			cancelPlace : 'right'
			});

		$('div.fixedRate').raty({ 
				path: imgRaty,
				readOnly: true,
				score: function() {
    				return $(this).attr('data-score');
    			}
			});

});
