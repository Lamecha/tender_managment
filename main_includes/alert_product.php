
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script type="text/javascript" src="alert/jquery.ulightbox.js"></script>

<link rel="stylesheet" type="text/css" href="alert/jquery.ulightbox.css" />

<script type="text/javascript">

 $(document).ready(function()
       {
               uLightBox.init({
                override:true,
              background: 'white',
              centerOnResize: true,
               fade: true,
			   
			   
		});
	
		
   
      $('#alert').click(function() {
      alert('Hello');
        });	
      $('.ajax').click(function() {
		 var $kk=($(this).attr('id'));
		 
      uLightBox.alert({
      width: '800px',
	  height: '200px',
      title: 'Update Tender Firm',
     rightButtons: ['Cancel'],
     
       opened: function() {
		   
     $('<span />').load('editProductFirm.php?Pid='+$kk).appendTo('#lbContent');
	 //---------------------
	 



	 //--------------------
	 
	   
	 
                            },
     onClick: function(button) {
		 
		 
           console.log(button);
                       }
                       });
                    });	
                                           
                                        });
										
										
										
                                    </script>
                                    
     
									