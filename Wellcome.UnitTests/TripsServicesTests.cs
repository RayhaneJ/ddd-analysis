using BingMapsRESTToolkit;
using Geolocation;
using Microsoft.EntityFrameworkCore;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using System;
using System.Linq;
using Wellcome.API.Helpers;
using Wellcome.Database;
using Coordinate = Geolocation.Coordinate;

namespace Wellcome.UnitTests
{
    [TestClass]
    public class TripsServicesTests
    {
        private WellcomeContext context;

        public TripsServicesTests(WellcomeContext context)
        {
            this.context = context; 
        }

        [TestMethod]
        public void DateTest()
        {
            var date = "25/02/2022";
            var d = DateTime.ParseExact(date, "dd/MM/yyyy", null);
        }

        [TestMethod]
        public void GetCoordinatesTest()
        {
            //var c = context.Hosts.ToList();
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