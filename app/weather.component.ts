import { Component, OnInit } from '@angular/core';
import { IWeatherData } from './weather.forecast.models';
import { Messages } from './messages';
import { WeatherService } from './weather.service';

@Component({
    moduleId: module.id,
    selector: 'weather',
    templateUrl: 'weather.component.html',
    providers: [WeatherService],
})
export class WeatherComponent implements OnInit {
    private data: IWeatherData;
    private messages: Messages = new Messages();
    private me = this;

    constructor(private weatherService: WeatherService) {
    }

    private clearMessages() {
        this.messages.clear();
    }

    private dataEvent(data: IWeatherData) {
        this.clearMessages();
        this.data = data;
    }

    private errorEvent(error: any) {
        this.messages.error = <any>error;
        console.error(this.messages.error);
    }

    private completeEvent() {
        // Nothing here for now
    }

    private loadWeatherData() {
        this.clearMessages();
        this.messages.information = "Refreshing data...";
        this.weatherService.getWeather().subscribe(
            (data) => this.dataEvent(data),
            (error) => this.errorEvent(error),
            () => this.completeEvent()
        );
    }

    ngOnInit() {
        this.loadWeatherData();
    }

}