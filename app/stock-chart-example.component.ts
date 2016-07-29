import { Component } from '@angular/core';
import { Jsonp, JSONP_PROVIDERS } from '@angular/http';
import { CHART_DIRECTIVES } from 'angular2-highcharts';
 
 @Component({
    selector: 'stock-chart-example',
    directives: [CHART_DIRECTIVES],
    providers: [JSONP_PROVIDERS],
    template: `<chart type="StockChart" [options]="options"></chart>`
})
export class StockChartExample {
    constructor(jsonp : Jsonp) {
        jsonp.request('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=JSONP_CALLBACK').subscribe(res => {
            this.options = {
                title : { text : 'AAPL Stock Price' },
                series : [{
                    name : 'AAPL',
                    data : res.json(),
                    tooltip: {
                        valueDecimals: 2
                    }
                }]
            };
        });
    }
    options: Object;
}