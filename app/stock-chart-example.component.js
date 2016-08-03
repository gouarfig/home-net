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
var http_1 = require('@angular/http');
var angular2_highcharts_1 = require('angular2-highcharts');
var StockChartExample = (function () {
    function StockChartExample(jsonp) {
        var _this = this;
        jsonp.request('https://www.highcharts.com/samples/data/jsonp.php?filename=aapl-c.json&callback=JSONP_CALLBACK').subscribe(function (res) {
            _this.options = {
                credits: { enabled: false },
                title: { text: 'AAPL Stock Price' },
                series: [{
                        name: 'AAPL',
                        data: res.json(),
                        tooltip: {
                            valueDecimals: 2
                        }
                    }]
            };
        });
    }
    StockChartExample = __decorate([
        core_1.Component({
            selector: 'stock-chart-example',
            directives: [angular2_highcharts_1.CHART_DIRECTIVES],
            providers: [http_1.JSONP_PROVIDERS],
            template: "<chart type=\"StockChart\" [options]=\"options\"></chart>"
        }), 
        __metadata('design:paramtypes', [http_1.Jsonp])
    ], StockChartExample);
    return StockChartExample;
}());
exports.StockChartExample = StockChartExample;
//# sourceMappingURL=stock-chart-example.component.js.map