import { Component } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { NavigationComponent } from './navigation.component';

import { AppConfiguration } from './app.config';

@Component({
  selector: 'home-net-app',
  templateUrl: 'app.component.html',
  directives: [ROUTER_DIRECTIVES, NavigationComponent],
  providers: [AppConfiguration]
})
export class AppComponent {
    constructor(private appConfig: AppConfiguration) {
    }
}