import { Component } from '@angular/core';
import { WeatherComponent } from './weather.component';

@Component({
  selector: 'weatherpage',
  templateUrl: 'app/weatherpage.component.html',
  directives: [
    WeatherComponent
    ]
})
export class WeatherPageComponent { }