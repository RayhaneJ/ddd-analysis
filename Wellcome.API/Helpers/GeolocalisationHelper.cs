using BingMapsRESTToolkit;
using Geolocation;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Coordinate = Geolocation.Coordinate;

namespace Wellcome.API.Helpers
{
    public class GeolocalisationHelper
    {
        private static readonly string apiKey = "AqCH5EFH9aLsR-HC3nAd363RPiw1A3FodhQyOA4eREcXwBQbKMXBwS6Q8jlNJQhd";

        //TODO : Handle null response
        public static (double latitude, double longitude) GetCoordinates(SimpleAddress address)
        {
            var request = new GeocodeRequest
            {
                BingMapsKey = apiKey,
                Address = address,
            };

            var result = request.Execute().GetAwaiter().GetResult();
            var toolkitLocation = (result?.ResourceSets?.FirstOrDefault())
                    ?.Resources?.FirstOrDefault() as Location;
            var latitude = toolkitLocation.Point.Coordinates[0];
            var longitude = toolkitLocation.Point.Coordinates[1];
            return (latitude, longitude);
        }

        public static double GetDistance(Coordinate c1, Coordinate c2) 
            => GeoCalculator
                .GetDistance(new Coordinate(c1.Latitude, c1.Longitude),
                new Geolocation.Coordinate(c2.Latitude, c2.Longitude), 1, DistanceUnit.Kilometers);


        public static bool IsInPerimter(Coordinate c1, Coordinate c2, int perimeter) 
            => GetDistance(
                c1,
                c2) <= perimeter;
    }
}
