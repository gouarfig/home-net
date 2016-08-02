import { Component } from '@angular/core';
import { ROUTER_DIRECTIVES } from '@angular/router';
import { NavigationComponent } from './navigation.component';

@Component({
  selector: 'home-net-app',
  templateUrl: 'app/app.component.html',
  directives: [ROUTER_DIRECTIVES, NavigationComponent]
})
export class AppComponent { }