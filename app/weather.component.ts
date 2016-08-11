import { Component, OnInit } from '@angular/core';
import { IWeather, IMain, IWind, IClouds, IPrecipitation, IWeatherDateTime, IWeatherData } from './weather.models';
import { WeatherService } from './weather.service';

@Component({
    moduleId: module.id,
    selector: 'weather',
    templateUrl: 'weather.component.html',
    providers: [WeatherService],
})
export class WeatherComponent implements OnInit {
    private data: IWeatherData = null;
    private errorMessage: any = "Loading...";

    constructor(private weatherService: WeatherService) {
    }

    private dataEvent(data: IWeatherData) {
        console.log("dataEvent");
        console.log(data);
        this.data = data;
    }

    private errorEvent(error: any) {
        this.errorMessage = <any>error;
        console.error(this.errorMessage);
    }

    private completeEvent() {
        console.log("completeEvent");
        this.errorMessage = "";
    }

    private loadWeatherData() {
        this.errorMessage = "Refreshing data...";
        this.weatherService.getWeather().subscribe(
            this.dataEvent,
            this.errorEvent,
            this.completeEvent
        );
    }

    ngOnInit() {
        this.loadWeatherData();
    }

}