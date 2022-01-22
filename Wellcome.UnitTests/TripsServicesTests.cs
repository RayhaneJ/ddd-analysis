using GoogleMaps.LocationServices;
using Microsoft.VisualStudio.TestTools.UnitTesting;

namespace Wellcome.UnitTests
{
    [TestClass]
    public class TripsServicesTests
    {
        [TestMethod]
        public void GetCoordinatesTest()
        {
            var address = "Stavanger, Norway";
            var point =  new GoogleLocationService()
                            .GetLatLongFromAddress(address);
            Assert.AreEqual(48.988506, point.Latitude);
            Assert.AreEqual(2.299731, point.Longitude);
        }
    }
}