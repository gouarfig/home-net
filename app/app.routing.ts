import { Routes, RouterModule }  from '@angular/router';
import { HomeComponent } from './home.component';
import { WeatherPageComponent } from './weatherpage.component';
import { AboutComponent } from './about.component';

const appRoutes: Routes = [
  {
    path: '',
    redirectTo: '/home',
    pathMatch: 'full'
  },
  {
    path: 'home',
    component: HomeComponent
  },
  {
    path: 'weather',
    component: WeatherPageComponent
  },
  {
    path: 'about',
    component: AboutComponent
  }];

export const routing = RouterModule.forRoot(appRoutes);
