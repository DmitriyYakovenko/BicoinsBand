(function($){

    var google_visualization_loaded = false;

    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(function(){

        google_visualization_loaded = true;

        $.each( widgetsWaitingForLoad , function( i , widget ){

            $( widget.element ).litecoinWidget( widget.data );

        });

    });

    var listOfWidgets = new Array();
    var widgetsWaitingForLoad = new Array();

    var widgetID = 0;

    

    $.fn.litecoinWidget = function( data ){

        if( !google_visualization_loaded ){

            return this.each(function(){

                widgetsWaitingForLoad.push({ "element" : this, "data" : data });

            });
        }

        return this.each(function(){

            var $widget = $(this),
                $tab_links = $widget.find("a.litecoin-tab-link"),
                $tabs = $widget.find(".litecoin-tab"),
                ID = widgetID++;

            listOfWidgets.push( $widget );

            if( listOfWidgets.length == 1 ){
                setInterval(function(){

                    $.get( lcw_ajax_url , { action : "lcw_data" , random : new Date().getTime() }, function( response ){

                        $.each( listOfWidgets , function( i , widget ){

                            $(widget).trigger("lcw.update",[ response ]);

                        });

                    },"json");

                }, 1 * 60 * 1000 );
            }

            $tab_links.each(function( index ){

                var $tab_link = $(this),
                    $tab = $tabs.eq(index),
                    tabName = $tab.attr("id").replace("litecoin-tab-",""),
                    tabData = data[tabName],
                    $time_links =  $tab.find(".litecoin-login-status a"),
                    time = null;

               $time_links.bind("click",function(e){

                    e.preventDefault();

                    $time_links.removeClass("active");

                    $(this).addClass("active");

                    time = $(this).data("time");

                    $tab.data("time",time);

                    $tab.find(".litecoin-chart").empty();

                    if( !tabData["chart"] || !tabData["chart"][ time ] || tabData["chart"][ time ].length == 0 ){
                        $tab.find(".litecoin-chart").addClass("litecoin-chart-disabled").html( "<span>Data currently not available</span>" );
                    }
                    else {
                        
                        var chartData = new Array();

                        chartData.push(['','']);

                        $.each( tabData["chart"][ time ] , function( index , time_data ){

                            chartData.push( [ null, time_data[ 1 ] ] );

                        } );

                        var googleChartData = google.visualization.arrayToDataTable(chartData);

                        var options = {
                            hAxis : {
                                textPosition : "none"
                            },
                            legend : {
                                position : "none"
                            }
                        };

                        var chart = new google.visualization.LineChart( $tab.find(".litecoin-chart").get( 0 ) );

                        chart.draw(googleChartData, options);

                        $(window).unbind("resize.litecoin"+ID).bind("resize.litecoin"+ID,function(){

                            chart.draw(googleChartData, options);

                        });

                    }

                });

                $tab_link.bind("click",function(e){

                    e.preventDefault();

                    $tab_links.removeClass("active");

                    $tab_link.addClass("active");

                    $tabs.hide();

                    $tab.show();
					
					var parent_dropdown=$time_links.filter(".active").parent().parent();
					$(parent_dropdown).addClass('expanded');

                    $time_links.filter(".active").trigger("click");

                });

                $tab.data("time","daily");

            }).first().trigger("click");

            $widget.bind("lcw.update",function( e, new_data ){
                data = new_data['lcw'];

                $tabs.each(function(){

                    var $tab = $(this),
                        tabName = $tab.attr("id").replace("litecoin-tab-",""),
                        tabData = data[tabName];
						
						var currency_symbol = '$';
						if (tabName == 'btc-china') {
							var currency_symbol = '&yen; ';
						}
						
						if (tabName == 'btc-avg') {
							var high_val = (tabData.ticker.high != 0)? ''+currency_symbol+(number_format(tabData.ticker.high,2))+'':'NA';
							var low_val = (tabData.ticker.low != 0)? ''+currency_symbol+(number_format(tabData.ticker.low,2))+'':'NA';
						}
						else {
							var high_val = currency_symbol+(number_format(tabData.ticker.high,2));
							var low_val = currency_symbol+(number_format(tabData.ticker.low,2));
						}
						
						var display_buy = $('#'+$widget.attr("id")+'-buy').val();
						var display_sell = $('#'+$widget.attr("id")+'-sell').val();
						var display_high = $('#'+$widget.attr("id")+'-high').val();
						var display_low = $('#'+$widget.attr("id")+'-low').val();
						var display_volume = $('#'+$widget.attr("id")+'-volume').val();
						
						var inner_content = '<ul>';
						if (display_buy == '1') {
						inner_content += '<li>Buy  <span class="item_val">'+currency_symbol+ (number_format(tabData.ticker.buy,2))+'</span></li>';
						}
						if (display_sell == '1') {
						inner_content += '<li>Sell  <span class="item_val">'+currency_symbol+ (number_format(tabData.ticker.sell,2))+'</span></li>';
						}
						if (display_high == '1') {
						inner_content += '<li>High  <span class="item_val">'+high_val+'</span></li>';
						}
						if (display_low == '1') {
						inner_content += '<li>Low  <span class="item_val">'+low_val+'</span></li>';
						}
						if (display_volume == '1') {
						inner_content += '<li>Volume  <span class="item_val">'+ (number_format(tabData.ticker.volume))+'  LTC</span></li>';
						}
						inner_content += '</ul>';

                    $tab.find(".litecoin-data").html(inner_content);

                    $tab.find('.litecoin-timeago').livestamp('destroy').livestamp( data.updated );
                        
                    $tab.find(".litecoin-chart").empty();

                    $tab.removeClass("litecoin-tab-loading");

                 //   if( tabData["chart"][ $tab.data("time") ].length == 0 ){
				    if( tabData["chart"][ $tab.data("time") ].length == 0 ){
                        $tab.find(".litecoin-chart").html( "Data currently not available" );
                    }
                    else {

                        var chartData = new Array();

                        chartData.push(['','']);

                        $.each( tabData["chart"][ $tab.data("time") ] , function( index , time_data ){

                            chartData.push( [ null, time_data[ 1 ] ] );

                        } );

                        var googleChartData = google.visualization.arrayToDataTable(chartData);

                        var options = {
                            hAxis : {
                                textPosition : "none"
                            },
                            legend : {
                                position : "none"
                            }
                        };

                        var chart = new google.visualization.LineChart( $tab.find(".litecoin-chart").get( 0 ) );

                        chart.draw(googleChartData, options);

                        $(window).unbind("resize.litecoin"+ID).bind("resize.litecoin"+ID,function(){

                            chart.draw(googleChartData, options);
                            
                        });

                    }

                });

            });

            $tabs.find('.litecoin-timeago').livestamp( data.updated );

        });
    }

})(jQuery);

