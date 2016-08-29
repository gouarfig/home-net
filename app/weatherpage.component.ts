import { Component } from '@angular/core';
import { WeatherComponent } from './weather.component';
import { WeatherHistory } from './history.component';

@Component({
  selector: 'weatherpage',
  templateUrl: 'weatherpage.component.html',
  directives: [
    WeatherComponent,
    WeatherHistory
    ]
})
export class WeatherPageComponent { }