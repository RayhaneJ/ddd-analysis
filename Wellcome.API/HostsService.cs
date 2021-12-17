using System.Linq.Expressions;
using Wellcome.Database;
using Wellcome.DataModel;

namespace Wellcome.API
{
    public class HostsService
    {
        public List<Host> GetHosts() => new WellcomeContext().Hosts.ToList();

        public List<Host> GetHosts(TripPattern p) 
            => new WellcomeContext().Hosts
                .Where(h => h.Address.Latitude == p.Latitude && h.Address.Longitude == p.Longitude)
                .Where(h => p.Rooms <= h.Configuration.Rooms && p.Bathrooms <= h.Configuration.Bathrooms && p.Beds <= h.Configuration.Beds)
                .Where(h => p.Adults <= h.Travelers.Adults && p.Babies <= h.Travelers.Babies && p.Childs <= h.Travelers.Childs)
                .ToList();
    }
}