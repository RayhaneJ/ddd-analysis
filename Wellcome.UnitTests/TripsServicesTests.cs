using BingMapsRESTToolkit;
using Geolocation;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using System.Linq;
using Wellcome.API.Helpers;
using Coordinate = Geolocation.Coordinate;

namespace Wellcome.UnitTests
{
    [TestClass]
    public class TripsServicesTests
    {
        [TestMethod]
        public void GetCoordinatesTest()
        {
            var address = new SimpleAddress()
            {
                CountryRegion = "France",
                Locality = "Soisy sous montmorency",
                PostalCode = "95230",
            };

            var (latitude, longitude) = GeolocalisationHelper.GetCoordinates(address);

            var distance = GeoCalculator
                .GetDistance(new Coordinate(48.988506, 2.299731),
                new Coordinate(latitude, longitude), 1, DistanceUnit.Kilometers);
            Assert.IsTrue(distance <= 1);
        }
    }
}