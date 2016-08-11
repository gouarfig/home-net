"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var weather_service_1 = require('./weather.service');
var WeatherComponent = (function () {
    function WeatherComponent(weatherService) {
        this.weatherService = weatherService;
        this.data = null;
        this.errorMessage = "Loading...";
    }
    WeatherComponent.prototype.dataEvent = function (data) {
        console.log("dataEvent");
        console.log(data);
        this.data = data;
    };
    WeatherComponent.prototype.errorEvent = function (error) {
        this.errorMessage = error;
        console.error(this.errorMessage);
    };
    WeatherComponent.prototype.completeEvent = function () {
        console.log("completeEvent");
        this.errorMessage = "";
    };
    WeatherComponent.prototype.loadWeatherData = function () {
        this.errorMessage = "Refreshing data...";
        this.weatherService.getWeather().subscribe(this.dataEvent, this.errorEvent, this.completeEvent);
    };
    WeatherComponent.prototype.ngOnInit = function () {
        this.loadWeatherData();
    };
    WeatherComponent = __decorate([
        core_1.Component({
            moduleId: module.id,
            selector: 'weather',
            templateUrl: 'weather.component.html',
            providers: [weather_service_1.WeatherService],
        }), 
        __metadata('design:paramtypes', [weather_service_1.WeatherService])
    ], WeatherComponent);
    return WeatherComponent;
}());
exports.WeatherComponent = WeatherComponent;
//# sourceMappingURL=weather.component.js.map