using Geolocation;
using System.Linq.Expressions;
using Wellcome.Database;
using Wellcome.DataModel;

namespace Wellcome.API
{
    public class HostsService
    {
        public List<Host> GetHosts()
        {
            return new WellcomeContext().Hosts.ToList();
        }

        public List<Host> GetHosts(TripPattern p)
        {
            var hosts = new WellcomeContext().Hosts
                .Where(h => p.Adults <= h.Travelers.Adults && p.Babies <= h.Travelers.Babies && p.Childs <= h.Travelers.Childs)
                .ToList();

            return hosts.Where(h =>
            {
                var perimeter = 10;
                return GeoCalculator
                .GetDistance(new Coordinate(p.Latitude, p.Longitude), new Coordinate(h.Address.Latitude, h.Address.Longitude), 1, DistanceUnit.Kilometers) <= perimeter;
            }).ToList();
        }
    }
}