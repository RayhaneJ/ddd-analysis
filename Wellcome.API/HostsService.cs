using Geolocation;
using System.Linq.Expressions;
using Wellcome.Database;
using Wellcome.DataModel;

namespace Wellcome.API
{
    public class HostsService
    {
        //public List<Host> GetHosts()
        //{
        //    return new WellcomeContext().Hosts.ToList();
        //}

        //public List<Host> GetHosts(TripPattern p)
        //{
        //    var hosts = new WellcomeContext().Hosts
        //        .Where(h => p.Adults <= h.Travelers.Adults && p.Babies <= h.Travelers.Babies && p.Childs <= h.Travelers.Childs)
        //        .ToList();

        //    return hosts.Where(h =>
        //    {
        //        var perimeter = 10;
        //        return GeoCalculator
        //        .GetDistance(new Coordinate(p.Latitude, p.Longitude), new Coordinate(h.Address.Latitude, h.Address.Longitude), 1, DistanceUnit.Kilometers) <= perimeter;
        //    }).ToList();
        //}

        public FileStream GetHostPicture(int id)
        {
            using var ctx = new WellcomeContext();
            var path = ctx.HostPictures.Find(id).Path;
            var fullPath = Path.Join(Environment.CurrentDirectory, path);
            return File.OpenRead(fullPath);
        }

        public List<HostPresenter> GetHostsPresenters() 
            => new WellcomeContext().Hosts
                .Select(h => new HostPresenter
                {
                    City = h.Address.City,
                    Country = h.Address.Country,
                    FirstName = h.User.Contact.FirstName,
                    LastName = h.User.Contact.LastName,
                    Latitude = h.Address.Latitude,
                    Longitude = h.Address.Longitude,
                    PictureId = h.HostPicture.ID
                }).ToList();

        public List<HostPresenter> GetHostsPresenters(TripPattern p)
        {
            var hosts = new WellcomeContext().Hosts
                .Where(h => p.Adults <= h.Travelers.Adults && p.Babies <= h.Travelers.Babies && p.Childs <= h.Travelers.Childs)
                .Select(h => new HostPresenter
                {
                    City = h.Address.City,
                    Country = h.Address.Country,
                    FirstName = h.User.Contact.FirstName,
                    LastName = h.User.Contact.LastName,
                    Latitude = h.Address.Latitude,
                    Longitude = h.Address.Longitude,
                    PictureId = h.HostPicture.ID
                }).ToList();

            return hosts.Where(h =>
            {
                var perimeter = 10;
                return GeoCalculator
                .GetDistance(new Coordinate(p.Latitude, p.Longitude), new Coordinate(h.Latitude, h.Longitude), 1, DistanceUnit.Kilometers) <= perimeter;
            }).ToList();
        }
    }
}