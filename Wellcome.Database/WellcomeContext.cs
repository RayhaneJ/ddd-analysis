using System.Data.Entity;
using System.Data.Entity.ModelConfiguration.Conventions;
using Wellcome.DataModel;

namespace Wellcome.Database
{
    public class WellcomeContext : DbContext
    {
        public DbSet<Host> Hosts { get; set; }
        public DbSet<Address> Addresses { get; set; }
        public DbSet<Contact> Contacts { get; set; }
        public DbSet<HostConfiguration> Configurations { get; set; }
        public DbSet<TravelersConfiguration> Travelers { get; set; }
        public DbSet<User> Users { get; set; }
        public DbSet<Feedback> Feedbacks { get; set; }
        public DbSet<HostPicture> HostPictures { get; set; }
        public DbSet<ProfilePicture> ProfilePictures { get; set; }

        protected override void OnModelCreating(DbModelBuilder modelBuilder)
        {
            modelBuilder.Conventions.Remove<PluralizingTableNameConvention>();
            modelBuilder.Entity<User>()
                .HasOptional(s => s.ProfilePicture)
                .WithRequired(ad => ad.User);
            modelBuilder.Entity<Host>()
                .HasOptional(s => s.HostPicture)
                .WithRequired(ad => ad.Host);
        }
    }
}