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

        public async Task SetFavoriteHost(FavoriteRequest request)
        {
            var user = await ctx.Users.SingleOrDefaultAsync(u => u.Contact.Mail == request.Email);
            var host = await ctx.Hosts.SingleOrDefaultAsync(h => h.Uuid == request.HostUuid);
            await ctx.FavoriteHosts.AddAsync(
                new FavoriteHost { HostId = host.ID, UserId = user.ID });
            await ctx.SaveChangesAsync();
        }

        public async Task RemoveFavoriteHost(FavoriteRequest request)
        {
            var user = await ctx.Users.SingleOrDefaultAsync(u => u.Contact.Mail == request.Email);
            var host = await ctx.Hosts.SingleOrDefaultAsync(h => h.Uuid == request.HostUuid);
            var favorite = await ctx.FavoriteHosts.FindAsync(user.ID, host.ID);
            ctx.FavoriteHosts.Remove(favorite);
            await ctx.SaveChangesAsync();
        }

        public async Task<HostDetails> GetHostDetailsAsync(string uuid)
        {
            var host = await ctx.Hosts
                .Include(h => h.Address)
                .Include(h => h.User)
                    .ThenInclude(u => u.ProfilePicture)
                .Include(h => h.User)
                    .ThenInclude(u => u.Contact)
                .Include(h => h.Configuration)
                .Include(h => h.Travelers)
                .FirstOrDefaultAsync(x => x.Uuid == uuid);
                
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
                    Language = host.User.Language, 
                    PictureUrl = host.User.ProfilePicture.Path
                }
            };
        }

        public async Task<List<HostPresenter>> GetHostsPresentersAsync() => 
            await ctx.Hosts
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
            List<FilteredHost> filteredHosts = await FilterHostByPattern(p);

            var user = await ctx.Users.SingleOrDefaultAsync(u => u.Contact.Mail == p.Email);
            List<FilteredHost> filteredHostByLocalisation = FilterHostByLocalisation(p, filteredHosts);

            var filteredHostByFavorites = await SetFavorites(user.ID, filteredHostByLocalisation);

            var res = await FillHostDetails(filteredHostByFavorites);
            return res;
        }

        private async Task<List<HostPresenter>> FillHostDetails(List<FilteredHost> filteredHostByFavorites)
        {
            var hosts = await ctx.Hosts
                .Include(h => h.Address)
                .Include(h => h.User.Contact)
                .Include(h => h.HostPicture)
                .ToListAsync();
            var joinResult = hosts.Join(filteredHostByFavorites,
                            h => h.ID,
                            f => f.Id,
                            (h, f) => new HostPresenter
                            {
                                IsFavorite = f.IsFavorite,
                                City = h.Address.City,
                                Country = h.Address.Country,
                                FirstName = h.User.Contact.FirstName,
                                LastName = h.User.Contact.LastName,
                                Latitude = h.Address.Latitude,
                                Longitude = h.Address.Longitude,
                                PictureUrl = h.HostPicture.Path,
                                Uuid = h.Uuid,
                                Title = h.Title
                            }).ToList();
            return joinResult;
        }

        private static List<FilteredHost> FilterHostByLocalisation(TripPattern p, List<FilteredHost> filteredHosts)
        {
            return filteredHosts.Where(h =>
            {
                var perimeter = 10;
                return GeoCalculator
                .GetDistance(new Coordinate(p.Latitude, p.Longitude), new Coordinate(h.Latitude, h.Longitude), 1, DistanceUnit.Kilometers) <= perimeter;
            }).ToList();
        }

        private async Task<List<FilteredHost>> FilterHostByPattern(TripPattern p)
        {
            return await ctx.Hosts
                            .Where(h => p.Adults <= h.Travelers.Adults && p.Babies <= h.Travelers.Babies && p.Childs <= h.Travelers.Childs)
                            .Select(h => new FilteredHost
                            {
                                Id = h.ID,
                                Latitude = h.Address.Latitude,
                                Longitude = h.Address.Longitude,
                                IsFavorite = false
                            }).ToListAsync();
        }

        private async Task<List<FilteredHost>> SetFavorites(int userId, List<FilteredHost> filteredHosts)
        {
            var favoriteHosts = await ctx.FavoriteHosts.Where(f => f.UserId == userId).ToListAsync();
            filteredHosts.Join(favoriteHosts,
                p => p.Id,
                f => f.HostId,
                (p, f) => p).ToList().ForEach(p => {
                    p.IsFavorite = true;
                    });
            return filteredHosts;
        }
    }
}