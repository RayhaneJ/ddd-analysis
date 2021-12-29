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
                 new HostConfiguration { ID = 1, Bathrooms = 1, Beds = 2, Rooms = 3, Equipments = new string[] { "Machine" } }
                );

            modelBuilder.Entity<Contact>().HasData(
                 new Contact() { ID = 1, FirstName = "Rayhane", LastName = "JEBBARI", Mail = "jebray@gmail.com", Phone = "0668319888" },
                new Contact() { ID = 2, FirstName = "Jialei", LastName = "SUN", Mail = "sunjia@gmail.com", Phone = "0668315554" }
                );

            modelBuilder.Entity<Address>().HasData(
                 new Address { ID = 1, City = "Soisy", Country = "France", PostalCode = "95230", Street = "11 rue des dures terres", Longitude = 2.299731, Latitude = 48.988506 }
                );

            modelBuilder.Entity<TravelersConfiguration>().HasData(
                new TravelersConfiguration { ID = 1, Adults = 2, Babies = 2, Childs = 0, Pets = 0 }
               );

            modelBuilder.Entity<User>().HasData(
                new User { ID = 1, Age = 31, ContactId = 1, Gender = Gender.Male, Language =  "French" , Password = "password", Profession = "It Engineer", Description = "I like meet new people !" }
               );

            modelBuilder.Entity<ProfilePicture>().HasData(
               new ProfilePicture() { ID = 1, Path = "/Images/Seth_Luty_Profile_Picture.jpg", UserId = 1 }
              );

            modelBuilder.Entity<Host>().HasData(
              new Host
              {
                  ID = 1,
                  Title = "Title",
                  AddressID = 1,
                  HostConfigurationID = 1,
                  TravelersConfigurationID = 1,
                  UserId = 1,
                  Description = "Description",
              }
             );

            modelBuilder.Entity<HostPicture>().HasData(
                new HostPicture() { ID = 1, Path = "/Images/corporate_housing_newyork1.jpg", HostId = 1 }
             );

            modelBuilder.Entity<Feedback>().HasData(
                new Feedback { ID = 1, Notation = 4, Remark = "Good host !", TimeStamp = DateTime.Now, UserId = 1 }
             );

            modelBuilder.Entity<FavoriteHost>().HasData(
               new FavoriteHost { UserId = 1, HostId = 1 }
            );
        }
    }
}
