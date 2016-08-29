import { Component, OnInit, ViewChild } from '@angular/core';
import { IWeatherData } from './weather.forecast.models';
import { Messages } from './messages';
import { WeatherService } from './weather.service';
import { ErrorComponent } from './error.component';

@Component({
    //moduleId: module.id,
    selector: 'weather',
    templateUrl: 'weather.component.html',
    providers: [WeatherService, ErrorComponent],
})
export class WeatherComponent implements OnInit {
    private data: IWeatherData;
    private messages: Messages = new Messages();
    private me = this;
    @ViewChild(ErrorComponent) errorComponent: ErrorComponent;

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
        this.errorComponent.setError(this.messages.error);
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