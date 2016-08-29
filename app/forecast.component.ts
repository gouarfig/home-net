import { Component, OnInit } from '@angular/core';
import { IForecastData } from './weather.forecast.models';
import { Messages } from './messages';
import { ForecastService } from './forecast.service';

@Component({
    //moduleId: module.id,
    selector: 'forecast',
    templateUrl: 'forecast.component.html',
    providers: [ForecastService],
})
export class ForecastComponent implements OnInit {
    private data: IForecastData;
    private messages: Messages = new Messages();
    private me = this;

    constructor(private forecastService: ForecastService) {
    }

    private clearMessages() {
        this.messages.clear();
    }

    private dataEvent(data: IForecastData) {
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

    private loadForecastData() {
        this.clearMessages();
        this.messages.information = "Refreshing data...";
        this.forecastService.getForecast().subscribe(
            (data) => this.dataEvent(data),
            (error) => this.errorEvent(error),
            () => this.completeEvent()
        );
    }

    ngOnInit() {
        this.loadForecastData();
    }

}