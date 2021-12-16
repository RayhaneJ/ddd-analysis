using System.Linq.Expressions;
using Wellcome.Database;
using Wellcome.DataModel;

namespace Wellcome.API
{
    public class HostsService
    {
        public List<Host> GetHosts() => new WellcomeContext().Hosts.ToList();

        public List<Host> GetHosts(TripPattern pattern)
        {
            Func<TripPattern, Host, bool> hostMatch = (x, y) => addressMatch(x, y) && configurationMatch(x, y) && travelersMatch(x, y);
            return new WellcomeContext().Hosts.Where(h => hostMatch(pattern, h)).ToList();
        }

        private Func<TripPattern, Host, bool> addressMatch
            = (x, y) => x.Latitude == y.Address.Latitude && x.Longitude == y.Address.Longitude;

        private Func<TripPattern, Host, bool> configurationMatch
           = (x, y) => x.Rooms <= y.Configuration.Rooms && x.Bathrooms <= y.Configuration.Bathrooms && x.Beds <= y.Configuration.Beds;

        private Func<TripPattern, Host, bool> travelersMatch
           = (x, y) => x.Adults <= y.Travelers.Adults && x.Babies <= y.Travelers.Babies && x.Childs <= y.Travelers.Childs;
    }
}