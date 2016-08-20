import { Component } from '@angular/core';
import { WeatherComponent } from './weather.component';
import { WeatherHistory } from './history.component';

@Component({
  selector: 'weatherpage',
  templateUrl: 'app/weatherpage.component.html',
  directives: [
    WeatherComponent,
    WeatherHistory
    ]
})
export class WeatherPageComponent { }