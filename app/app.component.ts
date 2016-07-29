import { Component } from '@angular/core';
import { SimpleChartExample } from './simple-chart-example.component';
import { StockChartExample } from './stock-chart-example.component';

@Component({
  selector: 'my-app',
  templateUrl: 'app/app.component.html',
  directives: [SimpleChartExample, StockChartExample]
})
export class AppComponent { }