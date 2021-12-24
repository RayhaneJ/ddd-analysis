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

            context.Addresses.Add(GetAddress());
            context.Configurations.Add(GetConfiguration());
            context.Travelers.Add(GetTravelers());
            context.Contacts.Add(GetContact());
            context.SaveChanges();

            var hosts = new Host
            {
                Title = "Title",
                AddressID = context.Addresses.Single(a => a.City == "Soisy").ID,
                ConfigurationID = context.Configurations.Single(c => c.Beds == 2).ID,
                TravelersID = context.Travelers.Single(t => t.Adults == 2).ID,
                ContactID = context.Contacts.Single(c => c.FirstName == "Rayhane").ID,
                Description = "Description",
            };
            context.Hosts.Add(hosts);
            context.SaveChanges();
        }

        private Address GetAddress()
             => new()
             { City = "Soisy", Country = "France", PostalCode = "95230", Street = "11 rue des dures terres", Longitude = 2.299731, Latitude = 48.988506 };

        private TravelersConfiguration GetTravelers()
            => new()
            { Adults = 2, Babies = 2, Childs = 0, Pets = 0 };

        private DataModel.HostConfiguration GetConfiguration()
            => new()
            { Bathrooms = 1, Beds = 2, Rooms = 3, Equipments = null };

        private static Contact GetContact1()
            => new()
            { FirstName = "Rayhane", LastName = "JEBBARI", Mail = "jebray@gmail.com", Phone = "0668319888" };

        private static Contact GetContact2()
            => new()
            { FirstName = "Jialei", LastName = "SUN", Mail = "sunjia@gmail.com", Phone = "0668315554" };

        private static Feedback GetFeedbacks(int userId)
            => new()
            { Notation = 4, Remark = "Good host !", TimeStamp = DateTime.Now, UserId = userId };

        private static User GetUser(int contactId, int imageId)
        {
            return new User { Age = 31, ContactId = contactId, Gender = Gender.Male, Languages = new List<string> { "French" }, 
             ImageId = imageId, Password = "password", Profession = "It Engineer", }
        }
    }
}
