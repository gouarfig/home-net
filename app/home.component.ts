import { Component } from '@angular/core';
import { SimpleChartExample } from './simple-chart-example.component';
import { StockChartExample } from './stock-chart-example.component';
import { WeatherComponent } from './weather.component';

@Component({
  selector: 'home',
  templateUrl: 'app/home.component.html',
  directives: [
    WeatherComponent,
    SimpleChartExample,
    StockChartExample],
})
export class HomeComponent { }