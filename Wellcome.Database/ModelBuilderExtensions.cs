using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Wellcome.DataModel;

namespace Wellcome.Database
{
    public static class ModelBuilderExtensions
    {
        public static void Seed(this ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<HostConfiguration>().HasData(
                 new HostConfiguration { Bathrooms = 1, Beds = 2, Rooms = 3, Equipments = null }
                );

            modelBuilder.Entity<Contact>().HasData(
                 new Contact() { FirstName = "Rayhane", LastName = "JEBBARI", Mail = "jebray@gmail.com", Phone = "0668319888" },
                new Contact() { FirstName = "Jialei", LastName = "SUN", Mail = "sunjia@gmail.com", Phone = "0668315554" }
                );

            modelBuilder.Entity<Address>().HasData(
                 new Address { City = "Soisy", Country = "France", PostalCode = "95230", Street = "11 rue des dures terres", Longitude = 2.299731, Latitude = 48.988506 }
                );

            modelBuilder.Entity<TravelersConfiguration>().HasData(
                new TravelersConfiguration { Adults = 2, Babies = 2, Childs = 0, Pets = 0 }
               );

            modelBuilder.Entity<User>().HasData(
                new User { Age = 31, ContactId = 1, Gender = Gender.Male, Languages = new string[] { "French" }, Password = "password", Profession = "It Engineer", FavoriteHostsIds = new List<int> { 1 }, Description = "I like meet new people !" }
               );

            modelBuilder.Entity<ProfilePicture>().HasData(
               new ProfilePicture() { Path = "/Images/Seth_Luty_Profile_Picture.jpg", UserId = 1 }
              );

            modelBuilder.Entity<Host>().HasData(
              new Host
              {
                  Title = "Title",
                  AddressID = 1,
                  HostConfigurationID = 1,
                  TravelersConfigurationID = 1,
                  UserId = 1,
                  Description = "Description",
              }
             );

            modelBuilder.Entity<Host>().HasData(
                new HostPicture() { Path = "/Images/corporate_housing_newyork1.jpg", HostId = 1 }
             );

            modelBuilder.Entity<Host>().HasData(
                new Feedback { Notation = 4, Remark = "Good host !", TimeStamp = DateTime.Now, UserId = 1 }
             );
        }
    }
}
