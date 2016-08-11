import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { routing } from './app.routing';
import { AppComponent } from './app.component';
import { HomeComponent } from './home.component';
import { AboutComponent } from './about.component';

@NgModule({
    declarations: [
        AppComponent,
        HomeComponent,
        AboutComponent,
    ],
    imports: [
        BrowserModule,
        FormsModule,
        routing,
    ],
    bootstrap: [
        AppComponent
    ],
})
export class AppModule { }
