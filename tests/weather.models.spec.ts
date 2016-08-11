import { IWeather, IMain, IWind, IClouds, IPrecipitation, IWeatherDateTime, IWeatherData } from '../app/weather.models'

describe('Weather Models', () => {
    it('IWeather can be loaded from an anonymous object', () => {
        let anonObject: any = {
            "id": 500,
            "main": "Rain",
            "description": "light rain",
            "icon": "10d"
        };
        let weather: IWeather = anonObject;
        expect(weather.id).toEqual(500);
        expect(weather.main).toEqual('Rain');
        expect(weather.description).toEqual('light rain');
        expect(weather.icon).toEqual('10d');
    });

    it('IWeather can be loaded from an anonymous object with more properties than the interface', () => {
        let anonObject: any = {
            "id": 500,
            "main": "Rain",
            "description": "light rain",
            "icon": "10d",
            "something": "else",
        };
        let weather: IWeather = anonObject;
        expect(weather.id).toEqual(500);
    });

    it('IWeather can be loaded from an anonymous object with missing properties', () => {
        let anonObject: any = {
            "id": 500,
            "main": "Rain",
        };
        let weather: IWeather = anonObject;
        expect(weather.id).toEqual(500);
        expect(weather.main).toEqual('Rain');
        expect(weather.description).toBeUndefined();
        expect(weather.icon).toBeUndefined();
    });

    it('IWeather can be loaded with null value', () => {
        let anonObject: any = null;
        let weather: IWeather = anonObject;
        expect(weather).toBeNull();
    });
});
