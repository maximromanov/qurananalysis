<?php 
#   PLEASE DO NOT REMOVE OR CHANGE THIS COPYRIGHT BLOCK
#   ====================================================================
#
#    Quran Analysis (www.qurananalysis.com). Full Semantic Search and Intelligence System for the Quran.
#    Copyright (C) 2015  Karim Ouda
#
#    This program is free software: you can redistribute it and/or modify
#    it under the terms of the GNU General Public License as published by
#    the Free Software Foundation, either version 3 of the License, or
#    (at your option) any later version.
#
#    This program is distributed in the hope that it will be useful,
#    but WITHOUT ANY WARRANTY; without even the implied warranty of
#    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#    GNU General Public License for more details.
#
#    You should have received a copy of the GNU General Public License
#    along with this program.  If not, see <http://www.gnu.org/licenses/>.
#
#    You can use Quran Analysis code, framework or corpora in your website
#	 or application (commercial/non-commercial) provided that you link
#    back to www.qurananalysis.com and sufficient credits are given.
#
#  ====================================================================
require_once("../global.settings.php");


$lang = "AR";


if ( isset($_GET['lang']) )
{
	$lang = $_GET['lang'];
}

loadModels("core",$lang);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Arabic to Buckwalter Transliteration Mapping | Quran Analysis  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Full Analytics System for the Quran">
    <meta name="author" content="">

	<script type="text/javascript" src="<?=$JQUERY_PATH?>" ></script>
	<script type="text/javascript" src="<?=$MAIN_JS_PATH?>"></script>
	<link rel="stylesheet" href="/qe.style.css?bv=<?=$BUILD_VERSION?>" />
	<link rel="icon" type="image/png" href="/favicon.png">	 
	<script type="text/javascript">
	</script>
     
       
  </head>
  <body>
  
		<?php 
				require("./analysis.template.start.code.php");
		
		?>	
				
  <div id='main-container'>
			  	

  	    <?php include_once("help-content.php"); ?>
  	    
			
				Enter Arabic word or Buckwalter Transliteration to convert
				<br/>
				<br/>
				<input type="text" id='arabic-buckwalter-text' name="word" />
				<input type="button" value="Convert" id='conversion-button'  />
				
				
		
		
			
			<div id="loading-layer">
			  		Loading ...
					</div>
	
			  
			  	
			  	<div id='converted-text-area'>
					
				</div>
	
		  		
			
   </div>
   
   		<?php 
				require("./analysis.template.end.code.php");
		
		?>	

	<script type="text/javascript">


				
		$(document).ready(function()
		{


		
		});

    	$("#arabic-buckwalter-text").keyup(function(e){ 
		    var keyCode = e.which; 
		    
		    if(keyCode==13)
		    {
		    	e.preventDefault();
		      	$("#conversion-button").click();
		    } 
		});

		$("#conversion-button").click(function()
				{
			        var text = $("#arabic-buckwalter-text").val();

				
					if ( text=="" )
					{
						return;
					}



					$("#loading-layer").show();

					showTransliteration(text);

						  
				});

				
				function showTransliteration(text)
				{
				

					 
					
			
						$("#converted-text-area").html("");
						
						$.ajaxSetup({
							url:  "/analysis/buckwalter-transliteration.ajax.service.php?lang=<?=$lang?>&text="+encodeURIComponent(text),
							global: false,
							type: "GET"
							
						  });


						$.ajax({
							
							timeout: 60000,
							success: function(retRes)
									{

								  			$("#loading-layer").hide();
								      	 	
								  			$("#converted-text-area").html(retRes);


								  			trackEvent('ANALYSIS','buckwalter-transliteration',text,'');
			
								 	 	
								     },
							      	 error: function (xhr, ajaxOptions, thrownError)
							         {
							      		$("#converted-text-area").html("<center>Error occured !</center>");
							      		$("#loading-layer").hide();
							         }
								});
									
						
						

						 
						
						
				}


				


		
	</script>
		

	<?php 
		require("../footer.php");
	?>
	


  </body>
</html>







