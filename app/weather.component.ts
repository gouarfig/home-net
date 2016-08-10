import { Component, OnInit } from '@angular/core';
import { IWeather, IMain, IWind, IClouds, IPrecipitation, IWeatherDateTime, IWeatherData } from './weather.models';

@Component({
    moduleId: module.id,
    selector: 'weather',
    templateUrl: 'weather.component.html'
})
export class WeatherComponent implements OnInit {
    private data: IWeatherData;

    constructor() { }

    ngOnInit() { }

}