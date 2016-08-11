"use strict";
describe('Weather Models', function () {
    it('IWeather can be loaded from an anonymous object', function () {
        var anonObject = {
            "id": 500,
            "main": "Rain",
            "description": "light rain",
            "icon": "10d"
        };
        var weather = anonObject;
        expect(weather.id).toEqual(500);
        expect(weather.main).toEqual('Rain');
        expect(weather.description).toEqual('light rain');
        expect(weather.icon).toEqual('10d');
    });
    it('IWeather can be loaded from an anonymous object with more properties than the interface', function () {
        var anonObject = {
            "id": 500,
            "main": "Rain",
            "description": "light rain",
            "icon": "10d",
            "something": "else",
        };
        var weather = anonObject;
        expect(weather.id).toEqual(500);
    });
    it('IWeather can be loaded from an anonymous object with missing properties', function () {
        var anonObject = {
            "id": 500,
            "main": "Rain",
        };
        var weather = anonObject;
        expect(weather.id).toEqual(500);
        expect(weather.main).toEqual('Rain');
        expect(weather.description).toBeUndefined();
        expect(weather.icon).toBeUndefined();
    });
    it('IWeather can be loaded with null value', function () {
        var anonObject = null;
        var weather = anonObject;
        expect(weather).toBeNull();
    });
});
//# sourceMappingURL=weather.models.spec.js.map