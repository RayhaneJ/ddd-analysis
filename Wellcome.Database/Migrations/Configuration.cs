namespace Wellcome.Database.Migrations
{
    using System;
    using System.Data.Entity;
    using System.Data.Entity.Migrations;
    using System.Linq;
    using Wellcome.DataModel;

    internal sealed class Configuration : DbMigrationsConfiguration<Wellcome.Database.WellcomeContext>
    {
        public Configuration()
        {
            AutomaticMigrationsEnabled = false;
        }

        protected override void Seed(WellcomeContext context)
        {
            if (context.Hosts.Any())
                return;



            var configurations = new List<HostConfiguration>
            {
                new HostConfiguration { Bathrooms = 1, Beds = 2, Rooms = 3, Equipments = null }
            };
            context.Configurations.AddRange(configurations);
            context.SaveChanges();

            var contacts = new List<Contact>
            {
                new Contact() { FirstName = "Rayhane", LastName = "JEBBARI", Mail = "jebray@gmail.com", Phone = "0668319888" },
                new Contact() { FirstName = "Jialei", LastName = "SUN", Mail = "sunjia@gmail.com", Phone = "0668315554" }
            };
            context.Contacts.AddRange(contacts);
            context.SaveChanges();

            var addresses = new List<Address>()
            {
                 new Address { City = "Soisy", Country = "France", PostalCode = "95230", Street = "11 rue des dures terres", Longitude = 2.299731, Latitude = 48.988506 }
            };
            context.Addresses.AddRange(addresses);
            context.SaveChanges();

            var travelers = new List<TravelersConfiguration>
            {
                new TravelersConfiguration { Adults = 2, Babies = 2, Childs = 0, Pets = 0 }
            };
            context.Travelers.AddRange(travelers);
            context.SaveChanges();

            var users = new List<User>
            {
                new User { Age = 31, ContactId = 1, Gender = Gender.Male, Languages = new List<string> { "French" }, Password = "password", Profession = "It Engineer", FavoriteHostsIds = new List<int> { 1 } }
            };
            var profilePictures = new List<ProfilePicture>()
            {
                new ProfilePicture() {  Path = "/Images/Seth_Luty_Profile_Picture.jpg", UserId = 1 }
            };
            context.Users.AddRange(users);
            context.ProfilePictures.AddRange(profilePictures);
            context.SaveChanges();

            var hosts = new List<Host>
            {

                new Host
            {
                Title = "Title",
                AddressID = 1,
                HostConfigurationID = 1,
                TravelersConfigurationID = 1,
                UserId = 1,
                Description = "Description",
            }
                };
            var hostPictures = new List<HostPicture>()
            {
                new HostPicture() {  Path = "/Images/corporate_housing_newyork1.jpg", HostId = 1 }
            };
            context.Hosts.AddRange(hosts);
            context.HostPictures.AddRange(hostPictures);
            context.SaveChanges();

            var feedbacks = new List<Feedback>
            {
                new Feedback { Notation = 4, Remark = "Good host !", TimeStamp = DateTime.Now, UserId = 1 }
            };
            context.Feedbacks.AddRange(feedbacks);
            context.SaveChanges();
        }
    }
}
