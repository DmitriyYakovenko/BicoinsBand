// JavaScript Document



jQuery(document).ready(function($) {

	//$("#ltc_info").hide();

    $(".main_category").click(function(){

		var drop_child=$(this).children('.dropdown');

		

		/*$(".dropdown").each(function(i,e){

			if($(e).hasClass('expanded') && !($(e).get(0)==$(drop_child).get(0)))

			{

				$(e).fadeOut(0);

				$(e).removeClass('expanded');

			}

		});*/

		

		$(drop_child).animate({

			opacity:1,

			height:'auto'

		},100,'linear',function(){

			

				if($(drop_child).hasClass('expanded'))

				{

					$(this).fadeOut(200);

					$(drop_child).removeClass('expanded');

				}

				else

				{					

					$(this).fadeIn(200);

					$(drop_child).addClass('expanded');

				}

			}

		);

	});

	

	$(".drop_options").click(function(e){

		var parent_category=$(this).parent().parent().parent();

		var category_value=$(parent_category).children('.category_value');

		

		$(category_value).html($(this).html());

		$('.dropdown').fadeOut(0);

		//$('.dropdown').removeClass('expanded');

		if($(category_value).attr('id')=='widget_coin')

		{

			var widget_parent_id=$(this).parent().parent().parent().parent().parent().attr('id');

			update_Widget(widget_parent_id);

		}

	});

	

	/*$(".main_category").trigger( "click" );

	var temp_coin=$("#widget_coin").parent();

	$(temp_coin).trigger( "click" );*/

	setTimeout(function(){$(".bitcoin-widget").css('opacity','1');},2000);

});



jQuery(window).bind("load",function(){

	jQuery(".main_category").trigger( "click" );

	var temp_coin=jQuery("#widget_coin").parent();

	jQuery(temp_coin).trigger( "click" );

	

	jQuery(".widget_period").each(function(i,e){

		var temp_period_dropdown=jQuery(e).parent();

		temp_period_dropdown=jQuery(temp_period_dropdown).children('.dropdown');

		jQuery(temp_period_dropdown).hide();

		jQuery(temp_period_dropdown).removeClass('expanded');

	});

	

});



function update_Widget(widget_parent_id)

{

	if((jQuery("#widget_coin").html()).toLowerCase()=='btc')

	{

		jQuery("#ltc_info").hide();

		jQuery("#btc_info").show();

		var listOfWidgets = new Array();

		listOfWidgets.push( jQuery("#"+widget_parent_id) );

		

		jQuery(".bitcoin-chart").css('opacity','0');

		jQuery("#btc_info .loading").show();

		

		 jQuery.get( btw_ajax_url , { action : "btw_data" , random : new Date().getTime() }, function( response ){



			jQuery.each( listOfWidgets , function( i , widget ){



				jQuery(widget).trigger("btw.update",[ response ]);



			});

			jQuery(".bitcoin-chart").css('opacity','1');

			jQuery("#btc_info .loading").hide();



		},"json");

	}

	else if((jQuery("#widget_coin").html()).toLowerCase()=='ltc')

	{

		jQuery("#btc_info").hide();

		jQuery("#ltc_info").show();

		//$("#ltc_info").css('opacity','0');

		//$("#bitcoin-tab-mtgox").show();

		

		jQuery(".litecoin-chart").css('opacity','0');

		jQuery("#ltc_info .loading").show();

		

		var listOfWidgets = new Array();

		listOfWidgets.push( jQuery("#"+widget_parent_id) );

		

				jQuery.get( lcw_ajax_url , { action : "lcw_data" , random : new Date().getTime() }, function( response ){

	

				jQuery.each( listOfWidgets , function( i , widget ){

	

					jQuery(widget).trigger("lcw.update",[ response ]);

	

				});

				

				jQuery(".litecoin-chart").css('opacity','1');

				jQuery("#ltc_info .loading").hide();

	

			},"json");

			//setTimeout(function(){$("#ltc_info").css('opacity','1');},1000);

		

		//$("#ltc_info .litecoin-tab-nav .drop_options").trigger('click');

		//$("#ltc_info #litecoin-tab-litecoin .litecoin-login-status a").trigger('click');

	}

}