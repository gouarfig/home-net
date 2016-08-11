import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { routing } from './app.routing';

import { WeatherService } from './weather.service';

import { AppComponent } from './app.component';
import { HomeComponent } from './home.component';
import { WeatherComponent } from './weather.component';
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
        WeatherComponent,
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
