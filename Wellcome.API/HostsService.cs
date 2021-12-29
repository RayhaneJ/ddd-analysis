using Geolocation;
using Microsoft.EntityFrameworkCore;
using System.Linq.Expressions;
using Wellcome.Database;
using Wellcome.DataModel;

namespace Wellcome.API
{
    public class HostsService
    {
        private readonly WellcomeContext ctx;

        public HostsService(WellcomeContext context)
        {
            ctx = context;
        }

        public async Task<HostDetails> GetHostDetailsAsync(int id)
        {
            var host = await ctx.Hosts
                .Include(h => h.Address)
                .Include(h => h.User)
                .Include(h => h.Configuration)
                .Include(h => h.Travelers)
                .Include(h => h.User.Contact).FirstOrDefaultAsync(x => x.ID == id);
            return new HostDetails
            {
                Title = host.Title,
                Description = host.Description,
                Rooms = host.Configuration.Rooms,
                Bathrooms = host.Configuration.Bathrooms,
                Travelers = host.Travelers.Adults + host.Travelers.Childs + host.Travelers.Babies,
                Address = new Address
                {
                    City = host.Address.City,
                    Country = host.Address.Country,
                    Latitude = host.Address.Latitude,
                    Longitude = host.Address.Longitude,
                    PostalCode = host.Address.PostalCode,
                },
                Hoster = new Hoster
                {
                    Description = host.User.Description,
                    FirstName = host.User.Contact.FirstName,
                    LastName = host.User.Contact.LastName,
                    Age = host.User.Age,
                    Profession = host.User.Profession,
                    Gender = host.User.Gender.ToString(),
                    Language = host.User.Language
                }
            };
        }

        public async Task<List<HostPresenter>> GetHostsPresentersAsync() 
            => await ctx.Hosts
                .Select(h => new HostPresenter
                {
                    City = h.Address.City,
                    Country = h.Address.Country,
                    FirstName = h.User.Contact.FirstName,
                    LastName = h.User.Contact.LastName,
                    Latitude = h.Address.Latitude,
                    Longitude = h.Address.Longitude,
                    PictureUrl = h.HostPicture.Path,
                    Id = h.ID,
                    Title = h.Title
                }).ToListAsync();

        public async Task<List<HostPresenter>> GetHostsPresentersAsync(TripPattern p)
        {
            var hosts = await ctx.Hosts
                .Where(h => p.Adults <= h.Travelers.Adults && p.Babies <= h.Travelers.Babies && p.Childs <= h.Travelers.Childs)
                .Select(h => new HostPresenter
                {
                    City = h.Address.City,
                    Country = h.Address.Country,
                    FirstName = h.User.Contact.FirstName,
                    LastName = h.User.Contact.LastName,
                    Latitude = h.Address.Latitude,
                    Longitude = h.Address.Longitude,
                    PictureUrl = h.HostPicture.Path,
                    Id = h.ID,
                    Title = h.Title
                }).ToListAsync();

            return hosts.Where(h =>
            {
                var perimeter = 10;
                return GeoCalculator
                .GetDistance(new Coordinate(p.Latitude, p.Longitude), new Coordinate(h.Latitude, h.Longitude), 1, DistanceUnit.Kilometers) <= perimeter;
            }).ToList();
        }
    }
}