$(function() {
    var $chart = $( '#chart' );
    
    if( $chart.length == 1 ) {
        $.get( '/api/v1/statistics/' + $chart.data( 'id' ), function( response, xhr ) {
            var builder = ChartDataBuilder();
            builder.init( response );
            
            Chart.defaults.global.animationEasing        = 'easeInOutQuad',
            Chart.defaults.global.responsive             = true;
            Chart.defaults.global.scaleOverride          = true;
            Chart.defaults.global.scaleShowLabels        = false;
            Chart.defaults.global.scaleSteps             = 50;
            Chart.defaults.global.scaleStepWidth         = builder.getChartStepWidth( Chart.defaults.global.scaleSteps );
            Chart.defaults.global.scaleStartValue        = 0;
            Chart.defaults.global.tooltipFontFamily      = 'Open Sans';
            Chart.defaults.global.tooltipFillColor       = '#FFFFFF';
            Chart.defaults.global.tooltipFontColor       = '#ccc';
            Chart.defaults.global.tooltipCaretSize       = 0;
            Chart.defaults.global.maintainAspectRatio    = true;

            Chart.defaults.Line.scaleShowHorizontalLines = false;
            Chart.defaults.Line.scaleShowHorizontalLines = false;
            Chart.defaults.Line.scaleGridLineColor       = '#185a9d';
            Chart.defaults.Line.scaleLineColor           = '#185a9d';

            var chart    = document.getElementById('chart').getContext('2d'),
                gradient = chart.createLinearGradient(0, 0, 0, 900);
                // light blue
                gradient.addColorStop(0, '#185a9d');   
                // dark blue
                gradient.addColorStop(1, '#43cea2');

            var data  = {
                labels: builder.getLabels(),

                datasets: [
                    {
                      label: 'Custom Label Name',
                      fillColor: gradient,
                      strokeColor: '#185a9d',
                      pointColor: 'white',
                      pointStrokeColor: 'rgba(256,256,256,1)',
                      pointHighlightFill: '#fff',
                      pointHighlightStroke: 'rgba(256,256,256,1)',
                      data: builder.getData()
                    }
                ]
            };

            gradient.addColorStop(0, 'rgba(24, 90,157, 0.5)');
            gradient.addColorStop(0.5, 'rgba(24, 90,157, 0.25)');
            gradient.addColorStop(1, 'rgba(24, 90,157, 0)');

            var chart = new Chart(chart).Line(data);
        });
        
        function ChartDataBuilder() {
            var success,
                data,
                max;
            
            function _init( response ) {
                success = response[ 'success' ];
                
                __build( response );
            }
            
            function _getChartStepWidth( steps ) {
                return Math.pow( 10, Math.max( 1, Math.ceil( Math.log10(max) ) ) ) / steps;
            }
            
            function _getData() {
                var monthData,
                    requestsNo = [];
                
                for( monthData in data )
                    requestsNo.push( data[monthData]['requestsNo'] );
                
                return requestsNo;
            }
            
            function _getLabels() {
                var monthData,
                    labels = [];
                
                for( monthData in data ) {
                    monthData = data[monthData];
                    labels.push( ( monthData['month'] < 10 ? "0" : " " ) + monthData['month'] + "-" + monthData['year'] );
                }
                
                return labels;
            }
            
            function __build( response ) {
                if( success ) {
                    data = response[ 'data' ];
                    
                    __setMax();
                }
            }
            
            function __setMax() {
                var monthData,
                    _max = 0;
            
                for( monthData in data ) {
                    monthData = data[monthData];
                    
                    if( monthData[ 'requestsNo' ] > _max )
                        _max = monthData[ 'requestsNo' ];
                }
                
                max = _max;
            }
            
            return {
                'init': _init,
                'getChartStepWidth': _getChartStepWidth,
                'getData': _getData,
                'getLabels': _getLabels
            }
        }
    }
});    