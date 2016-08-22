import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { routing } from './app.routing';

import { WeatherService } from './weather.service';
import { ForecastService } from './forecast.service';

import { AppComponent } from './app.component';
import { DashboardComponent } from './dashboard.component';
import { WeatherPageComponent } from './weatherpage.component';
import { ForecastPageComponent } from './forecastpage.component';
import { AboutComponent } from './about.component';
import { ErrorComponent } from './error.component';

import { AppConfiguration } from './app.config.ts';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        routing,
    ],
    declarations: [
        AppComponent,
        DashboardComponent,
        WeatherPageComponent,
        ForecastPageComponent,
        AboutComponent,
        ErrorComponent,
    ],
    providers: [
        WeatherService,
        ForecastService
    ],
    bootstrap: [
        AppComponent
    ],
})
export class AppModule { }
