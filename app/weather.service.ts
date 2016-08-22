import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { IWeatherData } from './weather.forecast.models';
import { Observable } from 'rxjs/Observable';
import { ErrorComponent } from './error.component';

@Injectable()
export class WeatherService {
    private weatherUrl = 'php/weather.json';

    constructor(private http: Http) { }

    private extractData(res: Response) : IWeatherData {
        let body = res.json();
        return body.data || {} as IWeatherData;
    }

    private handleError(error: any) {
        let errMsg = (error.message) ? error.message :
            error.status ? `${error.status} - ${error.statusText}` : 'Server error';
        console.error(errMsg);
        return Observable.throw(errMsg);
    }

    getWeather(): Observable<IWeatherData> {
        return this.http.get(this.weatherUrl)
            .map(this.extractData)
            .catch(this.handleError);
    }
}
