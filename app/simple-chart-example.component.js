"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var angular2_highcharts_1 = require('angular2-highcharts');
var SimpleChartExample = (function () {
    function SimpleChartExample() {
        this.options = {
            credits: { enabled: false },
            title: { text: 'simple chart' },
            series: [{
                    data: [29.9, 71.5, 106.4, 129.2],
                }]
        };
    }
    SimpleChartExample = __decorate([
        core_1.Component({
            selector: 'simple-chart-example',
            directives: [angular2_highcharts_1.CHART_DIRECTIVES],
            template: "\n        <chart [options]=\"options\"></chart>\n    "
        }), 
        __metadata('design:paramtypes', [])
    ], SimpleChartExample);
    return SimpleChartExample;
}());
exports.SimpleChartExample = SimpleChartExample;
//# sourceMappingURL=simple-chart-example.component.js.map