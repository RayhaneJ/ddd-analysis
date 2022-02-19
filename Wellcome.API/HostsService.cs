using Geolocation;
using Microsoft.AspNetCore.Http;
using Microsoft.EntityFrameworkCore;
using System.Linq.Expressions;
using Wellcome.API.Helpers;
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

        public async Task<HostReservationDto> SaveHostReservation(HostReservationDto request)
        {
            var user = await ctx.Users.SingleOrDefaultAsync(u => u.Contact.Mail == request.Email);
            var host = await ctx.Hosts.SingleOrDefaultAsync(u => u.Uuid == request.HostUuid);
            var hostReservation = new HostReservation
            {
                HostId = host.ID,
                UserId = user.ID,
                Phone = request.Phone,
                Message = request.Message,
                Uuid = Guid.NewGuid().ToString(),
            };
            await ctx.HostReservations.AddAsync(hostReservation);
            await ctx.SaveChangesAsync();
            return new HostReservationDto { Uuid = hostReservation.Uuid };
        }

        public async Task<List<HostPresenter>> GetPublishedHost(string email)
        {
            var user = await ctx.Users.SingleOrDefaultAsync(u => u.Contact.Mail == email);
            return await ctx.Hosts
                .Where(h => h.UserId == user.ID)
                .Select(h => new HostPresenter
                {
                    PictureUrl = h.HostPicture.Path, 
                    Title = h.Title
                }).ToListAsync();
        }

        public async Task<List<HostPresenter>> GetFavorites(string email)
        {
            var user = await ctx.Users.SingleOrDefaultAsync(u => u.Contact.Mail == email);   
            var presenters = await ctx.Hosts.Join(ctx.FavoriteHosts.Where(f => f.UserId == user.ID),
                h => h.ID,
                f => f.HostId,
                (h, f) =>
                    new HostPresenter
                    {
                        PictureUrl = h.HostPicture.Path,
                        Uuid = h.Uuid,
                        Title = h.Title,
                        IsFavorite = true
                    }).ToListAsync();
            return presenters;
        }

        public async Task<HostPresenter> CreateHost(HostRequest request)
        {
            using var transaction = ctx.Database.BeginTransaction();

            var (latitude, longitude) = GeolocalisationHelper.GetCoordinates(new BingMapsRESTToolkit.SimpleAddress
            {
                PostalCode = request.Address.PostalCode,
                Locality = request.Address.City,
                CountryRegion = request.Address.Country
            });

            var address = new Address
            {
                City = request.Address.City,
                Country = request.Address.Country,
                PostalCode = request.Address.PostalCode,
                Longitude = latitude,
                Latitude = longitude,
                Street = string.Empty
            };
            ctx.Addresses.Add(address);
            await ctx.SaveChangesAsync();

            var hostConfiguration = new HostConfiguration
            {
                Bathrooms = request.HostConfiguration.Bathrooms,
                Beds = request.HostConfiguration.Beds,
                Rooms = request.HostConfiguration.Rooms,
                Equipments = new string[0]
            };
            ctx.Configurations.Add(hostConfiguration);
            await ctx.SaveChangesAsync();

            var travelersConfiguration = new TravelersConfiguration
            {
                Childs = request.TravelersConfiguration.Childs,
                Adults = request.TravelersConfiguration.Adults,
                Babies = request.TravelersConfiguration.Babies,
                Pets = request.TravelersConfiguration.Pets,
            };
            ctx.Travelers.Add(travelersConfiguration);
            await ctx.SaveChangesAsync();

            var user = await ctx.Users
                .SingleOrDefaultAsync(u => u.Contact.Mail == request.Email);

            var host = new Host
            {
                Uuid = Guid.NewGuid().ToString(),
                UserId = user.ID,
                Title = request.Title,
                Description = request.Description,
                AddressID = address.ID,
                HostConfigurationID = hostConfiguration.ID,
                TravelersConfigurationID = travelersConfiguration.ID,
            };
            ctx.Hosts.Add(host);
            await ctx.SaveChangesAsync();

            var hostPicture = new HostPicture
            {
                HostId = host.ID,
                Path = Path.Combine(Environment.CurrentDirectory, "Images", request.PictureName),
            };
            ctx.HostPictures.Add(hostPicture);
            await ctx.SaveChangesAsync();

            transaction.Commit();

            return await GetHostPresenter(host.ID);
        }

        public async Task<FileUploadResult> UploadImage(UploadForm form)
        {
            string fileName = GenerateUniqueFilename(form.File);
            var filePath = Path.Combine(Environment.CurrentDirectory, "Images", fileName);
            using var fileStream = new FileStream(filePath, FileMode.Create);
            await form.File.CopyToAsync(fileStream);
            return new FileUploadResult { FileName = fileName };
        }

        private string GenerateUniqueFilename(IFormFile file)
        {
            var extension = Path.GetExtension(file.FileName);
            var receipt = Guid.NewGuid().ToString();
            var fileName = $"{receipt}{extension}";
            return fileName;
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
                Address = new AddressDto
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
                                Uuid = h.Uuid,
                                Title = h.Title
                            }).ToListAsync();

        private async Task<HostPresenter> GetHostPresenter(int hostId)
        {
            var host = await ctx.Hosts
                .Include(h => h.Address)
                .Include(h => h.User.Contact)
                .Include(h => h.HostPicture)
                .SingleOrDefaultAsync(h => h.ID == hostId);

            return new HostPresenter
            {
                City = host.Address.City,
                Country = host.Address.Country,
                FirstName = host.User.Contact.FirstName,
                LastName = host.User.Contact.LastName,
                Latitude = host.Address.Latitude,
                Longitude = host.Address.Longitude,
                PictureUrl = host.HostPicture.Path,
                Uuid = host.Uuid,
                Title = host.Title
            };
        }

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
                return GeolocalisationHelper.IsInPerimter(
                    new Coordinate { Latitude = p.Latitude, Longitude = p.Longitude },
                    new Coordinate { Latitude = h.Latitude, Longitude = h.Longitude },
                    perimeter);
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
                (p, f) => p).ToList().ForEach(p =>
                {
                    p.IsFavorite = true;
                });
            return filteredHosts;
        }
    }
}