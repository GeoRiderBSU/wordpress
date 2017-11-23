  
	$(function featured(){
        $('#featured .row .btn_active button').click(function(){

            $('#featured .featured_title').toggleClass('btn_active');
			$('#latest .latest_title').toggleClass('btn_active');

        });

        
     });	
   

   
    $(function latest(){
        $('#latest .row button').click(function(){

            $('#latest .latest_title').toggleClass('btn_active');
			$('#featured .featured_title').toggleClass('btn_active');
            
        });

      
    });


	$(function(f){
		var element = f('.back-top');
		f(window).scroll(function(){
			element['fade'+ (f(this).scrollTop() > 700 ? 'In': 'Out')](500);           
		});
	});

	$(function(f){
		var element = f('.back-top2');
		f(window).scroll(function(){
			element['fade'+ (f(this).scrollTop() > 1000 ? 'In': 'Out')](500);           
		});
	});

	
	