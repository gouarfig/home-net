import { Injectable } from '@angular/core';
import { Http, Response } from '@angular/http';
import { IForecastData } from './weather.forecast.models';
import { Observable } from 'rxjs/Observable';

@Injectable()
export class ForecastService {
    private forecastUrl = 'php/forecast.json';

    constructor(private http: Http) { }

    private extractData(res: Response) : IForecastData {
        let body = res.json();
        return body.data || {} as IForecastData;
    }

    private handleError(error: any) {
        let errMsg = (error.message) ? error.message :
            error.status ? `${error.status} - ${error.statusText}` : 'Server error';
        console.error(errMsg);
        return Observable.throw(errMsg);
    }

    getForecast(): Observable<IForecastData> {
        return this.http.get(this.forecastUrl)
            .map(this.extractData)
            .catch(this.handleError);
    }
}
