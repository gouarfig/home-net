import { Component } from '@angular/core';
import { ForecastComponent } from './forecast.component';

@Component({
  selector: 'forecastpage',
  templateUrl: 'app/forecastpage.component.html',
  directives: [
    ForecastComponent
    ]
})
export class ForecastPageComponent { }