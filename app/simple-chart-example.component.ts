import { Component } from '@angular/core';
import { CHART_DIRECTIVES } from 'angular2-highcharts';
 
@Component({
    selector: 'simple-chart-example',
    directives: [CHART_DIRECTIVES],
    template: `
        <chart [options]="options"></chart>
    `
})
export class SimpleChartExample {
    constructor() {
        this.options = {
            title : { text : 'simple chart' },
            series: [{
                data: [29.9, 71.5, 106.4, 129.2],
            }]
        };
    }
    options: Object;
}