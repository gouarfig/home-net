import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { routing } from './app.routing';

import { WeatherService } from './weather.service';
import { ForecastService } from './forecast.service';

import { AppComponent } from './app.component';
import { HomeComponent } from './home.component';
import { WeatherPageComponent } from './weatherpage.component';
import { ForecastPageComponent } from './forecastpage.component';
import { AboutComponent } from './about.component';

@NgModule({
    imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        routing,
    ],
    declarations: [
        AppComponent,
        HomeComponent,
        WeatherPageComponent,
        ForecastPageComponent,
        AboutComponent,
    ],
    providers: [
        WeatherService
    ],
    bootstrap: [
        AppComponent
    ],
})
export class AppModule { }
