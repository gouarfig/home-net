
export interface IWeather {
    id: number;
    main: string;
    description: string;
    icon: string;
}

export interface IMain {
    temp: number;
    pressure: number;
    humidity: number;
    temp_min: number;
    temp_max: number;
}

export interface IWind {
    speed: number;
    deg: number;
    gust: number;
}

export interface IClouds {
    all: number;
}

export interface IPrecipitation {
    one_hour: number;
    three_hours: number;
}

export interface IWeatherDateTime {
    timestamp: number;
    formatted: string;
}

export interface IWeatherData {
    weather: IWeather[];
    main: IMain;
    wind: IWind;
    rain: IPrecipitation;
    snow: IPrecipitation;
    clouds: IClouds;
    updated: IWeatherDateTime;
    town_id: number;
    town_name: string;
    timezone: number;
    sunrise: IWeatherDateTime;
    sunset: IWeatherDateTime;
}

export interface IForecastData {
    town_id: number;
    town_name: string;
    timezone: number;
    list: IForecastItem[];
}

export interface IForecastItem {
    weather: IWeather[];
    main: IMain;
    wind: IWind;
    rain: IPrecipitation;
    snow: IPrecipitation;
    clouds: IClouds;
    updated: IWeatherDateTime;
}
