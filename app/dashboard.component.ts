import { Component } from '@angular/core';
import { SimpleChartExample } from './simple-chart-example.component';
import { StockChartExample } from './stock-chart-example.component';

@Component({
  selector: 'dashboard',
  templateUrl: 'app/dashboard.component.html',
  directives: [
    SimpleChartExample,
    StockChartExample],
})
export class DashboardComponent { }